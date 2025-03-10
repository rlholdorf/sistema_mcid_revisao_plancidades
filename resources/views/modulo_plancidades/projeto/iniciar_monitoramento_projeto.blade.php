@extends('layouts.app')

@section('scriptscss')
<link rel="stylesheet" type="text/css" href="{{ asset('css/relatorio_executivo.css') }}" media="screen">
@endsection
@section('content')


<historico-navegacao :url="'{{ url('/home') }}'" 
    :telanterior02="'Consultar Monitoramento de Projeto'"
    :link2="'{{url('/plancidades/monitoramentos/projetos/consulta')}}'"
    :telanterior01="'PlanCidades'" 
    :link1="'{{url('/plancidades')}}'"    
    :telatual="'Cadastrar Monitoramento de Projeto'">

</historico-navegacao>


<div class="main-content pl-sm-3 mt-5 container-fluid" id="main-content">

    <cabecalho-relatorios :titulo="'Cadastrar Monitoramento de Projeto'"
        :linkcompartilhar="'{{ url("/") }}'"
        :barracompartilhar="false">
    </cabecalho-relatorios>

    <p>
        Confira se o projeto abaixo é o mesmo que deseja monitorar. A seguir, selecione o ano e o mês de referência do monitoramento e clique em salvar para começar a monitorar.
    </p>

    <form role="form" method="POST" action='{{ route('plancidades.monitoramentos.projeto.salvar') }}'>
        @csrf
        <cadastro-monitoramento-projeto 
        :dados-projeto="{{json_encode($dadosProjeto)}}" 
        :url="'{{ url('/') }}'">
        </cadastro-monitoramento-projeto>
        <span class="br-divider sm my-3"></span>
    </form>
</div>

<!-- Modal -->

@endsection