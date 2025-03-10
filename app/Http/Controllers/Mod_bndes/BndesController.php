<?php

namespace App\Http\Controllers\Mod_bndes;

use Illuminate\Http\Request;

use DB;

use App\Http\Controllers\Controller;
use App\Mod_bndes\Bndes;
use App\Mod_bndes\RlcBndesMunicipios;
use App\User;
use App\Mod_bndes\ViewDadosBndes;
use App\Mod_bndes\ViewMunicipiosBeneficiadosBndes;
use App\Mod_saci\mod_pac\ContratosPac;
use DirectoryIterator;
use Illuminate\Support\Facades\Auth;



class BndesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        // $this->middleware('moduloUsuario');

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function ConsultarEmpreendimentos()
    {

        $usuario = Auth::user();

        $dadosBndes = ViewDadosBndes::whereIn('andamento_id', [1, 2, 6, 7])->get();

        return view('modulo_bndes.ConsultarEmpreendimentos', compact('usuario', 'dadosBndes'));
    }

    public function PesquisarEmpreendimentos(Request $request)
    {

        // return $request->all();
        $usuario = Auth::user();

        $where = [];



        if (!empty($request->cod_mcidades)) {
            $where[] = ['cod_mcidades', $request->cod_mcidades];
            $dadosBndes = ViewDadosBndes::where($where)->get();
            if (count($dadosBndes) == 0) {
                flash()->erro("Erro", "Não existe empreendimento para o código digitado");
                return back();
            } else {
                $dadosBndes = ViewDadosBndes::where($where)->firstOrFail();
                return redirect('/bndes/empreendimento/dados/' . $dadosBndes->cod_bndes);
            }
        } else  if (!empty($request->cod_saci)) {
            $where[] = ['cod_saci', $request->cod_saci];
            $dadosBndes = ViewDadosBndes::where($where)->get();
            if (count($dadosBndes) == 0) {
                flash()->erro("Erro", "Não existe empreendimento para o código digitado");
                return back();
            } else {
                $dadosBndes = ViewDadosBndes::where($where)->firstOrFail();
                return redirect('/bndes/empreendimento/dados/' . $dadosBndes->cod_bndes);
            }
        } else  if (!empty($request->cod_bndes)) {
            $where[] = ['cod_bndes', $request->cod_bndes];
            $dadosBndes = ViewDadosBndes::where($where)->get();
            if (count($dadosBndes) == 0) {
                flash()->erro("Erro", "Não existe empreendimento para o código digitado");
                return back();
            } else {
                $dadosBndes = ViewDadosBndes::where($where)->firstOrFail();
                return redirect('/bndes/empreendimento/dados/' . $dadosBndes->cod_bndes);
            }
        } else {

            if (!empty($request->estado)) {
                $where[] = ['id_uf', $request->estado];
            }

            if (!empty($request->municipio)) {
                $where[] = ['municipio_id', $request->municipio];
            }

            if (!empty($request->andamento)) {
                $where[] = ['andamento_id', $request->andamento];
            }

            if (!empty($request->situacaoContrato)) {
                $where[] = ['situacao_contrato_id', $request->situacaoContrato];
            }

            if (!empty($request->situacaoObra)) {
                $where[] = ['situacao_obra_id', $request->situacaoObra];
            }

            if (!empty($request->statusProjeto)) {
                $where[] = ['status_projeto_engenharia_id', $request->statusProjeto];
            }

            if (!empty($request->statusDocumento)) {
                $where[] = ['status_documentacao_titularidade_id', $request->statusDocumento];
            }

            if (!empty($request->statusLicitacao)) {
                $where[] = ['status_licitacao_id', $request->statusLicitacao];
            }

            if (!empty($request->statusLicenciamento)) {
                $where[] = ['status_licenciamento_ambiental_id', $request->statusLicenciamento];
            }

            if (!empty($request->situacaotrabalhoTecnico)) {
                $where[] = ['situacao_trabalho_tecnico_social_id', $request->situacaotrabalhoTecnico];
            }

            if (!empty($request->novo_pac)) {
                $where[] = ['bln_novo_pac', true];
            }

            $dadosBndes = ViewDadosBndes::where($where)->get();
            if (count($dadosBndes) == 0) {
                flash()->erro("Erro", "Não existem empreendimentos para os parâmetros selecionados");
                return back();
            } else {
                $dadosBndes = ViewDadosBndes::where($where)->get();
                return view('modulo_bndes.ListaEmpreendimentosBndes', compact('usuario', 'dadosBndes'));
            }
        }










        return view('modulo_bndes.ListaEmpreendimentosBndes', compact('usuario'));
    }

    public function dadosEmpreendimento($cod_bndes)
    {

        $usuario = Auth::user();


        $dadosBndes = ViewDadosBndes::where('cod_bndes', $cod_bndes)->firstOrFail();

        $municipiosBeneficiados = ViewMunicipiosBeneficiadosBndes::where('cod_bndes', $cod_bndes)->get();

        return view('modulo_bndes.DadosEmpreendimentoBndes', compact('usuario', 'dadosBndes', 'municipiosBeneficiados'));
    }

    public function salvarEmpreendimentos(Request $request)
    {

        //return $request->all();



        $dadosBndes = Bndes::where('cod_bndes', $request->cod_bndes)->firstOrFail();

        DB::beginTransaction();

        $dadosBndes->dte_atualizacao_sintese_atual_do_projeto = $request->andamento;
        $dadosBndes->prc_execucao_atual = $request->prc_execucao_atual;
        $dadosBndes->dte_previsao_conclusao = $request->dte_previsao_conclusao;
        $dadosBndes->vlr_ogu_atualizado = $request->vlr_ogu_atualizado;
        $dadosBndes->vlr_financiamento_atualizado = $request->vlr_financiamento_atualizado;
        $dadosBndes->vlr_liberacoes = $request->vlr_liberacoes;
        $dadosBndes->dte_ult_liberacao = $request->dte_ult_liberacao;
        $dadosBndes->vlr_contrapartida_atualizada = $request->vlr_contrapartida_atualizada;
        $dadosBndes->vlr_investimento_atualizado = $request->vlr_ogu_atualizado + $request->vlr_contrapartida_atualizada + $request->vlr_contrapartida_atualizada;
        $dadosBndes->txt_sintese_da_situacao_atual_do_projeto = $request->txt_sintese_da_situacao_atual_do_projeto;
        $dadosBndes->dte_atualizacao_sintese_atual_do_projeto = Date("Y-m-d h:i:s");
        $salvoComSucesso = $dadosBndes->save();

        $dadosTabContratoPac = ContratosPac::where('cod_contrato_pac', $dadosBndes->cod_saci)->firstOrFail();

        //$dadosTabCOntratoPac

        if ($salvoComSucesso) {
            DB::commit();
            flash()->sucesso("Sucesso", "Dados do empreendimento atualizados com sucesso!");
            return back();
        } else {
            DB::rollBack();
            flash()->erro("Erro", "Não foi possível atualizar os dados do empreendimento.");
            return back();
        }
    }

    public function salvarMunBaneficiadoEmpreendimento(Request $request)
    {

        // return $request->all();

        $municipioBeneficiado = new RlcBndesMunicipios;
        $municipioBeneficiado->cod_bndes = $request->cod_bndes;
        $municipioBeneficiado->municipio_id = $request->municipioBeneficiado;

        $salvoComSucesso = $municipioBeneficiado->save();

        DB::beginTransaction();

        if ($salvoComSucesso) {
            DB::commit();
            flash()->sucesso("Sucesso", "Município adicionado com sucesso!");
            return back();
        } else {
            DB::rollBack();
            flash()->erro("Erro", "Não foi possível o Município.");
            return back();
        }
    }

    public function excluirMunicipioEmpreendimento($codigo)
    {

        $municipioBeneficiado = RlcBndesMunicipios::find($codigo);

        $cod_bndes = $municipioBeneficiado->cod_bndes;

        $deletouRegistro = $municipioBeneficiado->delete();

        if (!$deletouRegistro) {
            DB::rollBack();
            flash()->erro("Erro", "Não foi possível excluir o arquivo desejado.");
            return back();
        } else {
            DB::commit();
            flash()->sucesso("Sucesso", "Arquivo excluído com sucesso!");

            return redirect('bndes/empreendimento/dados/' . $cod_bndes);
        }
    }
}
