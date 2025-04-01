<?php

namespace App\Http\Controllers\Mod_plancidades;

use App\Mod_plancidades\MetasIndicadoresObjetivosEstrategicos;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mod_plancidades\IndicadoresObjetivosEstrategicos;
use App\Mod_plancidades\IndicadoresObjetivosEstrategicosRevisao;
use App\Mod_plancidades\MetasObjetivosEstrategicos;
use App\Mod_plancidades\MetasObjetivosEstrategicosRevisao;
use App\Mod_plancidades\MonitoramentoIndicadores;
use App\Mod_plancidades\MonitoramentoIndicadoresObjEspecificos;
use App\Mod_plancidades\RegionalizacaoMetaObjEstr;
use App\Mod_plancidades\RevisaoIndicadores;
use App\Mod_plancidades\RlcMetasMonitoramentoIndicadores;
use App\Mod_plancidades\RlcMonitoramentoObjEspecificos;
use App\Mod_plancidades\RlcRestricaoMetaMonitoramentoIndic;
use App\Mod_plancidades\RlcSituacaoMonitoramentoIndicadores;
use App\Mod_plancidades\RlcSituacaoRevisaoIndicadores;
use App\Mod_plancidades\ViewIndicadoresObjetivosEstrategicos;
use App\Mod_plancidades\ViewApuracaoMetaIndicador;
use App\Mod_plancidades\ViewIndicadoresObjetivosEstrategicosMetas;
use App\Mod_plancidades\ViewRevisaoIndicadoresObjEstrategicos;
use App\Mod_plancidades\ViewResumoApuracaoMetaIndicador;
use App\Mod_plancidades\ViewValidacaoMonitoramentoIndicadores;
use App\Mod_plancidades\ViewValidacaoRevisaoIndicadores;
use Illuminate\Support\Facades\DB;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegrationAssertPostConditionsForV7AndPrevious;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Support\Facades\Redirect;

