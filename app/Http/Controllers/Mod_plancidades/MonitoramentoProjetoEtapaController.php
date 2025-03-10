<?php

namespace App\Http\Controllers\Mod_plancidades;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mod_plancidades\RlcMonitoramentoEtapasProjetos;
use App\Mod_plancidades\MonitoramentoProjetos;
use App\Mod_plancidades\ViewResumoApuracaoProjeto;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;


class MonitoramentoProjetoEtapaController extends Controller
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
        //
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $user = Auth()->user();

        DB::beginTransaction(); 

        $dados_monitoramento_etapa =  RlcMonitoramentoEtapasProjetos::find($request->id);


        $dados_monitoramento_etapa->dte_efetiva_inicio_etapa = $request->dte_efetiva_inicio_etapa;
        $dados_monitoramento_etapa->dte_efetiva_conclusao_etapa = $request->dte_efetiva_conclusao_etapa;
        $dados_monitoramento_etapa->situacao_etapa_projeto_id = $request->situacao_etapa_projeto_id;

        $dados_monitoramento_projeto = MonitoramentoProjetos::where('id', $dados_monitoramento_etapa->monitoramento_projeto_id)->first();

        $etapasMonitoradas = ViewResumoApuracaoProjeto::where('monitoramento_projeto_id', $dados_monitoramento_etapa->monitoramento_projeto_id)->first();

        if($etapasMonitoradas->qtd_etapas_apuradas >= $etapasMonitoradas->qtd_etapas && $etapasMonitoradas->qtd_etapas != null){
               $dados_monitoramento_projeto->bln_meta_atingida = true;
        }else{
               $dados_monitoramento_projeto->bln_meta_atingida = false;
        }

        $dados_salvos = $dados_monitoramento_etapa->update();
        $dados_salvos_projeto = $dados_monitoramento_projeto->update();


        
        if ($dados_salvos) {
            DB::commit();

            flash()->sucesso("Sucesso", "Etapa do Monitoramento atualizada com sucesso!");
            return Redirect::route("plancidades.monitoramentos.projeto.editar", ["monitoramentoId" => $dados_monitoramento_etapa->monitoramento_projeto_id]);
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
}
