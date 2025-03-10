<div id="dados-gerais-caracterizacao" >
    
    <div class="row">
        <div class="col col-sm-6">
            <div class="card" >
                <div class="card-header text-white text-blue-50 bg-blue-10">
                    <strong>Objeto</strong>
                  </div>
                <div class="card-body">      
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col col-sm-6">
                                <div class="br-input field-pactabcontratospac-cod_modalidade">
                                    <label class="control-label" for="pactabcontratospac-cod_modalidade">Modalidade</label>
                                    <input type="text" id="pactabcontratospac-cod_modalidade" value="{{$contratoPAC->dsc_modalidade}}" readonly="">
                                    
                                </div>
                            </div>
                            <div class="col col-sm-6">
                                <div class="br-input field-pactabcontratospac-cod_submodalidade">
                                    <label class="control-label" for="pactabcontratospac-cod_submodalidade">Submodalidade</label>
                                    <input type="text" id="pactabcontratospac-cod_submodalidade" value="{{$contratoPAC->dsc_submodalidade}}" readonly="">
                                </div>
                            </div>
                            <div class="col col-sm-12">
                                <div class="br-textarea field-pactabcontratospac-txt_empreendimento">
                                    <label class="control-label" for="pactabcontratospac-txt_empreendimento">Empreendimento</label>
                                    <textarea id="pactabcontratospac-txt_empreendimento" rows="2">{{$contratoPAC->txt_empreendimento}}</textarea>
                                    <div class="help-block"></div>
                                </div>
                            </div>

                            <div class="col col-sm-12">
                                <div class="br-textarea field-pactabcontratospac-txt_objeto">
                                    <label class="control-label" for="pactabcontratospac-txt_objeto">Objeto</label>
                                    <textarea id="pactabcontratospac-txt_objeto" rows="3">{{$contratoPAC->txt_objeto}}</textarea>
                                    <div class="help-block"></div>
                                </div>
                            </div>

                            <div class="col col-sm-12">
                                <div class="br-textarea field-pactabcontratospac-txt_descricao_obj">
                                    <label class="control-label" for="pactabcontratospac-txt_descricao_obj">Descrição detalhada do Objeto</label>
                                    <textarea id="pactabcontratospac-txt_descricao_obj" rows="5">{{$contratoPAC->txt_descricao_obj}}</textarea>
                                    <div class="help-block"></div>
                                </div>
                            </div>

                            <div class="col col-sm-4">
                                <div class="br-input field-pactabcontratospac-qtd_familias_benef">
                                    <label class="control-label" for="pactabcontratospac-qtd_familias_benef">Famílias beneficiadas</label>
                                    <input type="text" id="pactabcontratospac-qtd_familias_benef"  value="{{$contratoPAC->qtd_familias_benef}}" readonly="">
                                    <div class="help-block"></div>
                                </div>
                            </div>

                            <div class="col col-sm-4">
                                <div class="br-input field-pactabcontratospac-km_semob">
                                    <label class="control-label" for="pactabcontratospac-km_semob">Km Totais</label>
                                    <input type="text" id="pactabcontratospac-km_semob" value="{{$contratoPAC->km_semob}}" readonly="">
                                    <div class="help-block"></div>
                                </div>
                            </div>

                            <div class="col col-sm-4">
                                <div class="br-input field-pactabcontratospac-txt_local_intervencao">
                                    <label class="control-label" for="pactabcontratospac-txt_local_intervencao">Área de Intervenção</label>
                                    <input type="text" id="pactabcontratospac-txt_local_intervencao" value="{{$contratoPAC->txt_local_intervencao}}" readonly="">
                                    <div class="help-block"></div>
                                </div>
                            </div>

                            <div class="col col-sm-6">
                                <div class="br-input field-pactabcontratospac-cod_entidade_proponente">
                                    <label class="control-label" for="pactabcontratospac-cod_entidade_proponente">Proponente</label>
                                    <input type="text" id="pactabcontratospac-cod_entidade_proponente" value="{{$contratoPAC->dsc_entidade_proponente}}" readonly="">                                    
                                </div>
                            </div>

                            <div class="col col-sm-6">
                                <div class="br-input field-pactabcontratospac-cod_entidade_executora">
                                    <label class="control-label" for="pactabcontratospac-cod_entidade_executora">Interveniente Executor</label>
                                    <input type="text" id="pactabcontratospac-cod_entidade_executora" value="{{$contratoPAC->dsc_entidade_executora}}" readonly="">
                                </div>
                            </div>  
                        </div><!-- row -->
                    </div>
                </div>
            </div>
        </div><!-- col col-sm-6-->
        <div class="col col-sm-3">
            <div class="card" >
                <div class="card-header text-white text-blue-50 bg-blue-10">
                    <strong>Valores R$</strong>
                  </div>
                <div class="card-body">      
                    <div class="container-fluid">
                        
                        <div class="br-input field-pactabcontratospac-vlr_repasse">
                            <label class="control-label" for="pactabcontratospac-vlr_repasse">Repasse/Financiamento</label>
                            <input type="text" id="pactabcontratospac-vlr_repasse-disp" class="text-right" name="pactabcontratospac-vlr_repasse-disp" value="{{number_format( ($contratoPAC->vlr_repasse), 2, ',' , '.')}}" readonly="">
                            
                            <div class="help-block"></div>
                        </div>
                        <div class="br-input field-pactabcontratospac-vlr_contrapartida">
                            <label class="control-label" for="pactabcontratospac-vlr_contrapartida">Contrapartida</label>
                            <input type="text" id="pactabcontratospac-vlr_contrapartida-disp" class="text-right" name="pactabcontratospac-vlr_contrapartida-disp" value="{{number_format( ($contratoPAC->vlr_contrapartida), 2, ',' , '.')}}" readonly="">
                            <div class="help-block"></div>
                        </div>
                        <div class="br-input field-pactabcontratospac-vlr_selecao">
                            <label class="control-label" for="pactabcontratospac-vlr_selecao">Seleção</label>
                            <input type="text" id="pactabcontratospac-vlr_selecao-disp" class="text-right" name="pactabcontratospac-vlr_selecao-disp" disabled="" value="{{number_format( ($contratoPAC->vlr_contrapartida), 2, ',' , '.')}}" readonly="">
                            <div class="help-block"></div>
                        </div>
                        <div class="br-input field-pactabcontratospac-vlr_contrapartida_selecao">
                            <label class="control-label" for="pactabcontratospac-vlr_contrapartida_selecao">Contrapartida - Seleção</label>
                            <input type="text" id="pactabcontratospac-vlr_contrapartida_selecao-disp" class="text-right" name="pactabcontratospac-vlr_contrapartida_selecao-disp" disabled="" value="{{number_format( ($contratoPAC->vlr_contrapartida), 2, ',' , '.')}}" readonly="">
                            <div class="help-block"></div>
                        </div>
                        <div class="br-input field-vtabcontratospac-vlr_investimento">
                            <label class="control-label" for="vtabcontratospac-vlr_investimento">Investimento (R$)</label>
                            <input type="text" id="vtabcontratospac-vlr_investimento-disp" class="text-right" disabled="" value="{{number_format( ($contratoPAC->vlr_contrapartida), 2, ',' , '.')}}" readonly="">
                            <div class="help-block"></div>
                        </div>
                        <div class="br-input field-vtabcontratospac-vlr_investimento_liquido">
                            <label class="control-label" for="vtabcontratospac-vlr_investimento_liquido">Investimento líquido (R$)</label>
                            <input type="text" id="vtabcontratospac-vlr_investimento_liquido-disp" class="text-right"  disabled="" value="{{number_format( ($contratoPAC->vlr_contrapartida), 2, ',' , '.')}}" readonly="">
                            <div class="help-block"></div>
                        </div>
                        <div class="br-input field-pactabcontratospac-vlr_taxa_administrativa">
                            <label class="control-label" for="pactabcontratospac-vlr_taxa_administrativa">Taxa Administrativa</label>
                            <input type="text" id="pactabcontratospac-vlr_taxa_administrativa-disp" class="text-right" disabled="" value="{{number_format( ($contratoPAC->vlr_contrapartida), 2, ',' , '.')}}" readonly="">
                            <div class="help-block"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- col col-sm-3-->
        <div class="col col-sm-3">
            <div class="card" >
                <div class="card-header text-white bg-green-30">
                    <strong>Municípios Beneficiados</strong>
                  </div>
                <div class="card-body">      
                    <div class="container-fluid">
                        <div id="grid-exibicao-container" class="table-responsive kv-grid-container">
                            <table class="kv-grid-table table table-bordered table-striped">
                                <caption style="display: none; text-align: left;">Código do Contrato: 052193752 <br>Objeto: (Vazio)<br>Município: Serra<br>UF: ESPÍRITO SANTO<br>Área: SEMOB<br>Modalidade: ESTUDOS/EVTE<br>Monitor: rodrigo.moreira<br>Usuário: Sandro  Gonçalves de Sousa Resende<br>Data da exportação: 21-11-2023 10:01:04</caption>
                                <thead>
                                    <tr>
                                        <th class="text-center kv-align-middle kv-align-center" style="max-width: 50px; width: 13.85%;" data-col-seq="0">#</th>
                                        <th class="text-center" data-col-seq="1" style="width: 48.2%;">UF</th>
                                        <th class="text-center" data-col-seq="1" style="width: 48.2%;">Município</th>
                                        <th class="text-center" data-col-seq="2" style="width: 37.95%;">Principal?</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($municipioBeneficiados as $dados) 
                                        <tr data-key="0">
                                            <td class="text-center kv-align-middle kv-align-center" style="width:50px;" data-col-seq="0">{{$loop->index+1}} </td>
                                            <td class="text-center" data-col-seq="1">{{$dados->sg_uf}}</td>
                                            <td class="text-center" data-col-seq="1">{{$dados->ds_municipio}}</td>
                                            <td class="text-center" data-col-seq="2"><code>@if($dados->bln_principal)(X)@endif</code></td>
                                        </tr>
                                    @endforeach    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- col col-sm-3-->



        
    </div><!-- row-->
</div>