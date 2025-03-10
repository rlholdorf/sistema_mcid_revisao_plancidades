<template>
    <div class="form-group">
        <!--
        <div class="row">
            
            <div class="column col-xs-12 col-md-3">
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
          
                      
        </div>
          -->
        <div class="row"  >    
            <div class="column col-xs-12 col-md-3">
                <label for="modalidade_projeto">Modalidade de Projeto</label>           
                <select 
                    id="modalidade_projeto"
                    class="form-select br-select" 
                    name="modalidade_projeto"                   
                    v-model="modalidade_projeto">
                    <option value="">Escolha uma modalidade projeto:</option>
                    <option v-for="modalidade_projeto in modalidade_projetos" v-text="modalidade_projeto.txt_modalidade_projeto" :value="modalidade_projeto.id" :key="modalidade_projeto.id"></option>
                </select>                                  
            </div>  
            <div class="column col-xs-12 col-md-3">
                <label for="situacao_analise">Situação Análise</label>           
                <select 
                    id="situacao_analise"
                    class="form-select br-select" 
                    name="situacao_analise"                   
                    v-model="situacao_analise">
                    <option value="">Escolha uma situação:</option>
                    <option v-for="situacao_analise in situacao_analises" v-text="situacao_analise.txt_situacao_analise" :value="situacao_analise.id" :key="situacao_analise.id"></option>
                </select>                                  
            </div> 
            <div class="column col-xs-12 col-md-3">
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
        
        <div class="row">            
            <div class="column col-xs-12 col-md-3">
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
           
            <div class="column col-xs-12 col-md-3">
                <label for="situacao_emissao">Situação Emissão</label>           
                <select 
                    id="situacao_emissao"
                    class="form-select br-select" 
                    name="situacao_emissao"                   
                    v-model="situacao_emissao">
                    <option value="">Escolha uma situação:</option>
                    <option v-for="situacao_emissao in situacao_emissoes" v-text="situacao_emissao.txt_situacao_emissao" :value="situacao_emissao.id" :key="situacao_emissao.id"></option>
                </select>                                  
            </div>   
           
            <div class="column col-xs-12 col-md-3">
                <label for="situacao_execucao">Situação  Execução</label>           
                <select 
                    id="situacao_execucao"
                    class="form-select br-select" 
                    name="situacao_execucao"                   
                    v-model="situacao_execucao">
                    <option value="">Escolha um situacao:</option>
                    <option v-for="situacao_execucao in situacao_execucoes" v-text="situacao_execucao.txt_situacao_execucao" :value="situacao_execucao.id" :key="situacao_execucao.id"></option>
                </select>                                  
            </div> 
           
        </div>
        
    </div>
</template>

<script>
    export default {
        props:['url'],
        data(){
            return{
                estados:'',
                estado:'',
                modalidade_projetos:'',
                modalidade_projeto:'',
                situacao_conjurs:'',
                situacao_conjur:'',
                situacao_emissoes:'',
                situacao_emissao:'',               
                situacao_envio_publicacoes:'',
                situacao_envio_publicacao:'',
                situacao_publicacoes:'',
                situacao_publicacao:'',
                situacao_enquadramentos:'',
                situacao_enquadramento:'',
                situacao_analises:'',
                situacao_analise:'',
                situacao_execucoes:'',
                situacao_execucao:'',
            }
        },
        methods:{           
           onChangeEstado() {
               this.textoEscolhaMunicipio = "Buscando...";
               this.municipio = '';
               this.buscando = true;
               if(this.estado != '') {
                   //busca dados no banco de dados para carregar no componente
                   axios.get(this.url + '/api/municipios/' + this.estado).then(resposta => {
                       this.textoEscolhaMunicipio = "Escolha um municipio:";
                       this.buscando = false;
                       this.municipios = resposta.data;
                       console.log(this.municipios);
                   }).catch(error => {
                       console.log(error);
                   });
                 
               } else {
                   this.buscando = false;
                   this.municipio = '';
                   this.textoEscolhaMunicipio = "Filtre o Estado"
               }            
           }
        } ,
        mounted() {
            //console.log(this.form._token);
            axios.get(this.url + '/api/apis/modalidade_projetos').then(resposta => {
                //console.log(resposta.data);
                this.modalidade_projetos = resposta.data;
                this.modalidade_projeto = '';
                        
            }).catch(erro => {
                console.log(erro);
            })

            axios.get(this.url + '/api/apis/situacao_conjur').then(resposta => {
                //console.log(resposta.data);
                this.situacao_conjurs = resposta.data;
                this.situacao_conjur = '';
                        
            }).catch(erro => {
                console.log(erro);
            })

            axios.get(this.url + '/api/apis/situacao_emissao').then(resposta => {
                //console.log(resposta.data);
                this.situacao_emissoes = resposta.data;
                this.situacao_emissao = '';
                        
            }).catch(erro => {
                console.log(erro);
            })

            axios.get(this.url + '/api/apis/situacao_enquadramento').then(resposta => {
                //console.log(resposta.data);
                this.situacao_enquadramentos = resposta.data;
                this.situacao_enquadramento = '';
                        
            }).catch(erro => {
                console.log(erro);
            })

            axios.get(this.url + '/api/apis/situacao_envio_publicacao').then(resposta => {
                //console.log(resposta.data);
                this.situacao_envio_publicacoes = resposta.data;
                this.situacao_envio_publicacao = '';
                        
            }).catch(erro => {
                console.log(erro);
            })

            axios.get(this.url + '/api/apis/situacao_publicacao').then(resposta => {
                //console.log(resposta.data);
                this.situacao_publicacoes = resposta.data;
                this.situacao_publicacao = '';
                        
            }).catch(erro => {
                console.log(erro);
            })

            axios.get(this.url + '/api/apis/situacao_analises').then(resposta => {
                //console.log(resposta.data);
                this.situacao_analises = resposta.data;
                this.situacao_analise = '';
                        
            }).catch(erro => {
                console.log(erro);
            })

          
            axios.get(this.url + '/api/apis/situacao_execucao').then(resposta => {
                //console.log(resposta.data);
                this.situacao_execucoes = resposta.data;
                this.situacao_execucao = '';
                        
            }).catch(erro => {
                console.log(erro);
            })
        
            
        }
            

        
    }
</script>
