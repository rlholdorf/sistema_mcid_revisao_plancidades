@extends('layouts.app')

@section('content')


<historico-navegacao
      :url="'{{ url('/home') }}'"      
      :telanterior01="'Controle de Demandas'"      
      :telanterior02="'Demanda'"      
      :telatual="'Inserir Documento Demanda'"
      >

</historico-navegacao>


<div class="main-content pl-sm-3 mt-5 container-fluid" id="main-content">

  <cabecalho-relatorios
            :titulo="'Inserir Documento  Demanda'"            
            :linkcompartilhar="'{{ url("/") }}'"
            :barracompartilhar="false">
  </cabecalho-relatorios>

  <form role="form" method="POST" action='{{ url("codem/demanda/documento/salvar") }}'>
    @csrf
    <input type="hidden" id="demanda_id" name="demanda_id" value="{{$demandaID}}">

    <cadastro-documento-demanda :url="'{{ url('/') }}'"></cadastro-documento-demanda>

    <div class="p-3 text-right">      
      <button class="br-button primary mr-3" type="submit" name="Salvar Edição">Salvar 
      </button>
      <button class="br-button danger mr-3" type="button" onclick="window.location.href='/codem/demanda/dados/{{$demandaID}}/demanda'">Fechar
      </button>
  </div>  

  </form>

</div>




@endsection