<template>
    <div class="form-group">
        <div class="row" v-if="!(casa_legislativa || comissao || acao || programa ||  situacao_oficio || oficio)">
                    
            <div class="br-input">
                <label for="apf">CNPJ Ente</label>
                <input id="txt_cnpj" 
                         name="txt_cnpj"  
                         type="text" 
                         placeholder="Digite o CNPJ do ente. Ex: 02333555000125" 
                         v-model="txt_cnpj"/>            
            </div>
               
        </div> 
        <div v-if="!txt_cnpj">
            <div class="row" v-if="!acao">
                <div class="column col-xs-12 col-sm-6">                
                    <label for="casa_legislativa">Casa legislativa</label>           
                    <select 
                        id="casa_legislativa"
                        class="form-select br-select" 
                        name="casa_legislativa"                   
                        @change="onChangeCasaLegislativa"
                        v-model="casa_legislativa">
                        <option value="">Escolha uma casa legislativa:</option>
                        <option v-for="casa_legislativa in casas_legislativas" v-text="casa_legislativa.txt_casa_legislativa" :value="casa_legislativa.id" :key="casa_legislativa.id"></option>
                    </select>                                                      
                </div> 
                <div class="column col-xs-12 col-sm-6">                
                    <label for="comissao">Comissão</label>           
                    <select 
                        id="comissao"
                        class="form-select br-select" 
                        name="comissao"
                        v-model="comissao"
                        @change="onChangeComissao"
                        :disabled="casa_legislativa == '' || buscando">
                        <option value="">{{this.textoEscolhaComissao}}</option>
                        <option v-for="comissao in comissoes" v-text="comissao.txt_comissao" :value="comissao.id" :key="comissao.id"></option>
                    </select>                                                      
                </div>
            
            </div>
            <div class="row" v-if="!casa_legislativa">
                <div class="column col-xs-12 col-sm-6">                
                    <label for="acao">Ação</label>           
                    <select 
                        id="acao"
                        class="form-select br-select" 
                        name="acao"   
                        @change="onChangeAcao"                
                        v-model="acao">
                        <option value="">Escolha uma ação:</option>
                        <option v-for="acao in acoes" v-text="acao.id + ' - ' +acao.txt_acao_programa" :value="acao.id" :key="acao.id"></option>
                    </select>                                                      
                </div> 
                <div class="column col-xs-12 col-sm-6">                
                    <label for="programa">Programa</label>           
                    <select 
                        id="programa"
                        class="form-select br-select" 
                        name="programa"   
                        :disabled="acao == ''"                
                        v-model="programa">
                        <option value="">{{this.txt_escolha_programa}}</option>
                        <option v-for="programa in programas" v-text="programa.txt_nome_programa" :value="programa.cod_programa" :key="programa.cod_programa"></option>
                    </select>                                                      
                </div> 
            </div>
            <div class="row">
                <div class="column column col-xs-12 col-sm-3">                
                    <label for="situacao_oficio">Situação Ofício</label>           
                    <select 
                        id="situacao_oficio"
                        class="form-select br-select" 
                        name="situacao_oficio"   
                        v-model="situacao_oficio">
                        <option value="">Escolha uma situaçãoOfício</option>
                        <option v-for="situacao_oficio in situacoes_oficios" v-text="situacao_oficio.txt_situacao_oficio" :value="situacao_oficio.id" :key="situacao_oficio.id"></option>
                        
                        
                    </select>                                                      
                </div> 
                <div class="column col-xs-12 col-sm-9">                
                    <label for="oficio">Ofício</label>           
                    <select 
                        id="oficio"
                        class="form-select br-select" 
                        name="oficio"   
                        :disabled="casa_legislativa == '' || (casa_legislativa  != '' && oficios.length == 0) || buscandoOficio"                    
                        v-model="oficio">
                        <option value="">{{this.textoEscolhaOficio}}</option>
                        <option v-for="oficio in oficios" v-text="oficio.txt_num_oficio_completo_congresso" :value="oficio.oficio_emenda_id" :key="oficio.oficio_emenda_id"></option>
                    </select>                                                      
                </div> 
            </div>
        </div> 
    </div>
</template>

