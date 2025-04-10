<?php

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/** GERAIS TAB DOMINIOS*/

Route::get('/tipo_usuario', 'ApiController@buscarTipoUsuarios');
Route::get('/tipo_usuario/{modulo}', 'ApiController@buscarTipoUsuariosModulo');
Route::get('/modulo_sistema', 'ApiController@buscarModuloSistemas');
Route::get('/tipoIndeferimento', 'ApiController@buscarTipoIndeferimento');
Route::get('/tipo_indeferimento/providencias/{tipo}', 'ApiController@buscarProvidenciasOficio');




Route::get('/modalidade_participacao', 'ApiController@modalidadeParticipacao');
Route::get('/itens/modalidade/{selecao}', 'ApiController@itensFinModalidades');
Route::get('/motivo_correcao', 'ApiController@motivoCorrecao');




Route::get('/selecao/itensFinanciaveis', 'ApiController@buscarItensFinanciaveis');
Route::get('/selecao', 'ApiController@buscarSelecoes');
Route::get('/situacaoPropostas', 'ApiController@buscarSituacoesPropostas');
Route::get('/acaoPrograma', 'ApiController@buscarAcaoPrograma');

Route::get('/oficios/ufs', 'ApiController@buscarUfsOficios');
Route::get('/oficios/municipios/{estado}', 'ApiController@buscarMunicipiosOficios');

Route::get('/ente_publico/municipio/{municipio}', 'ApiController@buscarEntePublico');



//propostas
Route::get('/municipios/propostas/{estado}', 'ApiController@buscarMunicipiosPropostas');

Route::get('/proposta/{protocolo}', 'ApiController@buscarProposta');
Route::get('/itens_financiaveis/proposta/{protocolo}', 'ApiController@buscarItensFinanciaveisProposta');
Route::get('/acoes/proposta/{protocolo}', 'ApiController@buscarAcoesProposta');
Route::get('/indicadores_saneamento/{municipio}', 'ApiController@buscarIndicadoresSanMun');

Route::get('/selecao/proposta/search/{proposta}', 'ApiController@buscarPropostasID');

Route::get('/relacao_propostas_id/{entePublico}', 'ApiController@buscarRelacaoPropostasID');


Route::get('/situacao_ajustada_proposta', 'ApiController@buscarSituacaoPropostaAjustada');
Route::get('/sistema_vs_transferegov', 'ApiController@buscarSistemaVsTransferegov');
Route::get('/valida_cnpj', 'ApiController@buscarValidaCnpj');

Route::get('/acaoProgramaTransferegov', 'ApiController@buscarAcaoProgramaTransferegov');








//mcid_corporativo2

Route::get('/programa_siconv', 'ApiController@buscarProgramaSiconv');




/** GERAIS INDICADORES HABITACIONAIS*/
Route::get('/municipios/{estado}', 'ApiController@buscarMunicipios');
Route::get('/municipio/estado/{municipio}', 'ApiController@buscarMunicipios');
Route::get('/ufs', 'ApiController@buscarUfs');
Route::get('/ufs/{regiao}', 'ApiController@buscarUfsPorRegiao');
Route::get('/regioes', 'ApiController@buscarRegioes');


//CONTRATOS PAC
Route::get('/pac/areas', 'ApiController@buscarAreas');
Route::get('/pac/areas/secretaria/{secretaria}', 'ApiController@buscarAreasSecretaria');
Route::get('/pac/secretarias', 'ApiController@buscarSecretarias');
Route::get('/pac/fontes', 'ApiController@buscarFontes');
Route::get('/pac/andamentos', 'ApiController@buscarAndamentos');

