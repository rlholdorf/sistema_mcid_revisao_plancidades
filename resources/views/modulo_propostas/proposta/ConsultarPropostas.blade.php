@extends('layouts.app')

@section('scriptscss')
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/custom.css')}}"  media="screen" />
<link rel="stylesheet" type="text/css" href="{{ asset('css/relatorio_executivo.css') }}"  media="screen" > 

@endsection


@section('content')




<historico-navegacao
      :url="'{{ url('/home') }}'"      
      :telanterior01="'Propostas'"  
      :telatual="'Consultar Propostas'"
      >

</historico-navegacao>


<div class="main-content pl-sm-3 mt-5" id="main-content" style="min-height: 100% width 100%">
  
    <cabecalho-relatorios
        :titulo="'Consulta Propostas'"
        
       barracompartilhar="false">
    </cabecalho-relatorios> 

    
    <div class="form-group">               
       <p>
        Este formulário permite que você filtre as propostas cadastradas via sistema de cadastramento ou via formulário web. Ele permite que consulte
        uma proposta específica, por meio do número de protocolo, ou selecionando as opções de filtro, nesse caso será disponibilizado uma lista de proposta com base
        nos parâmetros selecionados.
       </p>
       <span class="br-divider my-3"></span>
       <form action="{{ url('/selecao/propostas/pesquisar') }}" role="form" method="POST">
        {{ csrf_field() }}
            <div class="row">
                <filtro-propostas
                url='{{ url("/") }}' 
                :blnsituacaopropostas='true'
                :blnprotocolo='true' 
                :blnsistema='true' 
                :blnselecao='true' 
                :blnbtnpesquisar='true' 
                :blntransferegov='true'
                >
                    </filtro-propostas>      
                    
            </div>

           
        </form>


      
     
    </div>   

                        
   

   

</div>
@endsection


