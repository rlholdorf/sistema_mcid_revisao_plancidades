<?php

namespace App\Http\Controllers;


use App\Secretaria as AppSecretaria;
use App\Setor;
use App\User;
use App\Departamento;
use App\EntePublico;
use App\TipoUsuario;
use App\ModuloSistema;
use App\RlcModuloSistemaTipoUsuario;
use App\TipoIndeferimento;
use App\ViewArquivosEnviados;


use App\Corporativo\Mcid_carteira_investimento\Fonte as Mcid_carteira_investimentoFonte;
use App\Corporativo\Mcid_corporativo\ViewProgramaResumido;


use App\Financeiro\SituacaoPropostasAjustadas;
use App\Financeiro\ViewAgrupamentoUfMunicipioRps;

use App\Mod_plancidades\Cargos;
use App\Mod_plancidades\MetasIndicadoresObjetivosEstrategicos;
use App\Mod_plancidades\OrgaosPEI;
use App\Mod_plancidades\PeriodoMonitoramento;
use App\Mod_plancidades\PeriodosMonitoramento;
use App\Mod_plancidades\PerspectivasEstrategicasPEI;
use App\Mod_plancidades\Polaridades;
use App\Mod_plancidades\RegionalizacaoMetaObjEstr;
use App\Mod_plancidades\UnidadesMedidas;
use App\Mod_plancidades\UnidadesResponsaveis;

use App\Propostas\ViewSysRelatorioGeralDiscricionarioSistema;
use App\Propostas\ModalidadeParticipacao;
use App\Propostas\ViewItensFinanciaveis;
use App\Propostas\Selecao;
use App\Propostas\SituacaoProposta;
use App\Propostas\AcaoPrograma;
use App\Propostas\MotivoCorrecao;
use App\Propostas\Propostas;
use App\Propostas\ViewItensFinanciaveisPropostas;
use App\Propostas\ViewPropostasCadastradas;


use App\IndicadoresHabitacionais\Regiao;
use App\IndicadoresHabitacionais\Municipio;
use App\IndicadoresHabitacionais\Uf;
use App\IndicadoresHabitacionais\ViewIndicadoresSaneamento;

use App\Mod_apis\AgenteFiduciario;
use App\Mod_apis\ModalidadeProjeto;
use App\Mod_apis\SituacaoConjur;
use App\Mod_apis\SituacaoEmissao;
use App\Mod_apis\SituacaoEnquadramento;
use App\Mod_apis\SituacaoEnvioPublicacao;
use App\Mod_apis\SituacaoPublicacaoPortaria;
use App\Mod_apis\SituacaoAnalise;
use App\Mod_apis\SituacaoExecucao;
use App\Mod_apis\ViewMunicipiosBeneficiadosDebentures;

use App\Mod_bndes\Andamento as Mod_bndesAndamento;
use App\Mod_bndes\RlcAndamentoSituacaoObra;
use App\Mod_bndes\SituacaoContrato as Mod_bndesSituacaoContrato;
use App\Mod_bndes\SituacaoObra;
use App\Mod_bndes\SituacaoTrabalhoTecnicoSocial;
use App\Mod_bndes\StatusDocumentacaoTitularidade;
use App\Mod_bndes\StatusLicenciamentoAmbiental;
use App\Mod_bndes\StatusLicitacao;
use App\Mod_bndes\StatusProjetoEngenharia;
use App\Mod_bndes\ViewDadosBndes;
use App\Mod_bndes\ViewMunicipiosBeneficiadosBndes;

use App\Corporativo\Mcid_carteira_investimento\Origem;
use App\Corporativo\Mcid_carteira_investimento\SituacaoContrato as Mod_carteira_investimentoSituacaoContrato;
use App\Corporativo\Mcid_carteira_investimento\SituacaoObjeto;
use App\Corporativo\Mcid_carteira_investimento\Subfonte;
use App\Corporativo\Mcid_carteira_investimento\TipoInstrumento;
use App\Mod_briefing\DadosComparativosFGTS;
use App\Mod_briefing\OrcamentoPorRegiao;
use App\Mod_briefing\TabRetomadasMcmv;
use App\Mod_briefing\ValoresUhMcmvCidades;
use App\Mod_saci\mod_sistema\Area;
use App\Mod_saci\mod_sistema\Secretaria;
use App\Mod_saci\mod_sistema\Usuario;
use App\Mod_saci\mod_pac\Fase;
use App\Mod_saci\mod_pac\Andamento;
use App\Mod_saci\mod_pac\Chamada;
use App\Mod_saci\mod_pac\ModalidadePAC;
use App\Mod_saci\mod_pac\Fonte;
use App\Mod_saci\mod_pac\SituacaoContrato;
use App\Mod_saci\mod_pac\SituacaoObraPAC;
use App\Mod_saci\mod_pac\ClassificacaoCor;
use App\Mod_saci\mod_pac\Entidade;
use App\Mod_saci\mod_pac\AgenteFinanceiro;
use App\Mod_saci\mod_pac\Eixo;
use App\Mod_saci\mod_pac\Tipo;
use App\Mod_saci\mod_pac\Programa;
use App\Mod_saci\mod_ibge\Municipio as Mod_ibgeMunicipio;


use App\Mod_codem\TipoDemanda;
use App\Mod_codem\TipoAtendimento;
use App\Mod_codem\Tema;
use App\Mod_codem\SubTema;
use App\Mod_codem\Prioridade;
use App\Mod_codem\TipoInteressado;
use App\Mod_codem\RelacaoDemanda;
use App\Mod_codem\SituacaoDemanda;
use App\Mod_codem\TipoDocumento;

use App\Mod_debentures_reidi\SetorProjeto;
use App\Mod_debentures_reidi\TipoProjeto;
use App\Mod_debentures_reidi\ViewProjetosDebentures;
use App\Mod_debentures_reidi\ViewProjetosdebenturesReidi;
use App\Mod_debentures_reidi\ViewProjetosReidis;

use App\Mod_plancidades\AnosMonitoramentos;
use App\Mod_plancidades\Entregas;
use App\Mod_plancidades\EtapasProjeto;
use App\Mod_plancidades\IndicadoresEntregas;
use App\Mod_plancidades\IndicadoresIniciativa;
use App\Mod_plancidades\IndicadoresIniciativas;
use App\Mod_plancidades\IndicadoresObjetivosEspecificos;
use App\Mod_plancidades\IndicadoresObjetivosEstrategicos;
use App\Mod_plancidades\Iniciativas;
use App\Mod_plancidades\IniciativasIndicadores;
use App\Mod_plancidades\MetasIniciativas;
use App\Mod_plancidades\MetasObjetivosEspecificos;
use App\Mod_plancidades\MonitoramentoIndicadores;
use App\Mod_plancidades\MonitoramentoIniciativas;
use App\Mod_plancidades\MonitoramentoProjetos;
use App\Mod_plancidades\ObjetivosEspecificos;
use App\Mod_plancidades\ObjetivosEstrategicos;
use App\Mod_plancidades\ObjetivosGerais;
use App\Mod_plancidades\ObjetivosPPA;
use App\Mod_plancidades\Periodicidades;
use App\Mod_plancidades\PerspectivasPEI;
use App\Mod_plancidades\Programas;
use App\Mod_plancidades\Projetos;
use App\Mod_plancidades\RegionalizacaoMetaIniciativa;
use App\Mod_plancidades\RestricoesAtingimentoMetas;
use App\Mod_plancidades\RevisaoIndicadores;
use App\Mod_plancidades\RevisaoIniciativas;
use App\Mod_plancidades\RlcMonitoramentoEtapasProjetos;
use App\Mod_plancidades\SituacoesEtapasProjetos;
use App\Mod_plancidades\SituacoesMonitoramentos;
use App\Mod_plancidades\TipoPeriodicidades;
use App\Mod_plancidades\ViewIndicadoresIniciativa;
use App\Mod_plancidades\ViewIndicadoresIniciativas;
use App\Mod_plancidades\ViewIndicadoresObjetivosEstrategicosMetas;
use App\Mod_plancidades\ViewMonitoramentoIniciativas;

use App\Mod_resultado_primario\CasasLegislativas;
use App\Mod_resultado_primario\Comissoes;
use App\Mod_resultado_primario\MotivoCorrecao as Mod_resultado_primarioMotivoCorrecao;
use App\Mod_resultado_primario\ProgramasRps;
use App\Mod_resultado_primario\SituacoesOficios;
use App\Mod_resultado_primario\ViewOficiosEmendas;


use App\Mod_briefing\ViewCarteiraMcidBriefing;
use App\Mod_briefing\ViewContratacaoOguMcmv;
use App\Mod_briefing\ViewEntreguesFgts;
use App\Mod_briefing\ViewEntreguesMcmv;
use App\Mod_briefing\ViewNovoPacEixoSubeixo;
use App\Mod_briefing\ViewNovoPacRelatorio;
use App\Mod_briefing\ViewRetomadasMcmv;
use App\Mod_briefing\ViewSelecaoMcmv;
use App\Mod_briefing\ViewSuplementacaoMcmv;
use App\Mod_indicadores_brasil\MunicipiosIndBrasil;
use App\Mod_indicadores_brasil\UfIndBrasil;
use App\Mod_planejamento_tarefas\EtapasPlanejamentos;
use App\Mod_planejamento_tarefas\Periodizacoes;
use App\Mod_planejamento_tarefas\Prioridades;
use App\Mod_planejamento_tarefas\Progressos;
use App\Mod_planejamento_tarefas\TarefasEtapas;
use App\Mod_transferegov\Acoes;
use App\Mod_transferegov\Eixos;
use App\Mod_transferegov\Rps;
use App\Mod_transferegov\Secretarias;
use App\Mod_transferegov\Subeixos;
use App\Mod_transferegov\Modalidades;
use App\Mod_transferegov\GruposModalidade;
use App\Mod_transferegov\Programa as Mod_transferegovPrograma;
use App\Mod_transferegov\Programas as Mod_transferegovProgramas;
use App\Mod_transferegov\ViewListaProgramas;
use App\Mod_transferencias_especiais\FinalidadesMetasPlanoAcoes;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Client;

