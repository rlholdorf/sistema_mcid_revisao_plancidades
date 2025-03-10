<?php

namespace App\Http\Controllers\Mod_plancidades;

use App\Mod_plancidades\MetasIndicadoresObjetivosEstrategicos;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mod_plancidades\IndicadoresObjetivosEstrategicos;
use App\Mod_plancidades\MetasObjetivosEstrategicos;
use App\Mod_plancidades\MonitoramentoIndicadores;
use App\Mod_plancidades\MonitoramentoIndicadoresObjEspecificos;
use App\Mod_plancidades\RegionalizacaoMetaObjEstr;
use App\Mod_plancidades\RlcMetasMonitoramentoIndicadores;
use App\Mod_plancidades\RlcMonitoramentoObjEspecificos;
use App\Mod_plancidades\RlcRestricaoMetaMonitoramentoIndic;
use App\Mod_plancidades\RlcSituacaoMonitoramentoIndicadores;
use App\Mod_plancidades\ViewIndicadoresObjetivosEstrategicos;
use App\Mod_plancidades\ViewApuracaoMetaIndicador;
use App\Mod_plancidades\ViewIndicadoresObjetivosEstrategicosMetas;
use App\Mod_plancidades\ViewMonitoramentoIndicadoresObjEstrategicos;
use App\Mod_plancidades\ViewResumoApuracaoMetaIndicador;
use App\Mod_plancidades\ViewValidacaoMonitoramentoIndicadores;
use Illuminate\Support\Facades\DB;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegrationAssertPostConditionsForV7AndPrevious;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Support\Facades\Redirect;

