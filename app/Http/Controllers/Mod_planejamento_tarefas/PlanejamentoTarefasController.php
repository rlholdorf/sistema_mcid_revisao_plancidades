<?php

namespace App\Http\Controllers\Mod_planejamento_tarefas;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mod_planejamento_tarefas\EtapasPlanejamentos;
use App\Mod_planejamento_tarefas\PlanejamentoTarefas;
use App\Mod_planejamento_tarefas\TarefasEtapas;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PlanejamentoTarefasController extends Controller
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
        return view('modulo_planejamento_tarefas.cadastro_planejamento_tarefa');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        DB::beginTransaction();

        $planejamento = new PlanejamentoTarefas();

        $planejamento->txt_nome_planejamento = $request->txt_nome_planejamento;
        $planejamento->secretaria_id = $request->secretaria;
        $planejamento->dsc_planejamento_tarefa = $request->dsc_planejamento_tarefa;
        $planejamento->user_id = Auth::user()->id;
        $planejamento->created_at = date("Y-m-d h:i:s");

        $salvoSucesso = $planejamento->save();

        if ($salvoSucesso) {
            DB::commit();
            flash()->sucesso("Sucesso", "Planejamento cadastrado com sucesso!");
            return redirect("/planejamento_tarefas/show/$planejamento->id");
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
    public function show(PlanejamentoTarefas $planejamento)
    {
        $planejamento->load('secretaria', 'user');

        $etapasPlanejamento = EtapasPlanejamentos::where('planejamento_tarefa_id', $planejamento->id)->get();


        return view('modulo_planejamento_tarefas.planejamento_tarefa', [
            'planejamento' => $planejamento,
            'etapasPlanejamento' => $etapasPlanejamento
        ]);
    }

    public function listaPlanejamentos()
    {
        $usuario = Auth::user();
        $usuario->load('setor.departamento.secretaria');
        $planejamentos = PlanejamentoTarefas::where('secretaria_id', $usuario->setor->departamento->secretaria_id)->get();
        $planejamentos->load('secretaria');
        return view('modulo_planejamento_tarefas.lista_planejamento_tarefa', [
            'planejamentos' => $planejamentos
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