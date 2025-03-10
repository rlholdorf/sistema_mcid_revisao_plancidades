@extends('layouts.app')

@section('content')


<historico-navegacao
      :url="'{{ url('/home') }}'"      
      :telanterior01="'Planejamento de Tarefas'"      
      :telatual="'{{$planejamento->txt_nome_planejamento}}'"
      >

</historico-navegacao>


<div class="main-content pl-sm-3 mt-5 container-fluid" id="main-content">

  <cabecalho-relatorios
            :titulo="'{{$planejamento->txt_nome_planejamento}}'"            
            :subtitulo2="'{{$planejamento->secretaria->txt_nome_secretaria}}'"            
            :linkcompartilhar="'{{ url("/") }}'"
            :barracompartilhar="false">
  </cabecalho-relatorios>


  <button type="button" class="br-button block primary mb-3" data-bs-toggle="modal" data-bs-target="#addEtapa">
    <i class="fas fa-plus"></i>Adicionar Etapa
  </button>
  <br>
 

    <div class="form-group">
      <!-- Button trigger modal -->                        
      <div class="row">
        @foreach ( $etapasPlanejamento as $etapa)
          <etapas-planejamanto
            :url="'{{ url('/') }}'"
            v-bind:etapas="{{json_encode($etapa)}}"             >
          </etapas-planejamanto>
        @endforeach       
     </div>
    </div><!--from-group -->      

    <div class="p-3 text-right">      
      <button class="br-button danger mr-3" type="button" onclick="javascript:window.history.go(-1)">Voltar
      </button>
    </div> 
</div>


<!-- Modal -->
<div class="modal fade" id="addEtapa" tabindex="-1" aria-labelledby="addEtapaLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addEtapaLabel">Adicionar Etapa</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{ url('/etapas_planejamento/adicionar') }}" role="form" method="POST">
        {{ csrf_field() }}
      <div class="modal-body">
        
          <input type="hidden" id="planejamento_tarefa_id" name="planejamento_tarefa_id" value="{{$planejamento->id}}" />
                    
          
            <div class="br-input">              
              <label for="input-default">Nome da Etapa</label>
              <input id="txt_nome_etapa_planejamento" name="txt_nome_etapa_planejamento" type="text" required/>              
            </div>
        
      </div>
      <div class="modal-footer">
        <button type="submit" class="br-button primary mb-3">Adicionar</button>
        <button type="button" class="br-button danger mr-3" data-bs-dismiss="modal">Fechar</button>
        
      </div>
      </form>
    </div>
  </div>
</div>


@endsection