<template>
    <div class="form-group">  
        <div class="row">
            <div class="col col-xs-12 col-sm-12 br-textarea">
                <label >1. Objeto da Intervenção<span class="text-obrigatorio"></span></label>
                
                <textarea class="input-medium" 
                        id="dsc_obj_intervencao" 
                        name="dsc_obj_intervencao"  
                        type="text"
                        rows="5"                         
                        v-model="dsc_obj_intervencao"
                        disabled    
                            >
                </textarea>
               
            </div>    
        </div><!-- div row -->

        <span class="br-divider my-3"></span>

        <div class="row">
            <div class="col col-xs-12 col-sm-12 br-input input-highlight">     
                <label >2. Itens financiáveis das ações orçamentárias do programa cadastrados na proposta :</label>
            </div>    
            
        </div><!-- div row -->
        <div class="br-list" role="list">
            
                <div class="br-item" role="listitem" v-for="item in itens">
                    <div class="row align-items-center">
                       
                        <div class="col">
                            <li>{{item.acao}} - {{item.txt_acao_programa}} / {{item.txt_item_financiavel}}  </li>
                        </div>
                    
                    </div>
                </div>                
            
          </div>
          <span class="br-divider my-3"></span>

        <div class="row">
            <div class="col col-xs-12 col-sm-4 br-input">
                <label >3. Valor Repasse</label>
                <input id="vlr_repasse" 
                   type="text"
                    name="vlr_repasse"    
                    v-model="vlr_repasse" 
                    required                                     >
                  
            </div>
            <div class="col col-xs-12 col-sm-4 br-input">
                <label >4. Valor Tarifa</label>
                <input id="vlr_tarifa" 
                   type="text"
                    name="vlr_tarifa"    
                    v-model="vlr_tarifa" 
                    required                                     >
                  
            </div>
            <div class="col col-xs-12 col-sm-4 br-input">
                <label >5. Valor Transferegov</label>
                <input id="vlr_final_transferegov" 
                    type="text"
                    name="vlr_final_transferegov"    
                    v-model="vlr_final_transferegov" 
                    required                                     >
                 
            </div>
            
        </div><!-- div row -->

        <span class="br-divider my-3"></span>

        <div class="row">
            <div class="column col-xs-12 col-md-12">
                <label for="uf">6. Ação Selecionada</label>           
                <select 
                    id="acao"
                    class="form-select br-select" 
                    name="acao"                
                    v-model="acao">
                    <option value="">Escolha uma acao:</option>
                    <option v-for="acao in acoes" v-text="acao.acao + ' - ' + acao.txt_acao_programa" :value="acao.acao" :key="acao.acao"></option>
                </select>                                  
            </div>        
        </div>
                
        <span class="br-divider my-3"></span>



        <div class="p-3 text-right">
            <button class="br-button primary mr-3" name="Salvar" v-on:click="checkForm" v-if="this.blnbotao">Salvar
            </button>
            <button class="br-button danger mr-3" type="button" onclick="javascript:window.history.go(-1)">Cancelar
            </button>
            <slot>
                
            </slot>

        </div>

        

        

</div>
</template>

<script>
    export default {
        props:['url','itens','proposta','acoes','blnbotao'],
        data(){
            return{
                
                acao:'',
                dsc_obj_intervencao:'',
                vlr_intervencao:0,
                vlr_repasse:0,
                vlr_tarifa:0,
                vlr_final_transferegov:0,
                
                
            }        
        },
        methods:{
            checkForm: function () {


                

                
            },
            formatarValor(valor,casas) {
                if (valor) {
                    let val = (valor/1).toFixed(casas).replace('.', ',')
                    return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
                } else {
                    return '0.00';
                }
            },
           
        },
        computed: {
                
        },
        mounted() {

          

            if(this.proposta){

                
                this.dsc_obj_intervencao = this.proposta.dsc_obj_intervencao;
                
                
                if((this.proposta.vlr_intervencao > 238850) && (this.proposta.vlr_intervencao < 750000)){
                    this.vlr_tarifa = Number((this.proposta.vlr_intervencao* 0.031999999) + 3500);
                }else  if((this.proposta.vlr_intervencao >= 750000) && (this.proposta.vlr_intervencao < 1500000)){
                    this.vlr_tarifa = Number((this.proposta.vlr_intervencao* 0.037999996) + 3500);
                }

                this.vlr_repasse = this.formatarValor(Number(this.proposta.vlr_intervencao),2);
                this.vlr_final_transferegov = this.formatarValor(Number(this.proposta.vlr_intervencao - this.vlr_tarifa),2);
                this.vlr_tarifa = this.formatarValor(Number(this.vlr_tarifa),2);


                
            }

            
           
        }
    }
</script>
