<template>
    <div>
        <div class="form-group">
            <div class="row mt-3">
                <div class="column col-3 col-xs-12">
                    <label>Órgão Responsável</label>
                    <p v-text="dadosMonitoramento.dsc_orgao"></p>
                </div>
            
                <div class="column col-9 col-xs-12">
                    <label>Objetivo Estratégico</label>
                    <p v-text="dadosMonitoramento.txt_titulo_objetivo_estrategico_pei"></p>
                </div>
            </div><!--row-->
            
            <div class="row mt-3">
                <div class="column col-xs-12">
                    <label>Indicador de Objetivo Estratégico</label>
                    <p v-text="dadosMonitoramento.txt_denominacao_indicador"></p>
                </div>
            </div><!-- div row -->


            <div class="row mt-3">
                <div class="column col-xs-12">
                    <label>Descrição da Meta</label>
                    <p v-text="metaIndicador.txt_dsc_meta"></p>
                </div>
            </div><!-- div row -->

            <div class="row mt-3">

                <div class="column col-xs-12 col-sm-2">
                    <label>Consta no PPA:</label> 
                    <p v-text="dadosMonitoramento.bln_ppa ? 'Sim':'Não' "></p>
                </div>

                <div class="column col-xs-12 col-sm-10">
                    <label>Possui Meta Regionalizada:</label> 
                    <p v-text="metaIndicador.bln_meta_regionalizada ? 'Sim': 'Não'"></p>
                </div>
            </div><!-- div row -->



            <div class="row mt-3">
                <div class="column col-xs-12 col-sm-3">
                    <label>Ano do Monitoramento</label>
                    <p v-text="dadosMonitoramento.num_ano_periodo_monitoramento"></p>
                </div>

                <div class="column col-xs-12 col-sm-3">
                    <label>Periodo de Monitoramento</label>
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
        
        <slot>
        
        </slot>

        <div v-if="dadosMonitoramento.bln_meta_apurada">
            <div class="row mt-3">
                <div class="col col-xs-12">
                    <label>Análise do Indicador</label>
                    <p v-text="dadosMonitoramento.dsc_analise_indicador"></p>
                </div>
            </div><!-- div row -->

            <div class="row mt-3">
                <div class="col col-xs-12">
                    <label>Causas e impedimentos para o não atingimento da meta</label>
                    <p v-text="dadosMonitoramento.dsc_causas_impedimentos"></p>
                </div>
            </div><!-- div row -->

            <div class="row mt-3">
                <div class="col col-xs-12">
                    <label>Desafios e Próximos Passos</label>
                    <p v-text="dadosMonitoramento.dsc_desafios_proximos_passos"></p>
                </div>
            </div><!-- div row -->
        </div>

        <div class="row">
            <div  class="col col-xs-12 col-sm-6">                    
            </div>

            <div class="col col-xs-12 col-sm-6">
                <div class="p-3 text-right">
                    <button class="br-button primary mr-3" :disabled="this.situacao_monitoramento_id == '3' || this.situacao_monitoramento_id == '5' || this.situacao_monitoramento_id == '6'" @click="IrParaEdicao(dadosMonitoramento.monitoramento_indicador_id)">
                        Editar
                    </button>
                    
                    <a class="br-button danger mr-3" type="button"
                        :href="this.url+ '/plancidades/monitoramentos/objetivo_estrategico/indicadores/'+ this.dadosMonitoramento.indicador_objetivo_estrategico_id">Voltar
                    </a>
                </div>
            </div>
        </div>
        
        
    </div>
</template>

<script>

export default {
    props: ['url', 'dadosMonitoramento', 'metaIndicador', 'situacaoMonitoramento'],
    data() {
        return{
            //----Validação Monitoramento
            txt_situacao_monitoramento: '',
            situacao_monitoramento_observacao: '',
            situacao_monitoramento_id: '',
        }
    },
    methods: {
        IrParaEdicao(monitoramentoId){
            window.location.href = "/plancidades/monitoramentos/objetivo_estrategico/"+monitoramentoId+"/editar";
        }
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
        console.log (this.situacao_monitoramento_id);
    }
}
</script>
