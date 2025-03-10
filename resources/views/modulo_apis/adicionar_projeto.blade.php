@extends('layouts.app')

@section('content')


<historico-navegacao
      :url="'{{ url('/home') }}'"      
      :telanterior01="'Debentures'"      
      :telatual="'Adicionar Proposta'"
      >

</historico-navegacao>


<div class="main-content pl-sm-3 mt-5 container-fluid" id="main-content">

  <cabecalho-relatorios
            :titulo="'Adicionar Proposta'"            
            :linkcompartilhar="'{{ url("/") }}'"
            :barracompartilhar="false">
  </cabecalho-relatorios>

  <form role="form" method="POST" action='{{ url("apis/debentures/pesquisar") }}'>
    @csrf

     
     
    <div class="p-3 text-right">      
      @if(Auth::user()->setor_id == 47)
      <button class="br-button success mr-3" type="button" onclick="window.location.href='/apis/debentures/adicionar'">Adicionar Proposta
      </button>
      @endif
      <button class="br-button primary mr-3" type="submit" name="Salvar Edição">Pesquisar 
      </button>
      

      <button class="br-button danger mr-3" type="button" onclick="javascript:window.history.go(-1)">Voltar
      </button>
    </div> 

  </form>

</div>




@endsection