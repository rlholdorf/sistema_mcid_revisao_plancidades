<!-- inicio menu Documentos-->  


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
  
    <li><a class="menu-item" href="#" title="Dados Abertos"><span class="icon">
      <i class="bi bi-database-fill-down fa-lg"></i></i></span><span class="content">Painéis de informações</span></a>
      <ul>
        <li><a class="menu-item" href="{{url('/paineis/internos')}}" title="Painéis Internos"><span class="icon">
          <i class="bi bi-database-fill-down fa-lg"></i></i></span><span class="content">Painéis Internos</span></a>
        </li>                  
      </ul>
    </li>       
  </ul>
</div> 


<!-- inicio menu briefing-->
<div class="menu-folder"><a class="menu-item" href="javascript: void(0)"><span class="icon">
  <i class="fas fa-chart-line"></i></span><span class="content">Briefing Ministerial</span><span class="badge bg-warning">Em teste</span></a>
    <ul>
      <li><a class="menu-item" href="{{ route('briefing.cadastrar') }}" title="Resumos"><span class="icon">
        <i class="fas fa-regular fa-clipboard-list"></i></span><span class="content">Cadastrar Destaque Regional</span></a>
      </li>
      <li><a class="menu-item" href="{{ url('/briefing/ficha_briefing/consultar') }}" title="Ficha Briefing"><span class="icon">
        <i class="bi bi-journal-plus fa-lg"></i></span><span class="content">Ficha Briefing</span></a>
      </li>
    </ul>
</div>


<!-- inicio menu Carteira de Investimentos-->    
<div class="menu-folder"><a class="menu-item" href="javascript: void(0)"><span class="icon">
  <i class="bi bi-pc-display-horizontal fa-lg" aria-hidden="true"></i></span><span class="content">Carteira de Investimento</span></a>
  <ul>
    <li><a class="menu-item" href="#" title="Resumos"><span class="icon">
      <i class="bi bi-pc-display-horizontal fa-lg"></i></span><span class="content">Contratos</span></a>
      <ul>
        
        <li><a class="menu-item" href="{{ url('/carteira_investimento/contratos/consultar') }}" title="Consultar Contratos"><span class="icon">
          <i class="bi bi-pc-display-horizontal fa-lg"></i></span><span class="content">Consultar Contratos</span></a>
        </li>          
      </ul>
    </li>
   
    
  </ul>
</div>

@can('eDev')

<!-- inicio menu BALANÇO PAC-->    

<div class="menu-folder"><a class="menu-item" href="javascript: void(0)"><span class="icon">
  <i class="bi bi-pc-display-horizontal fa-lg"></i></span><span class="content">Planejamento de Tarefas</span><span class="badge bg-danger">Em desenvolvimento</span></a>
  <ul>
    
    <li><a class="menu-item" href="{{ url('/planejamento_tarefas/cadastrar') }}" title="Cadastrar Planejamento"><span class="icon">
      <i class="bi bi-journal-plus fa-lg"></i></span><span class="content">Cadastrar Planejamento</span></a>
    </li>   
    <li><a class="menu-item" href="{{ url('/planejamento_tarefas/lista_planejamentos') }}" title="Lista Planejamentos"><span class="icon">
      <i class="bi bi-journal-plus fa-lg"></i></span><span class="content">Lista Planejamentos</span></a>
    </li>   
    
  </ul>
</div>



<!-- inicio menu BALANÇO PAC-->    

<div class="menu-folder"><a class="menu-item" href="javascript: void(0)"><span class="icon">
  <i class="bi bi-pc-display-horizontal fa-lg"></i></span><span class="content">Balanço Pac</span><span class="badge bg-warning">Em teste</span></a>
  <ul>
    
    <li><a class="menu-item" href="{{ url('/pac/contratos/consultar') }}" title="Consultar Contrato"><span class="icon">
      <i class="bi bi-journal-plus fa-lg"></i></span><span class="content">Consultar Contrato</span></a>
    </li>    
    <li><a class="menu-item" href="{{ url('/pac/analise_execucao/consultar') }}" title="Análise Execução"><span class="icon">
      <i class="bi bi-journal-plus fa-lg"></i></span><span class="content">Análise Execução</span></a>
    </li>    
    
  </ul>
</div>



@endcan

