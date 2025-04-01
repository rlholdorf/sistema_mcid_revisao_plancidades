<template>
    <div>
        <div class="form-group">

            <div class="row mt-3">
                <div class="row mt-3">
                    <input type="hidden" id="iniciativa" name="iniciativa" :value="dadosIniciativa.iniciativa_id">
                    <input type="hidden" id="orgaoResponsavel" name="orgaoResponsavel" :value="dadosIniciativa.orgao_pei_id">
                    <input type="hidden" id="objetivoEstrategico" name="objetivoEstrategico" :value="dadosIniciativa.objetivo_estrategico_pei_id">
                    <input type="hidden" id="indicadorIniciativa" name="indicadorIniciativa" :value="dadosIniciativa.id">
                    <input type="hidden" id="metaIniciativa" name="metaIniciativa" :value="dadosIniciativa.meta_iniciativa_id">
                    <label for="iniciativa">Enunciado da Iniciativa</label>
                    <p v-text="dadosIniciativa.iniciativa_id+' - '+dadosIniciativa.txt_enunciado_iniciativa"></p>
                </div>
            </div><!-- div row -->

            <div class="row mt-3">
                <div class="column col-3 col-xs-12">
                    <label>Órgão Responsável</label>
                    <p v-text="dadosIniciativa.dsc_orgao"></p>
                </div>
            
                <div class="column col-9 col-xs-12">

                    <label>Objetivo Estratégico</label>
                    <p v-text="dadosIniciativa.txt_titulo_objetivo_estrategico_pei"></p>
                </div>
            </div><!--row-->

            <div class="row mt-3">
                <label for="indicador">Indicador da Iniciativa</label>
                <p v-text="dadosIniciativa.id+' - '+dadosIniciativa.txt_denominacao_indicador"></p>
            </div><!-- div row -->

            
            <div>
                <div class="row mt-3">
                    <div class="column col-xs-12">
                        <label for="dscMeta">Descrição da Meta</label>
                        <p v-text="dadosIniciativa.meta_iniciativa_id+' - '+dadosIniciativa.txt_dsc_meta"></p>
                    </div>
                </div><!-- div row -->

                <div class="row mt-3">
                    <div class="column col-xs-12 col-sm-4">
                        <label for="bln_ppa">Consta no PPA:</label> <!-- Puxar meta da tab -->
                        <p v-text="dadosIniciativa.bln_ppa ? 'Sim':'Não'"></p>
                    </div>

                    <div class="column col-xs-12 col-sm-4">
                        <label for="bln_meta_regionalizada">Possui Meta Regionalizada:</label> <!-- Puxar meta da tab -->
                        <p v-text="dadosIniciativa.bln_meta_regionalizada ? 'Sim':'Não'"></p>
                    </div>
                </div><!-- div row -->
            </div><!--form-group-->

            <div class="row mt-3">
                <!-- ************* CAMPO PERIODO DE REVISÃO ************* -->
                <div class="column col-xs-12 col-sm-6">
                    <label for="anoRevisao">Ano da Revisão</label>
                    <select id="anoRevisao" class="form-select br-select" name="anoRevisao" 
                        v-model="anoRevisao"
                        @change="onChangeAnoRevisao" required>
                        <option value="" v-text="textoEscolhaMês"></option>
                        <option v-for="item in anosRevisoes" v-text="item.num_ano_monitoramento" :value="item.num_ano_monitoramento"
                            :key="item.id"></option>
                    </select>
                </div>

                <div class="column col-xs-12 col-sm-6">
                    <label for="periodoRevisao">Periodo de Revisão</label>
                    <select id="periodoRevisao" class="form-select br-select" name="periodoRevisao" 
                        :disabled="anoRevisao == ''" v-model="periodoRevisao"
                        @change="onChangeMesRevisao" required>
                        <option value="" v-text="textoEscolhaAno"></option>
                        <option v-for="item in periodosRevisao" v-text="item.dsc_periodo_monitoramento" :value="item.id"
                            :key="item.id"></option>
                    </select>
                </div>
            </div>

            <div v-if="!this.periodoValido && this.periodoRevisao != '' && !this.validandoPeriodo" class="row mt-3">
                <div class="column col-sm-6"></div>
                <div class="column col-sm-6 col-xs-12">
                    <p class="text-danger">O indicador já tem uma revisão com esta data.</p>
                </div>
            </div>

        </div>


        
        <div class="row">
            <div  class="col col-xs-12 col-sm-6">                    
            </div>

            <div class="col col-xs-12 col-sm-6">
                <div class="p-3 text-right">
                    <button v-if="!validandoPeriodo" :disabled="!this.periodoValido || this.periodoRevisao == ''"
                        class="br-button primary mr-3" type="submit" name="botao_salvar" :value="true"> Salvar
                    </button>

                    <button v-else disabled class="br-button primary mr-3">
                        <i class="fa fa-spinner fa-spin"></i> Aguarde
                    </button>

                    <a class="br-button danger mr-3" type="button"
                        href="javascript:window.history.go(-1)">Voltar
                    </a>
                </div>
            </div>
        </div><!--form-group-->
        
    </div>
</template>

<slot>

</slot>

<script>

export default {
    props: ['url', 'dadosIniciativa'],
    data() {
        return {
        //----Campos Select
            anosRevisoes:'',
            anoRevisao:'',
            periodosRevisao: '',
            periodoRevisao: '',
            periodoValido: false,
            validandoPeriodo: false,

        //----Textos de Escolhas
            textoEscolhaAno: "Escolha o Ano da Revisão:",
            textoEscolhaMês:"Escolha o Mês da Revisão:",
        }
    },
    methods: {
        onChangeAnoRevisao(){
            this.periodoRevisao = '';
            this.periodoValido = false;
            if (this.anoRevisao != ''){
                this.textoEscolhaAno = 'Escolha o Periodo de Revisão:';
            }else{
                this.textoEscolhaAno = 'Escolha o Ano do Revisão:';
            }
        },
        onChangeMesRevisao(){
            if (this.periodoRevisao != ''){
                this.validandoPeriodo = true;
                axios.get(this.url + '/api/plancidades/revisao/iniciativa/validar_periodo_revisao/'+ this.dadosIniciativa.iniciativa_id +'/'+this.anoRevisao+'/'+this.periodoRevisao).then(resposta => {
                    this.periodoValido = (resposta.data.length <= 0) ? true : false;
                    this.validandoPeriodo = false;
                }).catch(error => {
                    console.log(error);
                });
            }
        },
    },
    mounted() {
        //retorna os anos para revisao
        axios.get(this.url + '/api/plancidades/anos_monitoramento').then(resposta=>{
            this.anosRevisoes = resposta.data;
        }).catch(error=>{
            console.log(error);
        });

        //busca os meses para revisao
        axios.get(this.url + '/api/plancidades/monitoramentos/meses_monitoramento/').then(resposta =>{
            this.periodosRevisao = resposta.data;
        }).catch(error => {
            console.log(error);
        });
    }
}
</script>