Route::get('/pac/situacao_contratos', 'ApiController@buscarSituacaoContratos');
Route::get('/pac/situacao_obras', 'ApiController@buscarSituacaoObras');
Route::get('/pac/classificacao_cores', 'ApiController@buscarClassificacaoCores');
Route::get('/pac/entidades', 'ApiController@buscarEntidades');
Route::get('/pac/agente_financeiros', 'ApiController@buscarAgenteFinanceiros');
Route::get('/pac/modalidades/areas/{area}', 'ApiController@buscarModalidadesAreas');
Route::get('/pac/monitores/areas/{area}', 'ApiController@buscarMonitoresAreas');
Route::get('/pac/modalidades/', 'ApiController@buscarModalidades');
Route::get('/pac/submodalidades/modalidade/{modalidade}/areas/{area}', 'ApiController@buscarSubmodalidadesAreas');
Route::get('/pac/submodalidades/', 'ApiController@buscarSubmodalidades');
Route::get('/pac/fases', 'ApiController@buscarFases');
Route::get('/pac/chamadas/fontes/{fonte}/areas/{area}', 'ApiController@buscarChamadas');
Route::get('/pac/eixos', 'ApiController@buscarEixos');
Route::get('/pac/tipos', 'ApiController@buscarTipos');
Route::get('/pac/programas', 'ApiController@buscarProgramas');

Route::get('/estados', 'ApiController@buscarEstados');


/** BNDES*/

Route::get('/bndes/andamento', 'ApiController@buscarAndamentosBndes');

Route::get('/bndes/municipios/{estado}', 'ApiController@buscarMunicipiosBndes');
Route::get('/bndes/ufs', 'ApiController@buscarEstadosBndes');
Route::get('/bndes/situacao_obra', 'ApiController@buscarSituacaoObraBndes');
Route::get('/bndes/situacao_obra/andamento/{andamento}', 'ApiController@buscarSituacaoObraAndamentoBndes');
Route::get('/bndes/situacao_contrato', 'ApiController@buscarSituacaoContratoBndes');
Route::get('/bndes/situacao_trabalho_tec', 'ApiController@buscarSituacaoTrabalhoTecBndes');
Route::get('/bndes/status_documentacao', 'ApiController@buscarStatusDocumentacaoBndes');
Route::get('/bndes/status_licenciamento', 'ApiController@buscarStatusLicenciamentoBndes');
Route::get('/bndes/status_licitacao', 'ApiController@buscarStatusLicitacaoBndes');
Route::get('/bndes/status_projeto_engenharia', 'ApiController@buscarStatusProjetoEngenhariaBndes');




/** CODEM */
Route::get('/tipoDemanda', 'ApiController@listaTipoDemanda');
Route::get('/tipoAtendimento', 'ApiController@listaTipoAtendimento');
Route::get('/tema', 'ApiController@listaTema');
Route::get('/subTema/{tema}', 'ApiController@listaSubTema');
Route::get('/prioridade', 'ApiController@listaPrioridade');
Route::get('/prioridade/{qtd_dias}', 'ApiController@buscaPrioridade');
Route::get('/tipo_interessado', 'ApiController@listaTipoInteressado');
Route::get('/modalidade_demanda', 'ApiController@listaModalidadeDemanda');
Route::get('/tema/subTema/{subtema}', 'ApiController@buscaIdTema');
Route::get('/situacao_demanda', 'ApiController@listaSituacaoDemanda');
Route::get('/sistema/secretarias', 'ApiController@listaSecretarias');
Route::get('/sistema/departamentos', 'ApiController@listaDepartamentos');
Route::get('/sistema/setores', 'ApiController@listaSetores');

Route::get('/sistema/departamento/secretaria/{secretaria}', 'ApiController@listaDepartamentoSecretarias');
Route::get('/sistema/setor/departamento/{departamento}', 'ApiController@listaSetoresDepartamento');
Route::get('/sistema/usuario/setor/{setor}', 'ApiController@listaUsuariosSetor');


Route::get('/tipo_documento', 'ApiController@listaTipoDocumento');



//PROPOSTAS
Route::get('/rps/ufs', 'ApiController@listaUfsRps');
Route::get('/rps/municipios/{uf}', 'ApiController@listaMunicipiosRps');
Route::get('/rps/situacaoPropostasAjustadas', 'ApiController@listaSituacaoPropostasRps');




//debentures
Route::get('/debentures/ufs', 'ApiController@buscarEstadosDebentures');
Route::get('/reidis/ufs', 'ApiController@buscarEstadosReidis');
Route::get('/debentures/setor_projeto', 'ApiController@buscarSetorProjetoDebentures');


