
<div id="pac-caixa_base" class="container-fluid">
    <div class="row">
        <div class="col col-sm-6">
            <div class="card" >
                <div class="card-header text-white bg-blue-50 border-blue-50">
                    <strong>Informações Gerais</strong>
                  </div>
                <div class="card-body">      
                    <div class="container-fluid">
                        <div class="row">
                           <div class="col col-sm-2">
                              <div class="br-input field-visbasecaixa-uf">
                                 <label class="control-label" for="visbasecaixa-uf">UF</label>
                                 <input type="text" id="visbasecaixa-uf" name="uf" value="{{$contratoBaseCaixa->uf}}" readonly="">
                                 <p class="help-block help-block-error"></p>
                              </div>
                           </div>
                           <div class="col col-sm-4">
                              <div class="br-input field-visbasecaixa-contrato">
                                 <label class="control-label" for="visbasecaixa-contrato">Contrato</label>
                                 <input type="text" id="visbasecaixa-contrato" name="contrato" value="{{$contratoBaseCaixa->contrato}}" readonly="">
                                 <p class="help-block help-block-error"></p>
                              </div>
                           </div>
                           <div class="col col-sm-6" style="background-color: #ff9999">
                              <div class="br-input field-visbasecaixa-situacao_da_obra">
                                 <label class="control-label" for="visbasecaixa-situacao_da_obra">Situação do objeto</label>
                                 <input type="text" id="visbasecaixa-situacao_da_obra" name="situacao_da_obra"  value="{{$contratoBaseCaixa->situacao_da_obra}}" readonly="">
                                 <p class="help-block help-block-error"></p>
                              </div>
                           </div>
                           <div class="col col-sm-6">
                              <div class="br-input field-visbasecaixa-municipio_tomador">
                                 <label class="control-label" for="visbasecaixa-municipio_tomador">Tomador</label>
                                 <input type="text" id="visbasecaixa-municipio_tomador" name="municipio_tomador" value="{{$contratoBaseCaixa->municipio_tomador}}" readonly="">
                                 <p class="help-block help-block-error"></p>
                              </div>
                           </div>
                           <div class="col col-sm-6" style="background-color: #ff9999">
                              <div class="br-input field-visbasecaixa-situacao">
                                 <label class="control-label" for="visbasecaixa-situacao">Situacao Contrato</label>
                                 <input type="text" id="visbasecaixa-situacao" name="situacao" value="{{$contratoBaseCaixa->situacao}}" readonly="">
                                 <p class="help-block help-block-error"></p>
                              </div>
                           </div>
                           <div class="col col-sm-6">
                              <div class="br-input field-visbasecaixa-localidade">
                                 <label class="control-label" for="visbasecaixa-localidade">Localidade</label>
                                 <input type="text" id="visbasecaixa-localidade" name="localidade" value="{{$contratoBaseCaixa->localidade}}" readonly="">
                                 <p class="help-block help-block-error"></p>
                              </div>
                           </div>
                           <div class="col col-sm-3" style="background-color: #ff9999">
                              <div class="br-input field-visbasecaixa-perc_realizado">
                                 <label class="control-label" for="visbasecaixa-perc_realizado">% Físico</label>
                                 <input type="text" id="visbasecaixa-perc_realizado" class="text-right" name="perc_realizado" value="{{number_format( ($contratoBaseCaixa->perc_realizado), 0, ',' , '.')}}" readonly="">
                                 <p class="help-block help-block-error"></p>
                              </div>
                           </div>
                           <div class="col col-sm-3" style="background-color: #ff9999">
                              <div class="br-input field-visbasecaixa-prc_financeiro">
                                 <label class="control-label" for="visbasecaixa-prc_financeiro">% Financeiro</label>
                                 <input type="text" id="visbasecaixa-prc_financeiro" class="text-right" name="prc_financeiro" value="{{number_format( ($contratoBaseCaixa->prc_financeiro), 0, ',' , '.')}}" readonly="">
                                 <p class="help-block help-block-error"></p>
                              </div>
                           </div>
                           <div class="col col-sm-6">
                              <div class="br-input field-visbasecaixa-logradouro">
                                 <label class="control-label" for="visbasecaixa-logradouro">Logradouro</label>
                                 <input type="text" id="visbasecaixa-logradouro" name="logradouro" value="{{$contratoBaseCaixa->logradouro}}" readonly="">
                                 <p class="help-block help-block-error"></p>
                              </div>
                           </div>
                           <div class="col col-sm-6">
                              <div class="br-input field-visbasecaixa-programa">
                                 <label class="control-label" for="visbasecaixa-programa">Programa</label>
                                 <input type="text" id="visbasecaixa-programa" name="programa" value="{{$contratoBaseCaixa->programa}}" readonly="">
                                 <p class="help-block help-block-error"></p>
                              </div>
                           </div>
                           <div class="col col-sm-12">
                              <div class="br-textarea field-visbasecaixa-empreendimento">
                                 <label class="control-label" for="visbasecaixa-empreendimento">Empreendimento</label>
                                 <textarea id="visbasecaixa-empreendimento" name="empreendimento" rows="2" readonly="">{{$contratoBaseCaixa->empreendimento}}</textarea>
                                 <p class="help-block help-block-error"></p>
                              </div>
                           </div>
                           <div class="col col-sm-12">
                              <div class="br-textarea field-visbasecaixa-objeto">
                                 <label class="control-label" for="visbasecaixa-objeto">Objeto</label>
                                 <textarea id="visbasecaixa-objeto" name="objeto" rows="2" readonly="">{{$contratoBaseCaixa->objeto}}</textarea>
                                 <p class="help-block help-block-error"></p>
                              </div>
                           </div>
                           <div class="col col-sm-3">
                              <div class="br-input field-visbasecaixa-dt_prev_contrata">
                                 <label class="control-label" for="visbasecaixa-dt_prev_contrata">Prev Contr</label>
                                 <input type="text" id="visbasecaixa-dt_prev_contrata" name="dt_prev_contrata" value="@if($contratoBaseCaixa->dt_prev_contrata) {{date('d/m/Y',strtotime($contratoBaseCaixa->dt_prev_contrata))}} @endif" readonly="">
                                 <p class="help-block help-block-error"></p>
                              </div>
                           </div>
                           <div class="col col-sm-3">
                              <div class="br-input field-visbasecaixa-dt_prev_analise">
                                 <label class="control-label" for="visbasecaixa-dt_prev_analise">Prev Análise</label>
                                 <input type="text" id="visbasecaixa-dt_prev_analise" name="dt_prev_analise" value="@if($contratoBaseCaixa->dt_prev_analise) {{date('d/m/Y',strtotime($contratoBaseCaixa->dt_prev_analise))}} @endif" readonly="">
                                 <p class="help-block help-block-error"></p>
                              </div>
                           </div>
                           <div class="col col-sm-3">
                              <div class="br-input field-visbasecaixa-dt_prev_docs">
                                 <label class="control-label" for="visbasecaixa-dt_prev_docs">Prev Docs</label>
                                 <input type="text" id="visbasecaixa-dt_prev_docs" name="dt_prev_docs" value="@if($contratoBaseCaixa->dt_prev_docs) {{date('d/m/Y',strtotime($contratoBaseCaixa->dt_prev_docs))}} @endif" readonly="">
                                 <p class="help-block help-block-error"></p>
                              </div>
                           </div>
                           <div class="col col-sm-3">
                              <div class="br-input field-visbasecaixa-docs_entregues">
                                 <label class="control-label" for="visbasecaixa-docs_entregues">Docs Entregues</label>
                                 <input type="text" id="visbasecaixa-docs_entregues" name="docs_entregues" value="@if($contratoBaseCaixa->docs_entregues == 'S') Sim @endif" readonly="">
                                 <p class="help-block help-block-error"></p>
                              </div>
                           </div>
                           <div class="col col-sm-6">
                              <div class="br-input field-visbasecaixa-origem_do_recurso">
                                 <label class="control-label" for="visbasecaixa-origem_do_recurso">Origem Do Recurso</label>
                                 <input type="text" id="visbasecaixa-origem_do_recurso" name="origem_do_recurso" value="{{$contratoBaseCaixa->origem_do_recurso}}" readonly="">
                                 <p class="help-block help-block-error"></p>
                              </div>
                           </div>
                           <div class="col col-sm-6">
                              <div class="br-input field-visbasecaixa-ident_externo_codigo">
                                 <label class="control-label" for="visbasecaixa-ident_externo_codigo">Ident Externo Codigo</label>
                                 <input type="text" id="visbasecaixa-ident_externo_codigo" name="ident_externo_codigo" value="{{$contratoBaseCaixa->ident_externo_codigo}}" readonly="">
                                 <p class="help-block help-block-error"></p>
                              </div>
                           </div>
                           <div class="col col-sm-6">
                              <div class="br-input field-visbasecaixa-sr">
                                 <label class="control-label" for="visbasecaixa-sr">Sr</label>
                                 <input type="text" id="visbasecaixa-sr" name="sr" value="{{$contratoBaseCaixa->sr}}" readonly="">
                                 <p class="help-block help-block-error"></p>
                              </div>
                           </div>
                           <div class="col col-sm-6">
                              <div class="br-input field-visbasecaixa-gidur_redur">
                                 <label class="control-label" for="visbasecaixa-gidur_redur">Gidur Redur</label>
                                 <input type="text" id="visbasecaixa-gidur_redur" name="gidur_redur" value="{{$contratoBaseCaixa->gidur_redur}}" readonly="">
                                 <p class="help-block help-block-error"></p>
                              </div>
                           </div>
                        </div>
                     </div>
                </div>
            </div>
        </div>
        <div class="col col-sm-3">
            <div class="card" >
                <div class="card-header text-blue-50 bg-blue-10">
                    <strong>Calendário</strong>
                  </div>
                <div class="card-body">      
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col col-sm-12">
                                <div class="br-input field-visbasecaixa-dt_assinatura">
                                   <label class="control-label" for="visbasecaixa-dt_assinatura">Assinatura</label>
                                   <input type="text" id="visbasecaixa-dt_assinatura" class="text-right" name="dt_assinatura" value="@if($contratoBaseCaixa->dt_assinatura) {{date('d/m/Y',strtotime($contratoBaseCaixa->dt_assinatura))}} @endif" readonly="">
                                   <p class="help-block help-block-error"></p>
                                </div>
                                <div class="br-input field-visbasecaixa-data_autorizacao_gestor">
                                   <label class="control-label" for="visbasecaixa-data_autorizacao_gestor">Homologação da SPA</label>
                                   <input type="text" id="visbasecaixa-data_autorizacao_gestor" class="text-right" name="data_autorizacao_gestor" value="@if($contratoBaseCaixa->data_autorizacao_gestor) {{date('d/m/Y',strtotime($contratoBaseCaixa->data_autorizacao_gestor))}} @endif" readonly="">
                                   <p class="help-block help-block-error"></p>
                                </div>
                                <div class="br-input field-visbasecaixa-data_previsao_inicio_de_obra">
                                   <label class="control-label" for="visbasecaixa-data_previsao_inicio_de_obra">Previsão início</label>
                                   <input type="text" id="visbasecaixa-data_previsao_inicio_de_obra" class="text-right" name="data_previsao_inicio_de_obra" value="@if($contratoBaseCaixa->data_previsao_inicio_de_obra) {{date('d/m/Y',strtotime($contratoBaseCaixa->data_previsao_inicio_de_obra))}} @endif" readonly="">
                                   <p class="help-block help-block-error"></p>
                                </div>
                                <div class="br-input field-visbasecaixa-data_inicio_obra">
                                   <label class="control-label" for="visbasecaixa-data_inicio_obra">Início obra</label>
                                   <input type="text" id="visbasecaixa-data_inicio_obra" class="text-right" name="data_inicio_obra" value="@if($contratoBaseCaixa->data_inicio_obra) {{date('d/m/Y',strtotime($contratoBaseCaixa->data_inicio_obra))}} @endif" readonly="">
                                   <p class="help-block help-block-error"></p>
                                </div>
                                <div class="br-input field-visbasecaixa-data_inicio_de_obra_pelo_proponente">
                                   <label class="control-label" for="visbasecaixa-data_inicio_de_obra_pelo_proponente">Início obra proponente</label>
                                   <input type="text" id="visbasecaixa-data_inicio_de_obra_pelo_proponente" class="text-right" name="data_inicio_de_obra_pelo_proponente" value="@if($contratoBaseCaixa->data_inicio_de_obra_pelo_proponente) {{date('d/m/Y',strtotime($contratoBaseCaixa->data_inicio_de_obra_pelo_proponente))}} @endif" readonly="">
                                   <p class="help-block help-block-error"></p>
                                </div>
                                <div class="br-input field-visbasecaixa-datavigencia">
                                   <label class="control-label" for="visbasecaixa-datavigencia">Vigência</label>
                                   <input type="text" id="visbasecaixa-datavigencia" class="text-right" name="datavigencia" value="@if($contratoBaseCaixa->datavigencia) {{date('d/m/Y',strtotime($contratoBaseCaixa->datavigencia))}} @endif" readonly="">
                                   <p class="help-block help-block-error"></p>
                                </div>
                                <div class="br-input field-visbasecaixa-data_autorizacao_caixa">
                                   <label class="control-label" for="visbasecaixa-data_autorizacao_caixa">Autorização CAIXA (AIO)</label>
                                   <input type="text" id="visbasecaixa-data_autorizacao_caixa" class="text-right" name="data_autorizacao_caixa" value="@if($contratoBaseCaixa->data_autorizacao_caixa) {{date('d/m/Y',strtotime($contratoBaseCaixa->data_autorizacao_caixa))}} @endif" readonly="">
                                   <p class="help-block help-block-error"></p>
                                </div>
                                <div class="br-input field-visbasecaixa-data_previsao_termino_pela_gidur">
                                   <label class="control-label" for="visbasecaixa-data_previsao_termino_pela_gidur">Prev. término GIDUR</label>
                                   <input type="text" id="visbasecaixa-data_previsao_termino_pela_gidur" class="text-right" name="data_previsao_termino_pela_gidur" value="@if($contratoBaseCaixa->data_previsao_termino_pela_gidur) {{date('d/m/Y',strtotime($contratoBaseCaixa->data_previsao_termino_pela_gidur))}} @endif" readonly="">
                                   <p class="help-block help-block-error"></p>
                                </div>
                                <div class="br-input field-visbasecaixa-data_previsao_termino_de_obra">
                                   <label class="control-label" for="visbasecaixa-data_previsao_termino_de_obra">Prev. término CAIXA</label>
                                   <input type="text" id="visbasecaixa-data_previsao_termino_de_obra" class="text-right" name="data_previsao_termino_de_obra" value="@if($contratoBaseCaixa->data_previsao_termino_de_obra) {{date('d/m/Y',strtotime($contratoBaseCaixa->data_previsao_termino_de_obra))}} @endif" readonly="">
                                   <p class="help-block help-block-error"></p>
                                </div>
                                <div class="br-input field-visbasecaixa-data_termino_obra">
                                   <label class="control-label" for="visbasecaixa-data_termino_obra">Término obra</label>
                                   <input type="text" id="visbasecaixa-data_termino_obra" class="text-right" name="data_termino_obra" value="@if($contratoBaseCaixa->data_termino_obra) {{date('d/m/Y',strtotime($contratoBaseCaixa->data_termino_obra))}} @endif" readonly="">
                                   <p class="help-block help-block-error"></p>
                                </div>
                             </div>
                        </div>
                    </div>   
                </div>
            </div>
        </div>
        <div class="col col-sm-3">
            <div class="card" >
                <div class="card-header text-white bg-green-30">
                    <strong>Valores R$</strong>
                  </div>
                <div class="card-body">      
                    <div class="container-fluid">
                        <div class="br-input">
                            <div class="br-input field-visbasecaixa-valor_orcamento">
                               <label class="control-label" for="visbasecaixa-valor_orcamento">Orçamento R$</label>
                               <input type="text" id="visbasecaixa-valor_orcamento" class="text-right" name="valor_orcamento" value="{{number_format( ($contratoBaseCaixa->valor_orcamento), 2, ',' , '.')}}" readonly="">
                               <p class="help-block help-block-error"></p>
                            </div>
                            <div class="br-input field-visbasecaixa-valor_contrapartida">
                               <label class="control-label" for="visbasecaixa-valor_contrapartida">Valor Contrapartida R$</label>
                               <input type="text" id="visbasecaixa-valor_contrapartida" class="text-right" name="valor_contrapartida" value="{{number_format( ($contratoBaseCaixa->valor_contrapartida), 2, ',' , '.')}}" readonly="">
                               <p class="help-block help-block-error"></p>
                            </div>
                            <div class="br-input field-visbasecaixa-valor_liberado">
                               <label class="control-label" for="visbasecaixa-valor_liberado">Valor Liberado R$</label>
                               <input type="text" id="visbasecaixa-valor_liberado" class="text-right" name="valor_liberado" value="{{number_format( ($contratoBaseCaixa->valor_liberado), 2, ',' , '.')}}" readonly="">
                               <p class="help-block help-block-error"></p>
                            </div>
                            <div class="br-input field-visbasecaixa-valor_desembolsado_desbloqueado">
                               <label class="control-label" for="visbasecaixa-valor_desembolsado_desbloqueado"> Desbloqueado Repasse R$</label>
                               <input type="text" id="visbasecaixa-valor_desembolsado_desbloqueado" class="text-right" name="valor_desembolsado_desbloqueado" value="{{number_format( ($contratoBaseCaixa->valor_desembolsado_desbloqueado), 2, ',' , '.')}}" readonly="">
                               <p class="help-block help-block-error"></p>
                            </div>
                            <div class="br-input field-visbasecaixa-valor_desembolsado_desbloqueado_cp">
                               <label class="control-label" for="visbasecaixa-valor_desembolsado_desbloqueado_cp">Desbloqueado Ctpa R$</label>
                               <input type="text" id="visbasecaixa-valor_desembolsado_desbloqueado_cp" class="text-right" name="valor_desembolsado_desbloqueado_cp" value="{{number_format( ($contratoBaseCaixa->valor_desembolsado_desbloqueado_cp), 2, ',' , '.')}}" readonly="">
                               <p class="help-block help-block-error"></p>
                            </div>
                            <div class="br-input field-visbasecaixa-contrapartida2">
                               <label class="control-label" for="visbasecaixa-contrapartida2">Rendimentos Utilizados R$</label>
                               <input type="text" id="visbasecaixa-contrapartida2" class="text-right" name="contrapartida2" value="{{number_format( ($contratoBaseCaixa->contrapartida2), 2, ',' , '.')}}" readonly="">
                               <p class="help-block help-block-error"></p>
                            </div>
                         </div>
                    </div>   
                </div>
            </div>
        </div>

    </div><!-- row -->
