<template>
    <div>
        <progresso-revisao-iniciativa
        :url="url"
        :dados-revisao="dadosRevisao"
        :active="'iniciativa'"
        :dados-meta-revisao="dadosMetaRevisao"
        >
        </progresso-revisao-iniciativa>
        
        <hr>

        <div class="form-group">
            <p class="text-center"><b>Detalhamento da Iniciativa</b></p>
            <div class="row mt-3">
                <div class="column col-6 col-xs-12">
                    <label for="txt_enunciado_iniciativa">Denominação da Iniciativa</label>
                    <p v-text="dadosIniciativa.txt_enunciado_iniciativa"></p>
                </div>
            
                <div class="column col-6 col-xs-12 br-textarea">
                    <label>Nova Denominação da Iniciativa</label>
                        <textarea class="input-medium" id="txt_enunciado_iniciativa_nova" name="txt_enunciado_iniciativa_nova" rows="2" >
                        </textarea>
                </div>
            </div>

            <div class="row mt-3">
                <div class="column col-6 col-xs-12">
                    <label for="dsc_iniciativa">Descrição da Iniciativa</label>
                    <p v-text="dadosIniciativa.dsc_iniciativa"></p>
                </div>
            
                <div class="column col-6 col-xs-12 br-textarea">
                    <label>Nova Descrição da Iniciativa</label>
                        <textarea class="input-medium" id="dsc_iniciativa_nova" name="dsc_iniciativa_nova" rows="5" >
                        </textarea>
                </div>
            </div>
            
            <div class="row mt-3">
                <div class="column col-6 col-xs-12">
                    <label for="bln_pac">É entrega/iniciativa do PAC?</label>
                    <p v-text="dadosIniciativa.bln_pac ? 'Sim': 'Não'"></p>
                </div>
        
                <div class="column col-6 col-xs-12 br-textarea">
                    <label>Novo enquadramento de entrega/iniciativa do PAC</label>
                    <select id="bln_pac_nova" class="form-select br-select" name="bln_pac_nova" >
                    <option value="">Selecione se a meta é ou não do PAC</option>
                    <option value="true">Sim</option>
                    <option value="false">Não</option>
                    </select>
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
