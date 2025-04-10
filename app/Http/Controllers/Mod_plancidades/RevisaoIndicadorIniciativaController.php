<?php

namespace App\Http\Controllers\Mod_plancidades;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mod_plancidades\IndicadoresIniciativa;
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

class RevisaoIndicadorIniciativaController extends Controller
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
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($revisaoId)
    {
        //Se a revisão da iniciativa já existe, redireciona para página de edição
        $indicadorExiste = IndicadoresIniciativasRevisao::where('revisao_iniciativa_id', $revisaoId)->first();
        if (!empty($indicadorExiste)) {
            session()->reflash();
            return Redirect::route("plancidades.revisao.indicador.iniciativa.editar", ['revisaoId'=> $revisaoId]);
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
            //return $dadosRevisao;

            $dadosIniciativa = ViewIndicadoresIniciativasRevisao::where('iniciativa_id', $dadosRevisao->iniciativa_id)->first();
            $dadosMetaRevisao = MetasIniciativasRevisao::where('revisao_iniciativa_id', $revisaoId)->first();
            return view('modulo_plancidades.revisao.iniciativa.indicador.criar_revisao_indicador_iniciativa', compact('dadosIniciativa','revisaoCadastrada', 'dadosRevisao', 'dadosMetaRevisao'));
        
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
        //return $revisaoId;

        $user = Auth()->user();
        DB::beginTransaction();

        $indicadorRevisaoExiste = IndicadoresIniciativasRevisao::where('revisao_iniciativa_id', $revisaoId)->first();

        if($indicadorRevisaoExiste){
            return Redirect::route("plancidades.revisao.iniciativa.indicador.editar", ["revisaoId" => $revisaoId]);
        }

        $dados_revisao = RevisaoIniciativas::find($revisaoId);
        $dados_indicador = IndicadoresIniciativa::where('iniciativa_id', $dados_revisao->iniciativa_id)->first();
        $dados_revisao_indicador_iniciativa = new IndicadoresIniciativasRevisao();

        $dados_revisao_indicador_iniciativa->user_id = $user->id;
        $dados_revisao_indicador_iniciativa->revisao_iniciativa_id = $revisaoId;
        $dados_revisao_indicador_iniciativa->iniciativa_id = $dados_revisao->iniciativa_id;

        $dados_revisao_indicador_iniciativa->txt_denominacao_indicador = $request->txt_denominacao_indicador_nova;
        $dados_revisao_indicador_iniciativa->txt_sigla_indicador = $request->txt_sigla_indicador_nova;
        $dados_revisao_indicador_iniciativa->vlr_indice_referencia = $request->vlr_indice_referencia_nova;
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

        $dados_revisao_indicador_iniciativa->created_at = date('Y-m-d H:i:s');
        $dados_revisao_indicador_iniciativa->indicador_iniciativa_id = $dados_indicador->id;

        $dados_salvos = $dados_revisao_indicador_iniciativa->save();

        if ($dados_salvos) {
            DB::commit();
            flash()->sucesso("Sucesso", "Revisão do Indicador da Iniciativa cadastrada com sucesso!");
            return Redirect::route("plancidades.revisao.meta.iniciativa.criar", ["revisaoId" => $revisaoId]);
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
            
            $dadosIniciativaRevisao = IniciativasRevisao::where('revisao_iniciativa_id', $revisaoId)->orderBy('created_at', 'desc')->first();
            $dadosIndicadorIniciativaRevisao = IndicadoresIniciativasRevisao::where('revisao_iniciativa_id', $revisaoId)->first();
            $dadosMetaRevisao = MetasIniciativasRevisao::where('revisao_iniciativa_id', $revisaoId)->first();
            

            if($dadosIndicadorIniciativaRevisao){
                return view('modulo_plancidades.revisao.iniciativa.indicador.editar_revisao_indicador_iniciativa', compact('dadosIniciativa', 'dadosRevisao','revisaoCadastrada', 'dadosIndicadorIniciativaRevisao', 'dadosMetaRevisao'));
            }else{
                return Redirect::route('plancidades.revisao.indicador.iniciativa.criar', ["revisaoId" => $revisaoId]);
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
        $dados_revisao_indicador_iniciativa = IndicadoresIniciativasRevisao::where('revisao_iniciativa_id', $revisaoId)->first();
        

        $dados_revisao_indicador_iniciativa->user_id = $user->id;

        $dados_revisao_indicador_iniciativa->txt_denominacao_indicador = $request->txt_denominacao_indicador_nova;
        $dados_revisao_indicador_iniciativa->txt_sigla_indicador = $request->txt_sigla_indicador_nova;
        $dados_revisao_indicador_iniciativa->vlr_indice_referencia = $request->vlr_indice_referencia_nova;
        $dados_revisao_indicador_iniciativa->unidade_medida_id = $request->txt_unidade_medida_nova;
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

        $dados_revisao_indicador_iniciativa->dte_apuracao = $request->dte_apuracao_nova;
        $dados_revisao_indicador_iniciativa->updated_at = date('Y-m-d H:i:s');
        $dados_salvos = $dados_revisao_indicador_iniciativa->update();

        
        


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
            flash()->sucesso("Sucesso", "Revisão do Indicador atualizada com sucesso!");
            return Redirect::route("plancidades.revisao.meta.iniciativa.criar", ['revisaoId'=> $revisaoId]);
        
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

}
