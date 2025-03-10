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
        :telatual="'Visualizar Monitoramento do Projeto'">

    </historico-navegacao>


    <div class="main-content pl-sm-3 mt-5 container-fluid" id="main-content">

        <cabecalho-relatorios :botaoEditar='false' :titulo="'Monitoramento do Projeto'" 
            :subtitulo1="'{{$dados_monitoramento->txt_enunciado_projeto}}'"
            :subtitulo2="'Mês de Referência: {{$dados_monitoramento->dsc_periodo_monitoramento}}/{{$dados_monitoramento->num_ano_periodo_monitoramento}}'"
            :linkcompartilhar="'{{ url('/') }}'"
            :barracompartilhar="false">
        </cabecalho-relatorios>

        <p>
            Nesta página, você poderá visualizar todos os detalhes do monitoramento.
        </p>
            <hr>

            @csrf
            <show-monitoramento-projeto
            :dados-monitoramento="{{json_encode($dados_monitoramento)}}"
            :dados-projeto="{{json_encode($dados_projeto)}}"
            :etapas-projeto="{{json_encode($etapas_projeto)}}"
            :etapas-preenchidas="{{json_encode($etapasPreenchidas)}}"
            :situacao-monitoramento="{{json_encode($situacao_monitoramento)}}"      
                :url="'{{ url('/') }}'">
            </show-monitoramento-projeto>
        <span class="br-divider sm my-3"></span>

    </div>
@endsection