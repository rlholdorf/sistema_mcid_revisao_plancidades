@extends('layouts.app')

@section('scriptscss')
<link rel="stylesheet" type="text/css" href="{{ asset('css/relatorio_executivo.css') }}" media="screen">
@endsection
@section('content')


<historico-navegacao :url="'{{ url('/home') }}'" 
    :telanterior02="'Consultar Monitoramento de Iniciativa'"
    :link2="'{{url('/plancidades/monitoramentos/iniciativas/consulta')}}'"
    :telanterior01="'PlanCidades'" 
    :link1="'{{url('/plancidades')}}'"
    :telatual="'Cadastrar Monitoramento de Iniciativa de Processo'">

</historico-navegacao>


<div class="main-content pl-sm-3 mt-5 container-fluid" id="main-content">

    <cabecalho-relatorios :titulo="'Cadastrar Monitoramento de Iniciativa de Processo'"
    
    :linkcompartilhar="'{{ url('/') }}'" 
    :barracompartilhar="false">
    </cabecalho-relatorios>
    <p>
        Confira se a iniciativa abaixo é a mesma que deseja monitorar. 
        A seguir, selecione o ano e o mês de referência do monitoramento e clique em salvar para começar a monitorar.
    </p>

    <form role="form" method="POST" action='{{ route('plancidades.monitoramentos.iniciativa.salvar') }}'>
        @csrf
        <cadastro-monitoramento-iniciativa
            :dados-iniciativa="{{json_encode($dadosIniciativa)}} "
            :dados-meta="{{json_encode($dadosMeta)}}"
            :url="'{{ url('/') }}'">
        </cadastro-monitoramento-iniciativa>
        <span class="br-divider sm my-3"></span>
    </form>
</div>
@endsection