<div class="menu-folder"><a class="menu-item" href="javascript: void(0)"><span class="icon">
  <i class="bi bi-pc-display-horizontal fa-lg"></i></span><span class="content">Transferências Especiais</span><span class="badge bg-danger">Em desenvolvimento</span></a>
  <ul>  
    <li><a class="menu-item" href="{{ url('/transferencias_especiais/consultar') }}" title="Consultar Planos de Ação"><span class="icon">
      <i class="bi bi-journal-plus fa-lg"></i></span><span class="content">Consultar Planos de Ação</span></a>
    </li>   
    
  </ul>
</div>


<!-- inicio menu Controle de Demandas-->    
<div class="menu-folder"><a class="menu-item" href="javascript: void(0)"><span class="icon">
  <i class="fas fa-regular fa-clipboard-list" aria-hidden="true"></i></span><span class="content">Controle de Demandas</span></a>
  <ul>
    <li><a class="menu-item" href="#" title="Resumos"><span class="icon">
      <i class="fas fa-regular fa-clipboard-list"></i></span><span class="content">Demanda</span></a>
      <ul>
        
        <li><a class="menu-item" href="{{ url('/codem/demanda/nova') }}" title="Cadastrar Demanda"><span class="icon">
          <i class="fas fa-regular fa-clipboard-list"></i></span><span class="content">Cadastrar Demanda</span></a>
        </li>  

        <li><a class="menu-item" href="{{ url('/codem/demanda/consultar') }}" title="Consultar Demandas"><span class="icon">
          <i class="fas fa-regular fa-clipboard-list"></i></span><span class="content">Consultar Demandas</span></a>
        </li>  
        
        <li><a class="menu-item" href="{{ url('/codem/demanda/minhas_demandas') }}" title="Minhas Demandas"><span class="icon">
          <i class="fas fa-regular fa-clipboard-list"></i></span><span class="content">Minhas Demandas</span></a>
        </li>  
        
       
       
      </ul>
    </li>
    
  </ul>
</div>

<!-- inicio menu Documentos-->    
<div class="menu-folder"><a class="menu-item" href="javascript: void(0)"><span class="icon">
  <i class="bi bi-journal-text fa-lg"></i></span><span class="content">Documentos</span></a>
  <ul>
    
    <li><a class="menu-item" href="{{ url('/usuario/termo_responsabilidade') }}" title="Termo de Responsabilidade"><span class="icon">
      <i class="bi bi-journal-arrow-up fa-lg"></i></span><span class="content">Termo de Responsabilidade</span></a>
    </li>

   
    
  </ul>
</div>

@can('ePlancidades')
<!-- inicio menu Plancidades-->
<div class="menu-folder"><a class="menu-item" href="javascript: void(0)"><span class="icon">
  <i class="fas fa-chart-line"></i></span><span class="content">Plancidades</span></a>
  <ul>
    <li>  
      <ul>
      
        <a class="menu-item" href="{{route('plancidades.home')}}" title="Pagina Inicial"><span class="icon">
          <i class="fas fa-regular fa-clipboard-list"></i></span><span class="content">Página Inicial</span></a>
      </ul>

      <ul>
        <li><a class="menu-item" href="#" title="Monitoramentos"><span class="icon">
          <i class="fas fa-regular fa-clipboard-list"></i></span><span class="content">Monitoramentos</span></a>
            <ul>
              <a class="menu-item" href="{{ route('plancidades.monitoramentos.objetivoEstrategico.consultar') }}"><span class="icon">
                <i class="fas fa-window-restore"></i></span><span class="content">Monitoramento de Objetivo Estratégico</span>
              </a>
              
              <a class="menu-item" href="{{ route('plancidades.monitoramentos.iniciativa.consultar') }}"><span class="icon">
                <i class="fas fa-window-restore"></i></span><span class="content">Monitoramento de Iniciativa/Entrega</span>
              </a>
              
              <a class="menu-item" href="{{ route('plancidades.monitoramentos.projeto.consultar') }}"><span class="icon">
                <i class="fas fa-window-restore"></i></span><span class="content">Monitoramento de Projetos</span>
              </a>
              @can('ePlancidadesValidacao')
              <a class="menu-item" href="{{ route('plancidades.monitoramentos.validacao.consultar') }}"><span class="icon">
                <i class="fas fa-window-restore"></i></span><span class="content">Análise de Monitoramentos CGPI</span>
              </a>
              @endcan
            </ul>
        </li>
      </ul>
    </li>
  </ul>
</div>
@endcan