class ApiController extends Controller
{

    /**APIS INDICADORES HABITACIONAIS */
    public function buscarRegioes()
    {
        return Regiao::orderBy('txt_regiao')->get();
    }

    public function buscarUfsPorRegiao($regiao)
    {
        return Uf::where('regiao_id', $regiao)->orderBy('txt_uf')->get();
    }

    public function buscarUfs()
    {
        return Uf::orderBy('txt_uf')->get();
    }

    public function buscarMunicipios($estado)
    {

        return Municipio::where('uf_id', $estado)->orderBy('ds_municipio', 'asc')->get();
    }

    public function buscarSelecoes()
    {

        return  Selecao::where('bln_ativa', true)->orderBy('txt_selecao')->orderBy('num_selecao')->get();
    }

    public function buscarSituacoesPropostas()
    {

        return  SituacaoProposta::where('bln_ativo', true)->orderBy('txt_situacao_proposta')->get();
    }

    public function motivoCorrecao()
    {

        return  MotivoCorrecao::orderBy('txt_motivo_correcao')->get();
    }



    public function itensFinModalidades(Selecao $selecao)
    {



        return  ViewItensFinanciaveis::where('modalidade_participacao_id', $selecao->modalidade_participacao_id)
            ->orderBy('txt_acao_programa')
            ->get();
    }




    public function buscarItensFinanciaveis()
    {

        return $itensFinanciveis = ViewItensFinanciaveis::get();
    }

    public function buscarTipoIndeferimento()
    {

        return TipoIndeferimento::get();
    }

    public function buscarProvidenciasOficio($tipo)
    {

        $dsc_providencia = TipoIndeferimento::find($tipo);
        return  $dsc_providencia->dsc_providencia;
    }


    public function buscarUfsOficios()
    {

        return ViewArquivosEnviados::select('uf_id', 'sg_uf')
            ->groupBy('uf_id', 'sg_uf')
            ->orderBy('sg_uf')
            ->get();
    }

    public function buscarMunicipiosOficios($estado)
    {

        return ViewArquivosEnviados::selectRaw('municipio_id, ds_municipio')->where('uf_id', $estado)->groupBy('municipio_id', 'ds_municipio')->orderBy('ds_municipio', 'asc')->get();
    }


    public function buscarEntePublico($municipio)
    {

        return EntePublico::Select("id", "txt_ente_publico")->where('municipio_id', $municipio)->orderBy('txt_ente_publico', 'asc')->get();
    }

    public function buscarMunicipiosPropostas($estado)
    {

        return ViewPropostasCadastradas::selectRaw('municipio_id as id, ds_municipio')->where('id_uf', $estado)->groupBy('municipio_id', 'ds_municipio')->orderBy('ds_municipio', 'asc')->get();
    }




    /**APIS INDICADORES HABITACIONAIS */

    /**SISTEMA */
    public function buscarTipoUsuarios()
    {

        return TipoUsuario::orderBy('txt_tipo_usuario')->get();
    }

    public function buscarTipoUsuariosModulo($modulo)
    {

        return TipoUsuario::join('rlc_modulo_sistema_tipo_usuario', 'opc_tipo_usuario.id', '=', 'rlc_modulo_sistema_tipo_usuario.tipo_usuario_id')
            ->join('opc_modulo_sistema', 'opc_modulo_sistema.id', '=', 'rlc_modulo_sistema_tipo_usuario.modulo_sistema_id')
            ->select('opc_tipo_usuario.id', 'txt_tipo_usuario')
            ->where('modulo_sistema_id', '=', $modulo)
            ->get();
    }

    public function buscarModuloSistemas()
    {

        return ModuloSistema::orderBy('txt_modulo_sistema')->get();
    }

    public function modalidadeParticipacao()
    {
        return ModalidadeParticipacao::orderBy('txt_modalidade_participacao')->get();
    }

    public function buscarAcaoPrograma()
    {
        return AcaoPrograma::orderBy('id')->get();
    }

    public function listaSecretarias()
    {
        return AppSecretaria::orderBy('txt_nome_secretaria')->get();
    }

    public function listaDepartamentos()
    {
        return Departamento::orderBy('txt_nome_departamento')->get();
    }

    public function listaSetores()
    {
        return Setor::orderBy('txt_nome_setor')->get();
    }

    public function listaDepartamentoSecretarias($secretaria)
    {
        return Departamento::where('secretaria_id', $secretaria)->orderBy('txt_nome_departamento')->get();
    }

    public function listaSetoresDepartamento($departamento)
    {
        return Setor::where('departamento_id', $departamento)->orderBy('txt_nome_setor')->get();
    }




    //MCID CORPORTIVO

    public function buscarProgramaSiconv()
    {
        return ViewProgramaResumido::select('cod_programa as id')
            ->groupBy('cod_programa')
            ->orderBy('cod_programa')->get();
    }










    //CONTRATOS PAC
    public function buscarAreas()
    {
        $secretariasAtivas = [1, 2, 14, 15];
        return Area::whereIn('cod_secretaria', $secretariasAtivas)->orderBy('dsc_area')->get();
    }

    public function buscarSecretarias()
    {
        $secretariasAtivas = [1, 2, 14, 15];
        return Secretaria::orderBy('txt_sigla_secretaria')->get();
    }

    public function buscarAreasSecretaria($secretariaId)
    {
        return Area::where('cod_secretaria', $secretariaId)->orderBy('dsc_area')->get();
    }

    public function buscarFontes()
    {
        return Fonte::orderBy('dsc_fonte')->get();
    }

    public function buscarSituacaoContratos()
    {
        return SituacaoContrato::orderBy('dsc_situacao_contrato')->get();
    }

    public function buscarSituacaoObras()
    {
        return SituacaoObraPAC::orderBy('dsc_situacao_obra')->get();
    }

    public function buscarClassificacaoCores()
    {
        return ClassificacaoCor::orderBy('dsc_classificacao_cor')->get();
    }

    public function buscarEntidades()
    {
        return Entidade::orderBy('dsc_entidade')->get();
    }

    public function buscarAgenteFinanceiros()
    {
        return AgenteFinanceiro::orderBy('dsc_agente_financeiro')->get();
    }

    public function buscarFases()
    {
        return Fase::orderBy('dsc_fase')->get();
    }


    public function buscarChamadas($fonte, $area)
    {
        $where = [];
        $where[] = ['cod_fonte', $fonte];
        $where[] = ['cod_area', $area];
        return Chamada::where($where)->orderBy('dsc_chamada')->get();
    }

    public function buscarModalidades()
    {
        return ModalidadePAC::select('cod_modalidade', 'dsc_modalidade', 'txt_sigla_modalidade')->orderBy('dsc_modalidade')->get();
    }

    public function buscarModalidadesAreas($area)
    {
        $where = [];
        $where[] = ['cod_area', $area];
        $where[] = ['cod_modalidade_pai',];
        return ModalidadePAC::select('cod_modalidade', 'dsc_modalidade', 'txt_sigla_modalidade', 'cod_area')
            ->where('cod_area', $area)
            ->whereNull('cod_modalidade_pai')
            ->orderBy('dsc_modalidade')->get();
    }

    public function buscarMonitoresAreas($area)
    {

        //return $area;
        if (($area >= 14) && ($area <= 15)) {
            $area = 3;
        }

        return Usuario::select('cod_usuario', 'txt_nome', 'cod_area')->where('cod_area', $area)->orderBy('txt_nome')->get();
    }



    public function buscarSubmodalidades()
    {

        return  ModalidadePAC::selectRaw('cod_modalidade as cod_submodalidade, dsc_modalidade as dsc_submodalidade, cod_modalidade_pai as cod_modalidade, cod_area')
            ->groupBy('cod_modalidade_pai', 'dsc_modalidade', 'cod_modalidade', 'cod_area')
            ->orderBy('dsc_modalidade')
            ->get();
    }


    public function buscarSubmodalidadesAreas($submodalidade, $area)
    {

        return  ModalidadePAC::getSubmodalidadeModalidade($submodalidade, $area);
    }

    public function buscarEstados()
    {
        return Uf::orderBy('txt_sigla_uf')->get();
    }

    public function buscarEixos()
    {
        return Eixo::orderBy('dsc_eixo')->get();
    }

    public function buscarTipos()
    {
        return Tipo::orderBy('dsc_tipo')->get();
    }

    public function buscarProgramas()
    {
        return Programa::orderBy('dsc_programa')->get();
    }

    public function buscarAndamentos()
    {
        return Andamento::orderBy('dsc_andamento')->get();
    }

    //CONTRATOS PAC

    // BNDES
    public function buscarAndamentosBndes()
    {
        return Mod_bndesAndamento::orderBy('txt_andamento')->get();
    }

