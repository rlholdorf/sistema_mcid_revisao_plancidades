@extends('layouts.app')

@section('scriptscss')
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/custom.css') }}"  media="screen" />

<link rel="stylesheet" type="text/css" href="{{ asset('css/relatorio_executivo.css') }}" media="screen">
@endsection
@section('content')


<historico-navegacao :url="'{{ url('/home') }}'" :telanterior01="'Plancidades'"
    :telatual="'Cadastrar Monitoramento Iniciativa'">

</historico-navegacao>


<div class="main-content pl-sm-3 mt-5 container-fluid" id="main-content">

    <cabecalho-relatorios :botaoEditar='false' :titulo="'Monitoramento do Projeto'" 
        :subtitulo1="'{{$dados_monitoramento->txt_enunciado_projeto}}'"
        :linkcompartilhar="'{{ url('/') }}'"
        :barracompartilhar="false">
    </cabecalho-relatorios>

    <form role="form" method="POST" action='{{ url("/plancidades/monitoramento/processo/iniciativa_projetos/update/$dados_monitoramento->monitoramento_projeto_id") }}'>
        @csrf
        <editar-monitoramento-projeto
        :dados="{{json_encode($dados_monitoramento)}}"
        :dados-projeto="{{json_encode($dados_projeto)}}"
        :etapas-projeto="{{json_encode($etapas_projeto)}}"
        :etapas-preenchidas="{{json_encode($etapasPreenchidas)}}"      
            :url="'{{ url('/') }}'">
            <div class="text-center mt-3">
                <span class="fs-5 fw-bold">Monitoramento das etapas</span>
            </div>
            <div class="form-group">
                <div class="row mt-3">
                @foreach($etapasPreenchidas as $dados)
                    <div class="column col-4 col-xs-12">
                        <div class="card">        
                            <div class="card-body"> 
                                <div class="column text-left">
                                    <span class="fw-bold">Nome da etapa: </span><span>{{ $dados->dsc_etapa }}</span>
                                    <br>
                                    <span class="fw-bold">Marco de entrega: </span><span>{{ $dados->dsc_marco }}</span>
                                    <br>
                                    @if($dados->situacao_etapa_projeto_id)
                                    <span class="fw-bold">Situação: </span><span>{{ $dados->txt_nome_situacao }}</span>
                                    <div class="row mt-3">
                                        <div class="column col-sm-12 col-md-6">
                                            <label>Data efetiva de início</label>
                                            <br>
                                            <input class="br-input" type="date" value="{{$dados->dte_efetiva_inicio_etapa}}" disabled></input>
                                        </div>
            
                                        <div class="column col-sm-12 col-md-6">
                                            <label>Data efetiva de conclusão: </label>
                                            <br>
                                            <input class="br-input" type="date" value="{{$dados->dte_efetiva_conclusao_etapa}}" disabled></input>
                                        </div>
                                        
                                        
                                    </div>
                                @else
                                <div class="mt-3 mb-3 text-center"><span class="feedback warning" role="alert"><i class="fas fa-times-circle" aria-hidden="true"></i>Etapa do Projeto não preenchida</span>
                                </div>
                                @endif
                                    
                                </div>
                                
                                
                                <button type="button" class="btn btn-outline-primary btn-block" data-bs-toggle="modal" data-bs-target="#{{$dados->etapa_projeto_id}}">
                                    <i class="fa fa-plus"></i> Editar Monitoramento da etapa
                                </button>
                            </div>
                        </div>
                    </div>            
                @endforeach
                </div>
            </div>          
        </editar-monitoramento-projeto>
        <span class="br-divider sm my-3"></span>
    </form>

</div>


@foreach ($etapasPreenchidas as $dados)
<div class="modal fade" id="{{$dados->etapa_projeto_id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Adicionar Monitoramentos das Etapas</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form role="form" method="POST" action='{{ url("plancidades/monitoramento/monitoramento_projeto_etapa/$dados->id")}}'>                    
            @csrf
            <input id='id' name='id'  class="br-input" type="hidden" value="{{$dados->id}}"></input>
            <div class="modal-body">
                <div class="card-body">         
                    <div class="column text-left">
                        <span class="fw-bold">Nome da etapa: </span><span>{{ $dados->dsc_etapa }}</span>
                        <br>
                        <span class="fw-bold">Marco de entrega: </span><span>{{ $dados->dsc_marco }}</span>
                        <br>
                        <span class="fw-bold">Data de início: </span><span>{{date('d/m/Y', strtotime($dados->dte_previsao_inicio_etapa)) }}</span><!-- precisa trazer para $dados a data prevista para apresentar -->
                        <br>
                        <span class="fw-bold">Data de conclusão: </span><span>{{date('d/m/Y', strtotime($dados->dte_previsao_conclusao_etapa)) }}</span> <!-- precisa trazer para $dados a data prevista para apresentar -->
                    </div>

                    <div class="row mt-3">
                        <div class="column col-sm-12 col-md-4">
                            <label>Data efetiva de início</label>
                            <br>
                            <input id='dte_efetiva_inicio_etapa' name='dte_efetiva_inicio_etapa'  class="br-input" type="date" value="{{$dados->dte_efetiva_inicio_etapa}}" required></input>
                        </div>

                        <div class="column col-sm-12 col-md-4">
                            <label>Data efetiva de conclusão: </label>
                            <br>
                            <input id='dte_efetiva_conclusao_etapa' name='dte_efetiva_conclusao_etapa' class="br-input" type="date" value="{{$dados->dte_efetiva_conclusao_etapa}}" required></input>
                        </div>
                            
                            
                        <div class="column col-sm-12 col-md-4">
                            <select-component
                                :dados="{{json_encode($situacaoEtapas)}}"
                                textolabel='Situação'
                                nomecampo='situacao_etapa_projeto_id'
                                selecionado='{{$dados->situacao_etapa_projeto_id}}'
                                textoescolha="Escolha uma Situação">
                            </select-component>
                        
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
            
                <button class="br-button primary mr-3" type="submit" name="Salvar Edição" >Salvar</button>
                <button type="button" class="br-button danger mr-3" data-bs-dismiss="modal">Fechar</button>
            
            </div>
        </form>
      </div>
    </div>
  </div>  
@endforeach


@endsection