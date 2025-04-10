<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Http\Controllers\Mod_plancidades\MonitoramentoProjetoController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {

        return view('welcome');
});


Auth::routes();

Route::get('/', 'WelcomeController@index');


Route::get('/home', 'HomeController@index')->name('home');
Route::post('/registrar', 'UsuariosController@cadastrar_usuario')->name('registrar');
Route::post('/atualizarUsuario', 'UsuariosController@atualizar_usuario')->name('atualizarUsuario');





Route::get('/usuario/perfil/', 'UsuarioController@perfilUsuario')->name('perfilUsuario');

Route::get('/usuario/primeiro_acesso', 'UsuariosController@primeiro_acesso');
Route::post('/usuario/update/primeiro_acesso', 'UsuariosController@updateUsuarioPrimeiroAcesso');
Route::get('/usuario/termo_responsabilidade', 'UsuariosController@abrirTermo');
Route::post('/usuario/termo_responsabilidade/aceite', 'UsuariosController@aceiteTermo');

Route::get('/ente_publico/usuario/dados', 'UsuariosController@dadosUsuarioEnte');



//ente publico
Route::get('/proposta/ente_publico/cadastro', 'WelcomeController@solicitarCadastro');
Route::post('/proposta/ente_publico/salvar', 'Sistema\EntePublicoController@salvarEntePublico');

Route::get('/ente_publico/usuario/{usuario}', 'Sistema\EntePublicoController@dadosUsuarioEntePublico');

Route::get('/ente_publico/dados', 'Sistema\EntePublicoController@dadosEnte');

Route::get('/ente_publico/usuarios/propostas', 'Sistema\EntePublicoController@acessoDadosPropostasUserNaoAtivo');








Route::post('/selecao/ente_publico/consulta', 'Sistema\EntePublicoController@consultaEntePublico');
Route::get('/ente_publico/propostas/{cpfUsuario}/{entePublicoId}', 'Sistema\EntePublicoController@entePublicoPropostas');

Route::post('/ente_publico/oficio/enviar', 'Sistema\EntePublicoController@enviarOficioEntePublico');
Route::post('/ente_publico/oficio/reenviar', 'Sistema\EntePublicoController@reenviarOficioEntePublico');






//modulo propostas
Route::post('/proposta/cadastrar/selecao/{selecao}', 'Propostas\PropostaController@cadastrarProposta');
Route::get('/usuario/{user}/proposta/{proposta}', 'Propostas\PropostaController@dadosProposta');
Route::get('/usuario/{userProp}/{userLog}/proposta/excluir/{proposta}', 'Propostas\PropostaController@excluirProposta');
Route::get('/selecao/proposta/excluir/{proposta}', 'Propostas\SelecaoController@excluirProposta');

Route::get('/selecao/propostas/relatorios/propostas_uf', 'Propostas\SelecaoController@relPropostasUf');




//selecao
Route::get('/selecao/ente_publico/propostas', 'Propostas\SelecaoController@listaPropostas');
Route::get('/selecao/proposta/{proposta}', 'Propostas\SelecaoController@dadosProposta');
Route::get('/selecao/andamento', 'Propostas\SelecaoController@selecoesAndamento');

Route::get('/admin/selecao/proposta/{proposta}', 'Propostas\SelecaoController@dadosPropostaAdmin');
Route::get('/admin/proposta/cancelar/{propostas}', 'Propostas\SelecaoController@cancelarPropostaAdmin');

Route::get('/selecao/propostas/consultar', 'Propostas\SelecaoController@consultarPropostas');
Route::post('/selecao/propostas/pesquisar', 'Propostas\SelecaoController@pesquisarPropostas');

Route::get('/selecao/resultados/consultar', 'Propostas\SelecaoController@consultarResultados');
Route::get('/selecao/resultado/arquivo/{arquivo}', 'Propostas\SelecaoController@listaResultado');
Route::post('/selecao/resultados/pesquisar', 'Propostas\SelecaoController@pesquisarResultado');
Route::get('/selecao/propostas/selecionadas/consultar', 'WelcomeController@consultarPropostasSelecionadas');
Route::post('/selecao/propostas/selecionadas/pesquisar', 'WelcomeController@pesquisarPropostasSelecionadas');

Route::get('/selecao/propostas/cadastradas/consultar', 'WelcomeController@consultarPropostasCadastradas');
Route::post('/selecao/propostas/cadastradas/pesquisar', 'WelcomeController@pesquisarPropostasCadastradas');

Route::get('/admin/propostas/selecionadas/consultar', 'Propostas\SelecaoController@consultarPropostasSelecionadas');
Route::post('/admin/propostas/selecionadas/pesquisar', 'Propostas\SelecaoController@pesquisarPropostasSelecionadas');

Route::get('/admin/propostas/selecionadas/lista/{selecaoPropostas}', 'Propostas\SelecaoController@listaPropostasSelecionadas');
Route::post('/admin/proposta/selecionada/adicionar/', 'Propostas\SelecaoController@adicionarProposta');
Route::get('/admin/proposta/selecionada/excluir/{selecaoPropostas}', 'Propostas\SelecaoController@excluirPropostaSelecionada');

Route::post('/admin/proposta/selecao/concluir/', 'Propostas\SelecaoController@concluirSelecao');

Route::get('/admin/proposta/selecionada/excluir/lista/{selecaoPropostas}', 'Propostas\SelecaoController@excluirSelecaoProposta');


Route::post('/admin/proposta/correcao/salvar', 'Propostas\SelecaoController@corrigirProposta');

Route::post('/admin/proposta/transferegov/visualizar/', 'Propostas\SelecaoController@pesquisarProponenteTransferegov');

Route::post('/admin/proposta/transferegov/adicionar', 'Propostas\SelecaoController@adicionarProposta');




Route::get('/admin/selecao/propostas/selecionar', 'Propostas\SelecaoController@selecionarPropostas');
Route::get('/admin/selecao/propostas/selecionar/nova', 'Propostas\SelecaoController@novaSelecaoPropostas');

Route::post('/proposta/transferegov/salvar', 'Propostas\SelecaoController@salvarDadosTransferegov');
Route::get('/proposta/transferegov/excluir/{proposta}', 'Propostas\SelecaoController@excluirPropostaTransferegov');


Route::get('/admin/selecao/propostas/transferegov', 'Propostas\SelecaoController@consultarPropostasTransferegov');
Route::post('/admin/propostas/transferegov/pesquisar', 'Propostas\SelecaoController@pesquisarPropostasTransferegov');

