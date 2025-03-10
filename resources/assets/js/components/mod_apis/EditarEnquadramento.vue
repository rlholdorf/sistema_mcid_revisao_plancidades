<template>
    <div class="form-group">
        <div class="row">
            <div class="column col-xs-12 col-md-3">
                <label for="txt_situacao_analise" class="control-label">Status Análise - DFIN</label>                        
                    <select 
                        id="situacao_analise"
                        class="form-select br-select" 
                        name="situacao_analise"                   
                        v-model="situacao_analise">
                        <option value="">Escolha um status:</option>
                        <option v-for="situacao_analise in situacao_analises" v-text="situacao_analise.txt_situacao_analise" :value="situacao_analise.id" :key="situacao_analise.id"></option>
                    </select>                                  
                
            </div>
            <div class="column col-xs-12 col-md-3">
                <label for="dte_enquadranento_dfin" class="control-label">Data de Enquadramento - DFIN</label>
                <input id="dte_enquadranento_dfin" type="date" 
                    class="form-control text-center" name="dte_enquadranento_dfin" v-model="dte_enquadranento_dfin" >
            </div>
            <div class="column col-xs-12 col-md-3">
                <label for="dte_emissao_enquadramento_sns" class="control-label">Data Emissão - SNS</label>
                <input id="dte_emissao_enquadramento_sns" type="date" 
                    class="form-control text-center" name="dte_emissao_enquadramento_sns" v-model="dte_emissao_enquadramento_sns">
            </div>
            <div class="column col-xs-12 col-md-3">
                <label for="situacao_enquadramento">Situação Enquadramento</label>           
                <select 
                    id="situacao_enquadramento"
                    class="form-select br-select" 
                    name="situacao_enquadramento"                   
                    v-model="situacao_enquadramento">
                    <option value="">Escolha uma situação:</option>
                    <option v-for="situacao_enquadramento in situacao_enquadramentos" v-text="situacao_enquadramento.txt_situacao_enquadramento" :value="situacao_enquadramento.id" :key="situacao_enquadramento.id"></option>
                </select>                                  
            </div> 
        </div>

        <div class="br-textarea">
            <label for="txt_motivo_nao_enquadramento" class="control-label">Motivo não enquadramento</label>
            <textarea class="form-control" 
            id="txt_motivo_nao_enquadramento" 
            name="txt_motivo_nao_enquadramento"  
            v-model="txt_motivo_nao_enquadramento"
            ></textarea>
        </div>
        <div class="row">
            <div class="column col-xs-12 col-md-4">
                <label for="situacao_conjur">Situação Conjur</label>           
                <select 
                    id="situacao_conjur"
                    class="form-select br-select" 
                    name="situacao_conjur"                   
                    v-model="situacao_conjur">
                    <option value="">Escolha uma situação:</option>
                    <option v-for="situacao_conjur in situacao_conjurs" v-text="situacao_conjur.txt_situacao_conjur" :value="situacao_conjur.id" :key="situacao_conjur.id"></option>
                </select>                                  
            </div> 
            <div class="column col-xs-12 col-md-4">
                <label for="dte_aprovacao_conjur" class="control-label">Data aprovação CONJUR</label>
                <input id="dte_aprovacao_conjur" type="date" 
                    class="form-control text-center" name="dte_aprovacao_conjur" v-model="dte_aprovacao_conjur"  >
            </div>
            <div class="column col-xs-12 col-md-4">
                <label for="situacao_enquadramento">Situação Enquadramento</label>           
                <select 
                    id="situacao_enquadramento"
                    class="form-select br-select" 
                    name="situacao_enquadramento"                   
                    v-model="situacao_enquadramento">
                    <option value="">Escolha um status:</option>
                    <option v-for="situacao_enquadramento in situacao_enquadramentos" v-text="situacao_enquadramento.txt_situacao_enquadramento" :value="situacao_enquadramento.id" :key="situacao_enquadramento.id"></option>
                </select>                                  
            </div> 
        </div>
        <div class="row">
            <div class="column col-xs-12 col-md-4">
                <label for="situacao_envio_publicacao">Situação Envio Publicação</label>           
                <select 
                    id="situacao_envio_publicacao"
                    class="form-select br-select" 
                    name="situacao_envio_publicacao"                   
                    v-model="situacao_envio_publicacao">
                    <option value="">Escolha uma situação:</option>
                    <option v-for="situacao_envio_publicacao in situacao_envio_publicacoes" v-text="situacao_envio_publicacao.txt_situacao_envio_publicacao_sns" :value="situacao_envio_publicacao.id" :key="situacao_envio_publicacao.id"></option>
                </select>                                  
            </div> 
            <div class="column col-xs-12 col-md-4">
                <label for="situacao_publicacao">Situação Publicação Portaria</label>           
                <select 
                    id="situacao_publicacao"
                    class="form-select br-select" 
                    name="situacao_publicacao"                   
                    v-model="situacao_publicacao">
                    <option value="">Escolha uma situação:</option>
                    <option v-for="situacao_publicacao in situacao_publicacoes" v-text="situacao_publicacao.txt_situacao_publicacao_portaria" :value="situacao_publicacao.id" :key="situacao_publicacao.id"></option>
                </select>                                  
            </div>  
            <div class="column col-xs-12 col-md-4">
                <label for="dte_publicacao_portaria" class="control-label">Data Publicação</label>
                <input id="dte_publicacao_portaria" type="date" 
                    class="form-control text-center" name="dte_publicacao_portaria" v-model="dte_enquadranento_dfin">
            </div>
            <div class="column col-xs-12 col-md-4">
                <label for="txt_portaria_aprovacao" class="control-label">Portaria de Aprovação</label>
                <input id="txt_portaria_aprovacao" type="text" 
                    class="form-control text-center" name="txt_portaria_aprovacao" v-model="txt_portaria_aprovacao">
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props:['url','dados'],
        data(){
            return{
                
                situacao_analises:'',
                situacao_analise:'',

                dte_enquadranento_dfin:'',
                dte_emissao_enquadramento_sns:'',

                situacao_enquadramentos:'',
                situacao_enquadramento:'',
                txt_motivo_nao_enquadramento:'',
                situacao_conjurs:'',
                situacao_conjur:'',
                dte_aprovacao_conjur:'',

                situacao_enquadramentos:'',
                situacao_enquadramento:'',
                situacao_envio_publicacoes:'',
                situacao_envio_publicacao:'',

                situacao_publicacoes:'',
                situacao_publicacao:'',
                dte_enquadranento_dfin:'',
                txt_portaria_aprovacao:'',
                
            }
        },
        methods:{           
           
        } ,
        mounted() {


            axios.get(this.url + '/api/apis/situacao_analises').then(resposta => {
                //console.log(resposta.data);
                this.situacao_analises = resposta.data;

            }).catch(erro => {
                console.log(erro);
            })

            axios.get(this.url + '/api/apis/situacao_enquadramento').then(resposta => {
                //console.log(resposta.data);
                this.situacao_enquadramentos = resposta.data;
            }).catch(erro => {
                console.log(erro);
            })

            axios.get(this.url + '/api/apis/situacao_conjur').then(resposta => {
                //console.log(resposta.data);
                this.situacao_conjurs = resposta.data;
            }).catch(erro => {
                console.log(erro);
            })

            axios.get(this.url + '/api/apis/situacao_enquadramentos').then(resposta => {
                //console.log(resposta.data);
                this.situacao_enquadramentos = resposta.data;
            }).catch(erro => {
                console.log(erro);
            })

            axios.get(this.url + '/api/apis/situacao_envio_publicacao').then(resposta => {
                //console.log(resposta.data);
                this.situacao_envio_publicacoes = resposta.data;
            }).catch(erro => {
                console.log(erro);
            })

            axios.get(this.url + '/api/apis/situacao_publicacao').then(resposta => {
                //console.log(resposta.data);
                this.situacao_publicacoes = resposta.data;
            }).catch(erro => {
                console.log(erro);
            })





            //console.log(this.form._token);
            axios.get(this.url + '/api/apis/modalidade_projetos').then(resposta => {
                //console.log(resposta.data);
                this.modalidade_projetos = resposta.data;
            }).catch(erro => {
                console.log(erro);
            })

           

            axios.get(this.url + '/api/apis/situacao_emissao').then(resposta => {
                //console.log(resposta.data);
                this.situacao_emissoes = resposta.data;
            }).catch(erro => {
                console.log(erro);
            })

           

           

           

           

           

            axios.get(this.url + '/api/apis/situacao_execucao').then(resposta => {
                //console.log(resposta.data);
                this.status_execucoes = resposta.data;
            }).catch(erro => {
                console.log(erro);
            })
            

           if(this.dados){

                if (this.dados.situacao_analise_id === null) {
                    this.situacao_analise = '';
                }else{
                    this.situacao_analise = this.dados.situacao_analise_id;
                } 

                this.dte_enquadranento_dfin = this.dados.dte_enquadranento_dfin;
                this.dte_emissao_enquadramento_sns = this.dados.dte_emissao_enquadramento_sns;

                if (this.dados.situacao_enquadramento_id === null) {
                    this.situacao_enquadramento  = '';
                }else{
                    this.situacao_enquadramento = this.dados.situacao_enquadramento_id;
                }                

                this.txt_motivo_nao_enquadramento = this.dados.txt_motivo_nao_enquadramento;

                if (this.dados.situacao_conjur_id === null) {
                    this.situacao_conjur  = '';
                }else{
                    this.situacao_conjur = this.dados.situacao_conjur_id;
                } 
                
                this.dte_aprovacao_conjur = this.dados.dte_aprovacao_conjur;

                if (this.dados.situacao_enquadramento_id === null) {
                    this.situacao_enquadramento  = '';
                }else{
                    this.situacao_enquadramento = this.dados.situacao_enquadramento_id;
                } 
               
                if (this.dados.situacao_envio_publicacao_id === null) {
                    this.situacao_envio_publicacao  = '';
                }else{
                    this.situacao_envio_publicacao = this.dados.situacao_envio_publicacao_id;
                } 

                if (this.dados.situacao_publicacao_portaria_id === null) {
                    this.situacao_publicacao  = '';
                }else{
                    this.situacao_publicacao = this.dados.situacao_publicacao_portaria_id;
                } 
                
                this.txt_situacao_publicacao_portaria = this.dados.txt_situacao_publicacao_portaria;
                this.dte_enquadranento_dfin = this.dados.dte_enquadranento_dfin;
                this.txt_portaria_aprovacao = this.dados.txt_portaria_aprovacao;
           }

        
            
        }
            

        
    }
</script>
