@extends('layouts.app')

@section('scriptscss')
<link rel="stylesheet" type="text/css" href="{{ asset('css/relatorio_executivo.css') }}" media="screen">
@endsection
@section('content')


<historico-navegacao :url="'{{ url('/home') }}'" :telanterior01="'Plancidades'"
    :telatual="'Cadastrar Monitoramento Iniciativa'">

</historico-navegacao>


<div class="main-content pl-sm-3 mt-5 container-fluid" id="main-content">

    <cabecalho-relatorios :titulo="'Cadastrar Monitoramento de Iniciativa/Entrega'" :linkcompartilhar="'{{ url("/") }}'" :barracompartilhar="false">
    </cabecalho-relatorios>
    <p>
        A presente ficha é para a descrição...
    </p>



    <form role="form" method="POST" action='{{ route('plancidades.monitoramentos.iniciativa.salvarMonitoramento') }}'>
        @csrf
        <cadastro-monitoramento-iniciativa-processo :editando="true" :cadastrando="true" :url="'{{ url('/') }}'">
        </cadastro-monitoramento-iniciativa-processo>
        <span class="br-divider sm my-3"></span>
    </form>

</div>
@endsection