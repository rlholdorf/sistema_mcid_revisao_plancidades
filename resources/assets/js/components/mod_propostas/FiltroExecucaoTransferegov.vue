<template>
   <div class="form-group">  
        
        <div class="row" >        
            <div class="column col-xs-12 col-md-2">
                <label for="uf">UF</label>           
                <select 
                    id="estado"
                    class="form-select br-select" 
                    name="estado"
                @change="onChangeEstado"
                    v-model="estado">
                    <option value="">Escolha um Estado:</option>
                    <option v-for="estado in estados" v-text="estado.txt_sigla_uf" :value="estado.id" :key="estado.id"></option>
                </select>                                  
            </div>        
            <div class="column col-xs-12 col-md-4">
    <!-- municipio -->    
                <label for="municipio">Município</label>                
                <select 
                    id="municipio"
                    class="form-select br-select" 
                    name="municipio"
                    @change="onChangeMunicipio"
                    :disabled="estado == '' || buscando"
                    v-model="municipio">
                    <option value="" v-text="textoEscolhaMunicipio"></option>
                    <option v-for="municipio in municipios" v-text="municipio.ds_municipio" :value="municipio.id" :key="municipio.id"></option>
                </select>    
            </div>
      
            <div class="col col-xs-12 col-sm-6 br-input">
                <label for="entepublico">Ente Público</label>                
                <select 
                    id="entepublico"
                    class="form-select br-select" 
                    name="entepublico"
                    :disabled="municipio == '' || buscando"
                    v-model="entepublico">
                    <option value="" v-text="textoEscolhaEnte"></option>
                    <option v-for="entepublico in entespublicos" v-text="entepublico.id +  ' - ' + entepublico.txt_ente_publico" :value="entepublico.id" :key="entepublico.id"></option>
                </select>  
            </div>                    
        </div>
        <div class="row">
            <div class="column col-xs-12 col-md-4">                
                <label for="acaoPrograma">Ação Programa</label>                
                <select 
                    id="acaoPrograma"
                    class="form-select br-select" 
                    name="acaoPrograma"                    
                    v-model="acaoPrograma">
                    <option value="">Escolha uma Ação</option>
                    <option v-for="item in acaoProgramas" v-text="item.id+ ' - ' + item.txt_acao_programa" :value="item.id" :key="item.id"></option>
                </select>    
            </div>            
            <div class="column col-xs-12 col-md-4">                
                <label for="programaSiconv">Programa Siconv</label>                
                <select 
                    id="programaSiconv"
                    class="form-select br-select" 
                    name="programaSiconv"                    
                    v-model="programaSiconv">
                    <option value="">Escolha um Programa </option>
                    <option v-for="item in programasSiconv" v-text="item.id" :value="item.id" :key="item.id"></option>
                </select>    
            </div>
       
            <div class="column col-xs-12 col-md-4">                
                <label for="situacaoPropostaAjustada">Situação da Proposta Ajustada</label>                
                <select 
                    id="situacaoPropostaAjustada"
                    class="form-select br-select" 
                    name="situacaoPropostaAjustada"                    
                    v-model="situacaoPropostaAjustada">
                    <option value="">Escolha uma Situação</option>
                    <option v-for="item in situacoesPropostasAjustadas" v-text="item.situacao_ajustada" :value="item.situacao_ajustada" :key="item.situacao_ajustada"></option>
                </select>    
            </div>           
        </div>
        
        

        <div class="p-3 text-right">
            <button class="br-button primary mr-3" type="submit">Pesquisar
            </button>
            

            
            <button class="br-button danger mr-3" type="button" onclick="javascript:window.history.go(-1)">Voltar
            </button>
        </div> 
    </div>    
</template>

<script>
    export default {
        props:['url'],
        data(){
            return{
              numPropostaTransf:'',
                estados:'',
                estado:'',
                municipios: '',
                municipio:'',
                textoEscolhaMunicipio: "Filtre o Estado",
                textoEscolhaEnte:"Filtre o Município",
                entespublicos: '',
                entepublico:'',
                situacoesPropostasAjustadas: '',
                situacaoPropostaAjustada:'',
               buscandoEnte: false,
                buscando: false,
                acaoProgramas: '',
                acaoPrograma:'',
               programaSiconv:'',
                programasSiconv:'',
                
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
            },
            onChangeMunicipio() {
                this.textoEscolhaEnte = "Buscando...";
                this.entepublico = '';
                this.buscandoEnte = true;
                if(this.municipio != '') {
                    //busca dados no banco de dados para carregar no componente
                    axios.get(this.url + '/api/ente_publico/municipio/' + this.municipio).then(resposta => {
                        this.textoEscolhaEnte = "Escolha um municipio:";
                        this.buscandoEnte = false;
                        this.entespublicos = resposta.data;                       
                    }).catch(error => {
                        console.log(error);
                    });
                  
                } else {
                    this.buscandoEnte = false;
                    this.entepublico = '';
                    this.textoEscolhaEnte = "Filtre o Município"
                }            
                
            }
        },
        mounted() {

            
           
            axios.get(this.url + '/api/programa_siconv').then(resposta => {
                //console.log(resposta.data);
                this.programasSiconv = resposta.data;
                this.programaSiconv= '';
                }).catch(erro => {
                    console.log(erro);
                })

            axios.get(this.url + '/api/acaoPrograma').then(resposta => {
                //console.log(resposta.data);
                this.acaoProgramas = resposta.data;
                this.acaoPrograma = '';
                }).catch(erro => {
                    console.log(erro);
                })

          
               
            //console.log(this.form._token);
            axios.get(this.url + '/api/ufs').then(resposta => {
                //console.log(resposta.data);
                this.estados = resposta.data;
                this.estado = '';
                this.municipio = '';                
                }).catch(erro => {
                    console.log(erro);
                })
           

         

            axios.get(this.url + '/api/situacao_ajustada_proposta').then(resposta => {
                //console.log(resposta.data);
                this.situacoesPropostasAjustadas = resposta.data;
                }).catch(erro => {
                    console.log(erro);
                })

                
        }
       
            
    }
</script>
