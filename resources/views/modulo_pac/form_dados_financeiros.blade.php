<div class="card">    
    <div class="card-body">    
        <div class="form-group">
            <div class="row">
                <div class="col col-sm-3">
                    <div class="br-input">
                        <label class="control-label" >Valor Orçamento</label>
                        <input class="br-input" type="text" id="valor_orcamento" name="valor_orcamento" value="{{number_format( ($dadosFinanceiros->valor_orcamento), 2, ',' , '.')}}" readonly="">
                    </div>
                </div>
                <div class="col col-sm-3">
                    <div class="br-input">
                        <label class="control-label" >Orçamento Alocado</label>
                        <input class="br-input" type="text" id="valor_orcamento_alocado" name="valor_orcamento_alocado" value="{{number_format( ($dadosFinanceiros->valor_orcamento_alocado), 2, ',' , '.')}}" readonly="">
                    </div>
                </div>
                <div class="col col-sm-3">
                    <div class="br-input">
                        <label class="control-label" >Saldo Orçamento</label>
                        <input class="br-input" type="text" id="saldo_orcamento" name="saldo_orcamento" value="{{number_format( ($dadosFinanceiros->valor_orcamento-$dadosFinanceiros->valor_orcamento_alocado), 2, ',' , '.')}}" readonly="">
                    </div>
                </div>
                <div class="col col-sm-3">
                    <div class="br-input">
                        <label class="control-label" >% Orçado</label>
                        <input class="br-input" type="text" id="percentual_orcado" name="percentual_orcado" value="{{number_format( ($dadosFinanceiros->valor_orcamento_alocado/$dadosFinanceiros->valor_orcamento)*100, 2, ',' , '.')}}" readonly="">
                    </div>
                </div>
            </div><!-- row -->
            <div class="row">
                <div class="col col-sm-3">
                    <div class="br-input">
                        <label class="control-label" >Valor Contratado</label>
                        <input class="br-input" type="text" id="valor_contratado" name="valor_contratado" value="{{number_format( ($dadosFinanceiros->valor_contratado), 2, ',' , '.')}}" readonly="">
                    </div>
                </div>
                <div class="col col-sm-3">
                    <div class="br-input">
                        <label class="control-label" >Valor Liberado</label>
                        <input class="br-input" type="text" id="valor_liberado" name="valor_liberado" value="{{number_format( ($dadosFinanceiros->valor_liberado), 2, ',' , '.')}}" readonly="">
                    </div>
                </div>
                <div class="col col-sm-3">
                    <div class="br-input">
                        <label class="control-label" >Saldo a liberar</label>
                        <input class="br-input" type="text" id="saldo_orcamento" name="saldo_orcamento" value="{{number_format( ($dadosFinanceiros->valor_contratado-$dadosFinanceiros->valor_liberado), 2, ',' , '.')}}" readonly="">
                    </div>
                </div>
                <div class="col col-sm-3">
                    <div class="br-input">
                        <label class="control-label" >% Liberado</label>
                        <input class="br-input" type="text" id="percentual_liberado" name="percentual_liberado" value="{{number_format( ($dadosFinanceiros->valor_liberado/$dadosFinanceiros->valor_contratado)*100, 2, ',' , '.')}}" readonly="">
                    </div>
                </div>
                
            </div><!-- row -->            
            
        </div>
    </div><!-- card-body -->
</div>

<div class="card">   
    <div class="card-header">  
        Ordens Bancárias
    </div> 
    <div class="card-body">    
        <div class="form-group">
            <div class="table-responsive">
                <table class="table table-hover">
                     <thead>
                      <tr>
                            <th>Parcela</th>
                            <th>Ordem Bancária</th>
                            <th>Data Liberação</th>                                    				
                            <th>Valor Parcela</th>                                    				
                            <th>Valor Saldo</th>                                    				                                                       				
                      </tr>
                  </thead>										
                  <tbody>
                      @foreach($ordensBancarias as $ob)
                     
                        <tr class="text-center">
                       
                         <td>{{$ob->dsc_parcela}}</td>
                          <td>{{$ob->cod_ordem_bancaria}}</td>   
                          <td>{{date('d/m/Y',strtotime($ob->dte_liberacao))}}</td>                                                                                           
                          <td>{{number_format( ($ob->vlr_parcela), 2, ',' , '.')}}</td>                                    
                          <td>{{number_format( ($ob->vlr_saldo), 2, ',' , '.')}}</td>    
                      </tr>    
                      @endforeach                                                                    
                   </tbody>	
                </table>                          
              </div><!-- div table 1-->
        </div>
    </div><!-- card-body -->
</div>