    public function buscarSituacaoObraBndes()
    {
        return SituacaoObra::orderBy('txt_situacao_obra')->get();
    }

    public function buscarSituacaoObraAndamentoBndes($andamento)
    {
        return RlcAndamentoSituacaoObra::join('mcid_bndes.opc_situacao_obra', 'opc_situacao_obra.id', '=', 'rlc_andamento_situacao_obra.situacao_obra_id')
            ->where('andamento_id', $andamento)
            ->select('opc_situacao_obra.*')
            ->orderBy('txt_situacao_obra')->get();
    }

    public function buscarSituacaoContratoBndes()
    {
        return Mod_bndesSituacaoContrato::orderBy('txt_situacao_contrato')->get();
    }

    public function buscarSituacaoTrabalhoTecBndes()
    {
        return SituacaoTrabalhoTecnicoSocial::orderBy('txt_situacao_trabalho_tecnico_social')->get();
    }

    public function buscarStatusDocumentacaoBndes()
    {
        return StatusDocumentacaoTitularidade::orderBy('txt_status_documentacao_titularidade')->get();
    }

    public function buscarStatusLicenciamentoBndes()
    {
        return StatusLicenciamentoAmbiental::orderBy('txt_status_licenciamento_ambiental')->get();
    }

    public function buscarStatusLicitacaoBndes()
    {
        return StatusLicitacao::orderBy('txt_status_licitacao')->get();
    }
    public function buscarStatusProjetoEngenhariaBndes()
    {
        return StatusProjetoEngenharia::orderBy('txt_status_projeto_engenharia')->get();
    }







    public function buscarEstadosBndes()
    {

        return ViewMunicipiosBeneficiadosBndes::selectRaw('id_uf as id, sg_uf as txt_sigla_uf')
            ->groupBy('id_uf', 'sg_uf')->orderBy('sg_uf', 'asc')->get();
    }

    public function buscarMunicipiosBndes($estado)
    {

        return ViewMunicipiosBeneficiadosBndes::selectRaw('municipio_id as id, txt_municipio as ds_municipio')->where('id_uf', $estado)
            ->groupBy('municipio_id', 'txt_municipio')->orderBy('txt_municipio', 'asc')->get();
    }
    //BNDES

    //PROPOSTAS

    public function buscarProposta($protocolo)
    {

        return ViewPropostasCadastradas::where('proposta_id', $protocolo)->firstorFail();
    }

    public function buscarItensFinanciaveisProposta($protocolo)
    {

        return ViewItensFinanciaveisPropostas::where('proposta_id', $protocolo)->get();
    }

    public function buscarAcoesProposta($protocolo)
    {

        return ViewItensFinanciaveisPropostas::selectRaw('acao, txt_acao_programa')->where('proposta_id', $protocolo)->groupBy('acao', 'txt_acao_programa')->get();
    }

    public function buscarRelacaoPropostasID($entePublico)
    {

        return $propostas = ViewPropostasCadastradas::leftjoin('rlc_lista_propostas_selecionadas', 'rlc_lista_propostas_selecionadas.proposta_id', '=', 'view_propostas_cadastradas.proposta_id')
            ->select('view_propostas_cadastradas.proposta_id', 'view_propostas_cadastradas.txt_modalidade_participacao', 'view_propostas_cadastradas.vlr_intervencao')
            ->where('ente_publico_id', $entePublico)
            ->whereNull('rlc_lista_propostas_selecionadas.proposta_id')
            ->get();
    }

    public function buscarIndicadoresSanMun($municipio)
    {

        return ViewIndicadoresSaneamento::where('codigo_municipio', $municipio)
            ->get();
    }

    public function buscarSituacaoPropostaAjustada()
    {

        return ViewSysRelatorioGeralDiscricionarioSistema::select('situacao_ajustada')
            ->groupBy('situacao_ajustada')
            ->orderBy('situacao_ajustada')
            ->get();
    }

    public function buscarSistemaVsTransferegov()
    {

        return ViewSysRelatorioGeralDiscricionarioSistema::select('sistema_x_transferegov')
            ->groupBy('sistema_x_transferegov')
            ->orderBy('sistema_x_transferegov')
            ->get();
    }

    public function buscarValidaCnpj()
    {

        return ViewSysRelatorioGeralDiscricionarioSistema::select('valida_cnpj')
            ->groupBy('valida_cnpj')
            ->orderBy('valida_cnpj')
            ->get();
    }


    public function listaUfsRps()
    {

        return ViewAgrupamentoUfMunicipioRps::selectRaw('sg_uf')->groupBy('sg_uf')->get();
    }

    public function listaMunicipiosRps($uf)
    {

        return $ufsRp8 = ViewAgrupamentoUfMunicipioRps::selectRaw('ds_municipio')
            ->where('sg_uf', $uf)->groupBy('ds_municipio')->orderBy('ds_municipio')->get();
    }
    public function listaSituacaoPropostasRps()
    {
        return SituacaoPropostasAjustadas::orderBy('txt_sistuacao_proposta_ajustada')->get();
    }









    //PROPOSTAS

    //  CODEM

    public function listaTipoDemanda()
    {

        return TipoDemanda::orderBy('txt_tipo_demanda', 'asc')->get();
    }

    public function listaTipoAtendimento()
    {

        return TipoAtendimento::orderBy('txt_tipo_atendimento', 'asc')->get();
    }

    public function listaTema()
    {

        return Tema::orderBy('txt_tema', 'asc')->get();
    }

    public function listaSubTema(Tema $tema)
    {

        return SubTema::where('tema_id', $tema->id)->orderBy('txt_sub_tema', 'asc')->get();
    }

    public function listaSituacaoDemanda()
    {

        return SituacaoDemanda::orderBy('txt_situacao', 'asc')->get();
    }

    public function listaPrioridade()
    {

        return Prioridade::orderBy('txt_prioridade', 'asc')->get();
    }

    public function buscaPrioridade($qtd_dias)
    {

        return Prioridade::where('id', $qtd_dias)->value('num_max_dias');
    }

    public function listaTipoInteressado()
    {

        return TipoInteressado::orderBy('txt_tipo_interessado', 'asc')->get();
    }

    public function listaTipoDocumento()
    {

        return TipoDocumento::orderBy('txt_tipo_documento', 'asc')->get();
    }

    public function buscaIdTema($subTema)
    {

        return SubTema::where('id', $subTema)->value('tema_id');
    }

    public function listaUsuariosSetor($setor)
    {

        return User::where('setor_id', $setor)->orderBy('name')->get();
    }

    public function buscarEstadosDebentures()
    {

        return ViewProjetosDebentures::select('uf_id', 'sg_uf')->groupBy('uf_id', 'sg_uf')->orderBy('sg_uf')->get();
    }

    public function buscarEstadosReidis()
    {

        return ViewProjetosReidis::select('uf_id', 'sg_uf')->groupBy('uf_id', 'sg_uf')->orderBy('sg_uf')->get();
    }

    public function buscarTipoProjetodebentures()
    {

        return TipoProjeto::orderBy('txt_tipo_projeto')->get();
    }

    public function buscarSetorProjetodebentures()
    {

        return SetorProjeto::orderBy('txt_setor_projeto')->get();
    }

    ///      MÓDULO APIS

    public function buscarModalidadeProjetos()
    {

        return ModalidadeProjeto::orderBy('txt_modalidade_projeto')->get();
    }

    public function buscarSituacaoConjur()
    {

        return SituacaoConjur::orderBy('txt_situacao_conjur')->get();
    }

    public function buscarSituacaoEmissao()
    {

        return SituacaoEmissao::orderBy('txt_situacao_emissao')->get();
    }

    public function buscarSituacaoEnquadramento()
    {

        return SituacaoEnquadramento::orderBy('txt_situacao_enquadramento')->get();
    }

    public function buscarSituacaoEnvioPublicacao()
    {

        return SituacaoEnvioPublicacao::orderBy('txt_situacao_envio_publicacao_sns')->get();
    }

    public function buscarSituacaoPublicacao()
    {

        return SituacaoPublicacaoPortaria::orderBy('txt_situacao_publicacao_portaria')->get();
    }

    public function buscarSituacaoAnalises()
    {

        return SituacaoAnalise::orderBy('txt_situacao_analise')->get();
    }



    public function buscarSituacaoExecucao()
    {

        return SituacaoExecucao::orderBy('txt_situacao_execucao')->get();
    }

    public function buscarAgenteFiduciario()
    {

        return AgenteFiduciario::orderBy('txt_agente_fiduciario')->get();
    }

    public function buscarMunicipiosBeneficiados($estado)
    {

        $where = [];
        $where[] = ['tab_municipios.id_uf', $estado];


        //
        return $municipios = Mod_ibgeMunicipio::leftjoin(
            'mcid_sistema_apis.rlc_municipios_beneficiados_debentures',
            'tab_municipios.id_municipio',
            '=',
            'rlc_municipios_beneficiados_debentures.municipio_id'
        )
            ->select(
                'tab_municipios.id_municipio',
                'tab_municipios.ds_municipio',
                'cod_ibge_7d'
            )
            ->where($where)
            ->whereNull('rlc_municipios_beneficiados_debentures.municipio_id')
            ->orderBy('tab_municipios.ds_municipio')
            ->get();

        return  $municipios = ViewMunicipiosBeneficiadosDebentures::where('id_uf', $estado)->get();
    }


    //PLANCIDADES

