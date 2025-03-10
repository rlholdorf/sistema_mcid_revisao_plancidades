<template>
   <div class="form-group">   
        <div class="row">        
            <div class="column col-xs-12 col-md-4">
                <label for="uf">UF</label>           
                <select 
                    id="estado"
                    class="form-select br-select" 
                    name="estado"
                    :required="requeruf == 'true'"
                    @change="onChangeEstado"
                    v-model="estado">
                    <option value="">Escolha um Estados:</option>
                    <option v-for="estado in estados" v-text="estado.txt_uf" :value="estado.id" :key="estado.id"></option>
                </select>                                  
            </div>        
            <div class="column col-xs-12 col-md-8">
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
        <div class="row">        
            <div class="column col-xs-12 col-md-4">
                <label for="tipoUsuario">Tipo Usuário</label>           
                <select 
                    id="tipoUsuario"
                    class="form-select br-select" 
                    name="tipoUsuario"
                    v-model="tipoUsuario">
                    <option value="">Escolha um tipo de usuário:</option>
                    <option v-for="tipoUsuario in tipoUsuarios" v-text="tipoUsuario.txt_tipo_usuario" :value="tipoUsuario.id" :key="tipoUsuario.id"></option>
                </select>                                  
            </div>        
            <div class="column col-xs-12 col-md-8">
    <!-- municipio -->    
                <label for="moduloSistema">Módulo Sistema</label>              
                <select 
                    id="moduloSistema"
                    class="form-select br-select" 
                    name="moduloSistema"
                    v-model="moduloSistema">
                    <option value="" >Escolha um módulo</option>
                    <option v-for="moduloSistema in moduloSistemas" v-text="moduloSistema.txt_modulo_sistema" :value="moduloSistema.id" :key="moduloSistema.id"></option>
                </select>    
            </div>
        </div>
        <div class="row">
            <div class="col col-xs-12 col-sm-12 br-input">
                <label for="entePublico">Ente Público</label>                
                <select 
                    id="entePublico"
                    class="form-select br-select" 
                    name="entePublico"
                    :disabled="municipio == '' || buscando"
                    @change="onChangeEnte"
                    v-model="entePublico">
                    <option value="" v-text="textoEscolhaEnte"></option>
                    <option v-for="entePublico in entePublicos" v-text="entePublico.txt_ente_publico" :value="entePublico.id.toString()" :key="entePublico.id.toString()"></option>
                </select>  
            </div>
                    
        </div>
    </div>    
</template>

<script>
    export default {
        props:['url','municipioselecionado','ufselecionada','requermunicipio','requeruf','complementonomelabelmun'],
        data(){
            return{
                estados:'',
                estado:'',
                municipios: '',
                municipio:'',
                textoEscolhaMunicipio: 'Filtre o Estado',
                textoEscolhaEnte:'Filtre o Município',
                buscando: false,
                tipoUsuarios:'',
                tipoUsuario:'',
                moduloSistemas:'',
                moduloSistema:'',
                entePublicos:'',
                entePublico:'',
                
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
                this.textoEscolhaEnte = "Buscando...";
                 this.entePublico = '';
                 this.buscandoEnte = true;
                 if(this.municipio != '') {
                     //busca dados no banco de dados para carregar no componente
                     axios.get(this.url + '/api/ente_publico/municipio/' + this.municipio).then(resposta => {
                         this.textoEscolhaEnte = "Escolha um municipio:";
                         this.buscandoEnte = false;
                         this.entePublicos = resposta.data;                       
                     }).catch(error => {
                         console.log(error);
                     });
                   
                 } else {
                     this.buscandoEnte = false;
                     this.entePublico = '';
                     this.textoEscolhaEnte = "Filtre o Município"
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

            axios.get(this.url + '/api/tipo_usuario').then(resposta => {
                //console.log(resposta.data);
                this.tipoUsuarios = resposta.data;
            }).catch(erro => {
                console.log(erro);
            });

            axios.get(this.url + '/api/modulo_sistema').then(resposta => {
                //console.log(resposta.data);
                this.moduloSistemas = resposta.data;
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
