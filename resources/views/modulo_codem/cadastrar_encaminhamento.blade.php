@extends('layouts.app')

@section('content')


<historico-navegacao
      :url="'{{ url('/home') }}'"      
      :telanterior01="'Controle de Demandas'"      
      :telanterior02="'Demanda'"      
      :telatual="'Adicionar Encaminhamento'"
      >

</historico-navegacao>


<div class="main-content pl-sm-3 mt-5" id="main-content">

  <cabecalho-relatorios
            :titulo="'Adicionar Encaminhamento'"            
            :linkcompartilhar="'{{ url("/") }}'"
            :barracompartilhar="false">
  </cabecalho-relatorios>

  <form role="form" method="POST" action='{{ url("codem/demanda/encaminhamento/salvar") }}'>
    @csrf
    <input type="hidden" id="demanda_id" name="demanda_id" value="{{$demandaID}}">

    <cadastro-encaminhamento :url="'{{ url('/') }}'"></cadastro-encaminhamento>

    <div class="p-3 text-right">      
      <button class="br-button primary mr-3" type="submit" name="Salvar Edição">Salvar 
      </button>
      <button class="br-button danger mr-3" type="button" onclick="window.location.href='/codem/demanda/dados/{{$demandaID}}/encaminhamento'">Fechar
      </button>
  </div>  

  </form>

</div>




@endsection