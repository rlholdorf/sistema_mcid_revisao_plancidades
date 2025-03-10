<?php

namespace App\Http\Controllers\Mod_plancidades;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mod_plancidades\IndicadoresIniciativa;
use App\Mod_plancidades\MetasIniciativas;
use App\Mod_plancidades\MonitoramentoIndicadoresIniciativas;
use App\Mod_plancidades\MonitoramentoIniciativas;
use App\Mod_plancidades\RegionalizacaoMetaIniciativa;
use App\Mod_plancidades\RlcMetasMonitoramentoIniciativas;
use App\Mod_plancidades\RlcRestricaoMetaMonitoramentoInic;
use App\Mod_plancidades\ViewApuracaoMetaIniciativa;
use App\Mod_plancidades\ViewIndicadoresIniciativa;
use App\Mod_plancidades\ViewMonitoramentoIniciativas;
use App\Mod_plancidades\ViewResumoApuracaoMetaIniciativa;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MonitoramentoIniciativaProcessoController extends Controller
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
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('modulo_plancidades.cadastrar_monitoramento_iniciativa_processo');
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

        $dados_monitoramento = new MonitoramentoIniciativas;

        $dados_monitoramento->user_id = $user->id;
        $dados_monitoramento->iniciativa_id = $request->iniciativa;
        $dados_monitoramento->dsc_analise_indicador = $request->dsc_analise_indicador;
        $dados_monitoramento->dsc_causas_impedimentos = $request->dsc_causas_impedimentos_atingimento_meta;
        $dados_monitoramento->dsc_desafios_proximos_passos = $request->dsc_desafios_proximos_passos;
        $dados_monitoramento->periodo_monitoramento_id = $request->periodoMonitoramento;
        $dados_monitoramento->num_ano_periodo_monitoramento = $request->anoMonitoramento;

        $dados_monitoramento->created_at = date('Y-m-d H:i:s');

        $dados_salvos = $dados_monitoramento->save();

        $metaIniciativa = MetasIniciativas::where('iniciativa_id', $dados_monitoramento->iniciativa_id)->first();

        if($metaIniciativa->bln_meta_regionalizada && $dados_salvos){
            $regionalizacoes = RegionalizacaoMetaIniciativa::where('meta_iniciativa_id', $metaIniciativa->id)->get();

            foreach($regionalizacoes as $regionalizacao){
                $rlc_metas_monitoramento = new RlcMetasMonitoramentoIniciativas();

                $rlc_metas_monitoramento->monitoramento_iniciativa_id = $dados_monitoramento->id;
                $rlc_metas_monitoramento->meta_iniciativa_id = $metaIniciativa->id;
                $rlc_metas_monitoramento->regionalizacao_meta_iniciativa_id = $regionalizacao->id;
                $rlc_metas_monitoramento->vlr_apurado = null;
                $rlc_metas_monitoramento->created_at = date('Y-m-d H:i:s');
                $rlc_metas_monitoramento->save();
            }
        }

        if ($dados_salvos) {
            DB::commit();

            flash()->sucesso("Sucesso", "Monitoramento cadastrado com sucesso!");
            return redirect("/plancidades/monitoramento/processo/iniciativa_processos/edit/" . $dados_monitoramento->id);
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
        $dados_monitoramento = ViewMonitoramentoIniciativas::find($id);

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

        $resumoApuracaoMeta = ViewResumoApuracaoMetaIniciativa::where('monitoramento_iniciativa_id', $id)->first();

        $metaIniciativa = MetasIniciativas::where('iniciativa_id', $dados_monitoramento->iniciativa_id)->first();

        
        $regionalizacaoMetas = RegionalizacaoMetaIniciativa::where('tab_regionalizacao_metas_iniciativas.meta_iniciativa_id', $metaIniciativa->id)
            ->leftJoin('mcid_plancidades.rlc_metas_monitoramento_iniciativas','rlc_metas_monitoramento_iniciativas.regionalizacao_meta_iniciativa_id','=','tab_regionalizacao_metas_iniciativas.id')
            ->where('rlc_metas_monitoramento_iniciativas.monitoramento_iniciativa_id',$id)
            ->orderBy('tab_regionalizacao_metas_iniciativas.id')
            ->get();
        $regionalizacaoMetas->load('regionalizacao', 'metasIniciativas.iniciativa');


        $restricoes = RlcRestricaoMetaMonitoramentoInic::where('monitoramento_iniciativa_id', $dados_monitoramento->monitoramento_iniciativa_id)->get();
        $restricoes->load('monitoramentoIniciativa', 'restricaoAtingimentoMeta');

        // if ($dados_monitoramento->bln_restricao && count($restricoes) == 0) {
        //     flash()->info("Meta não atingida", "Favor cadastrar o motivo do não atingimento da meta!");
        // }

        return view(
            'modulo_plancidades.iniciativa.show_monitoramento_iniciativa',
            compact(
                'dados_monitoramento',
                'restricoes',
                'metaIniciativa',
                'regionalizacaoMetas',
                'resumoApuracaoMeta'
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
        $dados_monitoramento = ViewMonitoramentoIniciativas::find($id);

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

        $resumoApuracaoMeta = ViewResumoApuracaoMetaIniciativa::where('monitoramento_iniciativa_id', $id)->first();

        $metaIniciativa = MetasIniciativas::where('iniciativa_id', $dados_monitoramento->iniciativa_id)->first();

        
        $regionalizacaoMetas = RegionalizacaoMetaIniciativa::where('tab_regionalizacao_metas_iniciativas.meta_iniciativa_id', $metaIniciativa->id)
            ->leftJoin('mcid_plancidades.rlc_metas_monitoramento_iniciativas','rlc_metas_monitoramento_iniciativas.regionalizacao_meta_iniciativa_id','=','tab_regionalizacao_metas_iniciativas.id')
            ->where('rlc_metas_monitoramento_iniciativas.monitoramento_iniciativa_id',$id)
            ->orderBy('tab_regionalizacao_metas_iniciativas.id')
            ->get();
        $regionalizacaoMetas->load('regionalizacao', 'metasIniciativas.iniciativa');


        $restricoes = RlcRestricaoMetaMonitoramentoInic::where('monitoramento_iniciativa_id', $dados_monitoramento->monitoramento_iniciativa_id)->get();
        $restricoes->load('monitoramentoIniciativa', 'restricaoAtingimentoMeta');

        if ($dados_monitoramento->bln_restricao && count($restricoes) == 0) {
            flash()->warning("Meta não atingida", "Favor cadastrar o motivo do não atingimento da meta!");
        }

        return view(
            'modulo_plancidades.iniciativa.editar_monitoramento_iniciativa',
            compact(
                'dados_monitoramento',
                'restricoes',
                'metaIniciativa',
                'regionalizacaoMetas',
                'resumoApuracaoMeta'
            )
        );
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
        
        $user = Auth()->user();
        DB::beginTransaction();
        //return $request;

        $dados_monitoramento =  MonitoramentoIniciativas::find($id);

        
        $dados_monitoramento->vlr_apurado_global = $request->vlr_apurado_global;

        $dados_monitoramento->dsc_analise_indicador = $request->dsc_analise_indicador;
        $dados_monitoramento->dsc_causas_impedimentos = $request->dsc_causas_impedimentos_atingimento_meta;
        $dados_monitoramento->dsc_desafios_proximos_passos = $request->dsc_desafios_proximos_passos;

        $dados_meta = ViewResumoApuracaoMetaIniciativa::where('monitoramento_iniciativa_id', $dados_monitoramento->id)->first();
        
        $checagem = ViewMonitoramentoIniciativas::where('monitoramento_iniciativa_id', $id)->first();


        switch ($checagem->polaridade_id) {
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

        if ($dados_meta->bln_ppa && !$dados_monitoramento->bln_meta_atingida && $dados_monitoramento->vlr_apurado_global != null){
            $dados_monitoramento->bln_restricao = true;
        }else{
            $dados_monitoramento->bln_restricao = false;
        }

        $restricoes = RlcRestricaoMetaMonitoramentoInic::where('monitoramento_iniciativa_id', $dados_monitoramento->id)->get();
        $restricoes->load('monitoramentoIniciativa', 'restricaoAtingimentoMeta');

        $regionalizacoesMonitoradas = RlcMetasMonitoramentoIniciativas::where('monitoramento_iniciativa_id',$id)
        ->whereNotNull('rlc_metas_monitoramento_iniciativas.vlr_apurado')->get();

        if ((($dados_monitoramento->bln_restricao && count($restricoes) > 0) || !$dados_monitoramento->bln_restricao) 
            && (!$dados_meta->bln_meta_regionalizada||count($regionalizacoesMonitoradas) >= $dados_meta->qtd_metas) 
            && $dados_monitoramento->vlr_apurado_global != null){
            $dados_monitoramento->bln_meta_apurada = true;
        }else{
            $dados_monitoramento->bln_meta_apurada = false;
        }


        $dados_salvos = $dados_monitoramento->update();

        if ($dados_salvos) {
            DB::commit();
            if($request->botao_salvar){
                flash()->sucesso("Sucesso", "Monitoramento atualizado com sucesso!");
                return redirect("/plancidades/monitoramento/processo/iniciativa_processos/edit/" . $dados_monitoramento->id);
            }
            if($request->botao_finalizar){
                //$statusMonitoramento->"Enviado para validação" -- LEMBRAR DE FAZER ESSA DISTINÇÃO DEPOIS, CONSIDERANDO TODOS OS CASOS
                flash()->sucesso("Sucesso", "Monitoramento do Indicador atualizado com sucesso!");
                return redirect("/plancidades/monitoramento/processo/iniciativa_processos/listar_monitoramentos/" . $dados_monitoramento->iniciativa_id);
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

    public function criarMonitoramento($iniciativaId)
    {
        // return $indicadorId;

        $dadosIniciativa = ViewindicadoresIniciativa::where('iniciativa_id', $iniciativaId)->first();
        $dadosMeta = MetasIniciativas::where('iniciativa_id', $iniciativaId)->first();

        return view('modulo_plancidades.iniciativa.iniciar_monitoramento_iniciativa', compact('dadosIniciativa', 'dadosMeta'));
        
        
    }

    public function consultarMonitoramento()
    {
        return view("modulo_plancidades.iniciativa.consultar_monitoramento_iniciativa");
    }

    public function pesquisarIniciativa(Request $request)
    {
        $where = [];

        //return $request->all();

        if ($request->orgaoResponsavel) {
            $where[] = ['orgao_pei_id', $request->orgaoResponsavel];
        }

        if ($request->objetivoEstrategico) {
            $where[] = ['objetivo_estrategico_pei_id', $request->objetivoEstrategico];
        }

        if ($request->iniciativa) {
            $where[] = ['iniciativa_id', $request->iniciativa];
        }



        $monitoramentos = ViewMonitoramentoIniciativas::where($where)->orderBy('txt_enunciado_iniciativa')->paginate(2);


        if (count($monitoramentos) > 0) {
            return view("modulo_plancidades.iniciativa.listar_monitoramentos_iniciativa", compact('monitoramentos'));
            //return $monitoramentos;
        } else {
            flash()->erro("Erro", "Nenhum monitoramento encontrado...");
            return back();
        }
    }

    public function listarMonitoramentos($iniciativaId)
    {
        $monitoramentos = ViewMonitoramentoIniciativas::where('iniciativa_id', $iniciativaId)->orderBy('monitoramento_iniciativa_id','desc')->get();
        
        if(count($monitoramentos) > 0){
            return view("modulo_plancidades.iniciativa.listar_monitoramentos_iniciativa", compact('monitoramentos'));
        }else{
            flash()->erro("Erro", "Nenhum monitoramento encontrado...");
            return back();
        }
    }
}