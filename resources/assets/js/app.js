/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");

window.Vue = require("vue");

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component(
  "example-component",
  require("./components/ExampleComponent.vue")
);

/** GERAIS */


Vue.component('modal', require('./components/gerais/modal/Modal.vue'));

Vue.component('modallink', require('./components/gerais/modal/ModalLink.vue'));

Vue.component(
  "select-uf-municipio",
  require("./components/gerais/SelectUfMunicipio.vue")
);
Vue.component(
  "modulo-sistema",
  require("./components/gerais/ModuloSistema.vue")
);
Vue.component(
  "cabecalho-form",
  require("./components/gerais/CabecalhoForm.vue")
);
Vue.component(
  "cabecalho-relatorios",
  require("./components/gerais/CabecalhoRelatorios.vue")
);
Vue.component(
  "cabecalho-relatorios-filtros",
  require("./components/gerais/CabecalhoRelatoriosFiltroSelec.vue")
);
Vue.component(
  "select-component",
  require("./components/gerais/SelectComponent.vue")
);


Vue.component(
  "historico-navegacao",
  require("./components/gerais/HistoricoNavegacao.vue")
);
Vue.component(
  "mensagem-feedback",
  require("./components/gerais/MensagemFeedback.vue")
);
Vue.component(
  "solicitar-adesao",
  require("./components/gerais/SolicitarAdesao.vue")
);
Vue.component(
  "botao-acao-icone",
  require("./components/gerais/BotaoAcaoIcone.vue")
);
Vue.component(
  "upload-arquivo",
  require("./components/gerais/UploadArquivos.vue")
);
Vue.component(
  "tabela-relatorios",
  require("./components/gerais/TabelaRelatorios.vue")
);
Vue.component(
  "setores-ministerio",
  require("./components/gerais/SetoresMinisterio.vue")
);

//ADMIN
Vue.component(
  "filtro-oficio",
  require("./components/mod_sistema/admin/arquivos/FiltroOficio.vue")
);
Vue.component(
  "valida-oficio",
  require("./components/mod_sistema/admin/arquivos/ValidaOficio.vue")
);
Vue.component(
  "tabela-oficios",
  require("./components/mod_sistema/admin/arquivos/TabelaOficios.vue")
);
Vue.component(
  "filtro-usuarios",
  require("./components/mod_sistema/admin/FiltroUsuarios.vue")
);
Vue.component(
  "registro-usuario",
  require("./components/mod_sistema/admin/RegistroUsuario.vue")
);

Vue.component(
  "configuracao_painel",
  require("./components/mod_sistema/admin/paineis/ConfiguracaoPainel.vue")
);



///mod propostas
Vue.component(
  "filtro-propostas",
  require("./components/mod_propostas/FiltroPropostas.vue")
);

Vue.component(
  "filtro-propostas-publicidade",
  require("./components/mod_propostas/FiltroPropostasPublicidade.vue")
);

Vue.component(
  "filtro-resultado",
  require("./components/mod_propostas/FiltroResultado.vue")
);
Vue.component(
  "selecionar-proposta",
  require("./components/mod_propostas/admin/SelecionarProposta.vue")
);
Vue.component(
  "cancelamento-proposta",
  require("./components/mod_propostas/admin/CorrecaoProposta.vue")
);

Vue.component(
  "auto-complete-proposta",
  require("./components/mod_propostas/AutoCompletePropostaID.vue")
);

Vue.component(
  "filtro-propostas-transferegov",
  require("./components/mod_propostas/FiltroPropostasTransferegov.vue")
);
Vue.component(
  "filtro-execucao-transferegov",
  require("./components/mod_propostas/FiltroExecucaoTransferegov.vue")
);

Vue.component(
  "filtro-rps",
  require("./components/mod_propostas/admin/FiltroRPs.vue")
);

///mod Formulario_painel
Vue.component(
  "dados-contrato",
  require("./components/mod_carteira_investimento/DadosContrato.vue")
);
Vue.component(
  "filtro-carteira-investimento",
  require("./components/mod_carteira_investimento/FiltroCarteiraInvestimento.vue")
);

///mod briefinc
Vue.component(
  "filtro-ficha-audiencia",
  require("./components/mod_briefing/FiltroFichaAudiencia.vue")
);

Vue.component(
  "cabecalho-briefing",
  require("./components/mod_briefing/CabecalhoBriefing.vue")
);


//mcmv
Vue.component(
  "cadastrar-proposta-mcmv",
  require("./components/mod_propostas/mcmv/CadastrarPropostaMcmv.vue")
);

