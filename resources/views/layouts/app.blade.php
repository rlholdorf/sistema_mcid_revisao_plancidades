<!DOCTYPE html>
<html lang="pt-BR">
  <head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>Secretaria Executiva</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title> {{ config('app.name', 'Laravel') }} </title>

    <!-- Scripts -->
   
    <script src="{{ URL::asset('js/app.js') }}" defer></script>
 
    
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ URL::asset('bootstrap/5/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css/app.css') }}" rel="stylesheet">

 

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

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    
   <!-- sweetalert2-->
    <link href="{{URL::asset('css/sweetalert2.css')}}" rel="stylesheet">



  </head>
  <body >
    <div id="app">
      <div class="template-base">
        <nav class="br-skiplink">
          <a class="br-item" href="#main-content" accesskey="1"><span class="br-tag text ml-1">1</span></a>
          <a class="br-item" href="#header-navigation" accesskey="2">Ir para o menu (2/4) <span class="br-tag text ml-1">2</span></a>
          <a class="br-item" href="#main-searchbox" accesskey="3">Ir para a busca (3/4) <span class="br-tag text ml-1">3</span></a>
          <a class="br-item" href="#footer" accesskey="4">Ir para o rodapé (4/4) <span class="br-tag text ml-1">4</span></a>
        </nav>
        <header class="br-header mb-4" id="header" data-sticky="data-sticky">
          <div class="container-fluid">
            <div class="header-top">
              <div class="header-logo"><img src='{{ URL::asset("/img/govbr-logo.png")}}' alt="logo"/><span class="br-divider vertical"></span>            
                <div class="header-sign">Ministério das Cidades</div>
              </div>
              <div class="header-actions">
                <div class="header-links dropdown">
                  <button class="br-button circle small" type="button" data-toggle="dropdown" aria-label="Abrir Acesso Rápido"><i class="fas fa-ellipsis-v" aria-hidden="true"></i>
                  </button>
                  <div class="br-list">
                    <div class="header">
                      <div class="title">Acesso Rápido</div>
                    </div>
                    <a class="br-item" href="https://www.gov.br/pt-br/orgaos-do-governo">Órgãos do Governo</a>
                    <a class="br-item" href="https://www.gov.br/acessoainformacao/pt-br">Acesso à Informação</a>
                    <a class="br-item" href="http://www4.planalto.gov.br/legislacao/">Legislação</a>
                    <a class="br-item" href="https://www.gov.br/governodigital/pt-br/acessibilidade-digital">Acessibilidade</a>
                  </div>
                </div><span class="br-divider vertical mx-half mx-sm-1"></span>
                <div class="header-functions dropdown">
                  <button class="br-button circle small" type="button" data-toggle="dropdown" aria-label="Abrir Funcionalidades do Sistema"><i class="fas fa-th" aria-hidden="true"></i>
                  </button>
                  <div class="br-list">
                    <div class="header">
                      <div class="title">Funcionalidades do Sistema</div>
                    </div>
                    <div class="br-item">
                      @guest

                      @else
                        @if(Auth::user()->modulo_sistema_id  == 1)
                      
                        <!--                        
                          <button class="br-button circle small" type="button" aria-label="Funcionalidade 1">
                            <a href="{{ url('/painel_controle') }}"  class="link-acesso">
                            <i class="fab fa-elementor" aria-hidden="true"></i><span class="text">Painel de Controle</span>
                            </a>
                          </button>
                        -->
                          @if(retornarQtdEncaminhamentos() > 0)
                            <a href="{{ url('/codem/demanda/minhas_demandas') }}"  class="link-acesso" data-tooltip-text="Encaminhamentos Demanda">
                              <i class="fas fa-bell" aria-hidden="true"></i><span class="br-tag count bg-danger"><span>{{retornarQtdEncaminhamentos()}}</span></span>
                            </a>
                            @endif
                          
                            @if(demandasAtasadas() > 0)
                            <span class="br-divider vertical mx-half mx-sm-1"></span>
                            <a href="{{ url('/codem/demanda/minhas_demandas') }}"  class="link-acesso" data-tooltip-text="Demanda em atraso">
                              <i class="fas fa-list" aria-hidden="true"></i><span class="br-tag count bg-danger"><span>{{demandasAtasadas()}}</span></span>
                            </a>
                            @endif

                        @endif
                      @endif

                      
                    </div>
                    <!--
                    <div class="br-item">
                      <button class="br-button circle small" type="button" aria-label="Funcionalidade 2"><i class="fas fa-headset" aria-hidden="true"></i><span class="text">Funcionalidade 2</span>
                      </button>
                    </div>
                    <div class="br-item">
                      <button class="br-button circle small" type="button" aria-label="Funcionalidade 3"><i class="fas fa-comment" aria-hidden="true"></i><span class="text">Funcionalidade 3</span>
                      </button>
                    </div>
                    <div class="br-item">
                      <button class="br-button circle small" type="button" aria-label="Funcionalidade 4"><i class="fas fa-adjust" aria-hidden="true"></i><span class="text">Funcionalidade 4</span>
                      </button>
                    </div>
                  -->
                  </div>
                </div>
                 <!--
                  <div class="header-search-trigger">
                  
                    <button class="br-button circle" type="button" aria-label="Abrir Busca" data-toggle="search" data-target=".header-search"><i class="fas fa-search" aria-hidden="true"></i>
                    </button>
                  
                  </div>
                -->
                <div class="header-login">
                  <div class="header-sign-in">
                    <!-- BOTÃO PARA ENTRAR E SAIR DO SISTEMA -->
                    @guest
                    
                      <button class="br-sign-in small" type="submit" data-trigger="login" onclick="window.location.href='/login'">
                        <i class="fas fa-user" aria-hidden="true"></i><span class="d-sm-inline">Entrar</span>
                      </button>
                      
                    @else  
                      <div>
                        <button class="br-sign-in" type="button" id="avatar-dropdown-trigger" data-toggle="dropdown" data-target="avatar-menu" aria-label="Avatar com dropdown">
                            <span class="br-avatar" title="{{retornarPrimeiroUltimoNome(Auth::user()->name)}}">
                                <span class="content bg-orange-vivid-30 text-pure-0">{{ pegarPrimeiraLetraUser(Auth::user()->name) }}</span>
                            </span>
                            <span class="ml-2 text-gray-80 text-weight-regular">Olá, <span class="text-weight-semi-bold">{{strtoupper(retornarPrimeiroUltimoNome(Auth::user()->name))}}</span></span>
                              <i class="fas fa-caret-down" aria-hidden="true"></i>
                        </button>
                        <div class="br-list" id="avatar-menu" hidden="hidden">
                          @if(Auth::user()->modulo_sistema_id == 1)
                                <a class="br-item" href='{{ url('admin/usuario/'. Auth::user()->id)}}'><i class="fas fa-user"></i> Dados pessoais</a>
                            @can('eAdmin')
                            <a class="br-item" href='{{ url('codem/demanda/minhas_demandas')}}'><i class="fas fa-clipboard-list"></i> Minhas demandas</a>
                            @endcan
                          @endif
                              <a class="br-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <span class="d-lg-inline"><i class="fas fa-sign-out-alt"></i> Sair</span>
                              </a>
                            
                        </div>
                      </div>
                                     
                      
                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                          @csrf
                        
                      </form>
                      @endguest
                  </div>
                  <div class="header-avatar"></div>
                </div>
              </div>
            </div>
            <div class="header-bottom">
              <div class="header-menu">
                <div class="header-menu-trigger" id="header-navigation">
                  <button class="br-button small circle" type="button" aria-label="Menu" data-toggle="menu" data-target="#main-navigation" id="navigation"><i class="fas fa-bars" aria-hidden="true"></i>
                  </button>
                </div>
                <div class="header-info">
                  <div class="header-title">Sistema de Gerenciamento</div>
                    <div class="header-subtitle"> 
                          @guest 
                            <a  href="{{ url('/') }}">Secretaria Executiva</a>
                          @else
                            <a  href="{{ url('home') }}">Secretaria Executiva</a>
                          @endguest
                  
                    </div>
                </div>
              </div>

              <div class="header-search" id="main-searchbox">
                <!--
                <div class="br-input has-icon">
                  <label for="searchbox">Texto da pesquisa</label>
                  <input id="searchbox" type="text" placeholder="O que você procura?"/>
                  <button class="br-button circle small" type="button" aria-label="Pesquisar"><i class="fas fa-search" aria-hidden="true"></i>
                  </button>
                </div>
                <button class="br-button circle search-close ml-1" type="button" aria-label="Fechar Busca" data-dismiss="search"><i class="fas fa-times" aria-hidden="true"></i>
                </button>
              -->
              </div>
            </div>
          </div>
        </header>
        <main class="d-flex flex-fill  mb-5" id="main">
          
          <div class="container-fluid"  style="max-width:'100%';">
            
            <div class="row">
              
              <div class="br-menu  pt-md-3" id="main-navigation">
                <div class="menu-container">
                  <div class="menu-panel">
                    <div class="menu-header">
                      <div class="menu-title"><img src='{{ URL::asset("/img/govbr-logo.png")}}' alt="Imagem ilustrativa"/><span>Secretaria Executiva</span></div>                    
                      <div class="menu-close">
                        <button class="br-button circle" type="button" aria-label="Fechar o menu" data-dismiss="menu"><i class="fas fa-times" aria-hidden="true"></i>
                        </button>
                      </div>
                    </div>
                    <nav class="menu-body">
                      @guest
                          @include('layouts.nav.nav_guest')
                      @else 

                        @if(Auth::user()->status_usuario_id == 1)
                            @if(Auth::user()->modulo_sistema_id == 2)
                                @if(Auth::user()->bln_aceite_termo)
                                    @include('layouts.nav.nav_selecao_proposta')                            
                                @endif  
                            @elseif(Auth::user()->modulo_sistema_id == 3)
                              @include('layouts.nav.nav_saci')  
                            @elseif(Auth::user()->modulo_sistema_id == 5)
                              @include('layouts.nav.nav_bndes')                               
                            @elseif(Auth::user()->modulo_sistema_id == 6)
                              @include('layouts.nav.nav_apis')                               
                            @elseif(Auth::user()->modulo_sistema_id == 7)
                              @include('layouts.nav.nav_pac')                               
                            @else                              
                                  @include('layouts.nav.nav_sistema')                               

                            @endif
                        @endif                       

                      @endguest
                    </nav>
                    <div class="menu-footer">
                     
                     <!--
                    
                      <div class="menu-links">
                          <a href="https://www.gov.br/cidades/pt-br/acesso-a-informacao/acoes-e-programas/habitacao/programa-minha-casa-minha-vida" target="_blank" >
                              <span class="mr-1">Minha Casa Minha Vida</span><i class="fas fa-external-link-square-alt" aria-hidden="true"></i>
                          </a>
                          <a href="https://www.gov.br/cidades/pt-br/acesso-a-informacao/institucional/competencias/competencias-da-secretaria-nacional-de-habitacao" target="_blank" >
                              <span class="mr-1">Secretaria Nacional de Habitação</span><i class="fas fa-external-link-square-alt" aria-hidden="true"></i>
                          </a>
                        </div>
                      -->
                      <div class="social-network">
                        <div class="social-network-title">Redes Sociais</div>
                        <div class="d-flex">
                            <a class="br-button circle" href="https://www.facebook.com/mcidades" target="_blank" aria-label="Compartilhar por Facebook">
                                <i class="fab fa-facebook-f" aria-hidden="true"></i>
                            </a>
                            <a class="br-button circle" href="https://twitter.com/mdascidades" target="_blank" aria-label="Compartilhar por Twitter">
                                <i class="fab fa-twitter" aria-hidden="true"></i>
                            </a>
                            <a class="br-button circle" href="https://www.instagram.com/ministeriocidades/" target="_blank" aria-label="Compartilhar por Instagram">
                                <i class="fab fa-instagram" aria-hidden="true"></i>
                            </a>
                            <a class="br-button circle" href="https://www.youtube.com/@ministeriocidades" target="_blank"  aria-label="Compartilhar por Youtube">
                                <i class="fab fa-youtube" aria-hidden="true"></i>
                            </a>
                            <a class="br-button circle" href="https://www.flickr.com/photos/ministeriodascidades" target="_blank"  aria-label="Compartilhar por Flickr">
                                <i class="fab fa-flickr" aria-hidden="true"></i>
                            </a>
                        </div>
                      </div>
                      <div class="menu-logos">
                      </br>
                    </br>
                        <img src='{{ URL::asset("/img/logo_governo_nova.png")}}' alt="Imagem ilustrativa"/>
                        
                      </div>
                      <div class="menu-info">
                        <!--
                        <button type="submit" class="br-button block secondary mr-3" aria-label="Ícone ilustrativo" onclick="window.location.href='/codem/demanda/nova'">
                          <i class="fas fa-edit" aria-hidden="true"></i>Nova demanda
                      </button>
                    -->
                      <span class="br-divider  my-3"></span>
                        <div class="text-center text-down-01">Todo o conteúdo deste site está publicado sob a licença <strong>Creative Commons Atribuição-SemDerivações 3.0</strong></div>
                      </div>
                    </div>
                  </div>
                  <div class="menu-scrim" data-dismiss="menu" tabindex="0">
                    

                  </div>
                </div>
              </div><!-- main-navigation -->
              <div class="col mb-5 " style="max-width:'100%';">              
                
                  @yield('content')   
                  
                            
               
              </div><!-- div col mb-5" -->
            </div>
          </div>
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
    <script src="{{ URL::asset('js/core-init.js') }}" defer></script>

    <script src="{{URL::asset('js/sweetalert2.js')}}"></script>

    <script src="{{URL::asset('bootstrap/5/js/bootstrap.min.js')}}"></script>

    @yield('scriptsfooterjs')

    @include('layouts.flash')

  </body>
</html>