class RevisaoIndicadorController extends Controller
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
        $revisoes = ViewRevisaoIndicadoresObjEstrategicos::where('view_revisao_indicadores.indicador_objetivo_estrategico_id', $indicadorId)
        ->orderBy('view_revisao_indicadores.revisao_indicador_id', 'DESC')
        ->leftJoin('mcid_hom_plancidades.view_validacao_revisao_indicadores','view_validacao_revisao_indicadores.revisao_indicador_id','=','view_revisao_indicadores.revisao_indicador_id')
        ->select('view_revisao_indicadores.*','view_validacao_revisao_indicadores.situacao_revisao_id','view_validacao_revisao_indicadores.txt_situacao_revisao')
        ->get();

        if(count($revisoes) > 0){
            return view("modulo_plancidades.revisao.objetivo_estrategico.listar_revisoes_indicador", compact('revisoes'));
        }else{
            flash()->erro("Erro", "Nenhuma revisao encontrada...");
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
    
        $revisaoCadastrada = RlcSituacaoRevisaoIndicadores::where('indicador_objetivo_estrategico_id', $indicadorId)->orderBy('created_at', 'desc')->first();

        $situacoes = array('5', '6', null);

        if (!empty($revisaoCadastrada)) {
            if(!in_array($revisaoCadastrada->situacao_revisao_id, $situacoes)) {
                DB::rollBack();
                flash()->erro("Erro", "Já existe uma revisão em andamento.");
                return back();
            }
        }

        $dadosIndicador = ViewIndicadoresObjetivosEstrategicosMetas::find($indicadorId);
        
        return view('modulo_plancidades.revisao.objetivo_estrategico.iniciar_revisao_indicador', compact('dadosIndicador'));
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
        $where[] = ['num_ano_periodo_revisao', $request->anoRevisao];
        $where[] = ['periodo_revisao_id', $request->periodoRevisao];
        
        $revisaoCadastrada = RevisaoIndicadores::where($where)->first();

        if (!empty($revisaoCadastrada)) {
            DB::rollBack();
            flash()->erro("Erro", "Já existe uma revisão em andamento.");
            return back();
        }   

        $dados_revisao = new RevisaoIndicadores();

        $dados_revisao->user_id = $user->id;
        $dados_revisao->indicador_objetivo_estrategico_id = $request->indicador;
        $dados_revisao->periodo_revisao_id = $request->periodoRevisao;
        $dados_revisao->num_ano_periodo_revisao = $request->anoRevisao;
        $dados_revisao->created_at = date('Y-m-d H:i:s');

        $dados_salvos = $dados_revisao->save();
        
        $situacao_revisao_indicadores = new RlcSituacaoRevisaoIndicadores();
        $situacao_revisao_indicadores->revisao_indicador_id = $dados_revisao->id;
        $situacao_revisao_indicadores->situacao_revisao_id = '2';
        $situacao_revisao_indicadores->user_id = $user->id;
        $situacao_revisao_indicadores->created_at = date('Y-m-d H:i:s');
        $situacao_revisao_indicadores->indicador_objetivo_estrategico_id = $request->indicador;
        $situacao_revisao_indicadores->save();

        $dados_revisao_indicador = new IndicadoresObjetivosEstrategicosRevisao();
        $dados_revisao_indicador->user_id = $user->id;
        $dados_revisao_indicador->revisao_indicador_id = $dados_revisao->id;
        $dados_revisao_indicador->indicador_objetivo_estrategico_id = $request->indicador;
        $dados_revisao_indicador->created_at = date('Y-m-d H:i:s');
        $dados_revisao_indicador->save();

        $dados_revisao_meta = new MetasObjetivosEstrategicosRevisao();
        $dados_revisao_meta->user_id = $user->id;
        $dados_revisao_meta->revisao_indicador_id = $dados_revisao->id;
        $dados_revisao_meta->indicador_objetivo_estrategico_id = $request->indicador;
        $dados_revisao_meta->meta_indicador_objetivo_estrategico_id = $request->metaObjetivoEstrategico;
        $dados_revisao_meta->created_at = date('Y-m-d H:i:s');
        $dados_revisao_meta->save();

        
        
        if ($dados_salvos) {
            DB::commit();

            flash()->sucesso("Sucesso", "Revisão do Indicador cadastrada com sucesso!");
            return Redirect::route("plancidades.revisao.objetivoEstrategico.editar", ["revisaoId" => $dados_revisao->id]);
        } else {
            DB::rollBack();
            flash()->erro("Erro", "Não foi possível cadastrar a revisão.");
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
        $dadosIndicador = ViewRevisaoIndicadoresObjEstrategicos::where('revisao_indicador_id', $id)->first();

            switch ($dadosIndicador->unidade_medida_id){
                case 1:
                    $dadosIndicador->unidade_medida_simbolo = '(R$)';
                    break;
                case 2:
                    $dadosIndicador->unidade_medida_simbolo = '(%)';
                    break;
                case 3:
                    $dadosIndicador->unidade_medida_simbolo = '(ADI)';
                    break;
                case 4:
                    $dadosIndicador->unidade_medida_simbolo = '(m²)';
                    break;
                case 5:
                    $dadosIndicador->unidade_medida_simbolo = '(UN)';
                    break;
                default:
                    $dadosIndicador->unidade_medida_simbolo = '';
            }
            
            $dadosRegionalizacao = RegionalizacaoMetaObjEstr::where('meta_objetivos_estrategicos_id', $dadosIndicador->objetivo_estrategico_meta_id)->get();

            return view('modulo_plancidades.revisao.objetivo_estrategico.show_revisao_indicador', compact('dadosIndicador', 'dadosRegionalizacao'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $revisaoCadastrada = RlcSituacaoRevisaoIndicadores::where('revisao_indicador_id', $id)->orderBy('created_at', 'desc')->first();

        if($revisaoCadastrada && ($revisaoCadastrada->situacao_revisao_id == 3 || $revisaoCadastrada->situacao_revisao_id == 5 || $revisaoCadastrada->situacao_revisao_id == 6 )) {

            flash()->erro("Erro", "Não foi possível atualizar a revisao.");
            return Redirect::route("plancidades.revisao.objetivoEstrategico.listarRevisoes", ['indicadorId'=> $revisaoCadastrada->indicador_objetivo_estrategico_id]);
        }
        else{

            $dadosIndicador = ViewIndicadoresObjetivosEstrategicosMetas::where('id', $revisaoCadastrada->indicador_objetivo_estrategico_id)->first();

            switch ($dadosIndicador->unidade_medida_id){
                case 1:
                    $dadosIndicador->unidade_medida_simbolo = '(R$)';
                    break;
                case 2:
                    $dadosIndicador->unidade_medida_simbolo = '(%)';
                    break;
                case 3:
                    $dadosIndicador->unidade_medida_simbolo = '(ADI)';
                    break;
                case 4:
                    $dadosIndicador->unidade_medida_simbolo = '(m²)';
                    break;
                case 5:
                    $dadosIndicador->unidade_medida_simbolo = '(UN)';
                    break;
                default:
                    $dadosIndicador->unidade_medida_simbolo = '';
            }
            
            $dadosIndicadorRevisao = IndicadoresObjetivosEstrategicosRevisao::where('revisao_indicador_id', $id)->first();
            
            $dadosMetaRevisao = MetasObjetivosEstrategicosRevisao::where('revisao_indicador_id', $id)->first();

            $dadosRegionalizacao = RegionalizacaoMetaObjEstr::where('meta_objetivos_estrategicos_id', $dadosIndicador->objetivo_estrategico_meta_id)->get();

            return view('modulo_plancidades.revisao.objetivo_estrategico.editar_revisao_indicador', compact('dadosIndicador', 'dadosRegionalizacao','revisaoCadastrada', 'dadosIndicadorRevisao', 'dadosMetaRevisao'));
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
        return ($request);
        //return ($id);

        $user = Auth()->user();
        DB::beginTransaction();

        $dados_revisao_indicador = IndicadoresObjetivosEstrategicosRevisao::where('revisao_indicador_id', $id)->first();

        $dados_revisao_indicador->user_id = $user->id;
        $dados_revisao_indicador->revisao_indicador_id = $request->revisao_indicador_id;
        $dados_revisao_indicador->indicador_objetivo_estrategico_id = $request->indicador_objetivo_estrategico_id;
        $dados_revisao_indicador->txt_denominacao_indicador = $request->txt_denominacao_indicador_nova;
        $dados_revisao_indicador->dsc_indicador = $request->dsc_indicador_nova;
        $dados_revisao_indicador->txt_sigla_indicador = $request->txt_sigla_indicador_nova;
        $dados_revisao_indicador->vlr_indice_referencia = $request->vlr_indice_referencia_nova;
        $dados_revisao_indicador->objetivo_estrategico_pei_id = $request->objetivo_estrategico_pei_id_nova;
        $dados_revisao_indicador->unidade_responsavel_id = $request->unidade_responsavel_id_nova;
        $dados_revisao_indicador->dte_apuracao = $request->dte_apuracao_nova;
        $dados_revisao_indicador->unidade_medida_id = $request->unidade_medida_id_nova;
        $dados_revisao_indicador->txt_periodo_ou_data = $request->txt_periodo_ou_data_nova;
        $dados_revisao_indicador->txt_data_divulgacao_ou_disponibilizacao = $request->txt_data_divulgacao_ou_disponibilizacao_nova;
        $dados_revisao_indicador->periodicidades_id = $request->periodicidades_id_nova;
        $dados_revisao_indicador->polaridades_id = $request->polaridades_id_nova;
        $dados_revisao_indicador->txt_formula_calculo = $request->txt_formula_calculo_nova;
        $dados_revisao_indicador->txt_variaveis_calculo = $request->txt_variaveis_calculo_nova;
        $dados_revisao_indicador->txt_fonte_dados_variaveis_calculo = $request->txt_fonte_dados_variaveis_calculo_nova;
        $dados_revisao_indicador->txt_forma_disponibilizacao = $request->txt_forma_disponibilizacao_nova;
        $dados_revisao_indicador->dsc_procedimento_calculo = $request->dsc_procedimento_calculo_nova;
        $dados_revisao_indicador->bln_ppa = $request->bln_ppa_nova;
        $dados_revisao_indicador->updated_at = date('Y-m-d H:i:s');

        $dados_salvos = $dados_revisao_indicador->update();

        $dados_revisao_meta = MetasObjetivosEstrategicosRevisao::where('revisao_indicador_id', $id)->first();

        $dados_revisao_meta->meta_indicador_objetivo_estrategico_id = $request->meta_indicador_objetivo_estrategico_id;
        $dados_revisao_meta->revisao_indicador_id = $request->revisao_indicador_id;
        $dados_revisao_meta->txt_dsc_meta = $request->txt_dsc_meta_nova;
        $dados_revisao_meta->indicador_objetivo_estrategico_id = $request->indicador_objetivo_estrategico_id;
        $dados_revisao_meta->bln_meta_cumulativa = $request->bln_meta_cumulativa_nova;
        $dados_revisao_meta->vlr_esperado_ano_2 = $request->vlr_esperado_ano_2_nova;
        $dados_revisao_meta->vlr_esperado_ano_3 = $request->vlr_esperado_ano_3_nova;
        $dados_revisao_meta->vlr_esperado_ano_4 = $request->vlr_esperado_ano_4_nova;
        $dados_revisao_meta->bln_meta_regionalizada = $request->bln_meta_regionalizada_nova;
        $dados_revisao_meta->dsc_justificativa_ausencia_regionalizacao = $request->dsc_justificativa_ausencia_regionalizacao_nova;
        $dados_revisao_meta->updated_at = date('Y-m-d H:i:s');
        $dados_revisao_meta->user_id = $user->id;

        $dados_revisao_meta->update();
        
        $checa_situacao_revisao = RlcSituacaoRevisaoIndicadores::where('revisao_indicador_id', $id)->orderBy('created_at', 'desc')->first();

        if ($dados_salvos) {
                        
            if($request->botao_salvar){
                if(!$checa_situacao_revisao || $checa_situacao_revisao->situacao_revisao_id <> '2'){
                    $situacao_revisao_indicadores = new RlcSituacaoRevisaoIndicadores();
                    $situacao_revisao_indicadores->revisao_indicador_id = $id;
                    $situacao_revisao_indicadores->situacao_revisao_id = '2';
                    $situacao_revisao_indicadores->user_id = $user->id;
                    $situacao_revisao_indicadores->created_at = date('Y-m-d H:i:s');
                    $situacao_revisao_indicadores->indicador_objetivo_estrategico_id = $request->indicador_objetivo_estrategico_id;
                    $situacao_revisao_indicadores->save();
                }

                DB::commit();
                flash()->sucesso("Sucesso", "Revisão do Indicador atualizada com sucesso!");
                return Redirect::route("plancidades.revisao.objetivoEstrategico.editar", ['revisaoId'=> $id]);
            }
            else{
                if($request->botao_finalizar){
                $situacao_revisao_indicadores = new RlcSituacaoRevisaoIndicadores();
                $situacao_revisao_indicadores->revisao_indicador_id = $id;
                $situacao_revisao_indicadores->situacao_revisao_id = '3';
                $situacao_revisao_indicadores->user_id = $user->id;
                $situacao_revisao_indicadores->created_at = date('Y-m-d H:i:s');
                $situacao_revisao_indicadores->indicador_objetivo_estrategico_id = $request->indicador_objetivo_estrategico_id;
                $situacao_revisao_indicadores->save();  
                // LEMBRAR DE FAZER ESSA DISTINÇÃO DEPOIS, CONSIDERANDO TODOS OS CASOS
                DB::commit();
                flash()->sucesso("Sucesso", "Revisão do Indicador finalizada com sucesso!");
                return Redirect::route("plancidades.revisao.objetivoEstrategico.listarRevisoes", ['indicadorId'=> $request->indicador_objetivo_estrategico_id]);
                
                }
            }
        } else {
            DB::rollBack();
            flash()->erro("Erro", "Não foi possível atualizar a revisao.");
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
    

    public function consultarIndicadores()
    {
        return view("modulo_plancidades.revisao.objetivo_estrategico.consultar_indicador");
    }

    public function pesquisarRevisoes(Request $request)
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

        $revisoes = ViewRevisaoIndicadoresObjEstrategicos::where($where)->orderBy('indicador_objetivo_estrategico_id')->paginate(10);

        if (count($revisoes) > 0) {
            return view("modulo_plancidades.revisao.objetivo_estrategico.listar_revisoes_indicador", compact('revisoes'));
        } else {
            flash()->erro("Erro", "Nenhum monitoramento encontrado...");
            return back();
        }
    }

}
