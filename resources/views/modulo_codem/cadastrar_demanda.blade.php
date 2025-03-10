@extends('layouts.app')

@section('content')


<historico-navegacao
      :url="'{{ url('/home') }}'"      
      :telanterior01="'Controle de Demandas'"      
      :telatual="'Cadastrar Demanda'"
      >

</historico-navegacao>


<div class="main-content pl-sm-3 mt-5 container-fluid" id="main-content">

  <cabecalho-relatorios
            :titulo="'Cadastrar Demanda'"            
            :linkcompartilhar="'{{ url("/") }}'"
            :barracompartilhar="false">
  </cabecalho-relatorios>

  <form role="form" method="POST" action='{{ url("codem/demanda/salvar") }}'>
    @csrf

    <cadastro-demanda :url="'{{ url('/') }}'"></cadastro-demanda>

    <div class="p-3 text-right">      
          <button class="br-button primary mr-3" type="submit" name="Salvar Edição">Salvar 
          </button>
      

      <button class="br-button danger mr-3" type="button" onclick="javascript:window.history.go(-1)">Voltar
      </button>
    </div> 

  </form>

</div>




@endsection