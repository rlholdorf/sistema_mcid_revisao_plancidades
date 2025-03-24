@extends('layouts.app')

@section('scriptscss')
<link rel="stylesheet" type="text/css" href="{{ asset('css/relatorio_executivo.css') }}" media="screen">
@endsection
@section('content')


<historico-navegacao :url="'{{ url('/home') }}'" 
    :telanterior02="'Consultar Revisão de Indicador'"
    :link2="'{{url('/plancidades/revisao/objetivo_estrategico/consulta')}}'"
    :telanterior01="'PlanCidades'" 
    :link1="'{{url('/plancidades')}}'"
    :telatual="'Cadastrar Revisão de Indicador'">
</historico-navegacao>


<div class="main-content pl-sm-3 mt-5 container-fluid" id="main-content">

    <cabecalho-relatorios :titulo="'Cadastrar Revisão de Indicador'" :linkcompartilhar="'{{ url('/') }}'" :barracompartilhar="false">
    </cabecalho-relatorios>
    <p>
        Confira se o indicador do objetivo estratégico abaixo é o mesmo que deseja revisar. A seguir, selecione o ano e o mês de referência da revisão e clique em salvar para começar a revisar.
    </p>

    <form role="form" method="POST" action='{{ route('plancidades.revisao.objetivoEstrategico.salvar') }}'>
        @csrf
        <cadastro-revisao-indicador
            :dados-indicador="{{json_encode($dadosIndicador)}} "
            :url="'{{ url('/') }}'">
        </cadastro-revisao-indicador>
        <span class="br-divider sm my-3"></span>
    </form>
</div>
@endsection