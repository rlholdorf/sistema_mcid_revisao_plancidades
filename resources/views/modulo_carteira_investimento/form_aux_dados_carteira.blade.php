    <div class="card" >
        <div class="card-header text-white text-blue-50 bg-blue-10">
            <strong>Códigos do Contrato</strong>
        </div>
        <div class="card-body">      
            <div class="container-fluid">
                <div class="form-group">                            
                    <div class="row">
                        <div class="col col-xs-12 col-sm-3 br-input">        
                            <label for="input-default">Código TCI</label>
                            <input id="cod_tci" name="cod_tci" type="text" value="{{$carteira->cod_tci}}"  readonly=""/>                
                        </div>  
                        <div class="col col-xs-12 col-sm-3 br-input">        
                            <label for="input-default">Nº Convênio</label>
                            <input id="num_convenio" name="num_convenio" type="text" value="{{html_entity_decode($carteira->num_convenio)}}"  readonly=""/>
                        </div>
                        <div class="col col-xs-12 col-sm-3 br-input">        
                            <label for="input-default">Código Contrato</label>
                            <input id="cod_contrato" name="cod_contrato" type="text" value="{{$carteira->cod_contrato}}"  readonly=""/>                            
                        </div>
                        <div class="col col-xs-12 col-sm-3 br-input">     
                            <label for="input-default">Código SACI</label>
                            <input id="cod_saci" name="cod_saci" type="text" value="{{$carteira->cod_saci}}"  readonly=""/>                                       
                        </div>
                    </div><!-- row -->
                    <div class="row">
                        <div class="col col-xs-12 col-sm-3 br-input">        
                            <label for="input-default">Código MDR antigo</label>
                            <input id="cod_mdr_antigo" name="cod_mdr_antigo" type="text" value="{{$carteira->cod_mdr_antigo}}"  readonly=""/>                
                        </div>  
                        <div class="col col-xs-12 col-sm-3 br-input">        
                            <label for="input-default">Código Operação</label>
                            <input id="cod_operacao" name="cod_operacao" type="text" value="{{$carteira->cod_operacao}}{{$carteira->cod_dv}}"  readonly=""/>
                        </div>
                        <div class="col col-xs-12 col-sm-3 br-input">        
                            <label for="input-default">Código Proposta</label>
                            <input id="cod_proposta" name="cod_proposta" type="text" value="{{$carteira->cod_proposta}}"  readonly=""/>                            
                        </div>
                        <div class="col col-xs-12 col-sm-3 br-input">     
                            <label for="input-default">Nº Proposta</label>
                            <input id="num_proposta" name="num_proposta" type="text" value="{{$carteira->num_proposta}}"  readonly=""/>                                       
                        </div>
                    </div><!-- row -->
                    
                </div><!-- form-group-->
        </div><!-- container-fluid-->
    </div><!-- card-body-->
    </div><!-- card-->
    <span class="br-divider my-3"></span>
            <div class="card" >
                <div class="card-header text-white text-red-50 bg-red-10">
                    <strong>Dados do Objeto</strong>
                  </div>
                <div class="card-body">      
                    <div class="container-fluid">
                        <div class="form-group">                            
                            <div class="row">
                                <div class="col col-xs-12 col-sm-2 br-input">        
                                    <label for="input-default">UF</label>
                                    <input id="uf" name="uf" type="text" value="{{$carteira->txt_uf}}"  readonly=""/>                
                                </div>  
                                <div class="col col-xs-12 col-sm-3 br-input">        
                                    <label for="input-default">Município</label>
                                    <input id="municipio" name="municipio" type="text" value="{{html_entity_decode($carteira->txt_municipio)}}"  readonly=""/>
                                </div>
                                <div class="col col-xs-12 col-sm-2 br-input">        
                                    <label for="input-default">Carteira Cidades</label>
                                    <input id="bln_carteira_mcid" name="bln_carteira_mcid" type="text" value="{{$carteira->bln_carteira_mcid}}"  readonly=""/>
                                    
                                </div>
                                <div class="col col-xs-12 col-sm-2 br-input">     
                                    <label for="input-default">Carteira Ativa</label>
                                    <input id="bln_carteira_ativa_mcid" name="bln_carteira_ativa_mcid" type="text" value="{{$carteira->bln_carteira_ativa_mcid}}"  readonly=""/>                                       
                                </div>
                                <div class="col col-xs-12 col-sm-3 br-input">        
                                    <label for="input-default">Em andamento</label>
                                    <input id="bln_carteira_andamento" name="bln_carteira_andamento" type="text" value="{{$carteira->bln_carteira_andamento}}"  readonly=""/>
                                </div>
                            </div><!-- row -->
                            
                            <div class="row">
                                <div class="col col-xs-12 col-sm-3 br-input">        
                                    <label for="input-default">Situação Contrato</label>
                                    <input id="dsc_situacao_contrato_mcid" name="dsc_situacao_contrato_mcid" type="text" value="{{$carteira->dsc_situacao_contrato_mcid}}"  readonly=""/>                
                                </div>  
                                <div class="col col-xs-12 col-sm-3 br-input">        
                                    <label for="input-default">Situação  Objeto</label>
                                    <input id="dsc_situacao_objeto_mcid" name="dsc_situacao_objeto_mcid" type="text" value="{{html_entity_decode($carteira->dsc_situacao_objeto_mcid)}}"  readonly=""/>
                                </div>
                                <div class="col col-xs-12 col-sm-3 br-input">        
                                    <label for="input-default">Data de Assinatura</label>
                                    <input id="dte_assinatura_contrato" name="dte_assinatura_contrato" type="date" value="{{$carteira->dte_assinatura_contrato}}"  readonly=""/>
                                </div>
                                <div class="col col-xs-12 col-sm-3 br-input">        
                                    <label for="input-default">Data Fim Contrato</label>
                                    <input id="dte_assinatura_contrato" name="dte_assinatura_contrato" type="date" value="{{$carteira->dte_fim_contrato}}"  readonly=""/>
                                </div>
                            </div><!-- row -->
                            <div class="row">
                                <div class="col col-xs-12 col-sm-2 br-input">        
                                    <label for="input-default">Fonte</label>
                                    <input id="txt_fonte" name="txt_fonte" type="text" value="{{$carteira->txt_fonte}}"  readonly=""/>                
                                </div>  
                                <div class="col col-xs-12 col-sm-2 br-input">        
                                    <label for="input-default">Subfonte</label>
                                    <input id="dsc_sub_fonte" name="dsc_sub_fonte" type="text" value="{{$carteira->dsc_sub_fonte}}"  readonly=""/>                
                                </div>  
                                <div class="col col-xs-12 col-sm-2 br-input">        
                                    <label for="input-default">Secretaria</label>
                                    <input id="txt_secretaria" name="txt_secretaria" type="text" value="{{$carteira->txt_sigla_secretaria}}"  readonly=""/>     
                                </div> 
                                <div class="col col-xs-12 col-sm-3 br-input">        
                                    <label for="input-default">Origem</label>
                                    <input id="txt_origem" name="txt_origem" type="text" value="{{$carteira->txt_origem}}"  readonly=""/>                
                                </div> 
                                <div class="col col-xs-12 col-sm-3 br-input">        
                                    <label for="input-default">Fase PAC</label>
                                    <input id="dsc_fase_pac" name="dsc_fase_pac" type="text" value="{{$carteira->dsc_fase_pac}}"  readonly=""/>     
                                </div> 
                            </div><!-- row -->
                        </div><!-- form-group-->
                        @if(!$carteira->txt_secretaria && Auth::user())
                                        <button type="button" class="br-button block secondary mr-3" aria-label="Ícone ilustrativo" data-bs-toggle="modal" data-bs-target="#editarSecretaria">
                                            <i class="fas fa-edit" aria-hidden="true"></i>Corrigir Secretaria
                                        </button>   
                                    @endif
                </div><!-- container-fluid-->
            </div><!-- card-body-->
        </div><!-- card-->
        <span class="br-divider my-3"></span>

        <div class="card" >
            <div class="card-header text-white text-green-50 bg-green-10">
                <strong>Valores R$</strong>
              </div>
            <div class="card-body">      
                <div class="container-fluid">
                    
                    <div class="row">
                        <div class="col col-xs-12 col-sm-4 br-input">        
                            <label for="input-default">Investimento</label>
                            <input id="vlr_investimento" name="vlr_investimento" type="text" value="{{number_format($carteira->vlr_investimento, 2, ',' , '.')}}" readonly="">
                        </div>
                        <div class="col col-xs-12 col-sm-4 br-input">        
                            <label for="input-default">Repasse</label>
                            <input id="vlr_repasse" name="vlr_repasse" type="text" value="{{number_format($carteira->vlr_repasse, 2, ',' , '.')}}" readonly="">
                        </div>
                        <div class="col col-xs-12 col-sm-4 br-input">        
                            <label for="input-default">Contrapartida</label>
                            <input id="vlr_contrapartida" name="vlr_contrapartida" type="text" value="{{number_format($carteira->vlr_contrapartida, 2, ',' , '.')}}" readonly="">
                        </div>
                    </div><!-- row -->
                    <div class="row">
                        <div class="col col-xs-12 col-sm-4 br-input">        
                            <label for="input-default">Empenhado</label>
                            <input id="vlr_empenhado" name="vlr_empenhado" type="text" value="{{number_format($carteira->vlr_empenhado, 2, ',' , '.')}}" readonly="">
                        </div>
                        <div class="col col-xs-12 col-sm-4 br-input">        
                            <label for="input-default">Desembolsado</label>
                            <input id="vlr_desembolsado" name="vlr_desembolsado" type="text" value="{{number_format($carteira->vlr_desembolsado, 2, ',' , '.')}}" readonly="">
                        </div>
                        <div class="col col-xs-12 col-sm-4 br-input">        
                            <label for="input-default">Desbloqueado (Executado)</label>
                            <input id="vlr_desbloqueado" name="vlr_desbloqueado" type="text" value="{{number_format($desbloqueios->SUM('vlr_desbloqueado'), 2, ',' , '.')}}" readonly="">
                        </div>
                    </div><!-- row -->
                        
                </div>
            </div>
        </div>

        <span class="br-divider my-3"></span>

        @if(count($municipios) > 1)
        
        <div class="card" >
            <div class="card-header text-white bg-blue-60">
                <strong>Municípios Beneficiados</strong>
              </div>
            <div class="card-body">      
                <div class="container-fluid">
                    <div id="grid-exibicao-container" class="table-responsive kv-grid-container">
                        <table class="kv-grid-table table table-bordered table-striped">                           
                            <thead>
                                <tr>
                                    <th class="text-center kv-align-middle kv-align-center" style="max-width: 50px; width: 13.85%;" data-col-seq="0">#</th>
                                    <th class="text-center" data-col-seq="1" >Região</th>
                                    <th class="text-center" data-col-seq="1" >UF</th>                                    
                                    <th class="text-center" data-col-seq="1" >Município</th>                             
                                    <th class="text-center" data-col-seq="2" >Principal?</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($municipios as $dados) 
                                    <tr data-key="0">
                                        <td class="text-center kv-align-middle kv-align-center" style="width:50px;" data-col-seq="0">{{$loop->index+1}} </td>
                                        <td class="text-center" data-col-seq="1">{{$dados->txt_regiao}}</td>
                                        <td class="text-center" data-col-seq="1">{{$dados->txt_sigla_uf}}</td>
                                        <td class="text-center" data-col-seq="1">{{$dados->txt_municipio}}</td>
                                        <td class="text-center" data-col-seq="2"><code>@if($dados->bln_municipio_principal)(X)@endif</code></td>
                                    </tr>
                                @endforeach    
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    
  
        @endif



    <!-- Modal -->
    <div class="modal fade" id="editarSecretaria" tabindex="-1" aria-labelledby="editarSecretariaLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="editarSecretariaLabel">Corrigir Secretaria</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="form-horizontal" role="form" method="POST" action='{{ url("carteira_investimento/secretaria/update") }}'>         
                {{ csrf_field() }}
                <input type="hidden" id="cod_tci" name="cod_tci" value="{{$carteira->cod_tci}}">
                <div class="modal-body">
                    <select-component
                            :dados="{{json_encode($secretarias)}}"
                            textolabel='Secretaria'
                            nomecampo='cod_secretaria'
                            selecionado='{{$carteira->cod_secretaria}}'
                            textoescolha="Escolha uma Secretaria">
                        </select-component>
                </div>
                <div class="modal-footer">
                   
               
                <button type="submit" class="br-button primary mr-3">Salvar</button>
                <button type="button" class="br-button danger mr-3" data-bs-dismiss="modal">Fechar</button>    
                </div>
            </form>
          </div>
        </div>
      </div>        