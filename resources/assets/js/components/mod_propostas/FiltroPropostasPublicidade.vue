<template>
   <div class="form-group">  
        
        <div class="row">        
            <div class="column col-xs-12 col-md-3">
                <label for="uf">UF</label>           
                <select 
                    id="estado"
                    class="form-select br-select" 
                    name="estado"
                    :="requeruf == 'true'"
                    @change="onChangeEstado"
                    v-model="estado">
                    <option value="">Escolha um Estado:</option>
                    <option v-for="estado in estados" v-text="estado.txt_sigla_uf" :value="estado.id" :key="estado.id"></option>
                </select>                                  
            </div>        
            <div class="column col-xs-12 col-md-9">
    <!-- municipio -->    
                <label for="municipio">Município</label>                
                <select 
                    id="municipio"
                    class="form-select br-select" 
                    name="municipio"
                    :="requermunicipio == 'true'"
                    @change="onChangeMunicipio"
                    :disabled="estado == '' || buscando"
                    v-model="municipio">
                    <option value="" v-text="textoEscolhaMunicipio"></option>
                    <option v-for="municipio in municipios" v-text="municipio.ds_municipio" :value="municipio.id" :key="municipio.id"></option>
                </select>    
            </div>
        </div>
        
        <div class="row">
            <div class="column col-xs-12 col-md-6">                
                <label for="selecao">Seleção</label>                
                <select 
                    id="selecao"
                    class="form-select br-select" 
                    name="selecao"                    
                    v-model="selecao">
                    <option value="">Escolha uma seleção</option>
                    <option v-for="item in selecoes" v-text="item.txt_selecao + ' - ' + item.num_selecao + 'ª Seleção'" :value="item.id" :key="item.id"></option>
                </select>    
            </div>
            <div class="column col-xs-12 col-md-6">                
                <label for="situacaoProposta">Situação da Proposta</label>                
                <select 
                    id="situacaoProposta"
                    class="form-select br-select" 
                    name="situacaoProposta"                    
                    v-model="situacaoProposta">
                    <option value="">Escolha uma Situação</option>
                    <option value="8">Excluída pelo Ente Público</option>
                    <option value="6">Não Selecionadas</option>
                    <option value="5">Selecionadas</option>
                    

                    
                    
                </select>    
            </div>
        </div>
        
        

        <div class="p-3 text-right">
            <button v-if="blnbtnpesquisar" class="br-button primary mr-3" type="submit" :disabled="estado == '' && municipio == '' && selecao == '' && situacaoProposta == ''">Pesquisar
            </button>
            <button v-if="!blnbtnpesquisar" class="br-button primary mr-3" type="submit">Pesquisar
            </button>

            
            <button class="br-button danger mr-3" type="button" onclick="javascript:window.history.go(-1)">Voltar
            </button>
        </div> 
    </div>    
</template>

<script>
    export default {
        props:['url','municipioselecionado','ufselecionada','coluf','colmun','requermunicipio','requeruf','complementonomelabelmun','blnsituacaopropostas',
        'blntransferegov','blnprotocolo', 'blnsistema','blnselecao','blnbtnpesquisar','blnentepublico'],
        data(){
            return{
                protocolodigitado:'',
                numPropostaTransf:'',
                estados:'',
                estado:'',
                municipios: '',
                municipio:'',
                textoEscolhaMunicipio: "Filtre o Estado",
                textoEscolhaEnte:"Filtre o Município",
                entespublicos: '',
                entepublico:'',
                selecoes: '',
                selecao:'',
                situacoesPropostas: '',
                situacaoProposta:'',
                recebidasSistema:'',
                buscandoEnte: false,
                buscando: false,
               
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
            //console.log(this.form._token);
            axios.get(this.url + '/api/ufs').then(resposta => {
                //console.log(resposta.data);
                this.estados = resposta.data;
                this.estado = '';
                this.municipio = '';                
                }).catch(erro => {
                    console.log(erro);
                })
           

            axios.get(this.url + '/api/selecao').then(resposta => {
                //console.log(resposta.data);
                this.selecoes = resposta.data;
                this.selecao = '';
                }).catch(erro => {
                    console.log(erro);
                })

            axios.get(this.url + '/api/situacaoPropostas').then(resposta => {
                //console.log(resposta.data);
                this.situacoesPropostas = resposta.data;
                this.situacaoProposta = '';
                }).catch(erro => {
                    console.log(erro);
                })

                
        }
       
            
    }
</script>