    public function buscarObjetivosPPA()
    {

        return ObjetivosPPA::orderBy('txt_titulo_objetivo_ppa')->get();
    }

    public function buscarProgramasPlacidades()
    {
        return Programas::orderBy('txt_programa')->get();
    }

    public function buscarPerspectivas()
    {
        return PerspectivasPEI::orderBy('txt_perspectivas_pei')->get();
    }

    public function buscarObjetivosPPAPrograma($programa)
    {
        return ObjetivosPPA::where('programa_id', $programa)->orderBy('txt_titulo_objetivo_ppa')->get();
    }

    public function buscarObjetivosPPAPerspectiva($perspectiva)
    {
        return ObjetivosPPA::where('perspectiva_pei_id', $perspectiva)->orderBy('txt_titulo_objetivo_ppa')->get();
    }


    public function buscarObjetivosEstrategicos()
    {

        return ObjetivosEstrategicos::orderBy('txt_titulo_objetivo_estrategico_pei')->get();
    }

    public function buscarProjetosObjetivosEstrategicos($objetivoEstrategicoId, $orgaoResponsavelId)
    {
        return Projetos::where('objetivo_estrategico_pei_id', $objetivoEstrategicoId)->where('orgao_pei_id', $orgaoResponsavelId)->orderBy('txt_enunciado_projeto')->get();
    }

    public function buscarProjetosOrgao($orgaoResponsavelId)
    {
        return Projetos::join('mcid_plancidades.opc_unidades_responsaveis', 'opc_unidades_responsaveis.id', '=', 'view_projetos.unidade_responsavel_id')
            ->join('mcid_plancidades.opc_objetivos_estrategicos_pei', 'opc_objetivos_estrategicos_pei.id', '=', 'view_projetos.objetivo_estrategico_pei_id')
            ->selectRaw('view_projetos.objetivo_estrategico_pei_id as id, opc_objetivos_estrategicos_pei.txt_titulo_objetivo_estrategico_pei')
            ->where('opc_unidades_responsaveis.orgao_pei_id', $orgaoResponsavelId)
            ->groupBy('view_projetos.objetivo_estrategico_pei_id', 'opc_objetivos_estrategicos_pei.txt_titulo_objetivo_estrategico_pei')
            ->orderBy('txt_titulo_objetivo_estrategico_pei')->get();
    }

    public function buscarDadosProjeto($projetoId)
    {


        return Projetos::find($projetoId);
    }

    public function buscarAnosMonitoramentos()
    {
        return AnosMonitoramentos::orderBy('num_ano_monitoramento')->get();
    }

    public function buscarRegionalizacoesMetaIniciativas($metaId, $monitoramentoId)
    {
        return RegionalizacaoMetaIniciativa::join('mcid_plancidades.opc_regionalizacao', 'opc_regionalizacao.id', '=', 'regionalizacao_id')
            ->leftjoin('mcid_plancidades.rlc_metas_monitoramento_iniciativas', 'rlc_metas_monitoramento_iniciativas.regionalizacao_meta_iniciativa_id', '=', 'tab_regionalizacao_metas_iniciativas.id')
            ->select('tab_regionalizacao_metas_iniciativas.id as regionalizacao_meta_iniciativa_id', 'regionalizacao_id', 'opc_regionalizacao.txt_regionalizacao')
            ->where('tab_regionalizacao_metas_iniciativas.meta_iniciativa_id', $metaId)
            ->where('rlc_metas_monitoramento_iniciativas.monitoramento_iniciativa_id', $monitoramentoId)
            ->whereNull('rlc_metas_monitoramento_iniciativas.vlr_apurado')->orderBy('opc_regionalizacao.txt_regionalizacao')->get();
    }

    public function buscarRegionalizacoesMetaIndicadores($metaId, $monitoramentoId)
    {
        return RegionalizacaoMetaObjEstr::join('mcid_plancidades.opc_regionalizacao', 'opc_regionalizacao.id', '=', 'regionalizacao_id')
            ->leftjoin('mcid_plancidades.rlc_metas_monitoramento_indicadores', 'rlc_metas_monitoramento_indicadores.regionalizacao_meta_indicador_id', '=', 'tab_regionalizacao_metas_objetivos_estrategicos.id')
            ->select('tab_regionalizacao_metas_objetivos_estrategicos.id as regionalizacao_metas_objetivos_estrategicos_id', 'regionalizacao_id', 'opc_regionalizacao.txt_regionalizacao')
            ->where('tab_regionalizacao_metas_objetivos_estrategicos.meta_objetivos_estrategicos_id', $metaId)
            ->where('rlc_metas_monitoramento_indicadores.monitoramento_indicador_id', $monitoramentoId)
            ->whereNull('rlc_metas_monitoramento_indicadores.vlr_apurado')->orderBy('opc_regionalizacao.txt_regionalizacao')->get();
    }

    public function buscarRegionalizacaoMetaIniciativa($regionalizacaoMetaIniciativaId)
    {
        return RegionalizacaoMetaIniciativa::find($regionalizacaoMetaIniciativaId);
    }

    public function buscarRegionalizacaoMetaIndicador($regionalizacaoMetaIndicadorId)
    {
        return RegionalizacaoMetaObjEstr::find($regionalizacaoMetaIndicadorId);
    }



    public function buscarEtapasProjeto($projetoId)
    {
        return EtapasProjeto::where('projeto_id', $projetoId)->orderBy('id')->get();
    }


    public function buscarEtapasMonitoramentoProjeto($monitoramentoProjetoId)
    {
        return RlcMonitoramentoEtapasProjetos::join('mcid_plancidades.tab_etapas_projetos', 'tab_etapas_projetos.id', '=', 'rlc_monitoramento_projetos_etapas.etapa_projeto_id')
            ->leftjoin('mcid_plancidades.opc_situacao_etapas_projetos', 'opc_situacao_etapas_projetos.id', '=', 'rlc_monitoramento_projetos_etapas.situacao_etapa_projeto_id')
            ->select(
                'monitoramento_projeto_id',
                'etapa_projeto_id',
                'tab_etapas_projetos.dsc_etapa',
                'tab_etapas_projetos.dsc_marco',
                'dte_efetiva_inicio_etapa',
                'dte_efetiva_conclusao_etapa',
                'situacao_etapa_projeto_id',
                'txt_nome_situacao',
                'created_at'
            )
            ->where('monitoramento_projeto_id', $monitoramentoProjetoId)->orderBy('etapa_projeto_id')->get();
    }



    public function buscarSituacoesEtapas()
    {
        return SituacoesEtapasProjetos::orderBy('id')->get();
    }

    public function buscarSituacoesMonitoramentos()
    {
        return SituacoesMonitoramentos::orderBy('id')->get();
    }

    public function buscarObjetivosGerais()
    {

        return ObjetivosGerais::orderBy('txt_titulo_objetivo_geral')->get();
    }

    public function buscarOrgaosPEI()
    {
        return OrgaosPEI::orderBy('dsc_orgao')->get();
    }

    public function buscarUnidadesResponsaveis()
    {
        return UnidadesResponsaveis::orderBy('txt_unidade_responsavel')->get();
    }


    public function buscarIndicadoresOrgao($orgaoResponsavelId)
    {
        return IndicadoresObjetivosEstrategicos::join('mcid_plancidades.opc_unidades_responsaveis', 'opc_unidades_responsaveis.id', '=', 'tab_indicadores_objetivos_estrategicos.unidade_responsavel_id')
            ->join('mcid_plancidades.opc_objetivos_estrategicos_pei', 'opc_objetivos_estrategicos_pei.id', '=', 'tab_indicadores_objetivos_estrategicos.objetivo_estrategico_pei_id')
            ->selectRaw('tab_indicadores_objetivos_estrategicos.objetivo_estrategico_pei_id as id, opc_objetivos_estrategicos_pei.txt_titulo_objetivo_estrategico_pei')
            ->where('opc_unidades_responsaveis.orgao_pei_id', $orgaoResponsavelId)
            ->groupBy('tab_indicadores_objetivos_estrategicos.objetivo_estrategico_pei_id', 'opc_objetivos_estrategicos_pei.txt_titulo_objetivo_estrategico_pei')
            ->orderBy('txt_titulo_objetivo_estrategico_pei')->get();
    }

    public function buscarIniciativasOrgao($orgaoResponsavelId)
    {
        return Iniciativas::join('mcid_plancidades.opc_unidades_responsaveis', 'opc_unidades_responsaveis.id', '=', 'tab_iniciativas.unidade_responsavel_id')
            ->join('mcid_plancidades.opc_objetivos_estrategicos_pei', 'opc_objetivos_estrategicos_pei.id', '=', 'tab_iniciativas.objetivo_estrategico_pei_id')
            ->selectRaw('tab_iniciativas.objetivo_estrategico_pei_id as id, opc_objetivos_estrategicos_pei.txt_titulo_objetivo_estrategico_pei')
            ->where('opc_unidades_responsaveis.orgao_pei_id', $orgaoResponsavelId)
            ->groupBy('tab_iniciativas.objetivo_estrategico_pei_id', 'opc_objetivos_estrategicos_pei.txt_titulo_objetivo_estrategico_pei')
            ->orderBy('txt_titulo_objetivo_estrategico_pei')->get();
    }

    public function buscarMetaIndicadorObjetivoEstrategico($indicador)
    {
        return ViewIndicadoresObjetivosEstrategicosMetas::where('indicador_objetivo_estrategico_id', $indicador)->orderBy('txt_dsc_meta')->first();
    }