@can('eDev')
<!-- inicio menu Programas 2024 -->
<div class="menu-folder"><a class="menu-item" href="javascript: void(0)"><span class="icon">
  <i class="fas fa-chart-line"></i></span><span class="content">Programas TransfereGov 2024 </span></a>
    <ul>
      <li><a class="menu-item" href="{{ route('transferegov.listarProgramas') }}" title="Monitoramentos"><span class="icon">
        <i class="fas fa-regular fa-clipboard-list"></i></span><span class="content">Consultar Programas</span></a>
      </li>
    </ul>
</div>


<!-- inicio menu Plancidades-->
<div class="menu-folder"><a class="menu-item" href="javascript: void(0)"><span class="icon">
  <!-- <i class="fas fa-chart-line"></i></span><span class="content">PlanCidades</span></a> -->
  <img src="{{URL::asset('/img/plancidades/logo_plan_cidades_icone.png')}}" style="width: 16px; height: 16px; vertical-align: sub;"/></span><span class="content">PlanCidades</span></a>
  <ul>
    <li>  
      <ul>
        <a class="menu-item" href="{{route('plancidades.home')}}" title="Pagina Inicial"><span class="icon">
          <i class="fas fa-regular fa-home"></i></span><span class="content">Página Inicial</span></a>
      </ul>

      <ul>
        <li><a class="menu-item" href="#" title="Monitoramentos"><span class="icon">
          <i class="fas fa-regular fa-clipboard-list"></i></span><span class="content">Monitoramentos</span></a>
            <ul>
              <a class="menu-item" href="{{ route('plancidades.monitoramentos.objetivoEstrategico.consultar') }}"><span class="icon">
                <i class="fas fa-window-restore"></i></span><span class="content">Monitoramento de Objetivo Estratégico</span>
              </a>
              
              <a class="menu-item" href="{{ route('plancidades.monitoramentos.iniciativa.consultar') }}"><span class="icon">
                <i class="fas fa-window-restore"></i></span><span class="content">Monitoramento de Iniciativa/Entrega</span>
              </a>
              
              <a class="menu-item" href="{{ route('plancidades.monitoramentos.projeto.consultar') }}"><span class="icon">
                <i class="fas fa-window-restore"></i></span><span class="content">Monitoramento de Projetos</span>
              </a>
              
              <a class="menu-item" href="{{ route('plancidades.monitoramentos.validacao.consultar') }}"><span class="icon">
                <i class="fas fa-window-restore"></i></span><span class="content">Análise de Monitoramentos CGPI</span>
              </a>
              
            </ul>
        </li>
      </ul>
    
      <ul>
        <li><a class="menu-item" href="#" title="Revisão"><span class="icon">
          <i class="fas fa-regular fa-route"></i></span><span class="content">Revisão</span></a>
            <ul>
              <a class="menu-item" href="{{ route('plancidades.revisao.objetivoEstrategico.consultar') }}"><span class="icon">
                <i class="fas fa-window-restore"></i></span><span class="content">Revisão de Objetivo Estratégico</span>
              </a>
              
              <a class="menu-item" href="{{ route('plancidades.revisao.iniciativa.consultar') }}"><span class="icon">
                <i class="fas fa-window-restore"></i></span><span class="content">Revisão de Iniciativa/Entrega</span>
              </a>
              
              <a class="menu-item" href="{{ route('plancidades.revisao.projeto.consultar') }}"><span class="icon">
                <i class="fas fa-window-restore"></i></span><span class="content">Revisão de Projetos</span>
              </a>
              
              <a class="menu-item" href="#"><span class="icon">
                <i class="fas fa-window-restore"></i></span><span class="content">Análise de Revisão CGPI</span>
              </a>
              
            </ul>
        </li>
      </ul>
    
    </li>
  </ul>
</div>

@endcan


<!-- inicio menu Seleção de Propostas-->    
<div class="menu-folder"><a class="menu-item" href="javascript: void(0)"><span class="icon">
  <i class="bi bi-file-earmark-check fa-lg"></i></span><span class="content">Resultado Primário</span></a>
  <ul>  

    <li><a class="menu-item" href="#" title="Propostas"><span class="icon">
      <i class="fa fa-clipboard-list fa-lg"></i></i></span><span class="content">Arquivos</span></a>
      <ul>
        <li><a class="menu-item" href="{{ url('/rp/arquivos/importar/rp8') }}" title="Importar RP8"><span class="icon">
          <i class="fas fa-file fa-lg"></i></span><span class="content">Importar RP8</span></a>
        </li>
      </ul>
    </li> 

    <li><a class="menu-item" href="{{ url('/rp/oficio/consultar') }}" title="Consulta Ofícios"><span class="icon">
      <i class="bi bi-journal-arrow-up fa-lg"></i></span><span class="content">Consulta Ofícios</span></a>
    </li>

    
      
     
  </ul>   