Route::get('/admin/transferegov/execucao_orcamentaria/consultar', 'Propostas\SelecaoController@consultarExecucaoTransferegov');
Route::post('/admin/transferegov/execucao_orcamentaria/pesquisar', 'Propostas\SelecaoController@pesquisarExecucaoTransferegov');

Route::get('/admin/transferegov/rps/consultar', 'Propostas\SelecaoController@consultarPropostasRps');
Route::post('/admin/transferegov/rps/pesquisar', 'Propostas\SelecaoController@pesquisarPropostasRps');






//modulo carteira investimento

Route::get('/carteira_investimento/contratos/consultar/', 'Mod_carteira_investimento\CarteiraInvestimentoController@consultarContratos');

Route::get('/carteira_investimento/contratos/pesquisar/', 'Mod_carteira_investimento\CarteiraInvestimentoController@pesquisarContratos');

Route::post('/carteira_investimento/contrato/cod_contrato', 'Mod_carteira_investimento\CarteiraInvestimentoController@dadosContrato');
Route::post('/carteira_investimento/contrato/cod_saci', 'Mod_carteira_investimento\CarteiraInvestimentoController@dadosContrato');
Route::post('/carteira_investimento/contrato/cod_tci', 'Mod_carteira_investimento\CarteiraInvestimentoController@dadosContrato');
Route::get('/carteira_investimento/contrato_tci/cod_tci/{codigo}', 'Mod_carteira_investimento\CarteiraInvestimentoController@dadosContratoTCI');

Route::get('/carteira_investimento/contrato/{cod_contrato}', 'Mod_carteira_investimento\CarteiraInvestimentoController@visualizarContrato');
Route::get('/carteira_investimento/convenio/{num_convenio}', 'Mod_carteira_investimento\CarteiraInvestimentoController@visualizarConvenio');

Route::get('/carteira_investimento/constratos/secretarias/nao_informadas', 'Mod_carteira_investimento\CarteiraInvestimentoController@visualizarContratosSecretariasNulo');

Route::post('/carteira_investimento/secretaria/update', 'Mod_carteira_investimento\CarteiraInvestimentoController@updateSecretaria');




////briefing

Route::get('/briefing/ficha_briefing/consultar/', 'Mod_briefing\BriefingCarteiraInvestimentoController@consultarFicha');
Route::post('/briefing/ficha_briefing/pesquisar/', 'Mod_briefing\BriefingCarteiraInvestimentoController@pesquisarFicha');
Route::get('/briefing/contrato_repasse/municipio/{municipio}', 'Mod_briefing\BriefingCarteiraInvestimentoController@listaContratoRepasse');






//modulo MCMV

Route::post('/proposta/mcmv/salvar', 'Propostas\PropostaController@salvarPropostaMcmv');


//modulo semob

Route::post('/proposta/semob/salvar', 'Propostas\PropostaController@salvarPropostaSemob');
Route::post('/proposta/semob/editar', 'Propostas\PropostaController@editarPropostaSemob');



//modulo SNSA

Route::post('/proposta/snsa/salvar', 'Propostas\PropostaController@salvarPropostaSnsa');
Route::post('/proposta/snsa/editar', 'Propostas\PropostaController@editarPropostasnsa');

//modulo SNSA2018

Route::post('/proposta/snsa/2018/salvar', 'Propostas\PropostaController@salvarPropostaSnsa2018');


//modulo Sndum

Route::post('/proposta/sndum/salvar', 'Propostas\PropostaController@salvarPropostaSndum');
Route::post('/proposta/sndum/editar', 'Propostas\PropostaController@editarPropostaSndum');






////////////////////////ADMINISTRACAO DO SISTEMA//////////////////////////////////////

/////arquivos
Route::get('/admin/ente_publico/oficios/consultar', 'Sistema\ArquivosController@consultarOficiosEnte');
Route::post('/admin/ente_publico/oficios/pesquisar', 'Sistema\ArquivosController@pesquisarOficio');


Route::get('/admin/ente_publico/oficios/validar/{arquivo}', 'Sistema\ArquivosController@validarOficiosEnte');
Route::get('/admin/ente_publico/analise/oficios/{arquivo}', 'Sistema\ArquivosController@analiseOficiosEnte');



Route::get('/admin/listas_arquivos', 'Sistema\ArquivosController@listarArquivos');

Route::post('/admin/ente_publico/oficios/validar/salvar', 'Sistema\ArquivosController@salvarValidacaoOficio');


Route::get('/rp/arquivos/importar/rp8', 'Mod_resultado_primario\RP8Controller@importarArquivoPR8');
Route::post('/rp/arquivos/importar/rp8', 'Mod_resultado_primario\RP8Controller@importarDadosPR8');
Route::get('/rp/arquivo/validar/rp8/oficio/{oficio}', 'Mod_resultado_primario\RP8Controller@validarOficioRp8');
Route::get('/rp/arquivo/validar/registro/emenda/{emendaComissao}', 'Mod_resultado_primario\RP8Controller@validarEmendaComissao');
Route::get('/rp/arquivo/invalidar/registro/emenda/{emendaComissao}', 'Mod_resultado_primario\RP8Controller@invalidarEmendaComissao');

Route::get('/rp/arquivo/editar/registro/emenda/{emendaComissao}', 'Mod_resultado_primario\RP8Controller@editarEmendaComissao');
Route::post('/rp/arquivo/atualizar/registro/emenda', 'Mod_resultado_primario\RP8Controller@updateEmendaComissao');

Route::get('//rp/arquivo/editar/num_indicacao_congresso/emenda/{emendaComissao}', 'Mod_resultado_primario\RP8Controller@editarnumIndicacao');


Route::get('/rp/arquivo/gerar/arquivo/oficio/{oficio}', 'Mod_resultado_primario\RP8Controller@gerarArquivoHabilitacao');

Route::get('/rp/arquivo/validar/oficio/{oficio}', 'Mod_resultado_primario\OficioEmendasController@validarOficioEmenda');
Route::get('/rp/oficio/consultar', 'Mod_resultado_primario\OficioEmendasController@consultarOficio');
Route::post('/rp/oficio/pesquisar', 'Mod_resultado_primario\OficioEmendasController@pesquisarOficio');
Route::get('/rp/oficio/visualizar/{oficio}', 'Mod_resultado_primario\OficioEmendasController@visualizarOficio');

Route::get('/rp/rp8/validado/oficio/{oficio}', 'Mod_resultado_primario\OficioEmendasController@oficioValidadoRP8');
Route::post('/rp/oficio/atualizar', 'Mod_resultado_primario\OficioEmendasController@update');

