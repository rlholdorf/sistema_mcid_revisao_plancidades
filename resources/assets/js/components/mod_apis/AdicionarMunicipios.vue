<template>
    <div class="form-group">
        <div class="row">
            <div class="column col-xs-12 col-md-4">                
                <label for="uf">UF</label>           
                <select 
                    id="estado"
                    class="form-select br-select" 
                    name="estado"                   
                    @change="onChangeEstado"
                    v-model="estado">
                    <option value="">Escolha um Estado:</option>
                    <option v-for="estado in estados" v-text="estado.txt_sigla_uf" :value="estado.id" :key="estado.id"></option>
                </select>                                                      
            </div> 
        </div>
            <div class="titulo"  v-if="estado != '' && this.municipios.length > 1">
                    <h5>Municípios Beneficiados</h5> 
                </div>
                <div class="row" v-if="estado != '' && this.municipios.length > 1">
                
                    <div class="col col-xs-12 col-sm-4 br-checkbox">
                        <input id="checkbox-1" name="checkbox-1" type="checkbox" @click='checkAll()' v-model='isCheckAll'/>
                        <label for="checkbox-1">Todos</label>
                    </div>
                    <div class="col col-xs-12 col-sm-4 br-checkbox" v-for='lang in municipios'>
                        <input id="municipiosBeneficiados"  name="municipiosBeneficiados[]" type='checkbox' v-bind:value='lang.cod_ibge_7d' v-model='municipiosCheck'  @change='updateCheckall()'/>        
                        <label for="checkbox-1">{{ lang.ds_municipio }}</label>
                    </div>
                </div>
        
    </div>
</template>

<script>
    export default {
        props:['url','dados'],
        data(){
            return{
                
                situacao_emissoes:'',
                estado:'',
                estados:'',
                textoEscolhaMunicipio:'Filtre o Estado',
                municipio:'',
                municipios:'',                
                buscando: false,
                isCheckAll: false,           
                listmunic: [],                
                municipiosCheck:[],
                selectedlang: "",
            }
        },
        methods:{    
            checkAll: function(){

                this.isCheckAll = !this.isCheckAll;
                this.municipiosCheck = [];
                if(this.isCheckAll){ // Check all
                    for (let i = 0; i < this.municipios.length; i++) {
                    this.municipiosCheck.push(this.municipios[i].cod_ibge_7d);
                    }
                }
            },
            updateCheckall: function(){
                if(this.municipiosCheck.length == this.municipios.length){
                    this.isCheckAll = true;
                }else{
                    this.isCheckAll = false;
                }
            },onChangeEstado() {
                this.textoEscolhaMunicipio = "Buscando...";
                this.municipio = '';
                this.buscando = true;
                if(this.estado != '') {
                    //busca dados no banco de dados para carregar no componente
                    axios.get(this.url + '/api/apis/debentures/municipios/' + this.estado).then(resposta => {
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
            }       
           
        } ,
        mounted() {           
            axios.get(this.url + '/api/ufs').then(resposta => {
                //console.log(resposta.data);
                this.estados = resposta.data;
                this.estado = '';            
                }).catch(erro => {
                    console.log(erro);
                })
           
          
            
        }
            

        
    }
</script>
