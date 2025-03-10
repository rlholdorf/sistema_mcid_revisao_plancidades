<template>
    <div class="form-group">
        <div class="row">
            <div class="text-center">
                <span class="fs-5 fw-bold">Descrição do projeto</span>
            </div>
        </div>
        <div class="row mt-5">
            <div class="column col-6 col-xs-12">
                <label for="objetivoEstrategico">Objetivo Estratégico</label> <!-- Alterar para Objetivo Estratégico PEI após alterações no Banco -->
                <p v-text="dadosMonitoramento.txt_titulo_objetivo_estrategico_pei"></p>
            </div>

            <div class="column col-6 col-xs-12">
                <label for="orgaoResponsavel">Órgão Responsável</label> <!-- Alterar para Objetivo Estratégico PEI após alterações no Banco -->
                <p v-text="dadosProjeto.dsc_orgao"></p>
            </div>
        </div>
        

        <div v-if="dadosProjeto.dsc_min_ppa != null" class="row mt-3">
            <div class="column col-xs-12 col-sm-12">
                <label>Medida Institucional e Normativa PPA</label>
                <p v-text="dadosProjeto.dsc_min_ppa"></p>
            </div>
        </div>

        <div class="row mt-3">
            <div class="column col-xs-12 col-sm-6">
                <label>Gerente do Projeto</label>
                <p v-text="dadosProjeto.dsc_nome_gerente"></p>
            </div>

            <div class="column col-xs-12 col-sm-6">
                <label>Unidade Responsável</label>
                <p v-text="dadosProjeto.txt_unidade_responsavel"></p>
            </div>
        </div><!-- div row -->


        <div class="row mt-3">
            <div class="column col-xs-12 col-sm-3">
                <label for="periodoMonitoramento">Ano de Monitoramento</label>
                <p v-text="dadosMonitoramento.num_ano_periodo_monitoramento"></p>
            </div>

            <div class="column col-xs-12 col-sm-3">
                <label for="periodoMonitoramento">Periodo de Monitoramento</label>
                <p v-text="dadosMonitoramento.dsc_periodo_monitoramento"></p>
            </div>

            <div class="column col-xs-12 col-sm-3">
                <label for="situacaoMonitoramento">Situação do Monitoramento</label>
                <p v-text="txt_situacao_monitoramento"></p>
            </div>

            <div v-if="situacao_monitoramento_observacao" class="column col-xs-12 col-sm-12">
                <label for="observacaoMonitoramento">Observações CGPI sobre o Monitoramento</label>
                <p v-text="situacao_monitoramento_observacao"></p>
            </div>
        </div>
        
        <hr>
        
        <!-- *************************************************************************************************** -->
        <!-- ***************************************** CAMPOS DE ETAPAS **************************************** -->
        <!-- *************************************************************************************************** -->

        <div class="row justify-content-center">
            <div class="column col-10">
                <div class="text-center mt-3">
                    <span class="fs-5 fw-bold">Progresso do Projeto</span>
                </div>
                <div>
                    <div class="mt-3">
                        <p><label>Progresso atual:</label> {{dadosProjeto.percentualAtual}}%</p>
                        <div class="progress">
                            <div :class="['progress-bar', corProgressoPorcentagem(this.dadosProjeto.percentualAtual)]" role="progressbar" :style="{width:dadosProjeto.percentualAtual + '%'}" :aria-valuenow="{width:dadosProjeto.percentualAtual + '%'}" aria-valuemin="0" aria-valuemax="100"></div>
                            <input type="hidden" name="vlr_percentual_atual" id="vlr_percentual_atual" :value="dadosProjeto.percentualAtual">
                        </div>
                    </div>

                    <div class="mt-3">
                        <p><label>Progresso validado:</label> {{dadosProjeto.vlr_percentual_validado}}%</p>
                        <div class="progress">
                            <div :class="['progress-bar', corProgressoPorcentagem(this.dadosProjeto.vlr_percentual_validado)]" role="progressbar" :style="{width:dadosProjeto.vlr_percentual_validado + '%'}" :aria-valuenow="{width:dadosProjeto.vlr_percentual_validado + '%'}" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>

                    <div class="mt-3">
                        <p><label>Previsão para o fim do ano: </label> {{PercentualEstimadoAno()}}%</p>
                        <div class="progress">
                            <div class="progress-bar bg-primary" role="progressbar" :style="{width:PercentualEstimadoAno() + '%'}" :aria-valuenow="{width:dadosProjeto.progressoProjeto + '%'}" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
        
        <slot>

        </slot>


        <hr>
        
        <div class="mt-5">
            <div class="text-center">
                <span class="fs-5 fw-bold">Descrição das etapas</span>
            </div>
            <div class="table-responsive mt-3">
                <table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nome da etapa (Produto)</th>
                            <th class="text-center" style="border-left:1px solid #dee2e6">Peso relativo</th>
                            <th class="text-center" style="border-left:1px solid #dee2e6">Data de Início</th>
                            <th class="text-center">Data de Conclusão</th>
                            <th class="text-center">Situação da Etapa</th>
                            <th class="text-center" style="border-left:1px solid #dee2e6">Data Atual de Início</th>
                            <th class="text-center">Data Atual de Conclusão</th>
                            <th class="text-center">Situação Atual da Etapa</th>
                            <th class="text-center" style="border-left:1px solid #dee2e6">Monitorar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr :class="[corTabelaPorcentagem(item)]" v-for="(item, index) in etapasPreenchidas">
                            <td>{{ (index+1) }}</td>
                            <td>{{ item.dsc_etapa }}</td>
                            <td class="text-center" style="width: 80px; border-left:1px solid #dee2e6;">{{ item.vlr_peso_etapa }}</td>
                            <td class="text-center" style="width: 80px; border-left:1px solid #dee2e6;">{{ item.dte_validada_inicio_etapa ? formatarData(item.dte_validada_inicio_etapa) +' (validada)' : formatarData(item.dte_previsao_inicio_etapa) +' (previsão)' }}</td>
                            <td class="text-center" style="width: 80px">{{ item.dte_validada_conclusao_etapa ? formatarData(item.dte_validada_conclusao_etapa) +' (validada)' :  formatarData(item.dte_previsao_conclusao_etapa)+' (previsão)' }}</td>
                            <td class="text-center" style="width: 160px">{{ (item.txt_situacao_validada !=null) ? item.txt_situacao_validada + ' (validada)' : "Não monitorado" }}</td>
                            <td class="text-center" style="width: 160px; border-left:1px solid #dee2e6;">{{ (item.dte_efetiva_inicio_etapa !=null) ? formatarData(item.dte_efetiva_inicio_etapa) : "Não monitorado" }}</td>
                            <td class="text-center" style="width: 160px">{{ (item.dte_efetiva_conclusao_etapa !=null) ? formatarData(item.dte_efetiva_conclusao_etapa) : "Não monitorado" }}</td>
                            <td class="text-center" style="width: 160px">{{ (item.txt_situacao !=null) ? item.txt_situacao : "Não monitorado" }}</td>
                            <td class="text-center" style="border-left:1px solid #dee2e6;">
                                <button type="button" class="br-button circle primary small" data-bs-toggle="modal" :data-bs-target="'#'+item.etapa_projeto_id" data-toggle="tooltip" data-placement="top" title="Monitorar etapa" >
                                    <i class="fa fa-pen"></i> 
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        

        <!-- *************************************************************************************************** -->
        <!-- ***************************************** CAMPOS DE TEXTO ***************************************** -->
        <!-- *************************************************************************************************** -->
        
        <div class="row mt-3">
            <div class="col col-xs-12 br-textarea">
                <label>Análise do Projeto</label>
                <textarea class="input-medium" id="dsc_analise_indicador" name="dsc_analise_indicador" rows="5"
                    v-model="dsc_analise_indicador" required>
                </textarea>
            </div>
        </div><!-- div row -->

        <div class="row mt-3">
            <div class="col col-xs-12 br-textarea">
                <label>Causas e impedimentos para atrasos no projeto</label>
                <textarea class="input-medium" id="dsc_causas_impedimentos_atingimento_meta"
                    name="dsc_causas_impedimentos_atingimento_meta" rows="5"
                    v-model="dsc_causas_impedimentos_atingimento_meta" required>
                </textarea>
            </div>
        </div><!-- div row -->

        <div class="row mt-3">
            <div class="col col-xs-12 br-textarea">
                <label>Desafios e Próximos Passos</label>
                <textarea class="input-medium" id="dsc_desafios_proximos_passos" name="dsc_desafios_proximos_passos"
                    rows="5" v-model="dsc_desafios_proximos_passos" required>
                </textarea>
            </div>
        </div><!-- div row -->

 
        <div class="row">
            <div class="col col-xs-12 text-right"> 
                Após monitorar as etapas e preencher os campos de texto da análise do monitoramento,
                pressione o botão "Salvar" para registrar todas as alterações.  
                <br>
                Assim, o botão "Finalizar" será habilitado.
                <div class="p-3 text-right">
                    <button class="br-button primary mr-3" type="submit" name="botao_salvar" :value="true">Salvar
                    </button>
                    
                    <button :disabled="!dadosMonitoramento.bln_meta_atingida" class="br-button success mr-3" type="submit" name="botao_finalizar" :value="true" >Finalizar
                    </button>

                    <a class="br-button danger mr-3" type="button"
                        :href="'/plancidades/monitoramentos/projetos/' + this.dadosProjeto.projeto_id">Voltar
                    </a>
                </div>
            </div>
        </div>
        


    </div>
