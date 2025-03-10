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
            :titulo="'{{strtoupper($usuario->name)}}'"
            :subtitulo1="'{{$usuario->tipoUsuario->txt_tipo_usuario}}'"
            :dataatualizacao="'{{$usuario->updated_at->format('d/m/Y')}}'"
            @if(Auth::user()->modulo_sistema_id==2)
                :linkcompartilhar="'{{ url("/ente_publico/usuario/$usuario->id") }}'"                        
            @else
                :linkcompartilhar="'{{ url("/usuario/$usuario->id") }}'"
            @endif
            :barracompartilhar="false"           
            >                        
    </cabecalho-relatorios> 

    <h4>Dados do Usuário </h4> 
    <span class="br-divider my-3"></span>   
        <form class="form-horizontal" role="form" method="POST" action='{{ url("usuario/atualizar/$usuario->id") }}'> 
            @csrf        
        <div class="card">        
            <div class="card-body">                
                <div class="form-group">
                    <div class="row">
                        <div class="column col-xs-12 col-md-4">
                            <label class="control-label ">Status</label>
                            <input id="txt_status_usuario" type="text" class="form-control" name="txt_status_usuario" value="{{empty(old('txt_status_usuario')) ? $usuario->statusUsuario->txt_status_usuario : old('txt_status_usuario')}}" disabled>
    
                            @if ($errors->has('txt_status_usuario'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('txt_status_usuario') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="column col-xs-12 col-md-4">
                            <label class="control-label">Atualizado em</label>
                            <input id="updated_at" type="text" maxlength="9" class="form-control" name="updated_at" value="{{empty($usuario->updated_at->format('d/m/Y')) ? old('updated_at'): $usuario->updated_at->format('d/m/Y')}}" disabled >
    
                            @if ($errors->has('updated_at'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('updated_at') }}</strong>
                                </span>
                            @endif
                        </div> 
                        
                        <div class="column col-xs-12 col-md-4">
                            
                            @if(Auth::user()->tipo_usuario_id == 1)
                                <select-component 
                                    :dados="{{$tipoUsuario}}"
                                    textolabel="Tipo Usuário"
                                    nomecampo="tipo_usuario_id"
                                    textoescolha="Escolha um Tipo de Usuário"
                                    :selecionado="{{$usuario->tipo_usuario_id}}"
                                >
                                </select-compenent>
                            @else
                                 <label class="control-label">Tipo Usuário</label>
                                <input id="txt_tipo_usuario" type="text" class="form-control" name="txt_tipo_usuario" value="{{empty(old('txt_tipo_usuario')) ? $usuario->tipoUsuario->txt_tipo_usuario : old('txt_tipo_usuario')}}"  disabled>
                            @endif

                            @if ($errors->has('txt_tipo_usuario'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('txt_tipo_usuario') }}</strong>
                                </span>
                            @endif
                        </div>
                         
                    </div>
                </div><!-- fechar primeiro form-group-->
                <div class="form-group">
                    <div class="row">
                        <div class="column col-xs-12 col-md-3">
                            <label class="control-label ">CPF</label>
                            <input id="txt_cpf_usuario" type="text" class="form-control" name="txt_cpf_usuario" value="{{empty(old('txt_cpf_usuario')) ? $usuario->txt_cpf_usuario : old('txt_cpf_usuario')}}" @if(!empty($usuario->txt_cpf_usuario)) disabled @endif required>
    
                            @if ($errors->has('txt_cpf_usuario'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('txt_cpf_usuario') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="column col-xs-12 col-md-6">
                            <label class="control-label ">Nome</label>
                            <input id="txt_nome" type="text" class="form-control" name="txt_nome" value="{{empty(old('txt_nome')) ? strtoupper($usuario->name) : old('txt_nome')}}" required >
    
                            @if ($errors->has('txt_nome'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('txt_nome') }}</strong>
                                </span>
                            @endif
                        </div>
                        
                        <div class="column col-xs-12 col-md-3">
                            <label class="control-label">Cargo</label>
                            <input id="txt_cargo" type="text" class="form-control" name="txt_cargo" value="{{empty(old('txt_cargo')) ? $usuario->txt_cargo : old('txt_cargo')}}" required >
    
                            @if ($errors->has('txt_cargo'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('txt_cargo') }}</strong>
                                </span>
                            @endif
                        </div>                         
                    </div>
                </div><!-- fechar segundo form-group-->
                
                @if($usuario->modulo_sistema_id == 1)           
                    <select-unidade-organizacional 
                            colunidorg="column col-xs-12 col-sm-5"
                            colsetor="column col-xs-12 col-sm-7"
                            requersetor="true"
                            requerunidorg="true"
                            @if($usuario->setor_id) :setorselecionado= "@if(old('setor')) {{ old('setor') }} @else {{$usuario->setor_id}} @endif" @endif
                            @if($usuario->setor_id) :unidorgselecionada= "'{{$usuario->setor->unidade_organizacional_id}}'"@endif                            
                            :url="'{{ url('/') }}'">
                    </select-unidade-organizacional>
                @endif

                <div class="form-group">
                    <div class="row">
                        <div class="column col-xs-12 col-md-6">
                            <label class="control-label ">Email</label>
                            <input id="email" type="text" class="form-control" name="email" value="{{empty(old('email')) ? $usuario->email : old('email')}}" disabled >
    
                            @if($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{$errors->first('email')}}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="column col-xs-12 col-md-1">
                            <label class="control-label">DDD</label>
                            <input id="txt_ddd_fixo" type="text" maxlength="2" class="form-control" name="txt_ddd_fixo" value="{{empty(old('txt_ddd_fixo')) ? $usuario->txt_ddd_fixo : old('txt_ddd_fixo')}}" required >
    
                            @if ($errors->has('txt_ddd_fixo'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('txt_ddd_fixo') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="column col-xs-12 col-md-2">
                            <label class="control-label">Telefone/Ramal</label>
                            <input id="txt_telefone_fixo" type="text" maxlength="9" class="form-control" name="txt_telefone_fixo" value="{{empty($usuario->txt_telefone_fixo) ? old('txt_telefone_fixo'): $usuario->txt_telefone_fixo}}" required >
    
                            @if ($errors->has('txt_telefone_fixo'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('txt_telefone_fixo') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="column col-xs-12 col-md-1">
                            <label class="control-label">DDD</label>
                            <input id="txt_ddd_movel" type="text" maxlength="2" class="form-control" name="txt_ddd_movel" value="{{empty(old('txt_ddd_movel')) ? $usuario->txt_ddd_movel : old('txt_ddd_movel')}}"  >
    
                            @if ($errors->has('txt_ddd_movel'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('txt_ddd_movel') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="column col-xs-12 col-md-2">
                            <label class="control-label">Celular</label>
                            <input id="txt_telefone_movel" type="text" maxlength="9" class="form-control" name="txt_telefone_movel" value="{{empty($usuario->txt_telefone_movel) ? old('txt_telefone_movel'): $usuario->txt_telefone_movel}}"  >
    
                            @if ($errors->has('txt_telefone_movel'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('txt_telefone_movel') }}</strong>
                                </span>
                            @endif
                        </div>
                         
                    </div>
                </div><!-- fechar terceiro form-group-->
              
                    @if(($idUsuarioLogado==$usuario->id) || (Auth::user()->tipo_usuario_id == 1))
                        <div class="p-3 text-right">
                            
                            <button class="br-button danger mr-3" type="button" onclick="window.location.href='/home'">Fechar
                            </button>
                        </div> 
                    @endif    
                
             </form>   

        </div>
    </div>




</div>

@endsection


