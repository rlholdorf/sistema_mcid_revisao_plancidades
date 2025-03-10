<template>
    <div>
        <!--
        <div class="form-group row">        
            <label for="modulo_sistema" v-bind:class="collabel">Módulo Sistema</label> 
            <div v-bind:class="colinput">
                <select 
                    id="modulo_sistema_id"
                    class="form-select br-select" 
                    name="modulo_sistema_id"
                    required
                    @change="onChangeModuloSistema"
                    v-model="modulo_sistema">
                    <option value="">Escolha um Módulo Sistema:</option>
                    <option v-for="item in moduloSistemas" v-text="item.txt_modulo_sistema" :value="item.id" :key="item.id"></option>
                </select>                                  
            </div> 
        </div>
        -->
        <div class="form-group row">   
            <label for="modulo_sistema" v-bind:class="collabel">Módulo Sistema</label>    
            <div v-bind:class="colinput">
                <div class="form-check"  v-for="item in moduloSistemas">       
                    <label class="form-check-label" >
                    <input class="form-check-input" 
                        type="checkbox" 
                        :id="'modulo_sistema_' +item.id"
                        
                        name="modulo_sistema[]"
                        :value="item.id"
                        v-model="modulos_sistema"
                        :checked="sistema_coleta_esgoto">&nbsp;{{item.txt_modulo_sistema}}</label>
                </div>
            </div>
        </div>
        <div class="form-group row">      
            <label for="tipo_usuario_id" v-bind:class="collabel">Tipo Usuário</label> 
            <div v-bind:class="colinput">
                            
                    <select 
                        id="tipo_usuario_id"
                        class="form-select br-select" 
                        name="tipo_usuario_id"
                        required      
                         :disabled="buscando"                 
                        v-model="tipo_usuario">
                        <option value="" v-text="this.textoEscolha"></option>
                        <option v-for="item in tipoUsuarios" v-text="item.txt_tipo_usuario" :value="item.id" :key="item.id"></option>
                    </select>                                  
                </div>   
            </div>      
            <div class="form-group row">      
                <label for="ente_publico_id" v-bind:class="collabel">Ente Público</label> 
                <div v-bind:class="colinput">
                                
                        <select 
                            id="ente_publico_id"
                            class="form-select br-select" 
                            name="ente_publico_id"                 
                            v-model="ente_publico_id">
                            <option value="">Escolha um Ente Público</option>
                            <option value="05465986000199">Ministério das Cidades</option>
                        </select>                                  
                    </div>   
                </div>          
      
    </div>
</template>

<script>
    export default {
        props:['url','colinput','collabel'],
        data(){
            return{
                 tipoUsuarios:'',
                 tipo_usuario:'',
                  moduloSistemas:'',
                 modulo_sistema:'',
                 modulos_sistema:'',
                 textoEscolha:'Filtre um módulo de sistema:',
                   buscando: true,
                   ente_publico_id:'05465986000199'
                
            }        
        },
        methods:{
            onChangeModuloSistema() {
                this.textoEscolha = "Buscando...";
                
                this.buscando = true;
                if(this.modulo_sistema != '') {
                    //busca dados no banco de dados para carregar no componente
                    axios.get(this.url + '/api/tipo_usuario/' + this.modulo_sistema).then(resposta => {
                        this.textoEscolha = "Escolha um Tipo de Usuário:";
                        this.buscando = false;
                        this.tipoUsuarios = resposta.data;
                        console.log('/api/tipo_usuario/' + this.modulo_sistema);
                    }).catch(error => {
                        console.log(error);
                    });
                  
                } else {
                    this.buscando = false;
                    this.tipo_usuario = '';
                    this.textoEscolha = "Filtre um módulo de sistema"
                }  
            }    
        },    
        mounted() {
             
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
        }
    }
</script>