</template>

<script>
export default {
    props: ['url', 'dadosMonitoramento', 'dadosProjeto', 'etapasProjeto', 'etapasPreenchidas', 'situacaoMonitoramento'],
    data() {
        return {

        //id do Monitoramento do Projeto    
            monitoramento_projeto_id:'',

        //----Objetivos/Indicadores/Órgãos
            objetivosEstrategicos: '',
            objetivoEstrategico: '',
            orgaosResponsaveis: '',
            orgaoResponsavel: '',
            projetos: '',
            projeto: '',


        //----Descrição
            textoDscObjProjeto: '-',
            textoMinPPA: null,
            textoUnidadeResponsavelComSigla: '-',
            textoGerenteProjeto: '-',
            
            

        //---Etapas
            etapas:'',
            etapa:'',
            situacoes:'',
            situacao:'',
            percentualConcluidoEtapa:'',
            percentualConcluidoProjeto:'',
            percentualEstimadoFinalAno:'',
        
        
        //----Periodicidade
            periodicidades: '',
            periodicidade: '',
            periodosMonitoramento: '',
            periodoMonitoramento: '',
            dte_periodicidade_diaria: '',
            num_ano_periodicidade_anual: '',


        //----Valor/Análise/Causas/Desafios
            vlr_apurado: '',
            temp_vlr_apurado: '',
            regionalizacao: '',
            dsc_analise_indicador: '',
            dsc_causas_impedimentos_atingimento_meta: '',
            dsc_desafios_proximos_passos: '',


        //----Textos de Escolhas
            textoEscolhaObjetivo: "Escolha um objetivo Estratégico:",
            textoEscolhaProjeto: "Escolha um objetivo estratégico ou o órgão responsável:",
            textoEscolhaOrgaoResponsavel: "Escolha o Órgão Responsável:",
            textoEscolhaPeriodoMonitoramento: "Escolha um objetivo estratégico ou o órgão responsável:",
            textoEscolhaSituacao: "Escolha a situação",


        //----Parametros para busca (via URL)
            paramObjetivoEstrategico: 'vazio',
            paramOrgaoResponsavel: 'vazio',

        //----MISC
            tab: null,

        //----Validação Monitoramento
            txt_situacao_monitoramento: '',
            situacao_monitoramento_observacao: '',

        }
    },
    methods: {
        formatarData(data){
            let dataTemp = data.split("-");
            let dataFormatada = '';
            
            for (let i = (dataTemp.length-1); i >= 0; i--){
                dataFormatada += String(dataTemp[i]) 
                if (i > 0){
                    dataFormatada += '/';
                }
            }
            return dataFormatada;
        },
        resetarCampos(){
            this.dsc_analise_indicador = this.dadosMonitoramento.dsc_analise_indicador;
            this.dsc_causas_impedimentos_atingimento_meta = this.dadosMonitoramento.dsc_causas_impedimentos;
            this.dsc_desafios_proximos_passos = this.dadosMonitoramento.dsc_desafios_proximos_passos;
        },
        PercentualEstimadoAno(){
            if(this.dadosMonitoramento.num_ano_periodo_monitoramento == 2024){
                this.percentual_estimado_ano = this.dadosProjeto.vlr_percentual_estimado_2024;
            }
            if(this.dadosMonitoramento.num_ano_periodo_monitoramento == 2025){
                this.percentual_estimado_ano = this.dadosProjeto.vlr_percentual_estimado_2025;
            }
            if(this.dadosMonitoramento.num_ano_periodo_monitoramento == 2026){
                this.percentual_estimado_ano = this.dadosProjeto.vlr_percentual_estimado_2026;
            }
            if(this.dadosMonitoramento.num_ano_periodo_monitoramento == 2027){
                this.percentual_estimado_ano = this.dadosProjeto.vlr_percentual_estimado_2027;
            }
            return this.percentual_estimado_ano;
        },  
        corProgressoPorcentagem(progresso){
            if ((progresso / this.PercentualEstimadoAno()) < 0.5){
                return 'bg-danger';
            }else{
                if((progresso / this.PercentualEstimadoAno()) <= 0.75 ){
                    return 'bg-warning';
                }
                else{
                    return 'bg-success'
                }
            }
        },
        corTabelaPorcentagem(item){
            if (item.situacao_etapa_projeto_id == 1){
                return 'table-secondary';
            }
            if((item.situacao_etapa_projeto_id > 1 && item.situacao_etapa_projeto_id < 5) ){
                return 'table-warning';
            }
            if(item.situacao_etapa_projeto_id == 5 ){
                return 'table-success'
            }
            return '';
        },
    },
    mounted() {

        axios.get(this.url + '/api/plancidades/situacoesEtapasProjeto').then(resposta => {
            this.situacoes = resposta.data;
        }).catch(error => {
            console.log(error);
        });

        if (this.dadosMonitoramento) {
            this.resetarCampos();
            // axios.get(this.url + '/api/plancidades/etapas/monitoramento_projetos/' +this.dadosMonitoramento.monitoramento_projeto_id).then(resposta =>{
            //         this.etapasPreenchidas = resposta.data;
            //     })
            //         .catch(error => {
            //         console.log(error);
            //     });
        }

        if (this.situacaoMonitoramento){
            this.txt_situacao_monitoramento = this.situacaoMonitoramento.txt_situacao_monitoramento;
            this.situacao_monitoramento_observacao = this.situacaoMonitoramento.situacao_monitoramento_observacao;
        }
        else {
            this.txt_situacao_monitoramento = 'Em monitoramento';
            this.situacao_monitoramento_observacao = '';
        };


        
    }
}
</script>
