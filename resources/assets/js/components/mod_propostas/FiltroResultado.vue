<template>
   <div class="form-group">  
        
        <div class="row" >        
            <div class="column col-xs-12 col-md-2">
                <label for="uf">UF</label>           
                <select 
                    id="estado"
                    class="form-select br-select" 
                    name="estado"
                    :="requeruf == 'true'"
                    @change="onChangeEstado"
                    v-model="estado">
                    <option value="">Escolha um Estado:</option>
                    <option v-for="estado in estados" v-text="estado.txt_sigla_uf" :value="estado.id" :key="estado.id"></option>
                </select>                                  
            </div>        
            <div class="column col-xs-12 col-md-4">
    <!-- municipio -->    
                <label for="municipio">Município</label>                
                <select 
                    id="municipio"
                    class="form-select br-select" 
                    name="municipio"
                    :="requermunicipio == 'true'"
                    @change="onChangeMunicipio"
                    :disabled="estado == '' || buscando"
                    v-model="municipio">
                    <option value="" v-text="textoEscolhaMunicipio"></option>
                    <option v-for="municipio in municipios" v-text="municipio.ds_municipio" :value="municipio.id" :key="municipio.id"></option>
                </select>    
            </div>
            <div class="column col-xs-12 col-md-6">                
                <label for="acaoPrograma">Ação Programa</label>                
                <select 
                    id="acaoPrograma"
                    class="form-select br-select" 
                    name="acaoPrograma"                    
                    v-model="acaoPrograma">
                    <option value="">Escolha uma Ação</option>
                    <option v-for="item in acaoProgramas" v-text="item.id+ ' - ' + item.txt_acao_programa" :value="item.id" :key="item.id"></option>
                </select>    
            </div>
        </div>
        
        
        <div class="p-3 text-right">
            <button class="br-button primary mr-3" type="submit" :disabled="estado == '' && municipio == '' && selecao == '' && acaoPrograma == '' ">Pesquisar
            </button>
            <button class="br-button danger mr-3" type="button" onclick="javascript:window.history.go(-1)">Voltar
            </button>
        </div> 
    </div>    
</template>

<script>
    export default {
        props:['url','municipioselecionado','ufselecionada','coluf','colmun','requermunicipio','requeruf','complementonomelabelmun'],
        data(){
            return{
                protocolodigitado:'',
                estados:'',
                estado:'',
                municipios: '',
                municipio:'',
                textoEscolhaMunicipio: "Filtre o Estado",
                selecoes: '',
                selecao:'',
                acaoProgramas: '',
                acaoPrograma:'',
                recebidasSistema:''
               
            }        
        },
        methods:{
            onChangeEstado() {
                this.textoEscolhaMunicipio = "Buscando...";
                this.municipio = '';
                this.buscando = true;
                if(this.estado != '') {
                    //busca dados no banco de dados para carregar no componente
                    axios.get(this.url + '/api/municipios/' + this.estado).then(resposta => {
                        this.textoEscolhaMunicipio = "Escolha um municipio:";
                        this.buscando = false;
                        this.municipios = resposta.data;
                        console.log(this.municipios);
                    }).catch(error => {
                        console.log(error);
                    });
                  
                } else {
                    this.buscando = false;
                    this.municipio = '';
                    this.textoEscolhaMunicipio = "Filtre o Estado"
                }            
            },
            onChangeMunicipio() {
                if(this.municipio){
                    this.municipioselecionado = this.municipio;
                }
                
            }
        },
        mounted() {
            //console.log(this.form._token);
            axios.get(this.url + '/api/ufs').then(resposta => {
                //console.log(resposta.data);
                this.estados = resposta.data;
                this.estado = '';
                this.municipio = '';                
                }).catch(erro => {
                    console.log(erro);
                })
           

            axios.get(this.url + '/api/selecao').then(resposta => {
                //console.log(resposta.data);
                this.selecoes = resposta.data;
                this.selecao = '';
                }).catch(erro => {
                    console.log(erro);
                })

            axios.get(this.url + '/api/acaoPrograma').then(resposta => {
                //console.log(resposta.data);
                this.acaoProgramas = resposta.data;
                this.acaoPrograma = '';
                }).catch(erro => {
                    console.log(erro);
                })

                
        }
       
            
    }
</script>
