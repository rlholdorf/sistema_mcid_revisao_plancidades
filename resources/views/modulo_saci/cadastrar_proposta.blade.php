@extends('layouts.app')

@section('scriptscss')
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/custom.css')}}"  media="screen" />

@endsection


@section('content')



<historico-navegacao
      :url="'{{ url('/home') }}'"      
      :telanterior01="'SACI WEB'"      
      :telatual="'Cadastro da Proposta'"
      >

</historico-navegacao>


<div class="main-content pl-sm-3 mt-5" id="main-content">
  
    <cabecalho-form
       :titulo="'Cadastro da Proposta'"
       :linkcompartilhar="'{{ url("/empreendimentos/filtro") }}'"
       barracompartilhar="true">
    </cabecalho-form> 

    <form action="{{ url('/saci/propostas/salvar/') }}" role="form" method="POST" enctype="multipart/form-data">
        <input type="hidden" id="cod_usuario" name="cod_usuario" value="{{$usuarioPAC->cod_usuario}}">
        @csrf
        <div class="titulo">
            <h5>Dados do Contrato</h5> 
        </div>
        
        <form-cad-contratos-pac
                    :url="'{{ url('/') }}'" >

                    <div class="p-3 text-right">
                        <button class="br-button primary mr-3" type="submit" name="Cadastrar">Cadastrar
                        </button>
                        <button class="br-button danger mr-3" type="button" onclick="javascript:window.history.go(-1)">Voltar
                        </button>
                      </div> 
        </form-cad-contratos-pac>

        
    
    
    
       
    </form> 



</div>

@endsection


