<?php

namespace App\Http\Controllers\Mod_apis;


use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Mod_apis\AcompanhamentoDebentures;
use App\Mod_apis\EmissaoDebentures;
use App\Mod_apis\ModalidadeProjeto;
use App\Mod_apis\ProjetosDebentures;
use App\Mod_apis\RlcCondicoesEmissao;
use App\Mod_apis\RlcGrupoControladorDebentures;
use App\Mod_apis\RlcMunicipiosBeneficiadosDebentures;
use App\Mod_apis\RlcTitularDebentures;
use App\Mod_apis\SituacaoAnalise;
use App\Mod_apis\SituacaoConjur;
use App\Mod_apis\SituacaoEmissao;
use App\Mod_apis\SituacaoEnquadramento;
use App\Mod_apis\SituacaoEnvioPublicacao;
use App\Mod_apis\SituacaoExecucao;
use App\Mod_apis\SituacaoPublicacaoPortaria;
use App\Mod_apis\ViewEmissaoDebentures;
use App\Mod_apis\ViewMunicipiosBeneficiadosDebentures;
use App\Mod_apis\ViewProjetosDebentures;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProjetosDebenturesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function adicionarProjetos()
    {

        return view('modulo_apis.adicionar_projeto');
    }

    public function consultarProjetos()
    {

        return view('modulo_apis.consultar_projetos');
    }

    public function pesquisarProjetos(Request $request)
    {

        $projetosCadastrados = ViewProjetosDebentures::selectRaw('count(projeto_debenture_id) AS num_propostas,
                                                                    sum(vlr_investimento_projeto) AS vlr_investimento_projeto,
                                                                    sum(vlr_debentures) AS vlr_debentures,
                                                                    sum(num_populacao_beneficiada) AS num_populacao_beneficiada,
                                                                    sum(vlr_captado) AS vlr_captado,
                                                                    sum(vlr_saldo_a_emitir) AS vlr_saldo_a_emitir
                                                                    
                                                                    ')->first();


        $where = [];
        $subtitulos = [];

        if ($request->modalidade_projeto) {
            $where[] = ['modalidade_projeto_id', $request->modalidade_projeto];

            $modalidade = ModalidadeProjeto::find($request->modalidade_projeto);
            array_push($subtitulos, 'Modalidade: ' . $modalidade->txt_modalidade_projeto);
        }

        if ($request->situacao_analise) {
            $where[] = ['situacao_analise_id', $request->situacao_analise];
            $situacao_analise = SituacaoAnalise::find($request->situacao_analise);
            array_push($subtitulos, 'Situação Análise: ' . $situacao_analise->txt_situacao_analise);
        }

        if ($request->situacao_envio_publicacao) {
            $where[] = ['situacao_envio_publicacao_id', $request->situacao_envio_publicacao];
            $situacao_envio_publicacao = SituacaoEnvioPublicacao::find($request->situacao_envio_publicacao);
            array_push($subtitulos, 'Situação Envio Publicação: ' . $situacao_envio_publicacao->txt_situacao_envio_publicacao);
        }

        if ($request->situacao_publicacao) {
            $where[] = ['situacao_publicacao_portaria_id', $request->situacao_publicacao];
            $situacao_publicacao = SituacaoPublicacaoPortaria::find($request->situacao_publicacao);
            array_push($subtitulos, 'Situação Publicação: ' . $situacao_publicacao->txt_situacao_publicacao_portaria);
        }



        if ($request->situacao_conjur) {
            $where[] = ['situacao_conjur_id', $request->situacao_conjur];
            $situacao_conjur = SituacaoConjur::find($request->situacao_conjur);
            array_push($subtitulos, 'Situação Concjur: ' . $situacao_conjur->txt_situacao_conjur);
        }

        if ($request->situacao_emissao) {
            $where[] = ['situacao_emissao_id', $request->situacao_emissao];
            $situacao_emissao = SituacaoEmissao::find($request->situacao_emissao);
            array_push($subtitulos, 'Situação Emissão: ' . $situacao_emissao->txt_situacao_emissao);
        }

        if ($request->situacao_enquadramento) {
            $where[] = ['situacao_enquadramento_id', $request->situacao_enquadramento];
            $situacao_enquadramento = SituacaoEnquadramento::find($request->situacao_enquadramento);
            array_push($subtitulos, 'Situação Enquadramento: ' . $situacao_enquadramento->txt_situacao_enquadramento);
        }

        if ($request->situacao_execucao) {
            $where[] = ['situacao_execucao_id', $request->situacao_execucao];
            $situacao_execucao = SituacaoExecucao::find($request->situacao_execucao);
            array_push($subtitulos, 'Situação Execução: ' . $situacao_execucao->txt_situacao_execucao);
        }


        $projetosDebentures = ViewProjetosDebentures::where($where)->get();

        if (count($projetosDebentures) == 0) {
            flash()->info('Informação', "Não existem projetos para os parâmetros selecionados.");
            return back();
        }

        //return $subtitulos;
        return view('modulo_apis.Lista_projetos', compact('projetosDebentures', 'subtitulos', 'projetosCadastrados'));
    }

    public function showProjeto($projetosDebenturesId)
    {

       return  $projetoDebenture = ViewProjetosDebentures::where('projeto_debenture_id', $projetosDebenturesId)->first();

        $grupoControlador = RlcGrupoControladorDebentures::where('projeto_debenture_id', $projetosDebenturesId)->orderBy('bln_atual', 'DESC')->get();
        $grupoControlador->load('concessionaria.tipoConcessionaria');

        $titularProjeto = RlcTitularDebentures::where('projeto_debenture_id', $projetosDebenturesId)->orderBy('bln_atual', 'DESC')->get();
        $titularProjeto->load('concessionaria.tipoConcessionaria');

        $municipiosBeneficiados = ViewMunicipiosBeneficiadosDebentures::where('projeto_debenture_id', $projetosDebenturesId)->get();

        $emissaoDebentures = ViewEmissaoDebentures::where('projeto_debenture_id', $projetosDebenturesId)->first();

        if (!empty($emissaoDebentures)) {
            $condicoesEmissao = RlcCondicoesEmissao::where('emissao_debenture_id', $emissaoDebentures->emissao_debenture_id)->get();
        } else {
            $condicoesEmissao = null;
        }


        $acompanhamento = AcompanhamentoDebentures::where('projeto_debenture_id', $projetosDebenturesId)->orderby('created_at', 'DESC')->get();
        $acompanhamento->load('usuario');
        return view('modulo_apis.dados_projeto', compact(
            'projetoDebenture',
            'grupoControlador',
            'titularProjeto',
            'municipiosBeneficiados',
            'emissaoDebentures',
            'condicoesEmissao',
            'acompanhamento'
        ));
    }

    public function cadastrarAcompanhamento(Request $request)
    {

        // return $request->all();

        DB::beginTransaction();

        $acompanhamento = new AcompanhamentoDebentures;
        $acompanhamento->projeto_debenture_id = $request->projeto_debenture_id;
        $acompanhamento->dsc_acompanhamento = $request->dsc_acompanhamento;
        $acompanhamento->user_id = Auth::user()->id;
        $acompanhamento->created_at = Date('Y-m-d h:m:s');
        $salvoAcompanhamento = $acompanhamento->save();

        if ($salvoAcompanhamento) {
            DB::commit();
            flash()->sucesso("Sucesso", "Acompanhamento cadastrado com sucesso!");
            return redirect()->back();
        } else {
            DB::rollBack();
            flash()->erro("Erro", "Não foi possível cadastrar o acompanhamento.");
            return back();
        }
    }

    public function excluirAcompanhamento($acompanhamentoId)
    {

        // return $request->all();

        DB::beginTransaction();

        $acompanhamento = AcompanhamentoDebentures::find($acompanhamentoId);

        $deleteAcompanhamento = $acompanhamento->delete();

        if ($deleteAcompanhamento) {
            DB::commit();
            flash()->sucesso("Sucesso", "Acompanhamento deletado com sucesso!");
            return redirect()->back();
        } else {
            DB::rollBack();
            flash()->erro("Erro", "Não foi possível deletar o acompanhamento.");
            return back();
        }
    }

    public function cadastrarEmissao(Request $request)
    {

        //return $request->all();

        DB::beginTransaction();

        $emissao = new EmissaoDebentures;
        $emissao->projeto_debenture_id = $request->projeto_debenture_id;
        $emissao->situacao_emissao_id = $request->situacao_emissao;
        $emissao->dte_emissao = $request->dte_emissao;
        $data = new DateTime($request->dte_emissao);
        $emissao->num_ano_emissao = $data->format('Y');
        $emissao->dte_distribuicao = $request->dte_distribuicao;
        $emissao->dte_encerramento_oferta_publica = $request->dte_encerramento_oferta_publica;
        $emissao->vlr_captado = floatval($request->vlr_captado);
        $emissao->agente_fiduciario_id = $request->agente_fiduciario;
        $emissao->created_at = Date('Y-m-d h:m:s');

        $salvaEmissao = $emissao->save();

        $projetoDebenture = ProjetosDebentures::find($request->projeto_debenture_id);
        $projetoDebenture->situacao_emissao_id = $request->situacao_emissao;
        $updateEmissao = $projetoDebenture->update();

        if ($salvaEmissao && $updateEmissao) {
            DB::commit();
            flash()->sucesso("Sucesso", "Emissão cadastrada com sucesso!");
            return redirect()->back();
        } else {
            DB::rollBack();
            flash()->erro("Erro", "Não foi possível cadastrar a emissão.");
            return back();
        }
    }
    public function cadastrarCondicaoEmissao(Request $request)
    {

        // return $request->all();

        DB::beginTransaction();

        $condicaoEmissao = new RlcCondicoesEmissao;
        $condicaoEmissao->emissao_debenture_id = $request->emissao_debenture_id;
        $condicaoEmissao->num_emissao = $request->num_emissao;

        if ($request->bln_serie_unica == 1) {
            $condicaoEmissao->bln_serie_unica = true;
        } else {
            $condicaoEmissao->bln_serie_unica = false;
        }

        $condicaoEmissao->num_serie_emissao = $request->num_serie_emissao;
        $condicaoEmissao->txt_observacao_serie = $request->txt_observacao_serie;
        $condicaoEmissao->vlr_emissao = floatval($request->vlr_emissao);
        $condicaoEmissao->vlr_captado = floatval($request->vlr_captado);
        $condicaoEmissao->vlr_unitario = floatval($request->vlr_unitario);
        $condicaoEmissao->dte_vencimento = $request->dte_vencimento;
        $condicaoEmissao->txt_taxa = $request->txt_taxa;
        $condicaoEmissao->num_prazo_meses = floatval($request->num_prazo_meses);
        $condicaoEmissao->num_duracao_anos = floatval($request->num_duracao_anos);
        $condicaoEmissao->num_cvm = $request->num_cvm;
        $salvaCondicaoEmissao = $condicaoEmissao->save();

        if ($salvaCondicaoEmissao) {
            DB::commit();
            flash()->sucesso("Sucesso", "Condição da emissão cadastrada com sucesso!");
            return redirect()->back();
        } else {
            DB::rollBack();
            flash()->erro("Erro", "Não foi possível cadastrar a condição da emissão.");
            return back();
        }
    }

    public function editarDadosProjeto($projetoDebentureId)
    {

        $projetoDebenture = ViewProjetosDebentures::where('projeto_debenture_id', $projetoDebentureId)->first();
        return view('modulo_apis.editar_dados_projeto', compact('projetoDebenture'));
    }

    public function atualizarDadosProjeto(Request $request)
    {

        //return $request->all();

        DB::beginTransaction();

        $projetoDebenture = ProjetosDebentures::find($request->projeto_debenture_id);
        $projetoDebenture->vlr_debentures = floatval($request->vlr_debentures);
        $projetoDebenture->vlr_fdic = floatval($request->vlr_fdic);
        $projetoDebenture->vlr_cri = floatval($request->vlr_cri);
        $projetoDebenture->vlr_recursos_proprios = floatval($request->vlr_recursos_proprios);
        $projetoDebenture->vlr_outras_fontes = floatval($request->vlr_outras_fontes);
        $updateProjetoDebenture = $projetoDebenture->update();

        if ($updateProjetoDebenture) {
            DB::commit();
            flash()->sucesso("Sucesso", "Projeto atualizado com sucesso!");
            return redirect()->back();
        } else {
            DB::rollBack();
            flash()->erro("Erro", "Não foi possível atualizar o projeto.");
            return back();
        }
    }

    public function editarEnquadramento($projetoDebentureId)
    {

        $projetoDebenture = ViewProjetosDebentures::where('projeto_debenture_id', $projetoDebentureId)->first();
        return view('modulo_apis.editar_enquadramento', compact('projetoDebenture'));
    }

    public function atualizarEnquadramento(Request $request)
    {

        //return $request->all();

        DB::beginTransaction();

        $projetoDebenture = ProjetosDebentures::find($request->projeto_debenture_id);
        $projetoDebenture->situacao_analise_id = $request->situacao_analise;
        $projetoDebenture->dte_enquadranento_dfin = $request->dte_enquadranento_dfin;
        $projetoDebenture->dte_emissao_enquadramento_sns = $request->dte_emissao_enquadramento_sns;
        $projetoDebenture->situacao_enquadramento_id = $request->situacao_enquadramento;
        $projetoDebenture->txt_motivo_nao_enquadramento = $request->txt_motivo_nao_enquadramento;
        $projetoDebenture->situacao_conjur_id = $request->situacao_conjur;
        $projetoDebenture->dte_aprovacao_conjur = $request->dte_aprovacao_conjur;
        $projetoDebenture->situacao_enquadramento_id = $request->situacao_enquadramento;
        $projetoDebenture->situacao_envio_publicacao_id = $request->situacao_envio_publicacao;
        $projetoDebenture->situacao_publicacao_portaria_id = $request->situacao_publicacao;
        $projetoDebenture->dte_publicacao_portaria = $request->dte_publicacao_portaria;
        $projetoDebenture->txt_portaria_aprovacao = $request->txt_portaria_aprovacao;

        $updateProjetoDebenture = $projetoDebenture->update();

        if ($updateProjetoDebenture) {
            DB::commit();
            flash()->sucesso("Sucesso", "Enquadramento atualizado com sucesso!");
            return redirect()->back();
        } else {
            DB::rollBack();
            flash()->erro("Erro", "Não foi possível atualizar o enquadramento.");
            return back();
        }
    }

    public function editarEmissao($emissaoId)
    {


        $emissaoDebentures = ViewEmissaoDebentures::where('emissao_debenture_id', $emissaoId)->first();

        $projetoDebenture = ViewProjetosDebentures::where('projeto_debenture_id', $emissaoDebentures->projeto_debenture_id)->first();

        if (!empty($emissaoDebentures)) {
            $condicoesEmissao = RlcCondicoesEmissao::where('emissao_debenture_id', $emissaoDebentures->emissao_debenture_id)->get();
        } else {
            $condicoesEmissao = null;
        }
        return view('modulo_apis.editar_emissao', compact('projetoDebenture', 'emissaoDebentures', 'condicoesEmissao'));
    }

    public function atualizarEmissao(Request $request)
    {

        // return $request->all();

        DB::beginTransaction();

        $emissao = EmissaoDebentures::find($request->emissao_debenture_id);
        $emissao->dte_emissao = $request->dte_emissao;
        $data = new DateTime($request->dte_emissao);
        $emissao->num_ano_emissao = $data->format('Y');
        $emissao->dte_distribuicao = $request->dte_distribuicao;
        $emissao->dte_encerramento_oferta_publica = $request->dte_encerramento_oferta_publica;
        $emissao->vlr_captado = floatval($request->vlr_captado);
        $emissao->agente_fiduciario_id = $request->agente_fiduciario;


        $updateEmissao = $emissao->update();

        if ($updateEmissao) {
            DB::commit();
            flash()->sucesso("Sucesso", "Emissão atualizada com sucesso!");
            return redirect()->back();
        } else {
            DB::rollBack();
            flash()->erro("Erro", "Não foi possível atualizada a emissão.");
            return back();
        }
    }

    public function editarCondicaoEmissao($condicaoEmissao)
    {


        $condicoesEmissao = RlcCondicoesEmissao::where('id', $condicaoEmissao)->first();



        return view('modulo_apis.editar_condicao_emissao', compact('condicoesEmissao'));
    }

    public function atualizarCondicaoEmissao(Request $request)
    {

        // return $request->all();

        DB::beginTransaction();

        $condicaoEmissao = RlcCondicoesEmissao::find($request->condicao_emissao_id);

        $condicaoEmissao->num_emissao = $request->num_emissao;

        if ($request->bln_serie_unica == 1) {
            $condicaoEmissao->bln_serie_unica = true;
        } else {
            $condicaoEmissao->bln_serie_unica = false;
        }

        $condicaoEmissao->num_serie_emissao = $request->num_serie_emissao;
        $condicaoEmissao->txt_observacao_serie = $request->txt_observacao_serie;
        $condicaoEmissao->vlr_emissao = floatval($request->vlr_emissao);
        $condicaoEmissao->vlr_captado = floatval($request->vlr_captado);
        $condicaoEmissao->vlr_unitario = floatval($request->vlr_unitario);
        $condicaoEmissao->dte_vencimento = $request->dte_vencimento;
        $condicaoEmissao->txt_taxa = $request->txt_taxa;
        $condicaoEmissao->num_prazo_meses = floatval($request->num_prazo_meses);
        $condicaoEmissao->num_duracao_anos = floatval($request->num_duracao_anos);
        $condicaoEmissao->num_cvm = $request->num_cvm;
        $updateCondicaoEmissao = $condicaoEmissao->update();

        if ($updateCondicaoEmissao) {
            DB::commit();
            flash()->sucesso("Sucesso", "Condição da emissão atualizada com sucesso!");
            return redirect()->back();
        } else {
            DB::rollBack();
            flash()->erro("Erro", "Não foi possível atualizar a condição da emissão.");
            return back();
        }
    }

    public function excluirCondicaoEmissao($condicaoId)
    {
        DB::beginTransaction();

        $condicaoEmissao = RlcCondicoesEmissao::find($condicaoId);

        $deleteCondicaoEmissao = $condicaoEmissao->delete();

        if ($deleteCondicaoEmissao) {
            DB::commit();
            flash()->sucesso("Sucesso", "Condição da emissão deletada com sucesso!");
            return redirect()->back();
        } else {
            DB::rollBack();
            flash()->erro("Erro", "Não foi possível deletar a condição da emissão.");
            return back();
        }
    }

    public function editarMunicipios($projetoDebentures)
    {


        $municipiosBeneficiados = ViewMunicipiosBeneficiadosDebentures::where('projeto_debenture_id', $projetoDebentures)->get();
        $projetoDebenture = ViewProjetosDebentures::where('projeto_debenture_id', $projetoDebentures)->first();



        return view('modulo_apis.editar_municipios', compact('projetoDebenture', 'municipiosBeneficiados'));
    }

    public function adicionarMunicipiosBeneficiados(Request $request)
    {
        //return $request->all();
        DB::beginTransaction();

        return $municipiosBeneficiados = $request->municipiosBeneficiados;

        foreach ($municipiosBeneficiados as $item) {

            $salvouMunicipioBeneficiado = RlcMunicipiosBeneficiadosDebentures::salvarMunicipioBeneficiado($request->projeto_debenture_id, $item);
        }

        if (!$salvouMunicipioBeneficiado) {
            DB::rollBack();
            flash()->erro("Erro", "Não foi possível adicionar os municípios.");
            return back();
        } else {

            DB::commit();
            flash()->sucesso("Sucesso", "Municípios adicionaos com sucesso!");
            return redirect()->back();
        }
    }

    public function excluirMunicipios($municipioBeneficiadoId)
    {

        DB::beginTransaction();

        $municipiosBeneficiados = RlcMunicipiosBeneficiadosDebentures::find($municipioBeneficiadoId);

        $deleteCondicaoEmissao = $municipiosBeneficiados->delete();

        if ($deleteCondicaoEmissao) {
            DB::commit();
            flash()->sucesso("Sucesso", "Condição da emissão deletada com sucesso!");
            return redirect()->back();
        } else {
            DB::rollBack();
            flash()->erro("Erro", "Não foi possível deletar a condição da emissão.");
            return back();
        }
    }
}