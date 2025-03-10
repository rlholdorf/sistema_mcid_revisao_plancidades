<template>
    <div>
        <div class="form-group">
            <div class="row mt-3">
                <div class="column col-4 col-xs-12">
                    <label>Órgão Responsável</label>
                    <p v-text="dadosProjeto.dsc_orgao"></p>
                </div>
            
                <div class="column col-8 col-xs-12">
                    <label>Objetivo Estratégico</label>
                    <p v-text="dadosProjeto.txt_titulo_objetivo_estrategico_pei"></p>
                </div>
            </div>
        </div>

        <div class="titulo">
            <h4>Projeto: {{ dadosProjeto.txt_enunciado_projeto }} </h4>
            <input type="hidden" id="projeto_id" name="projeto_id" :value="this.dadosProjeto.projeto_id"> 
        </div>

        <hr>
            
        <div class="row mt-3">
            <div class="column col-xs-12">
                <label>Objetivo do Projeto</label>
                <p v-text="this.dadosProjeto.dsc_objetivo_projeto"></p>
            </div>
        </div><!-- div row -->

        <div v-if="this.dadosProjeto.bln_ppa" class="row mt-3">
            <div class="column col-xs-12 col-sm-12">
                <label>Medida Institucional e Normativa PPA</label>
                <p v-text="this.dadosProjeto.dsc_min_ppa"></p>
            </div>
        </div><!-- div row -->

        <div class="row mt-3">
            <div class="column col-xs-12 col-sm-6">
                <label>Unidade Responsável</label>
                <p v-text="this.dadosProjeto.dsc_orgao"></p>
            </div>

            <div class="column col-xs-12 col-sm-6">
                <label>Gerente do Projeto</label>
                <p v-text="this.dadosProjeto.dsc_nome_gerente"></p>
            </div>
        </div><!-- div row -->

        <div>
            <div class="row mt-3">
                <div class="row mt-3">
                    <div class="column col-xs-12 col-sm-6">
                        <label for="anoMonitoramento">Ano do Monitoramento</label>
                        <select id="anoMonitoramento" class="form-select br-select" name="anoMonitoramento" 
                            v-model="anoMonitoramento"
                            @change="onChangeAnoMonitoramento"
                            required>
                                <option value="" v-text="textoEscolhaAno"></option>
                                <option v-for="item in anosMonitoramentos" v-text="item.num_ano_monitoramento" :value="item.num_ano_monitoramento"
                                    :key="item.id"></option>
                        </select>
                    </div>
                
                    <div class="column col-xs-12 col-sm-6">
                        <label for="periodoMonitoramento">Periodo de Monitoramento</label>
                        <select id="periodoMonitoramento" class="form-select br-select" name="periodoMonitoramento" 
                            v-model="periodoMonitoramento"
                            :disabled="anoMonitoramento == ''"
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
            </div><!-- div row -->
        </div>

        <div class="row">
            <div class="col col-xs-12 col-sm-12">
                <div class="p-3 text-right">
                    <button v-if="!validandoPeriodo" :disabled="!this.periodoValido"
                        class="br-button primary mr-3"
                        type="submit"
                        name="botao_salvar" >Salvar
                    </button>

                    <button v-else disabled class="br-button primary mr-3">
                        <i class="fa fa-spinner fa-spin"></i> Aguarde
                    </button>

                    <button class="br-button danger mr-3" type="button"
                        onclick="javascript:window.history.go(-1)">Voltar
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['url', 'dadosProjeto'],
    data() {
        return {
        //----Objetivos/Indicadores/Órgãos
            projeto: '',

        
        
        //----Periodicidade
            anosMonitoramentos:'',
            anoMonitoramento:'',
            periodosMonitoramento: '',
            periodoMonitoramento: '',
            periodoValido: false,
            validandoPeriodo: false,


        //----Textos de Escolhas
            textoEscolhaAno: "Escolha o ano do monitoramento",
            textoEscolhaPeriodoMonitoramento: "Escolha o ano de monitoramento:",
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
                axios.get(this.url + '/api/plancidades/monitoramentos/projeto/validar_periodo_monitoramento/'+ this.dadosProjeto.projeto_id +'/'+this.anoMonitoramento+'/'+this.periodoMonitoramento).then(resposta => {
                    this.periodoValido = (resposta.data.length <= 0) ? true : false;
                    this.validandoPeriodo = false;
                }).catch(error => {
                    console.log(error);
                });
            }
        },
    },
    mounted() {
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

        this.periodoValido = true;
    }

}
</script>
