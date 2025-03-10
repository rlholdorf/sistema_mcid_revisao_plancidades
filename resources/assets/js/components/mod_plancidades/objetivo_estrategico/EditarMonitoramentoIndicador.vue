<template>
    <div>
        <div class="form-group">
            <div class="row mt-3">
                <div class="column col-3 col-xs-12">
                    <label for="orgaoResponsavel">Órgão Responsável</label>
                    <p v-text="dadosMonitoramento.dsc_orgao"></p>
                </div>
            
                <div class="column col-9 col-xs-12">
                    <label for="objetivoEstrategico">Objetivo Estratégico</label>
                    <p v-text="dadosMonitoramento.txt_titulo_objetivo_estrategico_pei"></p>
                </div>
            </div><!--row-->
            

            <div class="row mt-3">
                <div class="column col-xs-12">
                    <label for="indicador">Indicador de Objetivo Estratégico</label>
                    <p v-text="dadosMonitoramento.txt_denominacao_indicador"></p>
                </div>
            </div><!-- div row -->


            <div class="row mt-3">
                <div class="column col-xs-12">
                    <label for="dscMeta">Descrição da Meta</label>
                    <p v-text="metaIndicador.txt_dsc_meta"></p>
                </div>
            </div><!-- div row -->


            <div class="row mt-3">
                <div class="column col-xs-12 col-sm-2">
                    <label for="bln_ppa">Consta no PPA:</label>
                    <p v-text="dadosMonitoramento.bln_ppa ? 'Sim':'Não'"></p>
                </div>

                <div class="column col-xs-12 col-sm-2">
                    <label for="bln_meta_regionalizada">Possui Meta Regionalizada:</label>
                    <p v-text="metaIndicador.bln_meta_regionalizada ? 'Sim':'Não'"></p>
                </div>

                <div class="column col-xs-12 col-sm-8">
                    <label for="txt_polaridade">Polaridade:</label>
                    <p v-text="dadosMonitoramento.txt_polaridade"></p>
                </div>
            </div><!-- div row -->

            
            <div class="row mt-3">
                <!-- ************* CAMPO PERIODO DE MONITORAMENTO ************* -->
                <div class="column col-xs-12 col-sm-3">
                    <label for="anoMonitoramento">Ano do Monitoramento</label>
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

                <div class="column col-xs-12 col-sm-12">
                    <label for="observacaoMonitoramento">Observações CGPI sobre o Monitoramento</label>
                    <p v-text="situacao_monitoramento_observacao"></p>
                </div>

            </div><!-- div row -->
        </div><!--form-group-->


        <div class="form-group">
            <!-- *************************************************************************************************** -->
            <!-- ************************************ CAMPOS DE INPUT DE TEXTO ************************************* -->
            <!-- *************************************************************************************************** -->
            
            <slot>
            
            </slot>

            
            <div v-if="this.dadosMonitoramento.bln_meta_apurada">
                <div class="row mt-3">
                    <div class="col col-xs-12 br-textarea">
                        <label>Análise do Indicador</label>
                        <textarea class="input-medium" id="dsc_analise_indicador" name="dsc_analise_indicador" rows="5"
                            v-model="dadosMonitoramento.dsc_analise_indicador" required>
                        </textarea>
                    </div>
                </div><!-- div row -->

                <div class="row mt-3" v-if="!this.resumoApuracao.bln_meta_atingida">
                    <div class="col col-xs-12 br-textarea">
                        <label>Causas e impedimentos para o não atingimento da meta</label>
                        <textarea class="input-medium" id="dsc_causas_impedimentos_atingimento_meta"
                            name="dsc_causas_impedimentos_atingimento_meta" rows="5"
                            v-model="dadosMonitoramento.dsc_causas_impedimentos" required>
                        </textarea>
                    </div>
                </div><!-- div row -->

                <div class="row mt-3">
                    <div class="col col-xs-12 br-textarea">
                        <label>Desafios e Próximos Passos</label>
                        <textarea class="input-medium" id="dsc_desafios_proximos_passos" name="dsc_desafios_proximos_passos"
                            rows="5" v-model="dadosMonitoramento.dsc_desafios_proximos_passos" required>
                        </textarea>
                    </div>
                </div><!-- div row -->
            </div>
            

            <div class="row">
                <div class="col col-xs-12">
                    <div class="p-3 text-right">
                        <button class="br-button primary mr-3" type="submit" name="botao_salvar" :value="true">Salvar
                        </button>

                        <button v-if="dadosMonitoramento.bln_meta_apurada"
                            class="br-button success mr-3" type="submit" name="botao_finalizar" :value="true" >Finalizar
                        </button>

                        <a class="br-button danger mr-3" type="button"
                            :href="this.url+ '/plancidades/monitoramentos/objetivo_estrategico/indicadores/'+ this.dadosMonitoramento.indicador_objetivo_estrategico_id">Voltar
                        </a>
                    </div>
                </div>
            </div>
        </div><!--form-group-->
        
    </div>
</template>

<script>

export default {
    props: ['url', 'dadosMonitoramento', 'metaIndicador', 'resumoApuracao', 'situacaoMonitoramento'],
    data() {
        return {

        //----Análise/Causas/Desafios
            dsc_analise_indicador: '',
            dsc_causas_impedimentos_atingimento_meta: '',
            dsc_desafios_proximos_passos: '',

        //----Validação Monitoramento
            txt_situacao_monitoramento: '',
            situacao_monitoramento_observacao: '',
        }
    },
    methods: {},
    mounted() {
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