//semob
Vue.component(
  "cadastrar-proposta-semob",
  require("./components/mod_propostas/semob/CadastrarPropostaSemob.vue")
);
Vue.component(
  "checks-itens-financiaveis-semob",
  require("./components/mod_propostas/semob/ChecksItensFinanciaveisSemob.vue")
);

//sndum
Vue.component(
  "cadastrar-proposta-sndum",
  require("./components/mod_propostas/sndum/CadastrarPropostaSndum.vue")
);
Vue.component(
  "checks-itens-financiaveis-sndum",
  require("./components/mod_propostas/sndum/ChecksItensFinanciaveisSndum.vue")
);

//snsa
Vue.component(
  "cadastrar-proposta-snsa",
  require("./components/mod_propostas/snsa/CadastrarPropostaSnsa.vue")
);
Vue.component(
  "checks-itens-financiaveis-snsa",
  require("./components/mod_propostas/snsa/ChecksItensFinanciaveisSnsa.vue")
);

Vue.component(
  "cadastrar-proposta-snsa-2218",
  require("./components/mod_propostas/snsa/CadastrarPropostaSnsa2218.vue")
);
Vue.component(
  "checks-itens-financiaveis-snsa-2018",
  require("./components/mod_propostas/snsa/ChecksItensFinanciaveisSnsa2018.vue")
);

/**SACI WEB */
Vue.component(
  "form-cad-contratos-pac",
  require("./components/mod_saci/FormCadContratosPAC.vue")
);
Vue.component(
  "form-cons-registro",
  require("./components/mod_saci/FormConsRegistro.vue")
);
Vue.component(
  "filtro-contratos-saci",
  require("./components/mod_saci/FiltroContratosSaci.vue")
);

/** BNDES */
Vue.component(
  "filtro-empreendimentos-bndes",
  require("./components/mod_bndes/FiltroEmpreendimentosBndes.vue")
);
Vue.component(
  "dados-empreendimento-bndes",
  require("./components/mod_bndes/DadosEmpreendimentoBndes.vue")
);

/** CODEM */
Vue.component(
  "cadastro-demanda",
  require("./components/mod_codem/CadastroDemanda.vue")
);
Vue.component(
  "cadastro-documento-demanda",
  require("./components/mod_codem/CadastroDocumentoDemanda.vue")
);
Vue.component(
  "cadastro-encaminhamento",
  require("./components/mod_codem/CadastroEncaminhamento.vue")
);
Vue.component(
  "cadastro-observacao-demanda",
  require("./components/mod_codem/CadastroObservacaoDemanda.vue")
);
Vue.component(
  "filtro-demandas",
  require("./components/mod_codem/FiltroDemandas.vue")
);

/**debentures E REIDI */

Vue.component(
  "filtro-debentures",
  require("./components/mod_debentures_reidi/FiltroDebentures.vue")
);

Vue.component(
  "filtro-reidis",
  require("./components/mod_debentures_reidi/FiltroReidis.vue")
);

Vue.component(
  "projeto-debentures",
  require("./components/mod_debentures_reidi/ProjetoDebentures.vue")
);
Vue.component(
  "projeto-reidis",
  require("./components/mod_debentures_reidi/ProjetoReidis.vue")
);
Vue.component(
  "add-estado",
  require("./components/mod_debentures_reidi/AddEstado.vue")
);

/**APIS */

Vue.component(
  "filtro-projetos-debentures",
  require("./components/mod_apis/FiltroProjetosDebentures.vue")
);

Vue.component(
  "cadastrar-emissao",
  require("./components/mod_apis/CadastrarEmissao.vue")
);

Vue.component(
  "cadastrar-condicao-emissao",
  require("./components/mod_apis/CadastrarCondicaoEmissao.vue")
);

Vue.component(
  "editar-dados-projeto",
  require("./components/mod_apis/EditarDadosProjeto.vue")
);

Vue.component(
  "editar-enquadramento",
  require("./components/mod_apis/EditarEnquadramento.vue")
);

Vue.component(
  "adicionar-municipios",
  require("./components/mod_apis/adicionarMunicipios.vue")
);

Vue.component(
  "filtro-contratos-pac",
  require("./components/mod_pac/FiltroContratosPac.vue")
);


Vue.component(
  "filtro-analise-exec-pac",
  require("./components/mod_pac/FiltroAnaliseExecPac.vue")
);


//resultado primario

Vue.component(
  "importar-arquivo-rp",
  require("./components/mod_rp/ImportarArquivosRP.vue")
);


Vue.component(
  "filtro-oficio-emendas",
  require("./components/mod_rp/FiltroOficioEmendas.vue")
);


