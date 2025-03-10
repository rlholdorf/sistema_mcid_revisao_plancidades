<!-- inicio menu Seleção de Propostas-->

<!-- inicio menu Documentos-->    
<div class="menu-folder"><a class="menu-item" href="javascript: void(0)"><span class="icon">
      <i class="bi bi-journal-text fa-lg"></i></span><span class="content">Dados para o Painel</span></a>
      <ul>
        <li><a class="menu-item" href="#" title="Dados Abertos"><span class="icon">
          <i class="bi bi-database-fill-down fa-lg"></i></i></span><span class="content">Debentures</span></a>
          <ul>
            <li><a class="menu-item" href="{{ url('/debentures_reidi/projetos/debentures/cadastrar') }}" title="Cadastrar Projeto Debentures"><span class="icon">
              <i class="bi bi-journal-arrow-up fa-lg"></i></span><span class="content">Cadastrar Projeto Debentures</span></a>
            </li>
            <li><a class="menu-item" href="{{ url('/debentures_reidi/projetos/debentures/consultar') }}" title="Consultar Projeto Debentures"><span class="icon">
              <i class="bi bi-journal-arrow-up fa-lg"></i></span><span class="content">Consultar Projeto Debentures</span></a>
            </li>                
          </ul>
        </li>   
        <li><a class="menu-item" href="#" title="Dados Abertos"><span class="icon">
          <i class="bi bi-database-fill-down fa-lg"></i></i></span><span class="content">Reidis</span></a>
          <ul>
            <li><a class="menu-item" href="{{ url('/debentures_reidi/projetos/reidis/consultar') }}" title="Consultar Projeto Reidis"><span class="icon">
              <i class="bi bi-journal-arrow-up fa-lg"></i></span><span class="content">Consultar Projeto Reidis</span></a>
            </li>   
            <li><a class="menu-item" href="{{ url('/debentures_reidi/projetos/reidis/cadastrar') }}" title="Cadastrar Projeto Reidis"><span class="icon">
              <i class="bi bi-journal-arrow-up fa-lg"></i></span><span class="content">Cadastrar Projeto Reidis</span></a>
            </li>             
          </ul>
        </li> 
      </ul>
    </div>

    <!-- inicio menu Documentos-->    
<div class="menu-folder"><a class="menu-item" href="javascript: void(0)"><span class="icon">
      <i class="bi bi-journal-text fa-lg"></i></span><span class="content">Projetos de Investimento em Saneamento Básico</span></a>
      <ul>
        <li><a class="menu-item" href="#" title="Dados Abertos"><span class="icon">
          <i class="bi bi-database-fill-down fa-lg"></i></i></span><span class="content">Debentures</span></a>
          <ul>
            <li><a class="menu-item" href="{{ url('/apis/debentures/adicionar') }}" title="Adicionar Proposta" @if(Auth::user()->setor_id <> 47)  disabled @endif><span class="icon">
                  <i class="fas fa-regular fa-home"></i></span><span class="content">Adicionar Proposta</span></a>
            </li>
            <li><a class="menu-item" href="{{ url('/apis/debentures/consultar') }}" title="Consultar Debentures"><span class="icon">
                  <i class="fas fa-regular fa-home"></i></span><span class="content">Consultar Debentures</span></a>
            </li>
                     
          </ul>
        </li>   
        
      </ul>
    </div>
