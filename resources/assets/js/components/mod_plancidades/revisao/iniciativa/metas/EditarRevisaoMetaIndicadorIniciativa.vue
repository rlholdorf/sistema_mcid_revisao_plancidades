<template>
    <div>
        <progresso-revisao-iniciativa
        :url="url"
        :dados-revisao="dadosRevisao"
        :active="'metas'"
        :dados-meta-revisao="dadosMetaRevisao"
        >
        </progresso-revisao-iniciativa>
        
        <hr>

        <div class="form-group">

            <p class="text-center"><b>Detalhamento da Meta do Indicador da Iniciativa</b></p>
            <div class="row mt-3">
                <div class="column col-6 col-xs-12">
                    <label for="txt_dsc_meta">Denominação da Meta</label>
                    <p v-text="dadosMeta.txt_dsc_meta"></p>
                </div>
            
                <div class="column col-6 col-xs-12 br-textarea">
                    <label>Nova Denominação da Meta</label>
                    <textarea class="input-medium" id="txt_dsc_meta_nova" name="txt_dsc_meta_nova" rows="2" v-model="dadosMetaRevisao.txt_dsc_meta">
                    </textarea>
                </div>
            </div>
                        
            <div class="row mt-3">
                <div class="column col-6 col-xs-12">
                    <label for="bln_meta_cumulativa">Cumulatividade da Meta</label>
                    <p v-text="dadosMeta.bln_meta_cumulativa ? 'Sim': 'Não'"></p>
                </div>
        
                <div class="column col-6 col-xs-12 br-textarea">
                    <label>Nova Cumulatividade da Meta</label>
                    <select id="bln_meta_cumulativa_nova" class="form-select br-select" name="bln_meta_cumulativa_nova" v-model="dadosMetaRevisao.bln_meta_cumulativa">
                    <option value="">Selecione se a meta é ou não cumulativa</option>
                    <option :value=true>Sim</option>
                    <option :value=false>Não</option>
                    </select>
                </div>
            </div>

            <div class="row mt-3">
                <div class="column col-6 col-xs-12">
                    <label for="vlr_esperado_ano_2">Meta para 2025 {{dadosIniciativa.unidade_medida_simbolo}}</label>
                    <p v-text="dadosMeta.vlr_esperado_ano_2"></p>
                </div>
            
                <div class="column col-6 col-xs-12 br-input">
                    <label>Nova Meta para 2025 {{novaUnidadeMedida}}</label>
                    <br>
                    <input id="vlr_esperado_ano_2_nova" 
                    type="number" 
                    name="vlr_esperado_ano_2_nova"
                    step="0.01"
                    v-model="dadosMetaRevisao.vlr_esperado_ano_2"
                    >
                </div>
            </div>    

            <div class="row mt-3">
                <div class="column col-6 col-xs-12 ">
                    <label for="vlr_esperado_ano_3">Meta para 2026 {{dadosIniciativa.unidade_medida_simbolo}}</label>
                    <p v-text="dadosMeta.vlr_esperado_ano_3"></p>
                </div>
            
                <div class="column col-6 col-xs-12 br-input">
                    <label>Nova Meta para 2026 {{novaUnidadeMedida}}</label>
                    <br>
                    <input id="vlr_esperado_ano_3_nova" 
                    type="number" 
                    name="vlr_esperado_ano_3_nova"
                    step="0.01"
                    v-model="dadosMetaRevisao.vlr_esperado_ano_3"
                    >
                </div>
            </div>

            <div class="row mt-3">
                <div class="column col-6 col-xs-12">
                    <label for="vlr_meta_final_cenario_alternativo">Meta para 2027 {{dadosIniciativa.unidade_medida_simbolo}}</label>
                    <p v-text="dadosMeta.vlr_meta_final_cenario_alternativo"></p>
                </div>
            
                <div class="column col-6 col-xs-12 br-input">
                    <label>Nova Meta para 2027 {{novaUnidadeMedida}}</label>
                    <br>
                    <input id="vlr_esperado_ano_4_nova" 
                    type="number" 
                    name="vlr_esperado_ano_4_nova"
                    step="0.01"
                    v-model="dadosMetaRevisao.vlr_esperado_ano_4"
                    >
                </div>
            </div>

            <div class="row mt-3">
                <div class="column col-6 col-xs-12">
                    <label for="bln_meta_regionalizada">A meta é regionalizada?</label>
                    <p v-text="dadosMeta.bln_meta_regionalizada ? 'Sim': 'Não'"></p>
                </div>
            
                <div class="column col-6 col-xs-12 br-textarea">
                    <label>A meta será regionalizada?</label>
                    <select id="bln_meta_regionalizada_nova" class="form-select br-select" name="bln_meta_regionalizada_nova" v-model="dadosMetaRevisao.bln_meta_regionalizada">
                    <option value="">Selecione se a meta é ou não regionalizada</option>
                    <option value="true">Sim</option>
                    <option value="false">Não</option>
                    </select>
                </div>
            </div>

            <div class="row mt-3">
                <div class="column col-6 col-xs-12">
                    <label for="dsc_justificativa_ausencia_regionalizacao">Justificativa para não regionalização</label>
                    <p v-text="dadosMeta.dsc_justificativa_ausencia_regionalizacao"></p>
                </div>
            
                <div class="column col-6 col-xs-12 br-textarea">
                    <label>Nova Justificativa para não regionalização</label>
                    <textarea class="input-medium" id="dsc_justificativa_ausencia_regionalizacao_nova" name="dsc_justificativa_ausencia_regionalizacao_nova" rows="5" v-model="dadosMetaRevisao.dsc_justificativa_ausencia_regionalizacao">
                    </textarea>
                </div>
            </div>

            <!-- Botões Formulário -->
            <div class="row">
                <div class="col col-xs-12 col-sm-12">
                    <div class="p-3 text-right">
                        <button class="br-button primary mr-3" type="submit">Salvar
                        </button>

                        <a class="br-button danger mr-3" type="button" :href='this.url+"/plancidades/revisao/objetivo_estrategico/consulta"'>Voltar
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['url', 'dadosRevisao', 'dadosIniciativa', 'dadosIniciativaRevisao', 'dadosIndicadorIniciativaRevisao', 'dadosMeta', 'dadosMetaRevisao', 'revisaoCadastrada'],
    data() {
        return {
        //----Campos Select
            bln_meta_regionalizada_nova:'',
            unidadesMedida:'',
            unidadeMedida:'',
            novaUnidadeMedida:this.dadosIndicadorIniciativaRevisao.unidade_medida_simbolo,
            periodicidades:'',
            periodicidade:'',
            polaridades:'',
            polaridade:'',

            //----Textos de Escolhas
            textoEscolhaUnidadeMedida: "Escolha uma nova Unidade de Medida:",
            textoEscolhaPeriodicidade: "Escolha uma nova Periodicidade:",
            textoEscolhaPolaridade: "Escolha uma nova Polaridade:",
        }
    },
    methods: {
        
    },
    mounted() {
        axios.get(this.url + '/api/plancidades/unidadesMedida').then(resposta=>{
            this.unidadesMedida = resposta.data;
        }).catch(error=>{
            console.log(error);
        });

        axios.get(this.url + '/api/plancidades/periodicidades').then(resposta=>{
            this.periodicidades = resposta.data;
        }).catch(error=>{
            console.log(error);
        });

        axios.get(this.url + '/api/plancidades/polaridades').then(resposta=>{
            this.polaridades = resposta.data;
        }).catch(error=>{
            console.log(error);
        });

    }
}
</script>
