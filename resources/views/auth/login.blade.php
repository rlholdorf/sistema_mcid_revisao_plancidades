<?php 
  
  $mensagem = null;
  if(Session::get('mensagem')){
    $mensagem = 'O perfil principal do Ente Público ainda não foi ativado.';  
  }  

?>
<!DOCTYPE html>
<html lang="pt-BR">
  <head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>Sistema de Gerenciamento</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
   
    <script src="{{ asset('js/app.js') }}" defer></script>
 
    
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('bootstrap/5/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

       <!-- sweetalert2-->
       <link href="{{URL::asset('css/sweetalert2.css')}}" rel="stylesheet">

    @yield('scriptscss')

    @yield('scriptsjs')

    <!-- Fonte Rawline-->
    <link rel="stylesheet" href="https://cdngovbr-ds.estaleiro.serpro.gov.br/design-system/fonts/rawline/css/rawline.css"/>
    <!-- Fonte Raleway-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:300,400,500,600,700,800,900&amp;display=swap"/>
    <!-- Design System de Governo-->
        <link rel="stylesheet" href="{{ asset('css/core/core.css') }}"/>
    <!-- Fontawesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css"/>





  </head>
  <body>
    <div id="app">
      <div class="template-base">
        <nav class="br-skiplink"><a class="br-item" href="#main-content" accesskey="1">Ir para o conteúdo (1/4) <span class="br-tag text ml-1">1</span></a><a class="br-item" href="#header-navigation" accesskey="2">Ir para o menu (2/4) <span class="br-tag text ml-1">2</span></a><a class="br-item" href="#main-searchbox" accesskey="3">Ir para a busca (3/4) <span class="br-tag text ml-1">3</span></a><a class="br-item" href="#footer" accesskey="4">Ir para o rodapé (4/4) <span class="br-tag text ml-1">4</span></a>
        </nav>
        <header class="br-header mb-4" id="header" data-sticky="data-sticky">
          <div class="container-fluid">
            <div class="header-top">
              <div class="header-logo"><img src='{{ URL::asset("/img/govbr-logo.png")}}' alt="logo"/>           
                
              </div>
              <div class="header-actions">
                
              </div>
            </div>
            
          </div>
        </header>
        <main class="d-flex flex-fill mb-5" id="main">
            <div class="col mb-5 container-lg">     
                <div class="form-group row">
                    <div class="col col-sm-8">  
                        <aside id="aside-signin">
                            <img id="identidade-govbr" src="{{URL::asset('img/img_tela_login.png')}}" alt="Logomarca GovBR">
                        </aside>                        
                    </div><!-- col col-sm-4 -->

                    <div class="col col-sm-4 text-center"> 
                        <div class="col-md">
                            <div class="br-card hover">
                                <div class="card-content">
                                    <form class="text-left form-validate" method="POST" action="{{ url('/login') }}">
                                        {{ csrf_field() }}  
                                        <img src="{{URL::asset('img/logo_mcid_75.png')}}"  >
                                        <span class="br-divider lg my-3"></span>                                    
                                        <p>Identifique-se no Sistema de Gerenciamento com:</p>
                                        <span class="br-divider dashed my-3"></span>
                                        {{ $mensagem }}{{ Session::get('mensagem')}}

                                       
                                        
                                        <div class="br-input large input-button">
                                            <label for="input-login-small">Usuário</label>
                                            <input id="email" type="email"  name="email" placeholder="Digite seu email de usuário" required/>
                                            <button class="br-button" type="button" aria-label="Botão de ação"><i class="fas fa-user" aria-hidden="true"></i>
                                            </button>
                                            @if ($errors->has('email'))
                                              <span class="feedback danger" role="alert">
                                                <i class="fas fa-times-circle" aria-hidden="true"></i>{{ $errors->first('email') }}
                                            </span>
                                          @endif
                                        </div>
                                        
                                    </br>
                                        <div class="br-input large input-button">
                                            <label for="input-login-small">Senha</label>
                                            <input id="password" type="password" name="password"  placeholder="Digite sua senha" required/>
                                            <button class="br-button" type="button" aria-label="Botão de ação"><i class="fas fa-lock" aria-hidden="true"></i>
                                            </button>
                                            @if ($errors->has('password'))
                                              <span class="feedback danger" role="alert">
                                                <i class="fas fa-times-circle" aria-hidden="true"></i>{{ $errors->first('password') }}
                                            </span>
                                          @endif
                                        </div>
                                      
                                        <div class="form-group row">
                                            <div class="col offset-md-12">
                                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                                    {{ __('Esqueceu sua senha?') }}
                                                </a>
                                            </div>
                                        </div><!-- form-group row -->

                                        <span class="br-divider dashed my-3"></span>

                                        <div class="p-3 text-center">
                                            <button class="br-button primary mr-3" type="submit" name="entrar" value="Entrar">Entrar
                                            </button>
                                            <button class="br-button danger mr-3" type="button" onclick="javascript:window.history.go(-1)">Voltar
                                            </button>
                                        </div><!-- p-3 text-right -->
                                    </form>
                                </div><!-- card-content -->                            
                            </div><!-- br-card hover -->
                        </div><!-- col-md -->    
                    </div><!-- col col-sm-4 -->                
                </div><!-- form-group row -->
              </div><!-- div col mb-5" -->          
        </main>
        <footer class="br-footer pt-3" id="footer">
          <div class="container-fluid">
            <div class="info">
              <div class="text-down-01 text-medium pb-3">Todo o conteúdo deste site está publicado sob a licença à&nbsp;<strong><a href="">Creative Commons Atribuição-SemDerivações 3.0 Não Adaptada.</a>.</strong></div>
            </div>
          </div>
        </footer>
          <!--
          <div class="br-cookiebar default d-none" tabindex="-1"></div>
          -->
      </div>
    </div>
    <script src="{{ asset('js/core-init.js') }}" defer></script>

    <script src="{{URL::asset('js/sweetalert2.js')}}"></script>


    @yield('scriptsfooterjs')

    
    @include('layouts.flash')

  </body>
</html>