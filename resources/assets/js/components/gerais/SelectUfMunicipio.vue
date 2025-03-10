<template>
   <div class="form-group">   
        <div class="row">        
            <div v-bind:class="coluf">
                <label for="uf">UF</label>           
                <select 
                    id="estado"
                    class="form-select br-select" 
                    name="estado"
                    :required="requeruf == 'true'"
                    @change="onChangeEstado"
                    v-model="estado">
                    <option value="">Escolha um Estado:</option>
                    <option v-for="estado in estados" v-text="estado.txt_uf" :value="estado.id" :key="estado.id"></option>
                </select>                                  
            </div>        
            <div v-bind:class="colmun">
    <!-- municipio -->    
                <label v-if="!complementonomelabelmun" for="municipio">Município</label>
                <label v-if="complementonomelabelmun" for="municipio">Município {{complementonomelabelmun}}</label>
                <select 
                    id="municipio"
                    class="form-select br-select" 
                    name="municipio"
                    :required="requermunicipio == 'true'"
                    @change="onChangeMunicipio"
                    :disabled="estado == '' || buscando"
                    v-model="municipio">
                    <option value="" v-text="textoEscolhaMunicipio"></option>
                    <option v-for="municipio in municipios" v-text="municipio.ds_municipio" :value="municipio.id" :key="municipio.id"></option>
                </select>    
            </div>
        </div>
    </div>    
</template>

<script>
    export default {
        props:['url','municipioselecionado','ufselecionada','coluf','colmun','requermunicipio','requeruf','complementonomelabelmun'],
        data(){
            return{
                estados:'',
                estado:'',
                municipios: '',
                municipio:'',
                textoEscolhaMunicipio: 'Filtre o Estado',
                buscando: false,
               // requeruf:'true',
               // requermunicipio:'true'
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
            }).catch(erro => {
                console.log(erro);
            });
                this.estado = '';
                this.municipio = '';
            if(this.municipioselecionado || this.municipio){
                 axios.get(this.url + '/api/municipio/estado/' + this.municipioselecionado).then(resposta => {
                        this.estado = resposta.data;
                        this.onChangeEstado();
                        this.municipio = this.municipioselecionado;

                    }).catch(error => {
                        console.log(error);
                    });  
            }else{
                this.estado = '';
                this.municipio = '';
            }

            if(this.ufselecionada){
                this.estado = this.ufselecionada;
                this.onChangeEstado();
                document.getElementById("estado").disabled = true;
            }


        }
    }
</script>
