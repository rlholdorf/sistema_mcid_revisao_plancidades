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
                :telanterior01="'Administrador'"
                :telanterior02="'Usuários'"
                :telanterior03="'Filtro de Usuários'"
                :link3="'{{ url('/admin/usuarios/filtro') }}'"
                :telanterior04="'Relação de Usuários'"
                :telatual='"Dados do Usuário"'

          
            >
            </historico-navegacao>  

          
<div class="main-content pl-sm-3 mt-5" id="main-content">

    <cabecalho-relatorios
            :titulo="'{{strtoupper($usuario->name)}}'"
            :subtitulo1="'{{$usuario->tipoUsuario->txt_tipo_usuario}}'"
            subtitulo2="{{$usuario->txt_cargo}}"
            @if($usuario->setor_id) :subtitulo3="' {{$usuario->setor->txt_nome_setor}}'"@endif
            subtitulo4="{{$usuario->entePublico->municipio->txt_nome_sem_acento}}-{{$usuario->entePublico->municipio->uf->txt_sigla_uf}}"
            

            :dataatualizacao="'{{date('d/m/Y',strtotime($usuario->updated_at))}}'"
            :linkcompartilhar="'{{ url("/admin/usuario/$usuario->id") }}'"
          
            :barracompartilhar="true"           
            >  
            
            <div class="text-center">
                @if($usuario->status_usuario_id  == 2 || $usuario->status_usuario_id  == 3)
                     <span class="feedback danger" role="alert">
                         <i class="fas fa-times-circle" aria-hidden="true"></i>{{$usuario->statusUsuario->txt_status_usuario}}
                     </span>
                 @elseif($usuario->status_usuario_id  == 1)
                     <span class="feedback success" role="alert">
                         <i class="fas fa-times-circle" aria-hidden="true"></i>{{$usuario->statusUsuario->txt_status_usuario}}
                     </span>
                 @else 
                     <span class="feedback warning" role="alert">
                         <i class="fas fa-times-circle" aria-hidden="true"></i>{{$usuario->statusUsuario->txt_status_usuario}}
                     </span>
                 @endif
            </div>
            @if(!$usuario->bln_ativo && $usuario->modulo_sistema_id != 2)
            <div class="br-message danger" role="alert">
                <div class="icon"><i class="fas fa-times-circle fa-lg" aria-hidden="true"></i>
                </div>
                <div class="content"><span class="message-title">Favor atualizar seus dados pessoais</span><span class="message-body"> </span></div>
                
              </div>
              @endif
    </cabecalho-relatorios> 

    <h4>Dados do Usuário </h4> 
    <span class="br-divider my-3"></span>   
        
    <form method="POST" action="{{ route('atualizarUsuario') }}" aria-label="{{ __('Atualizar') }}">
        @csrf
        <input type="hidden" id="usuario_id" name="usuario_id" value="{{$usuario->id}}">

        <div class="card">        
            <div class="card-body">   
                
                        <div class="form-group">
                            <div class="row">
                                <div class="column col-xs-12 col-md-3">
                                    <label class="control-label ">CPF</label>
                                    <input id="txt_cpf_usuario" type="text" class="form-control" name="txt_cpf_usuario" value="{{empty(old('txt_cpf_usuario')) ? $usuario->txt_cpf_usuario : old('txt_cpf_usuario')}}" @if(!empty($usuario->txt_cpf_usuario)) disabled @endif required>
                                    @if(!empty($usuario->txt_cpf_usuario))<input id="txt_cpf_usuario" type="hidden" class="form-control" name="txt_cpf_usuario" value="{{$usuario->txt_cpf_usuario}}"> @endif
            
                                    @if ($errors->has('txt_cpf_usuario'))
                                        <span class="help-block text-danger">
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
                        
                        <modulo-sistema
                            :url="'{{ url('/') }}'" 
                            :colinput="'column col-xs-12'"
                            :collabel="'column col-xs-12 col-form-label text-md-left'"
                            v-bind:dados="{{json_encode($usuario)}}">
                        </modulo-sistema>                         

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
                        @if($usuario->modulo_sistema_id == 1)
                            <setores-ministerio
                            :url="'{{ url('/') }}'" 
                            v-bind:dados="{{json_encode($usuario)}}">
                            </setores-ministerio>
                    @endif

                
                    
            </div>            
        </div>
        @if(count($dadosArquivoOficio) > 0)
        <h4>Documentos</h4> 
        <span class="br-divider my-3"></span>   
                 
            <div class="card">        
                <div class="card-body">                
                    <div class="form-group">
                       <div class="row">                                
                            <div class="table-responsive-sm">
                                <table class="table table-hover">
                                    <thead>
                                        <tr class="text-center" >                                    
                                            <th>Tipo</th>
                                            <th>Data de Envio</th>
                                            <th>Situação</th>
                                            <th>Motivo Indeferimento</th>
                                            <th>Analisado Por</th>
                                            <th>Data Análise</th>
                                            <th>Arquivo</th>     
                                        </tr>
                                    </thead>
                                    <tbody> 
                                        @foreach($dadosArquivoOficio as $dados)   
                                            @if($dados->bln_documento_analisado)
                                                @if($dados->bln_documento_validado)                             
                                                    <tr class="text-center table-primary"> 
                                                @else
                                                    <tr class="text-center table-danger"> 
                                                @endif
                                            @else
                                                <tr class="text-center table-warning"> 
                                                @endif
                                                <th>Ofício Assinado pela autoridade máxima</th>
                                                <td> {{date('d/m/Y',strtotime($dados->dte_envio))}} </td>    
                                                <td>
                                                    @if($dados->bln_documento_analisado)
                                                        @if($dados->bln_documento_validado)
                                                            Ofício Validado
                                                        @else
                                                            Ofício Inválido
                                                        @endif
                                                    @else
                                                        Aguardando Análise
                                                    @endif
                                                </td>      
                                                <td> {{$dados->txt_tipo_indeferimento}} </td>
                                                <td> {{$dados->txt_analisado_por}} </td>    
                                                <td> @if($dados->dte_validacao){{date('d/m/Y',strtotime($dados->dte_validacao))}} @endif</td>  
                                                <td>
                                                    <button type="button" class="br-button circle secondary small mr-3" aria-label="Ícone ilustrativo" 
                                                    onclick="window.open('/{{$dados->txt_caminho_arquivo}}');">
                                                    
                                                        <i class="fas fa-file-pdf" aria-hidden="true"></i>
                                                    </button>          
                                                </td>
                                            
                                            </tr>  
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>                        
                    </div>
                </div>            
            </div>
            @endif   

            
                <div class="p-3 text-right">
                    @if($usuario->modulo_sistema_id != 2 && (($idUsuarioLogado==$usuario->id) || (Auth::user()->tipo_usuario_id == 1)))
                        <button class="br-button primary mr-3" type="submit" > {{ __('Salvar') }}
                        </button>
                        @endif   
                        <button class="br-button danger mr-3" type="button" onclick="javascript:window.history.go(-1)">Fechar
                    </button>
                </div>             
               
       
            </form>



</div>

@endsection