    public function buscarIndicadoresObjetivosEstrategicos($objetivoEstrategicoId)
    {
        return IndicadoresObjetivosEstrategicos::where('objetivo_estrategico_pei_id', $objetivoEstrategicoId)
            ->orderBy('txt_denominacao_indicador')->get();
    }

    public function buscarInciativasObjetivosEstrategicos($objetivoEstrategicoId)
    {
        return Iniciativas::where('objetivo_estrategico_pei_id', $objetivoEstrategicoId)
            ->orderBy('txt_enunciado_iniciativa')->get();
    }

    public function buscarMetasIndicadoresObjetivoEstrategicoId($indicadorObjetivoEstrategicoId)
    {

        //$metas = MetasIndicadoresObjetivosEstrategicos::where('indicador_objetivo_estrategico_id',$indicadorObjetivoEstrategicoId)->get();
    }

    public function buscarRegionalizacaoMetaId($metaId)
    {
        return RegionalizacaoMetaObjEstr::where('meta_objetivo_estrategico_id', $metaId)->orderBy('txt_regionalizacao')->get();
    }

    public function buscarPeriodicidades()
    {
        return Periodicidades::orderBy('id')->get();
    }

    public function buscarPolaridades()
    {
        return Polaridades::orderBy('id')->get();
    }

    public function buscarPeriodosMonitoramentoPeriodicidades($periodicidadeId)
    {
        return PeriodosMonitoramento::where('periodicidade_id', $periodicidadeId)->orderBy('id')->get();
    }

    public function buscarPeriodosMonitoramentoMeses()
    {
        $periodicidadeId = 6; //Periodicidade_id 6 é a periodicidade mensal para monitoramento. Retorna todos os meses do ano.
        return PeriodosMonitoramento::where('periodicidade_id', $periodicidadeId)->orderBy('id')->get();
    }

    public function validarPeriodoMonitoramentoIniciativa($iniciativaId, $anoMonitoramento, $periodoMonitoramentoId)
    {
        $where = [];
        $where[] = ['iniciativa_id', $iniciativaId];
        $where[] = ['num_ano_periodo_monitoramento', $anoMonitoramento];
        $where[] = ['periodo_monitoramento_id', $periodoMonitoramentoId];
        return MonitoramentoIniciativas::where($where)->get();
    }

    public function validarPeriodoMonitoramentoIndicador($indicadorId, $anoMonitoramento, $periodoMonitoramentoId)
    {
        $where = [];
        $where[] = ['indicador_objetivo_estrategico_id', $indicadorId];
        $where[] = ['num_ano_periodo_monitoramento', $anoMonitoramento];
        $where[] = ['periodo_monitoramento_id', $periodoMonitoramentoId];
        return MonitoramentoIndicadores::where($where)->get();
    }

    public function validarPeriodoMonitoramentoProjeto($projetoId, $anoMonitoramento, $periodoMonitoramentoId)
    {
        $where = [];
        $where[] = ['projeto_id', $projetoId];
        $where[] = ['num_ano_periodo_monitoramento', $anoMonitoramento];
        $where[] = ['periodo_monitoramento_id', $periodoMonitoramentoId];
        return MonitoramentoProjetos::where($where)->get();
    }

    public function validarPeriodoRevisaoIndicador($indicadorId, $anoRevisao, $periodoRevisaoId)
    {
        $where = [];
        $where[] = ['indicador_objetivo_estrategico_id', $indicadorId];
        $where[] = ['num_ano_periodo_revisao', $anoRevisao];
        $where[] = ['periodo_revisao_id', $periodoRevisaoId];
        return RevisaoIndicadores::where($where)->get();
    }

    public function validarPeriodoRevisaoIniciativa($iniciativaId, $anoRevisao, $periodoRevisaoId)
    {
        $where = [];
        $where[] = ['iniciativa_id', $iniciativaId];
        $where[] = ['num_ano_periodo_revisao', $anoRevisao];
        $where[] = ['periodo_revisao_id', $periodoRevisaoId];
        return RevisaoIniciativas::where($where)->get();
    }

    public function buscarUnidadeMedidaId($unidadeMedidaId)
    {
        return UnidadesMedidas::where('id', $unidadeMedidaId)->get();
    }

    public function buscarUnidadesMedida()
    {
        return UnidadesMedidas::orderBy('id')->get();
    }

    public function buscarTipoPeriodicidade($periodicidadeId)
    {
        return TipoPeriodicidades::where('periodicidade_id', $periodicidadeId)->get();
    }

    public function buscarIniciativasObjetivosEstrategicos($objetivoEstrategicoId, $unidadeResponsavelId)
    {
        $where = [];
        if ($objetivoEstrategicoId != 'vazio') {
            $where[] = ['objetivo_estrategico_pei_id', $objetivoEstrategicoId];
        }
        if ($unidadeResponsavelId != 'vazio') {
            $where[] = ['unidade_responsavel_id', $unidadeResponsavelId];
        }

        return Iniciativas::where($where)->orderBy('txt_enunciado_iniciativa')->get();
    }

    public function buscarIndicadoresIniciativas($iniciativaId)
    {
        return ViewIndicadoresIniciativas::leftJoin('mcid_plancidades.tab_metas_iniciativas', 'tab_metas_iniciativas.iniciativa_id', '=', 'view_indicadores_iniciativas.iniciativa_id')
            ->where('view_indicadores_iniciativas.iniciativa_id', $iniciativaId)
            ->orderBy('txt_denominacao_indicador')->first();

        // return IndicadoresIniciativa::join('mcid_plancidades.tab_iniciativas', 'tab_iniciativas.id', '=', 'tab_indicadores_iniciativas.iniciativa_id')
        //     ->join('mcid_plancidades.tab_metas_iniciativas', 'tab_metas_iniciativas.iniciativa_id', '=', 'tab_indicadores_iniciativas.id')
        //     ->join('mcid_plancidades.opc_unidades_medidas', 'opc_unidades_medidas.id', '=', 'tab_indicadores_iniciativas.unidade_medida_id')
        //     ->join('mcid_plancidades.opc_periodicidades', 'opc_periodicidades.id', '=', 'tab_indicadores_iniciativas.periodicidade_id')
        //     ->select(
        //         'tab_indicadores_iniciativas.id as indicador_iniciativa_id',
        //         'tab_indicadores_iniciativas.iniciativa_id',
        //         'tab_metas_iniciativas.id as iniciativa_meta_id',
        //         'txt_denominacao_indicador',
        //         'opc_unidades_medidas.txt_unidade_medida',
        //         'opc_unidades_medidas.txt_sigla_unidade_medida',
        //         'txt_dsc_meta',
        //         'vlr_meta_final_cenario_atual',
        //         'bln_pac',
        //         'bln_ppa',
        //         'bln_meta_regionalizada',
        //         'tab_indicadores_iniciativas.periodicidade_id',
        //         'opc_periodicidades.dsc_periodicidades'
        //     )
        //     ->where('tab_indicadores_iniciativas.id', $iniciativaId)
        //     ->orderBy('txt_denominacao_indicador')
        //     ->get();
    }

    public function buscarRestricoesAtingimentoMeta()
    {
        return RestricoesAtingimentoMetas::orderBy('txt_item_restricao_atingimento_meta')->get();
    }

    //RESULTADO PRIMARIO


    public function buscarCasasLegislativas()
    {
        return CasasLegislativas::orderBy('txt_casa_legislativa')->get();
    }

    public function buscarComissoes($casaLegislativa)
    {
        $where = [];
        $where[] = ['casa_legislativa_id', $casaLegislativa];

        return Comissoes::where($where)->whereNotNull('txt_presidente')->orderBy('txt_comissao')->get();
    }

    public function buscarDadosComissao($comissao)
    {
        return Comissoes::find($comissao);
    }

    public function buscarProgramasRps()
    {
        $where = [];
        $where[] = [8];

        return ProgramasRps::whereIn('resultado_primario_id', $where)->orderBy('txt_nome_programa')->get();
    }

    public function buscarProgramasRpsAcao($acao)
    {
        $where = [];
        $where[] = [8];

        return ProgramasRps::where('cod_acao_governo', $acao)->whereIn('resultado_primario_id', $where)->orderBy('txt_nome_programa')->get();
    }

    public function buscarOficiosCasa($casaLegislativa)
    {

        return ViewOficiosEmendas::where('casa_legislativa_id', $casaLegislativa)->orderBy('num_oficio_congresso')->get();
    }

    public function buscarOficiosComissao($comissao)
    {

        return ViewOficiosEmendas::where('comissao_id', $comissao)->orderBy('num_oficio_congresso')->get();
    }

    public function buscarSituacaoOficio()
    {

        return SituacoesOficios::orderBy('txt_situacao_oficio')->get();
    }

    public function buscarMotivoCorrecao()
    {

        return Mod_resultado_primarioMotivoCorrecao::orderBy('txt_motivo_correcao')->get();
    }


    // public function Teste()
    // {
    //     return Situacoes::orderBy('txt_nome_situacao')->get();
    //}



    //Programas TransfereGov

