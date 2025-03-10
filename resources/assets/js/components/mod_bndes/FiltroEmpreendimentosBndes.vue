<template>
   <div class="form-group">  
        <div class="row" v-if="!(estado || municipio || andamento || situacaoContrato ||  situacaotrabalhoTecnico || statusDocumento || statusLicenciamento || statusLicitacao || statusProjeto || codSaci)">
            <div class="column col-xs-12 col-md-12">           
                <div class="br-input" >
                    <label for="cod_mcidades">Código MCidades</label>
                    <input id="cod_mcidades" name="cod_mcidades" type="text"  v-model="codMCidades" placeholder="Digite o Código do Empreendimentos no Ministério das Cidades. Ex: 01000501001"/>            
                </div>
            </div>
        
        </div> 
        <div class="row" v-if="!(estado || municipio || situacaoContrato ||  situacaotrabalhoTecnico || statusDocumento || statusLicenciamento || statusLicitacao || statusProjeto || codMCidades)">
            <div class="column col-xs-12 col-md-12">           
                <div class="br-input" >
                    <label for="cod_saci">Código SACI</label>
                    <input id="cod_saci" name="cod_saci" type="text"  v-model="codSaci" placeholder="Digite o Código do SACI. Ex: 0100050"/>            
                </div>
            </div>

        </div> 
        <!--
        <div class="row" v-if="!(estado || municipio || selecao || situacaoProposta ||  recebidasSistema || codMCidades || codSaci)">
            <div class="column col-xs-12 col-md-12">           
                <div class="br-input" >
                    <label for="cod_Bndes">Código BNDES</label>
                    <input id="cod_Bndes" name="cod_Bndes" minlength="20" maxlength="20" type="text"  v-model="codBndes" placeholder="Digite o Código do BNDES. Ex: 10005"/>            
                </div>
            </div>

        </div> 
        -->
        <span class="br-divider my-3"></span>
        <div class="row"  v-if="!(codSaci || codMCidades)">        
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
            <div class="column col-xs-12 col-md-8">
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
            <div class="column col-xs-12 col-md-2">
                <label for="novo_pac">Novo PAC</label>           
                <select 
                    id="novo_pac"
                    class="form-select br-select" 
                    name="novo_pac"                 
                    v-model="novo_pac">
                    <option value="">Pertence o novo PAC?</option>
                    <option value="1">Sim</option>
                    <option value="0">Não</option>
                </select>                                  
            </div>   
        </div>

        <div class="row" v-if="!(codSaci || codMCidades)">
            <div class="column col-xs-12 col-md-3">
                <label for="andamento">Andamento</label>                
                <select 
                    id="andamento"
                    class="form-select br-select" 
                    name="andamento"
                    v-model="andamento">
                    <option value="">Escolha um Andamento</option>
                    <option v-for="andamento in andamentos" v-text="andamento.txt_andamento" :value="andamento.id" :key="andamento.id"></option>
                </select>    
            </div>
            <div class="column col-xs-12 col-md-3">
                <label for="situacaoContrato">Situação Contrato</label>                
                <select 
                    id="situacaoContrato"
                    class="form-select br-select" 
                    name="situacaoContrato"
                    v-model="situacaoContrato">
                    <option value="">Escolha um Situação Contrato</option>
                    <option v-for="situacaoContrato in situacaoContratos" v-text="situacaoContrato.txt_situacao_contrato" :value="situacaoContrato.id" :key="situacaoContrato.id"></option>
                </select>    
            </div>
            <div class="column col-xs-12 col-md-3">
                <label for="situacaoObra">Situação Obra</label>                
                <select 
                    id="situacaoObra"
                    class="form-select br-select" 
                    name="situacaoObra"
                    v-model="situacaoObra">
                    <option value="">Escolha um Situação Obra</option>
                    <option v-for="situacaoObra in situacaoObras" v-text="situacaoObra.txt_situacao_obra" :value="situacaoObra.id" :key="situacaoObra.id"></option>
                </select>    
            </div>
            <div class="column col-xs-12 col-md-3">
                <label for="statusProjeto">Status Projeto</label>                
                <select 
                    id="statusProjeto"
                    class="form-select br-select" 
                    name="statusProjeto"
                    v-model="statusProjeto">
                    <option value="">Escolha um Status Projeto</option>
                    <option v-for="statusProjeto in statusProjetos" v-text="statusProjeto.txt_status_projeto_engenharia" :value="statusProjeto.id" :key="statusProjeto.id"></option>
                </select>    
            </div>
        </div>
        <div class="row" v-if="!(codSaci || codMCidades)">
            <div class="column col-xs-12 col-md-3">
                <label for="statusDocumento">Status Documento</label>                
                <select 
                    id="statusDocumento"
                    class="form-select br-select" 
                    name="statusDocumento"
                    v-model="statusDocumento">
                    <option value="">Escolha um Status Documento</option>
                    <option v-for="statusDocumento in statusDocumentos" v-text="statusDocumento.txt_status_documentacao_titularidade" :value="statusDocumento.id" :key="statusDocumento.id"></option>
                </select>    
            </div>
            <div class="column col-xs-12 col-md-3">
                <label for="statusLicitacao">Status Licitação</label>                
                <select 
                    id="statusLicitacao"
                    class="form-select br-select" 
                    name="statusLicitacao"
                    v-model="statusLicitacao">
                    <option value="">Escolha um Status Licitação</option>
                    <option v-for="statusLicitacao in statusLicitacaos" v-text="statusLicitacao.txt_status_licitacao" :value="statusLicitacao.id" :key="statusLicitacao.id"></option>
                </select>    
            </div>
            <div class="column col-xs-12 col-md-3">
                <label for="statusLicenciamento">Status Licenciamento Ambiental</label>                
                <select 
                    id="statusLicenciamento"
                    class="form-select br-select" 
                    name="statusLicenciamento"
                    v-model="statusLicenciamento">
                    <option value="">Escolha um Status Licenciamento Ambiental</option>
                    <option v-for="statusLicenciamento in statusLicenciamentos" v-text="statusLicenciamento.txt_status_licenciamento_ambiental" :value="statusLicenciamento.id" :key="statusLicenciamento.id"></option>
                </select>    
            </div>
            <div class="column col-xs-12 col-md-3">
                <label for="situacaotrabalhoTecnico">Situação do Trabalho Técnico</label>                
                <select 
                    id="situacaotrabalhoTecnico"
                    class="form-select br-select" 
                    name="situacaotrabalhoTecnico"
                    v-model="situacaotrabalhoTecnico">
                    <option value="">Escolha um Situação do Trabalho Técnico</option>
                    <option v-for="situacaotrabalhoTecnico in situacaotrabalhoTecnicos" v-text="situacaotrabalhoTecnico.txt_situacao_trabalho_tecnico_social" :value="situacaotrabalhoTecnico.id" :key="situacaotrabalhoTecnico.id"></option>
                </select>    
            </div>
        </div>
        

        <div class="p-3 text-right">
            <button class="br-button primary mr-3" type="submit" >Pesquisar
            </button>
            <button class="br-button danger mr-3" type="button" onclick="javascript:window.history.go(-1)">Voltar
            </button>
        </div> 
    </div>    
