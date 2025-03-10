<template>
    <div class="form-group">
        <div class="row">              
            <div class="col col-xs-12 col-sm-4 br-input">
                <label for="num_emissao" class="control-label">Número da Emissão</label>
                <input id="num_emissao" 
                    type="text" 
                    class="form-control" 
                    name="num_emissao" 
                    v-model="num_emissao" 
                
                    >
            </div>  
            <div class="column col-xs-12 col-md-4">
                <label for="bln_serie_unica">Série única?</label>           
                <select 
                    id="bln_serie_unica"
                    class="form-select br-select" 
                    name="bln_serie_unica"                   
                    v-model="bln_serie_unica"
                >
                    <option value="">Série única?</option>
                    <option value="0">Não</option>
                    <option value="1">Sim</option>
                    
                </select>                                  
            </div> 
            <div class="col col-xs-12 col-sm-4 br-input" v-if="bln_serie_unica == 0">
                <label for="num_serie_emissao" class="control-label">Número da Série</label>
                <input id="num_serie_emissao" 
                    type="text" 
                    class="form-control" 
                    name="num_serie_emissao" 
                    v-model="num_serie_emissao" 
                
                    >
            </div> 
        </div>
        <div class="form-group br-textarea"  v-if="bln_serie_unica == 0 && num_serie_emissao != ''">
            <label for="txt_observacao_serie" class="control-label">Observação série</label>
            <textarea class="form-control" 
               id="txt_observacao_serie" 
               name="txt_observacao_serie"  
               v-model="txt_observacao_serie"
               rows="3"></textarea>
       </div>
       <div class="row">              
            <div class="col col-xs-12 col-sm-4 br-input">
                <label for="vlr_emissao" class="control-label">Valor da Emissão</label>            
                <input id="vlr_emissao" 
                    type="number"                    
                    step=".01"
                    class="form-control" 
                    name="vlr_emissao" 
                    v-model="vlr_emissao"                     
                    >
            </div>  
            <div class="column col-xs-12 col-md-4">
                <label for="vlr_captado" class="control-label">Valor Captado</label>
                <input id="vlr_captado" 
                    type="number"                    
                    step=".01"
                    class="form-control" 
                    name="vlr_captado" 
                    v-model="vlr_captado" 
                    
                    >                       
            </div> 
            <div class="col col-xs-12 col-sm-4 br-input">           
                <label for="vlr_unitario" class="control-label">Valor Unitário</label>
                <input id="vlr_unitario" 
                    type="number"                    
                    step=".01"
                    class="form-control" 
                    name="vlr_unitario" 
                    v-model="vlr_unitario" 
                    
                    >
            </div> 
        </div>
        <div class="form-group br-textarea"  v-if="vlr_emissao > 0">
            <label for="dsc_valor" class="control-label">Descrição do Valor</label>
            <textarea class="form-control" 
            id="dsc_valor" 
            name="dsc_valor"  
            v-model="dsc_valor"
            rows="3"></textarea>
        </div>
        <div class="row">              
            <div class="col col-xs-12 col-sm-3 br-input">
                <label for="dte_vencimento" class="control-label">Vencimento</label>
                <input id="dte_vencimento" 
                    type="date" 
                    class="form-control" 
                    name="dte_vencimento" 
                    v-model="dte_vencimento" 
                
                    >
            </div>  
            <div class="col col-xs-12 col-sm-3 br-input">
                <label for="txt_taxa" class="control-label">Taxa</label>
                <input id="txt_taxa" 
                    type="date" 
                    class="form-control" 
                    name="txt_taxa" 
                    v-model="txt_taxa" 
                
                    >
            </div>  
            <div class="col col-xs-12 col-sm-2 br-input" v-if="bln_serie_unica == 0">
                <label for="num_prazo_meses" class="control-label">Prazo (meses)</label>
                <input id="num_prazo_meses" 
                    type="number"                    
                    step=".01"
                    class="form-control" 
                    name="num_prazo_meses" 
                    v-model="num_prazo_meses" 
                    
                    >
            </div> 
            <div class="col col-xs-12 col-sm-2 br-input" v-if="bln_serie_unica == 0">
                <label for="num_duracao_anos" class="control-label">Duração (anos)</label>
                <input id="num_duracao_anos" 
                    type="number"                    
                    step=".01"
                    class="form-control" 
                    name="num_duracao_anos" 
                    v-model="num_duracao_anos" 
                    
                    >
            </div> 
            <div class="col col-xs-12 col-sm-3 br-input">
                <label for="num_cvm" class="control-label">CVM</label>
                <input id="num_cvm" 
                    type="text" 
                    class="form-control" 
                    name="num_cvm" 
                    v-model="num_cvm" 
                
                    >
            </div>  
        </div>
        <hr>
        <div class="p-3 text-right" v-if="btnbuttons">
            <button type="button" class="br-button danger mr-3" data-bs-dismiss="modal">Fechar</button>
            <button type="submit" class="br-button primary mr-3" v-if="num_emissao || num_serie_emissao || txt_observacao_serie ||  vlr_emissao || dsc_valor || vlr_captado || vlr_unitario || dte_vencimento || txt_taxa || num_prazo_meses || num_duracao_anos || num_cvm">Salvar</button>
        </div>
    </div>
</template>

<script>
    export default {
        props:['url', 'dados','btnbuttons'],
        data(){
            return{
                
                num_emissao:'',
                num_serie_emissao:'',
                txt_observacao_serie:'',
                bln_serie_unica:0,
                vlr_emissao:'',
                dsc_valor:'',
                vlr_captado:'',
                vlr_unitario:'',
                dte_vencimento:'',
                txt_taxa:'',
                num_prazo_meses:'',
                num_duracao_anos:'',
                num_cvm:'',
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
                this.num_emissao = this.dados.num_emissao;
                this.num_serie_emissao = this.dados.num_serie_emissao;
                this.txt_observacao_serie = this.dados.txt_observacao_serie;
                if(this.dados.bln_serie_unica){
                    this.bln_serie_unica = 1;
                }else{
                    this.bln_serie_unica = 0;
                }
                    
                this.vlr_emissao = this.dados.vlr_emissao;
                this.dsc_valor = this.dados.dsc_valor;
                this.vlr_captado = this.dados.vlr_captado;
                this.vlr_unitario = this.dados.vlr_unitario;
                this.dte_vencimento = this.dados.dte_vencimento;
                this.txt_taxa = this.dados.txt_taxa;
                this.num_prazo_meses = this.dados.num_prazo_meses;
                this.num_duracao_anos = this.dados.num_duracao_anos;
                this.num_cvm = this.dados.num_cvm;
            }

        
            
        }
            

        
    }
</script>
