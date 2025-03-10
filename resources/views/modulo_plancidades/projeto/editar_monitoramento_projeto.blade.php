@extends('layouts.app')

@section('scriptscss')
<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/custom.css') }}"  media="screen" />

<link rel="stylesheet" type="text/css" href="{{ asset('css/relatorio_executivo.css') }}" media="screen">
@endsection
@section('content')


<historico-navegacao :url="'{{ url('/home') }}'" 
    :telanterior03="'Projeto {{$dados_monitoramento->projeto_id}}'"
    :link3="'{{url('/plancidades/monitoramentos/projetos/'.$dados_monitoramento->projeto_id)}}'"
    :telanterior02="'Consultar Monitoramento de Projeto'"
    :link2="'{{url('/plancidades/monitoramentos/projetos/consulta')}}'"
    :telanterior01="'PlanCidades'" 
    :link1="'{{url('/plancidades')}}'"
    :telatual="'Monitoramento do Projeto'">

</historico-navegacao>


<div class="main-content pl-sm-3 mt-5 container-fluid" id="main-content">

    <cabecalho-relatorios :botaoEditar='false' :titulo="'Monitoramento do Projeto'" 
        :subtitulo1="'{{$dados_monitoramento->txt_enunciado_projeto}}'"
        :subtitulo2="'Mês de Referência: {{$dados_monitoramento->dsc_periodo_monitoramento}}/{{$dados_monitoramento->num_ano_periodo_monitoramento}}'"
        :linkcompartilhar="'{{ url('/') }}'"
        :barracompartilhar="false">
    </cabecalho-relatorios>

    <p>
        <p>
            Primeiro, monitore cada uma das etapas, clicando no botão com o ícone do lápis,
            preenchendo a data de início e de conclusão (efetiva ou planejada) e a situação atual da etapa. Para registrar, clique em Salvar.
        </p>
        <p>
            Depois de monitorar todas as etapas, realize a avaliação qualitativa do projeto, composta por três itens:
        </p>
        <p>
            - Análise do Projeto: uma breve descrição sobre a execução do projeto no período.
        <br>
            - Causas e impedimentos para o não atingimento da meta: justificativas para o resultado de metas não alcançadas.
        <br>        
            - Desafios e Próximos Passos: o que se pretende fazer a seguir, em especial frente a eventuais não atingimentos das metas.
            Pode incluir informações relativas à necessidade de revisão do projeto. 
        </p>
        <p>
            Caso queira salvar, mas não sair da tela de monitoramento, clique em Salvar. Se quiser enviar o monitoramento e voltar para a lista de monitoramentos deste projeto,
            clique em Finalizar. Caso não deseje continuar preenchendo, clique em voltar (as últimas informações preenchidas não serão salvas).
        </p>
         <hr>

    <form role="form" method="POST" action='{{ route('plancidades.monitoramentos.projeto.atualizar', ['monitoramentoId'=> $dados_monitoramento->monitoramento_projeto_id]) }}'>
        @csrf
        <editar-monitoramento-projeto
        :dados-monitoramento="{{json_encode($dados_monitoramento)}}"
        :dados-projeto="{{json_encode($dados_projeto)}}"
        :etapas-projeto="{{json_encode($etapas_projeto)}}"
        :etapas-preenchidas="{{json_encode($etapasPreenchidas)}}"
        :situacao-monitoramento="{{json_encode($situacao_monitoramento)}}"    
            :url="'{{ url('/') }}'">
            {{-- <div class="text-center mt-5">
                <span class="fs-5 fw-bold">Monitoramento das etapas</span>
            </div>
            <div class="form-group">
                <div class="row mt-3">
                @foreach($etapasPreenchidas as $dados)
                    <div class="column col-4 col-xs-12">
                        <div class="card">        
                            <div class="card-body"> 
                                <div class="column text-left">
                                    <span class="fw-bold">Nº da etapa: </span><span>{{ $loop->index + 1 }}</span>
                                    <br>                                    
                                    <span class="fw-bold">Nome da etapa: </span><span>{{ $dados->dsc_etapa }}</span>
                                    <br>
                                    @if ($dados->dsc_marco)
                                        <span class="fw-bold">Marco de entrega: </span><span>{{ $dados->dsc_marco }}</span>
                                        <br>
                                    @endif
                                    @if($dados->situacao_etapa_projeto_id)
                                        <span class="fw-bold">Situação: </span><span>{{ $dados->txt_situacao }}</span>
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
                                        <div class="mt-3 mb-3 text-center"><span class="feedback warning" role="alert"><i class="fas fa-times-circle" aria-hidden="true"></i>Etapa do Projeto não monitorada</span>
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
            </div>           --}}
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
        <form role="form" method="POST" action='{{ route('plancidades.apuracaoEtapaProjeto.atualizar', ['monitoramentoProjetoEtapaId' => $dados->id]) }}'>                    
            @csrf
            <input id='id' name='id'  class="br-input" type="hidden" value="{{$dados->id}}"></input>
            <div class="modal-body">
                <div class="card-body">         
                    <div class="column text-left">
                        <span class="fw-bold">Nº da etapa: </span><span>{{ $loop->index + 1 }}</span>
                        <br>
                        <span class="fw-bold">Nome da etapa: </span><span>{{ $dados->dsc_etapa }}</span>
                        <br>
                        @if ($dados->dsc_marco)
                            <span class="fw-bold">Marco de entrega: </span><span>{{ $dados->dsc_marco }}</span>
                            <br>    
                        @endif
                    </div>

                    <div class="row mt-5">
                        <div class="column col-sm-12 col-md-4">
                            <span class="fw-bold">Data de início: </span>
                            <br>
                            @if ($dados->dte_validada_inicio_etapa)
                                <span>{{date('d/m/Y', strtotime($dados->dte_validada_inicio_etapa)) . ' (validada)' }}</span>
                            @else
                                <span>{{date('d/m/Y', strtotime($dados->dte_previsao_inicio_etapa)) . ' (previsão)'}}</span>
                            @endif
                            <br>
                        </div>

                        <div class="column col-sm-12 col-md-4">
                            <span class="fw-bold">Data de conclusão: </span>
                            <br>
                            @if ($dados->dte_validada_conclusao_etapa)
                                <span>{{date('d/m/Y', strtotime($dados->dte_validada_conclusao_etapa)) . ' (validada)' }}</span>
                            @else
                                <span>{{date('d/m/Y', strtotime($dados->dte_previsao_conclusao_etapa)) . ' (previsão)'}}</span>
                            @endif
                        </div>

                        <div class="column col-sm-12 col-md-4">
                            @if ($dados->txt_situacao_validada)
                            <span class="fw-bold">Situação anterior: </span>
                            <br>
                            <span>{{ $dados->txt_situacao_validada }}</span>
                            <br>  
                            @endif
                        </div>
                    </div>
                    

                    <div class="row mt-3">
                        <div class="column col-sm-12 col-md-4">
                            <label>Data de início (atualizada)</label>
                            <br>
                            <input id='dte_efetiva_inicio_etapa' name='dte_efetiva_inicio_etapa'  class="br-input" type="date" value={{$dados->dte_efetiva_inicio_etapa ? $dados->dte_efetiva_inicio_etapa : $dados->dte_validada_inicio_etapa}} required></input>
                        </div>

                        <div class="column col-sm-12 col-md-4">
                            <label>Data de conclusão (atualizada): </label>
                            <br>
                            <input id='dte_efetiva_conclusao_etapa' name='dte_efetiva_conclusao_etapa' class="br-input" type="date" value={{$dados->dte_efetiva_conclusao_etapa ? $dados->dte_efetiva_conclusao_etapa : $dados->dte_validada_conclusao_etapa}} required></input>
                        </div>
                            
                            
                        <div class="column col-sm-12 col-md-4">
                            <label for="situacao_etapa_projeto_id">Situação atual</label>
                            <select
                                id="situacao_etapa_projeto_id"
                                class="form-select br-select"
                                name="situacao_etapa_projeto_id"
                                required>
                                    <option value="">Escolha um item</option>
                                    @if ($dados->situacao_etapa_projeto_id)
                                        @foreach ($situacaoEtapas as $situacao)
                                            <option value="{{$situacao->id}}"  {{($dados->situacao_etapa_projeto_id == $situacao->id) ? 'selected': ''}}>{{$situacao->nome}}</option>
                                        @endforeach
                                    @else
                                        @foreach ($situacaoEtapas as $situacao)
                                            <option value="{{$situacao->id}}"  {{($dados->situacao_validada_etapa_projeto_id == $situacao->id) ? 'selected': ''}}>{{$situacao->nome}}</option>
                                        @endforeach
                                    @endif                    
                                    
                            </select>
                        </div>
                    </div>

                    
                </div>
            </div>
            <div class="modal-footer">
                <span class="mr-3">Para garantir que a etapa seja monitorada, clique no botão Salvar</span>
                <button class="br-button primary mr-3" type="submit" name="Salvar Edição" >Salvar</button>
                <button type="button" class="br-button danger mr-3" data-bs-dismiss="modal">Fechar</button>
            
            </div>
        </form>
      </div>
    </div>
  </div>  
@endforeach


@endsection