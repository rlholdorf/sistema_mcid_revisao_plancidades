@extends('layouts.app')

@section('scriptscss')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/relatorio_executivo.css') }}"  media="screen" > 
@endsection
@section('content')


<historico-navegacao
      :url="'{{ url('/home') }}'"      
      :telanterior01="'Plancidades'"      
      :telatual="'Cadastrar Iniciativa de Projetos'"
      >

</historico-navegacao>


<div class="main-content pl-sm-3 mt-5 container-fluid" id="main-content">

  <cabecalho-relatorios
            :titulo="'Cadastrar Iniciativa de Projetos'"            
            :linkcompartilhar="'{{ url("/") }}'"
            :barracompartilhar="false">
  </cabecalho-relatorios>
<p>
  A presente ficha é para a descrição de iniciativas que apresentam como projetos, ou seja, iniciativas que possuem início e fim e se 
  destinam à criação de um produto ou serviço único. Para ações continuadas, ou seja, processos do Ministério que devam ser medidos e 
  controlados por um indicador, deve-se utilizar a <a href="">Ficha de Indicador – Ação Continuada (Processo) </a>
</p>



  <form role="form" method="POST" action='{{ url("plancidades/iniciativa/projeto/pesquisar") }}'>
    @csrf
    <consultar-iniciativa-projeto
          :url="'{{ url('/') }}'">
    </consultar-iniciativa-projeto>
    <span class="br-divider sm my-3"></span>
     
     
    <div class="p-3 text-right">      
      
      <button class="br-button primary mr-3" type="submit" name="Salvar Edição">Salvar
      </button>
      

      <button class="br-button danger mr-3" type="button" onclick="javascript:window.history.go(-1)">Voltar
      </button>
    </div> 

  </form>

</div>




@endsection