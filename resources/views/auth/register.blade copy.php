@extends('layouts.app')

@section('content')

<historico-navegacao
      :url="'{{ url('/home') }}'"      
      :telanterior01="'Administrador'"    
      :telanterior02="'Usuários'"    
      :telatual="'Cadastro de Usuários'"
      >

</historico-navegacao>

<div class="main-content pl-sm-3 mt-5" id="main-content">

    <cabecalho-form
            :titulo="'Cadastro de Usuários'"
            :barracompartilhar="false"           
            >                        
    </cabecalho-form> 

    <div class="container">
        <div class="row justify-content-center">
            <div class="column col-xs-12">
                <div class="card">
                    <div class="card-header"></div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('registrar') }}" aria-label="{{ __('Cadastrar') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="name" class="column col-xs-12 col-form-label text-md-left">{{ __('Nome') }}</label>

                                <div class="column col-xs-12">
                                    <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                    @if ($errors->has('name'))
                                    <span class="feedback danger" role="alert">
                                        <i class="fas fa-times-circle" aria-hidden="true"></i>{{ $errors->first('name') }}
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="column col-xs-12 col-form-label text-md-left">{{ __('E-Mail Usuário') }}</label>

                                <div class="column col-xs-12">
                                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                    @if ($errors->has('email'))
                                            <span class="feedback danger" role="alert">
                                                <i class="fas fa-times-circle" aria-hidden="true"></i>{{ $errors->first('email') }}
                                            </span>
                                       
                                    @endif
                                </div>
                            </div>

                            <registro-usuario
                                    :url="'{{ url('/') }}'" 
                                    :colinput="'column col-xs-12'"
                                    :collabel="'column col-xs-12 col-form-label text-md-left'">

                            </registro-usuario>

                        

                            <div class="form-group row">
                                <label for="password" class="column col-xs-12 col-form-label text-md-left">{{ __('Senha') }}</label>

                                <div class="column col-xs-12">
                                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                    @if ($errors->has('password'))
                                    <span class="feedback danger" role="alert">
                                        <i class="fas fa-times-circle" aria-hidden="true"></i>{{ $errors->first('password') }}
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm" class="column col-xs-12 col-form-label text-md-left">{{ __('Confirme a senha') }}</label>

                                <div class="column col-xs-12">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                </div>
                            </div>

                            <div class="p-3 text-right">
                                <button class="br-button primary mr-3" type="submit" > {{ __('Registrar') }}
                                </button>
                                     <button class="br-button danger mr-3" type="button" onclick="window.location.href='/home'">Fechar
                                </button>
                              </div>  

                           
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
