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
            Seleção de Propostas
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
                <form action="{{ url('selecao/propostas/pesquisar') }}" method="POST">
                    <div class="card-header card-header-warning card-header-icon">
                        <div class="card-icon">
                            <i class="material-icons fas fa-file-contract"></i>
                        </div>
                        <p class="titulo-caixa">Proposta Cadastrada</p>                
                        @csrf               
                        <p class="valor-unidade-medida">Digite o ID da proposta cadastra no sistema</p>                
                    </div>
                    <div class="card-footer">
                        <div class="input-group mb-4">
                            <input type="text" class="form-control" required placeholder="Ex.: 1254863" aria-label="Ex.: 1254863" aria-describedby="basic-addon2" id="txt_protocolo" name="txt_protocolo">
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
                <form action="{{ url('/selecao/propostas/pesquisar') }}" method="POST">
                    <div class="card-header card-header-success card-header-icon">
                        <div class="card-icon">
                            <i class="material-icons fas  fa-building"></i>                
                        </div>
                        <p class="titulo-caixa">Ente Público</p>                
                        @csrf               
                        <p class="valor-unidade-medida">Digite o CNPJ com os zeros a esquerda e sem caracteres especiais</p>                
                    </div>
                    <div class="card-footer">
                        <div class="input-group mb-4">
                            <input type="text" class="form-control" required placeholder="Ex.: 00333444000111" aria-label="Ex.: 00333444000111" aria-describedby="basic-addon2" id="entepublico" name="entepublico">
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
                <form action="{{ url('/selecao/propostas/pesquisar') }}" method="POST">
                    <div class="card-header card-header-primary card-header-icon">
                        <div class="card-icon">
                        <i class="material-icons fas fa-file-contract"></i>                
                        </div>
                        <p class="titulo-caixa">Proposta Transferegov</p>                
                        @csrf               
                        <p class="valor-unidade-medida">Digite o número da proposta no Transferegov</p>                
                    </div>
                    <div class="card-footer">
                        <div class="input-group mb-4">
                            <input type="text" class="form-control" required placeholder="Ex: 2072/2020" aria-label="Ex: 2072/2020" aria-describedby="basic-addon2" id="numPropostaTransf" name="numPropostaTransf">
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