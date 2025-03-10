<?php

namespace App\Http\Controllers\Sistema;

use App\Http\Controllers\Controller;

use App\ConfiguracaoSistema;
use App\DadosPaineis;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class DadosPaineisController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('redirecionar');
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

        $dadosPaineis = DadosPaineis::where('bln_ativo', true)->get();

        /*
        if($configuracao->dte_termino_funcionalidade > $dataAtual){    
             flash()->confirma("Prorrogação", "O Programa 2222 - Saneamento Básico</span>, que visa reduzir as desigualdades e promover a inclusão social, promover o acesso aos serviços básicos e equipamentos sociais, proporcionar melhoria nas condições urbanas da população no que se refere à acessibilidade e à mobilidade, promover o desenvolvimento sustentável com a mitigação dos custos ambientais e socioeconômicos dos deslocamentos de pessoas e cargas nas cidades, e consolidar a gestão democrática como instrumento e garantia da construção contínua do aprimoramento da mobilidade urbana, terá seu cronograma para cadastramento de propostas prorrogado até 08/09/2023.",'info'); 
    
       }
*/

        return view('welcome', compact('configuracao', 'dataAtual', 'dadosPaineis'));
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

    public function listaPaineis()
    {

        $dadosPainel = DadosPaineis::orderBy('txt_nome_painel')->get();

        return view('modulo_sistema.admin.paineis.lista_painel', compact('dadosPainel'));
    }

    public function configuracaoPainel($painelId)
    {
        $dadosPainel = DadosPaineis::find($painelId);

        return view('modulo_sistema.admin.paineis.configuracao_painel', compact('dadosPainel'));
    }
}