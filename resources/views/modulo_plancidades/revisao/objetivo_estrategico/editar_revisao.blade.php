@extends('layouts.app')

@section('scriptscss')
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/custom.css')}}"  media="screen" />
<link rel="stylesheet" type="text/css" href="{{ asset('css/relatorio_executivo.css') }}"  media="screen" > 

@endsection

@section('content')


    <historico-navegacao :url="'{{ url('/home') }}'" 
        :telanterior02="'Consultar Indicadores para Revisão'"
        :link2="'{{url('/plancidades/revisao/objetivo_estrategico/consulta')}}'"
        :telanterior01="'PlanCidades'" 
        :link1="'{{url('/plancidades')}}'"
        :telatual="'Revisar Indicador de Objetivo Estratégico'">

    </historico-navegacao>


    <div class="main-content pl-sm-3 mt-5 container-fluid" id="main-content">

        <cabecalho-relatorios :botaoEditar='false' titulo="{{$dadosIndicador->txt_denominacao_indicador}}"
            :linkcompartilhar="'{{ url("/") }}'"
            :barracompartilhar="false">
        </cabecalho-relatorios>
        <p>
           Nesta página, você poderá visualizar todas as informações do indicador, suas metas e regionalizações (caso houver).
           <br>
           Ao final da página, selecione a nova situação do monitoramento após análise, bem como registre eventuais necessidades de ajuste antes de salvar.
        </p>
        
        <hr>

            <edita-revisao-indicador 
            :url="'{{ url('/') }}'"
            :dados-indicador="{{json_encode($dadosIndicador)}}"
            :dados-regionalizacao="{{json_encode($dadosRegionalizacao)}}"
            >
            </edita-revisao-indicador>
            <span class="br-divider sm my-3"></span>
        
    </div>
@endsection