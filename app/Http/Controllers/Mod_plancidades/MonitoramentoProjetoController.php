<?php

namespace App\Http\Controllers\Mod_plancidades;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mod_plancidades\EtapasProjeto;
use App\Mod_plancidades\MonitoramentoIndicadoresIniciativas;
use App\Mod_plancidades\MonitoramentoProjetos;
use App\Mod_plancidades\Projetos;
use App\Mod_plancidades\RlcMonitoramentoEtapasProjetos;
use App\Mod_plancidades\RlcSituacaoMonitoramentoProjetos;
use App\Mod_plancidades\SituacoesEtapasProjetos;
use App\Mod_plancidades\ViewMonitoramentoProjetos;
use App\Mod_plancidades\ViewProjetos;
use App\Mod_plancidades\ViewResumoApuracaoProjeto;
use App\Mod_plancidades\ViewValidacaoMonitoramentoProjetos;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class MonitoramentoProjetoController extends Controller
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
        return view('modulo_plancidades.cadastrar_monitoramento_iniciativa_projeto');
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
        $where[] = ['projeto_id', $request->projeto_id];
        $where[] = ['num_ano_periodo_monitoramento', $request->anoMonitoramento];
        $where[] = ['periodo_monitoramento_id', $request->periodoMonitoramento];


        $monitoramentoCadastrado = MonitoramentoProjetos::where($where)->first();

        if (!empty($monitoramentoCadastrado)) {
            DB::rollBack();
            flash()->erro("Erro", "Já existe um monitoramento para esse período.");
            return back();
        }

        $dados_monitoramento = new MonitoramentoProjetos;

        $dados_monitoramento->user_id = $user->id;
        $dados_monitoramento->projeto_id = $request->projeto_id;
        $dados_monitoramento->periodo_monitoramento_id = $request->periodoMonitoramento;
        $dados_monitoramento->num_ano_periodo_monitoramento = $request->anoMonitoramento;
        $dados_monitoramento->created_at = date('Y-m-d H:i:s');

        $dados_salvos = $dados_monitoramento->save();

        $etapasProjeto = EtapasProjeto::where('projeto_id', $request->projeto_id)->get();

        foreach ($etapasProjeto as $dados) {
            $etapas = new RlcMonitoramentoEtapasProjetos;
            $etapas->monitoramento_projeto_id = $dados_monitoramento->id;
            $etapas->etapa_projeto_id = $dados->id;
            $etapas->save();
        }

        $situacao_monitoramento_projetos = new RlcSituacaoMonitoramentoProjetos();
        $situacao_monitoramento_projetos->monitoramento_projeto_id = $dados_monitoramento->id;
        $situacao_monitoramento_projetos->situacao_monitoramento_id = '2';
        $situacao_monitoramento_projetos->user_id = $user->id;
        $situacao_monitoramento_projetos->created_at = date('Y-m-d H:i:s');
        $situacao_monitoramento_projetos->projeto_id = $request->projeto_id;
        $situacao_monitoramento_projetos->save();

        

        if ($dados_salvos) { // RLH: não deveria checar também se etapasProjeto está criado?
            DB::commit();

            flash()->sucesso("Sucesso", "Monitoramento cadastrado com sucesso!");
            return Redirect::route("plancidades.monitoramentos.projeto.editar", ["monitoramentoId" => $dados_monitoramento->id]);
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

        $dados_monitoramento = ViewMonitoramentoProjetos::find($id);
        $dados_projeto = ViewProjetos::where('projeto_id', $dados_monitoramento->projeto_id)->first();

        $etapasPreenchidas = RlcMonitoramentoEtapasProjetos::join('mcid_plancidades.tab_etapas_projetos', 'tab_etapas_projetos.id', '=', 'rlc_monitoramento_projetos_etapas.etapa_projeto_id')
            ->leftjoin('mcid_plancidades.opc_situacao_etapas_projetos as opc1', 'opc1.id', '=', 'rlc_monitoramento_projetos_etapas.situacao_etapa_projeto_id')
            ->leftjoin('mcid_plancidades.opc_situacao_etapas_projetos as opc2', 'opc2.id', '=', 'tab_etapas_projetos.situacao_etapa_projeto_id')
            ->select(
                'rlc_monitoramento_projetos_etapas.id',
                'monitoramento_projeto_id',
                'etapa_projeto_id',
                'tab_etapas_projetos.dsc_etapa',
                'tab_etapas_projetos.dsc_marco',
                'rlc_monitoramento_projetos_etapas.dte_efetiva_inicio_etapa',
                'rlc_monitoramento_projetos_etapas.dte_efetiva_conclusao_etapa',
                'rlc_monitoramento_projetos_etapas.situacao_etapa_projeto_id',
                'opc1.txt_nome_situacao as txt_situacao',
                'opc1.vlr_percentual_conclusao as vlr_percentual_conclusao',
                'created_at',
                'tab_etapas_projetos.vlr_peso_etapa',
                'tab_etapas_projetos.dte_previsao_inicio_etapa',
                'tab_etapas_projetos.dte_previsao_conclusao_etapa',
                'tab_etapas_projetos.dte_efetiva_inicio_etapa as dte_validada_inicio_etapa',
                'tab_etapas_projetos.dte_efetiva_conclusao_etapa as dte_validada_conclusao_etapa',
                'tab_etapas_projetos.situacao_etapa_projeto_id as situacao_validada_etapa_projeto_id',
                'opc2.txt_nome_situacao as txt_situacao_validada'
            )
            ->where('monitoramento_projeto_id', $dados_monitoramento->monitoramento_projeto_id)
            ->orderBy('etapa_projeto_id')->get();


            foreach($etapasPreenchidas as $etapa){
                if (in_array($etapa->situacao_etapa_projeto_id, [1, null])){
                        $percentual_etapa = $etapa->vlr_peso_etapa * 0;
                }else{
                    $percentual_etapa = $etapa->vlr_peso_etapa * $etapa->vlr_percentual_conclusao;
                } 
                $etapa->percentualEtapa = $percentual_etapa;
                $dados_projeto->percentualAtual += $percentual_etapa;
            }

        $situacaoEtapas = SituacoesEtapasProjetos::select('id', 'txt_nome_situacao as nome')->get();

        $etapas_projeto = EtapasProjeto::where('projeto_id', $dados_projeto->projeto_id)->get();

        $situacao_monitoramento = ViewValidacaoMonitoramentoProjetos::where('monitoramento_projeto_id', $id)->first();

        return view(
            'modulo_plancidades.projeto.show_monitoramento_projeto', 
            compact(
                'dados_monitoramento', 
                'dados_projeto', 
                'etapasPreenchidas', 
                'etapas_projeto', 
                'situacaoEtapas',
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
        $situacao_monitoramento = ViewValidacaoMonitoramentoProjetos::where('monitoramento_projeto_id', $id)->first();

        if($situacao_monitoramento && ($situacao_monitoramento->situacao_monitoramento_id == 3 || $situacao_monitoramento->situacao_monitoramento_id == 5 || $situacao_monitoramento->situacao_monitoramento_id == 6 )) {

            flash()->erro("Erro", "Não foi possível atualizar o monitoramento.");
            return Redirect::route("plancidades.monitoramentos.projeto.listarMonitoramentos", ['projetoId'=> $situacao_monitoramento->projeto_id]);
        }
        else{

            $dados_monitoramento = ViewMonitoramentoProjetos::find($id);
            $dados_projeto = ViewProjetos::where('projeto_id', $dados_monitoramento->projeto_id)->first();

            $etapasPreenchidas = RlcMonitoramentoEtapasProjetos::join('mcid_plancidades.tab_etapas_projetos', 'tab_etapas_projetos.id', '=', 'rlc_monitoramento_projetos_etapas.etapa_projeto_id')
            ->leftjoin('mcid_plancidades.opc_situacao_etapas_projetos as opc1', 'opc1.id', '=', 'rlc_monitoramento_projetos_etapas.situacao_etapa_projeto_id')
            ->leftjoin('mcid_plancidades.opc_situacao_etapas_projetos as opc2', 'opc2.id', '=', 'tab_etapas_projetos.situacao_etapa_projeto_id')
            ->select(
                'rlc_monitoramento_projetos_etapas.id',
                'monitoramento_projeto_id',
                'etapa_projeto_id',
                'tab_etapas_projetos.dsc_etapa',
                'tab_etapas_projetos.dsc_marco',
                'rlc_monitoramento_projetos_etapas.dte_efetiva_inicio_etapa',
                'rlc_monitoramento_projetos_etapas.dte_efetiva_conclusao_etapa',
                'rlc_monitoramento_projetos_etapas.situacao_etapa_projeto_id',
                'opc1.txt_nome_situacao as txt_situacao',
                'opc1.vlr_percentual_conclusao as vlr_percentual_conclusao',
                'created_at',
                'tab_etapas_projetos.vlr_peso_etapa',
                'tab_etapas_projetos.dte_previsao_inicio_etapa',
                'tab_etapas_projetos.dte_previsao_conclusao_etapa',
                'tab_etapas_projetos.dte_efetiva_inicio_etapa as dte_validada_inicio_etapa',
                'tab_etapas_projetos.dte_efetiva_conclusao_etapa as dte_validada_conclusao_etapa',
                'tab_etapas_projetos.situacao_etapa_projeto_id as situacao_validada_etapa_projeto_id',
                'opc2.txt_nome_situacao as txt_situacao_validada'
            )
            ->where('monitoramento_projeto_id', $dados_monitoramento->monitoramento_projeto_id)
            ->orderBy('etapa_projeto_id')->get();


            foreach($etapasPreenchidas as $etapa){
                if (in_array($etapa->situacao_etapa_projeto_id, [1, null])){
                        $percentual_etapa = $etapa->vlr_peso_etapa * 0;
                }else{
                    $percentual_etapa = $etapa->vlr_peso_etapa * $etapa->vlr_percentual_conclusao;
                } 
                $etapa->percentualEtapa = $percentual_etapa;
                $dados_projeto->percentualAtual += $percentual_etapa;
            }      
            
                
            
            $etapas_projeto = EtapasProjeto::where('projeto_id', $dados_projeto->projeto_id)->get();

            $situacaoEtapas = SituacoesEtapasProjetos::select('id', 'txt_nome_situacao as nome')->get();

            return view(
                'modulo_plancidades.projeto.editar_monitoramento_projeto', 
                compact(
                    'dados_monitoramento', 
                    'dados_projeto', 
                    'etapasPreenchidas', 
                    'etapas_projeto', 
                    'situacaoEtapas',
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

        $user = Auth()->user();

        DB::beginTransaction();
        $dados_monitoramento = MonitoramentoProjetos::find($id);

        $dados_monitoramento->user_id = $user->id;
        if($request->dsc_analise_indicador != null){
            $dados_monitoramento->dsc_analise_indicador = $request->dsc_analise_indicador;
        }
        if($request->dsc_causas_impedimentos_atingimento_meta != null){
            $dados_monitoramento->dsc_causas_impedimentos = $request->dsc_causas_impedimentos_atingimento_meta;
        }
        if($request->dsc_desafios_proximos_passos != null){
            $dados_monitoramento->dsc_desafios_proximos_passos = $request->dsc_desafios_proximos_passos;
        }

        $dados_monitoramento->vlr_percentual_atual = $request->vlr_percentual_atual;

        //Checagem de etapas 

        $etapasMonitoradas = ViewResumoApuracaoProjeto::where('monitoramento_projeto_id', $id)->first();

        //return ($etapasMonitoradas);

        if($etapasMonitoradas->qtd_etapas_apuradas >= $etapasMonitoradas->qtd_etapas && $etapasMonitoradas->qtd_etapas != null){
               $dados_monitoramento->bln_meta_atingida = true;
        }else{
               $dados_monitoramento->bln_meta_atingida = false;
        }

        
        $dados_salvos = $dados_monitoramento->update();

        $checa_situacao_monitoramento = RlcSituacaoMonitoramentoProjetos::where('monitoramento_projeto_id', $dados_monitoramento->id)->orderBy('created_at', 'desc')->first();        
        
        


        if ($dados_salvos) {


            
            if($request->botao_salvar){
                if(!$checa_situacao_monitoramento || $checa_situacao_monitoramento->situacao_monitoramento_id <> '2'){
                    $situacao_monitoramento_projetos = new RlcSituacaoMonitoramentoProjetos();
                    $situacao_monitoramento_projetos->monitoramento_projeto_id = $id;
                    $situacao_monitoramento_projetos->situacao_monitoramento_id = '2';
                    $situacao_monitoramento_projetos->user_id = $user->id;
                    $situacao_monitoramento_projetos->created_at = date('Y-m-d H:i:s');
                    $situacao_monitoramento_projetos->projeto_id = $dados_monitoramento->projeto_id;
                    $situacao_monitoramento_projetos->save();
                }

                DB::commit();
                flash()->sucesso("Sucesso", "Monitoramento do Indicador atualizado com sucesso!");
                return Redirect::route("plancidades.monitoramentos.projeto.editar", ["monitoramentoId" => $dados_monitoramento->id]);
            }else{
                if($request->botao_finalizar){
                    $situacao_monitoramento_projetos = new RlcSituacaoMonitoramentoProjetos();
                        $situacao_monitoramento_projetos->monitoramento_projeto_id = $id;
                        $situacao_monitoramento_projetos->situacao_monitoramento_id = '3';
                        $situacao_monitoramento_projetos->user_id = $user->id;
                        $situacao_monitoramento_projetos->created_at = date('Y-m-d H:i:s');
                        $situacao_monitoramento_projetos->projeto_id = $dados_monitoramento->projeto_id;
                        $situacao_monitoramento_projetos->save();  
                    flash()->sucesso("Sucesso", "Monitoramento do Projeto finalizado com sucesso!");
                    return Redirect::route("plancidades.monitoramentos.projeto.listarMonitoramentos", ["projetoId" => $dados_monitoramento->projeto_id]);
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

    public function consultarProjeto()
    {
        return view("modulo_plancidades.projeto.consultar_monitoramento_projeto");
    }

    public function listarMonitoramentos($projetoId)
    {

        $monitoramentos = ViewMonitoramentoProjetos::where('view_monitoramento_projetos.projeto_id', $projetoId)
        ->orderBy('view_monitoramento_projetos.monitoramento_projeto_id', 'DESC')
        ->leftJoin('mcid_plancidades.view_validacao_monitoramento_projetos','view_validacao_monitoramento_projetos.monitoramento_projeto_id','=','view_monitoramento_projetos.monitoramento_projeto_id')
        ->select('view_monitoramento_projetos.*','view_validacao_monitoramento_projetos.situacao_monitoramento_id','view_validacao_monitoramento_projetos.txt_situacao_monitoramento')
        ->get();

        //return ($monitoramentos);

        if (count($monitoramentos) > 0) {
            return view("modulo_plancidades.projeto.listar_monitoramentos_projeto", compact('monitoramentos'));
            //return $monitoramentos;
        } else {
            flash()->erro("Erro", "Nenhum monitoramento encontrado...");
            return back();
        }
    }

    public function criarMonitoramento($projetoId)
    {
        // return $indicadorId;

        $dadosProjeto = ViewProjetos::find($projetoId);

        $situacoes = array('5', '6', null); // 5 - Validado; 6 - Validado e registrado no SIOP; NULL - Nenhum monitoramento registrado;

        if (!in_array($dadosProjeto->situacao_monitoramento_id, $situacoes)){
            DB::rollBack();
            flash()->erro("Erro", "Já existe um monitoramento para esse período.");
            return back();
        }

        return view('modulo_plancidades.projeto.iniciar_monitoramento_projeto', compact('dadosProjeto'));
    }
}