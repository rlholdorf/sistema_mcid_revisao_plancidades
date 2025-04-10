<?php

namespace App\Http\Controllers\Mod_plancidades;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mod_plancidades\IndicadoresIniciativasRevisao;
use App\Mod_plancidades\Iniciativas;
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


    public function create($revisaoId)
    {
        //Se a revisão da iniciativa já existe, redireciona para página de edição
        $iniciativaExiste = IniciativasRevisao::where('revisao_iniciativa_id', $revisaoId)->first();
        if (!empty($iniciativaExiste)) {
            session()->reflash();
            return Redirect::route("plancidades.revisao.iniciativa.editar", ['revisaoId'=> $revisaoId]);
        }

        $revisaoCadastrada = RlcSituacaoRevisaoIniciativas::where('revisao_iniciativa_id', $revisaoId)->first();
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

            $dadosIniciativa = ViewIndicadoresIniciativasRevisao::where('iniciativa_id', $dadosRevisao->iniciativa_id)->first();
            $dadosMetaRevisao = MetasIniciativasRevisao::where('revisao_iniciativa_id', $revisaoId)->first();
            return view('modulo_plancidades.revisao.iniciativa.criar_revisao_iniciativa', compact('dadosIniciativa','revisaoCadastrada', 'dadosRevisao', 'dadosMetaRevisao'));
        
        }
    }

    public function store(Request $request, $revisaoId)
    {
        //return $request;

        $user = Auth()->user();
        DB::beginTransaction();
        
        $iniciativaRevisaoExiste = IniciativasRevisao::where('revisao_iniciativa_id', $revisaoId)->first();

        if($iniciativaRevisaoExiste){
            return Redirect::route("plancidades.revisao.iniciativa.editar", ["revisaoId" => $revisaoId]);
        }

        $dados_revisao = RevisaoIniciativas::find($revisaoId);
        $dados_iniciativa = Iniciativas::find($dados_revisao->iniciativa_id);
        $dados_iniciativa_revisao = new IniciativasRevisao();

        
        $dados_iniciativa_revisao->revisao_iniciativa_id = $revisaoId;
        $dados_iniciativa_revisao->iniciativa_id = $dados_revisao->iniciativa_id;

        //No caso de os 3 seguintes campos não serem preenchidos, eles manterão o valor da iniciativa atual
        //=========================
        $dados_iniciativa_revisao->txt_enunciado_iniciativa = $request->txt_enunciado_iniciativa_nova;
        $dados_iniciativa_revisao->dsc_iniciativa = $request->dsc_iniciativa_nova;
        $dados_iniciativa_revisao->bln_pac = $dados_iniciativa_revisao->bln_pac;
        //=========================

        $dados_iniciativa_revisao->objetivo_estrategico_pei_id = '-';
        $dados_iniciativa_revisao->created_at = date('Y-m-d H:i:s');
        $dados_iniciativa_revisao->user_id = $user->id;
        $dados_salvos = $dados_iniciativa_revisao->save();


        
        $situacao_revisao_iniciativas = new RlcSituacaoRevisaoIniciativas();
        $situacao_revisao_iniciativas->revisao_iniciativa_id = $dados_revisao->id;
        $situacao_revisao_iniciativas->situacao_revisao_id = '2';
        $situacao_revisao_iniciativas->user_id = $user->id;
        $situacao_revisao_iniciativas->created_at = date('Y-m-d H:i:s');
        $situacao_revisao_iniciativas->iniciativa_id = $request->iniciativa;
        $situacao_revisao_iniciativas->save();
        
        if ($dados_salvos) {
            DB::commit();
            flash()->sucesso("Sucesso", "Revisão da Iniciativa cadastrada com sucesso!");
            return Redirect::route("plancidades.revisao.indicador.iniciativa.criar", ["revisaoId" => $revisaoId]);
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
    public function show($revisaoId)
    {
        
        $dadosRevisao = RevisaoIniciativas::find($revisaoId);
        $dadosRevisao->bln_iniciativa = IniciativasRevisao::where('revisao_iniciativa_id', $revisaoId)->first()?true:false;
        $dadosRevisao->bln_indicador = IndicadoresIniciativasRevisao::where('revisao_iniciativa_id', $revisaoId)->first()?true:false;
        $dadosRevisao->bln_metas = MetasIniciativasRevisao::where('revisao_iniciativa_id', $revisaoId)->first()?true:false;
        $dadosRevisao->bln_regionalizacao = RegionalizacaoMetaIniciativaRevisao::where('revisao_iniciativa_id', $revisaoId)->first()?true:false;

        $dadosIniciativa = Iniciativas::find($dadosRevisao->iniciativa_id);
        $dadosIniciativaRevisao = IniciativasRevisao::where('revisao_iniciativa_id', $revisaoId)->first();
        $dadosIndicadorIniciativaRevisao = IndicadoresIniciativasRevisao::where('revisao_iniciativa_id', $revisaoId)->first();
        $dadosMetaRevisao = MetasIniciativasRevisao::where('revisao_iniciativa_id', $revisaoId)->first();
        $dadosRegionalizacaoRevisao = RegionalizacaoMetaIniciativaRevisao::where('revisao_iniciativa_id', $revisaoId)->get();

        return view('modulo_plancidades.revisao.iniciativa.show_revisao_iniciativa', compact('dadosIniciativa', 'dadosRevisao', 'dadosIniciativaRevisao', 'dadosIndicadorIniciativaRevisao', 'dadosMetaRevisao', 'dadosRegionalizacaoRevisao'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($revisaoId)
    {
        $revisaoCadastrada = RlcSituacaoRevisaoIniciativas::where('revisao_iniciativa_id', $revisaoId)->first();
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
            $dadosIniciativaRevisao = IniciativasRevisao::where('revisao_iniciativa_id', $revisaoId)->first();
            $dadosMetaRevisao = MetasIniciativasRevisao::where('revisao_iniciativa_id', $revisaoId)->first();

            if($dadosIniciativaRevisao){
                $dadosIniciativa = ViewIndicadoresIniciativasRevisao::where('iniciativa_id', $dadosIniciativaRevisao->iniciativa_id)->first();
                return view('modulo_plancidades.revisao.iniciativa.editar_revisao_iniciativa', compact('dadosIniciativa', 'dadosRevisao','revisaoCadastrada', 'dadosIniciativaRevisao', 'dadosMetaRevisao'));
            }else{
                return Redirect::route('plancidades.revisao.iniciativa.criar', ["revisaoId" => $revisaoId]);
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
        //return ($request);
        //return ($revisaoId);

        $user = Auth()->user();
        DB::beginTransaction();

        $dados_revisao = RevisaoIniciativas::find($revisaoId);
        $dados_iniciativa = Iniciativas::find($dados_revisao->iniciativa_id);
        $dados_iniciativa_revisao = IniciativasRevisao::where('revisao_iniciativa_id', $revisaoId)->first();

        $dados_iniciativa_revisao->user_id = $user->id;
        $dados_iniciativa_revisao->revisao_iniciativa_id = $request->revisao_iniciativa_id;

        //No caso de esses campos não serem preenchidos, eles manterão o valor da iniciativa atual
        //=============
        $dados_iniciativa_revisao->txt_enunciado_iniciativa = $request->txt_enunciado_iniciativa_nova;
        $dados_iniciativa_revisao->dsc_iniciativa = $request->dsc_iniciativa_nova;
        $dados_iniciativa_revisao->bln_pac = $request->bln_pac_nova;
        //=============

        $dados_iniciativa_revisao->objetivo_estrategico_pei_id = $request->objetivo_estrategico_pei_id;
        $dados_iniciativa_revisao->updated_at = date('Y-m-d H:i:s');
        $dados_salvos = $dados_iniciativa_revisao->update();
        
        
        //Não há necessidade de tabela de relação entre Revisão e Situação. A situação da revisão pode ser salva diretamente na tab da revisão
        if ($dados_salvos) {
            $situacao_revisao_indicadores = new RlcSituacaoRevisaoIniciativas();
            $situacao_revisao_indicadores->revisao_iniciativa_id = $revisaoId;
            $situacao_revisao_indicadores->user_id = $user->id;
            $situacao_revisao_indicadores->situacao_revisao_id = '2';
            $situacao_revisao_indicadores->created_at = date('Y-m-d H:i:s');
            $situacao_revisao_indicadores->iniciativa_id = $request->iniciativa_id;
            $situacao_revisao_indicadores->save();
        

            DB::commit();
            flash()->sucesso("Sucesso", "Revisão da iniciativa atualizada com sucesso!");
            return Redirect::route("plancidades.revisao.indicador.iniciativa.criar", ['revisaoId'=> $revisaoId]);
        
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function iniciarRevisao($iniciativaId)
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


    public function salvarRevisao(Request $request)
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
        
        if ($dados_salvos) {
            DB::commit();

            flash()->sucesso("Sucesso", "Revisão da Iniciativa cadastrada com sucesso!");
            return Redirect::route("plancidades.revisao.iniciativa.criar", ["revisaoId" => $dados_revisao->id]);
        } else {
            DB::rollBack();
            flash()->erro("Erro", "Não foi possível cadastrar a revisão.");
            return back();
        }
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
