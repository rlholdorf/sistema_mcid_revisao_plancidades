<template>
    <div>        
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
    </div>
</template>

<script>
    export default {
        props:['url','colinput','collabel','dados'],
        data(){
            return{
                buscando: true,
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

            if(this.dados){

                this.secretaria = this.dados.setor.departamento.secretaria_id;
                this.onChangeSecretaria();
                this.departamento = this.dados.setor.departamento_id;
                this.onChangeDepartamento();
                this.setor = this.dados.setor_id;

}
             
           
        }
    }
</script>

