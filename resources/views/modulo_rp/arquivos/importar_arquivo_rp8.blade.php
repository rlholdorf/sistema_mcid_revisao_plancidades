@extends('layouts.app')



@section('content')



<historico-navegacao
      :url="'{{ url('/home') }}'"      
      :telanterior01="'Resultado Primário'"  
      :telanterior02="'Arquivos'"  
      :telatual="'Importar arquivo RP8'"
      >

</historico-navegacao>


<div class="main-content pl-sm-3 mt-5" id="main-content">
  
    <cabecalho-form
       :titulo="'Importar arquivo RP8'"
       :linkcompartilhar="'{{ url("/rp/arquivos/importar/rp8") }}'"
       barracompartilhar="false">
    </cabecalho-form> 

    <form action="{{ url('/rp/arquivos/importar/rp8') }}" role="form" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="titulo">
            <h5>Importar dados do arquivo </h5> 
        </div>

        <importar-arquivo-rp
            :url="'{{ url('/') }}'"
        ></importar-arquivo-rp>
        
        <div class="mb-3">
            <label for="formFile" class="form-label">Importe o arquivo no padrão correto</label><span class="br-tag count bg-info" aria-label="Ícone ilustrativo" data-bs-toggle="modal" data-bs-target="#registrarCondicaoEmissao"><span>?</span></span>
            <input class="form-control" type="file" id="formFile" name="formFile" required>
        </div>

          <div class="p-3 text-right">
              <button class="br-button primary mr-3" type="submit" >Importar arquivo
              </button>
              <button class="br-button danger mr-3" type="button" onclick="javascript:window.history.go(-1)">Voltar
              </button>
          </div> 
       
    </form> 



</div>

<div class="modal fade" id="registrarCondicaoEmissao" tabindex="-1" aria-labelledby="registrarCondicaoEmissaoLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="registrarCondicaoEmissaoLabel">Padrão do arquivo para upload de emendas para RP 8</h1>
      
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div><!-- modal-header -->
      <div class="table-responsive">
        <table class="table table-striped table-hover table-sm">
            <thead  class="text-center">
                <tr class="text-center ">
                   
                    <th>num_emenda</th>  
                    
                    <th>txt_nome_orgao</th>  
                    
                </tr>
            </thead>
            <tbody> 
              
                        
                                               
                    
            </tbody>
        </table> 
      </div>
      
  </div>
  </div>
</div>

@endsection


