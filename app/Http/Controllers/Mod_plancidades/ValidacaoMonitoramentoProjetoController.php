<?php

namespace App\Http\Controllers\Mod_plancidades;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

use App\Mod_plancidades\EtapasProjeto;
use App\Mod_plancidades\MonitoramentoProjetos;
use App\Mod_plancidades\Projetos;
use App\Mod_plancidades\SituacoesEtapasProjetos;
use App\Mod_plancidades\RlcMonitoramentoEtapasProjetos;
use App\Mod_plancidades\RlcSituacaoMonitoramentoProjetos;
use App\Mod_plancidades\TabProjetos;
use App\Mod_plancidades\ViewProjetos;
use App\Mod_plancidades\ViewMonitoramentoProjetos;
use App\Mod_plancidades\ViewValidacaoMonitoramentoProjetos;

use Illuminate\Support\Facades\DB;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegrationAssertPostConditionsForV7AndPrevious;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Support\Facades\Redirect;

class ValidacaoMonitoramentoProjetoController extends Controller
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
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($indicadorId)
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
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
    public function edit($monitoramento_projeto_id)
    {
        $monitoramentos = ViewValidacaoMonitoramentoProjetos::where('monitoramento_projeto_id', $monitoramento_projeto_id)->first();
        
        $dados_monitoramento = ViewMonitoramentoProjetos::find($monitoramento_projeto_id);

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

        $usuarioPreenchimento = User::where('id', $monitoramentos->user_id)->first();

        return view(
            'modulo_plancidades.validacao_monitoramento.analisar_monitoramentos_projeto', 
            compact('monitoramentos',
                'dados_monitoramento', 
                'dados_projeto', 
                'etapasPreenchidas', 
                'etapas_projeto', 
                'situacaoEtapas',
                'usuarioPreenchimento'
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
    public function update(Request $request, $monitoramento_projeto_id)
    {
        //return $monitoramento_projeto_id;
        //return $request;

        $user = Auth()->user();
        DB::beginTransaction();

        $monitoramentos = ViewValidacaoMonitoramentoProjetos::where('monitoramento_projeto_id', $monitoramento_projeto_id)->first();

        $dados_validacao = new RlcSituacaoMonitoramentoProjetos();

        $rlc_etapas = RlcMonitoramentoEtapasProjetos::where('monitoramento_projeto_id', $monitoramento_projeto_id)->get();

        

        if(in_array($request->situacao_monitoramento_id, [5,6])){ //Checa se monitoramento está "Validado" ou "Validado e registrado no SIOP" 
            foreach($rlc_etapas as $etapa){
                $item = EtapasProjeto::find($etapa->etapa_projeto_id);
                $item->dte_efetiva_inicio_etapa = $etapa->dte_efetiva_inicio_etapa;
                $item->dte_efetiva_conclusao_etapa = $etapa->dte_efetiva_conclusao_etapa;
                $item->situacao_etapa_projeto_id = $etapa->situacao_etapa_projeto_id;
                $item->update();
            }

            $projeto = TabProjetos::find($monitoramentos->projeto_id);
            $projeto->vlr_percentual_validado = $request->vlr_percentual_atual;
            $projeto->update();
        }
        
        if($request->situacao_monitoramento_id != null && $request->txt_observacao != null){
            $dados_validacao->monitoramento_projeto_id = $monitoramento_projeto_id;
            $dados_validacao->situacao_monitoramento_id = $request->situacao_monitoramento_id;
            $dados_validacao->user_id = $user->id;
            $dados_validacao->created_at = date('Y-m-d H:i:s');
            $dados_validacao->projeto_id = $monitoramentos->projeto_id;
            $dados_validacao->txt_observacao = $request->txt_observacao;
            
        
            $dados_salvos = $dados_validacao->save();
        }
        


        if ($dados_salvos) {
            
            DB::commit();
            flash()->sucesso("Sucesso", "Situação do monitoramento do Indicador atualizada com sucesso!");
            return Redirect::route("plancidades.monitoramentos.validacao.projetos.listar");
            /**Quando só tem um na lista, ao resolver, ele não está mostrando esse flash. Tentei um if contando se não tem nada e não funcionou */

        } else {
            DB::rollBack();
            flash()->erro("Erro", "Não foi possível atualizar a situação do monitoramento.");
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
