@extends('layouts.app')

@section('content')


<historico-navegacao
      :url="'{{ url('/home') }}'"      
      :telanterior01="'debentures e Reidi'"      
      :telatual="'Consultar debentures e Reidi'"
      >

</historico-navegacao>


<div class="main-content pl-sm-3 mt-5 container-fluid" id="main-content">

  <cabecalho-relatorios
            :titulo="'Consultar debentures e Reidi'"            
            :linkcompartilhar="'{{ url("/") }}'"
            :barracompartilhar="false">
  </cabecalho-relatorios>

  <form role="form" method="POST" action='{{ url("debentures_reidi/projetos/debentures/pesquisar") }}'>
    @csrf

    <filtro-debentures :url="'{{ url('/') }}'"></filtro-debentures>

    <div class="p-3 text-right">      
          <button class="br-button primary mr-3" type="submit" name="Salvar Edição">Pesquisar 
          </button>
      

      <button class="br-button danger mr-3" type="button" onclick="javascript:window.history.go(-1)">Voltar
      </button>
    </div> 

  </form>

</div>




@endsection