Route::get('/rp/rp8/habiliacao/lote/oficio/{oficio}', 'Mod_resultado_primario\OficioEmendasController@exportarArquivoLoteRp8');






////PERMISSÕES


Route::get('/admin/modulo_sistema/validar/permissao/{permissao}', 'Sistema\PermissaoController@validarPermissao');

Route::get('/admin/usuario/permissao/{permissao}', 'Sistema\PermissaoController@dadosPermissao');





////////////////////////ADMINISTRACAO DO SISTEMA//////////////////////////////////////


//////usuarios

Route::get('/admin/usuarios/filtro', 'UsuariosController@filtroUsuarios');
Route::post('/admin/usuarios/pesquisar', 'UsuariosController@pesquisarUsuarios');
Route::get('/admin/usuario/{usuario}', 'UsuariosController@dadosUsuario');

///////paineis
Route::get('/admin/paineis/lista', 'Sistema\DadosPaineisController@listaPaineis');
Route::get('/admin/painel/show/{painel_id}', 'Sistema\DadosPaineisController@configuracaoPainel');






//////modulo ente publico////////
Route::get('/home_ente_publico', 'Mod_ente_publico\HomeEnteController@index')->name('home_ente_publico');




///// SACI WEB///////
Route::get('/home_saci', 'Mod_saci\HomeSaciController@index')->name('home_saci');

Route::get('/saci/painel', 'Mod_saci\Mod_saci\Pac\ContratosController@index');

Route::get('/saci/propostas/arquivo/abrir', 'Mod_saci\Pac\ContratosController@importarArquivo');
Route::post('/saci/propostas/arquivo/importar', 'Mod_saci\Pac\ContratosController@salvarDadosArquivo');
Route::post('/saci/propostas/arquivo/pesquisar', 'Mod_saci\Pac\ContratosController@pesquisarArquivos');
Route::get('/saci/propostas/arquivo/consultar', 'Mod_saci\Pac\ContratosController@consultarArquivos');
Route::get('/saci/propostas', 'Mod_saci\Pac\ContratosController@consultarRegistros');
Route::post('/saci/registros/pesquisar', 'Mod_saci\Pac\ContratosController@pesquisarRegistros');

Route::get('/saci/proposta/importada/{cod_arquivo}', 'Mod_saci\Pac\ContratosController@arquivoImportado');
Route::get('/saci/proposta/arquivo/excluir/{cod_arquivo}', 'Mod_saci\Pac\ContratosController@excluirArquivoImportado');

Route::post('/saci/propostas/arquivo/validar', 'Mod_saci\Pac\ContratosController@validarArquivo');
Route::post('/saci/propostas/arquivo/cancelar_validacao', 'Mod_saci\Pac\ContratosController@cancelarValidacao');
Route::post('/saci/propostas/salvar/', 'Mod_saci\Pac\ContratosController@salvarProposta');
Route::post('/saci/propostas/atualizar/', 'Mod_saci\Pac\ContratosController@atualizarProposta');
Route::get('/saci/contrato/{cod_arquivo_pac}', 'Mod_saci\Pac\ContratosController@dadosContrato');

Route::get('/saci/propostas/cadastro', 'Mod_saci\Pac\ContratosController@cadastroProposta');

Route::get('/saci/contratos/filtro', 'Mod_saci\Pac\ContratosController@filtroContratos');
Route::post('/saci/contratos/pesquisar', 'Mod_saci\Pac\ContratosController@PesquisarContratos');

Route::get('/saci/contrato/pac/{contrato}', 'Mod_saci\Pac\ContratosController@dadosContratoSaci');



///// SACI WEB///////


/////////módulo formulário/////////
Route::get('/home_formularios', 'Mod_formularios\HomeFormulariosController@index');

/////////módulo formulário/////////


/////////módulo bndes/////////
Route::get('/home_bndes', 'Mod_bndes\HomeBndesController@index');
Route::get('/bndes/empreendimentos/consultar', 'Mod_bndes\BndesController@consultarEmpreendimentos');
Route::post('/bndes/empreendimentos/pesquisar', 'Mod_bndes\BndesController@pesquisarEmpreendimentos');

Route::get('/bndes/empreendimento/dados/{cod_bndes}', 'Mod_bndes\BndesController@dadosEmpreendimento');
Route::post('/bndes/empreendimento/salvar', 'Mod_bndes\BndesController@salvarEmpreendimentos');
Route::post('/bndes/empreendimento/municipio_beneficiado/salvar', 'Mod_bndes\BndesController@salvarMunBaneficiadoEmpreendimento');

Route::get('/bndes/municipio/excluir/{cod_bndes}', 'Mod_bndes\BndesController@excluirMunicipioEmpreendimento');


//DADOS ABERTOS

Route::get('/dados_abertos/politica', 'WelcomeController@dadosAbertos');
Route::get('/dados_abertos', 'WelcomeController@dadosAbertosSNH');

//DADOS ABERTOS

//PAINÉIS INTERNOS

Route::get('/paineis/internos', 'Sistema\DadosPaineisController@paineisInternos');
Route::get('/painel/interno/visualizar/{DadosPaineis}', 'Sistema\DadosPaineisController@painelVisualizar');
Route::get('/painel/externo/visualizar/{DadosPaineis}', 'WelcomeController@painelVisualizar');


//PAINÉIS INTERNOS









/////////módulo bndes/////////


////módulo CODEM


Route::get('/codem/demanda/nova', 'Mod_codem\DemandaController@cadastrarDemanda');
Route::get('/codem/demanda/consultar', 'Mod_codem\DemandaController@consultarDemanda');
Route::post('/codem/demanda/pesquisar', 'Mod_codem\DemandaController@pesquisarDemanda');

Route::post('/codem/demanda/salvar', 'Mod_codem\DemandaController@salvarDemanda');
Route::post('/codem/demanda/atualizar', 'Mod_codem\DemandaController@atualizarDemanda');
Route::get('/codem/demanda/dados/{demanda}/{aba}', 'Mod_codem\DemandaController@abrirDemanda');
Route::get('/codem/demanda/minhas_demandas', 'Mod_codem\DemandaController@minhasDemandas');

Route::post('/codem/demanda/documento/novo', 'Mod_codem\DocumentosDemandaController@documentoNovo');
Route::post('/codem/demanda/documento/salvar', 'Mod_codem\DocumentosDemandaController@salvarDocumento');
Route::get('/codem/demanda/documento/excluir/{documento}', 'Mod_codem\DocumentosDemandaController@excluirDocumento');

