<div class="br-card">
    <div class="card-header ">
      <div class="d-flex">
          <span class="br-avatar mt-1" title="Situação">
              <span class="content">  
                <img src='{{ URL::asset("/img/icones/pesquisa.png  ")}}' alt="Imagem ilustrativa"/>
                                          
              </span>
          </span>
        <div class="ml-3">
          <div class="text-weight-semi-bold text-up-02">Pesquisas Rápidas</div>
          <div>   
            Por Códigos
          </div>
        </div>
        <div class="ml-auto">
          
        </div>
      </div>
    </div><!--card-header  -->
    <div class="card-content">
      <div class="row" >
        
        <div class="col-lg mb-8x mb-lg-0">
            <div class="card card-stats">
                <form action="{{ url('/bndes/empreendimentos/pesquisar') }}" method="POST">
                    <div class="card-header card-header-warning card-header-icon">
                        <div class="card-icon">
                            <i class="material-icons fas fa-home"></i>                
                        </div>
                        <p class="titulo-caixa">Empreendimento por Código do SACI</p>                
                        @csrf               
                        <p class="valor-unidade-medida">Digite o Código</p>                
                    </div>
                    <div class="card-footer">
                        <div class="input-group mb-4">
                        </BR>
                            <input type="text" class="form-control" placeholder="Ex.: 1254863" aria-label="Ex.: 1254863" aria-describedby="basic-addon2" id="cod_saci" name="cod_saci" required>
                            <div class="input-group-append">
                            <button class="btn btn-primary btn-sm" type="submit"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                        <div class="stats">                    
                            
                        </div>
                    </div>            
                </form> 
            </div>
        </div>
        <div class="col-lg mb-8x mb-lg-0">
            <div class="card card-stats">
                <form action="{{ url('/bndes/empreendimentos/pesquisar') }}" method="POST">
                    <div class="card-header card-header-success card-header-icon">
                        <div class="card-icon">
                            <i class="material-icons fas fa-home"></i>                
                        </div>
                        <p class="titulo-caixa">Empreendimento por Código do MDR</p>                
                        @csrf               
                        <p class="valor-unidade-medida">Digite o Código</p>                
                    </div>
                    <div class="card-footer">
                        <div class="input-group mb-4">
                            
                            <input type="text" class="form-control" placeholder="Ex.: 1254863" aria-label="Ex.: 1254863" aria-describedby="basic-addon2" id="cod_mcidades" name="cod_mcidades" required>
                            <div class="input-group-append">
                            <button class="btn btn-primary btn-sm" type="submit"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                        <div class="stats">                    
                            
                        </div>
                    </div>            
                </form> 
            </div>
        </div>
        <div class="col-lg">
            <div class="card card-stats">
                <form action="{{ url('/bndes/empreendimentos/pesquisar') }}" method="POST">
                    <div class="card-header card-header-info card-header-icon">
                        <div class="card-icon">
                            <i class="material-icons fas fa-home"></i>                
                        </div>
                        <p class="titulo-caixa">Empreendimento por Código do BNDES</p>                
                        @csrf               
                        <p class="valor-unidade-medida">Digite o Código</p>                
                    </div>
                    <div class="card-footer">
                        <div class="input-group mb-4">
                            
                            <input type="text" class="form-control" placeholder="Ex.: 1254863" aria-label="Ex.: 1254863" aria-describedby="basic-addon2" id="cod_bndes" name="cod_bndes" required>
                            <div class="input-group-append">
                            <button class="btn btn-primary btn-sm" type="submit"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                        <div class="stats">                    
                            
                        </div>
                    </div>            
                </form> 
            </div>
        </div>
      </div>
      
    </div><!--card-content  -->
    
  </div><!--br-card  -->