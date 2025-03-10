<template>
    <div class="form-group">
        <div class="row">            
            <div class="col col-xs-12 col-sm-3 br-input">
                <label >Nº Emenda</label>
                <input id="num_emenda" 
                    type="text" 
                    name="num_emenda"                       
                    v-model="num_emenda" 
                    :required="blnindicacao == 'false'"
                    :disabled="blnindicacao == 'true'"
                    >                   
            </div>
            <div class="col col-xs-12 col-sm-3 br-input">
                <label >Beneficiário</label>
                <input id="txt_beneficiario" 
                    type="text" 
                    name="txt_beneficiario"                       
                    v-model="txt_beneficiario" 
                    :required="blnindicacao == 'false'"
                    :disabled="blnindicacao == 'true'">                   
            </div>  
            <div class="col col-xs-12 col-sm-3 br-input">
                <label >UF</label>
                <input id="txt_uf" 
                    type="text" 
                    name="txt_uf"                       
                    v-model="txt_uf" 
                    :required="blnindicacao == 'false'"
                    :disabled="blnindicacao == 'true'">                   
            </div>   
            <div class="col col-xs-12 col-sm-3 br-input">
                <label >CNPJ</label>
                <input id="txt_cnpj" 
                    type="text" 
                    name="txt_cnpj"                       
                    v-model="txt_cnpj" 
                    :required="blnindicacao == 'false'"
                    :disabled="blnindicacao == 'true'">                   
            </div>            
        </div>  
        <div class="row">            
            <div class="col col-xs-12 col-sm-2 br-input">
                <label >Modalidade</label>
                <input id="cod_modalidade" 
                    type="text" 
                    name="cod_modalidade"                       
                    v-model="cod_modalidade" 
                    :required="blnindicacao == 'false'"
                    :disabled="blnindicacao == 'true'">                   
            </div>
            <div class="col col-xs-12 col-sm-3 br-input">
                <label >Funcional Programática</label>
                <input id="txt_funcional_programatica" 
                    type="text" 
                    name="txt_funcional_programatica"                       
                    v-model="txt_funcional_programatica"
                    :required="blnindicacao == 'false'"
                    :disabled="blnindicacao == 'true'" >                   
            </div>  
            <div class="col col-xs-12 col-sm-2 br-input">
                <label >Ação</label>
                <input id="txt_acao" 
                    type="text" 
                    name="txt_acao"                       
                    v-model="txt_acao" 
                    :required="blnindicacao == 'false'"
                    :disabled="blnindicacao == 'true'">                   
            </div>   
            <div class="col col-xs-12 col-sm-2 br-input">
                <label >Nº GND</label>
                <input id="nun_gnd" 
                    type="text" 
                    name="nun_gnd"                       
                    v-model="nun_gnd" 
                    :required="blnindicacao == 'false'"
                    :disabled="blnindicacao == 'true'">                   
            </div>  
            <div class="col col-xs-12 col-sm-3 br-input">
                <label >Valor Emenda</label>
                <input id="vlr_emenda" 
                    type="text" 
                    name="vlr_emenda"                       
                    v-model="vlr_emenda"
                    :required="blnindicacao == 'false'"
                    :disabled="blnindicacao == 'true'" >                   
            </div>           
        </div>
        <div class="row" v-if="blnindicacao == 'true'">
            <div class="col col-xs-12 col-sm-4 br-input">
                <label >Nº Indicação Congresso</label>
                <input id="id_indicacao_congresso" 
                    type="text" 
                    name="id_indicacao_congresso"                       
                    v-model="id_indicacao_congresso"
                    :required="blnindicacao == 'true'"
                    :disabled="blnindicacao == 'false'" >                   
            </div> 
        </div>
        <div class="row" v-if="blnindicacao == 'false'">
            <div class="column col-xs-12">                
                <label for="motivo_correcao">Motivo Correção</label>           
                <select 
                    id="motivo_correcao"
                    class="form-select br-select" 
                    name="motivo_correcao"     
                    v-model="motivo_correcao"
                    :required="blnindicacao == 'false'"
                    :disabled="blnindicacao == 'true'">
                    <option value="">Escolha um motivo:</option>
                    <option v-for="item in motivos_correcoes" v-text="item.txt_motivo_correcao" :value="item.id" :key="item.id"></option>
                </select>                                                      
            </div>
        </div>  
        <div class="p-3 text-right">
            <button class="br-button primary mr-3" type="submit" :disabled="motivo_correcao == '' && blnindicacao == 'false'">Salvar
            </button>
            <button class="br-button danger mr-3" type="button" onclick="javascript:window.history.go(-1)">Voltar
            </button>
        </div>    
    </div>
</template>

<script>
    export default {
        props:['url','dados','blnindicacao'],
        data(){
            return{
                num_emenda:'',
                txt_beneficiario:'',
                txt_uf:'',
                txt_cnpj:'',
                cod_modalidade:'',
                txt_funcional_programatica:'',
                txt_acao:'',
                nun_gnd:'',
                vlr_emenda:'',
                motivos_correcoes:'',
                motivo_correcao:'',
                id_indicacao_congresso:'',
            }
        },
        methods:{  
            
            
        } ,
        mounted() {           
            
            axios.get(this.url + '/api/motivoCorrecao').then(resposta => {
                //console.log(resposta.data);
                this.motivos_correcoes = resposta.data;
                }).catch(erro => {
                    console.log(erro);
                })

            if(this.dados){
                this.num_emenda = this.dados.num_emenda;
                this.txt_beneficiario = this.dados.txt_beneficiario;
                this.txt_uf = this.dados.txt_uf;
                this.txt_cnpj = this.dados.txt_cnpj;
                this.cod_modalidade = this.dados.cod_modalidade;
                this.txt_acao = this.dados.txt_acao;
                this.txt_funcional_programatica = this.dados.txt_funcional_programatica;
                this.nun_gnd = this.dados.nun_gnd;
                this.vlr_emenda = this.dados.vlr_emenda;
                
                if(!this.dados.motivo_correcao_id){
                    this.motivo_correcao = '';
                }else{
                    this.motivo_correcao = this.dados.motivo_correcao_id;
                    console.log(this.dados.motivo_correcao_id);
                }
                this.id_indicacao_congresso = this.dados.id_indicacao_congresso;
                
                
            }


                
        }
    }
</script>