Route::post('/codem/demanda/encaminhamento/novo', 'Mod_codem\EncaminhamentoController@encaminhamentoNovo');
Route::post('/codem/demanda/encaminhamento/salvar', 'Mod_codem\EncaminhamentoController@salvarEncaminhamento');
Route::get('/codem/demanda/encaminhamento/excluir/{encaminhamento}', 'Mod_codem\EncaminhamentoController@excluirEncaminhamento');
Route::get('codem/demanda/encaminhamento/dados/{encaminhamento}', 'Mod_codem\EncaminhamentoController@dadosEncaminhamento');
Route::post('/codem/demanda/encaminhamento/atualizar', 'Mod_codem\EncaminhamentoController@atualizarEncaminhamento');

Route::post('/codem/demanda/observacao/nova', 'Mod_codem\ObservacoesDemandaController@ObservacaoNova');
Route::post('/codem/demanda/observacao/salvar', 'Mod_codem\ObservacoesDemandaController@salvarObservacao');
Route::get('/codem/demanda/observacao/excluir/{observacao}', 'Mod_codem\ObservacoesDemandaController@excluirObservacao');





//////módulo CODEM


//módulo debentures e reidi
Route::get('/debentures_reidi/projetos/debentures/cadastrar', 'Mod_debentures_reidi\DebenturesController@cadastrarProjeto');
Route::post('/debentures_reidi/projeto/debentures/salvar', 'Mod_debentures_reidi\DebenturesController@salvarProjeto');
Route::get('/debentures_reidi/projetos/debentures/consultar', 'Mod_debentures_reidi\DebenturesController@consultarProjeto');
Route::post('/debentures_reidi/projetos/debentures/pesquisar', 'Mod_debentures_reidi\DebenturesController@pesquisarProjeto');
Route::get('/debentures_reidi/projeto/debentures/{projeto}', 'Mod_debentures_reidi\DebenturesController@dadosProjeto');
Route::post('/debentures_reidi/projeto/debentures/update', 'Mod_debentures_reidi\DebenturesController@updateProjeto');
Route::get('/debentures_reidi/projeto/debentures/excluir/{ufProjetoId}', 'Mod_debentures_reidi\DebenturesController@excluirEstado');
Route::post('/debentures_reidi/estado/debentures/add', 'Mod_debentures_reidi\DebenturesController@addEstado');


Route::get('/debentures_reidi/projetos/reidis/cadastrar', 'Mod_debentures_reidi\ReidisController@cadastrarProjeto');
Route::post('/debentures_reidi/projeto/reidis/salvar', 'Mod_debentures_reidi\ReidisController@salvarProjeto');
Route::get('/debentures_reidi/projetos/reidis/consultar', 'Mod_debentures_reidi\ReidisController@consultarProjeto');
Route::post('/debentures_reidi/projetos/reidis/pesquisar', 'Mod_debentures_reidi\ReidisController@pesquisarProjeto');
Route::get('/debentures_reidi/projeto/reidis/{projeto}', 'Mod_debentures_reidi\ReidisController@dadosProjeto');
Route::post('/debentures_reidi/projeto/reidis/update', 'Mod_debentures_reidi\ReidisController@updateProjeto');
Route::get('/debentures_reidi/projeto/reidis/excluir/{ufProjetoId}', 'Mod_debentures_reidi\ReidisController@excluirEstado');
Route::post('/debentures_reidi/estado/reidis/add', 'Mod_debentures_reidi\ReidisController@addEstado');



//////módulo APIS
Route::get('/home_apis', 'Mod_apis\HomeApisController@index');

Route::get('/apis/debentures/adicionar', 'Mod_apis\ProjetosDebenturesController@adicionarProjetos');
Route::get('/apis/debentures/consultar', 'Mod_apis\ProjetosDebenturesController@consultarProjetos');
Route::post('/apis/debentures/pesquisar', 'Mod_apis\ProjetosDebenturesController@pesquisarProjetos');

Route::get('/apis/debentures/{projeto_debenture}', 'Mod_apis\ProjetosDebenturesController@showProjeto');

Route::post('/apis/debenture/acompanhamento/cadastrar', 'Mod_apis\ProjetosDebenturesController@cadastrarAcompanhamento');
Route::get('/apis/debenture/acompanhamento/excluir/{acompanhamentoId}', 'Mod_apis\ProjetosDebenturesController@excluirAcompanhamento');

Route::post('/apis/debenture/emissao/cadastrar', 'Mod_apis\ProjetosDebenturesController@cadastrarEmissao');
Route::post('/apis/debenture/condicao_emissao/cadastrar', 'Mod_apis\ProjetosDebenturesController@cadastrarCondicaoEmissao');



Route::get('/apis/dados_projeto/debenture/{projetoDebenture}', 'Mod_apis\ProjetosDebenturesController@editarDadosProjeto');
Route::post('/apis/debenture/projeto/atualizar', 'Mod_apis\ProjetosDebenturesController@atualizarDadosProjeto');

Route::get('/apis/enquadramento/debenture/{projetoDebenture}', 'Mod_apis\ProjetosDebenturesController@editarEnquadramento');
Route::post('/apis/debenture/enquadramento/atualizar', 'Mod_apis\ProjetosDebenturesController@atualizarEnquadramento');


Route::get('/apis/debenture/emissao/{emissao}', 'Mod_apis\ProjetosDebenturesController@editarEmissao');
Route::post('/apis/debenture/emissao/atualizar', 'Mod_apis\ProjetosDebenturesController@atualizarEmissao');

Route::get('/apis/debenture/condicao_emissao/{condicaoEmissao}', 'Mod_apis\ProjetosDebenturesController@editarCondicaoEmissao');
Route::post('/apis/debenture/condicao_emissao/atualizar', 'Mod_apis\ProjetosDebenturesController@atualizarCondicaoEmissao');
Route::get('/apis/debenture/excluir/condicao_emissao/{condicaoEmissao}', 'Mod_apis\ProjetosDebenturesController@excluirCondicaoEmissao');

Route::get('/apis/municipios_beneficiados/debenture/{projetoDebenture}', 'Mod_apis\ProjetosDebenturesController@editarMunicipios');
Route::get('/apis/debenture/excluir/municipio/{municipioBeneficiadoId}', 'Mod_apis\ProjetosDebenturesController@excluirMunicipios');

Route::post('/apis/debenture/municipios_beneficiados/adicionar', 'Mod_apis\ProjetosDebenturesController@adicionarMunicipiosBeneficiados');


//////módulo PAC
Route::get('/home_pac', 'Mod_pac\HomePACController@index');


