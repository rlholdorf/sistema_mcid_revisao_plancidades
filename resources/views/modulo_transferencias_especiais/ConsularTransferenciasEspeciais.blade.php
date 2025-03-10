@extends('layouts.app')

@section('scriptscss')
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/custom.css')}}"  media="screen" />
<link rel="stylesheet" type="text/css" href="{{ asset('css/relatorio_executivo.css') }}"  media="screen" > 

@endsection


@section('content')




<historico-navegacao
      :url="'{{ url('/home') }}'"      
      :telanterior01="'Transferências Especiais'"        
      :telatual="'Consultar Contratos'"
      >
     
</historico-navegacao>


<div class="main-content pl-sm-3 mt-5" id="main-content">

    <cabecalho-relatorios
        :titulo="'Transferências Especiais'"
        :linkcompartilhar="'{{ url("/trasnferencias_especiais/consultarr") }}'"                       
         barracompartilhar="true">
    </cabecalho-relatorios> 

    <div class="form-group">               
        
        
        <form action="{{ url('/transferencias_especiais/pesquisar') }}" role="form" method="GET">
         {{ csrf_field() }}
             <div class="row">
                <filtro-tansferencias-especiais
                    url='{{ url("/") }}'
                
                    >

                </filtro-tansferencias-especiais>
            
        </form>  
        
        <div class="p-3 text-right">      
            <button class="br-button primary mr-3" type="submit" name="Pesquisar">Pesquisar 
            </button>
        
  
        <button class="br-button danger mr-3" type="button" onclick="javascript:window.history.go(-1)">Voltar
        </button>
      </div> 
    </div>   
</div>
@endsection


