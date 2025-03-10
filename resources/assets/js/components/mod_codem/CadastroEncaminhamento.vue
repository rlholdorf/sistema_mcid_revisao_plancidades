<template>
<div>   
    <div class="form-group">
        <div class="row"> 
            <div class="col col-xs-12 col-sm-3">
                <label for="secretaria">Secretaria Demandada</label>           
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
            <div class="col col-xs-12 col-sm-3">
                <label for="departamento">Departamento Demandado</label>           
                <select 
                    id="departamento"
                    class="form-select br-select" 
                    name="departamento"  
                    v-model="departamento"   
                    @change="onChangeDepartamento"
                    :disabled="(this.secretaria == '')"
                    required
                >
                    <option value=""  v-text="textoEscolhaDepartamento"></option>
                    <option v-for="departamento in departamentos" v-text="departamento.txt_nome_departamento" :value="departamento.id" :key="departamento.id"></option>
                </select>
            </div>
            <div class="col col-xs-12 col-sm-3">
                <label for="setor">Setor Demandado</label>           
                <select 
                    id="setor"
                    class="form-select br-select" 
                    name="setor"  
                    v-model="setor"  
                    @change="onChangeSetor"  
                    :disabled="(this.departamento == '')"
                    required
                >
                    <option value=""  v-text="textoEscolhaSetor"></option>
                    <option v-for="setor in setores" v-text="setor.txt_nome_setor" :value="setor.id" :key="setor.id"></option>
                </select>
            </div>
            <div class="col col-xs-12 col-sm-3">
                <label for="usuario">Demandado</label>           
                <select 
                    id="usuario"
                    class="form-select br-select" 
                    name="usuario"  
                    v-model="usuario"   
                    :disabled="(this.setor == '')" 
                    required
                >
                    <option value=""  v-text="textoEscolhaUsuario"></option>
                    <option v-for="usuario in usuarios" v-text="usuario.name + ' (' + usuario.email+')'" :value="usuario.id" :key="usuario.id"></option>
                </select>
            </div>
               
        </div><!-- fim row -->
        <div class="form-group br-textarea">
            <label for="dsc_encaminhamento" class="control-label">Descrição do Encaminhamento </label>
            <textarea class="form-control" 
               id="dsc_encaminhamento" 
               name="dsc_encaminhamento"  
               v-model="dsc_encaminhamento"
               rows="6" 
               :disabled="this.dados"
               required></textarea>
       </div>
       
        <div class="form-group br-textarea">
            <label for="dsc_resposta_encaminhamento" class="control-label">Resposta do Encaminhamento</label>
            <textarea class="form-control" 
               id="dsc_resposta_encaminhamento" 
               name="dsc_resposta_encaminhamento"  
               v-model="dsc_resposta_encaminhamento"
               rows="6" 
               :required="bln_concluido == 1"></textarea>
       </div>

       <div class="row">
        <div class="col col-xs-12 col-sm-4 br-input">
            <label for="dte_encaminhamento" class="control-label">Data do encaminhamento</label>
            <input id="dte_encaminhamento" 
                type="date" 
                class="form-control" 
                name="dte_encaminhamento" 
                v-model="dte_encaminhamento" :disabled="this.dados">
        </div>
   
        <div class="col col-xs-12 col-sm-4">
            <label for="bln_concluido">Encaminhamento Concluído</label>
            <select 
                id="bln_concluido"
                class="form-select br-select" 
                name="bln_concluido"
                required                        
                v-model="bln_concluido">
                <option value="" >Concluído?</option>
                <option value="0" >Não</option>
                <option value="1" >Sim</option>

            </select> 
        </div>  
        <div class="col col-xs-12 col-sm-4 br-input">
            <label for="dte_resposta" class="control-label">Data da Resposta</label>
            <input id="dte_resposta" 
                type="date" 
                class="form-control" 
                name="dte_resposta" 
                v-model="dte_resposta"
                :required="bln_concluido == 1">
        </div>             
    </div><!-- fim row -->
        

    </div>  <!-- form-group -->
           