<script>
    export default {
        props:['url'],
        data(){
            return{
                txt_cnpj:'',
                casa_legislativa:'',
                casas_legislativas:'',                               
                textoEscolhaComissao:'Filtre uma casa legislativa',
                comissao:'',
                comissoes:'',    
                programa:'',
                programas:'',    
                acao:'',
                acoes:'',    
                oficio:'',
                oficios:'',    
                buscando: false  ,
                buscandoOficio:false,
                dadosComissao:'',  
                textoEscolhaOficio: "Filtre uma casa legislativa",
                txt_num_oficio_completo:'',
                txt_escolha_programa:'Filtre uma ação',
                num_processo_sei:'',
                num_documento_sei:'',
                situacoes_oficios:'',
                situacao_oficio:'',
                estado:'',
                estados:'',
                municipio:'',
                municipios:'',
            }
        },
        methods:{  
            onChangeCasaLegislativa() {
                this.textoEscolhaComissao = "Buscando...";
                this.comissao = '';
                this.buscando = true;
                this.buscandoOficio = true;
                if(this.casa_legislativa != '') {
                    //busca dados no banco de dados para carregar no componente
                    axios.get(this.url + '/api/comissoes/casa_legislativa/' + this.casa_legislativa).then(resposta => {
                        this.textoEscolhaComissao = "Escolha uma comissão:";
                        this.buscando = false;
                        this.comissoes = resposta.data;
                        console.log(this.comissoes);
                    }).catch(error => {
                        console.log(error);
                    });

                    //busca dados no banco de dados para carregar no componente
                    axios.get(this.url + '/api/oficio/casa_legislativa/' + this.casa_legislativa).then(resposta => {
                        this.textoEscolhaOficio = "Escolha um ofício:";
                        this.buscandoOficio = false;
                        this.oficios = resposta.data;
                        if(this.oficios.length == 0){
                            this.textoEscolhaOficio = "Escolha uma comissão:";
                        }
                        console.log(this.comissoes);
                    }).catch(error => {
                        console.log(error);
                        this.textoEscolhaOficio = "Escolha uma comissão:";
                        this.oficios = '';
                        this.buscandoOficio = true;

                    });
                  
                } else {
                    this.buscando = false;
                    this.buscandoOficio = false;
                    this.casa_legislativa = '';
                    this.textoEscolhaComissao = "Filtre uma casa legislativa"
                }   
            },
            onChangeComissao() {
                this.textoEscolhaOficio = "Buscando...";
                this.buscandoOficio = true;
                if(this.comissao != '') {
                    //busca dados no banco de dados para carregar no componente
                    axios.get(this.url + '/api/oficio/comissao/' + this.comissao).then(resposta => {
                        this.textoEscolhaOficio = "Escolha um ofício:";
                        this.buscandoOficio = false;
                        this.oficios = resposta.data;
                        console.log(this.comissoes);
                    }).catch(error => {
                        console.log(error);
                        this.buscandoOficio = true;
                        this.textoEscolhaOficio = "Filtre uma comissão";
                        this.oficios = '';
                    });
                  
                } else {
                    this.buscandoOficio = false;
                    this.textoEscolhaOficio = "'Escolha um ofício";
                    if(this.comissao == '') {
                        this.textoEscolhaOficio = "'Filtre uma casa legislativa";
                    }
                    if(this.casa_legislativa == '') {
                        this.textoEscolhaOficio = "'Filtre uma casa legislativa";
                    }
                }   
            },
            onChangeAcao() {
                this.txt_escolha_programa = "Buscando...";
                this.programa = '';
                this.buscando = true;
                if(this.acao != '') {
                    //busca dados no banco de dados para carregar no componente
                    axios.get(this.url + '/api/programas_rp/acao/' + this.acao).then(resposta => {
                        this.txt_escolha_programa = "Escolha um programa:";
                        this.buscando = false;
                        this.programas = resposta.data;
                        console.log(this.comissoes);
                    }).catch(error => {
                        console.log(error);
                    });
                  
                } else {
                    this.buscando = false;
                    this.casa_legislativa = '';
                    this.txt_escolha_programa = "Filtre uma ação"
                }   
            },
            
        } ,
        mounted() {           
            axios.get(this.url + '/api/casas_legislativas').then(resposta => {
                //console.log(resposta.data);
                this.casas_legislativas = resposta.data;
                }).catch(erro => {
                    console.log(erro);
                })

            axios.get(this.url + '/api/programas_rp').then(resposta => {
                //console.log(resposta.data);
                this.programas = resposta.data;
                }).catch(erro => {
                    console.log(erro);
                })

            axios.get(this.url + '/api/acaoPrograma').then(resposta => {
                //console.log(resposta.data);
                this.acoes = resposta.data;
                }).catch(erro => {
                    console.log(erro);
                })

         axios.get(this.url + '/api/situacaoOficio').then(resposta => {
                //console.log(resposta.data);
                this.situacoes_oficios = resposta.data;
                }).catch(erro => {
                    console.log(erro);
                })


                
        }
    }
</script>
