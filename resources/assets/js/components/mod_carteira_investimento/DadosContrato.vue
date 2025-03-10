<template>
    <div>  
        <div class="card">        
            <div class="card-body">
                <div class="form-group">
                    <div class="titulo">
                        <h5>Dados Principais</h5> 
                    </div>
                    <div class="row">
                        <div class="col col-xs-12 col-sm-2 br-input">        
                            <label for="input-default">UF</label>
                            <input id="uf" name="uf" type="text" v-model="uf" disabled="disabled"/>                
                        </div>  
                        <div class="col col-xs-12 col-sm-4 br-input">        
                            <label for="input-default">Município</label>
                            <input id="municipio" name="nubicipio" type="text" v-model="municipio" disabled="disabled"/>
                        </div>
                        <div class="col col-xs-12 col-sm-3 br-input">        
                            <label for="input-default">Código do Saci</label>
                            <input id="cod_saci" name="cod_saci" type="text" v-model="cod_saci" disabled="disabled"/>
                        </div>
                        <div class="col col-xs-12 col-sm-3 br-input">        
                            <label for="input-default">Data de Assinatura</label>
                            <input id="dte_assinatura_contrato" name="dte_assinatura_contrato" type="date" v-model="dte_assinatura_contrato" disabled="disabled"/>
                        </div>
                    </div><!-- row -->
                    <div class="row">
                        <div class="col col-xs-12 col-sm-4 br-input">        
                            <label for="input-default">Valor Investimento</label>
                            <input id="vlr_investimento" name="vlr_investimento" type="text" v-model="vlr_investimento" disabled="disabled"/>                
                        </div>  
                        <div class="col col-xs-12 col-sm-4 br-input">        
                            <label for="input-default">Valor Repasse</label>
                            <input id="vlr_repasse" name="vlr_repasse" type="text" v-model="vlr_repasse" disabled="disabled"/>
                        </div>
                        <div class="col col-xs-12 col-sm-4 br-input">        
                            <label for="input-default">Valor Contrapartida</label>
                            <input id="vlr_contrapartida" name="vlr_contrapartida" type="text" v-model="vlr_contrapartida" disabled="disabled"/>
                        </div>
                    </div><!-- row -->
                </div>
            </div>
            <br/>
            <span class="br-divider my-3"></span>
            <div class="card">        
                <div class="card-body">
                    <div class="titulo">
                        <h5>Dados Principais</h5> 
                    </div>
                    <div class="row">
                        <div class="col col-xs-12 col-sm-3 br-input">        
                            <label for="input-default">Data Início Previsto</label>
                            <input id="dte_inicio_obra" name="dte_inicio_obra" type="date" v-model="dte_inicio_obra" disabled="disabled"/>                
                        </div>  
                        <div class="col col-xs-12 col-sm-3 br-input">        
                            <label for="input-default">Data Início Efetiva</label>
                            <input id="dte_inicio_obra_efetiva" name="dte_inicio_obra_efetiva" type="date" v-model="dte_inicio_obra_efetiva" disabled="disabled"/>
                        </div>
                        <div class="col col-xs-12 col-sm-3 br-input">        
                            <label for="input-default">Data Fim Previsto</label>
                            <input id="dte_fim_obra" name="dte_fim_obra" type="date" v-model="dte_fim_obra" disabled="disabled"/>                
                        </div>  
                        <div class="col col-xs-12 col-sm-3 br-input">        
                            <label for="input-default">Data Fim Efetiva</label>
                            <input id="dte_fim_obra" name="dte_fim_obra" type="date" v-model="dte_fim_obra" disabled="disabled"/>
                        </div>
                    </div><!-- row -->
                    <div class="row">
                        <div class="col col-xs-12 col-sm-4 br-input">        
                            <label for="input-default">Valor Investimento</label>
                            <input id="vlr_investimento" name="vlr_investimento" type="text" v-model="vlr_investimento" disabled="disabled"/>                
                        </div>  
                        <div class="col col-xs-12 col-sm-4 br-input">        
                            <label for="input-default">Valor Repasse</label>
                            <input id="vlr_repasse" name="vlr_repasse" type="text" v-model="vlr_repasse" disabled="disabled"/>
                        </div>
                        <div class="col col-xs-12 col-sm-4 br-input">        
                            <label for="input-default">Valor Contrapartida</label>
                            <input id="vlr_contrapartida" name="vlr_contrapartida" type="text" v-model="vlr_contrapartida" disabled="disabled"/>
                        </div>
                    </div><!-- row -->
                    <div class="row">
                        <div class="col col-xs-12 col-sm-3 br-input">        
                            <label for="input-default">Valor Pago</label>
                            <input id="vlr_pago_conta" name="vlr_pago_conta" type="text" v-model="vlr_pago_conta" disabled="disabled"/>                
                        </div>  
                        <div class="col col-xs-12 col-sm-3 br-input">        
                            <label for="input-default">Valor a Pagar</label>
                            <input id="vlr_restos_a_pagar" name="vlr_restos_a_pagar" type="text" v-model="vlr_restos_a_pagar" disabled="disabled"/>
                        </div>
                        <div class="col col-xs-12 col-sm-3 br-input">        
                            <label for="input-default">Percentual de Desembolso</label>
                            <input id="prc_desembolsado" name="prc_desembolsado" type="text" v-model="prc_desembolsado" disabled="disabled"/>
                        </div>
                        <div class="col col-xs-12 col-sm-3 br-input">        
                            <label for="input-default">Data da Última Liberaçäo</label>
                            <input id="dte_ult_mov_fin" name="dte_ult_mov_fin" type="date" v-model="dte_ult_mov_fin" disabled="disabled"/>
                        </div>
                    </div><!-- row -->
                </div>
            </div>
        </div>

        
    </div>
