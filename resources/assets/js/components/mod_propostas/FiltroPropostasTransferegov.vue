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
            <div class="column col-xs-12 col-md-2">
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
            <div class="column col-xs-12 col-md-4">
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
      
            <div class="col col-xs-12 col-sm-6 br-input">
                <label for="entepublico">Ente Público</label>                
                <select 
                    id="entepublico"
                    class="form-select br-select" 
                    name="entepublico"
                    :="requermunicipio == 'true'"
                    :disabled="municipio == '' || buscando"
                    v-model="entepublico">
                    <option value="" v-text="textoEscolhaEnte"></option>
                    <option v-for="entepublico in entespublicos" v-text="entepublico.id +  ' - ' + entepublico.txt_ente_publico" :value="entepublico.id" :key="entepublico.id"></option>
                </select>  
            </div>
                    
        </div>
        <div class="row" v-if="!(protocolodigitado || numPropostaTransf)">
            <div class="column col-xs-12 col-md-3">                
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
            <div class="column col-xs-12 col-md-3">                
                <label for="modalidadeParticipacao">Modalidade Participação</label>                
                <select 
                    id="modalidadeParticipacao"
                    class="form-select br-select" 
                    name="modalidadeParticipacao"                    
                    v-model="modalidadeParticipacao">
                    <option value="">Escolha uma Modalidade</option>
                    <option v-for="item in modalidadeParticipacoes" v-text="item.txt_modalidade_participacao" :value="item.id" :key="item.id"></option>
                </select>    
            </div>
            <div class="column col-xs-12 col-md-3">                
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
            <div class="column col-xs-12 col-md-3">                
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
        </div>
        <div class="row" v-if="!(protocolodigitado || numPropostaTransf)">
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
            <div class="column col-xs-12 col-md-4">                
                <label for="sistemaVsTransferegov">Sistema versus Transferegov</label>                
                <select 
                    id="sistemaVsTransferegov"
                    class="form-select br-select" 
                    name="sistemaVsTransferegov"                    
                    v-model="sistemaVsTransferegov">
                    <option value="">Escolha uma opção</option>
                    <option v-for="item in sistemasVsTransferegov" v-text="item.sistema_x_transferegov" :value="item.sistema_x_transferegov" :key="item.sistema_x_transferegov"></option>
                </select>    
            </div>
            <div class="column col-xs-12 col-md-4">                
                <label for="validaCnpj">Valida CNPJ</label>                
                <select 
                    id="validaCnpj"
                    class="form-select br-select" 
                    name="validaCnpj"                    
                    v-model="validaCnpj">
                    <option value="">Escolha uma opção</option>
                    <option v-for="item in validaCnpjs" v-text="item.valida_cnpj" :value="item.valida_cnpj" :key="item.valida_cnpj"></option>
                </select>    
            </div>
        </div>
        
        

        <div class="p-3 text-right">
            <button v-if="blnbtnpesquisar" class="br-button primary mr-3" type="submit">Pesquisar
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
        'blntransferegov','blnprotocolo', 'blnsistema','blnselecao','blnbtnpesquisar'],
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
                situacoesPropostasAjustadas: '',
                situacaoPropostaAjustada:'',
                recebidasSistema:'',
                buscandoEnte: false,
                buscando: false,
                acaoProgramas: '',
                acaoPrograma:'',
                modalidadeParticipacao:'',
                modalidadeParticipacoes:'',
                programaSiconv:'',
                programasSiconv:'',
                sistemaVsTransferegov:'',
                sistemasVsTransferegov:'',
                validaCnpj:'',
                validaCnpjs:'',

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

            
            axios.get(this.url + '/api/valida_cnpj').then(resposta => {
                //console.log(resposta.data);
                this.validaCnpjs = resposta.data;
                this.validaCnpj= '';
                }).catch(erro => {
                    console.log(erro);
                })


            axios.get(this.url + '/api/sistema_vs_transferegov').then(resposta => {
                //console.log(resposta.data);
                this.sistemasVsTransferegov = resposta.data;
                this.sistemaVsTransferegov= '';
                }).catch(erro => {
                    console.log(erro);
                })

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

                
            axios.get(this.url + '/api/modalidade_participacao').then(resposta => {
                //console.log(resposta.data);
                this.modalidadeParticipacoes = resposta.data;
                this.modalidadeParticipacao = '';
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
           

            axios.get(this.url + '/api/situacaoPropostas').then(resposta => {
                //console.log(resposta.data);
                this.situacoesPropostas = resposta.data;
                this.situacaoProposta = '';
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