</br>
    <div class="row">
        <div class="col col-sm-9">
            <div class="card" >
                <div class="card-header text-white bg-blue-50 border-blue-50">
                    <strong>Descrição da obra</strong>
                  </div>
                <div class="card-body"> 
                    <div class="row">
                        <div class="col col-sm-6">
                            <div class="br-textarea field-visbasecaixa-ident_externo_codigo">
                                <label class="control-label" for="visbasecaixa-justificativa_de_obra">Justificativa De Obra</label>
                                <textarea id="visbasecaixa-justificativa_de_obra" name="justificativa_de_obra" rows="3" readonly="">{{$contratoBaseCaixa->justificativa_de_obra}}</textarea>
    
                            </div>
                        </div>
                        <div class="col col-sm-6">
                            <div class="br-textarea field-visbasecaixa-ident_externo_codigo">
                                <label class="control-label" for="visbasecaixa-ultima_providencia_de_obra">Ultima Providencia De Obra</label>
                                <textarea id="visbasecaixa-ultima_providencia_de_obra" name="ultima_providencia_de_obra" rows="3" readonly="">{{$contratoBaseCaixa->ultima_providencia_de_obra}}</textarea>
                            </div>
                        </div>
                     </div>
                </div>                    
            </div>
        </br>
        @if($contratoPAC->cod_situacao_obra == 19)
            <div class="card" >
                <div class="card-header text-white bg-green-30">
                    <strong>Detalhes de paralisação, caso a obra esteja paralisada há mais de 12 meses ou Portaria nº 348</strong>
                  </div>
                <div class="card-body"> 
                    @if(!$paralisada->detalhe_motivo)
                    Não há informações sobre paralisação desta obra.	
                    @else
                        <div class="br-textarea field-visbasecaixa-ident_externo_codigo">
                            <label class="control-label" for="visbasecaixa-detalhe_motivo">Detalhe Motivo</label>
                            <textarea id="visbasecaixa-detalhe_motivo" name="detalhe_motivo" rows="3" readonly="">{{$paralisada->detalhe_motivo}}</textarea>

                        </div>
                        <div class="br-textarea field-visbasecaixa-ident_externo_codigo">
                            <label class="control-label" for="visbasecaixa-txt_obs">Observações</label>
                            <textarea id="visbasecaixa-txt_obs" name="txt_obs" rows="3" readonly="">{{$paralisada->txt_obs}}</textarea>

                        </div>
                    @endif
                </div>
                
            </div>
            @endif
        </div>
        <div class="col col-sm-3">
         @if($pendeciasCaixa)
            <div class="card" >
                <div class="card-header  bg-secundary border-blue-50">
                    <strong>Obra Física</strong>
                  </div>
                <div class="card-body"> 
                    <div class="br-input field-pendenciascaixatabobrafisica-dataterminoobrafisica">
                        <label class="control-label" for="pendenciascaixatabobrafisica-dataterminoobrafisica">Data do terminou da obra física.</label>
                        <input type="text" id="pendenciascaixatabobrafisica-dataterminoobrafisica" class="text-right" name="PendenciasCaixaTabObraFisica[dataterminoobrafisica" value="@if($pendeciasCaixa->dataterminoobrafisica) {{date('d/m/Y',strtotime($pendeciasCaixa->dataterminoobrafisica))}} @endif" readonly="">
                        <p class="help-block help-block-error"></p>
                     </div>
                     <div class="br-checkbox">
                        <input id="check-state-checked" name="pendenciascaixatabobrafisica-obrafisica" type="checkbox" @if($pendeciasCaixa->obrafisica == 'S')checked="checked"@endif/>
                        <label for="check-state-checked">Obra Fisica Concluída?</label>
                     </div>
                     <div class="br-checkbox">
                        <input id="check-state-checked" name="pendenciascaixatabobrafisica-tts" type="checkbox" @if($pendeciasCaixa->tts == 'S')checked="checked"@endif/>
                        <label for="check-state-checked"> TTS Concluído?</label>
                     </div>
                     <div class="br-checkbox">
                        <input id="check-state-checked" name="pendenciascaixatabobrafisica-regfundiaria" type="checkbox" @if($pendeciasCaixa->regfundiaria == 'S')checked="checked"@endif/>
                        <label for="check-state-checked">  Regularização Fundiaria Ok?</label>
                     </div>
                     <div class="br-checkbox">
                        <input id="check-state-checked" name="pendenciascaixatabobrafisica-usosaldoresidual" type="checkbox" @if($pendeciasCaixa->usosaldoresidual == 'S')checked="checked"@endif/>
                        <label for="check-state-checked">  Usou Saldo Residual?</label>
                     </div>
                     <div class="br-checkbox">
                        <input id="check-state-checked" name="pendenciascaixatabobrafisica-usorendimento" type="checkbox" @if($pendeciasCaixa->usorendimento == 'S')checked="checked"@endif/>
                        <label for="check-state-checked">   Usou Rendimento?</label>
                     </div>
                     
                </div>
                
            </div>
            @endif
        </div>
    </div><!-- row -->

</div><!-- pac-caixa_base -->