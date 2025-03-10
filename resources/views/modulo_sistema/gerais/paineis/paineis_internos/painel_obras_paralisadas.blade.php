@extends('layouts.app')

@section('scriptscss')
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/custom.css')}}"  media="screen" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/relatorio_executivo.css') }}"  media="screen" > 
@endsection


@section('content')

  
    <div id="content"> 
        
        <div id="content-core"> 
            <historico-navegacao
                :url="'{{ url('/home') }}'"  
                :telanterior01="'Acesso à Informação'"
                :telanterior02="'Painéis de informações'"
                :telatual="'Painéis Internos'"          
            >
            </historico-navegacao>  

          
<div class="main-content pl-sm-3 mt-5" id="main-content">

    <cabecalho-relatorios
            :titulo="'Painéis Internos'"            
            :dataatualizacao="''"
            :linkcompartilhar="'{{ url("/paineis/internos") }}'"
          
            :barracompartilhar="true"           
            >  
            
    </cabecalho-relatorios> 

    <p>Dados do Usuário </p> 
    <span class="br-divider my-3"></span>   
             
        <div class="card">        
            <div class="card-body">  
                <iframe 
                width="1080"
                height="1080"
                    src="https://app.powerbi.com/view?r=eyJrIjoiYWMzM2Y4MWEtZGQyMy00N2NjLWI5OTctNDdiNDIyNGRmODNmIiwidCI6Ijk2MTFlY2UxLTM0MTQtNGMzNS1hM2YwLTdkMTAwNDI5MGNkNiJ9&pageName=ReportSectionb028005f0c703d746998"
                    frameborder="0"
                    allowFullScreen="true">
                    
                </iframe>

                <div class="form-group">
                    <div class="row">
                        
                    </div>                    
                </div><!-- fechar form-group-->
            </div>            
        </div>      
       
</div>

@endsection