Route::get('/pac/contratos/consultar', 'Mod_pac\BalancoPACController@consultarBalancoPac');
Route::post('/pac/balanco_pac/pesquisar', 'Mod_pac\BalancoPACController@pesquisarBalancoPac');
Route::get('/pac/contrato/{cod_registro}', 'Mod_pac\BalancoPACController@dadosContrato');

Route::get('/pac/analise_execucao/consultar', 'Mod_pac\BalancoPACController@consultarAnaliseExecPac');
Route::post('/pac/analise_execucao/pesquisar', 'Mod_pac\BalancoPACController@pesquisarAnaliseExecPac');










//----------------Módulo Plancidades--------------//


//--------Home---------//
Route::view('/plancidades', 'modulo_plancidades.home.plancidades_home')->name('plancidades.home');

//--------Objetivos Estratégicos---------//

//--Monitoramentos--//
Route::get('/plancidades/monitoramentos/objetivo_estrategico/consulta', 'Mod_plancidades\MonitoramentoIndicadorController@consultarMonitoramento')->name('plancidades.monitoramentos.objetivoEstrategico.consultar');
Route::get('/plancidades/monitoramentos/objetivo_estrategico/indicadores', 'Mod_plancidades\IndicadorObjEstrController@listarIndicadores')->name('plancidades.monitoramentos.objetivoEstrategico.listarIndicadores');
Route::get('/plancidades/monitoramentos/objetivo_estrategico/indicadores/{indicadorId}', 'Mod_plancidades\MonitoramentoIndicadorController@index')->name('plancidades.monitoramentos.objetivoEstrategico.listarMonitoramentos');
Route::get('/plancidades/monitoramentos/objetivo_estrategico/exibir/{monitoramentoId}', 'Mod_plancidades\MonitoramentoIndicadorController@show')->name('plancidades.monitoramentos.objetivoEstrategico.show');
Route::get('/plancidades/monitoramentos/objetivo_estrategico/{indicadorId}/criar', 'Mod_plancidades\MonitoramentoIndicadorController@create')->name('plancidades.monitoramentos.objetivoEstrategico.criarMonitoramento');
Route::post('/plancidades/monitoramentos/objetivo_estrategico/salvar', 'Mod_plancidades\MonitoramentoIndicadorController@store')->name('plancidades.monitoramentos.objetivoEstrategico.salvar');
Route::get('/plancidades/monitoramentos/objetivo_estrategico/{monitoramentoId}/editar', 'Mod_plancidades\MonitoramentoIndicadorController@edit')->name('plancidades.monitoramentos.objetivoEstrategico.editar');
Route::post('/plancidades/monitoramentos/objetivo_estrategico/{monitoramentoId}/atualizar', 'Mod_plancidades\MonitoramentoIndicadorController@update')->name('plancidades.monitoramentos.objetivoEstrategico.atualizar');


//--Metas--//
Route::post('/plancidades/monitoramentos/apuracao_meta_indicador/salvar/{monitoramentoId}', 'Mod_plancidades\MonitoramentoMetaIndicadorController@store')->name('plancidades.apuracaoMetaIndicador.salvar');
Route::get('/plancidades/monitoramentos/apuracao_meta_indicador/edit/{monitoramentoId}', 'Mod_plancidades\MonitoramentoMetaIndicadorController@edit')->name('plancidades.apuracaoMetaIndicador.editar');
Route::post('/plancidades/monitoramentos/apuracao_meta_indicador/atualizar', 'Mod_plancidades\MonitoramentoMetaIndicadorController@update')->name('plancidades.apuracaoMetaIndicador.atualizar');



//--Restrições--//
Route::post('/plancidades/monitoramentos/restricao_meta_indicador/salvar/{monitoramentoId}', 'Mod_plancidades\RestricaoMetaMonitoramentoIndicadorController@store')->name('plancidades.restricaoIndicador.salvar');
Route::get('/plancidades/monitoramentos/restricao_meta_indicador/excluir/{restricaoId}', 'Mod_plancidades\RestricaoMetaMonitoramentoIndicadorController@destroy')->name('plancidades.restricaoIndicador.excluir');











//---------Iniciativas Processos----------//

//--Monitoramentos--//
Route::get('/plancidades/monitoramentos/iniciativas/consulta', 'Mod_plancidades\MonitoramentoIniciativaController@consultarMonitoramento')->name('plancidades.monitoramentos.iniciativa.consultar');
Route::get('/plancidades/monitoramentos/iniciativas', 'Mod_plancidades\IniciativaController@listarIniciativas')->name('plancidades.monitoramentos.iniciativa.listarIniciativas');
Route::get('/plancidades/monitoramentos/iniciativas/{iniciativaId}', 'Mod_plancidades\MonitoramentoIniciativaController@listarMonitoramentos')->name('plancidades.monitoramentos.iniciativa.listarMonitoramentos');
Route::get('/plancidades/monitoramentos/iniciativas/monitoramento/exibir/{monitoramentoId}', 'Mod_plancidades\MonitoramentoIniciativaController@show')->name('plancidades.monitoramentos.iniciativa.show');
Route::get('/plancidades/monitoramentos/iniciativas/{iniciativaId}/criar', 'Mod_plancidades\MonitoramentoIniciativaController@criarMonitoramento')->name('plancidades.monitoramentos.iniciativa.criarMonitoramento');
Route::post('/plancidades/monitoramentos/iniciativas/salvar', 'Mod_plancidades\MonitoramentoIniciativaController@store')->name('plancidades.monitoramentos.iniciativa.salvar');
Route::get('/plancidades/monitoramentos/iniciativas/{monitoramentoId}/editar', 'Mod_plancidades\MonitoramentoIniciativaController@edit')->name('plancidades.monitoramentos.iniciativa.editar');
Route::post('/plancidades/monitoramentos/iniciativas/{monitoramentoId}/atualizar', 'Mod_plancidades\MonitoramentoIniciativaController@update')->name('plancidades.monitoramentos.iniciativa.atualizar');


//--Metas--//
Route::post('/plancidades/apuracao_meta_iniciativa/salvar/{monitoramentoId}', 'Mod_plancidades\MonitoramentoMetaIniciativaController@store')->name('plancidades.apuracaoMetaIniciativa.salvar');
Route::get('/plancidades/apuracao_meta_iniciativa/show/{regionalizacaoMonitoramentoId}', 'Mod_plancidades\MonitoramentoMetaIniciativaController@show')->name('plancidades.apuracaoMetaIniciativa.show');
Route::get('/plancidades/apuracao_meta_iniciativa/excluir/{monitoramentoId}', 'Mod_plancidades\MonitoramentoMetaIniciativaController@destroy')->name('plancidades.apuracaoMetaIniciativa.excluir');
Route::post('/plancidades/apuracao_meta_iniciativa/atualizar', 'Mod_plancidades\MonitoramentoMetaIniciativaController@update')->name('plancidades.apuracaoMetaIniciativa.atualizar');
Route::post('/plancidades/apuracao_meta_iniciativa/editar/{monitoramentoId}', 'Mod_plancidades\MonitoramentoMetaIniciativaController@edit')->name('plancidades.apuracaoMetaIniciativa.edit');