//debentures
Route::get('/apis/modalidade_projetos', 'ApiController@buscarModalidadeProjetos');
Route::get('/apis/situacao_conjur', 'ApiController@buscarSituacaoConjur');
Route::get('/apis/situacao_emissao', 'ApiController@buscarSituacaoEmissao');
Route::get('/apis/situacao_enquadramento', 'ApiController@buscarSituacaoEnquadramento');
Route::get('/apis/situacao_envio_publicacao', 'ApiController@buscarSituacaoEnvioPublicacao');
Route::get('/apis/situacao_publicacao', 'ApiController@buscarSituacaoPublicacao');
Route::get('/apis/situacao_analises', 'ApiController@buscarSituacaoAnalises');
Route::get('/apis/situacao_enquadramentos', 'ApiController@buscarSituacaoEnquadramentos');
Route::get('/apis/situacao_execucao', 'ApiController@buscarSituacaoExecucao');
Route::get('/apis/agente_fiduciario', 'ApiController@buscarAgenteFiduciario');

Route::get('/apis/debentures/municipios/{estado}', 'ApiController@buscarMunicipiosBeneficiados');





//******************************************************
//*********************PLANCIDADES**********************
//******************************************************

Route::get('/plancidades/objetivosPPA', 'ApiController@buscarObjetivosPPA');
Route::get('/plancidades/programas', 'ApiController@buscarProgramasPlacidades');
Route::get('/plancidades/perspectivasPEI', 'ApiController@buscarPerspectivas');
Route::get('/plancidades/anos_monitoramento', 'ApiController@buscarAnosMonitoramentos');
Route::get('/plancidades/situacao_monitoramento', 'ApiController@buscarSituacoesMonitoramentos');

Route::get('/plancidades/objetivosPPA/programa/{programa}', 'ApiController@buscarObjetivosPPAPrograma');
Route::get('/plancidades/objetivosPPA/perspectiva/{perspectiva}', 'ApiController@buscarObjetivosPPAPerspectiva');

//Objetivos Gerais
Route::get('/plancidades/objetivosGerais', 'ApiController@buscarObjetivosGerais');
Route::get('/plancidades/objetivosEspecificos/objetivoGeral/{objetivoGeralId}', 'ApiController@buscarObjetivosEspecificos');
Route::get('/plancidades/indicadores/objetivoEspecifico/{objetivoEspecificoId}', 'ApiController@buscarIndicadoresObjetivosEspecificos');

//Objetivos Estratégicos
Route::get('/plancidades/objetivosEstrategicos', 'ApiController@buscarObjetivosEstrategicos')->name('plancidades.buscarObjetivosEstrategicos');
Route::get('/plancidades/indicadores/orgaoResponsavel/{orgaoResponsavelId}', 'ApiController@buscarIndicadoresOrgao');
Route::get('/plancidades/regionalizacao/meta_indicador/{metaId}/{monitoramentoId}', 'ApiController@buscarRegionalizacoesMetaIndicadores');
Route::get('/plancidades/regionalizacaoMetaIndicador/regionalizacao/{regionalizacaoMetaIndicadorId}', 'ApiController@buscarRegionalizacaoMetaIndicador');
Route::get('/plancidades/indicadores/objetivoEstrategico/{objetivoEstrategicoId}', 'ApiController@buscarIndicadoresObjetivosEstrategicos');
Route::get('/plancidades/meta/indicador_objetivo/{indicadorId}', 'ApiController@buscarMetaIndicadorObjetivoEstrategico');




//Iniciativas de Processo
Route::get('/plancidades/iniciativas', 'ApiController@buscarObjetivosEstrategicos');
Route::get('/plancidades/iniciativas/orgaoResponsavel/{orgaoResponsavelId}', 'ApiController@buscarIniciativasOrgao');
Route::get('/plancidades/iniciativas/objetivoEstrategico/{objetivoEstrategicoId}', 'ApiController@buscarInciativasObjetivosEstrategicos');
Route::get('/plancidades/iniciativas/objetivoEstrategico/{objetivoEstrategicoId?}/unidadeResponsavel/{unidadeResponsavelId?}', 'ApiController@buscarIniciativasObjetivosEstrategicos');
Route::get('/plancidades/regionalizacao/meta_iniciativa/{metaId}/{monitoramentoId}', 'ApiController@buscarRegionalizacoesMetaIniciativas');
Route::get('/plancidades/regionalizacaoMetaIniciativa/regionalizacao/{regionalizacaoMetaIniciativaId}', 'ApiController@buscarRegionalizacaoMetaIniciativa');