class MonitoramentoIndicadorController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        //$this->middleware('redirecionar'); 


    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($indicadorId)
    {
        $monitoramentos = ViewMonitoramentoIndicadoresObjEstrategicos::where('view_monitoramento_indicadores.indicador_objetivo_estrategico_id', $indicadorId)
        ->orderBy('view_monitoramento_indicadores.monitoramento_indicador_id', 'DESC')
        ->leftJoin('mcid_plancidades.view_validacao_monitoramento_indicadores','view_validacao_monitoramento_indicadores.monitoramento_indicador_id','=','view_monitoramento_indicadores.monitoramento_indicador_id')
        ->select('view_monitoramento_indicadores.*','view_validacao_monitoramento_indicadores.situacao_monitoramento_id','view_validacao_monitoramento_indicadores.txt_situacao_monitoramento')
        ->get();

        if(count($monitoramentos) > 0){
            return view("modulo_plancidades.objetivo_estrategico.listar_monitoramentos_indicador", compact('monitoramentos'));
        }else{
            flash()->erro("Erro", "Nenhum monitoramento encontrado...");
            return back();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($indicadorId)
    {   
        $dadosIndicador = ViewIndicadoresObjetivosEstrategicos::find($indicadorId);

        $situacoes = array('5', '6', null); // 5 - Validado; 6 - Validado e registrado no SIOP; NULL - Nenhum monitoramento registrado;

        if (!in_array($dadosIndicador->situacao_monitoramento_id, $situacoes)){
            DB::rollBack();
            flash()->erro("Erro", "Já existe um monitoramento para esse período.");
            return back();
        }

        $dadosMeta = ViewIndicadoresObjetivosEstrategicosMetas::find($indicadorId);

        return view('modulo_plancidades.objetivo_estrategico.iniciar_monitoramento_indicador', compact('dadosIndicador', 'dadosMeta'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth()->user();

        DB::beginTransaction();
        $where = [];
        $where[] = ['indicador_objetivo_estrategico_id', $request->indicador];
        $where[] = ['num_ano_periodo_monitoramento', $request->anoMonitoramento];
        $where[] = ['periodo_monitoramento_id', $request->periodoMonitoramento];


        $monitoramentoCadastrado = MonitoramentoIndicadores::where($where)->first();

        if (!empty($monitoramentoCadastrado)) {
            DB::rollBack();
            flash()->erro("Erro", "Já existe um monitoramento para esse período.");
            return back();
        }

        
        $dados_monitoramento = new MonitoramentoIndicadores();

        $dados_monitoramento->user_id = $user->id;
        $dados_monitoramento->indicador_objetivo_estrategico_id = $request->indicador;
        $dados_monitoramento->dsc_analise_indicador = $request->dsc_analise_indicador;
        $dados_monitoramento->dsc_causas_impedimentos = $request->dsc_causas_impedimentos_atingimento_meta;
        $dados_monitoramento->dsc_desafios_proximos_passos = $request->dsc_desafios_proximos_passos;
        $dados_monitoramento->periodo_monitoramento_id = $request->periodoMonitoramento;
        $dados_monitoramento->num_ano_periodo_monitoramento = $request->anoMonitoramento;
        
        $dados_monitoramento->created_at = date('Y-m-d H:i:s');

        $dados_salvos = $dados_monitoramento->save();

        $metaObjetivoEstrategico = MetasObjetivosEstrategicos::where('indicador_objetivo_estrategico_id', $dados_monitoramento->indicador_objetivo_estrategico_id)->first();


        if($metaObjetivoEstrategico->bln_meta_regionalizada && $dados_salvos){
            $regionalizacoes = RegionalizacaoMetaObjEstr::where('meta_objetivos_estrategicos_id', $metaObjetivoEstrategico->id)->get();

            foreach($regionalizacoes as $regionalizacao){
                $rlc_metas_monitoramento = new RlcMetasMonitoramentoIndicadores();

                $rlc_metas_monitoramento->monitoramento_indicador_id = $dados_monitoramento->id;
                $rlc_metas_monitoramento->meta_indicador_id = $metaObjetivoEstrategico->id;
                $rlc_metas_monitoramento->regionalizacao_meta_indicador_id = $regionalizacao->id;
                $rlc_metas_monitoramento->vlr_apurado = null;
                $rlc_metas_monitoramento->created_at = date('Y-m-d H:i:s');
                $rlc_metas_monitoramento->save();
            }
        }
        
        $situacao_monitoramento_indicadores = new RlcSituacaoMonitoramentoIndicadores();
        $situacao_monitoramento_indicadores->monitoramento_indicador_id = $dados_monitoramento->id;
        $situacao_monitoramento_indicadores->situacao_monitoramento_id = '2';
        $situacao_monitoramento_indicadores->user_id = $user->id;
        $situacao_monitoramento_indicadores->created_at = date('Y-m-d H:i:s');
        $situacao_monitoramento_indicadores->indicador_objetivo_estrategico_id = $request->indicador_objetivo_estrategico_id;
        $situacao_monitoramento_indicadores->save();
        
        if ($dados_salvos) {
            DB::commit();

            flash()->sucesso("Sucesso", "Monitoramento do Indicador cadastrado com sucesso!");
            return Redirect::route("plancidades.monitoramentos.objetivoEstrategico.editar", ["monitoramentoId" => $dados_monitoramento->id]);
        } else {
            DB::rollBack();
            flash()->erro("Erro", "Não foi possível cadastrar o monitoramento.");
            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $dados_monitoramento = ViewMonitoramentoIndicadoresObjEstrategicos::find($id);

        switch ($dados_monitoramento->unidade_medida_id){
            case 1:
                $dados_monitoramento->unidade_medida_simbolo = '(R$)';
                break;
            case 2:
                $dados_monitoramento->unidade_medida_simbolo = '(%)';
                break;
            case 3:
                $dados_monitoramento->unidade_medida_simbolo = '(ADI)';
                break;
            case 4:
                $dados_monitoramento->unidade_medida_simbolo = '(m²)';
                break;
            case 5:
                $dados_monitoramento->unidade_medida_simbolo = '(UN)';
                break;
            default:
                $dados_monitoramento->unidade_medida_simbolo = '';
        }

        $resumoApuracaoMeta = ViewResumoApuracaoMetaIndicador::where('monitoramento_indicador_id', $id)->first();

        $metaIndicador = MetasObjetivosEstrategicos::where('indicador_objetivo_estrategico_id', $dados_monitoramento->indicador_objetivo_estrategico_id)->first();

        $regionalizacaoMetas = RegionalizacaoMetaObjEstr::where('meta_objetivos_estrategicos_id', $metaIndicador->id)
            ->leftJoin('mcid_plancidades.rlc_metas_monitoramento_indicadores','rlc_metas_monitoramento_indicadores.regionalizacao_meta_indicador_id','=','tab_regionalizacao_metas_objetivos_estrategicos.id')
            ->where('rlc_metas_monitoramento_indicadores.monitoramento_indicador_id',$id)
            ->orderBy('tab_regionalizacao_metas_objetivos_estrategicos.id')
            ->get();
        $regionalizacaoMetas->load('regionalizacao', 'metasIndicadores.indicador');

        $restricoes = RlcRestricaoMetaMonitoramentoIndic::where('monitoramento_indicador_id', $dados_monitoramento->monitoramento_indicador_id)->get();
        $restricoes->load('monitoramentoIndicador', 'restricaoAtingimentoMeta');

        $situacao_monitoramento = ViewValidacaoMonitoramentoIndicadores::where('monitoramento_indicador_id', $id)->first();

        return view(
            'modulo_plancidades.objetivo_estrategico.show_monitoramento_indicador',
             compact(
                'dados_monitoramento', 
                'resumoApuracaoMeta', 
                'metaIndicador', 
                'regionalizacaoMetas', 
                'restricoes',
                'situacao_monitoramento'
            )
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $situacao_monitoramento = ViewValidacaoMonitoramentoIndicadores::where('monitoramento_indicador_id', $id)->first();

        if($situacao_monitoramento && ($situacao_monitoramento->situacao_monitoramento_id == 3 || $situacao_monitoramento->situacao_monitoramento_id == 5 || $situacao_monitoramento->situacao_monitoramento_id == 6 )) {

            flash()->erro("Erro", "Não foi possível atualizar o monitoramento.");
            return Redirect::route("plancidades.monitoramentos.objetivoEstrategico.listarMonitoramentos", ['monitoramentoId'=> $situacao_monitoramento->indicador_objetivo_estrategico_id]);
        }
        else{


            $dados_monitoramento = ViewMonitoramentoIndicadoresObjEstrategicos::find($id);

            switch ($dados_monitoramento->unidade_medida_id){
                case 1:
                    $dados_monitoramento->unidade_medida_simbolo = '(R$)';
                    break;
                case 2:
                    $dados_monitoramento->unidade_medida_simbolo = '(%)';
                    break;
                case 3:
                    $dados_monitoramento->unidade_medida_simbolo = '(ADI)';
                    break;
                case 4:
                    $dados_monitoramento->unidade_medida_simbolo = '(m²)';
                    break;
                case 5:
                    $dados_monitoramento->unidade_medida_simbolo = '(UN)';
                    break;
                default:
                    $dados_monitoramento->unidade_medida_simbolo = '';
            }

            $resumoApuracaoMeta = ViewResumoApuracaoMetaIndicador::where('monitoramento_indicador_id', $id)->first();

            $metaIndicador = MetasObjetivosEstrategicos::where('indicador_objetivo_estrategico_id', $dados_monitoramento->indicador_objetivo_estrategico_id)->first();

            $regionalizacaoMetas = RegionalizacaoMetaObjEstr::where('meta_objetivos_estrategicos_id', $metaIndicador->id)
                ->leftJoin('mcid_plancidades.rlc_metas_monitoramento_indicadores','rlc_metas_monitoramento_indicadores.regionalizacao_meta_indicador_id','=','tab_regionalizacao_metas_objetivos_estrategicos.id')
                ->where('rlc_metas_monitoramento_indicadores.monitoramento_indicador_id',$id)
                ->orderBy('tab_regionalizacao_metas_objetivos_estrategicos.id')
                ->get();
            $regionalizacaoMetas->load('regionalizacao', 'metasIndicadores.indicador');

            $restricoes = RlcRestricaoMetaMonitoramentoIndic::where('monitoramento_indicador_id', $dados_monitoramento->monitoramento_indicador_id)->get();
            $restricoes->load('monitoramentoIndicador', 'restricaoAtingimentoMeta');

        
            return view(
                'modulo_plancidades.objetivo_estrategico.editar_monitoramento_indicador',
                compact(
                    'dados_monitoramento', 
                    'resumoApuracaoMeta', 
                    'metaIndicador', 
                    'regionalizacaoMetas', 
                    'restricoes',
                    'situacao_monitoramento'
                )
            );
        }
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //return ($request);
        //return ($id);

        $user = Auth()->user();
        DB::beginTransaction();

        $dados_monitoramento = MonitoramentoIndicadores::find($id);

        if($request->vlr_apurado_global != null){
            $dados_monitoramento->vlr_apurado_global = $request->vlr_apurado_global;
        }
        if($request->dsc_analise_indicador != null){
            $dados_monitoramento->dsc_analise_indicador = $request->dsc_analise_indicador;
        }
        if($request->dsc_causas_impedimentos_atingimento_meta != null){
            $dados_monitoramento->dsc_causas_impedimentos = $request->dsc_causas_impedimentos_atingimento_meta;
        }
        if($request->dsc_desafios_proximos_passos != null){
            $dados_monitoramento->dsc_desafios_proximos_passos = $request->dsc_desafios_proximos_passos;
        }

        $dados_meta = ViewResumoApuracaoMetaIndicador::where('monitoramento_indicador_id', $dados_monitoramento->id)->first();
        
        $checagem = IndicadoresObjetivosEstrategicos::where('id', $dados_meta->indicador_objetivo_estrategico_id)->first();

        switch ($checagem->polaridades_id) {
            case 1:
                if($dados_monitoramento->vlr_apurado_global >= $dados_meta->vlr_esperado){
                    $dados_monitoramento->bln_meta_atingida = true;
                }else{
                    $dados_monitoramento->bln_meta_atingida = false;
                }
            break;
            case 2:
                if($dados_monitoramento->vlr_apurado_global <= $dados_meta->vlr_esperado){
                    $dados_monitoramento->bln_meta_atingida = true;
                }else{
                    $dados_monitoramento->bln_meta_atingida = false;
                }
            break;
            case 3:
                if($dados_monitoramento->vlr_apurado_global == $dados_meta->vlr_esperado){
                    $dados_monitoramento->bln_meta_atingida = true;
                }else{
                    $dados_monitoramento->bln_meta_atingida = false;
                }
            break;
            default:
        }

        if ($checagem->bln_ppa && !$dados_monitoramento->bln_meta_atingida && $dados_monitoramento->vlr_apurado_global != null){ //Tem que confirmar BLN_PPA = TRUE
            $dados_monitoramento->bln_restricao = true;
        }else{
            $dados_monitoramento->bln_restricao = false;
        }

        $restricoes = RlcRestricaoMetaMonitoramentoIndic::where('monitoramento_indicador_id', $dados_monitoramento->id)->get();
        $restricoes->load('monitoramentoIndicador', 'restricaoAtingimentoMeta');

        $regionalizacoesMonitoradas = RlcMetasMonitoramentoIndicadores::where('monitoramento_indicador_id',$id)
        ->whereNotNull('rlc_metas_monitoramento_indicadores.vlr_apurado')->get();
        

        if ((($dados_monitoramento->bln_restricao && count($restricoes) > 0) || !$dados_monitoramento->bln_restricao) 
            && (!$dados_meta->bln_meta_regionalizada||count($regionalizacoesMonitoradas) >= $dados_meta->qtd_metas) 
            && $dados_monitoramento->vlr_apurado_global != null){
            $dados_monitoramento->bln_meta_apurada = true;
        }else{
            $dados_monitoramento->bln_meta_apurada = false;
        }

        $dados_salvos = $dados_monitoramento->update();

        $checa_situacao_monitoramento = RlcSituacaoMonitoramentoIndicadores::where('monitoramento_indicador_id', $dados_monitoramento->id)->orderBy('created_at', 'desc')->first();
        
        

        if ($dados_salvos) {
            
            
            if($request->botao_salvar){
                if(!$checa_situacao_monitoramento || $checa_situacao_monitoramento->situacao_monitoramento_id <> '2'){
                    $situacao_monitoramento_indicadores = new RlcSituacaoMonitoramentoIndicadores();
                    $situacao_monitoramento_indicadores->monitoramento_indicador_id = $id;
                    $situacao_monitoramento_indicadores->situacao_monitoramento_id = '2';
                    $situacao_monitoramento_indicadores->user_id = $user->id;
                    $situacao_monitoramento_indicadores->created_at = date('Y-m-d H:i:s');
                    $situacao_monitoramento_indicadores->indicador_objetivo_estrategico_id = $dados_meta->indicador_objetivo_estrategico_id;
                    $situacao_monitoramento_indicadores->save();
                }

                DB::commit();
                flash()->sucesso("Sucesso", "Monitoramento do Indicador atualizado com sucesso!");
                return Redirect::route("plancidades.monitoramentos.objetivoEstrategico.editar", ['monitoramentoId'=> $dados_monitoramento->id]);
            }
            else{
                if($request->botao_finalizar){
                $situacao_monitoramento_indicadores = new RlcSituacaoMonitoramentoIndicadores();
                $situacao_monitoramento_indicadores->monitoramento_indicador_id = $id;
                $situacao_monitoramento_indicadores->situacao_monitoramento_id = '3';
                $situacao_monitoramento_indicadores->user_id = $user->id;
                $situacao_monitoramento_indicadores->created_at = date('Y-m-d H:i:s');
                $situacao_monitoramento_indicadores->indicador_objetivo_estrategico_id = $dados_meta->indicador_objetivo_estrategico_id;
                $situacao_monitoramento_indicadores->save();  
                // LEMBRAR DE FAZER ESSA DISTINÇÃO DEPOIS, CONSIDERANDO TODOS OS CASOS
                DB::commit();
                flash()->sucesso("Sucesso", "Monitoramento do Indicador finalizado com sucesso!");
                //return redirect("plancidades/monitoramento/processo/indicador_obj_estrategico/listar_monitoramentos/" . $dados_monitoramento->indicador_objetivo_estrategico_id);
                return Redirect::route("plancidades.monitoramentos.objetivoEstrategico.listarMonitoramentos", ['monitoramentoId'=> $dados_monitoramento->indicador_objetivo_estrategico_id]);
                
                }
            }
        } else {
            DB::rollBack();
            flash()->erro("Erro", "Não foi possível atualizar o monitoramento.");
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    

    public function consultarMonitoramento()
    {
        return view("modulo_plancidades.objetivo_estrategico.consultar_monitoramento_indicador");
    }

    public function pesquisarMonitoramento(Request $request)
    {
        $where = [];

        if ($request->orgaoResponsavel) {
            $where[] = ['orgao_pei_id', $request->orgaoResponsavel];
        }

        if ($request->objetivoEstrategico) {
            $where[] = ['objetivo_estrategico_pei_id', $request->objetivoEstrategico];
        }

        if ($request->indicador) {
            $where[] = ['indicador_objetivo_estrategico_id', $request->indicador];
        }

        $monitoramentos = ViewMonitoramentoIndicadoresObjEstrategicos::where($where)->orderBy('indicador_objetivo_estrategico_id')->paginate(10);

        if (count($monitoramentos) > 0) {
            return view("modulo_plancidades.listar_monitoramentos_indicador", compact('monitoramentos'));
        } else {
            flash()->erro("Erro", "Nenhum monitoramento encontrado...");
            return back();
        }
    }

    

}
