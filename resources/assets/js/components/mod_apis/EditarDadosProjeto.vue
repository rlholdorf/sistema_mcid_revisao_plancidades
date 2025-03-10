<template>
    <div class="form-group">
        <div class="form-group row">
                        
            <div class="col-md-4 text-center">
                <label for="dte_cadastramento" class="control-label">Data de Cadastramento</label>
                <input id="dte_cadastramento" type="date" 
                    class="form-control text-center" name="dte_cadastramento" v-model="dte_cadastramento" disabled>
            </div>
            <div class="col-md-4 offset-md-4 text-center">
                <label for="dte_validade_pgfn" class="control-label">Validade PGFN</label>
                <input id="dte_validade_pgfn" type="date" 
                    class="form-control text-center" name="dte_validade_pgfn" v-model="dte_validade_pgfn"  disabled>
            </div>
        </div>
        <div class="form-group br-textarea ">
            <label for="dsc_projeto_investimento" class="control-label">Projeto de Investimento</label>
            <textarea class="form-control" 
               id="dsc_projeto_investimento" 
               name="dsc_projeto_investimento" 
               v-model="dsc_projeto_investimento" 
               ></textarea>
       </div>

       <div class="form-group">
            <div class="row">
                <div class="col col-xs-12 col-sm-4 br-input">
                    <label for="vlr_investimento_projeto" class="control-label">Investimento Projeto</label>
                    <input id="vlr_investimento_projeto" type="number" step=".01" 
                        class="form-control" name="vlr_investimento_projeto" v-model="vlr_investimento_projeto" disabled>
                </div>
                <div class="col col-xs-12 col-sm-4 br-input">
                    <label for="vlr_debentures" class="control-label">Debentures</label>
                    <input id="vlr_debentures" type="number" step=".01" 
                        class="form-control" name="vlr_debentures" v-model="vlr_debentures">
                </div>
                <div class="col col-xs-12 col-sm-4 br-input">
                    <label for="vlr_fdic" class="control-label">FDIC</label>
                    <input id="vlr_fdic" type="number" step=".01" 
                        class="form-control" name="vlr_fdic" v-model="vlr_fdic">
                </div>
            </div>
            <div class="row">
                <div class="col col-xs-12 col-sm-4 br-input">
                    <label for="vlr_cri" class="control-label">CRI</label>
                    <input id="vlr_cri" type="number" step=".01" 
                        class="form-control" name="vlr_cri" v-model="vlr_cri">
                </div>
                <div class="col col-xs-12 col-sm-4 br-input">
                    <label for="vlr_recursos_proprios" class="control-label">Recursos Próprios</label>
                    <input id="vlr_recursos_proprios" type="number" step=".01" 
                        class="form-control" name="vlr_recursos_proprios" v-model="vlr_recursos_proprios">
                </div>
                <div class="col col-xs-12 col-sm-4 br-input">
                    <label for="vlr_outras_fontes" class="control-label">Outras Fontes</label>
                    <input id="vlr_outras_fontes" type="number" step=".01" 
                        class="form-control" name="vlr_outras_fontes" v-model="vlr_outras_fontes">
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
                
                dte_cadastramento:'',
                dte_validade_pgfn:'',
                dsc_projeto_investimento:'',
                vlr_investimento_projeto:'',
                vlr_debentures:'',
                vlr_fdic:'',
                vlr_cri:'',
                vlr_recursos_proprios:'',
                vlr_outras_fontes:'',
                
            }
        },
        methods:{           
           
        } ,
        mounted() {
            

           if(this.dados){

            this.dte_cadastramento = this.dados.dte_cadastramento;
            this.dte_validade_pgfn = this.dados.dte_validade_pgfn;
            this.dsc_projeto_investimento = this.dados.dsc_projeto_investimento;
            this.vlr_investimento_projeto = this.dados.vlr_investimento_projeto;
            this.vlr_debentures = this.dados.vlr_debentures;
            this.vlr_fdic = this.dados.vlr_fdic;
            this.vlr_cri = this.dados.vlr_cri;
            this.vlr_recursos_proprios = this.dados.vlr_recursos_proprios;
            this.vlr_outras_fontes = this.dados.vlr_outras_fontes;
           }

        
            
        }
            

        
    }
</script>
