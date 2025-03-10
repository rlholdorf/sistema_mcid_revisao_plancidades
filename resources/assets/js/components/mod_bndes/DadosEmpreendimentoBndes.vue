<template>
   <div >  

        <div class="accordion" id="accordionPanelsStayOpenExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                        1. Dados Principais
                    </button>
                </h2>
                <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingOne">
                    <div class="accordion-body">
                        <div class="row">
                            <div class="col col-xs-12 col-sm-2 br-input">        
                                <label for="input-default">1.1. Código SACI</label>
                                <input id="cod_saci" name="cod_saci" type="text" v-model="cod_saci" disabled="disabled"/>                
                            </div>  
                            <div class="col col-xs-12 col-sm-2 br-input">        
                                <label for="input-default">1.2. Código MDR</label>
                                <input id="cod_mcidades" name="cod_mcidades" type="text" v-model="cod_mcidades" disabled="disabled"/>
                            </div>  
                            <div class="col col-xs-12 col-sm-2 br-input">        
                                <label for="input-default">1.3. Nº Carta-Consulta</label>
                                <input id="num_carta_consulta_m_cidades" name="num_carta_consulta_m_cidades" type="text" v-model="num_carta_consulta_m_cidades" disabled="disabled"/>
                            </div>  
                            <div class="col col-xs-12 col-sm-2 br-input">        
                                <label for="input-default">1.4. Nº do Contrato</label>
                                <input id="num_contrato" name="num_contrato" type="text" v-model="num_contrato" disabled="disabled"/>
                            </div>  
                            <div class="col col-xs-12 col-sm-2 br-input">        
                                <label for="input-default">1.5. Código do Projeto</label>
                                <input id="cod_projeto" name="cod_projeto" type="text" v-model="cod_projeto" disabled="disabled"/>
                            </div>    
                            <div class="col col-xs-12 col-sm-2 br-input">        
                                <label for="input-default">1.6. Nº Operação</label>
                                <input id="num_operacoes" name="num_operacoes" type="text" v-model="num_operacoes" disabled="disabled"/>                
                            </div> 
                        </div><!-- div row -->
                        </br>
                        <div class="row">
                            
                            <div class="col col-xs-12 col-sm-2 br-input">        
                                <label for="input-default">1.7. Nº da Chamada</label>
                                <input id="num_chamada" name="num_chamada" type="text" v-model="num_chamada" disabled="disabled"/>                
                            </div>  
                            <div class="col col-xs-12 col-sm-4 br-input">        
                                <label for="input-default">1.8. Modalidade</label>
                                <input id="txt_modalidade" name="txt_modalidade" type="text" v-model="txt_modalidade" disabled="disabled"/>                
                            </div> 
                            <div class="col col-xs-12 col-sm-2 br-input">        
                                <label for="input-default">1.9. Obra</label>
                                <input id="txt_obra" name="txt_obra" type="text" v-model="txt_obra" disabled="disabled"/>                
                            </div> 
                            
                            <div class="col col-xs-12 col-sm-2 br-input">        
                                <label for="input-default">1.10. Tipo PAC</label>
                                <input id="num_pac1_pac2" name="num_pac1_pac2" type="text" v-model="num_pac1_pac2" disabled="disabled"/>                
                            </div> 
                            <div class="col col-xs-12 col-sm-2 br-input">        
                                <label for="input-default">1.11. Famílias Atendidas</label>
                                <input id="qtd_familias_atendidas" name="qtd_familias_atendidas" type="text" v-model="qtd_familias_atendidas" disabled="disabled"/>                
                            </div> 
                        </div><!-- div row -->
                        </br>
                        <div class="row">
                            <div class="col col-xs-12 col-sm-2 br-input">        
                                <label for="input-default">1.12. UF</label>
                                <select 
                                    id="estado"
                                    v-bind:class="classeditmun" 
                                    name="estado"
                                    :disabled="!btneditarmun"
                                    @change="onChangeEstado"
                                    v-model="estado">
                                    <option value="">Escolha um Estado:</option>
                                    <option v-for="estado in estados" v-text="estado.txt_sigla_uf" :value="estado.id" :key="estado.id"></option>
                                </select> 
                                <span class="feedback danger" role="alert" v-if="this.bln_erros && this.errors.atualizaMunicipio">
                                    <i class="fas fa-times-circle" aria-hidden="true"></i>O campo UF é obrigatório.
                                </span>   
                            </div>  
                            <div class="col col-xs-12 col-sm-4 br-input">        
                                <label for="input-default">1.13. Município Principal</label>
                                <select 
                                    id="municipio"
                                    v-bind:class="classeditmun"
                                    name="municipio"
                                    :disabled="!btneditarmun || estado == '' || buscando"
                                    v-model="municipio">
                                    <option value="" v-text="textoEscolhaMunicipio"></option>
                                    <option v-for="municipio in municipios" v-text="municipio.ds_municipio" :value="municipio.id" :key="municipio.id"></option>
                                </select> 
                                <span class="feedback danger" role="alert" v-if="this.bln_erros && this.errors.atualizaMunicipio">
                                    <i class="fas fa-times-circle" aria-hidden="true"></i>O campo Município é obrigatório.
                                </span>
                            </div> 
                            <div class="col col-xs-12 col-sm-6 br-textarea">        
                                <label for="textarea-id1">1.13.1. Municípios Digitados</label>
                                <textarea id="txt_municipios_sem_tratamento" name="txt_municipios_sem_tratamento"  v-model="txt_municipios_sem_tratamento" disabled="disabled"></textarea>
                            </div>                   
                        </div><!-- div row -->
                        </br>
                        <div class="row">
                            <div class="col col-xs-12 col-sm-4 br-input">        
                                <label for="input-default">1.14. Proponente</label>
                                <input id="txt_proponente" name="txt_proponente" type="text" v-model="txt_proponente" disabled="disabled"/>
                            </div>  
                            <div class="col col-xs-12 col-sm-8 br-textarea">        
                                <label for="textarea-id1">1.15. Local da Intervenção</label>
                                <textarea id="txt_local_da_intervencao" name="txt_local_da_intervencao" v-model="txt_local_da_intervencao" disabled="disabled"></textarea>
                            </div>
                        </div><!-- div row -->
                        </br>
                        <div class="row">
                            <div class="col col-xs-12 col-sm-6 br-textarea">        
                                <label for="input-default">1.16. Objeto</label>
                                <textarea id="txt_objeto" name="txt_objeto" rows="5" v-model="txt_objeto" disabled="disabled"></textarea>
                            </div>  
                            <div class="col col-xs-12 col-sm-6 br-textarea">        
                                <label for="textarea-id1">1.17. Descrição do Objeto</label>
                                <textarea id="txt_descricao_do_objeto" name="txt_descricao_do_objeto" rows="5" v-model="txt_descricao_do_objeto" disabled="disabled"></textarea>
                            </div>  
                        </div><!-- div row -->
                        </br>
                        <div class="row">
                            <div class="col col-xs-12 col-sm-3 br-input">        
                                <label for="input-default">1.18. Valor de Investimento</label>
                                <input id="vlr_investimento" name="vlr_investimento" type="text" v-model="vlr_investimento" disabled="disabled"/>                
                            </div>  
                            <div class="col col-xs-12 col-sm-3 br-input">        
                                <label for="input-default">1.19. Valor OGU</label>
                                <input id="vlr_ogu" name="vlr_ogu" type="text" v-model="vlr_ogu" disabled="disabled"/>
                            </div>  
                            <div class="col col-xs-12 col-sm-3 br-input">        
                                <label for="input-default">1.20. Valor do Financiamento</label>
                                <input id="vlr_financiamento" name="vlr_financiamento" type="text" v-model="vlr_financiamento" disabled="disabled"/>
                            </div>  
                            <div class="col col-xs-12 col-sm-3 br-input">        
                                <label for="input-default">1.21. Valor de Contrapartida</label>
                                <input id="vlr_contrapartida" name="vlr_contrapartida" type="text" v-model="vlr_contrapartida" disabled="disabled"/>
                            </div>                     
                        </div><!-- div row -->
                        </br>
                        


                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
                    <button id="panelsStayOpen-collapseTwo" class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" :aria-expanded="this.expandir" aria-controls="panelsStayOpen-collapseTwo">
                        2. Dados de Monitoramento
                    </button>
                    
                </h2>
                <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingTwo">
                    <div class="accordion-body">
                        <div class="row">
                            <div class="column col-xs-12 col-md-4">
                                <label for="andamento">2.1. Andamento</label>                
                                <select 
                                    id="andamento"
                                    v-bind:class="classeditselect"
                                    name="andamento"
                                    v-model="andamento"
                                    @change="onChangeAndamento"
                                    :disabled="!btneditar">
                                    <option value="">Escolha um Andamento</option>
                                    <option v-for="andamento in andamentos" v-text="andamento.txt_andamento" :value="andamento.id" :key="andamento.id"></option>
                                </select>    
                            </div>                    
                            <div class="col col-xs-12 col-sm-4 br-input" >        
                                <label for="input-default">2.2. Percentual de Execução</label>
                                <input v-bind:class="classeditinput" id="prc_execucao_atual" name="prc_execucao_atual" type="text" v-model="prc_execucao_atual"  :disabled="!btneditar"/>
                                <span class="feedback danger" role="alert" v-if="this.bln_erros && this.errors.percentual">
                                    <i class="fas fa-times-circle" aria-hidden="true"></i>Valor menor que 100%
                                </span>
                            </div>
                            <div class="col col-xs-12 col-sm-4 br-input">        
                                <label for="input-default">2.3. Data de possível inauguração</label>
                                <input id="dte_inauguracao" name="dte_inauguracao"  type="date" v-model="dte_inauguracao" disabled="disabled"/>
                            </div>  
                        </div><!-- div row -->
                        </br>
                        <div class="row">    
                            <div class="col col-xs-12 col-sm-3 br-input">        
                                <label for="input-default">2.4. Situação Contrato</label>
                                <input id="txt_situacao_contrato" name="txt_situacao_contrato" type="text" v-model="txt_situacao_contrato" disabled="disabled"/>
                            </div>
                            <div class="col col-xs-12 col-sm-3 br-input">        
                                <label for="input-default">2.5. Data Prevista da Assinatura do Contrato</label>
                                <input id="dte_previsao_assinatura_contrato" name="dte_previsao_assinatura_contrato" type="date" v-model="dte_previsao_assinatura_contrato" disabled="disabled"/>                
                            </div> 
                            <div class="col col-xs-12 col-sm-3 br-input">        
                                <label for="input-default">2.6. Data de Assinatura do Contrato</label>
                                <input id="dte_assinatura_contrato" name="dte_assinatura_contrato" type="date" v-model="dte_assinatura_contrato" disabled="disabled"/>                
                            </div>  
                            <div class="col col-xs-12 col-sm-3 br-input">        
                                <label for="input-default">2.7. Data de Conclusão Bndes</label>
                                <input id="dte_previsao_conclusao_bndes" name="dte_previsao_conclusao_bndes" type="date" v-model="dte_previsao_conclusao_bndes" disabled="disabled"/>  
                            
                                
                            </div>   
                        </div><!-- div row -->
                        </br>
                        <div class="row">            
                            <div class="col col-xs-12 col-sm-4 br-input">   
                                <label for="situacaoObra">2.8. Situação da Obra</label>                
                                <select 
                                    id="situacaoObra"
                                    v-bind:class="classeditselect" 
                                    name="situacaoObra"
                                    @change="onChangeSituacaoObra"
                                    v-model="situacaoObra"
                                    :disabled="!btneditar">
                                    <option value="">Escolha um Situação Obra</option>
                                    <option v-for="situacaoObra in situacaoObras" v-text="situacaoObra.txt_situacao_obra" :value="situacaoObra.id" :key="situacaoObra.id"></option>
                                </select>       
                            
                            </div> 
                            
                            <div class="col col-xs-12 col-sm-2 br-input">        
                                <label for="input-default">2.9. Data Prevista do Início</label>
                                <input id="dte_previsao_inicio" name="dte_previsao_inicio" type="date" v-model="dte_previsao_inicio" disabled="disabled"/>
                            </div> 
                            <div class="col col-xs-12 col-sm-2 br-input">        
                                <label for="input-default">2.10. Data Efetiva do Início</label>
                                <input  id="dte_efetivo_inicio_empreendimento" name="dte_efetivo_inicio_empreendimento"  type="date" v-model="dte_efetivo_inicio_empreendimento" disabled="disabled"/>
                            </div> 
                            <div class="col col-xs-12 col-sm-2 br-input">        
                                <label for="input-default">2.11. Data Prevista do Término</label>
                                <input v-bind:class="classeditinput" id="dte_previsao_conclusao" name="dte_previsao_conclusao" type="date" v-model="dte_previsao_conclusao"  :disabled="!btneditar"/>
                                <span class="feedback danger" role="alert" v-if="this.bln_erros && this.errors.dte_previsao_menor">
                                    <i class="fas fa-times-circle" aria-hidden="true"></i>Data deve ser maior que data atual
                                </span>
                            </div> 
                            <div class="col col-xs-12 col-sm-2 br-input">        
                                <label for="input-default">2.12. Data Efetiva do Término</label>
                                <input id="dte_efetivo_termino_do_empreendimento" name="dte_efetivo_termino_do_empreendimento" type="date" v-model="dte_efetivo_termino_do_empreendimento" disabled="disabled"/>
                            </div> 
                        </div><!-- div row -->
                        </br>
                        <div class="row"> 
                            
                        
                        </div><!-- div row -->
                        </br>
                        <div class="row"> 
                            <div class="col col-xs-12 col-sm-3 br-input">        
                                <label for="input-default">2.13. Valor de Investimento Atual</label>
                                <input id="vlr_investimento_atualizado" name="vlr_investimento_atualizado" type="text" v-model="vlr_investimento_atualizado" disabled="disabled"/>
                                
                                <span class="feedback danger" role="alert" v-if="this.bln_erros && this.errors.vlr_investimento_atual">
                                    <i class="fas fa-times-circle" aria-hidden="true"></i>O valor de investimento atual deve ser maior que 0.
                                </span>
                                
                            </div>  
                            <div class="col col-xs-12 col-sm-3 br-input">        
                                <label for="input-default">2.14. Valor OGU</label>
                                <input v-bind:class="classeditinput"  
                                        id="vlr_ogu_atualizado" 
                                        name="vlr_ogu_atualizado" 
                                        type="number" 
                                        v-model="vlr_ogu_atualizado" 
                                        :disabled="!btneditar"/>
                            </div>  
                            <div class="col col-xs-12 col-sm-3 br-input">        
                                <label for="input-default">2.15. Valor de Financiamento</label>
                                <input v-bind:class="classeditinput" 
                                    id="vlr_financiamento_atualizado" 
                                    name="vlr_financiamento_atualizado" 
                                    type="number" 
                                    v-model="vlr_financiamento_atualizado" 
                                    :disabled="!btneditar"/>
                            </div>    
                            <div class="col col-xs-12 col-sm-3 br-input">        
                                <label for="input-default">2.16. Valor de Contrapartida</label>
                                <input v-bind:class="classeditinput" 
                                        id="vlr_contrapartida_atualizada" 
                                        name="vlr_contrapartida_atualizada" 
                                        type="number" 
                                        v-model="vlr_contrapartida_atualizada" 
                                        :disabled="!btneditar"/>                
                            </div> 
                        </div><!-- div row -->
                        </br>
                        <div class="row">
                            <div v-bind:class="classedittextarea">        
                                <label for="input-default">1.17. Síntese da Situação Atual do Projeto</label>
                                <textarea id="txt_sintese_da_situacao_atual_do_projeto" name="txt_sintese_da_situacao_atual_do_projeto"  rows="5" v-model="txt_sintese_da_situacao_atual_do_projeto"  :disabled="!btneditar"></textarea>
                            </div>  
                            <div class="col col-xs-12 col-sm-6 br-textarea">        
                                <label for="textarea-id1">1.18. Serviços Executados</label>
                                <textarea id="txt_servicos_executados" name="txt_servicos_executados"  rows="5" v-model="txt_servicos_executados" disabled="disabled"></textarea>
                            </div>  
                        </div><!-- div row -->
                        </br>
                        <div class="row"> 
                            <div class="col col-xs-12 col-sm-4 br-input">        
                                <label for="input-default">2.19. Valor de Liberações</label>
                                <input id="vlr_liberacoes" v-bind:class="classeditinput" name="vlr_liberacoes" type="text" v-model="vlr_liberacoes"/>                
                            </div> 
                            <div class="col col-xs-12 col-sm-4 br-input">        
                                <label for="input-default">2.20. Data da Última Liberação</label>
                                <input id="dte_ult_liberacao" v-bind:class="classeditinput"  name="dte_ult_liberacao" type="date" v-model="dte_ult_liberacao"/>                
                            </div> 
                            <div class="col col-xs-12 col-sm-4 br-input">        
                                <label for="input-default">2.21. Valor de Desembolso Contrapartida</label>
                                <input id="vlr_desembolso_contrapartida" name="vlr_desembolso_contrapartida" type="text" v-model="vlr_desembolso_contrapartida" disabled="disabled"/>                
                            </div> 
                        </div><!-- div row -->
                        </br>
                        <div class="row"> 
                            <div class="col col-xs-12 col-sm-4 br-input">        
                                <label for="input-default">2.22. Data da Atualização</label>
                                <input id="dte_atualizacao_sintese_atual_do_projeto" name="dte_atualizacao_sintese_atual_do_projeto" type="date" v-model="dte_atualizacao_sintese_atual_do_projeto" disabled="disabled"/>                
                            </div> 
                            <div class="col col-xs-12 col-sm-4 br-input">        
                                <label for="input-default">2.23. Data da Carga</label>
                                <input id="dte_carga" name="dte_carga" type="date" v-model="dte_carga" disabled="disabled"/>                
                            </div>
                        </div>
                        </br>
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header" id="panelsStayOpen-headingThree">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false" aria-controls="panelsStayOpen-collapseThree">
                        3. Dados Complementares
                    </button>
                </h2>
                <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingThree">
                    <div class="accordion-body">
                        <div class="row"> 
                            <div class="col col-xs-12 col-sm-4 br-input">        
                                <label for="input-default">3.1. Gerente</label>
                                <input id="txt_gerente" name="txt_gerente" type="text" v-model="txt_gerente" disabled="disabled"/>                
                            </div>
                        
                            <div class="col col-xs-12 col-sm-4 br-input">        
                                <label for="input-default">3.3. Número do Ramal</label>
                                <input id="num_ramal" name="num_ramal" type="text" v-model="num_ramal" disabled="disabled"/>                
                            </div> 
                            <div class="col col-xs-12 col-sm-4 br-input">        
                                <label for="input-default">3.4. E-mail</label>
                                <input id="txt_email" name="txt_email" type="text" v-model="txt_email" disabled="disabled"/>                
                            </div> 
                        </div><!-- div row -->               
                        </br>
                        <div class="row">
                            <div class="col col-xs-12 col-sm-4 br-input">        
                                <label for="input-default">3.2. Monitor no MDR</label>
                                <input id="txt_monitor_mcidades" name="txt_monitor_mcidades" type="text" v-model="txt_monitor_mcidades" disabled="disabled"/>                
                            </div> 
                            
                            <div class="col col-xs-12 col-sm-4 br-input">        
                                <label for="input-default">3.5. Técnico Responsável</label>
                                <input id="txt_tecnico_responsavel" name="txt_tecnico_responsavel" type="text" v-model="txt_tecnico_responsavel" disabled="disabled"/>                
                            </div> 
                        </div>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="panelsStayOpen-headingFour">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseFour" aria-expanded="false" aria-controls="panelsStayOpen-collapseFour">
                    4. Municípios Beneficiados
                </button>
                </h2>
                <div id="panelsStayOpen-collapseFour" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingFour">
                    <div class="accordion-body">
                        
                        <button type="button" class="br-button block secondary mr-3" aria-label="Ícone ilustrativo" data-bs-toggle="modal" href="#exampleModalToggle" role="button">
                            <i class="fas fa-plus" aria-hidden="true"></i>Adicionar Município                            
                        </button> 
                        <span class="br-divider my-3"></span>
                        <div class="row"> 
                            <div class="table-responsive">		
                                <table class="table table-striped">
                                <thead>
                                    <tr class="text-center">
                                        <th scope="col">UF</th>
                                        <th scope="col">Município</th>
                                        <th scope="col">Ação</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="item in municipiosbeneficiados"> 
                                        <td >{{item.sg_uf}}</td>
                                        <td >{{item.txt_municipio}}</td>
                                        <td class="acao"><a  v-bind:href="url + '/bndes/municipio/excluir/'+ item.id"><i class="fas fa-trash-alt text-danger"></i></a></td>  
                                    </tr>
                                </tbody>                                        
                            </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <span class="br-divider lg my-3"></span>
        <div class="row">
            <div class="col col-xs-12 col-sm-6">        
                <div class="p-3 text-left">
                    <button class="br-button primary mr-3" type="button" name="imprimir" value="Imprimir" onclick="window.print();">Imprimir
                    </button>
                </div>
            </div>
            <div class="col col-xs-12 col-sm-6">        
                <div class="p-3 text-right">

                    <button v-if="!btneditar && (this.tipousuario == 14 || this.tipousuario == 1)" class="br-button warning mr-3" type="button" @click="editarDados(true)">Editar</button>
                    <button v-if="btneditar && (this.tipousuario == 14 || this.tipousuario == 1)" class="br-button info mr-3" type="button" v-on:click="checkForm">Salvar</button>
                    <button v-if="!btneditar" class="br-button danger mr-3" type="button" onclick="javascript:window.history.go(-1)">Voltar
                    </button>
                    <button v-if="btneditar && (this.tipousuario == 14 || this.tipousuario == 1)" class="br-button danger mr-3" type="button" @click="editarDados(false)">Cancelar
                    </button>
                </div> 
            </div>
        </div>
    <div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
        <form  v-bind:action="action " method="POST">            
            <input v-if="token" type="hidden" name="_token" v-bind:value="token">
            <input type="hidden" id="cod_bndes" name="cod_bndes" v-bind:value="this.cod_bndes">
        <div class="modal-dialog modal-dialog-centered  modal-lg">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalToggleLabel">Municípo Beneficiado</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Escolha a UF e o Município beneficiado para adicionar ao empreendimento.
                <span class="br-divider my-3"></span>
                <div class="row">        
                    <div class="col col-xs-12 col-sm-6">
                        <label for="uf">UF</label>           
                        <select 
                            id="estado"
                            class="form-select br-select" 
                            name="estadoBeneficiado"
                            required
                            @change="onChangeEstadoBeneficiado"
                            v-model="estadoBeneficiado">
                            <option value="">Escolha um Estado Benedeficiado:</option>
                            <option v-for="estadoBeneficiado in estadoBeneficiados" v-text="estadoBeneficiado.txt_uf" :value="estadoBeneficiado.id" :key="estadoBeneficiado.id"></option>
                        </select>                                  
                    </div>        
                    <div class="col col-xs-12 col-sm-6">
            <!-- municipio -->    
                        <label for="municipioBeneficiado">Município</label>               
                        <select 
                            id="municipioBeneficiado"
                            class="form-select br-select" 
                            name="municipioBeneficiado"
                            required
                            :disabled="estadoBeneficiado == '' || buscandoBeneficiado"
                            v-model="municipioBeneficiado">
                            <option value="" v-text="textoEscolhaMunicipioBeneficiado"></option>
                            <option v-for="municipioBeneficiado in municipioBeneficiados" v-text="municipioBeneficiado.ds_municipio" :value="municipioBeneficiado.id" :key="municipioBeneficiado.id"></option>
                        </select>    
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="br-button danger mr-3" data-bs-dismiss="modal">Fechar</button>
                <button class="br-button info mr-3" type="submit">Adicionar</button>
            </div>
            </div>
        </div>
    </form>

    </div><!-- modal -->