    public function BuscarProgramasTransferegov(Request $request)
    {
        $query = ViewListaProgramas::leftJoin('mcid_paineis.view_programas_cidades', 'view_lista_programas_2024.cod_programa', '=', 'view_programas_cidades.cod_programa')
            ->select(
                'view_lista_programas_2024.cod_programa',
                'view_lista_programas_2024.nom_programa',
                'view_lista_programas_2024.cod_orgao_sup_programa',
                'view_lista_programas_2024.num_ano_disponiblizacao',
                'view_lista_programas_2024.dsc_sit_programa',
                'view_lista_programas_2024.num_acao_orcamentaria',
                'view_programas_cidades.cod_programa as cod_programa_cidades',
                'view_programas_cidades.cod_acao',
                'view_programas_cidades.cod_resultado_primario',
                'view_programas_cidades.txt_rp',
                'view_programas_cidades.id_secretaria',
                'view_programas_cidades.txt_sigla_secretaria',
                'view_programas_cidades.cod_eixo',
                'view_programas_cidades.txt_eixo',
                'view_programas_cidades.cod_subeixo',
                'view_programas_cidades.txt_subeixo',
                'view_programas_cidades.cod_modalidade',
                'view_programas_cidades.txt_modalidade',
                'view_programas_cidades.cod_grupo_modalidade',
                'view_programas_cidades.txt_grupo_modalidade',
                'view_programas_cidades.bln_novo_pac'
            );

        if ($request->acao) {
            $query->where('view_programas_cidades.cod_acao', $request->acao);
        }
        if ($request->ano) {
            $query->where('view_lista_programas_2024.num_ano_disponiblizacao', $request->ano);
        }
        if ($request->rp) {
            $query->where('view_programas_cidades.cod_resultado_primario', $request->rp);
        }
        if ($request->bln_novo_pac) {
            $query->where('view_programas_cidades.bln_novo_pac', $request->bln_novo_pac);
        }
        if ($request->secretaria) {
            $query->where('view_programas_cidades.id_secretaria', $request->secretaria);
        }
        if ($request->eixo) {
            $query->where('view_programas_cidades.cod_eixo', $request->eixo);
        }
        if ($request->subeixo) {
            $query->where('view_programas_cidades.cod_subeixo', $request->subeixo);
        }
        if ($request->modalidade) {
            $query->where('view_programas_cidades.cod_modalidade', $request->modalidade);
        }
        if ($request->grupo) {
            $query->where('view_programas_cidades.cod_grupo_modalidade', $request->grupo);
        }

        if ($request->txt_busca) {

            //Colunas específicas para buscar por texto
            $colunas = [
                'view_lista_programas_2024.cod_programa',
                'view_lista_programas_2024.nom_programa',
                'view_lista_programas_2024.cod_orgao_sup_programa',
                'view_lista_programas_2024.dsc_sit_programa',
                'view_lista_programas_2024.num_acao_orcamentaria',
                'view_programas_cidades.cod_programa',
                'view_programas_cidades.cod_acao',
                'view_programas_cidades.txt_rp',
                'view_programas_cidades.txt_sigla_secretaria',
                'view_programas_cidades.txt_eixo',
                'view_programas_cidades.txt_subeixo',
                'view_programas_cidades.txt_modalidade',
                'view_programas_cidades.txt_grupo_modalidade'
            ];

            //Verifica em cada coluna se o texto informado no filtro existe
            $query->where(function ($query) use ($colunas, $request) {
                foreach ($colunas as $index => $coluna) {
                    if ($index === 0) {
                        $query->where($coluna, 'ILIKE', '%' . $request->txt_busca . '%');
                    } else {
                        $query->orWhere($coluna, 'ILIKE', '%' . $request->txt_busca . '%');
                    }
                }
            });
        }

        $resultados = $query->orderby('cod_programa', 'desc')->get();

        return $resultados;
    }

    public function BuscarEixosTransferegov()
    {
        $where = [7, 10];
        return Eixos::whereIn('cod_eixo', $where)->orderBy('txt_eixo')->get();
    }

    public function BuscarSubeixosTransferegov(Request $request)
    {
        $where = [];
        //Se a api recebeu um parâmetro EIXO como filtro
        if ($request->eixo) {
            $where[] = ['cod_eixo', $request->eixo];
        }

        return Subeixos::where($where)->orderBy('txt_subeixo')->get();
    }

    public function BuscarModalidadesTransferegov(Request $request)
    {
        $where = [];
        if ($request->subeixo) {
            $where[] = ['cod_subeixo', $request->subeixo];
        }
        return Modalidades::where($where)->orderBy('txt_modalidade')->get();
    }

    public function BuscarGrupoModalidadeTransferegov()
    {
        return GruposModalidade::orderBy('txt_grupo_modalidade')->get();
    }

    public function BuscarSecretariasTransferegov()
    {
        $where = [];
        $where[] = ['cargo_id', 9]; //buscar apenas secretarias nacionais
        return Secretarias::where($where)->orderBy('txt_nome_secretaria')->get();
    }

    public function BuscarRpsTransferegov()
    {
        return Rps::orderBy('txt_rp')->get();
    }

    public function BuscarAcoes()
    {
        return Acoes::orderBy('cod_acao_governo')->get();
    }




    //carteira investimento



    public function buscarSituacaoContrato()
    {
        return Mod_carteira_investimentoSituacaoContrato::orderBy('dsc_situacao_contrato_mcid')->get();
    }

    public function buscarSituacaoObjeto()
    {
        return SituacaoObjeto::orderBy('dsc_situacao_objeto_mcid')->get();
    }

    public function buscarOrigem()
    {
        return Origem::orderBy('txt_origem')->get();
    }

    public function buscarSubfonte($fonte)
    {
        return Subfonte::where('cod_fonte', $fonte)->orderBy('dsc_sub_fonte')->get();
    }

    public function buscarFonte()
    {
        return Mcid_carteira_investimentoFonte::orderBy('dsc_fonte')->get();
    }

    public function buscarTipoInstrumento()
    {
        return TipoInstrumento::orderBy('txt_tipo_instrumento')->where('bln_ativo', true)->get();
    }

    public function buscarSecretariasCarteira()
    {
        $secretariasCarteira = [11, 12, 13, 14, 15];
        return AppSecretaria::whereIn('id', $secretariasCarteira)->orderBy('txt_sigla_secretaria')->get();
    }



    public function downloadCarteira($file_name)
    {
        $file_path = public_path('/arquivos/dados_abertos/' . $file_name);
        return response()->download($file_path);
    }



