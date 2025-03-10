<?php

namespace App\Http\Controllers\Mod_briefing;

use App\Corporativo\Mcid_corporativo\ViewCarteiraMcid;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\IndicadoresHabitacionais\IdhMunicipio;
use App\IndicadoresHabitacionais\Municipio;
use App\IndicadoresHabitacionais\Uf;
use App\Mod_briefing\OperacoesOguMcmv;
use App\Mod_briefing\ViewARetomarMcmv;
use App\Mod_briefing\ViewCarteiraMcidBriefing;
use App\Mod_briefing\ViewContratacaoOguMcmv;
use App\Mod_briefing\ViewEntreguesFgts;
use App\Mod_briefing\ViewEntreguesMcmv;
use App\Corporativo\Mcid_corporativo\ViewNovoPacMigrado;
use App\Mod_briefing\DadosComparativosFGTS;
use App\Mod_briefing\OrcamentoPorRegiao;
use App\Mod_briefing\TabRetomadasMcmv;
use App\Mod_briefing\ValoresUhMcmvCidades;
use App\Mod_briefing\ViewNovoPacEixoSubeixo;
use App\Mod_briefing\ViewNovoPacRelatorio;
use App\Mod_briefing\ViewPac;
use App\Mod_briefing\ViewRetomadasMcmv;
use App\Mod_briefing\ViewSelecaoMcmv;
use App\Mod_briefing\ViewSuplementacaoMcmv;
use App\Mod_briefing\ViewTipoInstrumento;
use App\Mod_indicadores_brasil\MunicipiosIndBrasil;
use App\Mod_indicadores_brasil\UfIndBrasil;
use App\Mod_sishab\Operacoes\HistoricoEntregas;

class BriefingCarteiraInvestimentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
        //$this->middleware('redirecionar'); 


    }

    public function consultarFicha()
    {
        return view('modulo_briefing.ConsultarFichaAudiencia');
    }

    public function pesquisarFicha(Request $request)
    {
        //


        $idmunicipio = $request->municipio;

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
            ->where('ibge_6_dig', $idmunicipio)->first();


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

        $novoPacEixoSubeixoEstado = ViewNovoPacEixoSubeixo::selectRaw('subeixo,modalidade,
                            COUNT(DISTINCT municipio) AS qtd_municipios,
                            SUM(vlr_portaria_total) AS vlr_portaria_total
                            ')
            ->where('uf',  $estado->sg_uf)
            ->groupBy('subeixo', 'modalidade')
            ->orderBy('subeixo')
            ->orderBy('modalidade')
            ->get();

        // return $municipio->ds_municipio_sem_acentos;
        $novoPacEixoSubeixoMunic = ViewNovoPacEixoSubeixo::selectRaw('subeixo,modalidade,
                            COUNT(DISTINCT municipio) AS qtd_municipios,
                            SUM(vlr_portaria_total) AS vlr_portaria_total
                            ')
            ->where('municipio', 'ILIKE', '%' . $municipio->ds_municipio_sem_acentos . '%')
            ->groupBy('subeixo', 'modalidade')
            ->orderBy('subeixo')
            ->orderBy('modalidade')
            ->get();

        $eixoSubeixoPACEstado = ViewCarteiraMcidBriefing::selectRaw('subeixo,modalidade,
            count(DISTINCT cod_tci) AS qtd_contratos,
            COUNT(DISTINCT cod_ibge_6dig) AS qtd_municipios,
            SUM(vlr_repasse) AS vlr_repasse
            ')
            ->where('uf',  $estado->sg_uf)
            ->where('dsc_fase_pac', 'NOVO PAC - Migrado')
            ->groupBy('subeixo', 'modalidade')
            ->orderBy('subeixo')
            ->orderBy('modalidade')
            ->get();

        $eixoSubeixoPACMunic = ViewCarteiraMcidBriefing::selectRaw('subeixo,modalidade,
                                                                count(DISTINCT cod_tci) AS qtd_contratos,
                                                                COUNT(DISTINCT cod_ibge_6dig) AS qtd_municipios,
                                                                SUM(vlr_repasse) AS vlr_repasse
                                                                ')
            ->where('cod_ibge_6dig', $idmunicipio)
            ->where('dsc_fase_pac', 'NOVO PAC - Migrado')
            ->groupBy('subeixo', 'modalidade')
            ->orderBy('subeixo')
            ->orderBy('modalidade')
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


    public function listaContratoRepasse($municipioId)
    {
        //return $municipio;
        $municipio = Municipio::find($municipioId);
        $estado = Uf::find($municipio->uf_id);
        $contratoRepasseMunic = ViewCarteiraMcidBriefing::where('bln_carteira_mcid', 'SIM')
            ->where('cod_ibge_6dig', $municipioId)
            ->where('cod_tipo_instrumento', 7)
            ->orderBy('objeto_instrumento')
            ->get();
        /*
        $dadosContratoRepJader =  ViewCarteiraMcidBriefing::selectRaw('COUNT(DISTINCT cod_tci) AS contratos')->where('bln_carteira_mcid', 'SIM')
            ->where('cod_ibge_6dig', $idmunicipio)
            ->where('cod_tipo_instrumento', 7)
            ->where('ano_contrato', '>=', 2023)->first();
            */

        return view('modulo_briefing.ListaContratoRepasse', [
            'estado' => $estado,
            'municipio' => $municipio,
            'contratoRepasseMunic' => $contratoRepasseMunic,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
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
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}