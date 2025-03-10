<template>
    <div>
        
        <div class="form-group row">  
            <div class="col col-xs-12 col-sm-4">      
                <label for="modulo_sistema" v-bind:class="collabel">Módulo Sistema</label>             
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
            <div class="col col-xs-12 col-sm-4">      
                <label for="tipo_usuario_id" v-bind:class="collabel">Tipo Usuário</label> 
                    <select 
                        id="tipo_usuario_id"
                        class="form-select br-select" 
                        name="tipo_usuario_id"
                        required      
                        @change="onChangeTipo"
                        v-model="tipo_usuario">
                        <option value="" v-text="this.textoEscolha"></option>
                        <option v-for="item in tipoUsuarios" v-text="item.txt_tipo_usuario" :value="item.id" :key="item.id"></option>
                    </select>                                  
                </div>   
                
                
                <div class="col col-xs-12 col-sm-4">
                    <label for="ente_publico_id" v-bind:class="collabel">Ente Público</label>                 
                        <select v-if="modulo_sistema != 2"
                            id="ente_publico_id"
                            class="form-select br-select" 
                            name="ente_publico_id"                 
                            v-model="ente_publico_id">
                            <option value="">Escolha um Ente Público</option>
                            <option value="05465986000199">Ministério das Cidades</option>
                            <option value="33657248000189">Banco Nacional de Desenvolvimento Econômico e Social</option>
                        </select>  
                        <input v-if="modulo_sistema == 2" id="ente_publico" type="text" class="form-control" name="ente_publico" v-model="ente_publico" disabled >
                                
                    </div>   
                </div>          
        
    </div>
</template>

<script>
    export default {
        props:['url','colinput','collabel','dados'],
        data(){
            return{
                tipoUsuarios:'',
                tipo_usuario:'',
                moduloSistemas:'',
                modulo_sistema:'',
                modulos_sistema:[],
                textoEscolha:'Filtre um módulo de sistema:',
                buscando: true,
                ente_publico_id:'05465986000199',
                ente_publico:'',
                textoEscolhaDepartamento: "Escolha uma secretaria:",
                textoEscolhaSetor: "Escolha uma secretaria:",
                secretaria:'',
                secretarias:'',
                departamento:'',
                departamentos:'',
                setor:'',
                setores:'',
                
            }        
        },
        methods:{
            onChangeTipo() {
                if(this.modulo_sistema == 5){
                    this.ente_publico_id = '33657248000189';
                }else{
                    this.ente_publico_id = '05465986000199';

                }

            },
            onChangeSecretaria() {
                this.textoEscolhaDepartamento = "Buscando...";
                this.departamento = '';
                this.buscando = true;
                if(this.secretaria != '') {
                    //Implementação correta após arrumar tabela dos municipios
                    axios.get(this.url + '/api/sistema/departamento/secretaria/' + this.secretaria).then(resposta => {
                        this.textoEscolhaDepartamento = "Escolha um departamento:";
                        this.buscando = false;
                        this.departamentos = resposta.data;                        
                        this.departamento = 7;     
                        this.onChangeDepartamento();
                        console.log(this.departamentos);                   
                    }).catch(error => {
                        console.log(error);
                    });
                  
                } else {
                    this.buscando = false;
                    this.departamento = '';
                    this.textoEscolhaDepartamento = "Filtre a Secretaria"
                }            
            },
            onChangeDepartamento() {
                this.textoEscolhaSetor = "Buscando...";
                this.setor = '';
                this.buscando = true;
                if(this.departamento != '') {
                    //Implementação correta após arrumar tabela dos municipios
                    axios.get(this.url + '/api/sistema/setor/departamento/' + this.departamento).then(resposta => {
                        this.textoEscolhaSetor = "Escolha um setor:";
                        this.buscando = false;
                        this.setores = resposta.data;     
                        this.setor = 16;                   
                    }).catch(error => {
                        console.log(error);
                    });
                  
                } else {
                    this.buscando = false;
                    this.setor = '';
                    this.textoEscolhaSetor = "Filtre um Departamento"
                }            
            },
            onChangeModuloSistema() {
                this.textoEscolha = "Buscando...";
                this.tipoUsuario= '';
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

                if(this.modulo_sistema == 5){
                    this.ente_publico_id = '33657248000189';
                }else{
                    this.ente_publico_id = '05465986000199';
                }
            }    
        },    
        mounted() {

             //retorna as secretarias
             axios.get(this.url + '/api/sistema/secretarias/').then(resposta => {
                this.textoEscolhaDepartamento = "Escolha uma secretaria:";
                this.textoEscolhaSetor = "Escolha uma secretaria:";
                this.buscando = false;
                this.secretarias = resposta.data;
            }).catch(error => {
                console.log(error);
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

            if(this.dados){

                this.modulo_sistema = this.dados.modulo_sistema_id;
                this.onChangeModuloSistema();
                this.tipo_usuario = this.dados.tipo_usuario_id;
                
                this.ente_publico = this.dados.ente_publico_id;
                this.ente_publico = this.dados.ente_publico.txt_ente_publico;

            }
        }
    }
</script>

