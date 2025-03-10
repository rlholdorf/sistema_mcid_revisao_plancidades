@extends('layouts.app')

@section('scriptscss')
<link rel="stylesheet" type="text/css" href="{{ asset('css/relatorio_executivo.css') }}" media="screen">
@endsection
@section('content')


<historico-navegacao :url="'{{ url('/home') }}'"
    :telanterior01="'Consultar Programas'"
    :link1="'{{url('/transferegov/programas/listar')}}'"
>

</historico-navegacao>


<div class="main-content pl-sm-3 mt-5 container-fluid">

    <cabecalho-relatorios :titulo="'Programas TransfereGov'" 
    :linkcompartilhar="'{{ url("/") }}'"
        :barracompartilhar="false">
    </cabecalho-relatorios>

    <form role="form" method="POST" action='{{route('transferegov.atualizar', ['id'=>$programaCidades->id])}}'>
        @csrf
        <registro-programa
            v-bind:programa-transferegov='{{json_encode($programaTransferegov)}}'
            :programa-cidades='{{json_encode($programaCidades)}}'
            :url="'{{ url('/') }}'">
        
        </registro-programa>
    </form>
    
</div>
@endsection