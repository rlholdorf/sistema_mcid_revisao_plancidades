@extends('layouts.app')

@section('scriptscss')
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/custom.css')}}"  media="screen" />
<link rel="stylesheet" type="text/css" href="{{ asset('css/relatorio_executivo.css') }}"  media="screen" > 

@endsection


@section('content')




<historico-navegacao
      :url="'{{ url('/home') }}'"      
      :telanterior01="'Briefing Ministerial'"  
      :telanterior02="'Ficha Briefing'"  
      :telatual="'Consultar'"
      >
     
</historico-navegacao>


<div class="main-content pl-sm-3 mt-5" id="main-content">

    <cabecalho-relatorios
        :titulo="'Consultar'"
        :linkcompartilhar="'{{ url("/briefing/ficha_briefing/consultar") }}'"                       
         barracompartilhar="true">


    </cabecalho-relatorios> 

    <div class="form-group">               
        <p>
         Este formulário permite que você filtre um resumo da carteira de investimento do município. Ele permite que consulte
         um município específico, selecionando as opções de filtro.
        </p>
        <span class="br-divider my-3"></span>
        <form action="{{ url('/briefing/ficha_briefing/pesquisar') }}" role="form" method="POST">
         {{ csrf_field() }}
             <div class="row">
                <filtro-ficha-audiencia
                    url='{{ url("/") }}'
                
                    >

            </filtro-ficha-audiencia>
            
        </form>


      
     
    </div>   


</div>
@endsection


