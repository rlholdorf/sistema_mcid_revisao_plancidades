@extends('layouts.app')

@section('content')


<historico-navegacao
      :url="'{{ url('/home') }}'"      
      :telanterior01="'Controle de Demandas'"      
      :telanterior02="'Demanda'"      
      :telatual="'Editar Encaminhamento'"
      >

</historico-navegacao>


<div class="main-content pl-sm-3 mt-5" id="main-content">

  <cabecalho-relatorios
            :titulo="'Editar Encaminhamento'"            
            :linkcompartilhar="'{{ url("/") }}'"
            :barracompartilhar="false">
  </cabecalho-relatorios>

  <form role="form" method="POST" action='{{ url("codem/demanda/encaminhamento/atualizar") }}'>
    @csrf
    <input type="hidden" id="demanda_id" name="demanda_id" value="{{$encaminhamento->demanda_id}}">
    <input type="hidden" id="encaminhamento_id" name="encaminhamento_id" value="{{$encaminhamento->id}}">
    
    <cadastro-encaminhamento 
        :url="'{{ url('/') }}'"
        v-bind:dados="{{json_encode($encaminhamento)}}" 
        usuariodemandante="{{$demanda->isDemandante(Auth::user()->id)}}"></cadastro-encaminhamento>

        <div class="p-3 text-right">      
          <button class="br-button primary mr-3" type="submit" name="Salvar Edição">Salvar 
          </button>
          <button class="br-button danger mr-3" type="button" onclick="window.location.href='/codem/demanda/dados/{{$encaminhamento->demanda_id}}/encaminhamento'">Fechar
          </button>
      </div>    

  </form>

  
</div>




@endsection