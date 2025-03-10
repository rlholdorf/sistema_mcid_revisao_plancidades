<template>
    <div>
        <div class="form-group" v-if="this.proposta == ''">  
            <div class="row" v-if="!(estado || municipio)">
                        
                        <div class="br-input" v-if="blnprotocolo" >
                            <label for="apf">ID da Proposta</label>
                            <input id="txt_protocolo" name="txt_protocolo"  type="text" placeholder="Digite o ID da proposta. Ex: 207236" 
                                v-model="protocolodigitado"/>            
                        </div>
                        
                          
                    
            </div> 
            <div class="row"  v-if="!protocolodigitado">        
                <div class="column col-xs-12 col-md-3">
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
                <div class="column col-xs-12 col-md-9">
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
            </div>
            <div class="row" v-if="!protocolodigitado">
                <div class="col col-xs-12 col-sm-12 br-input">
                    <label for="entepublico">Ente Público</label>                
                    <select 
                        id="entepublico"
                        class="form-select br-select" 
                        name="entepublico"
                        :disabled="municipio == '' || buscando"
                        @change="onChangeEnte"
                        v-model="entepublico">
                        <option value="" v-text="textoEscolhaEnte"></option>
                        <option v-for="entepublico in entespublicos" v-text="entepublico.txt_ente_publico" :value="entepublico.id.toString()" :key="entepublico.id.toString()"></option>
                    </select>  
                </div>
                        
            </div>
            <div class="row" v-if="!protocolodigitado">
                <div class="col col-xs-12 col-sm-12 br-input">
                    <label for="relacaoId">Proposta</label>                
                    <select 
                        id="relacaoId"
                        class="form-select br-select" 
                        name="relacaoId"
                        :disabled="entepublico == '' || buscando"
                        v-model="relacaoId">
                        <option value="" v-text="textoEscolhaProposta"></option>
                        <option v-for="dados in relacaoIdsPropostas" v-text="'Proposta ID: ' + dados.proposta_id + ' ('+dados.txt_modalidade_participacao +  ' - Valor intervenção: ' + formatarValor(dados.vlr_intervencao,2)" :value="dados.proposta_id" :key="dados.proposta_id"></option>
                    </select>  
                </div>
                        
            </div>
            
            
    
            <div class="p-3 text-right">
                <button v-if="blnbtnpesquisar" class="br-button primary mr-3" type="button"  @click="onAddProposta" :disabled="protocolodigitado == '' && relacaoId == ''">Adicionar
                </button>
                <button v-if="!blnbtnpesquisar" class="br-button primary mr-3"  type="button" @click="onAddProposta">Adicionar
                </button>
                <button class="br-button danger mr-3" type="button" data-bs-dismiss="modal"  @click="limparProposta">Fechar
                </button>
            </div> 
        </div>  
        
        <div class="form-group" v-if="this.proposta != ''">   
            <input type="hidden" id="proposta_id" name="proposta_id"  v-model="proposta">
            <input type="hidden" id="proposta_transferegov" name="proposta_transferegov"  v-model="num_proposta_transferegov">
            <div class="row">
                <div class="col col-xs-12 col-sm-2">
                    <label >1. ID da Proposta<span></span></label>
                    <p>
                        {{ this.proposta }}
                    </p>                   
                </div> 
                <div class="col col-xs-12 col-sm-4">
                    <label >2. Ente Público<span></span></label>
                    <p>
                        {{ this.txt_ente_publico }}
                    </p>                   
                </div> 
                <div class="col col-xs-12 col-sm-2">
                    <label >3. UF<span></span></label>
                    <p>
                        {{ this.txt_uf }}
                    </p>                   
                </div> 
                <div class="col col-xs-12 col-sm-4">
                    <label >4. Município<span></span></label>
                    <p>
                        {{ this.txt_municipio }}
                    </p>                   
                </div> 
            </div><!-- div row -->  
            <div class="row">            
                <div class="col col-xs-12 col-sm-12 ">
                    <label >5. Objeto da Intervenção<span></span></label>
                    <p>
                        {{ this.dsc_obj_intervencao }}
                    </p>                   
                </div>    
            
                <div class="col col-xs-12 col-sm-12">     
                    <label >6. Itens financiáveis das ações orçamentárias do programa cadastrados na proposta :</label>
                </div>    
                
            </div><!-- div row -->

            <div class="br-list" role="list">
                
                    <div class="br-item" role="listitem" >
                        <div class="row align-items-center" v-for="item in itens">
                           
                            <div class="col" >
                                <li>{{item.acao}} - {{item.txt_acao_programa}} / {{item.txt_item_financiavel}}  </li>
                            </div>
                        
                        </div>
                    </div>                
                
              </div>

              <div class="row">            
                <div class="col col-xs-12 col-sm-12">     
                    <label >7. Indicadores:</label>
                </div>    
                
            </div><!-- div row -->
            
            <div class="br-list" role="list">
                
                    <div class="br-item" role="listitem">
                        <div class="row align-items-center">                           
                            <div class="col">
                                <li>IDH do Município: <strong>{{this.idh}}</strong> </li>
                                <li>População Atendida Abastecimento de Água: <strong>{{this.num_pop_atendida_abastecimento_agua}}</strong>  </li>
                                <li>População Atendida Saneamento: <strong>{{this.num_pop_atendida_esgotamento_sanitario}}</strong>  </li>
                            </div>
                        
                        </div>
                    </div>                
                
              </div>
             
            <div class="row">
                <div class="col col-xs-12 col-sm-4 br-input">
                    <label >8. Valor Repasse</label>
                    <input id="vlr_repasse" 
                       type="text"
                        name="vlr_repasse"    
                        @input="calcular"
                        @change="onChangeRepasse"
                        v-model="vlr_repasse" 
                        required                                     >
                      
                </div>
                <div class="col col-xs-12 col-sm-4 br-input">
                    <label >9. Valor Tarifa</label>
                    <input id="vlr_tarifa" 
                       type="text"
                        name="vlr_tarifa"    
                        v-model="vlr_tarifa" 
                        disabled                                     >
                      
                </div>
                <div class="col col-xs-12 col-sm-4 br-input">
                    <label >10. Valor Transferegov</label>
                    <input id="vlr_final_transferegov" 
                        type="text"
                        name="vlr_final_transferegov"    
                        v-model="vlr_final_transferegov" 
                        disabled                                     >
                     
                </div>
                
            </div><!-- div row -->
    
           
    
            <div class="row">
                
                <div class="col col-xs-12 col-sm-12">
                    <label for="uf">11. Ação Selecionada</label>           
                    <select 
                        id="acao"
                        class="form-select br-select" 
                        name="acao" 
                        required               
                        v-model="acao">
                        <option value="">Escolha uma acao:</option>
                        <option v-for="acao in acoes" v-text="acao.acao + ' - ' + acao.txt_acao_programa" :value="acao.acao" :key="acao.acao"></option>
                    </select>                                                      
                </div>   
                <!--     
                <div class="col col-xs-12 col-sm-3 br-input">
                    <label >12. Num Proposta Transferegov</label>
                    <input id="num_proposta_transferegov" 
                        type="text"
                        name="num_proposta_transferegov"    
                        v-model="num_proposta_transferegov" 
                        disabled                                     >
                     
                </div>
                -->
            </div>
                    
            <span class="br-divider my-3"></span>
            <div class="p-3 text-right">
                <button class="br-button primary mr-3" type="submit">Salvar
                </button>
                <button class="br-button danger mr-3" type="button" data-bs-dismiss="modal"  @click="limparProposta">Fechar
                </button>
            </div> 
        </div>   

    </div>
 </template>
 
 <script>
     export default {
         props:['url','blnsituacaopropostas','blnprotocolo', 'blnbtnpesquisar','idproposta','numpropostatransferegov'],
         data(){
             return{
                 protocolodigitado:'',
                 estados:'',
                 estado:'',
                 municipios: '',
                 municipio:'',
                 txt_municipio:'',
                 txt_uf:'',
                 textoEscolhaMunicipio: "Filtre o Estado",
                 textoEscolhaEnte:"Filtre o Município",
                 entespublicos: '',
                 entepublico:'',
                 txt_ente_publico:'',
                 selecoes: '',
                 selecao:'',
                 situacoesPropostas: '',
                 situacaoProposta:'',
                 recebidasSistema:'',
                 buscandoEnte: false,
                 buscando: false,
                 buscandoProposta:false,
                 proposta:'',
                 dados_proposta:'',
                 dsc_obj_intervencao:'',
                 vlr_intervencao:0,
                vlr_repasse:0,
                vlr_tarifa:0,
                vlr_final_transferegov:0,
                itens:'',
                acao:'',
                acoes:'',
                isOpen: true,                
                results: [],
                relacaoId:'',
                relacaoIdsPropostas:'',
                textoEscolhaProposta:"Filtre o Ente Público",
                propostaSelecionada:'',
                idh:'',
                num_pop_atendida_esgotamento_sanitario:'',
                num_pop_atendida_abastecimento_agua:'',
                num_propostatrans_feregov:''
                
             }        
         },
         methods:{
            
            formatarValor(valor,casas) {
                if (valor) {
                    let val = (valor/1).toFixed(casas).replace('.', ',')
                    return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
                } else {
                    return '0.00';
                }
            },
            calcular(){
                if((this.vlr_repasse > 238856) && (this.vlr_repasse < 777450)){
                    this.vlr_tarifa = Number(Math.ceil(((this.vlr_repasse - 3500)* 0.03100775) + 3500));
                }else if((this.vlr_repasse >= 777450) && (this.vlr_repasse < 1560500)){
                    this.vlr_tarifa = Number(Math.ceil(((this.vlr_repasse - 3500)* 0.03660886) + 3500));
                }else  if((this.vlr_repasse >= 1569500) && (this.vlr_repasse < 83523500)){
                    this.vlr_tarifa = Number(Math.ceil(((this.vlr_repasse - 3500)* 0.042145594) + 3500));
                }else  if(this.vlr_repasse >= 83523500){
                    this.vlr_tarifa = Number(Math.ceil(((this.vlr_repasse - 3500)* 0.0421455939) + 3500));
                }else{
                    this.vlr_tarifa = Number(0);
                }  
                
                this.vlr_tarifa = Number(Math.ceil(this.vlr_tarifa));
                this.vlr_final_transferegov = Number(this.vlr_repasse - this.vlr_tarifa);

             //   this.vlr_repasse = this.formatarValor(this.vlr_repasse,2);
                this.vlr_tarifa = this.formatarValor(this.vlr_tarifa,2);
                this.vlr_final_transferegov = this.formatarValor(this.vlr_final_transferegov,2);
                
                
                
            },
            onChangeRepasse(){
                this.vlr_repasse = this.formatarValor(Number(this.vlr_repasse),2);
            },
             onChangeEstado() {
                 this.textoEscolhaMunicipio = "Buscando...";
                 this.municipio = '';
                 this.buscando = true;
                 if(this.estado != '') {
                     //busca dados no banco de dados para carregar no componente
                     axios.get(this.url + '/api/municipios/propostas/' + this.estado).then(resposta => {
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
                 
             },
             onChangeEnte(){
                this.textoEscolhaProposta = "Buscando...";
                 this.relacaoId = '';
                 this.buscandoProposta = true;

                 if(this.entepublico != '') {
                     //busca dados no banco de dados para carregar no componente
                     axios.get(this.url + '/api/relacao_propostas_id/' + this.entepublico.toString()).then(resposta => {
                         this.textoEscolhaProposta = "Escolha uma proposta:";
                         this.buscandoProposta = false;
                         this.relacaoIdsPropostas = resposta.data;    
                         console.log('entrou: ' + this.entepublico);                   
                     }).catch(error => {
                         console.log(error);
                     });
                   
                 } else {
                     this.buscandoProposta = false;
                     this.entepubrelacaoIdlico = '';
                     this.textoEscolhaProposta = "Filtre o Ente Público"
                 }   
                

             },
             limparProposta(){
                this.proposta = '';
                this.relacaoId = '';
                this.protocolodigitado = '';
                this.entepublico = '';
                this.estado = '';
                this.municipio = '';

             },
             onAddProposta(){
                this.proposta = '';
                 this.buscandoProposta = true;
                 if(this.protocolodigitado != '' || this.relacaoId != ''){
                    //buscar dados proposta
                    if(this.protocolodigitado == ''){
                        this.propostaSelecionada = this.relacaoId;
                    }else if(this.relacaoId == ''){
                        this.propostaSelecionada = this.protocolodigitado;
                    }
                    
                    axios.get(this.url + '/api/proposta/' + this.propostaSelecionada).then(resposta => {
                         
                        
                                this.buscandoProposta = false;
                                  
                                if(resposta.data){
                                    this.dados_proposta = resposta.data; 
                                    this.dsc_obj_intervencao = this.dados_proposta.dsc_obj_intervencao;       
                                    this.proposta = this.dados_proposta.proposta_id;    
                                    this.txt_ente_publico   = this.dados_proposta.txt_ente_publico;    
                                    this.txt_municipio   = this.dados_proposta.ds_municipio;    
                                    this.txt_uf   = this.dados_proposta.sg_uf;   
                                    this.idh = this.dados_proposta.vlr_idhm;
                                    this.num_pop_atendida_esgotamento_sanitario = this.dados_proposta.num_pop_atendida_esgotamento_sanitario;
                                    this.num_pop_atendida_abastecimento_agua = this.dados_proposta.num_pop_atendida_abastecimento_agua;
                                  
                                    if((this.dados_proposta.vlr_intervencao > 238856) && (this.dados_proposta.vlr_intervencao < 777450)){
                                        this.vlr_tarifa = Number(Math.ceil(((this.dados_proposta.vlr_intervencao - 3500)* 0.03100775) + 3500));
                                    }else if((this.dados_proposta.vlr_intervencao >= 777450) && (this.dados_proposta.vlr_intervencao < 1560500)){
                                        this.vlr_tarifa = Number(Math.ceil(((this.dados_proposta.vlr_intervencao - 3500)* 0.03660886) + 3500));
                                    }else  if((this.dados_proposta.vlr_intervencao >= 1569500) && (this.dados_proposta.vlr_intervencao < 83523500)){
                                        this.vlr_tarifa = Number(Math.ceil(((this.dados_proposta.vlr_intervencao - 3500)* 0.042145594) + 3500));
                                    }else  if(this.dados_proposta.vlr_intervencao >= 83523500){
                                        this.vlr_tarifa = Number(Math.ceil(((this.dados_proposta.vlr_intervencao - 3500)* 0.0421455939) + 3500));
                                    }else{
                                        this.vlr_tarifa = Number(0);
                                    }
                     

                                    this.vlr_repasse =Number(this.dados_proposta.vlr_intervencao);                                    
                                    this.vlr_tarifa =Number(Math.ceil(this.vlr_tarifa).toFixed());
                                    this.vlr_final_transferegov = Number(Math.ceil(this.dados_proposta.vlr_intervencao - this.vlr_tarifa).toFixed());

                                    this.vlr_repasse = this.formatarValor(this.vlr_repasse,2);
                                    this.vlr_tarifa = this.formatarValor(this.vlr_tarifa,2);
                                    this.vlr_final_transferegov = this.formatarValor(this.vlr_final_transferegov,2);


                                }else{
                                    Swal({
                                        title: 'Atenção!',
                                        text: 'Não existe proposta para o ID informado.',
                                        type: 'warning',
                                        showCancelButton: false,
                                        cancelButtonColor: '#dc3545',
                                        cancelButtonText: 'OK',
                                        }).then((result) => {
                                            if (result.value ) {
                                                this.dados_proposta = '';                                               
                                            }
                                        })
                                }
                            

                           
                     }).catch(error => {
                         console.log(error);
                     });



                     //buscar dados itens financiáveis
                     axios.get(this.url + '/api/itens_financiaveis/proposta/' + this.propostaSelecionada).then(resposta => {
                         this.itens = resposta.data;      
                         
                     }).catch(error => {
                         console.log(error);
                     });

                     //buscar dados acoes
                     axios.get(this.url + '/api/acoes/proposta/' + this.propostaSelecionada).then(resposta => {
                         this.acoes = resposta.data;      
                         
                     }).catch(error => {
                         console.log(error);
                     });


                 }
             },
             formatarValor(valor,casas) {
                if (valor) {
                    let val = (valor/1).toFixed(casas).replace('.', ',')
                    return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
                } else {
                    return '0.00';
                }
            },
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
            
                
             if(this.idproposta){
                this.proposta = this.idproposta;
                this.protocolodigitado = this.idproposta;
                console.log('entrou: ' + this.idproposta);
                this.onAddProposta();     

             }

             if(this.numpropostatransferegov){

                this.num_proposta_transferegov = this.numpropostatransferegov;
             }

             
                 
         }
        
             
     }
 </script>
 