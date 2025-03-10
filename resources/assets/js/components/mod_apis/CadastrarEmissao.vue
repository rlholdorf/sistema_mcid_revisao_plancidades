<template>
    <div class="form-group">
        <div class="row">
            <div class="column col-xs-12 col-md-4">
                <label for="situacao_emissao">Situação Emissão</label>           
                <select 
                    id="situacao_emissao"
                    class="form-select br-select" 
                    name="situacao_emissao"                   
                    v-model="situacao_emissao"
                    :disabled="this.dados"
                    required>
                    <option value="">Escolha uma situação:</option>
                    <option v-for="situacao_emissao in situacao_emissoes" v-text="situacao_emissao.txt_situacao_emissao" :value="situacao_emissao.id" :key="situacao_emissao.id"></option>
                </select>                                  
            </div> 
        </div>
        <div class="row"  v-if="situacao_emissao == 1">  
            
            <div class="col col-xs-12 col-sm-4 br-input">
                <label for="dte_emissao" class="control-label">Data de Emissão</label>
                <input id="dte_emissao" 
                    type="date" 
                    class="form-control" 
                    name="dte_emissao" 
                    v-model="dte_emissao" 
                    
                    required
                    >
            </div>  
            <div class="col col-xs-12 col-sm-4 br-input">
                <label for="dte_distribuicao" class="control-label">Data de Distribuição</label>
                <input id="dte_distribuicao" 
                    type="date" 
                    class="form-control" 
                    name="dte_distribuicao" 
                    v-model="dte_distribuicao" 
                    
                    >
            </div> 
            <div class="col col-xs-12 col-sm-4 br-input">
                <label for="dte_encerramento_oferta_publica" class="control-label">Data de Encerramento Oferta Pública</label>
                <input id="dte_encerramento_oferta_publica" 
                    type="date" 
                    class="form-control" 
                    name="dte_encerramento_oferta_publica" 
                    v-model="dte_encerramento_oferta_publica" 
                    
                    >
            </div>  
        </div>
        <div class="row"    v-if="situacao_emissao == 1">    
            <div class="column col-xs-12">
                <label for="agente_fiduciario">Agente Fiduciário</label>           
                <select 
                    id="agente_fiduciario"
                    class="form-select br-select" 
                    name="agente_fiduciario"                   
                    v-model="agente_fiduciario"
                    >
                    <option value="">Escolha um agente:</option>
                    <option v-for="agente_fiduciario in agente_fiduciarios" v-text="agente_fiduciario.txt_agente_fiduciario" :value="agente_fiduciario.id" :key="situacao_emissao.id"></option>
                </select>                                  
            </div> 
        </div>
        <div class="row"    v-if="situacao_emissao == 1">  
            <div class="col col-xs-12 col-sm-4 br-input">
                <label for="vlr_captado" class="control-label">Valor Captado</label>
                <input id="vlr_captado" 
                    type="number"                    
                    step=".01"
                    class="form-control" 
                    name="vlr_captado" 
                    v-model="vlr_captado" 
                    
                    >
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
                situacao_emissao:'',
                dte_emissao:'',
                dte_distribuicao:'',
                dte_encerramento_oferta_publica:'',
                vlr_captado:'',
                agente_fiduciarios:'',
                agente_fiduciario:''
            }
        },
        methods:{           
           
        } ,
        mounted() {           

            axios.get(this.url + '/api/apis/situacao_emissao').then(resposta => {
                //console.log(resposta.data);
                this.situacao_emissoes = resposta.data;                
            }).catch(erro => {
                console.log(erro);
            })

            axios.get(this.url + '/api/apis/agente_fiduciario').then(resposta => {
                //console.log(resposta.data);
                this.agente_fiduciarios = resposta.data;                
                     
            }).catch(erro => {
                console.log(erro);
            })

            if(this.dados){

                this.situacao_emissao = this.dados.situacao_emissao_id;
                this.dte_emissao = this.dados.dte_emissao;
                this.dte_distribuicao = this.dados.dte_distribuicao;
                this.vlr_captado = this.dados.vlr_captado;
                this.agente_fiduciario = this.dados.agente_fiduciario_id;
            }
            
        }
            

        
    }
</script>
