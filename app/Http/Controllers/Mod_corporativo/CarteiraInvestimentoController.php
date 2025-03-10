<?php

namespace App\Http\Controllers\Mod_corporativo;

use App\Corporativo\Mcid_corporativo\ViewCarteiraInvestimento;
use App\Corporativo\Mdr_corporativo\ContratosMcmv;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\IndicadoresHabitacionais\Municipio;
use App\IndicadoresHabitacionais\Uf;
use App\ViewArquivosEnviados;

use DirectoryIterator;
use Illuminate\Support\Facades\Auth;



class CarteiraInvestimentoController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');        

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function consultarContratos()
    {


        return view('modulo_carteira_investimento.ConsularContratosCarteiraInvestimento');
    }


    public function pesquisarContratos(Request $request)
    {

        $search = $request->search;
        //return $request->all();
        $usuario = Auth::user();

        $where = [];



        if (!empty($request->cod_contrato)) {
            $where[] = ['cod_contrato', $request->cod_contrato];
            $dadosContrato = ViewCarteiraInvestimento::where($where)->get();
            if (count($dadosContrato) == 0) {
                flash()->erro("Erro", "Não existe contrato para o código digitado");
                return back();
            } else {
                $dadosContrato = ViewCarteiraInvestimento::where($where)->firstOrFail();
                return redirect('/carteira_investimento/contrato/' . $dadosContrato->cod_contrato);
            }
        } else  if (!empty($request->codigo_saci)) {
            $where[] = ['codigo_saci', $request->codigo_saci];
            $dadosContrato = ViewCarteiraInvestimento::where($where)->get();
            if (count($dadosContrato) == 0) {
                flash()->erro("Erro", "Não existe contrato para o código digitado");
                return back();
            } else {
                $dadosContrato = ViewCarteiraInvestimento::where($where)->firstOrFail();
                return redirect('/carteira_investimento/contrato/' . $dadosContrato->cod_contrato);
            }
        } else {

            if (!empty($request->estado)) {
                $estado = Uf::where('id', $request->estado)->firstOrFail();
                $where[] = ['uf', $estado->txt_sigla_uf];
            }

            if (!empty($request->municipio)) {
                $municipio = Municipio::where('id', $request->municipio)->firstOrFail();
                $where[] = ['ibge', $municipio->cod_ibge_7_dig];
            }

            $dadosContratos = ViewCarteiraInvestimento::where($where)->get();
            if (count($dadosContratos) == 0) {
                flash()->erro("Erro", "Não existem contratos para os parâmetros selecionados");
                return back();
            } else {
                $dadosContratos = ViewCarteiraInvestimento::where($where)->get();
                return view('modulo_carteira_investimento.ListaContratosCarteira', compact('usuario', 'dadosContratos', 'search'));
            }
        }
    }


    public function dadosContrato(Request $request)
    {

        $where = [];

        //return $request->all();

        $dadosContratoMCMV = '';

        if (!empty($request->cod_contrato)) {
            $where[] = ['cod_contrato', $request->cod_contrato];

            $dadosContratoMCMV = ContratosMcmv::where($where)->firstOrFail();
        }

        if (!empty($request->cod_mdr)) {
            $where[] = ['cod_mdr', $request->cod_mdr];

            $dadosContratoMCMV = ContratosMcmv::where($where)->firstOrFail();
        }

        if (!empty($request->codigo_saci)) {
            $where[] = ['codigo_saci', $request->codigo_saci];
        }




        $carteira = ViewCarteiraInvestimento::where($where)->firstOrFail();



        $dadosContratoRepasse = '';

        return view('modulo_carteira_investimento.DadosContratoCarteiraInvestimento', compact('carteira', 'dadosContratoMCMV'));
    }


    public function visualizarContrato($cod_contrato)
    {

        $dadosContratoMCMV = ContratosMcmv::where('cod_contrato', $cod_contrato)->firstOrFail();
        $carteira = ViewCarteiraInvestimento::where('cod_contrato', $cod_contrato)->firstOrFail();

        return view('modulo_carteira_investimento.DadosContratoCarteiraInvestimento', compact('carteira', 'dadosContratoMCMV'));
    }
}
