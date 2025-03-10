<template>
    <div class="form-group">
        <p class="text-center"><b>Detalhamento do Indicador</b></p>
        <div class="row mt-3">
            <div class="column col-6 col-xs-12">
                <label for="txt_denominacao_indicador">Denominação Indicador</label>
                <p v-text="dadosIndicador.txt_denominacao_indicador"></p>
            </div>
        
            <div class="column col-6 col-xs-12 br-textarea">
                <label>Nova Denominação do Indicador</label>
                    <textarea class="input-medium" id="txt_denominacao_indicador_nova" name="txt_denominacao_indicador_nova" rows="2">
                    </textarea>
            </div>
        </div>

        <div class="row mt-3">
            <div class="column col-6 col-xs-12">
                <label for="dsc_indicador">Descrição do Indicador</label>
                <p v-text="dadosIndicador.dsc_indicador"></p>
            </div>
        
            <div class="column col-6 col-xs-12 br-textarea">
                <label>Nova Descrição do Indicador</label>
                    <textarea class="input-medium" id="dsc_indicador_nova" name="dsc_indicador_nova" rows="5">
                    </textarea>
            </div>
        </div>
        
        <div class="row mt-3">
            <div class="column col-6 col-xs-12">
                <label for="txt_sigla_indicador">Sigla do Indicador</label>
                <p v-text="dadosIndicador.txt_sigla_indicador"></p>
            </div>
        
            <div class="column col-6 col-xs-12 br-textarea">
                <label>Nova Sigla do Indicador</label>
                    <textarea class="input-medium" id="txt_sigla_indicador_nova" name="txt_sigla_indicador_nova" rows="1">
                    </textarea>
            </div>
        </div>

        <div class="row mt-3">
            <div class="column col-6 col-xs-12">
                <label for="vlr_indice_referencia">Valor de Referência</label>
                <p v-text="dadosIndicador.vlr_indice_referencia"></p>
            </div>
        
            <div class="column col-6 col-xs-12 br-textarea">
                <label>Novo Valor de Referência</label>
                    <textarea class="input-medium" id="vlr_indice_referencia_nova" name="vlr_indice_referencia_nova" rows="1">
                    </textarea>
            </div>
        </div>

        <div class="row mt-3">
            <div class="column col-6 col-xs-12">
                <label for="txt_unidade_medida">Unidade de Medida</label>
                <p v-text="dadosIndicador.txt_unidade_medida"></p>
            </div>
        
            <div class="column col-6 col-xs-12 br-textarea">
                <label>Nova Unidade de Medida</label>
                    <select id="txt_unidade_medida_nova" class="form-select br-select" name="txt_unidade_medida_nova"
                    v-model="unidadeMedida">
                        <option value="" v-text="textoEscolhaUnidadeMedida"></option>
                        <option v-for="item in unidadesMedida" v-text="item.txt_unidade_medida" :value="item.txt_unidade_medida"
                            :key="item.id"></option>
                    </select>
            </div>
        </div>

        <div class="row mt-3">
            <div class="column col-6 col-xs-12">
                <label for="txt_data_divulgacao_ou_disponibilizacao">Data de Divulgação ou Disponibilidade</label>
                <p v-text="dadosIndicador.txt_data_divulgacao_ou_disponibilizacao"></p>
            </div>
        
            <div class="column col-6 col-xs-12 br-textarea">
                <label>Novo Data de Divulgação ou Disponibilidade</label>
                    <textarea class="input-medium" id="txt_data_divulgacao_ou_disponibilizacao_nova" name="txt_data_divulgacao_ou_disponibilizacao_nova" rows="1">
                    </textarea>
            </div>
        </div>

        <div class="row mt-3">
            <div class="column col-6 col-xs-12">
                <label for="dsc_periodicidades">Periodicidade</label>
                <p v-text="dadosIndicador.dsc_periodicidades"></p>
            </div>
        
            <div class="column col-6 col-xs-12 br-textarea">
                <label>Nova Periodicidade</label>
                    <select id="dsc_periodicidades_nova" class="form-select br-select" name="dsc_periodicidades_nova"
                    v-model="periodicidade">
                        <option value="" v-text="textoEscolhaPeriodicidade"></option>
                        <option v-for="item in periodicidades" v-text="item.dsc_periodicidades" :value="item.dsc_periodicidades"
                            :key="item.id"></option>
                    </select>
            </div>
        </div>


        <div class="row mt-3">
            <div class="column col-6 col-xs-12">
                <label for="txt_polaridade">Polaridade do Indicador</label>
                <p v-text="dadosIndicador.txt_polaridade"></p>
            </div>
        
            <div class="column col-6 col-xs-12 br-textarea">
                <label>Nova Polaridade do Indicador</label>
                    <select id="txt_polaridade_nova" class="form-select br-select" name="txt_polaridade_nova"
                    v-model="polaridade">
                        <option value="" v-text="textoEscolhaPolaridade"></option>
                        <option v-for="item in polaridades" v-text="item.txt_polaridade" :value="item.txt_polaridade"
                            :key="item.id"></option>
                    </select>
            </div>
        </div>

<!-- Botões Formulário -->
        <div class="row">
            <div class="col col-xs-12 col-sm-12">
                <div class="p-3 text-right">
                    <button class="br-button primary mr-3" type="submit" name="salvar_revisão">Salvar Revisão
                    </button>


                    <a class="br-button danger mr-3" type="button" :href='this.url+"/plancidades/"'>Voltar
                    </a>
                </div>
            </div>
        </div>
        
    </div>
</template>

<script>
export default {
    props: ['url', 'dadosIndicador', 'dadosRegionalizacao'],
    data() {
        return {
        //----Campos Select
            unidadesMedida:'',
            unidadeMedida:'',
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
