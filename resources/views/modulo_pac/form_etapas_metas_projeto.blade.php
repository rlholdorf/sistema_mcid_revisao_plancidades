<div class="card">    
  <div class="card-body">    
    <div class="br-list" role="list">   
        @foreach($dadosContrato->etapasPacs as $etapas)
           
                  
              <div class="br-item" role="listitem" data-toggle="collapse" data-target="l{{$etapas->num_etapa}}">    
                  <div class="content">
                    <div class="flex-fill"><b>{{$etapas->num_etapa}}</b>: {{$etapas->cod_etapa}} - {{$etapas->descricao_etapa}}</div>
                    
                        <i class="fas fa-angle-down" aria-hidden="true"></i>
                      
                  </div>
                </div>
              <span class="br-divider"></span>  
              <div class="br-list" id="l{{$etapas->num_etapa}}" role="list" hidden="hidden">
                </br>
                <div class="card">    
                  <div class="card-body">  
                  <div class="form-group ">
                      <div class="row">
                        <div class="col col-xs-12">
                          <label for="descricao_etapa" class="control-label">Descrição</label>
                          <p class="ml-20">{{$etapas->descricao_etapa}}</p>
                        </div> 
                      </div>
                      <div class="row">
                        <div class="col col-xs-12 col-sm-2">
                          <label for="descricao_etapa" class="control-label">Nº Etapa</label>
                          <p class="ml-20">{{$etapas->num_etapa}}</p>
                        </div>  
                        <div class="col col-xs-12 col-sm-2">
                          <label for="descricao_etapa" class="control-label">% execução</label>
                          <p class="ml-20">{{number_format( ($etapas->perc), 2, ',' , '.')}}%</p>
                        </div> 
                        <div class="col col-xs-12 col-sm-2">
                          <label for="descricao_etapa" class="control-label">Previsão Início</label>
                          <p class="ml-20">@if($etapas->prevetapa){{date('d/m/Y',strtotime($etapas->prevetapa))}}@endif</p>
                        </div>
                        <div class="col col-xs-12 col-sm-2">
                          <label for="descricao_etapa" class="control-label">Início Etapa</label>
                          <p class="ml-20">@if($etapas->efetetapa){{date('d/m/Y',strtotime($etapas->efetetapa))}}@endif</p>
                        </div>  
                        <div class="col col-xs-12 col-sm-2">
                          <label for="descricao_etapa" class="control-label">Previsão Fim</label>
                          <p class="ml-20">@if($etapas->dt_prev_fim_etapa){{date('d/m/Y',strtotime($etapas->dt_prev_fim_etapa))}}@endif</p>
                        </div>
                        <div class="col col-xs-12 col-sm-2">
                          <label for="descricao_etapa" class="control-label">Fim Etapa</label>
                          <p class="ml-20">@if($etapas->dt_fim_etapa){{date('d/m/Y',strtotime($etapas->dt_fim_etapa))}}@endif</p>
                        </div> 
                      </div>                                   
                  </div>
                  <div class="row">
                    <div class="col col-xs-12">
                      <label for="descricao_etapa" class="control-label">Observações</label>
                      <p class="ml-20">{{$etapas->obs}}</p>
                    </div> 
                  </div>
                  @if(count($etapas->metasPacs)>0)
                    <div class="header"><div class="title">Metas da Etapa</div>
                    </div><span class="br-divider"></span>
                  @endif   
                  <div class="br-list" role="list">   
                      @foreach($etapas->metasPacs as $metas)
                        
                                
                            <div class="br-item" role="listitem" data-toggle="collapse" data-target="l{{$metas->num_etapa}}">    
                              <div class="content">
                                <div class="flex-fill"><b>{{$metas->num_etapa}}</b>: {{$metas->cod_etapa}} - {{$metas->descricao_etapa}}</div>
                                
                                    <i class="fas fa-angle-down" aria-hidden="true"></i>
                                  
                              </div>
                            </div>
                            <span class="br-divider"></span>  
                            <div class="br-list" id="l{{$metas->num_etapa}}" role="list" hidden="hidden">
                            </br>
                            <div class="card">    
                              <div class="card-body">  
                                <div class="form-group ">
                                    <div class="row">
                                      <div class="col col-xs-12">
                                        <label for="descricao_etapa" class="control-label">Descrição</label>
                                        <p class="ml-20">{{$metas->descricao_etapa}}</p>
                                      </div> 
                                    </div>
                                    <div class="row">
                                      <div class="col col-xs-12 col-sm-2">
                                        <label for="descricao_etapa" class="control-label">Nº Etapa</label>
                                        <p class="ml-20">{{$metas->num_etapa}}</p>
                                      </div>  
                                      <div class="col col-xs-12 col-sm-2">
                                        <label for="descricao_etapa" class="control-label">% execução</label>
                                        <p class="ml-20">{{number_format( ($metas->perc), 2, ',' , '.')}}%</p>
                                      </div> 
                                      <div class="col col-xs-12 col-sm-2">
                                        <label for="descricao_etapa" class="control-label">Previsão Início</label>
                                        <p class="ml-20">@if($metas->prevetapa){{date('d/m/Y',strtotime($metas->prevetapa))}}@endif</p>
                                      </div>
                                      <div class="col col-xs-12 col-sm-2">
                                        <label for="descricao_etapa" class="control-label">Início Etapa</label>
                                        <p class="ml-20">@if($metas->efetetapa){{date('d/m/Y',strtotime($metas->efetetapa))}}@endif</p>
                                      </div>  
                                      <div class="col col-xs-12 col-sm-2">
                                        <label for="descricao_etapa" class="control-label">Previsão Fim</label>
                                        <p class="ml-20">@if($metas->dt_prev_fim_etapa){{date('d/m/Y',strtotime($metas->dt_prev_fim_etapa))}}@endif</p>
                                      </div>
                                      <div class="col col-xs-12 col-sm-2">
                                        <label for="descricao_etapa" class="control-label">Fim Etapa</label>
                                        <p class="ml-20">@if($metas->dt_fim_etapa){{date('d/m/Y',strtotime($metas->dt_fim_etapa))}}@endif</p>
                                      </div> 
                                    </div>                                   
                                </div>
                                <div class="row">
                                  <div class="col col-xs-12">
                                    <label for="descricao_etapa" class="control-label">Observações</label>
                                    <p class="ml-20">{{$metas->obs}}</p>
                                  </div> 
                                </div>                                         
                                
                            </div><!-- br-item-->  
                          </div><!-- card body -->
                        </div><!-- card -->   
                      @endforeach
                  
                  </div> 
                </div><!-- card body -->
              </div><!-- card -->           
                
            </div><!-- br-item-->  
              
        @endforeach
    </div><!-- br-list -->
  </div><!-- card body -->
</div><!-- card -->