//--Restrições--//
Route::post('/plancidades/monitoramentos/restricao_meta_iniciativa/salvar/{monitoramentoIniciativaId}', 'Mod_plancidades\RestricaoMetaMonitoramentoIniciativaController@store')->name('plancidades.restricaoIniciativa.salvar');
Route::get('/plancidades/monitoramentos/restricao_meta_iniciativa/excluir/{retricaoId}', 'Mod_plancidades\RestricaoMetaMonitoramentoIniciativaController@destroy')->name('plancidades.restricaoIniciativa.excluir');




//---------Projetos----------//

//--Monitoramentos--//
Route::get('/plancidades/monitoramentos/projetos/consulta', 'Mod_plancidades\MonitoramentoProjetoController@consultarProjeto')->name('plancidades.monitoramentos.projeto.consultar');
Route::get('/plancidades/monitoramentos/projetos/', 'Mod_plancidades\ProjetoController@listarProjetos')->name('plancidades.monitoramentos.projeto.listarProjetos');
Route::get('/plancidades/monitoramentos/projetos/{projetoId}', 'Mod_plancidades\MonitoramentoProjetoController@listarMonitoramentos')->name('plancidades.monitoramentos.projeto.listarMonitoramentos');
Route::get('/plancidades/monitoramentos/projetos/monitoramento/exibir/{monitoramentoId}', 'Mod_plancidades\MonitoramentoProjetoController@show')->name('plancidades.monitoramentos.projeto.show');
Route::get('/plancidades/monitoramentos/projetos/{projetoId}/criar', 'Mod_plancidades\MonitoramentoProjetoController@criarMonitoramento')->name('plancidades.monitoramentos.projeto.criarMonitoramento');
Route::post('/plancidades/monitoramentos/projetos/salvar', 'Mod_plancidades\MonitoramentoProjetoController@store')->name('plancidades.monitoramentos.projeto.salvar');
Route::get('/plancidades/monitoramentos/projetos/{monitoramentoId}/editar', 'Mod_plancidades\MonitoramentoProjetoController@edit')->name('plancidades.monitoramentos.projeto.editar');
Route::post('/plancidades/monitoramentos/projetos/{monitoramentoId}/atualizar', 'Mod_plancidades\MonitoramentoProjetoController@update')->name('plancidades.monitoramentos.projeto.atualizar');


//--Etapas--//
Route::post('/plancidades/apuracao_etapa_projeto/{monitoramentoProjetoEtapaId}/atualizar', 'Mod_plancidades\MonitoramentoProjetoEtapaController@update')->name('plancidades.apuracaoEtapaProjeto.atualizar');




//---------Validação----------
Route::get('/plancidades/monitoramentos/validacao/consulta', 'Mod_plancidades\ValidacaoMonitoramentoController@iniciarConsulta')->name('plancidades.monitoramentos.validacao.consultar');

Route::get('/plancidades/monitoramentos/validacao/objetivo_estrategico/listarMonitoramentosPendentes', 'Mod_plancidades\ValidacaoMonitoramentoController@listarMonitoramentosPendentesIndicadores')->name('plancidades.monitoramentos.validacoesPendentes.indicadores.listar');
Route::get('/plancidades/monitoramentos/validacao/objetivo_estrategico/listarMonitoramentos', 'Mod_plancidades\ValidacaoMonitoramentoController@listarMonitoramentosIndicadores')->name('plancidades.monitoramentos.validacao.indicadores.listar');
Route::get('/plancidades/monitoramentos/validacao/objetivo_estrategico/{monitoramentoIndicadorid}/editar', 'Mod_plancidades\ValidacaoMonitoramentoIndicadorController@edit')->name('plancidades.monitoramentos.validacao.indicadores.editar');
Route::post('/plancidades/monitoramentos/validacao/objetivo_estrategico/{monitoramentoIndicadorid}/atualizar', 'Mod_plancidades\ValidacaoMonitoramentoIndicadorController@update')->name('plancidades.monitoramentos.validacao.indicadores.atualizar');

Route::get('/plancidades/monitoramentos/validacao/iniciativa/listarMonitoramentosPendentes', 'Mod_plancidades\ValidacaoMonitoramentoController@listarMonitoramentosPendentesIniciativas')->name('plancidades.monitoramentos.validacoesPendentes.iniciativas.listar');
Route::get('/plancidades/monitoramentos/validacao/iniciativa/listarMonitoramentos', 'Mod_plancidades\ValidacaoMonitoramentoController@listarMonitoramentosIniciativas')->name('plancidades.monitoramentos.validacao.iniciativas.listar');
Route::get('/plancidades/monitoramentos/validacao/iniciativa/{monitoramentoIniciativaid}/editar', 'Mod_plancidades\ValidacaoMonitoramentoIniciativaController@edit')->name('plancidades.monitoramentos.validacao.iniciativas.editar');
Route::post('/plancidades/monitoramentos/validacao/iniciativa/{monitoramentoIniciativaid}/atualizar', 'Mod_plancidades\ValidacaoMonitoramentoIniciativaController@update')->name('plancidades.monitoramentos.validacao.iniciativas.atualizar');

Route::get('/plancidades/monitoramentos/validacao/projeto/listarMonitoramentosPendentes', 'Mod_plancidades\ValidacaoMonitoramentoController@listarMonitoramentosPendentesProjetos')->name('plancidades.monitoramentos.validacoesPendentes.projetos.listar');
Route::get('/plancidades/monitoramentos/validacao/projeto/listarMonitoramentos', 'Mod_plancidades\ValidacaoMonitoramentoController@listarMonitoramentosProjetos')->name('plancidades.monitoramentos.validacao.projetos.listar');
Route::get('/plancidades/monitoramentos/validacao/projeto/{monitoramentoProjetoid}/editar', 'Mod_plancidades\ValidacaoMonitoramentoProjetoController@edit')->name('plancidades.monitoramentos.validacao.projetos.editar');
Route::post('/plancidades/monitoramentos/validacao/projeto/{monitoramentoProjetoid}/atualizar', 'Mod_plancidades\ValidacaoMonitoramentoProjetoController@update')->name('plancidades.monitoramentos.validacao.projetos.atualizar');


