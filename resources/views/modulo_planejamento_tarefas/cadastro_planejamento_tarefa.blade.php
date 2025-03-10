@extends('layouts.app')

@section('content')


<historico-navegacao
      :url="'{{ url('/home') }}'"      
      :telanterior01="'Planejamento de Tarefas'"      
      :telatual="'Adicionar Planejamento'"
      >

</historico-navegacao>


<div class="main-content pl-sm-3 mt-5 container-fluid" id="main-content">

  <cabecalho-relatorios
            :titulo="'Adicionar Planejamento'"            
            :linkcompartilhar="'{{ url("/") }}'"
            :barracompartilhar="false">
  </cabecalho-relatorios>

  <form action="{{ url('/planejamento_tarefas/salvar') }}" role="form" method="POST">
    {{ csrf_field() }}
        <div class="row">
           <cadastro-planejamento-tarefa
            :url="'{{ url('/') }}'"               >

            </cadastro-planejamento-tarefa>
        </div>

        <div class="p-3 text-right">      
          <button class="br-button primary mr-3" type="submit" name="Adicionar Edição">Adicionar 
          </button>
      

      <button class="br-button danger mr-3" type="button" onclick="javascript:window.history.go(-1)">Voltar
      </button>
    </div> 
       
   </form>


</div>




@endsection