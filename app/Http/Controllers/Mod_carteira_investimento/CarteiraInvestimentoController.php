<?php

namespace App\Http\Controllers\Mod_carteira_investimento;

use App\Corporativo\Mcid_carteira_investimento\Desbloqueios;
use App\Corporativo\Mcid_carteira_investimento\Desembolsos;
use App\Corporativo\Mcid_carteira_investimento\Empenhos;
use App\Corporativo\Mcid_carteira_investimento\LocalizacaoDadosBasicos;
use App\Corporativo\Mcid_carteira_investimento\TabCarteiraInvestimento;
use App\Corporativo\Mcid_carteira_investimento\ViewResumoTipoInstrumentoOrigem;
use App\Corporativo\Mcid_corporativo\ViewCarteiraInvestimento;
use App\Corporativo\Mcid_repositorios_carga\Nova_tci\TabContratoUnidade;
use App\Corporativo\Mdr_corporativo\ContratosMcmv;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\IndicadoresHabitacionais\Municipio;
use App\IndicadoresHabitacionais\Uf;
use App\Secretaria;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CarteiraInvestimentoController extends Controller
{
    public function consultarContratos()
    {
        $resumoTipoInstrumento = ViewResumoTipoInstrumentoOrigem::get();
        return view(
            'modulo_carteira_investimento.ConsularContratosCarteiraInvestimento',
            compact('resumoTipoInstrumento')
        );
    }


    public function pesquisarContratos(Request $request)
    {


        $usuario = Auth::user();

        $where = [];

        if (!empty($request->codigo_base)) {

            // return $request->all();
            $where[] = [$request->codigo_base, $request->codigo];
            $dadosContrato = TabCarteiraInvestimento::where($where)->paginate(20);
            if (count($dadosContrato) == 0) {
                flash()->erro("Erro", "Não existe contrato para o código digitado");
                return back();
            } else {
                $dadosContrato = TabCarteiraInvestimento::where($where)->firstOrFail();
                return redirect('/carteira_investimento/contrato/' . $dadosContrato->cod_contrato);
            }
        } else {
            // return $request->all();
            if (!empty($request->estado)) {
                $estado = Uf::where('id', $request->estado)->firstOrFail();
                $where[] = ['txt_uf', $estado->txt_sigla_uf];
            }

            if (!empty($request->municipio)) {
                $municipio = Municipio::where('id', $request->municipio)->firstOrFail();
                $where[] = ['cod_ibge_7dig', $municipio->cod_ibge_7_dig];
            }

            if (!empty($request->bln_carteira_mcid)) {
                if ($request->bln_carteira_mcid == 'true') {
                    $where[] = ['bln_carteira_mcid', 'SIM'];
                } else {
                    $where[] = ['bln_carteira_mcid', 'NÃO'];
                }
            }

            if (!empty($request->bln_carteira_ativa_mcid)) {
                if ($request->bln_carteira_ativa_mcid == 'true') {
                    $where[] = ['bln_carteira_ativa_mcid', 'SIM'];
                } else {
                    $where[] = ['bln_carteira_ativa_mcid', 'NÃO'];
                }
            }

            if (!empty($request->bln_carteira_andamento)) {
                if ($request->bln_carteira_andamento == 'true') {
                    $where[] = ['bln_carteira_andamento', 'SIM'];
                } else {
                    $where[] = ['bln_carteira_andamento', 'NÃO'];
                }
            }

            if (!empty($request->situacao_contrato)) {
                $where[] = ['cod_situacao_contrato_mcid', $request->situacao_contrato];
            }

            if (!empty($request->situacao_objeto)) {
                $where[] = ['cod_situacao_objeto_mcid', $request->situacao_objeto];
            }

            if (!empty($request->tipo_instrumento)) {
                $where[] = ['cod_tipo_instrumento', $request->tipo_instrumento];
            }

            if (!empty($request->secretaria)) {
                $where[] = ['cod_secretaria', $request->secretaria];
            }

            if (!empty($request->origem)) {
                $where[] = ['cod_origem', $request->origem];
            }

            if (!empty($request->fonte)) {
                $where[] = ['cod_fonte', $request->fonte];
            }

            if (!empty($request->sub_fonte)) {
                $where[] = ['cod_sub_fonte', $request->sub_fonte];
            }

            if (!empty($request->fase_pac)) {
                $where[] = ['cod_fase_pac', $request->fase_pac];
            }

            //return $where;
            $dadosContratos = TabCarteiraInvestimento::where($where)->orderBy('txt_uf')->orderBy('txt_municipio')->paginate(40);
            if (count($dadosContratos) == 0) {
                flash()->erro("Erro", "Não existem contratos para os parâmetros selecionados");
                return back();
            } else {
                return view('modulo_carteira_investimento.ListaContratosCarteira', compact('usuario', 'dadosContratos'));
            }
        }
    }

    public function dadosContrato(Request $request)
    {
        //return $request->all();

        $codigo = explode("/", $_SERVER["REQUEST_URI"]);
        $codigo_base = $codigo[3];

        $where[] = [$codigo_base, $request->codigo];
        $dadosContrato = TabCarteiraInvestimento::where($where)->first();
        if (!$dadosContrato) {
            flash()->erro("Erro", "Não existe contrato para o código digitado");
            return back();
        } else {

            return redirect('/carteira_investimento/contrato/' . $dadosContrato->cod_contrato);
        }
    }

    public function dadosContratoTCI($codigo)
    {
        //return $request->all();
        $where[] = ['cod_tci', $codigo];
        $dadosContrato = TabCarteiraInvestimento::where($where)->first();
        if (!$dadosContrato) {
            flash()->erro("Erro", "Não existe contrato para o código digitado");
            return back();
        } else {

            return redirect('/carteira_investimento/contrato/' . $dadosContrato->cod_contrato);
        }
    }

    public function visualizarContrato($cod_contrato)
    {


        $carteira = TabCarteiraInvestimento::where('cod_contrato', $cod_contrato)->first();
        $secretarias = Secretaria::select('id', 'txt_sigla_secretaria AS nome')->whereIn('id', [11, 12, 13, 14, 16])->orderBy('txt_sigla_secretaria')->get();

        if (!$carteira) {
            flash()->erro("Erro", "Não existe contrato com este código.");
            return back();
        }

        $empenhos = Empenhos::where('cod_contrato', $cod_contrato)->orderBy('dte_emissao_ne')->get();
        $desembolsos = Desembolsos::where('cod_tci', $carteira->cod_tci)->orderBy('dte_ordem_bancaria')->get();
        $desbloqueios = Desbloqueios::join('mcid_carteira_investimento.opc_tipo_recurso_desbloqueio', 'opc_tipo_recurso_desbloqueio.cod_tipo_recurso_desbloqueio', '=', 'tab_desbloqueios.cod_tipo_recurso_desbloqueio')
            ->where('cod_tci', $carteira->cod_tci)->orderBy('dte_cadastro')->get();

        $municipios = LocalizacaoDadosBasicos::where('cod_tci', $carteira->cod_tci)->orderBy('txt_uf')->orderBy('txt_municipio')->get();

        $dadosContratoMCMV = '';
        if ($carteira->cod_origem == 4) {
            $dadosContratoMCMV = ContratosMcmv::where('cod_contrato', $cod_contrato)->firstOrFail();
        }



        return view(
            'modulo_carteira_investimento.DadosContratoCarteiraInvestimento',
            compact('carteira', 'dadosContratoMCMV', 'empenhos', 'desembolsos', 'municipios', 'secretarias', 'desbloqueios')
        );
    }


    public function visualizarConvenio($num_convenio)
    {

        $secretarias = Secretaria::select('id', 'txt_sigla_secretaria AS nome')->whereIn('id', [11, 12, 13, 14, 16])->orderBy('txt_sigla_secretaria')->get();

        $carteira = TabCarteiraInvestimento::where('num_convenio', $num_convenio)->first();

        if (!$carteira) {
            flash()->erro("Erro", "Não existe contrato com este código.");
            return back();
        }

        $empenhos = Empenhos::where('cod_contrato', $carteira->cod_contrato)->orderBy('dte_emissao_ne')->get();
        $desembolsos = Desembolsos::where('cod_tci', $carteira->cod_tci)->orderBy('dte_ordem_bancaria')->get();


        $municipios = LocalizacaoDadosBasicos::where('cod_tci', $carteira->cod_tci)->orderBy('txt_uf')->orderBy('txt_municipio')->get();

        $dadosContratoMCMV = '';
        if ($carteira->cod_origem == 4) {
            $dadosContratoMCMV = ContratosMcmv::where('cod_contrato',  $carteira->cod_contrato)->firstOrFail();
        }



        return view(
            'modulo_carteira_investimento.DadosContratoCarteiraInvestimento',
            compact('carteira', 'dadosContratoMCMV', 'empenhos', 'desembolsos', 'municipios', 'secretarias')
        );
    }


    public function visualizarContratosSecretariasNulo()
    {
        //
        $contratos = TabCarteiraInvestimento::where('cod_secretaria', 99)->orderBy('txt_uf')->orderBy('txt_municipio')->paginate(30);

        return view(
            'modulo_carteira_investimento.ListaContratoSecretariaNulo',
            compact('contratos')
        );
    }

    /**
     * Display a listing of the resource.
     *
    
     */
    public function updateSecretaria(Request $request)
    {
        $usuario = Auth::user();

        $secretaria = Secretaria::find($request->cod_secretaria);

        //return $request->all();
        $dadosContrato = TabCarteiraInvestimento::where('cod_tci', $request->cod_tci)->first();
        $dadosContrato->cod_secretaria = $request->cod_secretaria;
        $dadosContrato->txt_sigla_secretaria = $secretaria->txt_sigla_secretaria;


        $dadosContrato->user_id = $usuario->id;
        $dadosContratoAtualizado = $dadosContrato->update();

        $dadosContratoUnidade = TabContratoUnidade::find($request->cod_tci);
        $dadosContratoUnidade->cod_secretaria = $request->cod_secretaria;
        $dadosContratoUnidade->user_id = $usuario->id;
        $dadosContratoUnidadeAtualizado = $dadosContratoUnidade->update();





        DB::beginTransaction();

        if ($dadosContratoUnidadeAtualizado && $dadosContratoAtualizado) {
            DB::commit();

            flash()->sucesso("Sucesso", "Secretaria atualizada com sucesso!");
            return redirect('/carteira_investimento/contrato/' . $dadosContrato->cod_contrato);
        } else {
            DB::rollBack();
            flash()->erro("Erro", "Não foi possível atualizar a Secretaria.");
            return back();
        }
    }





    /**
     * Show the form for creating a new resource.
     *
    
     */
    public function create() {}


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
    
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
    
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
    
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
    
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
    
     */
    public function destroy($id)
    {
        //
    }
}