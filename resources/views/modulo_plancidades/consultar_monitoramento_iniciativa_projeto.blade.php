@extends('layouts.app')

@section('scriptscss')
<link rel="stylesheet" type="text/css" href="{{ asset('css/relatorio_executivo.css') }}" media="screen">
@endsection
@section('content')


<historico-navegacao :url="'{{ url('/home') }}'" :telanterior01="'Plancidades'"
    :telatual="'Consultar Monitoramento de Projeto'">

</historico-navegacao>


<div class="main-content pl-sm-3 mt-5 container-fluid" id="main-content">

    <cabecalho-relatorios :titulo="'Consulta de Monitoramento de Projeto'" 
    :linkcompartilhar="'{{ url("/") }}'"
        :barracompartilhar="false">
    </cabecalho-relatorios>
    <p>
        Utilize os filtros "Órgão Responsável" e "Objetivo Estratégico" para obter uma lista de projetos. 
        Você pode selecionar também o filtro "Buscar somente PPA" para obter os projetos que estão no PPA.
        <br>
        Clique em Pesquisar para ver a lista de projetos.
    </p>
    <form role="form" method="GET" action='{{ route('plancidades.projeto.listar') }}'>
        @csrf
        <consulta-monitoramento-projeto :url="'{{ url('/') }}'">
        </consulta-monitoramento-projeto>
        <span class="br-divider sm my-3"></span>
    </form>
</div>
@endsection