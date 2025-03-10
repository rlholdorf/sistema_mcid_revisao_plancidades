<template>
    <div>
        <div class="form-group row">
            <div class="col col-xs-12 col-sm-4 br-input input-button">
                <label for="name" >Nome</label>            
                <input id="name" type="text" name="name" v-model="name" required autofocus>                
            </div>
        
            <div class="col col-xs-12 col-sm-4 br-input">
                <label for="email" class="textmd-left">E-Mail Usuário</label>            
                <input id="email" type="email" class="form-control" name="email" v-model="email" required>
                    <span class="feedback danger" role="alert" v-if="this.erroemail">
                        <i class="fas fa-times-circle" aria-hidden="true"></i>Já existe um cadastro com esse email.
                    </span>
            </div> 
            <div class="col col-xs-12 col-sm-4 br-input">
                <label for="cpf" class="textmd-left">CPF</label>            
                <input id="cpf" type="cpf" class="form-control" name="cpf" v-model="cpf" required>
                    <span class="feedback danger" role="alert" v-if="this.errocpf">
                        <i class="fas fa-times-circle" aria-hidden="true"></i>Já existe um cadastro com esse CPF.
                    </span>
            </div>        
             
            </div>
            <div class="form-group row"> 
                <div class="col col-xs-12 col-sm-4">
                    <label for="secretaria">Secretaria</label>           
                    <select 
                        id="secretaria"
                        class="form-select br-select" 
                        name="secretaria"  
                        v-model="secretaria"   
                        @change="onChangeSecretaria"
                        required
                    >
                        <option value="" >Escolha uma Secretaria</option>
                        <option v-for="secretaria in secretarias" v-text="secretaria.txt_nome_secretaria" :value="secretaria.id" :key="secretaria.id"></option>
                    </select>
                </div>
                <div class="col col-xs-12 col-sm-4">
                    <label for="departamento">Departamento</label>           
                    <select 
                        id="departamento"
                        class="form-select br-select" 
                        name="departamento"  
                        v-model="departamento"   
                        @change="onChangeDepartamento" 
                        :disabled="this.secretaria == ''"                       
                        required
                    >
                        <option value=""  v-text="textoEscolhaDepartamento"></option>
                        <option v-for="departamento in departamentos" v-text="departamento.txt_sigla_departamento" :value="departamento.id" :key="departamento.id"></option>
                    </select>
                </div>
                <div class="col col-xs-12 col-sm-4">
                    <label for="setor">Setor</label>           
                    <select 
                        id="setor"
                        class="form-select br-select" 
                        name="setor"  
                        v-model="setor"                         
                        :disabled="this.departamento == ''"
                        required
                    >
                        <option value=""  v-text="textoEscolhaSetor"></option>
                        <option v-for="setor in setores" v-text="setor.txt_sigla_setor" :value="setor.id" :key="setor.id"></option>
                    </select>
                </div>
                   
            </div><!-- fim row -->
            <div class="form-group row">  
                <div class="col col-xs-12 col-sm-4">      
                    <label for="modulo_sistema" >Módulo Sistema</label>             
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
                    <label for="tipo_usuario_id">Tipo Usuário</label> 
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
                    <label for="ente_publico_id">Ente Público</label>                 
                        <select 
                            id="ente_publico_id"
                            class="form-select br-select" 
                            name="ente_publico_id"                 
                            v-model="ente_publico_id">
                            <option value="">Escolha um Ente Público</option>
                            <option value="05465986000199">Ministério das Cidades</option>
                            <option value="33657248000189">Banco Nacional de Desenvolvimento Econômico e Social</option>
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
                name:'',
                email:'',
                cpf:'',
                erroemail:'',
                tipoUsuarios:'',
                tipo_usuario:'',
                moduloSistemas:'',
                modulo_sistema:'',
                modulos_sistema:[],
                textoEscolha:'Filtre um módulo de sistema:',
                buscando: true,
                ente_publico_id:'05465986000199',
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
                        this.textoEscolhaSetor = "Escolha um departamento:";
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
        }
    }
</script>