//Projetos
Route::get('/plancidades/projetos', 'ApiController@buscarProjetos');
Route::get('/plancidades/projeto/{projetoId}', 'ApiController@buscarDadosProjeto');

Route::get('/plancidades/projetos/orgaoResponsavel/{orgaoResponsavelId}', 'ApiController@buscarProjetosOrgao');


Route::get('/plancidades/projetos/objetivoEstrategico/{objetivoEstrategicoId}/orgaoResponsavel/{orgaoResponsavelId}', 'ApiController@buscarProjetosObjetivosEstrategicos');
Route::get('/plancidades/projetos/periodo_monitoramento/{periodicidadeId}', 'ApiController@buscarPeriodosMonitoramentoPeriodicidades');



Route::get('/plancidades/projeto/etapas/{projetoId}', 'ApiController@buscarEtapasProjeto');
Route::get('/plancidades/etapas/monitoramento_projetos/{monitoramentoProjetoId}', 'ApiController@buscarEtapasMonitoramentoProjeto');


Route::get('/plancidades/situacoesEtapasProjeto', 'ApiController@buscarSituacoesEtapas');


//Unidades Responsáveis
Route::get('/plancidades/unidadesResponsaveis', 'ApiController@buscarUnidadesResponsaveis')->name('plancidades.buscarUnidadesResponsaveis');
Route::get('/plancidades/orgaosPEI', 'ApiController@buscarOrgaosPEI')->name('plancidades.buscarOrgaosPEI');

//Periodicidades
Route::get('/plancidades/periodicidades', 'ApiController@buscarPeriodicidades');
Route::get('/plancidades/monitoramentos/periodo_monitoramento/{periodicidadeId}', 'ApiController@buscarPeriodosMonitoramentoPeriodicidades');
Route::get('/plancidades/monitoramentos/meses_monitoramento/', 'ApiController@buscarPeriodosMonitoramentoMeses');
Route::get('/plancidades/monitoramentos/iniciativa/validar_periodo_monitoramento/{iniciativaId}/{anoMonitoramentoId}/{periodoMonitoramentoId}', 'ApiController@validarPeriodoMonitoramentoIniciativa');
Route::get('/plancidades/monitoramentos/indicador/validar_periodo_monitoramento/{indicadorId}/{anoMonitoramentoId}/{periodoMonitoramentoId}', 'ApiController@validarPeriodoMonitoramentoIndicador');
Route::get('/plancidades/monitoramentos/projeto/validar_periodo_monitoramento/{projetoId}/{anoMonitoramentoId}/{periodoMonitoramentoId}', 'ApiController@validarPeriodoMonitoramentoProjeto');

Route::get('/plancidades/revisao/indicador/validar_periodo_revisao/{indicadorId}/{anoRevisaoId}/{periodoRevisaoId}', 'ApiController@validarPeriodoRevisaoIndicador');
Route::get('/plancidades/revisao/iniciativa/validar_periodo_revisao/{iniciativaId}/{anoRevisaoId}/{periodoRevisaoId}', 'ApiController@validarPeriodoRevisaoIniciativa');

//Polaridades
Route::get('/plancidades/polaridades', 'ApiController@buscarPolaridades');



//Unidades de Medida
Route::get('/plancidades/unidadesMedida/{unidadeMedidaId}', 'ApiController@buscarUnidadeMedidaId');
Route::get('/plancidades/unidadesMedida', 'ApiController@buscarUnidadesMedida');


//Metas
Route::get('/plancidades/objetivosEstrategicos/indicador/metas/{indicadorObjetivoEstrategicoId}', 'ApiController@buscarMetasIndicadoresObjetivoEstrategicoId');
Route::get('/plancidades/objetivosEstrategicos/indicador/metas/regionalizacao/{metaId}', 'ApiController@buscarRegionalizacaoMetaId');




