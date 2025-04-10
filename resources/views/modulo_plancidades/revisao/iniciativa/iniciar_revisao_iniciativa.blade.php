@extends('layouts.app')

@section('scriptscss')
<link rel="stylesheet" type="text/css" href="{{ asset('css/relatorio_executivo.css') }}" media="screen">
@endsection
@section('content')


<historico-navegacao :url="'{{ url('/home') }}'" 
    :telanterior02="'Consultar Revisão de Iniciativa'"
    :link2="'{{url('/plancidades/revisao/iniciativa/consulta')}}'"
    :telanterior01="'PlanCidades'" 
    :link1="'{{url('/plancidades')}}'"
    :telatual="'Cadastrar Revisão de Iniciativa'">
</historico-navegacao>


<div class="main-content pl-sm-3 mt-5 container-fluid" id="main-content">

    <cabecalho-relatorios :titulo="'Cadastrar Revisão de Iniciativa'" :linkcompartilhar="'{{ url('/') }}'" :barracompartilhar="false">
    </cabecalho-relatorios>
    <p>
        Confira se a iniciativa abaixo é a mesma que deseja revisar. A seguir, selecione o ano e o mês de referência da revisão e clique em salvar para começar a revisar.
    </p>

    <form role="form" method="POST" action='{{ route('plancidades.revisao.iniciativa.salvarRevisao') }}'>
        @csrf
        <cadastro-revisao-iniciativa
            :dados-iniciativa="{{json_encode($dadosIniciativa)}} "
            :url="'{{ url('/') }}'">
        </cadastro-revisao-iniciativa>
        <span class="br-divider sm my-3"></span>
    </form>
</div>
@endsection