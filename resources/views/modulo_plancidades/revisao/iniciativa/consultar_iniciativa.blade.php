@extends('layouts.app')

@section('scriptscss')
<link rel="stylesheet" type="text/css" href="{{ asset('css/relatorio_executivo.css') }}" media="screen">
@endsection
@section('content')


<historico-navegacao :url="'{{ url('/home') }}'"
    :telanterior01="'PlanCidades'"
    :link1="'{{url('/plancidades')}}'"
    :telatual="'Consultar Iniciativas para Revisão'"
    >

</historico-navegacao>


<div class="main-content pl-sm-3 mt-5 container-fluid" id="main-content">

    <cabecalho-relatorios :titulo="'Consulta de Iniciativas para Revisão'" 
        :linkcompartilhar="'{{ url("/") }}'"
        :barracompartilhar="false">
    </cabecalho-relatorios>
    <div class="mb-3">
        <p>
            Esta página apresenta as Iniciativas e Entregas do PPA para serem revisadoa. 
            Você pode filtrar pelo Órgão Responsável e por Objetivo Estratégico, bem como usar o seletor "buscar somente PPA" para facilitar sua busca.
            <br> 
            Clique em pesquisar para obter a lista de iniciativas.
        </p>
    </div>

    <form role="form" method="GET" action="{{ route('plancidades.revisao.iniciativa.listarIniciativas') }}">
        <consulta-iniciativa-revisao :url="'{{ url('/') }}'">
        </consulta-iniciativa-revisao>
        <span class="br-divider sm my-3"></span>
    </form>

</div>
@endsection