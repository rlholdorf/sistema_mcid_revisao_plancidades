@extends('layouts.app')

@section('scriptscss')
<link rel="stylesheet" type="text/css" href="{{ asset('css/relatorio_executivo.css') }}" media="screen">
@endsection
@section('content')


<historico-navegacao :url="'{{ url('/home') }}'" 
    :telanterior02="'Consultar Monitoramento de Indicador'"
    :link2="'{{url('/plancidades/monitoramentos/objetivo_estrategico/consulta')}}'"
    :telanterior01="'PlanCidades'" 
    :link1="'{{url('/plancidades')}}'"
    :telatual="'Cadastrar Monitoramento de Indicador'">
</historico-navegacao>


<div class="main-content pl-sm-3 mt-5 container-fluid" id="main-content">

    <cabecalho-relatorios :titulo="'Cadastrar Monitoramento de Indicador'" :linkcompartilhar="'{{ url('/') }}'" :barracompartilhar="false">
    </cabecalho-relatorios>
    <p>
        Confira se o indicador do objetivo estratégico abaixo é o mesmo que deseja monitorar. A seguir, selecione o ano e o mês de referência do monitoramento e clique em salvar para começar a monitorar.
    </p>

    <form role="form" method="POST" action='{{ route('plancidades.monitoramentos.objetivoEstrategico.salvar') }}'>
        @csrf
        <cadastro-monitoramento-indicador
            :dados-indicador="{{json_encode($dadosIndicador)}} "
            :dados-meta="{{json_encode($dadosMeta)}} "
            :url="'{{ url('/') }}'">
        </cadastro-monitoramento-indicador>
        <span class="br-divider sm my-3"></span>
    </form>
</div>
@endsection