</div>

<!-- inicio menu Seleção de Propostas-->    
<div class="menu-folder"><a class="menu-item" href="javascript: void(0)"><span class="icon">
  <i class="bi bi-file-earmark-check fa-lg"></i></span><span class="content">Seleção de Propostas</span></a>
  <ul>  

  

    <li><a class="menu-item" href="#" title="Propostas"><span class="icon">
      <i class="fa fa-clipboard-list fa-lg"></i></i></span><span class="content">Propostas</span></a>
      <ul>
          <li><a class="menu-item" href="{{ url('/selecao/propostas/consultar') }}" title="Consultar Propostas"><span class="icon">
              <i class="fas fa-file fa-lg"></i></span><span class="content">Consultar Propostas</span></a>
          </li>
          <li><a class="menu-item" href="{{ url('/admin/propostas/selecionadas/consultar') }}" title="Consultar Propostas"><span class="icon">
            <i class="fas fa-file fa-lg"></i></span><span class="content">Consultar Propostas Selecionadas</span></a>
          </li>
        
       @can('eGestao')
          <li><a class="menu-item" href="{{ url('/admin/selecao/propostas/selecionar') }}" title="Selecionar Propostas"><span class="icon">
              <i class="fas fa-file fa-lg"></i></span><span class="content">Selecionar Propostas</span></a>
          </li>
          <li><a class="menu-item" href="{{ url('/selecao/resultados/consultar') }}" title="Resultados"><span class="icon">
              <i class="fas fa-file fa-lg"></i></span><span class="content">Resultados</span></a>
          </li>
          <li><a class="menu-item" href="{{ url('/admin/ente_publico/oficios/consultar') }}" title="Validar Ofícios"><span class="icon">
              <i class="fas fa-file fa-lg"></i></span><span class="content">Validar Ofícios</span></a>
          </li>
        @endcan
      </ul>  
    </li>
    <li><a class="menu-item" href="#" title="Propostas"><span class="icon">
      <i class="fa fa-clipboard-list fa-lg"></i></i></span><span class="content">Relatórios</span></a>
      <ul>
        <li><a class="menu-item" href="{{ url('/selecao/propostas/relatorios/propostas_uf') }}" title="Propostas Cadastradas por UF"><span class="icon">
          <i class="fas fa-file fa-lg"></i></span><span class="content">Propostas Cadastradas por UF</span></a>
        </li>
      </ul>
    </li> 
      <li><a class="menu-item" href="#" title="Transferegov"><span class="icon">
        <i class="bi bi-database-fill-down fa-lg"></i></i></span><span class="content">Transferegov</span></a>
        <ul>
          @can('eGestao')

            <li><a class="menu-item" href="{{ url('/admin/transferegov/execucao_orcamentaria/consultar') }}" title="Execução Transferegov"><span class="icon">
              <i class="fas fa-file fa-lg"></i></span><span class="content">Execução Transferegov</span></a>
            </li>
            <li><a class="menu-item" href="{{ url('/admin/selecao/propostas/transferegov') }}" title="Propostas Transferegov"><span class="icon">
              <i class="fas fa-file fa-lg"></i></span><span class="content">Propostas Transferegov</span></a>
            </li>
            <li><a class="menu-item" href="{{ url('/admin/transferegov/rps/consultar') }}" title="Situação Propostas RPs"><span class="icon">
              <i class="fas fa-file fa-lg"></i></span><span class="content">Situação Propostas RPs</span></a>
            </li>

            
          @endcan
        </ul>     
      </li>
  </ul>   
</div>

