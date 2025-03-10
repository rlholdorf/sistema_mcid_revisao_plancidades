<?php

namespace App\Http\Controllers\Mod_planejamento_tarefas;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mod_planejamento_tarefas\EtapasPlanejamentos;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EtapasPlanejamentoController extends Controller
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
    public function create(Request $request)
    {

        DB::beginTransaction();

        $etapaPlanejamento = new EtapasPlanejamentos();

        $etapaPlanejamento->txt_nome_etapa_planejamento = $request->txt_nome_etapa_planejamento;
        $etapaPlanejamento->planejamento_tarefa_id = $request->planejamento_tarefa_id;
        $etapaPlanejamento->user_id = Auth::user()->id;
        $etapaPlanejamento->created_at = date("Y-m-d h:i:s");

        $salvoSucesso = $etapaPlanejamento->save();

        if ($salvoSucesso) {
            DB::commit();
            flash()->sucesso("Sucesso", "Etapa cadastrada com sucesso!");
            return back();
        } else {
            DB::rollBack();
            flash()->erro("Erro", "Não foi possível cadastrar o Planejamento.");
            return back();
        }
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
        //
    }
}