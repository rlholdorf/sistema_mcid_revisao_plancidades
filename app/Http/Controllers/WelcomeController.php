<?php

namespace App\Http\Controllers;

use App\ConfiguracaoSistema;
use App\Corporativo\Mcid_carteira_investimento\ViewResumoSecretariaOrigem;
use App\Corporativo\Mcid_carteira_investimento\ViewResumoSituacaoContrato;
use App\Corporativo\Mcid_carteira_investimento\ViewResumoTipoInstrumentoOrigem;
use App\DadosPaineis;
use App\Mod_saci\mod_ibge\Municipio;
use App\Mod_saci\mod_ibge\Uf;
use App\Propostas\Selecao;
use App\Propostas\ViewPropostasCadastradas;
use App\Propostas\ViewPropostasSelecionadas;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {

        $manutencao = false;
        if ($manutencao) {
            // Auth::logout();
            return view('errors.manutencao');
        }

        $configuracao = ConfiguracaoSistema::where('txt_formulario', 'modulo_sistema.ente_publico.CadastrarEnte')->firstOrFail();

        $dataAtual = date("Y-m-d");


        $mensagem = "Prezados, Gostaríamos de informar que a nossa Coordenação passou por uma mudança de localização para proporcionar um melhor atendimento e serviços a vocês.  Caso precisem entrar em contato favor ligar para os telefones 61-20344912/61-20344913 ou enviar email para cadastramento.mcid@mdr.gov.br.  Agradecemos pela compreensão e colaboração.";

        //    flash()->confirma("Mudança de Prédio",$mensagem );   

        $wherePainel = [];
        $wherePainel[] = ['bln_ativo', true];
        $wherePainel[] = ['bln_acesso_externo', true];

        $dadosPaineis = DadosPaineis::where($wherePainel)->get();

        $resumoTipoInstrumento = ViewResumoTipoInstrumentoOrigem::get();
        $resumoSecretaria = ViewResumoSecretariaOrigem::get();
        $resumoSituacaoContrato = ViewResumoSituacaoContrato::get();

        return view('welcome', compact('configuracao', 'dataAtual', 'dadosPaineis', 'resumoTipoInstrumento', 'resumoSecretaria', 'resumoSituacaoContrato'));
    }



    public function solicitarCadastro()
    {

        $configuracao = ConfiguracaoSistema::where('txt_formulario', 'modulo_sistema.ente_publico.CadastrarEnte')->firstOrFail();

        $dataAtual = date("Y-m-d");


        if ($configuracao->dte_termino_funcionalidade < $dataAtual) {
            flash()->info("Prazo encerrado", "Prazo para cadastramento de propostas encerrado.");
            return redirect('/');
        }

        return view('modulo_sistema.ente_publico.CadastrarEnte');
    }

    public function dadosAbertos()
    {
        return view('modulo_sistema.gerais.dados_abertos.politica_dados_abertos');
    }

    public function dadosAbertosSNH()
    {
        return view('modulo_sistema.gerais.dados_abertos.dados_abertos_sistema');
    }

    public function paineisInternos()
    {

        $dadosPaineis = DadosPaineis::where('bln_ativo', true)->get();

        return view('modulo_sistema.gerais.paineis.paineis_internos', compact('dadosPaineis'));
    }

    public function painelVisualizar($idPainel)
    {

        $dadosPainel = DadosPaineis::find($idPainel);

        return view('modulo_sistema.gerais.paineis.dados_painel', compact('dadosPainel'));
    }

    public function consultarPropostasSelecionadas()
    {

        return view('modulo_propostas.proposta.ConsultarPropostasSelecionadas');
    }


    public function pesquisarPropostasSelecionadas(Request $request)
    {

        $where = [];

        $where[] = ['situacao_proposta_id', 5];

        //return $request->all();


        if ($request->estado) {
            $where[] = ['id_uf', $request->estado];
        }

        if ($request->municipio) {
            $where[] = ['municipio_id', $request->municipio];
        }

        if ($request->entepublico) {
            $where[] = ['ente_publico_id', str_pad($request->entepublico, 14, "0", STR_PAD_LEFT)];
        }

        $propostas = ViewPropostasSelecionadas::where($where)->get();

        if (count($propostas) == 0) {
            flash()->erro("Erro", "Não existem propostas para os parâmetros selecionados.");
            return back();
        }


        return view('modulo_propostas.proposta.ListaPropostasSelecionadas', compact('propostas'));
    }

    public function pesquisarPropostasCadastradas(Request $request)
    {


        $where = [];

        // return $request->all();

        $subtitulo1 = null;
        if ($request->estado) {
            $where[] = ['id_uf', $request->estado];
            $estado = Uf::where($where)->first();
            $subtitulo1 = $estado->ds_uf;
        }

        if ($request->municipio) {
            $where[] = ['municipio_id', $request->municipio];
            $municipio = Municipio::where('id_municipio', $request->municipio)->first();
            $subtitulo1 = $municipio->ds_municipio . '-' . $estado->sg_uf;
        }

        $subtitulo2 = null;
        if ($request->selecao) {
            $where[] = ['selecao_id', $request->selecao];
            $selecao = Selecao::find($request->selecao);
            if ($subtitulo1) {
                $subtitulo2 = $selecao->txt_selecao;
            } else {
                $subtitulo1 = $selecao->txt_selecao;
            }
        }

        if ($request->situacaoProposta) {

            $where[] = ['situacao_proposta_id', $request->situacaoProposta];
        }



        $propostas = ViewPropostasCadastradas::where($where)->get();

        if (count($propostas) == 0) {
            flash()->erro("Erro", "Não existem propostas para os parâmetros selecionados.");
            return back();
        }


        return view('modulo_propostas.proposta.ListaPropostasPublicidade', compact('propostas', 'subtitulo1', 'subtitulo2'));
    }
}