Route::get('/plancidades/test', 'ApiController@teste');
Route::get('/plancidades/iniciativas/objetivoEspecifico/{objetivoEspecificoId}', 'ApiController@buscarIniciativas');
Route::get('/plancidades/indicadores_iniciativas/iniciativa/{iniciativaId}', 'ApiController@buscarIndicadoresIniciativas');

//restrições atingimento meta
Route::get('/plancidades/restricoes_atingimento_meta', 'ApiController@buscarRestricoesAtingimentoMeta');





//resultado primario
Route::get('/casas_legislativas', 'ApiController@buscarCasasLegislativas');
Route::get('/comissoes/casa_legislativa/{casa_legislativa}', 'ApiController@buscarComissoes');
Route::get('/comissao/{comissao}', 'ApiController@buscarDadosComissao');
Route::get('/programas_rp', 'ApiController@buscarProgramasRps');
Route::get('/programas_rp/acao/{acao}', 'ApiController@buscarProgramasRpsAcao');
Route::get('/acoes_rp8', 'ApiController@buscarAcoesRP8');

Route::get('/oficio/casa_legislativa/{casa_legislativa}', 'ApiController@buscarOficiosCasa');
Route::get('/oficio/comissao/{comissao}', 'ApiController@buscarOficiosCcomissao');
Route::get('/situacaoOficio', 'ApiController@buscarSituacaoOficio');

Route::get('/motivoCorrecao', 'ApiController@buscarMotivoCorrecao');



Route::get('/teste', 'ApiController@Teste');



//carteira investimento
Route::get('/carteira_investimento/situacao_objeto', 'ApiController@buscarSituacaoObjeto');
Route::get('/carteira_investimento/situacao_contrato', 'ApiController@buscarSituacaoContrato');
Route::get('/carteira_investimento/origem', 'ApiController@buscarOrigem');
Route::get('/carteira_investimento/fonte', 'ApiController@buscarFonte');
Route::get('/carteira_investimento/sub_fonte/{fonte}', 'ApiController@buscarSubfonte');
Route::get('/carteira_investimento/tipo_instrumento', 'ApiController@buscarTipoInstrumento');
Route::get('/carteira_investimento/secretarias', 'ApiController@buscarSecretariasCarteira');

Route::get('/carteira_investimento/download/{file_name}', 'ApiController@downloadCarteira');

//TransfereGov
//Programas
Route::get('/transferegov/programas/buscar', 'ApiController@BuscarProgramasTransferegov');

//Eixos
Route::get('/transferegov/programas/eixos', 'ApiController@BuscarEixosTransferegov');
Route::get('/transferegov/programas/subeixos', 'ApiController@BuscarSubeixosTransferegov');
Route::get('/transferegov/programas/modalidades', 'ApiController@BuscarModalidadesTransferegov');
Route::get('/transferegov/programas/grupos', 'ApiController@BuscarGrupoModalidadeTransferegov');

//Resto
Route::get('/transferegov/programas/secretarias', 'ApiController@BuscarSecretariasTransferegov');
Route::get('/transferegov/programas/rps', 'ApiController@BuscarRpsTransferegov');
Route::get('/transferegov/programas/acoes', 'ApiController@BuscarAcoes');


//apis painel briefing
Route::get('/briefing/ficha_briefing/pesquisar/estado/{estado}/municipio/{municipio}', 'ApiController@pesquisarBriefing');


//planejamento tarefas
Route::get('/tarefas_etapas/{etapaPlanejamento}', 'ApiController@buscarTarefasEtapas');
Route::get('/planejamento_tarefa/etapas', 'ApiController@buscarEtapas');
Route::get('/planejamento_tarefa/progressos', 'ApiController@buscarProgressos');
Route::get('/planejamento_tarefa/prioridades', 'ApiController@buscarPrioridades');
Route::get('/planejamento_tarefa/periodizacoes', 'ApiController@buscarPeriodizacoes');

//transferencias especiais
Route::get('/planos_acoes/secretarias', 'ApiController@buscarSecretariasPlanosAcoes');
Route::get('/planos_acoes/situacao_analise', 'ApiController@buscarSituacaoAnalise');