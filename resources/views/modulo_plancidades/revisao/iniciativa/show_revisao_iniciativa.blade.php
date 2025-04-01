@extends('layouts.app')

@section('scriptscss')
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/custom.css')}}"  media="screen" />
<link rel="stylesheet" type="text/css" href="{{ asset('css/relatorio_executivo.css') }}"  media="screen" > 

@endsection

@section('content')


    <historico-navegacao :url="'{{ url('/home') }}'" 
        :telanterior03="'Iniciativa {{$dadosIniciativa->iniciativa_id}}'"
        :link3="'{{url('/plancidades/revisao/iniciativa/listar/'.$dadosIniciativa->iniciativa_id)}}'"
        :telanterior02="'Consultar Iniciativas para Revisão'"
        :link2="'{{url('/plancidades/revisao/iniciativa/consulta')}}'"
        :telanterior01="'PlanCidades'" 
        :link1="'{{url('/plancidades')}}'"
        :telatual="'Revisar Iniciativa'">

    </historico-navegacao>


    <div class="main-content pl-sm-3 mt-5 container-fluid" id="main-content">

        <cabecalho-relatorios :botaoEditar='false' titulo="{{$dadosIniciativa->iniciativa_id}} - {{$dadosIniciativa->txt_enunciado_iniciativa}}"
            :linkcompartilhar="'{{ url("/") }}'"
            :barracompartilhar="false">
        </cabecalho-relatorios>
        <p>
        Nesta página, você poderá visualizar todos os detalhes da revisão.
        </p>
        
        <hr>
        <show-revisao-iniciativa 
        :url="'{{ url('/') }}'"
        :dados-iniciativa="{{json_encode($dadosIniciativa)}}"
        :dados-regionalizacao="{{json_encode($dadosRegionalizacao)}}"
        v-bind:dados-iniciativa-revisao="{{json_encode($dadosIniciativaRevisao)}}"
        v-bind:dados-indicador-iniciativa-revisao="{{json_encode($dadosIndicadorIniciativaRevisao)}}"
        v-bind:dados-meta-iniciativa-revisao="{{json_encode($dadosMetaIniciativaRevisao)}}"
        >
        </show-revisao-iniciativa>
        <span class="br-divider sm my-3"></span>
    </div>
@endsection