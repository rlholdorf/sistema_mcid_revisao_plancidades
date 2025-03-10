@extends('layouts.app')

@section('scriptscss')
  <link rel="stylesheet" type="text/css" href="{{ asset('css/relatorio_executivo.css') }}"  media="screen" > 
@endsection

@section('content')


<historico-navegacao
      :url="'{{ url('/home') }}'"      
      :telanterior01="'Planejamento de Tarefas'"      
      :telatual="'{{$tarefaEtapa->txt_nome_planejamento}}'"
      >

</historico-navegacao>


<div class="main-content pl-sm-3 mt-5 container-fluid" id="main-content">

  <cabecalho-relatorios
            :titulo="'{{$tarefaEtapa->txt_tarefa_etapa}}'"            
            :subtitulo2="'{{$tarefaEtapa->txt_nome_secretaria}}'"            
            :linkcompartilhar="'{{ url("/") }}'"
            :barracompartilhar="false">
  </cabecalho-relatorios>

  <form action="{{ url('/planejamento_tarefas/salvar') }}" role="form" method="POST">
    {{ csrf_field() }}

    <div class="form-group">
      <div class="row">
        
          <tarefa-etapa
            :url="'{{ url('/') }}'"
            v-bind:tarefa="{{json_encode($tarefaEtapa)}}"               >

          </tarefa-etapa>
     </div>
     <div class="row">
          <div class="titulo"><h3>Propostas Cadastradas</h3> </div>  
          <div class="table-responsive-sm">
              <table class="table table-hover">
                  <thead>
                      <tr class="text-center" >
                      <th class="text-center"></th>
                      <th class="text-center"> # </th>
                      <th class="text-center">Verificação</th>                  
                      <th class="text-center">Verificado Por</th>
                      <th class="text-center">Responsável</th>
                      <th class="text-center">Início</th>
                      <th class="text-center">Fim</th>
                      <th class="text-center">Ação</th>
                      </tr>
                  </thead>
                  <tbody>

                      @foreach($listaVerificacao as $dados) 
                      <form action="{{ url('/tarefa_etapa/lista_verificacao_tarefa/salvar') }}" role="form" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" id="postId" name="postId" value="{{$dados->id}}" />
                        @if(!empty($dados->bln_verificado)) 
                            <tr class="text-center table-success">   
                        @else
                            <tr class="text-center">   
                        @endif
                              <td class="text-center">
                                @if(!empty($dados->bln_verificado)) 
                                  <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>                                
                                  </div>
                                @else
                                  <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                  </div>

                                @endif
                              </td>  
                              <td class="text-center">{{$dados->num_ordem_verificacao}}</td>                              
                              
                              <td class="text-center">{{$dados->user->name}}</td>                              
                                                          
                              <td class="text-center">@if(!empty($dados->num_fase)) Fase {{$dados->num_fase}}: @endif{{$dados->listaVerificacao->txt_lista_verificacao}}</td>                              
                              <td class="text-center">{{$dados->responsavel->txt_sigla_responsavel}}</td>                              
                              <td class="text-center">@if($dados->dte_inicio_verificacao) {{date('d/m/Y',strtotime($dados->dte_inicio_verificacao))}}@endif</td>                              
                              <td class="text-center">@if($dados->dte_fim_verificacao) {{date('d/m/Y',strtotime($dados->dte_fim_verificacao))}}@endif</td>                              
                              <td class="text-center">
                                <button class="br-button primary mr-3" type="submit" name="Adicionar Edição">Salvar 
                                </button>
                              </td>                              

                          </tr>  
                        </form>
                      @endforeach
                  </tbody><!-- fechar tbody-->
              </table><!-- fechar table-->
          </div> <!-- table-responsive-sm -->  
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