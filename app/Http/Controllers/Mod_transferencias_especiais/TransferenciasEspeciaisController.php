<?php

namespace App\Http\Controllers\Mod_transferencias_especiais;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mod_transferencias_especiais\FinalidadesMetasPlanoAcoes;
use App\Mod_transferencias_especiais\PlanoAcoes;
use App\Mod_transferencias_especiais\ViewPalavrasSecretarias;

class TransferenciasEspeciaisController extends Controller
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
    public function index() {}

    public function consultar()
    {
        return view('modulo_transferencias_especiais.ConsularTransferenciasEspeciais');
    }

    public function pesquisar(Request $request)
    {

        //  return $request->all();



        $where = [];

        $secretariaId = $request->secretaria;
        $distribuicao = 0;

        if ($request->codigo) {
            $where[] = ['cod_plano_acao', $request->codigo];
        }

        if ($request->bln_distribuicao == 1) {
            $distribuicao = 1;
            $where[] = ['view_palavras_secretarias.bln_distribuido', true];
        } else {
            $where[] = ['view_palavras_secretarias.bln_distribuido', false];
        }

        if ($request->secretaria == 11) {
            $where[] = ['view_palavras_secretarias.txt_palavra_sndum', '!=', ''];
        } else if ($request->secretaria == 12) {
            $where[] = ['view_palavras_secretarias.txt_palavra_semob', '!=', ''];
        } else if ($request->secretaria == 13) {
            $where[] = ['view_palavras_secretarias.txt_palavra_snsa', '!=', ''];
        } else if ($request->secretaria == 14) {
            $where[] = ['view_palavras_secretarias.txt_palavra_snh', '!=', ''];
        } else if ($request->secretaria == 15) {
            $where[] = ['view_palavras_secretarias.txt_palavra_snp', '!=', ''];
        } else if ($request->secretaria == 99) {
            $where[] = ['view_palavras_secretarias.txt_palavra_sndum', '=', ''];
            $where[] = ['view_palavras_secretarias.txt_palavra_semob', '=', ''];
            $where[] = ['view_palavras_secretarias.txt_palavra_snsa', '=', ''];
            $where[] = ['view_palavras_secretarias.txt_palavra_snh', '=', ''];
            $where[] = ['view_palavras_secretarias.txt_palavra_snp', '=', ''];
        }


        if ($request->bln_distribuicao == 0) {
            $planos = ViewPalavrasSecretarias::where($where)->get();
        } else {
            $planos = ViewPalavrasSecretarias::leftjoin('mcid_transferencia_especiais_novo.tab_planos_acoes', 'tab_planos_acoes.cod_plano_acao', '=', 'view_palavras_secretarias.cod_plano_acao')
                ->leftjoin('mcid_sistema_se.users', 'users.id', '=', 'tab_planos_acoes.user_id')
                ->leftjoin('mcid_sistema_se.opc_secretarias', 'opc_secretarias.id', '=', 'tab_planos_acoes.secretaria_id')
                ->select(
                    'view_palavras_secretarias.*',
                    'users.name',
                    'users.txt_cpf_usuario',
                    'opc_secretarias.txt_sigla_secretaria',
                    'bln_distribuicao_automatica'
                )
                ->where($where)->get();
        }

        //return count($planos);

        if (count($planos) < 0) {
            flash()->erro("Erro", "Não existe planos para o parâmetro informado.");
        }

        if (count($planos) > 0) {
            return view('modulo_transferencias_especiais.ListaTransferenciasEspeciais', [
                'planos' => $planos,
                'secretariaId' => $secretariaId,
                'distribuicao' => $distribuicao
            ]);
        } else {
            flash()->erro("Erro", "Não existem planos de ações para os parâmetros escolhidos.");
            return back();
        }
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
    public function show($id) {}

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