    //apis briefing
    public function pesquisarBriefing($idestado, $idmunicipio)
    {
        //





        $where = [];
        $where[] = ['dsc_situacao_objeto_mcid', 'CONCLUIDA'];
        $where[] = ['data_fim_obra', '>=', '2023-01-01'];



        if ($idmunicipio) {
            $municipio = MunicipiosIndBrasil::find($idmunicipio);
            $estado = UfIndBrasil::find($municipio->id_uf);
            $idestado = $estado->id_uf;
            $municipio->load('ufindbrasil');
            $whereEstado[] = ['uf', $estado->sg_uf];
            $whereMunic[] = ['cod_ibge_6dig', $idmunicipio];
            $whereOguEstado[] = ['uf',  $estado->sg_uf];
            $whereOguMunic[] = ['cod_ibge_6dig', $idmunicipio];
        }

        //return $where;
        $carteriaMcidEstado = ViewCarteiraMcidBriefing::selectRaw('
                                            COUNT(DISTINCT cod_tci) AS contratos, 
                                            COUNT(DISTINCT cod_ibge_6dig) AS municipios, 
                                            SUM(vlr_investimento) AS vlr_investimento_total, 
                                            SUM(vlr_repasse) AS vlr_global, 
                                            SUM(vlr_empenhado) AS vlr_empenhado, 
                                            SUM(vlr_desembolsado) AS vlr_desembolsado, 
                                            SUM(vlr_repasse)-SUM(vlr_desembolsado) AS vlr_executar, 
                                            SUM(vlr_desbloqueado) AS vlr_desbloqueados')
            ->where('uf',  $estado->sg_uf)
            ->first();

        $carteriaMcidMunicipio = ViewCarteiraMcidBriefing::selectRaw('
                                            COUNT(DISTINCT cod_tci) AS contratos, 
                                            COUNT(DISTINCT cod_ibge_6dig) AS municipios, 
                                            SUM(vlr_investimento) AS vlr_investimento_total, 
                                            SUM(vlr_repasse) AS vlr_global, 
                                            SUM(vlr_empenhado) AS vlr_empenhado, 
                                            SUM(vlr_desembolsado) AS vlr_desembolsado, 
                                            SUM(vlr_repasse)-SUM(vlr_desembolsado) AS vlr_executar, 
                                            SUM(vlr_desbloqueado) AS vlr_desbloqueados')
            ->where('cod_ibge_6dig', $idmunicipio)
            ->first();
        /*
        return $eixosEstado = ViewCarteiraMcidBriefing::selectRaw('eixo,cod_fase_pac,dsc_fase_pac,
                                            COUNT(DISTINCT cod_tci) AS contratos, 
                                            COUNT(DISTINCT cod_ibge_6dig) AS municipios, 
                                            SUM(vlr_investimento) AS vlr_investimento_total, 
                                            SUM(vlr_repasse) AS vlr_global
                                            ')
            ->where('uf',  $estado->sg_uf)
            ->groupBy('eixo', 'cod_fase_pac', 'dsc_fase_pac')
            ->get();
*/
        $contratoRepasseEstado = ViewCarteiraMcidBriefing::selectRaw('
                                            secretaria,
                                            ano_contrato,
                                            COUNT(DISTINCT cod_tci) AS contratos, 
                                            COUNT(DISTINCT cod_ibge_6dig) AS municipios, 
                                            SUM(vlr_investimento) AS vlr_investimento_total, 
                                            SUM(vlr_repasse) AS vlr_global, 
                                            SUM(vlr_empenhado) AS vlr_empenhado, 
                                            SUM(vlr_desembolsado) AS vlr_desembolsado, 
                                            SUM(vlr_repasse)-SUM(vlr_desembolsado) AS vlr_executar, 
                                            SUM(vlr_desbloqueado) AS vlr_desbloqueados')
            ->where('bln_carteira_mcid', 'SIM')
            ->where('uf',  $estado->sg_uf)
            ->where('cod_tipo_instrumento', 7)
            ->groupBy('secretaria', 'ano_contrato')
            ->get();

        $contratoRepasseMunic = ViewCarteiraMcidBriefing::selectRaw('
                                                        secretaria,
                                                        COUNT(DISTINCT cod_tci) AS contratos, 
                                                        COUNT(DISTINCT cod_ibge_6dig) AS municipios, 
                                                        SUM(vlr_investimento) AS vlr_investimento_total, 
                                                        SUM(vlr_repasse) AS vlr_global, 
                                                        SUM(vlr_empenhado) AS vlr_empenhado, 
                                                        SUM(vlr_desembolsado) AS vlr_desembolsado, 
                                                        SUM(vlr_repasse)-SUM(vlr_desembolsado) AS vlr_executar, 
                                                        SUM(vlr_desbloqueado) AS vlr_desbloqueados')
            ->where('bln_carteira_mcid', 'SIM')
            ->where('cod_ibge_6dig', $idmunicipio)
            ->where('cod_tipo_instrumento', 7)
            ->groupBy('secretaria')
            ->get();

        $dadosContratoRepJader =  ViewCarteiraMcidBriefing::selectRaw('COUNT(DISTINCT cod_tci) AS contratos')->where('bln_carteira_mcid', 'SIM')
            ->where('cod_ibge_6dig', $idmunicipio)
            ->where('cod_tipo_instrumento', 7)
            ->where('ano_contrato', '>=', 2023)->first();
        /*
            WHERE bln_carteira_mcid = 'SIM'
            AND cod_tipo_instrumento = 7
            AND uf = 'PA' and municipio = 'Belém'
            AND ano_contrato >=2023;
*/

        $whereOguEstado[] = ['tipo_instrumento', 'Contrato Minha Casa Minha Vida'];
        $whereOguMunic[] = ['tipo_instrumento', 'Contrato Minha Casa Minha Vida'];

        $oguMcmvEstado = ViewCarteiraMcidBriefing::selectRaw('
                                            COUNT(DISTINCT cod_tci) AS contratos, 
                                            COUNT(DISTINCT cod_ibge_6dig) AS municipios, 
                                            SUM(qtd_uh) AS qtd_uh,
                                            SUM(vlr_investimento) AS vlr_investimento_total, 
                                            SUM(vlr_repasse) AS vlr_global, 
                                            SUM(vlr_empenhado) AS vlr_empenhado, 
                                            SUM(vlr_desembolsado) AS vlr_desembolsado, 
                                            SUM(vlr_repasse)-SUM(vlr_desembolsado) AS vlr_executar, 
                                            SUM(vlr_desbloqueado) AS vlr_desbloqueados')
            ->where($whereOguEstado)
            ->first();

        $ativaMcmvEstado = ViewCarteiraMcidBriefing::selectRaw('
                                            COUNT(DISTINCT cod_tci) AS contratos, 
                                            COUNT(DISTINCT cod_ibge_6dig) AS municipios, 
                                            SUM(qtd_uh) AS qtd_uh,
                                            SUM(vlr_investimento) AS vlr_investimento_total, 
                                            SUM(vlr_repasse) AS vlr_global, 
                                            SUM(vlr_empenhado) AS vlr_empenhado, 
                                            SUM(vlr_desembolsado) AS vlr_desembolsado, 
                                            SUM(vlr_repasse)-SUM(vlr_desembolsado) AS vlr_executar, 
                                            SUM(vlr_desbloqueado) AS vlr_desbloqueados')
            ->where($whereOguEstado)
            ->first();

        $oguMcmvMunicipio = ViewCarteiraMcidBriefing::selectRaw('
                                            COUNT(DISTINCT cod_tci) AS contratos, 
                                            COUNT(DISTINCT cod_ibge_6dig) AS municipios, 
                                            SUM(qtd_uh) AS qtd_uh,
                                            SUM(vlr_investimento) AS vlr_investimento_total, 
                                            SUM(vlr_repasse) AS vlr_global, 
                                            SUM(vlr_empenhado) AS vlr_empenhado, 
                                            SUM(vlr_desembolsado) AS vlr_desembolsado, 
                                            SUM(vlr_repasse)-SUM(vlr_desembolsado) AS vlr_executar, 
                                            SUM(vlr_desbloqueado) AS vlr_desbloqueados')
            ->where($whereOguMunic)
            ->first();

        $whereOguEstado[] = ['bln_carteira_ativa_mcid', 'SIM'];
        $whereOguMunic[] = ['bln_carteira_ativa_mcid', 'SIM'];

        $ativaMcmvEstado = ViewCarteiraMcidBriefing::selectRaw('
                        COUNT(DISTINCT cod_tci) AS contratos, 
                        COUNT(DISTINCT cod_ibge_6dig) AS municipios, 
                        SUM(qtd_uh) AS qtd_uh,
                        SUM(vlr_investimento) AS vlr_investimento_total, 
                        SUM(vlr_repasse) AS vlr_global, 
                        SUM(vlr_empenhado) AS vlr_empenhado, 
                        SUM(vlr_desembolsado) AS vlr_desembolsado, 
                        SUM(vlr_repasse)-SUM(vlr_desembolsado) AS vlr_executar, 
                        SUM(vlr_desbloqueado) AS vlr_desbloqueados')
            ->where($whereOguEstado)
            ->first();

        $ativaMcmvMunicipio = ViewCarteiraMcidBriefing::selectRaw('
                                            COUNT(DISTINCT cod_tci) AS contratos, 
                                            COUNT(DISTINCT cod_ibge_6dig) AS municipios, 
                                            SUM(qtd_uh) AS qtd_uh,
                                            SUM(vlr_investimento) AS vlr_investimento_total, 
                                            SUM(vlr_repasse) AS vlr_global, 
                                            SUM(vlr_empenhado) AS vlr_empenhado, 
                                            SUM(vlr_desembolsado) AS vlr_desembolsado, 
                                            SUM(vlr_repasse)-SUM(vlr_desembolsado) AS vlr_executar, 
                                            SUM(vlr_desbloqueado) AS vlr_desbloqueados')
            ->where($whereOguMunic)
            ->first();

        //return count($carteriaMcid);
        $selecaoMcmvEstado = ViewSelecaoMcmv::selectRaw('txt_modalidade, txt_tipo,SUM(num_uh) AS num_uh, 
                                                    COUNT(DISTINCT ibge_6_dig) AS qtd_municipios,
                                                    SUM(vlr_selecao) AS vlr_selecao')
            ->where('txt_uf',  $estado->sg_uf)
            ->groupBy('txt_modalidade', 'txt_tipo')
            ->orderBy('txt_modalidade')
            ->orderBy('txt_tipo')
            ->get();





        $selecaoMcmvMunicipio = ViewSelecaoMcmv::selectRaw('txt_modalidade, txt_tipo, SUM(num_uh) AS num_uh, 

                                        SUM(vlr_selecao) AS vlr_selecao')
            ->where('ibge_6_dig', $idmunicipio)
            ->groupBy('txt_modalidade', 'txt_tipo')
            ->orderBy('txt_modalidade')
            ->orderBy('txt_tipo')
            ->get();


        $entreguesOguEstado = ViewEntreguesMcmv::selectRaw('sum(num_uh) as num_uh, sum(num_uh_entregues_ate_2022) as num_uh_entregues_ate_2022,
                                                sum(num_uh_entregues_2023) as num_uh_entregues_2023,
                                                sum(num_uh_entregues_2024) as num_uh_entregues_2024')
            ->where('txt_sigla_uf',  $estado->sg_uf)->first();

        $entreguesOguMunic = ViewEntreguesMcmv::selectRaw('sum(num_uh) as num_uh, sum(num_uh_entregues_ate_2022) as num_uh_entregues_ate_2022,
                                                sum(num_uh_entregues_2023) as num_uh_entregues_2023,
                                                sum(num_uh_entregues_2024) as num_uh_entregues_2024')
            ->where('cod_ibge', $idmunicipio)->first();


        $entreguesFgtsEstado = ViewEntreguesFgts::selectRaw('sum(num_uh) as num_uh, sum(vlr_financiamento_2023+vlr_financiamento_2024) as vlr_financiamento,
                                                sum(num_uh_entregues_ate_2022) as num_uh_entregues_ate_2022,
                                                sum(num_uh_entregues_2023) as num_uh_entregues_2023,
                                                sum(num_uh_entregues_2024) as num_uh_entregues_2024')
            ->where('txt_sigla_uf',  $estado->sg_uf)->first();

        $entreguesFgtsMunic = ViewEntreguesFgts::selectRaw('sum(num_uh) as num_uh, sum(vlr_financiamento_2023+vlr_financiamento_2024) as vlr_financiamento,
                                                sum(num_uh_entregues_ate_2022) as num_uh_entregues_ate_2022,
                                                sum(num_uh_entregues_2023) as num_uh_entregues_2023,
                                                sum(num_uh_entregues_2024) as num_uh_entregues_2024')
            ->where('cod_ibge', $idmunicipio)->first();


        $retomadaEstado = TabRetomadasMcmv::selectRaw('sum(num_uh_contratada) as num_uh_contratada,
                                                    sum(vlr_novo_contatado_uniao) as vlr_novo_contratado_uniao,
                                                    sum(vlr_suplementado) as vlr_suplementado')
            ->where('txt_uf',  $estado->sg_uf)->first();

        $retomadaMunicipio = TabRetomadasMcmv::selectRaw('sum(num_uh_contratada) as num_uh_contratada,
                                                    sum(vlr_novo_contatado_uniao) as vlr_novo_contratado_uniao,
                                                    sum(vlr_suplementado) as vlr_suplementado')
            ->where('cod_ibge', $idmunicipio)->first();


        $suplementacaoEstado = ViewSuplementacaoMcmv::selectRaw('sum(num_uh_contratadas) as num_uh_contratada,
                                                            sum(vlr_novo_contatado_uniao) as vlr_novo_contatado_uniao,
                                                            sum(vlr_suplementacao) as vlr_suplementacao')
            ->where('txt_uf',  $estado->sg_uf)->first();

        $suplementacaoMunicipio = ViewSuplementacaoMcmv::selectRaw('sum(num_uh_contratadas) as num_uh_contratada,
                                                            sum(vlr_novo_contatado_uniao) as vlr_novo_contatado_uniao,
                                                            sum(vlr_suplementacao) as vlr_suplementacao')
            ->where('ibge_6_dig',  $idmunicipio)->first();


        $listaNovoPacSelecaoEstado = ViewNovoPacRelatorio::selectRaw('UPPER(modalidade) AS modalidade,
                        SUM(vlr_investimento) AS vlr_investimento                                  
                        ')
            ->where('uf',  $estado->sg_uf)
            ->groupBy('modalidade')
            ->orderBy('modalidade')
            ->get();

        $novoPacSelecaoEstado = ViewNovoPacRelatorio::selectRaw('SUM(vlr_investimento) AS vlr_investimento                                  
                        ')
            ->where('uf',  $estado->sg_uf)
            ->first();


        $listaNovoPacSelecaoMunic = ViewNovoPacRelatorio::selectRaw('UPPER(modalidade) AS modalidade,
                                                                    SUM(vlr_investimento) AS vlr_investimento                                  
                                                                    ')
            ->where('cod_ibge', $idmunicipio)
            ->groupBy('modalidade')
            ->orderBy('modalidade')
            ->get();

        $novoPacSelecaoMunic = ViewNovoPacRelatorio::selectRaw('SUM(vlr_investimento) AS vlr_investimento')
            ->where('cod_ibge', $idmunicipio)
            ->first();

        $novoPacEixoSubeixoEstado = ViewNovoPacEixoSubeixo::selectRaw('eixo,subeixo,
                            COUNT(DISTINCT municipio) AS qtd_municipios,
                            SUM(vlr_portaria_total) AS vlr_portaria_total
                            ')
            ->where('uf',  $estado->sg_uf)
            ->groupBy('eixo', 'subeixo')
            ->orderBy('eixo')
            ->get();

        // return $municipio->ds_municipio_sem_acentos;
        $novoPacEixoSubeixoMunic = ViewNovoPacEixoSubeixo::selectRaw('eixo,subeixo,
                            COUNT(DISTINCT municipio) AS qtd_municipios,
                            SUM(vlr_portaria_total) AS vlr_portaria_total
                            ')
            ->where('municipio', 'ILIKE', '%' . $municipio->ds_municipio_sem_acentos . '%')
            ->groupBy('eixo', 'subeixo')
            ->orderBy('eixo')
            ->get();

        $eixoSubeixoPACEstado = ViewCarteiraMcidBriefing::selectRaw('eixo,subeixo,
            count(DISTINCT cod_tci) AS qtd_contratos,
            COUNT(DISTINCT cod_ibge_6dig) AS qtd_municipios,
            SUM(vlr_repasse) AS vlr_repasse
            ')
            ->where('uf',  $estado->sg_uf)
            ->where('dsc_fase_pac', 'NOVO PAC - Migrado')
            ->groupBy('eixo', 'subeixo')
            ->orderBy('eixo')
            ->get();

        $eixoSubeixoPACMunic = ViewCarteiraMcidBriefing::selectRaw('eixo,subeixo,
                                                                count(DISTINCT cod_tci) AS qtd_contratos,
                                                                COUNT(DISTINCT cod_ibge_6dig) AS qtd_municipios,
                                                                SUM(vlr_repasse) AS vlr_repasse
                                                                ')
            ->where('cod_ibge_6dig', $idmunicipio)
            ->where('dsc_fase_pac', 'NOVO PAC - Migrado')
            ->groupBy('eixo', 'subeixo')
            ->orderBy('eixo')
            ->get();

        $valoresUhMcmvCidadesEstado = ValoresUhMcmvCidades::selectRaw('SUM((vlr_apto+vlr_casa)/2)/COUNT(cod_ibge) as vlr_uh')
            ->where('txt_sigla_uf',  $estado->sg_uf)
            ->first();


        $valoresUhMcmvCidadesMunic = ValoresUhMcmvCidades::selectRaw('(vlr_apto+vlr_casa)/2 as vlr_uh')->first();

        $dadosComparativosFGTS = DadosComparativosFGTS::where('txt_sigla_uf',  $estado->sg_uf)->orderBy('txt_regiao')->orderBy('txt_sigla_uf')->get();

        $orcamentoPorRegiao = OrcamentoPorRegiao::orderBy('txt_regiao')->get();

        return view('modulo_briefing.FichaAudiencia', [
            'estado' => $estado,
            'municipio' => $municipio,
            'carteriaMcidEstado' => $carteriaMcidEstado,
            'carteriaMcidMunicipio' => $carteriaMcidMunicipio,
            'oguMcmvEstado' => $oguMcmvEstado,
            'oguMcmvMunicipio' => $oguMcmvMunicipio,
            'selecaoMcmvEstado' => $selecaoMcmvEstado,
            'selecaoMcmvMunicipio' => $selecaoMcmvMunicipio,
            'entreguesOguEstado' => $entreguesOguEstado,
            'entreguesOguMunic' => $entreguesOguMunic,
            'entreguesFgtsEstado' => $entreguesFgtsEstado,
            'entreguesFgtsMunic' => $entreguesFgtsMunic,
            'retomadaEstado' => $retomadaEstado,
            'retomadaMunicipio' => $retomadaMunicipio,
            'suplementacaoEstado' => $suplementacaoEstado,
            'suplementacaoMunicipio' => $suplementacaoMunicipio,
            'entreguesFgtsEstado' => $entreguesFgtsEstado,
            'entreguesFgtsMunic' => $entreguesFgtsMunic,
            'listaNovoPacSelecaoEstado' => $listaNovoPacSelecaoEstado,
            'novoPacSelecaoEstado' => $novoPacSelecaoEstado,
            'listaNovoPacSelecaoMunic' => $listaNovoPacSelecaoMunic,
            'novoPacSelecaoMunic' => $novoPacSelecaoMunic,
            'contratoRepasseEstado' => $contratoRepasseEstado,
            'contratoRepasseMunic' => $contratoRepasseMunic,
            'dadosContratoRepJader' => $dadosContratoRepJader,
            'dadosComparativosFGTS' => $dadosComparativosFGTS,
            'orcamentoPorRegiao' => $orcamentoPorRegiao,
            'valoresUhMcmvCidadesEstado' => $valoresUhMcmvCidadesEstado,
            'valoresUhMcmvCidadesMunic' => $valoresUhMcmvCidadesMunic,
            'ativaMcmvEstado' => $ativaMcmvEstado,
            'ativaMcmvMunicipio' => $ativaMcmvMunicipio,
            'eixoSubeixoPACEstado' => $eixoSubeixoPACEstado,
            'eixoSubeixoPACMunic' => $eixoSubeixoPACMunic,
            'novoPacEixoSubeixoEstado' => $novoPacEixoSubeixoEstado,
            'novoPacEixoSubeixoMunic' => $novoPacEixoSubeixoMunic,
        ]);
    }


    public function buscarTarefasEtapas($etapaPlanejamento)
    {
        $tarefas = TarefasEtapas::where('etapa_planejamento_id', $etapaPlanejamento)->get();
        $tarefas->load('secretaria', 'user');
        return json_encode($tarefas);
    }

    public function buscarEtapas()
    {
        return EtapasPlanejamentos::orderBy('txt_nome_etapa_planejamento')->get();
    }

    public function buscarProgressos()
    {
        return Progressos::get();
    }

    public function buscarPrioridades()
    {
        return Prioridades::get();
    }

    public function buscarPeriodizacoes()
    {
        return Periodizacoes::get();
    }


    public function buscarSecretariasPlanosAcoes()
    {
        return FinalidadesMetasPlanoAcoes::select('txt_secretaria_objeto')->groupBy('txt_secretaria_objeto')->orderBy('txt_secretaria_objeto')->get();
    }

    public function buscarSituacaoAnalise()
    {
        return SituacaoAnalise::orderBy('txt_situacao_analise')->get();
    }
}