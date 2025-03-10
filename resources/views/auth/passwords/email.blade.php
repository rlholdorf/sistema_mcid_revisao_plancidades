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
            <div class="col mb-5 container-fluid">     
                <div class="form-group row">
                    <div class="col col-sm-8">  
                        <aside id="aside-signin">
                            <img id="identidade-govbr" src="{{URL::asset('img/img_tela_login.png')}}" alt="Logomarca GovBR">
                        </aside>                        
                    </div><!-- col col-sm-4 -->

                    <div class="col col-sm-4"> 
                        <div class="col-md">
                            <div class="br-card hover">
                                <div class="card-content">
                                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif



                    <form method="POST" action="{{ route('password.email') }}" aria-label="{{ __('Reset Password') }}">
                        @csrf
                        <img src="{{URL::asset('img/logo_mcid_75.png')}}"  >
                                        <span class="br-divider lg my-3"></span>                                    
                                        <p>Redefina sua senha de acesso ao sistema.</p>
                                        <span class="br-divider dashed my-3"></span>

                        <div class="form-group row">
                            <div class="br-input large input-button">
                                <label for="input-login-small">Email</label>
                                <input id="email" type="email"  name="email" placeholder="Digite seu email de usuário" value="{{ old('email') }}" required/>
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>                           
                        </div>

                        <div class="p-3 text-center">
                            <button class="br-button primary mr-3" type="submit" name="entrar" value="Entrar">  {{ __('Enviar link') }}
                            </button>
                            <button class="br-button danger mr-3" type="button" onclick="window.location.href='/'">Fechar
                            </button>
                        </div><!-- p-3 text-right -->
                       <em>
                        
                       </em>
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

    @yield('scriptsfooterjs')

  </body>
</html>