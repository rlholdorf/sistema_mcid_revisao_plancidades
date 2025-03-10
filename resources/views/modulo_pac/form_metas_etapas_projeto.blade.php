<div class="card">    
  <div class="card-body">    
    <div class="br-list" role="list">   
        @foreach($metas as $meta)
        <div class="br-item" role="listitem" data-toggle="collapse" data-target="l{{$meta->num_meta}}">    
            <div class="content">
              <div class="flex-fill"><b>META {{$meta->num_meta}}</b>: {{$meta->cod_meta}} - {{$meta->dsc_meta}}</div>
              
                  <i class="fas fa-angle-down" aria-hidden="true"></i>
                
            </div>
          </div>
          <span class="br-divider"></span>   
          <div class="br-list" id="l{{$meta->num_meta}}" role="list" hidden="hidden">
          </br>
          <div class="card">    
            <div class="card-body">  
            <div class="form-group ">
                <div class="row">
                  <div class="col col-xs-12">
                    <label for="dsc_meta" class="control-label">Descrição</label>
                    <p class="ml-20">{{$meta->dsc_meta}}</p>
                  </div> 
                </div>
                <div class="row">
                  <div class="col col-xs-12 col-sm-3">
                    <label for="num_meta" class="control-label">Nº Meta</label>
                    <p class="ml-20">{{$meta->num_meta}}</p>
                  </div>  
                  <div class="col col-xs-12 col-sm-3">
                    <label for="descricao_etapa" class="control-label">Valor</label>
                    <p class="ml-20">{{number_format( ($meta->vlr_meta), 2, ',' , '.')}}</p>
                  </div> 
                 
                  <div class="col col-xs-12 col-sm-3">
                    <label for="descricao_etapa" class="control-label">Início Meta</label>
                    <p class="ml-20">@if($meta->dte_inicio_meta){{date('d/m/Y',strtotime($meta->dte_inicio_meta))}}@endif</p>
                  </div>  
                  
                  <div class="col col-xs-12 col-sm-3">
                    <label for="descricao_etapa" class="control-label">Fim Meta</label>
                    <p class="ml-20">@if($meta->dte_fim_meta){{date('d/m/Y',strtotime($meta->dte_fim_meta))}}@endif</p>
                  </div> 
                </div>                                   
            </div>
           
            @if(count($meta->etapas)>0)
              <div class="header"><div class="title">Etapa Meta</div>
              </div><span class="br-divider"></span>
            @endif   
           
            <div class="br-list" role="list">   
              @foreach($meta->etapas as $etapa)
                  
                          
              <div class="br-item" role="listitem" data-toggle="collapse" data-target="l{{$etapa->cod_etapa}}">    
                <div class="content">
                  <div class="flex-fill"><b>{{$etapa->num_etapa}} ETAPA</b>: {{$etapa->cod_etapa}} - {{$etapa->dsc_etapa}}</div>
                  
                      <i class="fas fa-angle-down" aria-hidden="true"></i>
                    
                </div>
              </div>
              <span class="br-divider"></span>  
              <div class="br-list" id="l{{$etapa->cod_etapa}}" role="list" hidden="hidden">
              </br>
              <div class="card">    
                <div class="card-body">  
                  <div class="form-group ">
                      <div class="row">
                        <div class="col col-xs-12">
                          <label for="descricao_etapa" class="control-label">Descrição</label>
                          <p class="ml-20">{{$etapa->dsc_etapa}}</p>
                        </div> 
                      </div>
                      <div class="row">
                        <div class="col col-xs-12 col-sm-3">
                          <label for="descricao_etapa" class="control-label">Nº Etapa</label>
                          <p class="ml-20">{{$etapa->num_etapa}}</p>
                        </div>  
                        <div class="col col-xs-12 col-sm-3">
                          <label for="descricao_etapa" class="control-label">Valor</label>
                          <p class="ml-20">{{number_format( ($etapa->vlr_etapa), 2, ',' , '.')}}</p>
                        </div> 
                       
                        <div class="col col-xs-12 col-sm-3">
                          <label for="dte_inicio_etapa" class="control-label">Início Etapa</label>
                          <p class="ml-20">@if($etapa->dte_inicio_etapa){{date('d/m/Y',strtotime($etapa->dte_inicio_etapa))}}@endif</p>
                        </div>  
                       
                        <div class="col col-xs-12 col-sm-3">
                          <label for="dte_fim_etapa" class="control-label">Fim Etapa</label>
                          <p class="ml-20">@if($etapa->dte_fim_etapa){{date('d/m/Y',strtotime($etapa->dte_fim_etapa))}}@endif</p>
                        </div> 
                      </div>                                   
                  </div>
                                                       
                  
              </div><!-- br-item-->  
            </div><!-- card body -->
          </div><!-- card -->   
        @endforeach
            
            </div> <!-- br list-->
          </div><!-- card body -->
        </div><!-- card -->           
          
          
        </div>  <!-- br-ITEM -->
        @endforeach
      </div><!-- br-list -->
    </div><!-- card body -->
  </div><!-- card -->