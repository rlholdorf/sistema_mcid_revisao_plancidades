<template>
   <div class="form-group">  
        <div class="row" v-if="!(estado || municipio || selecao || situacaoProposta ||  recebidasSistema || numPropostaTransf)">
                    
            <div class="br-input" v-if="blnprotocolo" >
                <label for="apf">ID da Proposta</label>
                <input id="txt_protocolo" name="txt_protocolo"  type="text" placeholder="Digite o ID da proposta. Ex: 207236" v-model="protocolodigitado"/>            
            </div>
               
        </div> 
        <div class="row" v-if="!(estado || municipio || selecao || situacaoProposta ||  recebidasSistema || protocolodigitado)">
                            
            <div class="br-input" v-if="blntransferegov" >
                <label for="apf">Número da Proposta no Transferegov</label>
                <input id="numPropostaTransf" name="numPropostaTransf"  type="text" placeholder="Digite o Número da Proposta no Transferegov. Ex: 2072/2020" v-model="numPropostaTransf"/>            
            </div>
            
        </div> 
        
        <div class="row"  v-if="!(protocolodigitado || numPropostaTransf)">        
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
        <div class="row" v-if="!(protocolodigitado || numPropostaTransf)">
            <div class="col col-xs-12 col-sm-12 br-input" v-if="blnentepublico">
                <label for="entepublico">Ente Público</label>                
                <select 
                    id="entepublico"
                    class="form-select br-select" 
                    name="entepublico"
                    :="requermunicipio == 'true'"
                    :disabled="municipio == '' || buscando"
                    v-model="entepublico">
                    <option value="" v-text="textoEscolhaEnte"></option>
                    <option v-for="entepublico in entespublicos" v-text="entepublico.id + ' - ' + entepublico.txt_ente_publico" :value="entepublico.id" :key="entepublico.id"></option>
                </select>  
            </div>
                    
        </div>
        <div class="row" v-if="!(protocolodigitado || numPropostaTransf)">
            <div class="column col-xs-12 col-md-6" v-if="blnselecao">                
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
            <div class="column col-xs-12 col-md-6" v-if="blnsituacaopropostas">                
                <label for="situacaoProposta">Situação da Proposta</label>                
                <select 
                    id="situacaoProposta"
                    class="form-select br-select" 
                    name="situacaoProposta"                    
                    v-model="situacaoProposta">
                    <option value="">Escolha uma Situação</option>
                    <option v-for="item in situacoesPropostas" v-text="item.txt_situacao_proposta" :value="item.id" :key="item.id"></option>
                </select>    
            </div>
        </div>
        <div class="row" v-if="!(protocolodigitado || numPropostaTransf)">
            <div class="col col-xs-12 col-sm-12 br-input" v-if="blnsistema">
                <label for="recebidasSistema">Escolha a forma que a proposta foi cadastrada</label>           
                <select 
                    id="recebidasSistema"
                    class="form-select br-select" 
                    name="recebidasSistema"     
                        v-model="recebidasSistema"     
                    >
                    <option value="">Escolha um Sistema:</option>
                    <option value="1">Sistema de Cadastramento</option>
                    <option value="0">Formulário WEB</option>                    
                </select>
            </div>
                    
        </div>
        

        <div class="p-3 text-right">
            <button v-if="blnbtnpesquisar" class="br-button primary mr-3" type="submit" :disabled="numPropostaTransf == '' && protocolodigitado == '' && estado == '' && municipio == '' && selecao == '' && situacaoProposta == '' &&  recebidasSistema == '' ">Pesquisar
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
