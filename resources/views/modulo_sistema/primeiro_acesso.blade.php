@extends('layouts.app')

@section('scriptscss')
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/custom.css')}}"  media="screen" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/relatorio_executivo.css') }}"  media="screen" > 
@endsection

@section('content')

  
    <div id="content"> 
        
        <div id="content-core"> 
           
            <cabecalho-form
                    :titulo="'Atualizar senha de acesso'"
                    :subtitulo1="'{{$usuario->name}}'"
                    :barracompartilhar="false">
                   
            </cabecalho-form> 
            <form class="form-horizontal" role="form" method="POST" action='{{ url("/usuario/update/primeiro_acesso") }}'>    
                {{ csrf_field() }}

                
     
    
             
            <div class="form-group">
                <p>
                    Para garantir a segurança e proteção de suas informações no sistema, solicitamos que crie uma nova senha com no mínimo 6 dígitos para acessar sua conta. A senha deve ser única e pessoal, evitando o compartilhamento com terceiros.
                </p>
                <p>    
                    Pedimos que escolha uma combinação de caracteres que seja fácil de lembrar, mas ao mesmo tempo, difícil de ser adivinhada por outros. Recomendamos o uso de letras maiúsculas, letras minúsculas, números e caracteres especiais para aumentar a complexidade da senha e, assim, fortalecer sua proteção.
                </p>
                <p> 
                    Por favor, digite a nova senha nos campos abaixo e confirme-a. 
                </p>
                <div class="row">
                    <div class="column col-xs-12 col-md-6">
                        <label class="control-label ">Nova Senha</label>
                        <input id="password" type="password" class="form-control" name="password" value="{{ old('password') }}" required >

                        @if ($errors->has('password'))
                            <span class="erro_validacao">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="column col-xs-12 col-md-6">
                        <label class="control-label">Confirmar Senha</label>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" value="{{ old('password-confirm') }}" required >

                        @if ($errors->has('password-confirm'))
                            <span class="erro_validacao">
                                <strong>{{ $errors->first('password-confirm') }}</strong>
                            </span>
                        @endif
                    </div>  
                                        
                </div>
            </div><!-- fechar terceiro form-group--> 
                
           
           <div class="form-group">
            <button type="submit" class="br-button block secondary mr-3" aria-label="Ícone ilustrativo" >
                Salvar
            </button> 
                
            </div><!-- fechar quarto form-group-->
            </form>    
    </div>   
    <!-- content-core -->
</div>    
<!-- content -->
@endsection