</div>
</template>

<script>
    export default {
        props:['url','dados','usuariodemandante'],
        data(){
            return{
                secretaria:'',
                secretarias:'',
                departamento:'',
                departamentos:'',
                setor:'',
                setores:'',
                usuario:'',
                usuarios:'',
                textoEscolhaDepartamento: "Escolha uma secretaria:",
                textoEscolhaSetor: "Escolha uma secretaria:",
                textoEscolhaUsuario:'Escolha um setor',
                dte_encaminhamento:'',
                dsc_encaminhamento:'',
                bln_concluido:'0',
                dte_resposta:'',
                dsc_resposta_encaminhamento:'',
                
            }        
        },
       
        methods:{
            onChangeSecretaria() {
                this.textoEscolhaDepartamento = "Buscando...";
                
                this.buscando = true;
                if(this.secretaria != '') {
                    //Implementação correta após arrumar tabela dos municipios
                    axios.get(this.url + '/api/sistema/departamento/secretaria/' + this.secretaria).then(resposta => {
                        this.textoEscolhaDepartamento = "Escolha um departamento:";
                        this.buscando = false;
                        this.departamentos = resposta.data;               
                    }).catch(error => {
                        console.log(error);
                    });
                  
                } else {
                    this.buscando = false;
                    this.departamento = '';
                    this.textoEscolhaDepartamento = "Escolha uma Secretaria"
                }            
            },
            onChangeDepartamento() {
                this.textoEscolhaSetor = "Buscando...";
                
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
                    this.textoEscolhaSetor = "Escolha um Departamento"
                }            
            },
            onChangeSetor() {
                this.textoEscolhaUsuario = "Buscando...";
                
                this.buscando = true;
                if(this.setor != '') {
                    //Implementação correta após arrumar tabela dos municipios
                    axios.get(this.url + '/api/sistema/usuario/setor/' + this.setor).then(resposta => {
                        this.textoEscolhaUsuario = "Escolha um demandado:";
                        this.buscando = false;
                        this.usuarios = resposta.data;               
                    }).catch(error => {
                        console.log(error);
                    });
                  
                } else {
                    this.buscando = false;
                    this.usuario = '';
                    this.textoEscolhaUsuario = "Escolha um setor"
                }            
            },
            
            
        },
        mounted() {

                      
             //retorna as secretarias
             axios.get(this.url + '/api/sistema/secretarias/').then(resposta => {
                this.textoEscolhaDepartamento = "Escolha uma secretaria:";
                this.textoEscolhaSetor = "Escolha uma secretaria:";
                this.buscando = false;
                this.secretarias = resposta.data;
                this.onChangeSecretaria();
                
            }).catch(error => {
                console.log(error);
            });

            var dteEncaminhamento = new Date();
            this.dte_encaminhamento = dteEncaminhamento.getDate() + '/' + (dteEncaminhamento.getMonth()+1) + '/' + dteEncaminhamento.getFullYear();


            console.log('data: ' + this.dte_encaminhamento);

            if(this.dados){
                
                this.secretaria = this.dados.secretaria_id;
                this.onChangeSecretaria();
                this.departamento = this.dados.departamento_id;
                this.onChangeDepartamento();
                this.setor = this.dados.setor_id;
                this.onChangeSetor();
                this.usuario = this.dados.usuario_id_demandado;
                this.dte_encaminhamento = this.dados.dte_encaminhamento;
                this.dsc_encaminhamento = this.dados.dsc_encaminhamento;
                if(this.dados.bln_concluido){
                    this.bln_concluido = 1;
                }else{
                    this.bln_concluido = 0;
                }
                this.dte_resposta = this.dados.dte_resposta;
                this.dsc_resposta_encaminhamento = this.dados.txt_resposta_encaminhamento;
                
            }



        }
    }
</script>
