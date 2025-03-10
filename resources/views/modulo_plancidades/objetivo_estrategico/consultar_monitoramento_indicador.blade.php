@extends('layouts.app')

@section('scriptscss')
<link rel="stylesheet" type="text/css" href="{{ asset('css/relatorio_executivo.css') }}" media="screen">
@endsection
@section('content')


<historico-navegacao :url="'{{ url('/home') }}'"
    :telanterior01="'Plancidades'"
    :link1="'{{url('/plancidades')}}'"
    :telatual="'Consultar Monitoramento de Indicador'"
    >

</historico-navegacao>


<div class="main-content pl-sm-3 mt-5 container-fluid" id="main-content">

    <cabecalho-relatorios :titulo="'Consulta de Monitoramento de Indicador'" 
        :linkcompartilhar="'{{ url("/") }}'"
        :barracompartilhar="false">
    </cabecalho-relatorios>
    <div class="mb-3">
        <p>
            Esta página apresenta os indicadores de Objetivos Estratégicos para serem monitorados. 
            Você pode filtrar pelo Órgão Responsável e por Objetivo Estratégico, bem como usar o seletor "buscar somente PPA" para facilitar sua busca.
            <br> 
            Clique em pesquisar para obter a lista de indicadores.
        </p>
    </div>

    <form role="form" method="GET" action="{{ route('plancidades.monitoramentos.objetivoEstrategico.listarIndicadores') }}">
        <consulta-monitoramento-indicador :url="'{{ url('/') }}'">
        </consulta-monitoramento-indicador>
        <span class="br-divider sm my-3"></span>
    </form>

</div>
@endsection