<?php

namespace App\Http\Controllers\Mod_plancidades;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mod_plancidades\RestricoesAtingimentoMetas;
use App\Mod_plancidades\RlcRestricaoMetaMonitoramentoIndic;
use App\Mod_plancidades\RlcRestricaoMetaMonitoramentoInic;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class RestricaoMetaMonitoramentoIniciativaController extends Controller
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
    public function store(Request $request, $monitoramentoIniciativaId)
    {
        //return $request->all();
        DB::beginTransaction();

        //return $request->all();

        $restricoes = new RlcRestricaoMetaMonitoramentoInic();

        $restricoes->monitoramento_iniciativa_id = $monitoramentoIniciativaId;
        $restricoes->restricao_atingimento_meta_id = $request->restricao_atingimento_meta_id;
        $restricoes->dsc_detalhamento_restricao = $request->dsc_detalhamento_restricao;
        $restricoes->dsc_providencias_superacao_restricao = $request->dsc_providencias_superacao_restricao;
        if ($request->restricao_atingimento_meta_id == 99) {
            $restricoes->dsc_outra_restricao = $request->dsc_outra_restricao;
        }

        if ($request->restricao_atingimento_meta_id == 1 || $request->restricao_atingimento_meta_id == 2) {
            $restricoes->vlr_insuficiencia_recurso = $request->vlr_insuficiencia_recurso;
        }

        $dados_salvos = $restricoes->save();

        if ($dados_salvos) {
            DB::commit();

            flash()->sucesso("Sucesso", "Restrição cadastrada com sucesso!");
            return Redirect::route("plancidades.monitoramentos.iniciativa.editar", ['monitoramentoId' => $monitoramentoIniciativaId]);
        } else {
            DB::rollBack();
            flash()->erro("Erro", "Não foi possível cadastrar a restrição.");
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dados = RlcRestricaoMetaMonitoramentoInic::find($id);
        $monitoramentoIniciativaId = $dados->monitoramento_iniciativa_id;
        $dados_deletados = $dados->delete();
        if ($dados_deletados) {
            DB::commit();
            flash()->sucesso("Sucesso", "Restrição excluída com sucesso!");
            return Redirect::route("plancidades.monitoramentos.iniciativa.editar", ['monitoramentoId' => $monitoramentoIniciativaId]);
        } else {
            DB::rollBack();
            flash()->erro("Erro", "Não foi possível excluir a restrição.");
            return back(); 
        }
    }
}