//--------Módulo Revisão---------//

//--------Objetivos Estratégicos---------//

//--Informações Básicas (indicadores e metas)--//
Route::get('/plancidades/revisao/objetivo_estrategico/consulta', 'Mod_plancidades\RevisaoIndicadorController@consultarIndicadores')->name('plancidades.revisao.objetivoEstrategico.consultar');
Route::get('/plancidades/revisao/objetivo_estrategico/indicadores', 'Mod_plancidades\RevisaoController@listarIndicadores')->name('plancidades.revisao.objetivoEstrategico.listarIndicadores');
Route::get('/plancidades/revisao/objetivo_estrategico/{indicadorId}/criar', 'Mod_plancidades\RevisaoIndicadorController@create')->name('plancidades.revisao.objetivoEstrategico.iniciarRevisao');
Route::post('/plancidades/revisao/objetivo_estrategico/salvar', 'Mod_plancidades\RevisaoIndicadorController@store')->name('plancidades.revisao.objetivoEstrategico.salvar');
Route::get('/plancidades/revisao/objetivo_estrategico/indicadores/{indicadorId}', 'Mod_plancidades\RevisaoIndicadorController@index')->name('plancidades.revisao.objetivoEstrategico.listarRevisoes');
Route::get('/plancidades/revisao/objetivo_estrategico/exibir/{revisaoId}', 'Mod_plancidades\RevisaoIndicadorController@show')->name('plancidades.revisao.objetivoEstrategico.show');


Route::get('/plancidades/revisao/objetivo_estrategico/{revisaoId}/editar', 'Mod_plancidades\RevisaoIndicadorController@edit')->name('plancidades.revisao.objetivoEstrategico.editar');
Route::post('/plancidades/revisao/objetivo_estrategico/{revisaoId}/atualizar', 'Mod_plancidades\RevisaoIndicadorController@update')->name('plancidades.revisao.objetivoEstrategico.atualizar');


// //--Metas--//
// Route::post('/plancidades/monitoramentos/apuracao_meta_indicador/salvar/{monitoramentoId}', 'Mod_plancidades\MonitoramentoMetaIndicadorController@store')->name('plancidades.apuracaoMetaIndicador.salvar');
// Route::get('/plancidades/monitoramentos/apuracao_meta_indicador/edit/{monitoramentoId}', 'Mod_plancidades\MonitoramentoMetaIndicadorController@edit')->name('plancidades.apuracaoMetaIndicador.editar');
// Route::post('/plancidades/monitoramentos/apuracao_meta_indicador/atualizar', 'Mod_plancidades\MonitoramentoMetaIndicadorController@update')->name('plancidades.apuracaoMetaIndicador.atualizar');

//--------Iniciativas---------//

//--Informações Básicas (indicadores e metas)--//
//Revisão Base
Route::get('/plancidades/revisao/iniciativa/consulta', 'Mod_plancidades\RevisaoIniciativaController@consultarIniciativas')->name('plancidades.revisao.iniciativa.consultar');
Route::get('/plancidades/revisao/iniciativa/listar', 'Mod_plancidades\RevisaoController@listarIniciativas')->name('plancidades.revisao.iniciativa.listarIniciativas');
Route::get('/plancidades/revisao/iniciativa/{iniciativaId}/iniciarRevisao', 'Mod_plancidades\RevisaoIniciativaController@iniciarRevisao')->name('plancidades.revisao.iniciativa.iniciarRevisao');
Route::post('/plancidades/revisao/iniciativa/salvarRevisao', 'Mod_plancidades\RevisaoIniciativaController@salvarRevisao')->name('plancidades.revisao.iniciativa.salvarRevisao');
Route::get('/plancidades/revisao/iniciativa/listar/{iniciativaId}', 'Mod_plancidades\RevisaoIniciativaController@index')->name('plancidades.revisao.iniciativa.listarRevisoes');


//Revisão da Iniciativa
Route::get('/plancidades/revisao/iniciativa/{revisaoId}/criar', 'Mod_plancidades\RevisaoIniciativaController@create')->name('plancidades.revisao.iniciativa.criar');
Route::post('/plancidades/revisao/iniciativa/{revisaoId}/salvar', 'Mod_plancidades\RevisaoIniciativaController@store')->name('plancidades.revisao.iniciativa.salvar');
Route::get('/plancidades/revisao/iniciativa/{revisaoId}/editar', 'Mod_plancidades\RevisaoIniciativaController@edit')->name('plancidades.revisao.iniciativa.editar');
Route::post('/plancidades/revisao/iniciativa/{revisaoId}/atualizar', 'Mod_plancidades\RevisaoIniciativaController@update')->name('plancidades.revisao.iniciativa.atualizar');

//Revisão do Indicador (Iniciativa)
Route::get('/plancidades/revisao/indicador/iniciativa/{revisaoId}/criar', 'Mod_plancidades\RevisaoIndicadorIniciativaController@create')->name('plancidades.revisao.indicador.iniciativa.criar');
Route::post('/plancidades/revisao/indicador/iniciativa/{revisaoId}/salvar', 'Mod_plancidades\RevisaoIndicadorIniciativaController@store')->name('plancidades.revisao.indicador.iniciativa.salvar');
Route::get('/plancidades/revisao/indicador/iniciativa/{revisaoId}/editar', 'Mod_plancidades\RevisaoIndicadorIniciativaController@edit')->name('plancidades.revisao.indicador.iniciativa.editar');
Route::post('/plancidades/revisao/indicador/iniciativa/{revisaoId}/atualizar', 'Mod_plancidades\RevisaoIndicadorIniciativaController@update')->name('plancidades.revisao.indicador.iniciativa.atualizar');

//Revisão da Meta (Iniciativa)
Route::get('/plancidades/revisao/meta/iniciativa/{revisaoId}/criar', 'Mod_plancidades\RevisaoMetaIndicadorIniciativaController@create')->name('plancidades.revisao.meta.iniciativa.criar');
Route::post('/plancidades/revisao/meta/iniciativa/{revisaoId}/salvar', 'Mod_plancidades\RevisaoMetaIndicadorIniciativaController@store')->name('plancidades.revisao.meta.iniciativa.salvar');
Route::get('/plancidades/revisao/meta/iniciativa/{revisaoId}/editar', 'Mod_plancidades\RevisaoMetaIndicadorIniciativaController@edit')->name('plancidades.revisao.meta.iniciativa.editar');
Route::post('/plancidades/revisao/meta/iniciativa/{revisaoId}/atualizar', 'Mod_plancidades\RevisaoMetaIndicadorIniciativaController@update')->name('plancidades.revisao.meta.iniciativa.atualizar');

