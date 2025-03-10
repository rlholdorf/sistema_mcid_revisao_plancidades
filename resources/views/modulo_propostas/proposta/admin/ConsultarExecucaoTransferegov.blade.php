@extends('layouts.app')

@section('scriptscss')
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/custom.css')}}"  media="screen" />
<link rel="stylesheet" type="text/css" href="{{ asset('css/relatorio_executivo.css') }}"  media="screen" > 

@endsection


@section('content')




<historico-navegacao
      :url="'{{ url('/') }}'"      
      :telanterior01="'Propostas'"  
      :telanterior02="'Transferegov'"  
      :telatual="'Consultar Execução Orçamentária'"
      >

</historico-navegacao>


<div class="main-content pl-sm-3 mt-5" id="main-content" style="min-height: 100% width 100%">
  
    <cabecalho-relatorios
        :titulo="'Consulta Execução Orçamentária'"
        
       barracompartilhar="false">
    </cabecalho-relatorios> 

    
    <div class="form-group">   
        
       <p>
        Este formulário permite que você filtre as ações e sua situação no Portal do transferegov selecionando as opções de filtro ou todas as propostas caso não selecione nenhum filtro. Nesse caso será disponibilizado uma lista de proposta com base
        nos parâmetros selecionados.
       </p>
       <span class="br-divider my-3"></span>
       <form action="{{ url('/admin/transferegov/execucao_orcamentaria/pesquisar') }}" role="form" method="POST">
        {{ csrf_field() }}
            <div class="row">
                <filtro-execucao-transferegov
                url='{{ url("/") }}'               
                >
                    </filtro-execucao-transferegov>      
                    
            </div>

           
        </form>


      
     
    </div>   

                        
   

   

</div>
@endsection


