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
        <show-finalizar-revisao-iniciativa 
        :url="'{{ url('/') }}'"
        :dados-revisao="{{json_encode($dadosRevisao)}}"
        :dados-iniciativa="{{json_encode($dadosIniciativa)}}"
        :dados-iniciativa-revisao="{{json_encode($dadosIniciativaRevisao)}}"
        :dados-indicador-revisao="{{json_encode($dadosIndicadorIniciativaRevisao)}}"
        :dados-meta-revisao="{{json_encode($dadosMetaRevisao)}}"
        :dados-regionalizacao-revisao="{{json_encode($dadosRegionalizacaoRevisao)}}"
        >
        </show-finalizar-revisao-iniciativa>
        <span class="br-divider sm my-3"></span>
    </div>
@endsection