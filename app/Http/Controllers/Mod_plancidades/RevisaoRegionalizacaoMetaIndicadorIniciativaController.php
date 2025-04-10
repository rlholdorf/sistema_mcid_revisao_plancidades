<?php

namespace App\Http\Controllers\Mod_plancidades;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mod_plancidades\IndicadoresIniciativasRevisao;
use App\Mod_plancidades\IniciativasRevisao;
use App\Mod_plancidades\MetasIniciativas;
use App\Mod_plancidades\MetasIniciativasRevisao;
use App\Mod_plancidades\RegionalizacaoMetaIniciativa;
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
use Exception;
use Illuminate\Support\Facades\DB;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegrationAssertPostConditionsForV7AndPrevious;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Support\Facades\Redirect;

class RevisaoRegionalizacaoMetaIndicadorIniciativaController extends Controller
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
        $regionalizacaoRevisaoExiste = RegionalizacaoMetaIniciativaRevisao::where('revisao_iniciativa_id', $revisaoId)->first();
        if(!empty($regionalizacaoRevisaoExiste)){
            return Redirect::route("plancidades.revisao.regionalizacao.iniciativa.editar", ["revisaoId" => $revisaoId]);
        }

        $revisaoCadastrada = RlcSituacaoRevisaoIniciativas::where('revisao_iniciativa_id', $revisaoId)->orderBy('created_at', 'desc')->first();

        $dadosRevisao = RevisaoIniciativas::find($revisaoId);
        $dadosRevisao->bln_iniciativa = IniciativasRevisao::where('revisao_iniciativa_id', $revisaoId)->first()?true:false;
        $dadosRevisao->bln_indicador = IndicadoresIniciativasRevisao::where('revisao_iniciativa_id', $revisaoId)->first()?true:false;
        $dadosRevisao->bln_metas = MetasIniciativasRevisao::where('revisao_iniciativa_id', $revisaoId)->first()?true:false;
        $dadosRevisao->bln_regionalizacao = RegionalizacaoMetaIniciativaRevisao::where('revisao_iniciativa_id', $revisaoId)->first()?true:false;

        $dadosIniciativa = ViewIndicadoresIniciativas::where('iniciativa_id' , $dadosRevisao->iniciativa_id)->first();
        $dadosMeta = MetasIniciativas::where('iniciativa_id', $dadosRevisao->iniciativa_id)->first();
        $dadosMetaRevisao = MetasIniciativasRevisao::where('revisao_iniciativa_id', $revisaoId)->first();
        $dadosRegionalizacao = RegionalizacaoMetaIniciativa::where('meta_iniciativa_id', $dadosMeta->id)->leftJoin('mcid_hom_plancidades.tab_metas_iniciativas', 'tab_metas_iniciativas.id','=','tab_regionalizacao_metas_iniciativas.meta_iniciativa_id')->get();
        
        return view('modulo_plancidades.revisao.iniciativa.regionalizacao.criar_revisao_regionalizacao_meta_indicador_iniciativa', compact('dadosIniciativa', 'dadosMetaRevisao', 'revisaoCadastrada', 'dadosRevisao', 'dadosRegionalizacao'));
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

        $user = Auth()->user();
        DB::beginTransaction();

        try{
            $dados_revisao = RevisaoIniciativas::find($revisaoId);

            foreach ($request->novaRegionalizacao as $item) {
                $regionalizacao = (object) $item;
                
                $regionalizacaoExiste = RegionalizacaoMetaIniciativaRevisao::where('regionalizacao_id', $regionalizacao->regionalizacao_id)->first();
                if($regionalizacaoExiste){
                   throw new \Exception("Regionalização já cadastrada.");
                }

                $dados_regionalizacao_revisao = new RegionalizacaoMetaIniciativaRevisao();
                $dados_regionalizacao = RegionalizacaoMetaIniciativa::where('regionalizacao_id', $regionalizacao->regionalizacao_id)->first();
                
                
                $dados_regionalizacao_revisao->txt_sigla_iniciativas_metas_region = $dados_regionalizacao->txt_sigla_iniciativas_metas_region;
                $dados_regionalizacao_revisao->meta_iniciativa_id = $dados_regionalizacao->meta_iniciativa_id;
                $dados_regionalizacao_revisao->regionalizacao_id = $regionalizacao->regionalizacao_id;
                $dados_regionalizacao_revisao->vlr_esperado_ano_2 = $regionalizacao->vlr_esperado_ano_2;
                $dados_regionalizacao_revisao->vlr_esperado_ano_3 = $regionalizacao->vlr_esperado_ano_3;
                $dados_regionalizacao_revisao->vlr_esperado_ano_4 = $regionalizacao->vlr_esperado_ano_4;
                $dados_regionalizacao_revisao->revisao_iniciativa_id = $revisaoId;
                $dados_regionalizacao_revisao->created_at = date('Y-m-d H:i:s');
                $dados_regionalizacao_revisao->user_id = $user->id;

                $dados_salvos = $dados_regionalizacao_revisao->save();
                
                if(!$dados_salvos){
                    throw new \Exception('Erro ao salvar a regionalização.');
                }
            }

            DB::commit();
            flash()->sucesso("Sucesso", "Revisão das regionalizações cadastrada com sucesso!");
            return Redirect::route("plancidades.revisao.regionalizacao.iniciativa.editar", ["revisaoId" => $dados_revisao->id]);

        } catch (\Exception $e){
            DB::rollBack();
            flash()->erro("Erro", $e->getMessage());
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

        $dadosIniciativa = ViewIndicadoresIniciativas::where('iniciativa_id' , $dadosRevisao->iniciativa_id)->first();
        $dadosIndicadorRevisao = IndicadoresIniciativasRevisao::where('revisao_iniciativa_id' , $revisaoId)->first();
        $dadosMeta = MetasIniciativas::where('iniciativa_id', $dadosRevisao->iniciativa_id)->first();
        $dadosMetaRevisao = MetasIniciativasRevisao::where('revisao_iniciativa_id', $revisaoId)->first();
        $dadosRegionalizacao = RegionalizacaoMetaIniciativa::where('meta_iniciativa_id', $dadosMeta->id)->leftJoin('mcid_hom_plancidades.tab_metas_iniciativas', 'tab_metas_iniciativas.id','=','tab_regionalizacao_metas_iniciativas.meta_iniciativa_id')->get();
        $dadosRegionalizacaoRevisao = RegionalizacaoMetaIniciativaRevisao::where('revisao_iniciativa_id', $revisaoId)->get();

        
        return view('modulo_plancidades.revisao.iniciativa.regionalizacao.editar_revisao_regionalizacao_meta_indicador_iniciativa', compact('dadosIniciativa', 'dadosIndicadorRevisao', 'dadosMetaRevisao', 'revisaoCadastrada', 'dadosRevisao', 'dadosRegionalizacao', 'dadosRegionalizacaoRevisao'));
    
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

        $user = Auth()->user();
        DB::beginTransaction();

        try{
            $dados_revisao = RevisaoIniciativas::find($revisaoId);

            foreach ($request->novaRegionalizacao as $item) {
                $regionalizacao = (object) $item;

                $dados_regionalizacao_revisao = RegionalizacaoMetaIniciativaRevisao::where('regionalizacao_id', $regionalizacao->regionalizacao_id)->first();
                $dados_regionalizacao = RegionalizacaoMetaIniciativa::where('regionalizacao_id', $regionalizacao->regionalizacao_id)->first();
                
                
                $dados_regionalizacao_revisao->txt_sigla_iniciativas_metas_region = $dados_regionalizacao->txt_sigla_iniciativas_metas_region;
                $dados_regionalizacao_revisao->meta_iniciativa_id = $dados_regionalizacao->meta_iniciativa_id;
                $dados_regionalizacao_revisao->regionalizacao_id = $regionalizacao->regionalizacao_id;
                $dados_regionalizacao_revisao->vlr_esperado_ano_2 = $regionalizacao->vlr_esperado_ano_2;
                $dados_regionalizacao_revisao->vlr_esperado_ano_3 = $regionalizacao->vlr_esperado_ano_3;
                $dados_regionalizacao_revisao->vlr_esperado_ano_4 = $regionalizacao->vlr_esperado_ano_4;
                $dados_regionalizacao_revisao->revisao_iniciativa_id = $revisaoId;
                $dados_regionalizacao_revisao->updated_at = date('Y-m-d H:i:s');
                $dados_regionalizacao_revisao->user_id = $user->id;

                $dados_salvos = $dados_regionalizacao_revisao->update();
                
                if(!$dados_salvos){
                    throw new \Exception('Erro ao atualizar a regionalização ' . $dados_regionalizacao->txt_sigla_iniciativas_metas_region);
                }
            }

            DB::commit();
            flash()->sucesso("Sucesso", "Revisão das regionalizações atualizada com sucesso!");
            return Redirect::route("plancidades.revisao.regionalizacao.iniciativa.editar", ["revisaoId" => $dados_revisao->id]);

        } catch (\Exception $e){
            DB::rollBack();
            flash()->erro("Erro", $e->getMessage());
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
