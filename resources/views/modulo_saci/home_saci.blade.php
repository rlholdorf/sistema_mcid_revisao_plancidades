@extends('layouts.app')

@section('scriptscss')
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/custom.css')}}"  media="screen" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/relatorio_executivo.css') }}"  media="screen" > 
@endsection

@section('content')


<div class="titulo">
    <h3>Contratos</h3>         
</div>
<div class="panel-body">
    <div class="row">            
            <div class="column col-xs-12 col-sm-6 col-md-3 text-center">
                <h4>
                    <a href='{{ url("saci/contratos/filtro") }}'>
                        <img src='{{ URL::asset("/img/icones/pesquisa.png")}}'  class="img-thumbnail img-responsive" >
                    </a>
                    <p>Consultar Contratos</p>
                </h4>
            </div>  
            <div class="column col-xs-12 col-sm-6 col-md-3 text-center">
             
            </div>  
            <div class="column col-xs-12 col-sm-6 col-md-3 text-center">
                
            </div>
            <div class="column col-xs-12 col-sm-6 col-md-3 text-center">
                
            </div>                    
       </div>
 </div>   

@endsection

