@extends('layouts.app')

@section('content')


<historico-navegacao
      :url="'{{ url('/home') }}'"      
      :telatual="'Planejamento de Tarefas'"      
      >

</historico-navegacao>


<div class="main-content pl-sm-3 mt-5 container-fluid" id="main-content">

  <cabecalho-relatorios
            :titulo="'Planejamento de Tarefas'"   
            :linkcompartilhar="'{{ url("/") }}'"
            :barracompartilhar="false">
  </cabecalho-relatorios>

  <form action="{{ url('/planejamento_tarefas/salvar') }}" role="form" method="POST">
    {{ csrf_field() }}

    <div class="form-group">
      <div class="row">
        @foreach ( $planejamentos as $dados)
          <div class="col-sm-6 col-md-4 col-lg-3">
            <div class="br-card">
              <div class="card-header">
                <div class="d-flex"><span class="br-avatar mt-1" title="Fulano da Silva"><span class="content"><img src="https://picsum.photos/id/823/400"/></span></span>
                  <div class="ml-3">
                    <div class="text-weight-semi-bold text-up-02">{{$dados->txt_nome_planejamento}}</div>
                    <div>{{$dados->secretaria->txt_nome_secretaria}}</div>
                  </div>
                  <div class="ml-auto">
                    <button class="br-button circle" type="button" aria-label="Ícone ilustrativo"><i class="fas fa-ellipsis-v" aria-hidden="true"></i>
                    </button>
                  </div>
                </div>
              </div>
              <div class="card-content">
                <p>
                  {{$dados->dsc_planejamento_tarefa}}  
                </p>
              </div>
              <div class="card-footer">
                <div class="d-flex">
                  <div>
                    
                    <a class="br-button block secondary" href='{{ url("planejamento_tarefas/show/$dados->id")}}'><i class="fas fa-eye"></i>Visualizar</a>
                  </div>
                  <div class="ml-auto">
                    <button class="br-button circle" type="button" aria-label="Ícone ilustrativo"><i class="fas fa-heart" aria-hidden="true"></i>
                    </button>
                    <button class="br-button circle" type="button" aria-label="Ícone ilustrativo 3"><i class="fas fa-share-alt" aria-hidden="true"></i>
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
          
        @endforeach
       
     </div>


    </div><!--from-group -->
       

        <div class="p-3 text-right">      
          <button class="br-button primary mr-3" type="submit" name="Adicionar Edição">Adicionar 
          </button>
      

      <button class="br-button danger mr-3" type="button" onclick="javascript:window.history.go(-1)">Voltar
      </button>
    </div> 
       
   </form>


</div>




@endsection