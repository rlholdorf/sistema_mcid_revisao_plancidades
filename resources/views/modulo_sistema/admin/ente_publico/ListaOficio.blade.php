@extends('layouts.app')

@section('scriptscss')
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/custom.css')}}"  media="screen" />
<link rel="stylesheet" type="text/css" href="{{ asset('css/relatorio_executivo.css') }}"  media="screen" > 

@endsection


@section('content')




<historico-navegacao
      :url="'{{ url('/home') }}'"      
      :telanterior01="'Propostas'"  
      :telanterior02="'Consultar Ofícios'"  
      :telatual="'Ofícios Enviados'"
      >

</historico-navegacao>


<div class="main-content pl-sm-3 mt-5" id="main-content" style="min-height: 100% width 100%">
  
    <cabecalho-relatorios
        :titulo="'Ofícios Enviados'"
        
       barracompartilhar="false">
    </cabecalho-relatorios> 

    
    <div class="form-group">                     

       

        <tabela-oficios
            v-bind:titulos="{{json_encode($cabecalhoTab)}}"
            v-bind:itens="{{json_encode($arquivosOficio)}}" 
            url='{{ url("/") }}' 
        >
        </tabela-oficios> 

        <div class="p-3 text-right">
            <button class="br-button primary mr-3" type="button" name="imprimir" value="Imprimir" onclick="window.print();">Imprimir
            </button>
            <button class="br-button danger mr-3" type="button" onclick="javascript:window.history.go(-1)">Voltar
            </button>
        </div> 
    </div>   

                        
   

   

</div>
@endsection


