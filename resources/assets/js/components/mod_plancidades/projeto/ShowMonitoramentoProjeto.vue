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
                <p v-text="dadosMonitoramento.dsc_orgao"></p>
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
        <!-- ***************************************** BARRA DE PROGRESSO ************************************** -->
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


        <hr>


        <!-- *************************************************************************************************** -->
        <!-- ***************************************** CAMPOS DE ETAPAS **************************************** -->
        <!-- *************************************************************************************************** -->

        <div>
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
                            <!-- <td class="acao text-center"><button type="button" class="btn btn-outline-primary btn-block" data-bs-toggle="modal" data-bs-target="#{{$dados->etapa_projeto_id}}">
                                    <i class="fa fa-plus"></i> Editar Monitoramento da etapa
                                </button>
                            </td> -->
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>


        <!-- *************************************************************************************************** -->
        <!-- ***************************************** CAMPOS DE TEXTO ***************************************** -->
        <!-- *************************************************************************************************** -->
        
        <div class="row mt-3">
            <div v-if="dadosMonitoramento.dsc_analise_indicador" class="col col-xs-12">
                <label>Análise do Projeto</label>
                <p v-text="dadosMonitoramento.dsc_analise_indicador"></p>
            </div>
        </div><!-- div row -->

        <div class="row mt-3">
            <div v-if="dadosMonitoramento.dsc_causas_impedimentos" class="col col-xs-12">
                <label>Causas e impedimentos para atrasos no projeto</label>
                <p v-text="dadosMonitoramento.dsc_causas_impedimentos"></p>
            </div>
        </div><!-- div row -->

        <div class="row mt-3">
            <div v-if="dadosMonitoramento.dsc_desafios_proximos_passos" class="col col-xs-12">
                <label>Desafios e Próximos Passos</label>
                <p v-text="dadosMonitoramento.dsc_desafios_proximos_passos"></p>
            </div>
        </div><!-- div row -->

 
        <div class="row">
        <div class="col col-xs-12">
            <div class="p-3 text-right">
                <button  class="br-button primary mr-3" :disabled="this.situacao_monitoramento_id == '3' || this.situacao_monitoramento_id == '5' || this.situacao_monitoramento_id == '6' " @click="IrParaEdicao(dadosMonitoramento.monitoramento_projeto_id)">
                    Editar
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
             //----Validação Monitoramento
            txt_situacao_monitoramento: '',
            situacao_monitoramento_observacao: '',
            situacao_monitoramento_id: '',

            //----Progresso do Projeto
            percentual_estimado_ano:'',
        }
    },
    methods: {
        IrParaEdicao(monitoramentoId){
            window.location.href = "/plancidades/monitoramentos/projetos/" + monitoramentoId + "/editar";
        },
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
        corProgressoPorcentagem(){
            if ((this.dadosProjeto.percentualAtual / this.PercentualEstimadoAno()) < 0.5){
                return 'bg-danger';
            }else{
                if((this.dadosProjeto.percentualAtual / this.PercentualEstimadoAno()) <= 0.75 ){
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
        if (this.situacaoMonitoramento != null){
            this.situacao_monitoramento_id = this.situacaoMonitoramento.situacao_monitoramento_id;
            this.txt_situacao_monitoramento = this.situacaoMonitoramento.txt_situacao_monitoramento;
            this.situacao_monitoramento_observacao = this.situacaoMonitoramento.situacao_monitoramento_observacao;
        }
        else {
            this.situacao_monitoramento_id = '';
            this.txt_situacao_monitoramento = 'Em monitoramento';
            this.situacao_monitoramento_observacao = '';
        };
    }
}
</script>
