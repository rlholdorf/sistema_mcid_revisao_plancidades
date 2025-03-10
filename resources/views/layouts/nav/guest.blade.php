<div class="menu-folder"><a class="menu-item" href="javascript: void(0)"><span class="icon">
    <i class="fas fa-regular fa-home" aria-hidden="true"></i></span><span class="content">Acesso a Informação</span></a>
    <ul>
  
      <li><a class="menu-item" href="#" title="Dados Abertos"><span class="icon">
        <i class="bi bi-database-fill-down fa-lg"></i></i></span><span class="content">Dados Abertos</span></a>
        <ul>
         
          <li><a class="menu-item" href="{{url('/dados_abertos/politica')}}" title="Política de Dados Abertos"><span class="icon">
            <i class="bi bi-database-fill-gear fa-lg"></i></span><span class="content">Política de Dados Abertos</span></a>              
          </li>            
        </ul>
      </li>     
       
    </ul>
  </div> 
  
  <li class="plain dropdown-submenu">
    <a href="#" class="plain">Seleção de Propostas</a>
    <ul class="submenu">
        <li>
            <a href="{{ url('/selecao') }}" title="Propostas Apresentadas" class="state-published">Propostas Apresentadas</a>
        </li>
        <li>
            <a href="{{ url('/selecao/resumo/filtro') }}" title="Resumo Seleção" class="state-published">Resumo Seleção</a>
        </li>
        <li>
            <a href="{{ url('/contratadas/resumo/filtro') }}" title="Resumo Contratadas" class="state-published">Resumo Contratadas</a>
        </li>                                  
    </ul>
</li>                      

<li class="plain dropdown-submenu">
    <a href="#" class="plain">PMCMV</a>
    <ul class="submenu">
        <li>
            <a href="{{url('/empreendimentos/filtro')}}" title="Empreendimentos" class="state-published">Empreendimentos</a>
        </li> 
        <li>
            <a href="{{url('/novo_executivo/filtro')}}" title="Relatório Executivo">Relatório Executivo </a>
        </li>                                 
    </ul>
</li>                      

<li class="plain dropdown-submenu">
    <a href="#" class="plain">Solicitações e Liberações</a>
    <ul class="submenu">
        <li>
            <a href="{{url('/externo/pagamento/situacao/filtro')}}" title="Situação Pagamentos">Situação Pagamentos <span class="badge badge-danger">Novo</span></a>
        </li>                               
    </ul>
</li> 