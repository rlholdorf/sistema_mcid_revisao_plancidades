<?php

namespace App\Http\Controllers\Mod_planejamento_tarefas;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mod_planejamento_tarefas\ListaVerificacaoTarefas;
use App\Mod_planejamento_tarefas\TarefasEtapas;
use App\Mod_planejamento_tarefas\ViewTarefasEtapas;

class TarefaEtapaController extends Controller
{
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($tarefa)
    {
        $tarefaEtapa = ViewTarefasEtapas::where('tarefa_etapa_id', $tarefa)->first();

        $listaVerificacao = ListaVerificacaoTarefas::where('tarefa_etapa_id', $tarefa)->orderBy('num_ordem_verificacao')->get();
        $listaVerificacao->load('listaVerificacao', 'responsavel', 'tarefaEtapa', 'user');


        return view('modulo_planejamento_tarefas.tarefa_etapa', [
            'tarefaEtapa' => $tarefaEtapa,
            'listaVerificacao' => $listaVerificacao,
        ]);
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
        //
    }
}