Vue.component(
  "emendas-comissao-rp8",
  require("./components/mod_rp/EmendasComissaoRP8.vue")
);



//----------------Plancidades----------------//

Vue.component(
  "cadastro-restricao-meta",
  require("./components/mod_plancidades/CadastroRestricaoMeta.vue")
);

  //---Objetivo Estrategico---

  Vue.component(
    "consulta-monitoramento-indicador",
    require("./components/mod_plancidades/objetivo_estrategico/ConsultaMonitoramentoIndicador.vue")
  );
  
  Vue.component(
    "show-monitoramento-indicador",
    require("./components/mod_plancidades/objetivo_estrategico/ShowMonitoramentoIndicador.vue")
  );
  
  Vue.component(
    "cadastro-monitoramento-indicador",
    require("./components/mod_plancidades/objetivo_estrategico/CadastroMonitoramentoIndicador.vue")
  );
  
  Vue.component(
    "editar-monitoramento-indicador",
    require("./components/mod_plancidades/objetivo_estrategico/EditarMonitoramentoIndicador.vue")
  );
  
  Vue.component(
    "cadastro-apuracao-indicador-global",
    require("./components/mod_plancidades/objetivo_estrategico/CadastroApuracaoIndicadorGlobal.vue")
  );
  
  Vue.component(
    "cadastro-apuracao-indicador-regionalizada",
    require("./components/mod_plancidades/objetivo_estrategico/CadastroApuracaoIndicadorRegionalizada.vue")
  );
  
  
    //Iniciativa
  
  Vue.component(
    "consulta-monitoramento-iniciativa-processo",
    require("./components/mod_plancidades/iniciativa/ConsultaMonitoramentoIniciativaProcesso.vue")
  );
  
  Vue.component(
    "show-monitoramento-iniciativa",
    require("./components/mod_plancidades/iniciativa/ShowMonitoramentoIniciativa.vue")
  );
  
  Vue.component(
    "editar-monitoramento-iniciativa",
    require("./components/mod_plancidades/iniciativa/EditarMonitoramentoIniciativa.vue")
  );
  
  Vue.component(
    "cadastro-monitoramento-iniciativa",
    require("./components/mod_plancidades/iniciativa/CadastroMonitoramentoIniciativa.vue")
  );
  
  Vue.component(
    "cadastro-apuracao-iniciativa-global",
    require("./components/mod_plancidades/iniciativa/CadastroApuracaoIniciativaGlobal.vue")
  );
  
  Vue.component(
    "cadastro-apuracao-iniciativa-regionalizada",
    require("./components/mod_plancidades/iniciativa/CadastroApuracaoIniciativaRegionalizada.vue")
  );
  
  
  
  
  
  
  //Projeto
  
  Vue.component(
    "consulta-monitoramento-projeto",
    require("./components/mod_plancidades/projeto/ConsultaMonitoramentoProjeto.vue")
  );
  
  Vue.component(
    "cadastro-monitoramento-projeto",
    require("./components/mod_plancidades/projeto/CadastroMonitoramentoProjeto.vue")
  );
  
  Vue.component(
    "editar-monitoramento-projeto",
    require("./components/mod_plancidades/projeto/EditarMonitoramentoProjeto.vue")
  );
  
  Vue.component(
    "show-monitoramento-projeto",
    require("./components/mod_plancidades/projeto/ShowMonitoramentoProjeto.vue")
  );
  
  
  // Vue.component(
  //   "cadastro-iniciativa-projeto",
  //   require("./components/mod_plancidades/projeto/EditarMonitoramentoProjeto.vue")
  // );
  
  // Validação Monitoramento
  
  Vue.component(
    "altera-situacao-monitoramento-indicador",
    require("./components/mod_plancidades/validacao_monitoramento/AlteraSituacaoMonitoramentoIndicador.vue")
  );
  
  Vue.component(
    "altera-situacao-monitoramento-iniciativa",
    require("./components/mod_plancidades/validacao_monitoramento/AlteraSituacaoMonitoramentoIniciativa.vue")
  );
  
  Vue.component(
    "altera-situacao-monitoramento-projeto",
    require("./components/mod_plancidades/validacao_monitoramento/AlteraSituacaoMonitoramentoProjeto.vue")
  );

// Revisão



Vue.component(
  "progresso-revisao-iniciativa",
  require("./components/mod_plancidades/revisao/componentes/ProgressoRevisaoIniciativa.vue")
);


// Revisão Objetivo Estrategico
Vue.component(
  "consulta-indicador-revisao",
  require("./components/mod_plancidades/revisao/objetivo_estrategico/ConsultaIndicadorRevisao.vue")
);

