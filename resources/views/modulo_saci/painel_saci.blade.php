@extends('layouts.app')

@section('scriptscss')
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/custom.css')}}"  media="screen" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/relatorio_executivo.css') }}"  media="screen" > 
@endsection

@section('content')

  
    <div id="content"> 
        
        <div id="content-core"> 
            
            <cabecalho-form
                    :titulo="'Painel de controle'"
                    :barracompartilhar="false"           
                    >                        
            </cabecalho-form> 

                <div class="card" >
                    <div class="card-body">      
                        <div class="titulo">
                            <h3>Saci WEB</h3>         
                            </div>                
                    <div class="row"> 
                
                        <div class="column col-xs-12 col-sm-6 col-md-3 text-center">
                            <h5>
                                <a href="{{ url('/saci/contratos/filtro') }}" title="Consultar Contratos" class="state-published">
                                    <img src='{{ URL::asset("/img/icones/pesquisar.png")}}'  class="img-thumbnail" >
                                </a>
                                <p>Consultar Contratos</p>
                            </h5>
                        </div>
                        <div class="column col-xs-12 col-sm-6 col-md-3 text-center">
                            
                        </div>
                        <div class="column col-xs-12 col-sm-6 col-md-3 text-center">
                           
                        </div>
                        <div class="column col-xs-12 col-sm-6 col-md-3 text-center">
                           
                        </div>
                                         
                    </div>
                </div> 
            </div> 

</div> 
</div>  
    <!-- content-core -->
</div>    
<!-- content -->
@endsection

