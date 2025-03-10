@extends('layouts.app')

@section('scriptscss')
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/custom.css')}}"  media="screen" />
<link rel="stylesheet" type="text/css" href="{{ asset('css/relatorio_executivo.css') }}"  media="screen" > 

@endsection


@section('content')




<historico-navegacao
      :url="'{{ url('/') }}'"      
      :telanterior01="'Propostas'"  
      :telatual="'Consultar Situação Propostas RPs'"
      >

</historico-navegacao>


<div class="main-content pl-sm-3 mt-5" id="main-content" style="min-height: 100% width 100%">
  
    <cabecalho-relatorios
        :titulo="'Consultar Situação Propostas RPs'"
        
       barracompartilhar="false">
    </cabecalho-relatorios> 

    
    <div class="form-group">   
            

       <p>
        Este formulário permite que você filtre as propostas cadastradas no Portal do Transferegov selecionando as opções de filtro ou todas as propostas caso não selecione nenhum filtro. Nesse caso será disponibilizado uma lista de proposta com base
        nos parâmetros selecionados.
       </p>
       <span class="br-divider my-3"></span>
       <form action="{{ url('/admin/transferegov/rps/pesquisar') }}" role="form" method="POST">
        {{ csrf_field() }}
            <div class="row">
                <filtro-rps
                url='{{ url("/") }}'
                
                :blnbtnpesquisar='false' 
                >
                    </filtro-rps>      
                    
            </div>

           
        </form>


      
     
    </div>   

                        
   

   

</div>
@endsection