@can('eAdmin')
<!-- inicio menu Administrador-->   
<div class="menu-folder"><a class="menu-item" href="javascript: void(0)"><span class="icon">
  <i class="bi bi-gear-fill fa-lg"></i></span><span class="content">Administrador</span></a>
  <ul>
    
    <li><a class="menu-item" href="#" title="Faqs"><span class="icon">
      <i class="fas fa-regular fa-users" aria-hidden="true"></i></span><span class="content">Usuários</span></a>
      <ul>
       
        <li><a class="menu-item" href="{{url('/register') }}" title="Registrar Usuários"><span class="icon">
          <i class="fas fa-regular fa-user"></i></span><span class="content">Registrar Usuários</span></a>              
        </li>  

        <li><a class="menu-item" href="{{url('/admin/usuarios/filtro') }}" title="Usuários"><span class="icon">
          <i class="fas fa-regular fa-users"></i></span><span class="content">Usuários</span></a>              
        </li>  

        <li><a class="menu-item" href="{{ url('/admin/ente_publico/oficios/consultar') }}" title="Validar Ofício"><span class="icon">
          <i class="bi bi-journal-arrow-up fa-lg"></i></span><span class="content">Validar Ofício</span></a>
        </li>
       
      </ul>
    </li>
    <li><a class="menu-item" href="#" title="Faqs"><span class="icon">
      <i class="fas fa-regular fa-users" aria-hidden="true"></i></span><span class="content">Painéis</span></a>
      <ul>
       
        <li><a class="menu-item" href="{{ url('/admin/paineis/lista') }}" title="Relação de Painéis"><span class="icon">
          <i class="bi bi-journal-arrow-up fa-lg"></i></span><span class="content">Relação de Painéis</span></a>
        </li>
       
      </ul>
    </li>
  </ul>
</div>






@endcan


@can('eDev')



<!-- inicio menu BNDES-->    

<div class="menu-folder"><a class="menu-item" href="javascript: void(0)"><span class="icon">
  <i class="fbi bi-pc-display-horizontal fa-lg" aria-hidden="true"></i></span><span class="content">Bndes</span><span class="badge bg-danger">Em Desenvolvimento</span></a>
  <ul>
    <li><a class="menu-item" href="#" title="Resumos"><span class="icon">
      <i class="fbi bi-pc-display-horizontal fa-lg"></i></span><span class="content">Empreendimentos</span></a>
      <ul>
        
        <li><a class="menu-item" href="{{ url('/bndes/empreendimentos/consultar') }}" title="Consultar Empreendimentos"><span class="icon">
          <i class="fbi bi-pc-display-horizontal fa-lg"></i></span><span class="content">Consultar Empreendimentos</span></a>
        </li>          
      </ul>
    </li>
    
  </ul>
</div>


<!-- inicio menu Debentures e Reidi-->    
<!--
<div class="menu-folder"><a class="menu-item" href="javascript: void(0)"><span class="icon">
  <i class="bi bi-journal-text fa-lg"></i></span><span class="content">Debentures e Reidi</span><span class="badge bg-danger">Em Desenvolvimento</span></a>
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
-->


<!-- inicio menu sistema apis-->
<div class="menu-folder"><a class="menu-item" href="javascript: void(0)"><span class="icon">
  <i class="fas fa-regular fa-home"></i></span><span class="content">Debentures</span> <span class="badge bg-danger">Em Desenvolvimento</span></a>
    <ul>
        <li disabled><a class="menu-item" href="{{ url('/apis/debentures/cadastrar') }}" title="Cadastrar Debentures" disabled><span class="icon">
              <i class="fas fa-regular fa-home"></i></span><span class="content">Cadastrar Debentures</span></a>
        </li>
        <li><a class="menu-item" href="{{ url('/apis/debentures/consultar') }}" title="Consultar Debentures"><span class="icon">
              <i class="fas fa-regular fa-home"></i></span><span class="content">Consultar Debentures</span></a>
        </li>
    </ul>
</div>


<!-- inicio menu SACI WEB-->    
<div class="menu-folder"><a class="menu-item" href="javascript: void(0)"><span class="icon">
  <i class="bi bi-pc-display-horizontal fa-lg"></i></span><span class="content">SACI WEB</span><span class="badge bg-danger">Em Desenvolvimento</span></a>
  <ul>
    
    <li><a class="menu-item" href="{{ url('/saci/propostas/cadastro') }}" title="Cadastrar Propostas"><span class="icon">
      <i class="bi bi-journal-plus fa-lg"></i></span><span class="content">Cadastrar Propostas</span></a>
    </li>

    
    <li><a class="menu-item" href="{{ url('/saci/contratos/filtro') }}" title="Consultar Contratos"><span class="icon">
      <i class="bi bi-journal-plus fa-lg"></i></span><span class="content">Consultar Contratos</span></a>
    </li>

    <li><a class="menu-item" href="{{ url('/saci/propostas') }}" title="Registros Importados/Cadastrados"><span class="icon">
      <i class="bi bi-journal-text fa-lg"></i></span><span class="content">Registros Importados/Cadastrados</span></a>
    </li>
    
  </ul>
</div>
@endcan