</template>

<script>
    export default {        
        props:['url','dados'],
        data(){
            return{
                uf:'',
                municipio:'',
                cod_contrato:'',
                cod_saci:'',
                dte_assinatura_contrato:'',
                vlr_investimento:0,
                vlr_repasse:0,
                vlr_contrapartida:0,
                dte_inicio_obra:'',
                dte_inicio_obra_efetiva:'',
                dte_fim_obra:'',
                dte_fim_obra:'',
                vlr_pago_conta:0,
                vlr_restos_a_pagar:0,
                prc_desembolsado:0,
                dte_ult_mov_fin:''

            }                },
        computed:{
            
        },
        methods:{
            formatarData(data) {
                if (data) {   
                    const novaData = data.toLocaleDateString('pt-BR');
                    return novaData;
                } else {
                    return '';
                }
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
        mounted() {
           
            if(this.dados){

                this.uf = this.dados.txt_uf;
                this.municipio = this.dados.txt_municipio;
                this.cod_contrato = this.dados.cod_contrato;
                this.cod_saci = this.dados.cod_saci;
                this.dte_assinatura_contrato = this.dados.dte_assinatura_contrato;
                this.vlr_investimento = this.formatarValor(Number(this.dados.vlr_investimento),2);
                this.vlr_repasse = this.formatarValor(Number(this.dados.vlr_repasse),2);
                this.vlr_contrapartida = this.formatarValor(Number(this.dados.vlr_contrapartida),2);
                this.dte_inicio_obra = this.dados.dte_inicio_obra;
                this.dte_inicio_obra_efetiva = this.dados.dte_inicio_obra_efetiva;
                this.dte_fim_obra = this.dados.dte_fim_obra;
                this.dte_fim_obra = this.dados.dte_fim_obra;

                this.vlr_pago_conta = this.formatarValor(Number(this.dados.vlr_pago_conta),2);
                this.vlr_restos_a_pagar = this.formatarValor(Number(this.dados.vlr_restos_a_pagar),2);
                this.prc_desembolsado = this.formatarValor(Number((this.dados.vlr_pago_conta/this.dados.vlr_repasse)*100),2);
                this.dte_ult_mov_fin = this.dados.dte_ult_mov_fin;


              
            }
          
        }
    }
</script>
