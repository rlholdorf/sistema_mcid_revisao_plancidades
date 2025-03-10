@extends('layouts.app')

@section('scriptscss')
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/custom.css')}}"  media="screen" />
<link rel="stylesheet" type="text/css" href="{{ asset('css/relatorio_executivo.css') }}"  media="screen" > 

@endsection


@section('content')




<historico-navegacao
      :url="'{{ url('/home') }}'"      
      :telanterior01="'Propostas'"  
      :telatual="'Proposta Ente'"
      >

</historico-navegacao>


<div class="main-content pl-sm-3 mt-5" id="main-content">
  
    <cabecalho-relatorios
        :titulo="'Consulta de Ente Público'"
        
       barracompartilhar="false">
    </cabecalho-relatorios> 

    
    <div class="form-group">               
        <div class="titulo"><h3>Dados do Usuário </h3> </div>             
        

        <div class="row">
            <div class="column col-xs-12 col-md-12">
                <label class="control-label label-relatorio">CPF do Usuário</label>
                <input id="txt_cpf_usuario" type="text" class="form-control input-relatorio" name="txt_cpf_usuario">
            </div>       
                
        </div>

              
    </div>   

                        
   

   

</div>
@endsection


