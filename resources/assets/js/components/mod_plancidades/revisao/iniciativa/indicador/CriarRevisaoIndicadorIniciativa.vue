<template>
    <div>
        <progresso-revisao-iniciativa
        :url="url"
        :dados-revisao="dadosRevisao"
        :active="'indicador'"
        :dados-meta-revisao="dadosMetaRevisao"
        >
        </progresso-revisao-iniciativa>
        
        <hr>

        <div class="form-group">
            <p class="text-center"><b>Detalhamento do Indicador da Iniciativa</b></p>
            <div class="row mt-3">
                <div class="column col-6 col-xs-12">
                    <label for="txt_denominacao_indicador">Denominação do Indicador da Iniciativa</label>
                    <p v-text="dadosIniciativa.txt_denominacao_indicador"></p>
                </div>
            
                <div class="column col-6 col-xs-12 br-textarea">
                    <label>Nova Denominação do Indicador da Iniciativa</label>
                        <textarea class="input-medium" id="txt_denominacao_indicador_nova" name="txt_denominacao_indicador_nova" rows="1">
                        </textarea>
                </div>
            </div>

            <div class="row mt-3">
                <div class="column col-6 col-xs-12">
                    <label for="dsc_indicador">Descrição do Indicador da Iniciativa</label>
                    <p v-text="dadosIniciativa.dsc_indicador"></p>
                </div>
            
                <div class="column col-6 col-xs-12 br-textarea">
                    <label>Nova Descrição do Indicador da Iniciativa</label>
                        <textarea class="input-medium" id="dsc_indicador_nova" name="dsc_indicador_nova" rows="5">
                        </textarea>
                </div>
            </div>

            <div class="row mt-3">
                <div class="column col-6 col-xs-12">
                    <label for="txt_sigla_indicador">Sigla do Indicador da Iniciativa</label>
                    <p v-text="dadosIniciativa.txt_sigla_indicador"></p>
                </div>
            
                <div class="column col-6 col-xs-12 br-textarea">
                    <label>Nova Sigla do Indicador da Iniciativa</label>
                        <textarea class="input-medium" id="txt_sigla_indicador_nova" name="txt_sigla_indicador_nova" rows="1">
                        </textarea>
                </div>
            </div>

            <div class="row mt-3">
                <div class="column col-6 col-xs-12">
                    <label for="vlr_indice_referencia">Valor de Referência</label>
                    <p v-text="dadosIniciativa.vlr_indice_referencia"></p>
                </div>
            
                <div class="column col-6 col-xs-12 br-input">
                    <label>Novo Valor de Referência</label>
                        <input class="input-medium" type="number" id="vlr_indice_referencia_nova" name="vlr_indice_referencia_nova" rows="1">
                        </input>
                </div>
            </div>

            <div class="row mt-3">
                <div class="column col-6 col-xs-12">
                    <label for="txt_unidade_medida">Unidade de Medida</label>
                    <p v-text="dadosIniciativa.txt_unidade_medida"></p>
                </div>
            
                <div class="column col-6 col-xs-12 br-textarea">
                    <label>Nova Unidade de Medida</label>
                        <select id="txt_unidade_medida_nova" class="form-select br-select" name="txt_unidade_medida_nova" @change="onChangeUnidadeMedida">
                            <option value="" v-text="textoEscolhaUnidadeMedida"></option>
                            <option v-for="item in unidadesMedida" v-text="item.txt_unidade_medida" :value="item.id"
                                :key="item.id"></option>
                        </select>
                </div>
            </div>

            <div class="row mt-3">
                <div class="column col-6 col-xs-12">
                    <label for="txt_data_divulgacao_ou_disponibilizacao">Data de Divulgação ou Disponibilidade</label>
                    <p v-text="dadosIniciativa.txt_data_divulgacao_ou_disponibilizacao"></p>
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
                    <p v-text="dadosIniciativa.dsc_periodicidades"></p>
                </div>
            
                <div class="column col-6 col-xs-12 br-textarea">
                    <label>Nova Periodicidade</label>
                        <select id="periodicidade_id_nova" class="form-select br-select" name="periodicidade_id_nova">
                            <option value="" v-text="textoEscolhaPeriodicidade"></option>
                            <option v-for="item in periodicidades" v-text="item.dsc_periodicidades" :value="item.id"
                                :key="item.id"></option>
                        </select>
                </div>
            </div>

            <div class="row mt-3">
                <div class="column col-6 col-xs-12">
                    <label for="txt_polaridade">Polaridade do Indicador</label>
                    <p v-text="dadosIniciativa.txt_polaridade"></p>
                </div>
            
                <div class="column col-6 col-xs-12 br-textarea">
                    <label>Nova Polaridade do Indicador</label>
                    <select id="polaridade_id_nova" class="form-select br-select" name="polaridade_id_nova" > <!-- Não funcionou-->
                        <option value="" v-text="textoEscolhaPolaridade"></option>
                        <option v-for="item in polaridades" v-text="item.txt_polaridade" :value="item.id"
                            :key="item.id"></option>
                    </select>
                </div>
            </div>

            <div class="row mt-3">
                <div class="column col-6 col-xs-12">
                    <label for="txt_formula_calculo">Fórmula de Cálculo do Indicador</label>
                    <p v-text="dadosIniciativa.txt_formula_calculo ? dadosIniciativa.txt_formula_calculo : 'Verificar no Espelho do PPA'"></p>
                </div>
            
                <div class="column col-6 col-xs-12 br-textarea">
                    <label>Nova Fórmula de Cálculo do Indicador</label>
                    <textarea class="input-medium" id="txt_formula_calculo_nova" name="txt_formula_calculo_nova" rows="5">
                    </textarea>
                </div>
            </div>

            <div class="row mt-3">
                <div class="column col-6 col-xs-12">
                    <label for="txt_fonte_dados_variaveis_calculo">Fonte de Dados das Variáveis do Indicador</label>
                    <p v-text="dadosIniciativa.txt_fonte_dados_variaveis_calculo"></p>
                </div>
            
                <div class="column col-6 col-xs-12 br-textarea">
                    <label>Nova Fonte de Dados das Variáveis do Indicador</label>
                    <textarea class="input-medium" id="txt_fonte_dados_variaveis_calculo_nova" name="txt_fonte_dados_variaveis_calculo_nova" rows="5">
                    </textarea>
                </div>
            </div>

            <div class="row mt-3">
                <div class="column col-6 col-xs-12">
                    <label for="txt_forma_disponibilizacao">Forma de Disponibilização do Indicador</label>
                    <p v-text="dadosIniciativa.txt_forma_disponibilizacao"></p>
                </div>
            
                <div class="column col-6 col-xs-12 br-textarea">
                    <label>Nova Forma de Disponibilização do Indicador</label>
                    <textarea class="input-medium" id="txt_forma_disponibilizacao_nova" name="txt_forma_disponibilizacao_nova" rows="5">
                    </textarea>
                </div>
            </div>

            <div class="row mt-3">
                <div class="column col-6 col-xs-12">
                    <label for="dsc_procedimento_calculo">Procedimento de Cálculo do Indicador</label>
                    <p v-text="dadosIniciativa.dsc_procedimento_calculo"></p>
                </div>
            
                <div class="column col-6 col-xs-12 br-textarea">
                    <label>Nova Procedimento de Cálculo do Indicador</label>
                    <textarea class="input-medium" id="dsc_procedimento_calculo_nova" name="dsc_procedimento_calculo_nova" rows="5">
                    </textarea>
                </div>
            </div>


            <!-- Botões Formulário -->
            <div class="row">
                <div class="col col-xs-12 col-sm-12">
                    <div class="p-3 text-right">
                        <button class="br-button primary mr-3" type="submit" :value="true">Avançar
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
    props: ['url', 'dadosRevisao', 'dadosIniciativa', 'revisaoCadastrada', 'dadosMetaRevisao'],
    data() {
        return {
        //----Campos Select
            bln_meta_regionalizada_nova:'',
            unidadesMedida:'',
            unidadeMedida:'',
            novaUnidadeMedida:this.dadosIniciativa.unidade_medida_simbolo,
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
        onChangeUnidadeMedida(){
            this.novaUnidadeMedida = this.unidadeMedida;
            switch (this.novaUnidadeMedida){
                case 1:
                    this.novaUnidadeMedida = '(R$)';
                    break;
                case 2:
                    this.novaUnidadeMedida = '(%)';
                    break;
                case 3:
                    this.novaUnidadeMedida = '(ADI)';
                    break;
                case 4:
                    this.novaUnidadeMedida = '(m²)';
                    break;
                case 5:
                    this.novaUnidadeMedida = '(UN)';
                    break;
                default:
                    this.novaUnidadeMedida = '';
            }

        },

        irParaPagina(destino){
            window.location.href = this.url + destino;
        }
        
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
