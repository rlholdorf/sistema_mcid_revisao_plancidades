@extends('layouts.app')

@section('scriptscss')
<link rel="stylesheet" type="text/css" href="{{ asset('css/relatorio_executivo.css') }}" media="screen">
@endsection
@section('content')


<historico-navegacao :url="'{{ url('/home') }}'" 
    :telanterior01="'PlanCidades'"
    :link1="'{{url('/plancidades')}}'"
    :telatual="'Consultar Monitoramentos Preenchidos'">

</historico-navegacao>


<div class="main-content pl-sm-3 mt-5 container-fluid" id="main-content">

    <cabecalho-relatorios :titulo="'Consulta de Monitoramentos Preenchidos'" 
    :linkcompartilhar="'{{ url("/") }}'"
        :barracompartilhar="false">
    </cabecalho-relatorios>
    
    <div class="mb-3">
        <p>
            Esta página apresentará os monitoramentos já preenchidos pelas unidades do MCID. 
            Você deve selecionar o botão correspodente para filtrar monitoramentos de Objetivo Estratégico,
            Iniciativas ou Projetos, e pode usar o seletor "buscar somente PPA" para facilitar sua busca.
            <br> 
            Clique em pesquisar para obter a lista de monitoramentos.
        </p>
    </div>

    <div class="row text-center">
        <div class="col col-xs-4 col-sm-4">
            <h4>Indicadores</h4>
            <a class="br-button primary mr-3" href="{{ route('plancidades.monitoramentos.validacoesPendentes.indicadores.listar') }}">Monitoramentos pendentes</a>
            <br>
            <a class="br-button primary mr-3 mt-3" href="{{ route('plancidades.monitoramentos.validacao.indicadores.listar') }}">Todos os monitoramentos</a>
        </div>

        <div class="col col-xs-4 col-sm-4">
            <h4>Iniciativas</h4>
            <a class="br-button primary mr-3" href="{{ route('plancidades.monitoramentos.validacoesPendentes.iniciativas.listar') }}">Monitoramentos pendentes</a>
            <br>
            <a class="br-button primary mr-3 mt-3" href="{{ route('plancidades.monitoramentos.validacao.iniciativas.listar') }}">Todos os monitoramentos</a>
        </div>

        <div class="col col-xs-4 col-sm-4">
            <h4>Projetos</h4>
            <a class="br-button primary mr-3" href="{{ route('plancidades.monitoramentos.validacoesPendentes.projetos.listar') }}">Monitoramentos pendentes</a>
            <br>
            <a class="br-button primary mr-3 mt-3" href="{{ route('plancidades.monitoramentos.validacao.projetos.listar') }}">Todos os monitoramentos</a>
        </div> 
    </div>
</div>
@endsection