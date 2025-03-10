@extends('layouts.app')



@section('content')



<historico-navegacao
      :url="'{{ url('/home') }}'"      
      :telanterior01="'Resultado Primário'"  
      :telatual="'Consultar Ofício Emendas'"
      >

</historico-navegacao>


<div class="main-content pl-sm-3 mt-5" id="main-content">
  
    <cabecalho-form
       :titulo="'Consultar Ofício Emendas'"
       :linkcompartilhar="'{{ url("/rp/oficio/consultar") }}'"
       barracompartilhar="true">
    </cabecalho-form> 

    <form action="{{ url('/rp/oficio/pesquisar') }}" role="form" method="POST" enctype="multipart/form-data">
        @csrf

        <filtro-oficio-emendas
            :url="'{{ url('/') }}'"
        ></filtro-oficio-emendas>
        
       

          <div class="p-3 text-right">
              <button class="br-button primary mr-3" type="submit" >Pesquisar
              </button>
              <button class="br-button danger mr-3" type="button" onclick="javascript:window.history.go(-1)">Voltar
              </button>
          </div> 
       
    </form> 



</div>


@endsection


