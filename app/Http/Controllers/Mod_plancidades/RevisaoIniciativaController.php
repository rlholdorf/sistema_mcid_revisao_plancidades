<?php

namespace App\Http\Controllers\Mod_plancidades;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mod_plancidades\IndicadoresIniciativasRevisao;
use App\Mod_plancidades\IniciativasRevisao;
use App\Mod_plancidades\MetasIniciativasRevisao;
use App\Mod_plancidades\RegionalizacaoMetaIniciativaRevisao;
use App\Mod_plancidades\RevisaoIniciativas;
use App\Mod_plancidades\RlcMetasMonitoramentoIndicadores;
use App\Mod_plancidades\RlcMonitoramentoObjEspecificos;
use App\Mod_plancidades\RlcRestricaoMetaMonitoramentoIndic;
use App\Mod_plancidades\RlcSituacaoMonitoramentoIndicadores;
use App\Mod_plancidades\RlcSituacaoRevisaoIniciativas;
use App\Mod_plancidades\ViewIndicadoresObjetivosEstrategicos;
use App\Mod_plancidades\ViewApuracaoMetaIndicador;
use App\Mod_plancidades\ViewIndicadoresIniciativas;
use App\Mod_plancidades\ViewIndicadoresIniciativasRevisao;
use App\Mod_plancidades\ViewRevisaoIniciativas;
use App\Mod_plancidades\ViewResumoApuracaoMetaIndicador;
use App\Mod_plancidades\ViewValidacaoMonitoramentoIndicadores;
use App\Mod_plancidades\ViewValidacaoRevisaoIniciativas;
use Illuminate\Support\Facades\DB;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegrationAssertPostConditionsForV7AndPrevious;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Support\Facades\Redirect;

