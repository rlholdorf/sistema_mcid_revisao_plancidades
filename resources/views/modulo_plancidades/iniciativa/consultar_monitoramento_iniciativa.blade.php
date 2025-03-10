@extends('layouts.app')

@section('scriptscss')
<link rel="stylesheet" type="text/css" href="{{ asset('css/relatorio_executivo.css') }}" media="screen">
@endsection
@section('content')


<historico-navegacao :url="'{{ url('/home') }}'" 
    :telanterior01="'Plancidades'"
    :link1="'{{url('/plancidades')}}'"
    :telatual="'Consultar Monitoramento de Iniciativa'">

</historico-navegacao>


<div class="main-content pl-sm-3 mt-5 container-fluid" id="main-content">

    <cabecalho-relatorios :titulo="'Consulta de Monitoramento de Iniciativa/Entrega'" 
    :linkcompartilhar="'{{ url("/") }}'"
        :barracompartilhar="false">
    </cabecalho-relatorios>
    <p>
        Esta página apresenta as iniciativas vinculadas aos Objetivos Estratégicos para serem monitorados. 
        Você pode filtrar pelo Órgão Responsável e por Objetivo Estratégico, bem como usar o seletor "Filtro PPA" e/ou "Filtro PAC" para facilitar sua busca.
        <br> 
        Clique em pesquisar para obter a lista de iniciativas.
    </p>

    <form role="form" method="GET" action='{{ route('plancidades.monitoramentos.iniciativa.listarIniciativas') }}'>
        <consulta-monitoramento-iniciativa-processo :url="'{{ url('/') }}'">
        </consulta-monitoramento-iniciativa-processo>
        <span class="br-divider sm my-3"></span>
    </form>
</div>
@endsection