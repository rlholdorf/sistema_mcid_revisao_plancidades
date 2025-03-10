@extends('layouts.app')

@section('scriptscss')
<link rel="stylesheet" type="text/css" href="{{ asset('css/relatorio_executivo.css') }}" media="screen">
@endsection
@section('content')


<historico-navegacao :url="'{{ url('/home') }}'" :telanterior01="'Programas TransfereGov'"
    :telatual="'Cadastrar Programa'">

</historico-navegacao>


<div class="main-content pl-sm-3 mt-5 container-fluid">

    <cabecalho-relatorios :titulo="'Programas TransfereGov'" 
    :linkcompartilhar="'{{ url("/") }}'"
        :barracompartilhar="false">
    </cabecalho-relatorios>

    <form role="form" method="POST" action='{{route('transferegov.salvar')}}'>
        @csrf
        <registro-programa
            v-bind:programa-transferegov='{{json_encode($programaTransferegov)}}'
            :url="'{{ url('/') }}'">
        
        </registro-programa>
    </form>
    
</div>
@endsection