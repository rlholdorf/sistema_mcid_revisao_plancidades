<template>
<div class="form-group">  
    <div class="row"  v-if="!(secretaria || distribuicao)">
        <div class="column col-xs-12">
            <div class="br-input">
              <label for="codigo">Código Plano de Ação</label>
              <input
                id="codigo"
                name="codigo"
                type="text"
                v-model="codigo"
                placeholder="Digite o Código da Base"
              />
            </div>
          </div>
    </div>
    <div class="row" v-if="!codigo" > 
        <div class="col col-xs-12 col-sm-6">
            <label for="secretaria">Secretaria</label>           
            <select 
                id="secretaria"
                class="form-select br-select" 
                name="secretaria"  
                v-model="secretaria"   
                @change="onChangeSecretaria"
                
            >
                <option value="" >Escolha uma Secretaria</option>
                <option v-for="item in secretarias" v-text="item.txt_sigla_secretaria" :value="item.id" :key="item.id"></option>
                <option value="99" >Não se aplica</option>
            </select>
        </div>
        <div class="col col-xs-12 col-sm-6">
            <label for="analise">Situação Distribuição</label>           
            <select 
                id="bln_distribuicao"
                class="form-select br-select" 
                name="bln_distribuicao"  
                v-model="distribuicao" 
                
            >
            <option value="" >Escolha uma Situação</option>
            <option value="0" >A distribuir</option>
            <option value="1" >Distribuído</option>
           
            
                
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
                secretaria:'',
                secretarias:'',
                distribuicao:'',
                codigo:''
            }        
        },
        methods:{
            onChangeSecretaria() {
                this.textoEscolhaDepartamento = "Buscando...";
                this.departamento = '';
                this.buscando = true;
                if(this.secretaria != '') {
                    //Implementação correta após arrumar tabela dos municipios
                    axios.get(this.url + '/api/planos_acoes/responsavel/secretaria/' + this.secretaria).then(resposta => {
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
            }
        },    
        mounted() {


            axios.get(this.url + '/api/planos_acoes/situacao_analise').then(resposta => {
                        this.situacao_analises = resposta.data;                        
                        
                        console.log(this.departamentos);                   
                    }).catch(error => {
                        console.log(error);
                    });

            axios.get(this.url + '/api/carteira_investimento/secretarias').then(resposta => {
                        this.secretarias = resposta.data;                        
                        
                        console.log(this.departamentos);                   
                    }).catch(error => {
                        console.log(error);
                    });

                    

             
             
          
        }
    }
</script>