Vue.component(
  "cadastro-revisao-indicador",
  require("./components/mod_plancidades/revisao/objetivo_estrategico/CadastroRevisaoIndicador.vue")
);

Vue.component(
  "editar-revisao-indicador",
  require("./components/mod_plancidades/revisao/objetivo_estrategico/EditarRevisaoIndicador.vue")
);

Vue.component(
  "show-revisao-indicador",
  require("./components/mod_plancidades/revisao/objetivo_estrategico/ShowRevisaoIndicador.vue")
);


// Revisão Iniciativas
Vue.component(
  "consulta-iniciativa-revisao",
  require("./components/mod_plancidades/revisao/iniciativa/ConsultaIniciativaRevisao.vue")
);

Vue.component(
  "cadastro-revisao-iniciativa",
  require("./components/mod_plancidades/revisao/iniciativa/CadastroRevisaoIniciativa.vue")
);

Vue.component(
  "criar-revisao-iniciativa",
  require("./components/mod_plancidades/revisao/iniciativa/CriarRevisaoIniciativa.vue")
);

Vue.component(
  "editar-revisao-iniciativa",
  require("./components/mod_plancidades/revisao/iniciativa/EditarRevisaoIniciativa.vue")
);

Vue.component(
  "show-finalizar-revisao-iniciativa",
  require("./components/mod_plancidades/revisao/iniciativa/ShowFinalizarRevisaoIniciativa.vue")
);

Vue.component(
  "criar-revisao-indicador-iniciativa",
  require("./components/mod_plancidades/revisao/iniciativa/indicador/CriarRevisaoIndicadorIniciativa.vue")
);

Vue.component(
  "editar-revisao-indicador-iniciativa",
  require("./components/mod_plancidades/revisao/iniciativa/indicador/EditarRevisaoIndicadorIniciativa.vue")
);

Vue.component(
  "criar-revisao-meta-indicador-iniciativa",
  require("./components/mod_plancidades/revisao/iniciativa/metas/CriarRevisaoMetaIndicadorIniciativa.vue")
);

Vue.component(
  "editar-revisao-meta-indicador-iniciativa",
  require("./components/mod_plancidades/revisao/iniciativa/metas/EditarRevisaoMetaIndicadorIniciativa.vue")
);

Vue.component(
  "criar-revisao-regionalizacao-meta-indicador-iniciativa",
  require("./components/mod_plancidades/revisao/iniciativa/regionalizacao/CriarRevisaoRegionalizacaoMetaIndicadorIniciativa.vue")
);

Vue.component(
  "editar-revisao-regionalizacao-meta-indicador-iniciativa",
  require("./components/mod_plancidades/revisao/iniciativa/regionalizacao/EditarRevisaoRegionalizacaoMetaIndicadorIniciativa.vue")
);


// Revisão Projeto

Vue.component(
  "consulta-projeto-revisao",
  require("./components/mod_plancidades/revisao/projeto/ConsultaProjetoRevisao.vue")
);

Vue.component(
  "editar-revisao-projeto",
  require("./components/mod_plancidades/revisao/projeto/EditarRevisaoProjeto.vue")
);





  //Transferegov - Programas
  Vue.component(
    "registro-programa",
    require("./components/mod_transferegov/RegistoPrograma.vue")
  );

  Vue.component(
    "listar-programas",
    require("./components/mod_transferegov/ListarProgramas.vue")
  );
  


  Vue.component(
    "cadastro-destaque",
    require("./components/mod_briefing/CadastroDestaque.vue")
  );

  //planejamento tarefas

  
  Vue.component(
    "cadastro-planejamento-tarefa",
    require("./components/mod_planejamento_tarefas/CadastroPlanejamentoTarefa.vue")
  );

  Vue.component(
    "etapas-planejamanto",
    require("./components/mod_planejamento_tarefas/EtapasPlanejamento.vue")
  );

  Vue.component(
    "tarefa-etapa",
    require("./components/mod_planejamento_tarefas/TarefaEtapa.vue")
  );

  Vue.component(
    "lista-verificacao-tarefa",
    require("./components/mod_planejamento_tarefas/ListaVerificacaoTarefa.vue")
  );


  //transferênciais especiais

  Vue.component(
    "filtro-tansferencias-especiais",
    require("./components/mod_transferencias_especiais/FiltroTransferenciasEspeciais.vue")
  );

  Vue.component(
    "cadastro-analise-plano",
    require("./components/mod_transferencias_especiais/CadastroAnalisePlano.vue")
  );

  

  
  




const app = new Vue({
  el: "#app",
});