</div>  
      
</template>

<script>
    export default {
        props:['url','dados','municipiosbeneficiados','tipousuario','token','action'],
        data(){
            return{
                cod_bndes:'',
                estados:'',
                estado:'',
                municipios: '',
                municipio:'',
                textoEscolhaMunicipio: "Filtre o Estado",
                estadoBeneficiados:'',
                estadoBeneficiado:'',
                municipioBeneficiados: '',
                municipioBeneficiado:'',
                textoEscolhaMunicipioBeneficiado: "Filtre o Estado",
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
                cod_saci:'',
                cod_mcidades:'',
                num_carta_consulta_m_cidades:'',
                num_contrato:'',
                cod_projeto:'',
                num_operacoes:'',
                num_chamada:'',
                txt_modalidade:'',
                txt_obra:'',
                num_pac1_pac2:'',
                id_uf:'',
                sg_uf:'',
                txt_municipio_principal:'',
                municipio_id:'',
                txt_local_da_intervencao:'',
                qtd_familias_atendidas:'',
                txt_proponente:'',
                txt_municipios_sem_tratamento:'',
                txt_objeto:'',
                txt_descricao_do_objeto:'',
                vlr_investimento:0,
                vlr_ogu:0,
                vlr_financiamento:0,
                vlr_contrapartida:0,
                txt_andamento:'',
                txt_situacao_obra:'',
                txt_situacao_contrato:0,
                prc_execucao_atual:0,
                vlr_investimento_atualizado:0,
                vlr_ogu_atualizado:0,
                vlr_financiamento_atualizado:0,
                vlr_contrapartida_atualizada:0,
                vlr_liberacoes:0,
                dte_previsao_assinatura_contrato:'',
                dte_assinatura_contrato:'',               
                dte_previsao_conclusao_bndes:'',
                dte_previsao_inicio:'',
                dte_efetivo_inicio_empreendimento:'',
                dte_previsao_conclusao:'',
                dte_efetivo_termino_do_empreendimento:'',
                txt_sintese_da_situacao_atual_do_projeto:'',
                txt_servicos_executados:'',
                dte_carga:'',
                dte_atualizacao_sintese_atual_do_projeto:'',
                txt_gerente:'',
                num_ramal:'',
                txt_email:'',
                txt_monitor_mcidades:'',
                txt_tecnico_responsavel:'',
                dte_inauguracao:'',
                dte_ult_liberacao:'',
                vlr_desembolso_contrapartida:'',
                btneditar:false,
                classedittextarea:'col col-xs-12 col-sm-6 br-textarea',
                classeditselect:'form-select br-select br-input',
                classeditmun:'form-select br-select br-input',
                classeditinput:'',
                bln_conferir_municipios:'',
                btneditarmun:false,
                expandir:false,
                bln_erros: false,
                errors:{percentual:false, dte_previsao_menor:false,vlr_investimento_atual:false,atualizaMunicipio:false},    
                soma_investimento_atualizado:0, 

            }        
        },
        computed:{
            
        },
        methods:{
            onChangeEstadoBeneficiado() {
                this.textoEscolhaMunicipioBeneficiado = "Buscando...";
                this.municipioBeneficiado = '';
                this.buscandoBeneficiado = true;
                if(this.estadoBeneficiado != '') {
                    //busca dados no banco de dados para carregar no componente
                    axios.get(this.url + '/api/municipios/' + this.estadoBeneficiado).then(resposta => {
                        this.textoEscolhaMunicipioBeneficiado = "Escolha um municipio:";
                        this.buscandoBeneficiado = false;
                        this.municipioBeneficiados = resposta.data;
                        console.log(this.municipioBeneficiados);
                    }).catch(error => {
                        console.log(error);
                    });
                  
                } else {
                    this.buscandoBeneficiado = false;
                    this.municipioBeneficiado = '';
                    this.textoEscolhaMunicipioBandeficiado = "Filtre o Estado"
                }            
            },
            checkForm: function () {
                this.bln_erros = false;


	//
                if(this.situacaoObra == 9 || this.situacaoObra == 10){
                    if(this.prc_execucao_atual < 100){
                        this.errors.percentual = true;
                        this.bln_erros = true;                
                    }
                }

                if(!this.estado || !this.municipio){                    
                    this.errors.atualizaMunicipio = true;
                    this.bln_erros = true;      
                }

                
                if(!this.dte_previsao_conclusao){
                    this.errors.dte_previsao_menor = true;
                    this.bln_erros = true; 
                }else if((this.andamento != 3 || this.situacaoContrato == 1)  && !this.dados.dte_previsao_conclusao ){
                    let date1 = new Date(this.dte_previsao_conclusao); 
                    let date2 = new Date(); 
                    if (date1.getTime() < date2.getTime()){
                        this.errors.dte_previsao_menor = true;
                        this.bln_erros = true;                
                    }
                }

                this.soma_investimento_atualizado = Number(this.vlr_financiamento_atualizado) + Number(this.vlr_ogu_atualizado) + Number(this.vlr_contrapartida_atualizada);
                this.vlr_investimento_atualizado = parseFloat(Number(this.soma_investimento_atualizado));

                if(Number(this.soma_investimento_atualizado) == 0){                    
                    this.errors.vlr_investimento_atual = true;
                    this.bln_erros = true;                                    
                }


               
                if(!this.bln_erros){                   
                    console.log('Sem erros: ' + this.bln_valor_incorreto +' - '+ this.bln_erros);
                    document.getElementById('form_edit_bndes').submit(); 
                }
            },
            onChangeAndamento(){
                /*
                axios.get(this.url + '/api/bndes/situacao_obra/andamento/'+ this.andamento).then(resposta => {
                    //console.log(resposta.data);
                    this.situacaoObras = resposta.data;
                    }).catch(erro => {
                        console.log(erro);
                    })
                  */  
                if(this.andamento == 3){
                    this.situacaoObra = 9;
                }else if(this.andamento == 4){
                    this.situacaoObra = 10;
                }else if(this.andamento == 5){
                    this.situacaoObra = 10;
                }else if(this.andamento == 1 || this.andamento == 6 || this.andamento == 7){
                    this.situacaoObra = 2;
                }else if(this.andamento == 8){
                    this.situacaoObra = 8;
                }else{
                    this.situacaoObra = '';
                }
               
            },
            onChangeSituacaoObra(){
                 
                if(this.situacaoObra == 9){
                    this.andamento = 3;
                }else if(this.situacaoObra == 10){
                    this.andamento = 4;
                }else if(this.situacaoObra == 10){
                    this.andamento = 5;
                }else if(this.situacaoObra == 8){
                    this.andamento = 8;
                }else if(this.situacaoObra == 1 || this.situacaoObra == 3 || this.situacaoObra == 5 || this.situacaoObra == 4 || this.situacaoObra == 6 || this.situacaoObra == 7 || this.situacaoObra == 12){
                    this.andamento = 2;
                }else{
                    this.andamento = '';
                }
               
            },
            onChangeValorInvestimento(){
                let vlrOgu = parseFloat(this.vlr_ogu_atualizado);
                let vlrFinanc = parseFloat(this.vlr_financiamento_atualizado);
                let vlrContra = parseFloat(this.vlr_contrapartida_atualizada);
                this.vlr_investimento_atualizado = vlrOgu + vlrFinanc +vlrContra;
            },
            editarDados($habilitar){
                if($habilitar){
                    this.btneditar = true;
                    this.classedittextarea='col col-xs-12 col-sm-6 br-textarea success';
                    this.classeditselect='form-select br-select br-input border border-2 border-success';
                    this.classeditinput='border border-2 border-success';
                    this.expandir = true;
                    console.log(this.bln_conferir_municipios);
                    if(this.bln_conferir_municipios){
                        this.classeditmun='form-select br-select br-input border border-2 border-success';
                        this.btneditarmun = true;
                    }

                }else{
                    this.btneditar = false;
                    this.btneditarmun = false;
                    this.classedittextarea='col col-xs-12 col-sm-6 br-textarea';
                    this.classeditselect='form-select br-select br-input';
                    this.classeditmun='form-select br-select br-input';
                    this.classeditinput='';
                    this.expandir = false;
                    
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
             formatarData(data) {
                if (data) {   
                    const novaData = data.toLocaleDateString('pt-BR');
                    return novaData;
                } else {
                    return '';
                }
            }, 
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
                    }).catch(error => {
                        console.log(error);
                    });
                  
                } else {
                    this.buscando = false;
                    this.municipio = '';
                    this.textoEscolhaMunicipio = "Filtre o Estado"
                }            
            },
            
        },
        mounted() {
            //console.log(this.form._token);
            axios.get(this.url + '/api/ufs').then(resposta => {
                //console.log(resposta.data);
                this.estados = resposta.data;
                this.estadoBeneficiados = resposta.data;
               
                }).catch(erro => {
                    console.log(erro);
                })
           


            axios.get(this.url + '/api/bndes/andamento').then(resposta => {
                //console.log(resposta.data);
                this.andamentos = resposta.data;
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
                this.status_licitacaos = resposta.data;
                this.status_licitacao = '';
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

              
                if(this.dados){

                    this.cod_bndes = this.dados.cod_bndes;
                    this.cod_saci = this.dados.cod_saci;
                    this.cod_mcidades = this.dados.cod_mcidades;
                    this.num_carta_consulta_m_cidades = this.dados.num_carta_consulta_m_cidades;
                    this.num_contrato = this.dados.num_contrato;
                    this.cod_projeto = this.dados.cod_projeto;
                    this.num_operacoes = this.dados.num_operacoes;
                    this.num_chamada = this.dados.num_chamada;
                    this.txt_modalidade = this.dados.txt_modalidade;
                    this.txt_obra = this.dados.txt_obra;
                    this.num_pac1_pac2 = this.dados.num_pac1_pac2;
                    this.estado = this.dados.id_uf;

                    this.onChangeEstado();

                    this.sg_uf = this.dados.sg_uf;
                    this.txt_municipio_principal = this.dados.txt_municipio_principal;
                    this.municipio = this.dados.municipio_id;
                    

                    this.txt_local_da_intervencao = this.dados.txt_local_da_intervencao;
                    this.qtd_familias_atendidas = parseInt(this.dados.qtd_familias_atendidas);
                    this.txt_municipios_sem_tratamento = this.dados.txt_municipios_sem_tratamento;
                    this.txt_proponente = this.dados.txt_proponente;
                    this.txt_objeto = this.dados.txt_objeto;
                    this.txt_descricao_do_objeto = this.dados.txt_descricao_do_objeto;

                    this.vlr_investimento = this.dados.vlr_investimento;
                    if(!this.dados.vlr_investimento){
                        this.vlr_investimento = 0.00;
                    }else{
                        this.vlr_investimento = Number(this.dados.vlr_investimento);
                    }

                    if(!this.dados.vlr_ogu){
                        this.vlr_ogu = 0.00;
                    }else{
                        this.vlr_ogu = Number(this.dados.vlr_ogu);
                    }

                    if(!this.dados.vlr_financiamento){
                        this.vlr_financiamento = 0.00;
                    }else{
                        this.vlr_financiamento = Number(this.dados.vlr_financiamento);
                    }

                    if(!this.dados.vlr_contrapartida){
                        this.vlr_contrapartida = 0.00;
                    }else{
                        this.vlr_contrapartida = Number(this.dados.vlr_contrapartida);
                    }
                   

                    this.txt_andamento = this.dados.txt_andamento;
                    this.andamento = this.dados.andamento_id;
                    this. txt_situacao_obra = this.dados.txt_situacao_obra;
                    this. situacaoObra = this.dados.situacao_obra_id;

                    
                    this.txt_situacao_contrato = this.dados.txt_situacao_contrato;
                    
                    if(!this.dados.prc_execucao_atual){
                        this.prc_execucao_atual = 0.00;
                    }else{
                        this.prc_execucao_atual = Number(this.dados.prc_execucao_atual);
                    }
                    

                    if(!this.dados.vlr_investimento_atualizado){
                        this.vlr_investimento_atualizado = 0.00;
                    }else{
                        this.vlr_investimento_atualizado = Number(this.dados.vlr_investimento_atualizado);
                    }

                    if(!this.dados.vlr_ogu_atualizado){
                        this.vlr_ogu_atualizado = 0.00;
                    }else{
                        this.vlr_ogu_atualizado = Number(this.dados.vlr_ogu_atualizado);
                    }

                    if(!this.dados.vlr_financiamento_atualizado){
                        this.vlr_financiamento_atualizado = 0.00;
                    }else{
                        this.vlr_financiamento_atualizado = Number(this.dados.vlr_financiamento_atualizado);
                    }

                    if(!this.dados.vlr_contrapartida_atualizada){
                        this.vlr_contrapartida_atualizada = 0.00;
                    }else{
                        this.vlr_contrapartida_atualizada = Number(this.dados.vlr_contrapartida_atualizada);
                    }


                   

                    this.dte_previsao_assinatura_contrato = this.dados.dte_previsao_assinatura_contrato;
                    this.dte_assinatura_contrato = this.dados.dte_assinatura_contrato;
                    
                    this.dte_previsao_conclusao_bndes = this.dados.dte_previsao_conclusao_bndes;
                    this.dte_previsao_inicio = this.dados.dte_previsao_inicio;
                    this.dte_efetivo_inicio_empreendimento = this.dados.dte_efetivo_inicio_empreendimento;
                    this.dte_previsao_conclusao = this.dados.dte_previsao_conclusao;
                    this.dte_efetivo_termino_do_empreendimento = this.dados.dte_efetivo_termino_do_empreendimento;
                
                    this.txt_sintese_da_situacao_atual_do_projeto = this.dados.txt_sintese_da_situacao_atual_do_projeto;
                    this.txt_servicos_executados = this.dados.txt_servicos_executados;

                    this.dte_carga = this.dados.dte_carga;
                    this.dte_atualizacao_sintese_atual_do_projeto  = this.dados.dte_atualizacao_sintese_atual_do_projeto;

                    this.txt_gerente = this.dados.txt_gerente;
                    this.num_ramal = this.dados.num_ramal;
                    this.txt_email = this.dados.txt_email;
                    this.txt_monitor_mcidades = this.dados.txt_monitor_mcidades;
                    this.txt_tecnico_responsavel = this.dados.txt_tecnico_responsavel;
                    this.dte_inauguracao = this.dados.dte_inauguracao;
                    this.dte_ult_liberacao = this.dados.dte_ult_liberacao;
                   
                    if(!this.dados.vlr_desembolso_contrapartida){
                        this.vlr_desembolso_contrapartida = 0.00;
                    }else{
                        this.vlr_desembolso_contrapartida = Number(this.dados.vlr_desembolso_contrapartida);
                    }

                    if(!this.dados.vlr_liberacoes){
                        this.vlr_liberacoes = 0.00;
                    }else{
                        this.vlr_liberacoes = Number(this.dados.vlr_liberacoes);
                    }

                    this.bln_conferir_municipios = this.dados.bln_conferir_municipios;

                    

                    
                    

                    
                    
                }
                
                
        }
       
            
    }
</script>
