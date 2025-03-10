@extends('layouts.app')

@section('scriptscss')
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/custom.css')}}"  media="screen" />
<link rel="stylesheet" type="text/css" href="{{ asset('css/relatorio_executivo.css') }}"  media="screen" > 

@endsection


@section('content')




<historico-navegacao
      :url="'{{ url('/home') }}'"      
      :telanterior01="'Propostas'"  
      :telatual="'Consultar Resultados'"
      >

</historico-navegacao>


<div class="main-content pl-sm-3 mt-5" id="main-content" style="min-height: 100% width 100%">
  
    <cabecalho-relatorios
        :titulo="'Consulta Resultados'"
        
       barracompartilhar="false">
    </cabecalho-relatorios> 

    
    <div class="form-group">               
       <p>
        Este formulário permite que você filtre as propostas selecionada via sistema de cadastramento ou via formulário web. Ele permite que consulte
         selecionando as opções de filtro, disponibilizando uma lista de proposta com base
        nos parâmetros selecionados.
       </p>
       <span class="br-divider my-3"></span>

       
       <form action="{{ url('/selecao/resultados/pesquisar') }}" role="form" method="POST">
        {{ csrf_field() }}
            <div class="row">
                <filtro-resultado
                url='{{ url("/") }}' >
                    </filtro-resultado>      
                    
            </div>

           
        </form>
        <span class="br-divider my-3"></span>

       
      
     
    </div>   

                        
   

   

</div>
@endsection


