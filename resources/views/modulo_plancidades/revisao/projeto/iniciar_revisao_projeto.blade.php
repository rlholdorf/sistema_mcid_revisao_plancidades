@extends('layouts.app')

@section('scriptscss')
<link rel="stylesheet" type="text/css" href="{{ asset('css/relatorio_executivo.css') }}" media="screen">
@endsection
@section('content')


<historico-navegacao :url="'{{ url('/home') }}'" 
    :telanterior02="'Consultar Revisão de Projeto'"
    :link2="'{{url('/plancidades/revisao/projeto/consulta')}}'"
    :telanterior01="'PlanCidades'" 
    :link1="'{{url('/plancidades')}}'"
    :telatual="'Cadastrar Revisão de Projeto'">
</historico-navegacao>


<div class="main-content pl-sm-3 mt-5 container-fluid" id="main-content">

    <cabecalho-relatorios :titulo="'Cadastrar Revisão de Projeto'" :linkcompartilhar="'{{ url('/') }}'" :barracompartilhar="false">
    </cabecalho-relatorios>
    <p>
        Confira se o projeto abaixo é o mesmo que deseja revisar. A seguir, selecione o ano e o mês de referência da revisão e clique em salvar para começar a revisar.
    </p>

    <form role="form" method="POST" action='{{ route('plancidades.revisao.projeto.salvar') }}'>
        @csrf
        <cadastro-revisao-projeto
            :dados-projeto="{{json_encode($dadosProjeto)}} "
            :url="'{{ url('/') }}'">
        </cadastro-revisao-projeto>
        <span class="br-divider sm my-3"></span>
    </form>
</div>
@endsection