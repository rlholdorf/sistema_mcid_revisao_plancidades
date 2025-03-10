@extends('layouts.app')

@section('scriptscss')
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/custom.css')}}"  media="screen" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/relatorio_executivo.css') }}"  media="screen" > 
@endsection


@section('content')

<historico-navegacao
      :url="'{{ url('/home') }}'"      
      :telanterior01="'SACI WEB'"      
      :telatual="'Consultar contratos'"
      >

</historico-navegacao>


<div class="main-content pl-sm-3 mt-5" id="main-content">
  
    <cabecalho-form
       :titulo="'Consultar contratos'"
       :linkcompartilhar="'{{ url("/saci/propostas/") }}'"
       barracompartilhar="true">
    </cabecalho-form> 

    <p>
        Este forumulário permite consultar as informações disponibilizadas pelo SACI embasam o processo de trabalho e o monitoramento das intervenções 
        realizado rotineiramente pelas equipes técnicas das Secretarias finalísticas do Ministério das Cidades e fornecem elementos para a avaliação e 
        aperfeiçoamento de suas políticas públicas.
    </p>
    <form action="{{ url('/saci/contratos/pesquisar/') }}" role="form" method="POST">
        {{ csrf_field() }} 
        <filtro-contratos-saci 
                :url="'{{ url('/') }}'" >
        </filtro-contratos-saci>

        <div class="p-3 text-right">
            <button class="br-button primary mr-3" type="submit" name="Pesquisar">Pesquisar
            </button>
            <button class="br-button danger mr-3" type="button" onclick="javascript:window.history.go(-1)">Voltar
            </button>
          </div> 
    
          <span class="br-divider sm my-3"></span>
    
    </form> 

</div>

@endsection


