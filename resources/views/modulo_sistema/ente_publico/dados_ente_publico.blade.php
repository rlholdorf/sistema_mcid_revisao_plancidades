@extends('layouts.app')

@section('scriptscss')
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/custom.css')}}"  media="screen" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/relatorio_executivo.css') }}"  media="screen" > 
@endsection


@section('content')

  
    <div id="content"> 
        
        <div id="content-core"> 
            <historico-navegacao

            @if(Auth::user()->modulo_sistema_id==2)
                :url="'{{ url('/home') }}'"                
                :telanterior01="'Ente Público'"
                :telanterior02='"Usuários e Responsáveis"'
            @else
                :telanterior01="'Configurações'"    
                :telanterior02='"Usuário"'                
            @endif

            
            :telatual="'Dados do Usuário'"

          
            >
            </historico-navegacao>  

          
<div class="main-content pl-sm-3 mt-5" id="main-content">

    <cabecalho-relatorios
            :titulo="'{{strtoupper($entePublico->txt_ente_publico)}}'"
            :subtitulo1="'{{$entePublico->municipio->txt_nome_sem_acento}}'"
            :dataatualizacao="'{{$entePublico->updated_at->format('d/m/Y')}}'"
            @if(Auth::user()->modulo_sistema_id==2)
                :linkcompartilhar="'{{ url("/ente_publico/entePublico/$entePublico->id") }}'"                        
            @else
                :linkcompartilhar="'{{ url("/entePublico/$entePublico->id") }}'"
            @endif
            :barracompartilhar="false"           
            >                        
    </cabecalho-relatorios> 

    <h4>Dados do Ente Público </h4> 
    <span class="br-divider my-3"></span>   
        <form class="form-horizontal" role="form" method="POST" action='{{ url("ente_publico/atualizar/$entePublico->id") }}'> 
            @csrf        
        <div class="card">        
            <div class="card-body">                
                <div class="form-group">
                    <div class="row">
                        <div class="column col-xs-12 col-md-4">
                            <label class="control-label ">Cnpj</label>
                            <input id="ente_publico_id" type="text" class="form-control" txt_ente_publico="ente_publico_id" value="{{$entePublico->id}}" disabled>
    
                        </div>
                        <div class="column col-xs-12 col-md-4">
                        </div>
                        <div class="column col-xs-12 col-md-4">
                            <label class="control-label">Atualizado em</label>
                            <input id="updated_at" type="text" maxlength="9" class="form-control" txt_ente_publico="updated_at" value="{{empty($entePublico->updated_at->format('d/m/Y')) ? old('updated_at'): $entePublico->updated_at->format('d/m/Y')}}" disabled >                             
                        </div> 
                    </div>
                    <div class="row">
                        <div class="column col-xs-12 col-md-6">
                            <label class="control-label ">Nome</label>
                            <input id="txt_ente_publico" type="text" class="form-control" txt_ente_publico="txt_ente_publico" value="{{strtoupper($entePublico->txt_ente_publico)}}" required >
                        </div>

                        <div class="column col-xs-12 col-md-2">                                                      
                            <label class="control-label">UF</label>
                           <input id="txt_sigla_uf" type="text" class="form-control" txt_ente_publico="txt_sigla_uf" value="{{empty(old('txt_sigla_uf')) ? $entePublico->municipio->uf->txt_sigla_uf : old('txt_sigla_uf')}}"  disabled>
                        </div>
                   
                        <div class="column col-xs-12 col-md-4">
                            <label class="control-label ">Município</label>
                            <input id="ds_municipio" type="text" class="form-control" txt_ente_publico="ds_municipio" value="{{$entePublico->municipio->txt_nome_sem_acento}}" disabled>
                        </div>      
                    </div>
                </div><!-- fechar segundo form-group-->
                
               

                <div class="form-group">
                    <div class="row">
                        <div class="column col-xs-12 col-md-6 col-sm-6">
                            <label class="control-label ">Email</label>
                            <input id="txt_email_ente_publico" type="text" class="form-control" txt_ente_publico="txt_email_ente_publico" value="{{$entePublico->txt_email_ente_publico}}" disabled >
    
                        </div>
                        <div class="column col-xs-12 col-md-4  col-sm-4">
                            <label class="control-label">Autoridade Máxima</label>
                            <input id="txt_nome_chefe_executivo" type="text" maxlength="2" class="form-control" txt_ente_publico="txt_nome_chefe_executivo" value="{{$entePublico->txt_nome_chefe_executivo}}" required >
                        </div>                       
                        <div class="column col-xs-12 col-md-2 col-sm-2" >
                            <label class="control-label">Cargo</label>
                            <input id="txt_cargo_executivo" type="text" maxlength="2" class="form-control" txt_ente_publico="txt_cargo_executivo" value="{{$entePublico->txt_cargo_executivo}}" required >
                        </div>                       
                         
                    </div>
                </div><!-- fechar terceiro form-group-->
              
                  
                        <div class="p-3 text-right">
                            
                            <button class="br-button danger mr-3" type="button" onclick="window.location.href='/home'">Fechar
                            </button>
                        </div> 
                  
                
             </form>   

        </div>
    </div>




</div>

@endsection


