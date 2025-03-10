<template>
    <div>
        <div class="form-group">
            <div class="row mt-3">
                <div class="column col-3 col-xs-12">
                    <label for="orgaoResponsavel">Órgão Responsável</label>
                    <input type="hidden" id="orgaoResponsavel" name="orgaoResponsavel" :value="dadosIniciativa.orgao_pei_id">
                    <p v-text="dadosIniciativa.dsc_orgao"></p>
                </div>
            
                <div class="column col-9 col-xs-12">
                    <label for="objetivoEstrategico">Objetivo Estratégico</label>
                    <input type="hidden" id="objetivoEstrategico" name="objetivoEstrategico" :value="dadosIniciativa.objetivo_estrategico_pei_id">
                    <p v-text="dadosIniciativa.txt_titulo_objetivo_estrategico_pei"></p>
                </div>
            </div>

            <div class="row mt-3">
                <div class="column col-xs-12">
                    <label for="iniciativa">Iniciativa</label>
                    <input type="hidden" id="iniciativa" name="iniciativa" :value="dadosIniciativa.iniciativa_id">
                    <p v-text="dadosIniciativa.txt_enunciado_iniciativa"></p>
                </div>
            </div>
        </div>


        <div>
            <div class="row mt-3">
                <div class="column col-xs-12">
                    <label for="dscMeta">Descrição da Meta</label> <!-- Puxar descrição da tab_metas_objetivo_especifico -->
                    <p v-text="dadosIniciativa.txt_dsc_meta"></p>
                </div>
            </div>


            <div class="row mt-3">
                <div class="column col-xs-12 col-sm-4">
                    <label for="bln_pac">Consta no PAC:</label> <!-- Puxar Consta no PAC de acordo com o indicador -->
                    <p  v-text="dadosIniciativa.bln_pac ? 'Sim': 'Não'"></p>
                </div>

                <div class="column col-xs-12 col-sm-4">
                    <label for="bln_ppa">Consta no PPA:</label> <!-- Puxar meta da tab -->
                    <p v-text="dadosIniciativa.bln_ppa ? 'Sim': 'Não'"></p>
                </div>

                <div class="column col-xs-12 col-sm-4">
                    <label for="bln_meta_regionalizada">Possui Meta Regionalizada:</label> <!-- Puxar meta da tab -->
                    <p v-text="dadosMeta.bln_meta_regionalizada ? 'Sim': 'Não'"></p>
                </div>
            </div>
        </div>


        <div>
            <div class="row mt-3">
                <div class="column col-xs-12 col-sm-6">
                    <label for="anoMonitoramento">Ano do Monitoramento</label>
                    <select id="anoMonitoramento" class="form-select br-select" name="anoMonitoramento" 
                        v-model="anoMonitoramento"
                        @change="onChangeAnoMonitoramento" required>
                        <option value="" v-text="textoEscolhaAno"></option>
                        <option v-for="item in anosMonitoramentos" v-text="item.num_ano_monitoramento" :value="item.num_ano_monitoramento"
                            :key="item.id"></option>
                    </select>
                </div>

                <div class="column col-xs-12 col-sm-6">
                    <label for="periodoMonitoramento">Periodo de Monitoramento</label>
                    <select id="periodoMonitoramento" class="form-select br-select" name="periodoMonitoramento" 
                        :disabled="anoMonitoramento == ''" v-model="periodoMonitoramento"
                        @change="onChangePeriodoMonitoramento" required>
                        <option value="" v-text="textoEscolhaPeriodoMonitoramento"></option>
                        <option v-for="item in periodosMonitoramento" v-text="item.dsc_periodo_monitoramento" :value="item.id"
                            :key="item.id"></option>
                    </select>
                </div>
            </div>

            <div v-if="!this.periodoValido && this.periodoMonitoramento != '' && !this.validandoPeriodo" class="row mt-3">
                <div class="column col-sm-6"></div>
                <div class="column col-sm-6 col-xs-12">
                    <p class="text-danger">O indicador já tem um monitoramento com esta data.</p>
                </div>
            </div>

        </div>


        <div class="row">
            <div  class="col col-xs-12 col-sm-6">
                <div class="p-3 text-left">
                    
                </div>
            </div>

            <div class="col col-xs-12 col-sm-6">
                <div class="p-3 text-right">
                    <button v-if="!validandoPeriodo" :disabled="!this.periodoValido"
                        class="br-button primary mr-3"
                        type="submit"
                        name="botao_salvar" >Salvar
                    </button>

                    <button v-else disabled class="br-button primary mr-3">
                        <i class="fa fa-spinner fa-spin"></i> Aguarde
                    </button>

                    <a class="br-button danger mr-3" type="button"
                        onclick="javascript:window.history.go(-1)">Voltar
                    </a>
                </div>
            </div>
        </div>
    </div>
    
</template>

<script>
export default {
    props: ['url', 'dadosIniciativa', 'dadosMeta'],
    data() {
        return {
        //----Campos Select
            periodosMonitoramento: '',
            periodoMonitoramento: '',
            anosMonitoramentos:'',
            anoMonitoramento:'',
            periodoValido: false,
            validandoPeriodo: false,

        //----Textos de Escolhas
            textoEscolhaPeriodoMonitoramento: "Escolha o Ano de Monitoramento:",
            textoEscolhaAno:"Escolha o Ano de Monitoramento:",
        }
    },
    methods: {
        
        onChangeAnoMonitoramento(){
            this.periodoMonitoramento = '';
            this.periodoValido = false;
            if (this.anoMonitoramento != ''){
                this.textoEscolhaPeriodoMonitoramento = 'Escolha o Periodo de Monitoramento:';
            }else{
                this.textoEscolhaPeriodoMonitoramento = 'Escolha o Ano do Monitoramento:';
            }
        },
        onChangePeriodoMonitoramento(){
            if (this.periodoMonitoramento != ''){
                this.validandoPeriodo = true;
                axios.get(this.url + '/api/plancidades/monitoramentos/iniciativa/validar_periodo_monitoramento/'+ this.dadosIniciativa.iniciativa_id +'/'+this.anoMonitoramento+'/'+this.periodoMonitoramento).then(resposta => {
                    this.periodoValido = (resposta.data.length <= 0) ? true : false;
                    this.validandoPeriodo = false;
                }).catch(error => {
                    console.log(error);
                });
                
            }
        },
    },
    mounted() {
        //retorna as Anos
       axios.get(this.url + '/api/plancidades/anos_monitoramento').then(resposta => {
            this.anosMonitoramentos = resposta.data;
        }).catch(error => {
            console.log(error);
        });

        axios.get(this.url + '/api/plancidades/monitoramentos/meses_monitoramento/').then(resposta => {
            this.periodosMonitoramento = resposta.data;
        }).catch(error => {
            console.log(error);
        });
    }
}
</script>
