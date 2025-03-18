<template>
    <div class="form-group">
        <div class="row mt-3">
            <div class="column col-6 col-xs-12">
                <label for="orgaoResponsavel">Órgão Responsável</label> <!-- Alterar para Objetivo Estratégico PEI após alterações no Banco -->
                <select id="orgaoResponsavel" class="form-select br-select" name="orgaoResponsavel"
                    @change="onChangeOrgaoResponsavel" v-model="orgaoResponsavel">
                    <option value="">Escolha a Órgão Responsável:</option>
                    <option v-for="item in orgaosResponsaveis" v-text="item.dsc_orgao" :value="item.id"
                        :key="item.id"></option>
                </select>
            </div>
        
            <div class="column col-6 col-xs-12">
                <label for="objetivoEstrategico">Objetivo Estratégico</label> <!-- Alterar para Objetivo Estratégico PEI após alterações no Banco -->
                <select id="objetivoEstrategico" 
                    class="form-select br-select" 
                    name="objetivoEstrategico" 
                    :disabled="orgaoResponsavel == '' || this.editando=='true'"
                    v-model="objetivoEstrategico">
                    <option value="">{{this.textoEscolhaObjetivo}}</option>
                    <option v-for="item in objetivosEstrategicos" v-text="item.txt_titulo_objetivo_estrategico_pei" :value="item.id"
                        :key="item.id"></option>
                </select>
            </div>
        </div><!--row-->

        <div class="row mt-3">
            <div class="column col-2">
                <div class="br-item" data-toggle="selection">
                    <div class="br-checkbox">
                        <input id="bln_ppa" name="bln_ppa" type="checkbox"/>
                        <label for="bln_ppa">Buscar somente PPA</label>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col col-xs-12 col-sm-12">
                <div class="p-3 text-right">
                    <button class="br-button primary mr-3" type="submit" name="Salvar Edição">Pesquisar
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
    props: ['url', 'dados'],
    data() {
        return {

            //----Objetivos/Órgãos
            objetivosEstrategicos: '',
            objetivoEstrategico: '',
            orgaosResponsaveis: '',
            orgaoResponsavel: '',

            //----Textos de Escolhas
            textoEscolhaObjetivo: "Escolha o Órgão Responsável:",
            textoEscolhaOrgaoResponsavel: "Escolha o Órgão Responsável:",
        }
    },
    methods: {
        onChangeOrgaoResponsavel() {
            this.textoEscolhaObjetivo = "Buscando...";
            this.objetivoEstrategico = '';

            if (this.orgaoResponsavel != '') {
                axios.get(this.url + '/api/plancidades/projetos/orgaoResponsavel/'+ this.orgaoResponsavel).then(resposta => {
                    this.textoEscolhaObjetivo = "Escolha um objetivo estratégico:";
                    this.objetivosEstrategicos = resposta.data;         
                }).catch(error => {
                    console.log(error);
                });
            }else{
                this.textoEscolhaObjetivo = "Escolha o Órgão Responsável:";
                this.orgaoResponsavel = '';
            }           
        },
    },
    mounted() {

         //retorna as Unidades Responsáveis
         axios.get(this.url + '/api/plancidades/orgaosPEI').then(resposta => {
            this.textoEscolhaOrgaoResponsavel = "Escolha o Órgão Responsável:";
            this.orgaosResponsaveis = resposta.data;

        }).catch(error => {
            console.log(error);
        });
        ;
    }
}
</script>
