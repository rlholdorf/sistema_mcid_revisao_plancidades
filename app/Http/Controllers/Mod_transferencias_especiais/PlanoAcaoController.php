<?php

namespace App\Http\Controllers\Mod_transferencias_especiais;

use App\Exports\Mod_transferencias_especiais\PlanosAcoesExport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mod_transferencias_especiais\AgrupamentoMetas;
use App\Mod_transferencias_especiais\AnalisePlanoAcoes;
use App\Mod_transferencias_especiais\PlanoAcoes;
use App\Secretaria;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


use Maatwebsite\Excel\Facades\Excel;

class PlanoAcaoController extends Controller
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
    public function show($plano_acao)
    {
        $plano = PlanoAcoes::find($plano_acao);
        $plano->load('situacaoAnalise');

        $metas = AgrupamentoMetas::where('cod_plano_acao', $plano_acao)
            ->orderBy('txt_executor')
            ->orderBy('txt_finalidade')
            ->orderBy('txt_meta')->get();
        $analise = AnalisePlanoAcoes::where('cod_plano_acao', $plano_acao)->first();

        return view('modulo_transferencias_especiais.PlanoAcao', [
            'plano' => $plano,
            'metas' => $metas,
            'analise' => $analise

        ]);
    }

    public function planoAtribuir($cod_plano_acao)
    {
        //  return $cod_plano_acao;

        DB::beginTransaction();

        $usuario = Auth::user();
        $plano_acao = PlanoAcoes::find($cod_plano_acao);

        $plano_acao->bln_distribuido = true;
        $plano_acao->dte_distribuicao = date("Y-m-d h:i:s");
        $plano_acao->user_id = $usuario->id;
        $plano_acao->secretaria_id = $usuario->secretaria_id;
        $plano_acao->bln_distribuicao_automatica = false;

        $atualizadoSucesso = $plano_acao->update();

        if ($atualizadoSucesso) {
            DB::commit();
            flash()->sucesso("Sucesso", "Plano de ação distribuído com sucesso!");
            return back();
        } else {
            DB::rollBack();
            flash()->erro("Erro", "Não foi possível distribuir o plano de ação.");
            return back();
        }
    }

    public function planoDesatribuir($cod_plano_acao)
    {
        //  return $cod_plano_acao;

        DB::beginTransaction();

        $usuario = Auth::user();
        $plano_acao = PlanoAcoes::find($cod_plano_acao);

        $plano_acao->bln_distribuido = false;
        $plano_acao->dte_distribuicao = null;
        $plano_acao->user_id = null;
        $plano_acao->secretaria_id = null;
        $atualizadoSucesso = $plano_acao->update();
        $plano_acao->bln_distribuicao_automatica = false;
        if ($atualizadoSucesso) {
            DB::commit();
            flash()->sucesso("Sucesso", "Distribuição cancelada com sucesso!");
            return back();
        } else {
            DB::rollBack();
            flash()->erro("Erro", "Não foi possível cancelar a distribuição do plano de ação.");
            return back();
        }
    }

    public function downloadsPlanosAcao($secretariaId, $distribuicao)
    {

        $secretaria = Secretaria::find($secretariaId);
        return Excel::download(new PlanosAcoesExport($secretariaId, $distribuicao), 'planosAcoes-' . $secretaria->txt_sigla_secretaria . '.xlsx');
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