</template>

<script>
    export default {
        props:['url','municipioselecionado','ufselecionada','coluf','colmun','requermunicipio','requeruf','complementonomelabelmun'],
        data(){
            return{
                codMCidades:'',
                codSaci:'',
                estados:'',
                estado:'',
                municipios: '',
                municipio:'',
                textoEscolhaMunicipio: "Filtre o Estado",
                textoEscolhaEnte:"Filtre o Município",
                andamentos:'',
                andamento:'',
                situacaoContratos:'',
                situacaoContrato:'',
                situacaoObras:'',
                situacaoObra:'',
                situacaotrabalhoTecnicos:'',
                situacaotrabalhoTecnico:'',
                statusDocumentos:'',
                statusDocumento:'',
                statusLicenciamentos:'',
                statusLicenciamento:'',
                statusLicitacaos:'',
                statusLicitacao:'',
                statusProjetos:'',
                statusProjeto:'',
                novo_pac:'',
            }        
        },
        methods:{
           
            onChangeEstado() {
                this.textoEscolhaMunicipio = "Buscando...";
                this.municipio = '';
                this.buscando = true;
                if(this.estado != '') {
                    //busca dados no banco de dados para carregar no componente
                    axios.get(this.url + '/api/bndes/municipios/' + this.estado).then(resposta => {
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
                    axios.get(this.url + '/api/bnde/municipios/' + this.municipio).then(resposta => {
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
            axios.get(this.url + '/api/bndes/ufs').then(resposta => {
                //console.log(resposta.data);
                this.estados = resposta.data;
                this.estado = '';
                this.municipio = '';                
                }).catch(erro => {
                    console.log(erro);
                })
           


            axios.get(this.url + '/api/bndes/andamento').then(resposta => {
                //console.log(resposta.data);
                this.andamentos = resposta.data;
                this.andamento = '';
                }).catch(erro => {
                    console.log(erro);
                })

            axios.get(this.url + '/api/bndes/situacao_contrato').then(resposta => {
                //console.log(resposta.data);
                this.situacaoContratos = resposta.data;
                this.situacaoContrato = '';
                }).catch(erro => {
                    console.log(erro);
                })

            axios.get(this.url + '/api/bndes/situacao_obra').then(resposta => {
                //console.log(resposta.data);
                this.situacaoObras = resposta.data;
                this.situacaoObra = '';
                }).catch(erro => {
                    console.log(erro);
                })

            axios.get(this.url + '/api/bndes/situacao_trabalho_tec').then(resposta => {
                //console.log(resposta.data);
                this.situacaotrabalhoTecnicos = resposta.data;
                this.situacaotrabalhoTecnico = '';
                }).catch(erro => {
                    console.log(erro);
                })     

            axios.get(this.url + '/api/bndes/status_documentacao').then(resposta => {
                //console.log(resposta.data);
                this.statusDocumentos = resposta.data;
                this.statusDocumento = '';
                }).catch(erro => {
                    console.log(erro);
                })    
                
                
            axios.get(this.url + '/api/bndes/status_licenciamento').then(resposta => {
                //console.log(resposta.data);
                this.statusLicenciamentos = resposta.data;
                this.statusLicenciamento = '';
                }).catch(erro => {
                    console.log(erro);
                }) 

                
            axios.get(this.url + '/api/bndes/status_licitacao').then(resposta => {
                //console.log(resposta.data);
                this.statusLicitacaos = resposta.data;
                this.statusLicitacao = '';
                }).catch(erro => {
                    console.log(erro);
                }) 
                
            axios.get(this.url + '/api/bndes/status_projeto_engenharia').then(resposta => {
                //console.log(resposta.data);
                this.statusProjetos = resposta.data;
                this.statusProjeto = '';
                }).catch(erro => {
                    console.log(erro);
                }) 
                
                
        }
       
            
    }
</script>
