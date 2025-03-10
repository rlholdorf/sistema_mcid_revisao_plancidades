<template>
<div>
    <div class="row mt-3">
        <div class="column col-3 col-xs-12">
            <label>Órgão Responsável</label>
            <p v-text="dadosMonitoramento.dsc_orgao"></p>
        </div>
    
        <div class="column col-9 col-xs-12">
            <label for="objetivoEstrategico">Objetivo Estratégico</label>
            <p v-text="dadosMonitoramento.txt_titulo_objetivo_estrategico_pei"></p>
        </div>
    </div>


    <div class="row mt-3">
        <!-- Campo Iniciativa -->
        <div class="column col-xs-12">
            <label for="iniciativa">Iniciativa</label>
            <p v-text="dadosMonitoramento.txt_enunciado_iniciativa"></p>
        </div>
    </div>

    <div class="row mt-3">
        <div class="column col-xs-12 col-sm-4">
            <label for="bln_pac">Consta no PAC:</label>
            <p  v-text="dadosMonitoramento.bln_pac ? 'Sim':'Não'"></p>
        </div>

        <div class="column col-xs-12 col-sm-4">
            <label for="bln_ppa">Consta no PPA:</label>
            <p v-text="dadosMonitoramento.bln_ppa ? 'Sim':'Não'"></p>
        </div>

        <div class="column col-xs-12 col-sm-4">
            <label for="bln_meta_regionalizada">Possui Meta Regionalizada:</label>
            <p v-text="dadosMeta.bln_meta_regionalizada ? 'Sim':'Não'"></p>
        </div>
    </div><!-- div row -->

    <div class="row mt-3">
        <div class="column col-xs-12 col-sm-3">
            <label for="anoMonitoramento">Ano do Monitoramento</label>
            <p v-text="dadosMonitoramento.num_ano_periodo_monitoramento"></p>
        </div>

        <div class="column col-xs-12 col-sm-3">
            <label for="periodoMonitoramento">Periodo de Monitoramento</label>
            <p v-text="dadosMonitoramento.dsc_periodo_monitoramento	"></p>
        </div>

        <div class="column col-xs-12 col-sm-3">
            <label for="situacaoMonitoramento">Situação do Monitoramento</label>
            <p v-text="txt_situacao_monitoramento"></p>
        </div>

        <div class="column col-xs-12 col-sm-12">
            <label for="observacaoMonitoramento">Observações CGPI sobre o Monitoramento</label>
            <p v-text="situacao_monitoramento_observacao"></p>
        </div>
    </div>



    <slot>

        
    </slot>

    <div v-if="this.dadosMonitoramento.bln_meta_apurada">
        <div class="row mt-3">
            <div class="col col-xs-12 br-textarea">
                <label>Análise Crítica</label>
                <textarea class="input-medium" id="dsc_analise_indicador" name="dsc_analise_indicador" rows="5"
                    v-model="dadosMonitoramento.dsc_analise_indicador" required>
                </textarea>
            </div>
        </div><!-- div row -->
    </div>

    <div class="row">
        <div  class="col col-xs-12 col-sm-6">
            <div class="p-3 text-left">
                
            </div>
        </div>

        <div class="col col-xs-12 col-sm-6">
            <div class="p-3 text-right">
                <button class="br-button primary mr-3" type="submit" name="botao_salvar" :value="true">Salvar
                </button>

                <button v-if="dadosMonitoramento.bln_meta_apurada"
                    class="br-button success mr-3" type="submit" name="botao_finalizar" :value="true" >Finalizar
                </button>

                <a class="br-button danger mr-3"
                    :href="'/plancidades/monitoramentos/iniciativas/' + this.dadosMonitoramento.iniciativa_id">Voltar
                </a>
            </div>
        </div>
    </div>
</div>
    
</template>

<script>
export default {
    props: ['url', 'dadosMonitoramento', 'dadosMeta', 'resumoApuracao', 'situacaoMonitoramento'],
    data() {
        return {
             //----Valor/Análise/Causas/Desafios
            dsc_analise_indicador: '',

            //----Validação Monitoramento
            txt_situacao_monitoramento: '',
            situacao_monitoramento_observacao: '',
        }
    },
    methods: {},
    mounted() {if (this.situacaoMonitoramento){
            this.txt_situacao_monitoramento = this.situacaoMonitoramento.txt_situacao_monitoramento;
            this.situacao_monitoramento_observacao = this.situacaoMonitoramento.situacao_monitoramento_observacao;
        }
        else {
            this.txt_situacao_monitoramento = 'Em monitoramento';
            this.situacao_monitoramento_observacao = '';
        };
        console.log (this.situacaoMonitoramento);
        console.log (this.txt_situacao_monitoramento);
    }
}
</script>