class RevisaoIniciativaController extends Controller
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
    public function index($iniciativaId)
    {
        $revisoes = ViewRevisaoIniciativas::where('view_revisao_iniciativas.iniciativa_id', $iniciativaId)
        ->orderBy('view_revisao_iniciativas.revisao_iniciativa_id', 'DESC')
        ->leftJoin('mcid_hom_plancidades.view_validacao_revisao_iniciativas','view_validacao_revisao_iniciativas.revisao_iniciativa_id','=','view_revisao_iniciativas.revisao_iniciativa_id')
        ->select('view_revisao_iniciativas.*','view_validacao_revisao_iniciativas.situacao_revisao_id','view_validacao_revisao_iniciativas.txt_situacao_revisao')
        ->get();

        if(count($revisoes) > 0){
            return view("modulo_plancidades.revisao.iniciativa.listar_revisoes_iniciativa", compact('revisoes'));
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
    public function create($iniciativaId)
    {   
        $revisaoCadastrada = RlcSituacaoRevisaoIniciativas::where('iniciativa_id', $iniciativaId)->orderBy('created_at', 'desc')->first();

        $situacoes = array('5', '6', null);

        if (!empty($revisaoCadastrada)) {
            if(!in_array($revisaoCadastrada->situacao_revisao_id, $situacoes)) {
                DB::rollBack();
                flash()->erro("Erro", "Já existe uma revisão em andamento.");
                return back();
            }
        }

        $dadosIniciativa = ViewIndicadoresIniciativas::where('iniciativa_id' , $iniciativaId)->first();
        
        return view('modulo_plancidades.revisao.iniciativa.iniciar_revisao_iniciativa', compact('dadosIniciativa'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //return ($request);

        $user = Auth()->user();

        DB::beginTransaction();
        
        $where = [];
        $where[] = ['iniciativa_id', $request->iniciativa];
        $where[] = ['num_ano_periodo_revisao', $request->anoRevisao];
        $where[] = ['periodo_revisao_id', $request->periodoRevisao];
        
        $revisaoCadastrada = RevisaoIniciativas::where($where)->first();

        if (!empty($revisaoCadastrada)) {
            DB::rollBack();
            flash()->erro("Erro", "Já existe uma revisão em andamento.");
            return back();
        }   

        $dados_revisao = new RevisaoIniciativas();

        $dados_revisao->user_id = $user->id;
        $dados_revisao->iniciativa_id = $request->iniciativa;
        $dados_revisao->periodo_revisao_id = $request->periodoRevisao;
        $dados_revisao->num_ano_periodo_revisao = $request->anoRevisao;
        $dados_revisao->created_at = date('Y-m-d H:i:s');

        $dados_salvos = $dados_revisao->save();
        
        $situacao_revisao_iniciativas = new RlcSituacaoRevisaoIniciativas();
        $situacao_revisao_iniciativas->revisao_iniciativa_id = $dados_revisao->id;
        $situacao_revisao_iniciativas->situacao_revisao_id = '2';
        $situacao_revisao_iniciativas->user_id = $user->id;
        $situacao_revisao_iniciativas->created_at = date('Y-m-d H:i:s');
        $situacao_revisao_iniciativas->iniciativa_id = $request->iniciativa;
        $situacao_revisao_iniciativas->save();

        $dados_revisao_iniciativa = new IniciativasRevisao();
        $dados_revisao_iniciativa->user_id = $user->id;
        $dados_revisao_iniciativa->revisao_iniciativa_id = $dados_revisao->id;
        $dados_revisao_iniciativa->iniciativa_id = $request->iniciativa;
        $dados_revisao_iniciativa->objetivo_estrategico_pei_id = $request->objetivoEstrategico  ;
        $dados_revisao_iniciativa->created_at = date('Y-m-d H:i:s');
        $dados_revisao_iniciativa->save();

        $dados_revisao_indicador = new IndicadoresIniciativasRevisao();
        $dados_revisao_indicador->user_id = $user->id;
        $dados_revisao_indicador->revisao_iniciativa_id = $dados_revisao->id;
        $dados_revisao_indicador->iniciativa_id = $request->iniciativa;
        $dados_revisao_indicador->indicador_iniciativa_id = $request->indicadorIniciativa;
        $dados_revisao_indicador->created_at = date('Y-m-d H:i:s');
        $dados_revisao_indicador->save();

        $dados_revisao_meta = new MetasIniciativasRevisao();
        $dados_revisao_meta->user_id = $user->id;
        $dados_revisao_meta->revisao_iniciativa_id = $dados_revisao->id;
        $dados_revisao_meta->iniciativa_id = $request->iniciativa;
        $dados_revisao_meta->meta_iniciativa_id = $request->metaIniciativa;
        $dados_revisao_meta->created_at = date('Y-m-d H:i:s');
        $dados_revisao_meta->save();

        
        
        if ($dados_salvos) {
            DB::commit();

            flash()->sucesso("Sucesso", "Revisão da Iniciativa cadastrada com sucesso!");
            return Redirect::route("plancidades.revisao.iniciativa.editar", ["revisaoId" => $dados_revisao->id]);
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
        $dadosIniciativa = ViewRevisaoIniciativas::where('revisao_iniciativa_id', $id)->first();

            switch ($dadosIniciativa->unidade_medida_id){
                case 1:
                    $dadosIniciativa->unidade_medida_simbolo = '(R$)';
                    break;
                case 2:
                    $dadosIniciativa->unidade_medida_simbolo = '(%)';
                    break;
                case 3:
                    $dadosIniciativa->unidade_medida_simbolo = '(ADI)';
                    break;
                case 4:
                    $dadosIniciativa->unidade_medida_simbolo = '(m²)';
                    break;
                case 5:
                    $dadosIniciativa->unidade_medida_simbolo = '(UN)';
                    break;
                default:
                    $dadosIniciativa->unidade_medida_simbolo = '';
            }
            
            $dadosIniciativaRevisao = IniciativasRevisao::where('revisao_iniciativa_id', $id)->orderBy('created_at', 'desc')->first();
            
            $dadosIndicadorIniciativaRevisao = IndicadoresIniciativasRevisao::where('revisao_iniciativa_id', $id)->orderBy('created_at', 'desc')->first();
            
            $dadosMetaIniciativaRevisao = MetasIniciativasRevisao::where('revisao_iniciativa_id', $id)->orderBy('created_at', 'desc')->first();

            $dadosRegionalizacao = RegionalizacaoMetaIniciativaRevisao::where('meta_objetivos_estrategicos_id', $dadosIniciativa->meta_iniciativa_id)->get();

            return view('modulo_plancidades.revisao.iniciativa.show_revisao_iniciativa', compact('dadosIniciativa', 'dadosRegionalizacao','dadosIniciativaRevisao', 'dadosIndicadorIniciativaRevisao', 'dadosMetaIniciativaRevisao'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $revisaoCadastrada = RlcSituacaoRevisaoIniciativas::where('revisao_iniciativa_id', $id)->orderBy('created_at', 'desc')->first();

        if($revisaoCadastrada && ($revisaoCadastrada->situacao_revisao_id == 3 || $revisaoCadastrada->situacao_revisao_id == 5 || $revisaoCadastrada->situacao_revisao_id == 6 )) {

            flash()->erro("Erro", "Não foi possível atualizar a revisao.");
            return Redirect::route("plancidades.revisao.iniciativa.listarRevisoes", ['iniciativaId'=> $revisaoCadastrada->iniciativa_id]);
        }
        else{

            $dadosIniciativa = ViewIndicadoresIniciativasRevisao::where('iniciativa_id', $revisaoCadastrada->iniciativa_id)->first();

            switch ($dadosIniciativa->unidade_medida_id){
                case 1:
                    $dadosIniciativa->unidade_medida_simbolo = '(R$)';
                    break;
                case 2:
                    $dadosIniciativa->unidade_medida_simbolo = '(%)';
                    break;
                case 3:
                    $dadosIniciativa->unidade_medida_simbolo = '(ADI)';
                    break;
                case 4:
                    $dadosIniciativa->unidade_medida_simbolo = '(m²)';
                    break;
                case 5:
                    $dadosIniciativa->unidade_medida_simbolo = '(UN)';
                    break;
                default:
                    $dadosIniciativa->unidade_medida_simbolo = '';
            }
            
            $dadosIniciativaRevisao = IniciativasRevisao::where('revisao_iniciativa_id', $id)->orderBy('created_at', 'desc')->first();
            
            $dadosIndicadorIniciativaRevisao = IndicadoresIniciativasRevisao::where('revisao_iniciativa_id', $id)->orderBy('created_at', 'desc')->first();
            
            $dadosMetaIniciativaRevisao = MetasIniciativasRevisao::where('revisao_iniciativa_id', $id)->orderBy('created_at', 'desc')->first();

            $dadosRegionalizacao = RegionalizacaoMetaIniciativaRevisao::where('meta_objetivos_estrategicos_id', $dadosIniciativa->meta_iniciativa_id)->get();

            return view('modulo_plancidades.revisao.iniciativa.editar_revisao_iniciativa', compact('dadosIniciativa', 'dadosRegionalizacao','revisaoCadastrada', 'dadosIniciativaRevisao', 'dadosIndicadorIniciativaRevisao', 'dadosMetaIniciativaRevisao'));
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

        $dados_revisao_iniciativa = IniciativasRevisao::where('revisao_iniciativa_id', $id)->first();

        $dados_revisao_iniciativa->user_id = $user->id;
        $dados_revisao_iniciativa->revisao_iniciativa_id = $request->revisao_iniciativa_id;
        $dados_revisao_iniciativa->txt_enunciado_iniciativa = $request->txt_enunciado_iniciativa_nova;
        $dados_revisao_iniciativa->dsc_iniciativa = $request->dsc_iniciativa_nova;
        $dados_revisao_iniciativa->objetivo_estrategico_pei_id = $request->objetivo_estrategico_pei_id;
        $dados_revisao_iniciativa->bln_pac = $request->bln_pac_nova;
        $dados_revisao_iniciativa->updated_at = date('Y-m-d H:i:s');
        $dados_salvos = $dados_revisao_iniciativa->update();
        
        $dados_revisao_indicador_iniciativa = IndicadoresIniciativasRevisao::where('revisao_iniciativa_id', $id)->first();

        $dados_revisao_indicador_iniciativa->user_id = $user->id;
        $dados_revisao_indicador_iniciativa->txt_denominacao_indicador = $request->txt_denominacao_indicador_nova;
        $dados_revisao_indicador_iniciativa->txt_sigla_indicador = $request->txt_sigla_indicador_nova;
        $dados_revisao_indicador_iniciativa->vlr_indice_referencia = $request->vlr_indice_referencia_nova;
        $dados_revisao_indicador_iniciativa->dte_apuracao = $request->dte_apuracao_nova;
        $dados_revisao_indicador_iniciativa->unidade_medida_id = $request->unidade_medida_id_nova;
        $dados_revisao_indicador_iniciativa->dsc_indicador = $request->dsc_indicador_nova;
        $dados_revisao_indicador_iniciativa->txt_periodo_ou_data = $request->txt_periodo_ou_data_nova;
        $dados_revisao_indicador_iniciativa->txt_data_divulgacao_ou_disponibilizacao = $request->txt_data_divulgacao_ou_disponibilizacao_nova;
        $dados_revisao_indicador_iniciativa->periodicidade_id = $request->periodicidade_id_nova;
        $dados_revisao_indicador_iniciativa->polaridade_id = $request->polaridade_id_nova;
        $dados_revisao_indicador_iniciativa->txt_formula_calculo = $request->txt_formula_calculo_nova;
        $dados_revisao_indicador_iniciativa->txt_variaveis_calculo = $request->txt_variaveis_calculo_nova;
        $dados_revisao_indicador_iniciativa->txt_fonte_dados_variaveis_calculo = $request->txt_fonte_dados_variaveis_calculo_nova;
        $dados_revisao_indicador_iniciativa->txt_forma_disponibilizacao = $request->txt_forma_disponibilizacao_nova;
        $dados_revisao_indicador_iniciativa->dsc_procedimento_calculo = $request->dsc_procedimento_calculo_nova;
        $dados_revisao_indicador_iniciativa->updated_at = date('Y-m-d H:i:s');
        $dados_revisao_indicador_iniciativa->update();

        $dados_revisao_meta_iniciativa = MetasIniciativasRevisao::where('revisao_iniciativa_id', $id)->first();

        $dados_revisao_meta_iniciativa->meta_iniciativa_id = $request->meta_iniciativa_id;
        $dados_revisao_meta_iniciativa->revisao_iniciativa_id = $request->revisao_iniciativa_id;
        $dados_revisao_meta_iniciativa->txt_dsc_meta = $request->txt_dsc_meta_nova;
        $dados_revisao_meta_iniciativa->bln_meta_cumulativa = $request->bln_meta_cumulativa_nova;
        $dados_revisao_meta_iniciativa->vlr_esperado_ano_2 = $request->vlr_esperado_ano_2_nova;
        $dados_revisao_meta_iniciativa->vlr_esperado_ano_3 = $request->vlr_esperado_ano_3_nova;
        $dados_revisao_meta_iniciativa->vlr_esperado_ano_4 = $request->vlr_esperado_ano_4_nova;
        $dados_revisao_meta_iniciativa->bln_meta_regionalizada = $request->bln_meta_regionalizada_nova;
        $dados_revisao_meta_iniciativa->dsc_justificativa_ausencia_regionalizacao = $request->dsc_justificativa_ausencia_regionalizacao_nova;
        $dados_revisao_meta_iniciativa->updated_at = date('Y-m-d H:i:s');
        $dados_revisao_meta_iniciativa->user_id = $user->id;

        $dados_revisao_meta_iniciativa->update();
        
        $checa_situacao_revisao = RlcSituacaoRevisaoIniciativas::where('revisao_iniciativa_id', $id)->orderBy('created_at', 'desc')->first();

        if ($dados_salvos) {
                        
            if($request->botao_salvar){
                if(!$checa_situacao_revisao || $checa_situacao_revisao->situacao_revisao_id <> '2'){
                    $situacao_revisao_indicadores = new RlcSituacaoRevisaoIniciativas();
                    $situacao_revisao_indicadores->revisao_iniciativa_id = $id;
                    $situacao_revisao_indicadores->situacao_revisao_id = '2';
                    $situacao_revisao_indicadores->user_id = $user->id;
                    $situacao_revisao_indicadores->created_at = date('Y-m-d H:i:s');
                    $situacao_revisao_indicadores->iniciativa_id = $request->iniciativa_id;
                    $situacao_revisao_indicadores->save();
                }

                DB::commit();
                flash()->sucesso("Sucesso", "Revisão do Indicador atualizada com sucesso!");
                return Redirect::route("plancidades.revisao.iniciativa.editar", ['revisaoId'=> $id]);
            }
            else{
                if($request->botao_finalizar){
                $situacao_revisao_indicadores = new RlcSituacaoRevisaoIniciativas();
                $situacao_revisao_indicadores->revisao_iniciativa_id = $id;
                $situacao_revisao_indicadores->situacao_revisao_id = '3';
                $situacao_revisao_indicadores->user_id = $user->id;
                $situacao_revisao_indicadores->created_at = date('Y-m-d H:i:s');
                $situacao_revisao_indicadores->iniciativa_id = $request->iniciativa_id;
                $situacao_revisao_indicadores->save();  
                // LEMBRAR DE FAZER ESSA DISTINÇÃO DEPOIS, CONSIDERANDO TODOS OS CASOS
                DB::commit();
                flash()->sucesso("Sucesso", "Revisão do Indicador finalizada com sucesso!");
                return Redirect::route("plancidades.revisao.iniciativa.listarRevisoes", ['indicadorId'=> $request->iniciativa_id]);
                
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
    

    public function consultarIniciativas()
    {
        return view("modulo_plancidades.revisao.iniciativa.consultar_iniciativa");
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

        $revisoes = ViewRevisaoIniciativasObjEstrategicos::where($where)->orderBy('indicador_objetivo_estrategico_id')->paginate(10);

        if (count($revisoes) > 0) {
            return view("modulo_plancidades.revisao.objetivo_estrategico.listar_revisoes_indicador", compact('revisoes'));
        } else {
            flash()->erro("Erro", "Nenhum monitoramento encontrado...");
            return back();
        }
    }

}