//Revisão da Regionalização (Iniciativa)
Route::get('/plancidades/revisao/regionalizacao/iniciativa/{revisaoId}/criar', 'Mod_plancidades\RevisaoRegionalizacaoMetaIndicadorIniciativaController@create')->name('plancidades.revisao.regionalizacao.iniciativa.criar');
Route::post('/plancidades/revisao/regionalizacao/iniciativa/{revisaoId}/salvar', 'Mod_plancidades\RevisaoRegionalizacaoMetaIndicadorIniciativaController@store')->name('plancidades.revisao.regionalizacao.iniciativa.salvar');
Route::get('/plancidades/revisao/regionalizacao/iniciativa/{revisaoId}/editar', 'Mod_plancidades\RevisaoRegionalizacaoMetaIndicadorIniciativaController@edit')->name('plancidades.revisao.regionalizacao.iniciativa.editar');
Route::post('/plancidades/revisao/regionalizacao/iniciativa/{revisaoId}/atualizar', 'Mod_plancidades\RevisaoRegionalizacaoMetaIndicadorIniciativaController@update')->name('plancidades.revisao.regionalizacao.iniciativa.atualizar');


//Revisão da Regionalização (Finalizar)
Route::get('/plancidades/revisao/iniciativa/exibir/{revisaoId}', 'Mod_plancidades\RevisaoIniciativaController@show')->name('plancidades.revisao.iniciativa.show');
Route::post('/plancidades/revisao/iniciativa/finalizar/{revisaoId}', 'Mod_plancidades\RevisaoIniciativaController@finalizar')->name('plancidades.revisao.iniciativa.finalizar');




//--------Projetos---------//

//--Informações Básicas (indicadores e metas)--//
Route::get('/plancidades/revisao/projeto/consulta', 'Mod_plancidades\RevisaoProjetoController@consultarProjetos')->name('plancidades.revisao.projeto.consultar');
Route::get('/plancidades/revisao/projeto/indicadores', 'Mod_plancidades\RevisaoController@listarProjetos')->name('plancidades.revisao.projeto.listarProjetos');
Route::get('/plancidades/revisao/projeto/{projetoId}/criar', 'Mod_plancidades\RevisaoProjetoController@create')->name('plancidades.revisao.projeto.iniciarRevisao');
// Route::post('/plancidades/revisao/objetivo_estrategico/salvar', 'Mod_plancidades\RevisaoIndicadorController@teste')->name('plancidades.revisao.objetivoEstrategico.salvar');






//---------Antigos, avaliar exclusão----------
Route::get('/plancidades/monitoramento/processo/iniciativa_projetos/cadastrar', 'Mod_plancidades\MonitoramentoProjetoController@create')->name('plancidades.iniciativa.projeto.cadastrar');
Route::post('/plancidades/monitoramento/processo/iniciativa_projetos/pesquisar', 'Mod_plancidades\MonitoramentoProjetoController@pesquisarMonitoramentoProjeto')->name('plancidades.monitoramento_projeto.pesquisar');
Route::get('/plancidades/monitoramento/processo/iniciativa_projetos/show/{id}', 'Mod_plancidades\MonitoramentoProjetoController@show')->name('plancidades.iniciativa.projeto.show');



//----------------Módulo Briefing--------------//
Route::get('/briefing/destaques/cadastrar', 'Mod_briefing\DestaquesController@create')->name('briefing.cadastrar');
Route::post('/briefing/destaques/salvar', 'Mod_briefing\DestaquesController@store')->name('briefing.salvar');






//----------------Módulo TransfereGov - Programas 2024--------------//
Route::get('/transferegov/programas/listar', 'Mod_transferegov\ProgramaController@index')->name('transferegov.listarProgramas');
Route::get('/transferegov/programas/{cod_programa}/create', 'Mod_transferegov\ProgramaController@create')->name('transferegov.criar');
Route::post('/transferegov/programas/salvar', 'Mod_transferegov\ProgramaController@store')->name('transferegov.salvar');
Route::get('/transferegov/programas/{cod_programa}/editar', 'Mod_transferegov\ProgramaController@edit')->name('transferegov.editar');
Route::get('/transferegov/programas/{cod_programa}/show', 'Mod_transferegov\ProgramaController@show')->name('transferegov.show');
Route::post('/transferegov/programas/{id}/atualizar', 'Mod_transferegov\ProgramaController@update')->name('transferegov.atualizar');



Route::get('/carga/arquivo/dbgestores/', 'Mod_carteira_investimento\DbGestoresController@downloadDbGestores');


//PLANEJAMENTO DE TAREFAS
Route::get('/planejamento_tarefas/cadastrar/', 'Mod_planejamento_tarefas\PlanejamentoTarefasController@index');
Route::post('/planejamento_tarefas/salvar/', 'Mod_planejamento_tarefas\PlanejamentoTarefasController@create');
Route::get('/planejamento_tarefas/show/{planejamento}', 'Mod_planejamento_tarefas\PlanejamentoTarefasController@show');
Route::get('/planejamento_tarefas/lista_planejamentos/', 'Mod_planejamento_tarefas\PlanejamentoTarefasController@listaPlanejamentos');

Route::post('/etapas_planejamento/adicionar/', 'Mod_planejamento_tarefas\EtapasPlanejamentoController@create');


Route::get('/tarefa_etapa/tarefa/{tarefaEtapa}', 'Mod_planejamento_tarefas\TarefaEtapaController@show');


//transferências especiais
Route::get('/transferencias_especiais/consultar', 'Mod_transferencias_especiais\TransferenciasEspeciaisController@consultar');
Route::get('/transferencias_especiais/pesquisar', 'Mod_transferencias_especiais\TransferenciasEspeciaisController@pesquisar');
Route::get('/transferencias_especiais/plano_acao/{plano_acao}', 'Mod_transferencias_especiais\PlanoAcaoController@show');

Route::get('/transferencias_especiais/atribuir/plano_acao/{plano_acao}', 'Mod_transferencias_especiais\PlanoAcaoController@planoAtribuir');
Route::get('/transferencias_especiais/desatribuir/plano_acao/{plano_acao}', 'Mod_transferencias_especiais\PlanoAcaoController@planoDesatribuir');

Route::get('transferencias_especiais/download/secretaria/{secretaria}/distribuicao/{distribuicao}', 'Mod_transferencias_especiais\PlanoAcaoController@downloadsPlanosAcao');