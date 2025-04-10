<?php

namespace App\Http\Controllers\Mod_plancidades;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mod_plancidades\IndicadoresIniciativasRevisao;
use App\Mod_plancidades\Iniciativas;
use App\Mod_plancidades\IniciativasRevisao;
use App\Mod_plancidades\MetasIniciativas;
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

class RevisaoMetaIndicadorIniciativaController extends Controller
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
    public function create($revisaoId)
    {   
        //Se a revisão da iniciativa já existe, redireciona para página de edição
        $metaRevisaoExiste = MetasIniciativasRevisao::where('revisao_iniciativa_id', $revisaoId)->first();
        if (!empty($metaRevisaoExiste)) {
            session()->reflash(); //mantêm a mensagem em caso de redirect
            return Redirect::route("plancidades.revisao.meta.iniciativa.editar", ['revisaoId'=> $revisaoId]);
        }

        $revisaoCadastrada = RlcSituacaoRevisaoIniciativas::where('revisao_iniciativa_id', $revisaoId)->orderBy('created_at', 'desc')->first();
        $situacoes_nao_editaveis = array(3,5,6);


        if (in_array($revisaoCadastrada->situacao_revisao_id, $situacoes_nao_editaveis)) {
            flash()->erro("Erro", "Não foi possível atualizar a revisao.");
            return Redirect::route("plancidades.revisao.iniciativa.listarRevisoes", ['iniciativaId'=> $revisaoCadastrada->iniciativa_id]);
        }
        else{
            $dadosRevisao = RevisaoIniciativas::find($revisaoId);
            $dadosRevisao->bln_iniciativa = IniciativasRevisao::where('revisao_iniciativa_id', $revisaoId)->first()?true:false;
            $dadosRevisao->bln_indicador = IndicadoresIniciativasRevisao::where('revisao_iniciativa_id', $revisaoId)->first()?true:false;
            $dadosRevisao->bln_metas = MetasIniciativasRevisao::where('revisao_iniciativa_id', $revisaoId)->first()?true:false;
            $dadosRevisao->bln_regionalizacao = RegionalizacaoMetaIniciativaRevisao::where('revisao_iniciativa_id', $revisaoId)->first()?true:false;
            //return $dadosRevisao;

            $dadosMeta = MetasIniciativas::where('iniciativa_id' , $dadosRevisao->iniciativa_id)->first();
            $dadosIniciativa = Iniciativas::find($dadosRevisao->iniciativa_id);
            $dadosMetaRevisao = MetasIniciativasRevisao::where('revisao_iniciativa_id', $revisaoId)->first();

            return view('modulo_plancidades.revisao.iniciativa.metas.criar_revisao_meta_iniciativa', compact('dadosMeta', 'dadosIniciativa','revisaoCadastrada', 'dadosRevisao', 'dadosMetaRevisao'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $revisaoId)
    {
        //return $request;
        // return $revisaoId;

        $user = Auth()->user();
        DB::beginTransaction();

        $metaRevisaoExiste = MetasIniciativasRevisao::where('revisao_iniciativa_id', $revisaoId)->first();
        if($metaRevisaoExiste){
            return Redirect::route('plancidades.revisao.meta.iniciativa.editar', ["revisaoId" => $revisaoId]);
        }

        $dados_revisao = RevisaoIniciativas::find($revisaoId);
        $dados_meta = MetasIniciativas::where('iniciativa_id', $dados_revisao->iniciativa_id)->first();
        $dados_meta_revisao = new MetasIniciativasRevisao();

        $dados_meta_revisao->user_id = $user->id;
        $dados_meta_revisao->revisao_iniciativa_id = $revisaoId;
        $dados_meta_revisao->iniciativa_id = $dados_revisao->iniciativa_id;
        $dados_meta_revisao->meta_iniciativa_id = $dados_meta->id;
        $dados_meta_revisao->txt_dsc_meta = $request->txt_dsc_meta_nova;
        $dados_meta_revisao->bln_meta_cumulativa = $request->bln_meta_cumulativa_nova;
        $dados_meta_revisao->vlr_esperado_ano_2 = $request->vlr_esperado_ano_2_nova;
        $dados_meta_revisao->vlr_esperado_ano_3 = $request->vlr_esperado_ano_3_nova;
        $dados_meta_revisao->vlr_esperado_ano_4 = $request->vlr_esperado_ano_4_nova;
        $dados_meta_revisao->bln_meta_regionalizada = $request->bln_meta_regionalizada_nova;
        $dados_meta_revisao->dsc_justificativa_ausencia_regionalizacao = $request->dsc_justificativa_ausencia_regionalizacao_nova;
        $dados_meta_revisao->created_at = date('Y-m-d H:i:s');


        $dados_salvos = $dados_meta_revisao->save();

        if ($dados_salvos) {
            DB::commit();
            flash()->sucesso("Sucesso", "Revisão da meta da Iniciativa cadastrada com sucesso!");
            if($dados_meta_revisao->bln_meta_regionalizada){
                return Redirect::route("plancidades.revisao.regionalizacao.iniciativa.criar", ["revisaoId" => $revisaoId]);
            }
            else{
                return Redirect::route("plancidades.revisao.meta.iniciativa.editar", ["revisaoId" => $revisaoId]);
            }
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

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($revisaoId)
    {
        $revisaoCadastrada = RlcSituacaoRevisaoIniciativas::where('revisao_iniciativa_id', $revisaoId)->orderBy('created_at', 'desc')->first();
        $dadosRevisao = RevisaoIniciativas::find($revisaoId);
        $dadosRevisao->bln_iniciativa = IniciativasRevisao::where('revisao_iniciativa_id', $revisaoId)->first()?true:false;
        $dadosRevisao->bln_indicador = IndicadoresIniciativasRevisao::where('revisao_iniciativa_id', $revisaoId)->first()?true:false;
        $dadosRevisao->bln_metas = MetasIniciativasRevisao::where('revisao_iniciativa_id', $revisaoId)->first()?true:false;
        $dadosRevisao->bln_regionalizacao = RegionalizacaoMetaIniciativaRevisao::where('revisao_iniciativa_id', $revisaoId)->first()?true:false;

        if($revisaoCadastrada && ($revisaoCadastrada->situacao_revisao_id == 3 || $revisaoCadastrada->situacao_revisao_id == 5 || $revisaoCadastrada->situacao_revisao_id == 6 )) {
            
            flash()->erro("Erro", "Não foi possível atualizar a revisao.");
            return Redirect::route("plancidades.revisao.iniciativa.listarRevisoes", ['iniciativaId'=> $revisaoCadastrada->iniciativa_id]);
        }
        else{
            $dadosIniciativa = ViewIndicadoresIniciativasRevisao::where('iniciativa_id', $dadosRevisao->iniciativa_id)->first();
            $dadosIndicadorIniciativaRevisao = IndicadoresIniciativasRevisao::where('revisao_iniciativa_id', $revisaoId)->first();

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

            switch ($dadosIndicadorIniciativaRevisao->unidade_medida_id){
                case 1:
                    $dadosIndicadorIniciativaRevisao->unidade_medida_simbolo = '(R$)';
                    break;
                case 2:
                    $dadosIndicadorIniciativaRevisao->unidade_medida_simbolo = '(%)';
                    break;
                case 3:
                    $dadosIndicadorIniciativaRevisao->unidade_medida_simbolo = '(ADI)';
                    break;
                case 4:
                    $dadosIndicadorIniciativaRevisao->unidade_medida_simbolo = '(m²)';
                    break;
                case 5:
                    $dadosIndicadorIniciativaRevisao->unidade_medida_simbolo = '(UN)';
                    break;
                default:
                    $dadosIndicadorIniciativaRevisao->unidade_medida_simbolo = '';
            }
            
            
            
            $dadosMeta = MetasIniciativas::where('iniciativa_id', $dadosRevisao->iniciativa_id)->first();
            $dadosIniciativaRevisao = IniciativasRevisao::where('revisao_iniciativa_id', $revisaoId)->first();
            $dadosMetaRevisao = MetasIniciativasRevisao::where('revisao_iniciativa_id', $revisaoId)->first();

            if($dadosMetaRevisao){
                return view('modulo_plancidades.revisao.iniciativa.metas.editar_revisao_meta_iniciativa', compact('dadosRevisao', 'dadosIniciativa', 'dadosIniciativaRevisao', 'dadosIndicadorIniciativaRevisao', 'dadosMeta', 'dadosMetaRevisao', 'revisaoCadastrada'));
            }else{
                return Redirect::route('plancidades.revisao.meta.iniciativa.criar', ["revisaoId" => $revisaoId]);
            }
        }
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $revisaoId)
    {
        //return $request;
        // return $revisaoId;

        $user = Auth()->user();
        DB::beginTransaction();

        $dados_revisao = RevisaoIniciativas::find($revisaoId);
        $dados_meta = MetasIniciativas::where('iniciativa_id', $dados_revisao->iniciativa_id)->first();
        $dados_meta_revisao = new MetasIniciativasRevisao();

        $dados_meta_revisao->user_id = $user->id;
        $dados_meta_revisao->revisao_iniciativa_id = $revisaoId;
        $dados_meta_revisao->iniciativa_id = $dados_revisao->iniciativa_id;
        $dados_meta_revisao->meta_iniciativa_id = $dados_meta->id;
        $dados_meta_revisao->txt_dsc_meta = $request->txt_dsc_meta_nova;
        $dados_meta_revisao->bln_meta_cumulativa = $request->bln_meta_cumulativa_nova;
        $dados_meta_revisao->vlr_esperado_ano_2 = $request->vlr_esperado_ano_2_nova;
        $dados_meta_revisao->vlr_esperado_ano_3 = $request->vlr_esperado_ano_3_nova;
        $dados_meta_revisao->vlr_esperado_ano_4 = $request->vlr_esperado_ano_4_nova;
        $dados_meta_revisao->bln_meta_regionalizada = $request->bln_meta_regionalizada_nova;
        $dados_meta_revisao->dsc_justificativa_ausencia_regionalizacao = $request->dsc_justificativa_ausencia_regionalizacao_nova;
        $dados_meta_revisao->updated_at = date('Y-m-d H:i:s');


        $dados_salvos = $dados_meta_revisao->update();

        if ($dados_salvos) {
            DB::commit();
            flash()->sucesso("Sucesso", "Revisão da meta da Iniciativa atualizada com sucesso!");
            if($dados_meta_revisao->bln_meta_regionalizada == 'true'){
                return Redirect::route("plancidades.revisao.regionalizacao.iniciativa.criar", ["revisaoId" => $revisaoId]);
            }
            else{
                return Redirect::route("plancidades.revisao.meta.iniciativa.editar", ["revisaoId" => $revisaoId]);
            }
        } else {
            DB::rollBack();
            flash()->erro("Erro", "Não foi possível cadastrar a revisão.");
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
