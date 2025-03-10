@extends('layouts.app')

@section('scriptscss')
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/custom.css')}}"  media="screen" />
<link rel="stylesheet" type="text/css" href="{{ asset('css/relatorio_executivo.css') }}"  media="screen" > 

@endsection


@section('content')




<historico-navegacao
      :url="'{{ url('/') }}'"      
      :telanterior01="'Propostas'"  
      :telatual="'Consultar Propostas Selecionadas'"
      >

</historico-navegacao>


<div class="main-content pl-sm-3 mt-5" id="main-content" style="min-height: 100% width 100%">
  
    <cabecalho-relatorios
        :titulo="'Consulta Selecionadas'"
        
       barracompartilhar="false">
    </cabecalho-relatorios> 

    
    <div class="form-group">   
        <p>
            O Ministério das Cidades informa que devido ao número elevado de propostas, até o momento foram recebidas mais 12 mil, as propostas selecionadas serão 
            publicadas conforme forem analisadas. Destaca-se que com o lançamento do sistema de cadastro de propostas discricionárias, a divulgação dos resultados
             passou por um processo evolutivo, sempre visando maior confiabilidade, transparência e isonomia do processo.
        </p>
     

       <p>
        Este formulário permite que você filtre as propostas selecionadas selecionando as opções de filtro ou todas as propostas caso não selecione nenhum filtro. Nesse caso será disponibilizado uma lista de proposta com base
        nos parâmetros selecionados.
       </p>
       <span class="br-divider my-3"></span>
       <form action="{{ url('/admin/propostas/selecionadas/pesquisar') }}" role="form" method="POST">
        {{ csrf_field() }}
            <div class="row">
                <filtro-propostas
                url='{{ url("/") }}'
                :blnsituacaopropostas='false'
                :blnprotocolo='false' 
                :blnsistema='false' 
                :blnselecao='false' 
                :blnbtnpesquisar='false' 
                >
                    </filtro-propostas>      
                    
            </div>

           
        </form>


      
     
    </div>   

                        
   

   

</div>
@endsection


