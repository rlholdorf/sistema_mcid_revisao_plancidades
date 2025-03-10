@extends('layouts.app')

@section('content')




<historico-navegacao
      :url="'{{ url('/home') }}'"      
      :telanterior01="'Ente Público'"  
      :telatual="'Seleção de propostas em andamento'"
      >

</historico-navegacao>


<div class="main-content pl-sm-3 mt-5" id="main-content">
  
    <cabecalho-relatorios
        :titulo="'Seleção de propostas em andamento'"
        :dataatualizacao="'{{date('d/m/Y',strtotime($usuario->updated_at))}}'"
       barracompartilhar="false">

    </cabecalho-relatorios> 


    <p>
        Abaixo estão listadas as modalidades de seleção de propostas disponíveis em nosso sistema. Solicitamos a gentileza de se atentar aos prazos de 
        cadastro das propostas em cada modalidade para garantir a participação nos processos seletivos. Estamos à disposição para esclarecer qualquer 
        dúvida e oferecer suporte durante o processo.
    </p>
    <span class="br-divider my-3"></span>

    <div class="br-card">
        <div class="card-header">
        <div class="d-flex"><span class="br-avatar mt-1" title="Fulano da Silva"><span class="content">
            <img height="50" width="50" src='{{ URL::asset("/img/icones/termo.png")}}' alt="Avatar"/></span></span>
            <div class="ml-3">
            <div class="text-weight-semi-bold text-up-02">
                Programa 2217   
            </div>

            <div>
                Desenvolvimento Urbano e Metropolitano
            </div>
            </div>
            <div class="ml-auto">
            <!--
            <button class="br-button circle" type="button" aria-label="Ícone ilustrativo"><i class="fas fa-ellipsis-v" aria-hidden="true"></i>
            </button>
        -->
            </div>
        </div>
        </div>
        <div class="card-content">
            
            <h4>OBJETIVO</h4>
            <p>
                O Programa 2217 - possui objetivo de Fomentar transformações urbanísticas estruturais e urbanização acessível orientadas pelas funções 
                sociais da cidade e da propriedade.
            </p>
            <p>
                Apoio a estados e municípios para promoção da urbanização acessível, por meio de ações e intervenções de qualificação de espaços 
                de uso público, eliminação de barreiras arquitetônicas e urbanísticas e modernização tecnológica.
            </p>
        <!--
            <h4>DIRETRIZES</h4>
            <p>
                As propostas cadastradas devem ser compatíveis com:
            </p>
            <p>
                a)	O Plano Diretor;
            </br>  
            b)	O Código de Posturas;
            </br>  
            c)	O Código de Obras e de Edificações;
            </br>  
            d)	Os planos locais de habitação, saneamento, mobilidade urbana, dentre outros;
            </br>  
            e)	O Estatuto da Cidade (Lei n.º 10.257/01);
            </br>  
            f)	A Política Nacional de Mobilidade Urbana (Lei n.º 12.587/12);
            </br>  
            g)	Demais leis e normas nacionais, regionais e locais acerca de edificações, infraestrutura urbana, 
            parcelamento, uso e ocupação do solo, proteção e preservação do meio ambiente e do patrimônio cultural;
            </br>  
            h)	Promover o exercício dos direitos das pessoas com deficiência nos termos da Convenção Internacional sobre os Direitos das Pessoas com Deficiência; 
            da Lei Brasileira de Inclusão da Pessoa com Deficiência (Lei n.º 13.146/15); da Lei n.º 10.098/00; da Lei n.º 10.048/00; do Decreto n.º 5.296/04; da 
            NBR 9050:2015 – Acessibilidade a edificações, mobiliário, espaços e equipamentos urbanos e das demais normas vigentes;
            </br> 
            i)	Fomentar a implentação de tecnologia e comunicação para assegurar o desenvolvimento urbano no âmbito do Programa de Fortalecimento das Capacidades 
            Governativas Subnacionais, visando otimizara prestação dos diversos serviços públicos à população, garantindo o desenvolvimento urbano sustentável; o 
            apoio a estratégias, programas, projetos, produtos e ações com soluções inteligentes vinculadas a gestão urbana; e a capacitação de servidores e agentes
            municipais para conhecimento, uso e operação dos sistemas tecnológicos utilizados; e
            </br> 
            j)	Observar as disposições referentes à elaboração de custos contidas no Decreto n.º 7.983/2013 e as orientações previstas na Portaria Interministerial
             n.º 424/2016, adotando como referência custos menores ou iguais à mediana de seus correspondentes no Sistema Nacional de Pesquisa de Custos e Índices 
             da Construção Civil (SINAPI) e, no caso de obras e serviços rodoviários, a tabela do Sistema de Custos de Obras Rodoviárias (SICRO).
            </p>
        -->
            <h4>PARTICIPANTES E ATRIBUIÇÕES</h4>
            <P>
                Constituem-se participantes da ação orçamentária:
            </P>
            <p>
                a)	Gestor/Concedente, representado pelo Ministério das Cidades;</br>
                b)	Mandatária da União, representada pela Caixa Econômica Federal e</br>
                c)	Proponentes/Compromissários:</br>
                I. O chefe do Poder Executivo dos Estados, do Distrito Federal e dos Municípios, ou seu representante legal.</br>
                II. O representante legal dos Consórcios Públicos.</br>
                d)	Interveniente: órgão ou entidade da Administração Pública direta ou indireta de qualquer esfera de governo, ou entidade privada que participa do instrumento para manifestar consentimento ou assumir obrigações em nome próprio.</br>
                
            </p>

            <p>
                As competências e responsabilidades dos participantes estão preconizadas nos manuas específicos do Ministério das Cidades e na legislação sobre convênios do Governo Federal, Portaria Interministerial nº 424, de 30 de dezembro de 2016.
            </p>
<!--
            <h4>CRONOGRAMA</h4>
                <div class="table-responsive">	
                    <table class="table table-bordered table-sm tab_executivo">
                        <thead>
                            <tr>
                                <th>Tarefa</th>         
                                <th>Atribuido para</th>    
                                <th>Início</th>                                                                                                       
                                <th>Término</th>
                            </tr>
                                                
                        </thead>
                        <tbody>
                            @foreach($cronogramas as $dados)
                                @if($dados->selecao_id == 2)                        
                                    <tr>                        
                                        <td>{{$dados->dsc_tarefa}}</td>
                                        <td class="text-center">{{$dados->txt_atribuicao}}</td>
                                        <td class="text-center">{{date('d/m/Y',strtotime($dados->dte_inicio_tarefa))}}</td>
                                        <td class="text-center">{{date('d/m/Y',strtotime($dados->dte_fim_tarefa))}}</td>
                                    </tr>   
                                    @endif
                            @endforeach                                           
                            
                        </tbody>
                    </table>     
                </div>
            -->

            <h4>DOCUMENTOS</h4>
                <div class="row">
                    <div class="column col-xs-12 col-sm-6 col-md-6 text-center">
                        <a href="{{ url("/documentos/manuais/PS_Emendas_Discricionarias_4A_RP2_SNDUM.pdf") }}" target="_blank" title="Manifestação de Interesse" class="state-published">
                            <img height="50" width="50" src='{{ URL::asset("/img/icones/termo.png")}}'  class="img-thumbnail" >
                        </a></br> 
                        Manual de Processo Seletivo
                    </div>
                    <div class="column col-xs-12 col-sm-6 col-md-6 text-center">
                        <a href="https://www.gov.br/cidades/pt-br/acesso-a-informacao/acoes-e-programas/programas-projetos-acoes-obras-e-atividades/programas-e-acoes-orcamentarias/programa-2217-desenvolvimento-regional-territorial-e-urbano-ppa-2020-2023/acoes-orcamentarias-programa-2217-loa-mcid-2023" 
                        target="_blank" title="Manifestação de Interesse" class="state-published">
                            <img height="50" width="50" src='{{ URL::asset("/img/icones/termo.png")}}'  class="img-thumbnail" >
                        </a></br> 
                        Manual de Ações Orçamentárias - Programa 2217 - LOA MCID 2023
                    </div>
                </div>
            

        </div>
        <div class="card-footer">
        <div class="d-flex" style="padding-top: 10px;"> 
            <form class="form-horizontal" role="form" method="POST" action='{{ url("proposta/cadastrar/selecao/2") }}'>         
                {{ csrf_field() }}
                <input type="hidden" id="txt_cpf_usuario" name="txt_cpf_usuario" value="{{Crypt::encrypt($usuario->txt_cpf_usuario)}}">
                <input type="hidden" id="ente_publico_id" name="ente_publico_id" value="{{Crypt::encrypt($usuario->ente_publico_id)}}">                        
                <input type="hidden" id="moduloSistema" name="moduloSistema" value="{{$moduloSistema}}">                        
                                     
                <button type="submit" class="br-button block secondary mr-3" aria-label="Ícone ilustrativo">
                    <i class="fas fa-edit" aria-hidden="true"></i>Cadastrar Proposta
                </button>                          
            </form>
        </div>
        </div>                  
    </div><!-- br-card -->

    <span class="br-divider my-3"></span>

    <div class="br-card">
        <div class="card-header">
        <div class="d-flex"><span class="br-avatar mt-1" title="Fulano da Silva"><span class="content">
            <img height="50" width="50" src='{{ URL::asset("/img/icones/termo.png")}}' alt="Avatar"/></span></span>
            <div class="ml-3">
            <div class="text-weight-semi-bold text-up-02">
                Programa 2218   
            </div>

            <div>
                Gestão de Riscos e Desastres
            </div>
            </div>
            <div class="ml-auto">
          
            </div>
        </div>
        </div>
        <div class="card-content">
            
            <h4>OBJETIVO</h4>
            <p>
                O Programa 2218 - possui objetivo de Investir na Compreensão e Redução do Risco, Ampliar a Preparação e Reduzir os Efeitos dos Desastres.
            </p>
            <p>
                Apoio a estados e municípios para promoção da melhoria da qualidade ambiental, da conservação e do uso sustentável de recursos naturais,
                considerados os custos e os benefícios ambientais.
            </p>
       
            <h4>PARTICIPANTES E ATRIBUIÇÕES</h4>
            <P>
                Constituem-se participantes da ação orçamentária:
            </P>
            <p>
                a)	Gestor/Concedente, representado pelo Ministério das Cidades;</br>
                b)	Mandatária da União, representada pela Caixa Econômica Federal e</br>
                c)	Proponentes/Compromissários:</br>
                I. O chefe do Poder Executivo dos Estados, do Distrito Federal e dos Municípios, ou seu representante legal.</br>
                II. O representante legal dos Consórcios Públicos.</br>
                d)	Interveniente: órgão ou entidade da Administração Pública direta ou indireta de qualquer esfera de governo, ou entidade privada que participa do instrumento para manifestar consentimento ou assumir obrigações em nome próprio.</br>
                
            </p>

            <p>
                As competências e responsabilidades dos participantes estão preconizadas nos manuas específicos do Ministério das Cidades e na legislação sobre convênios do Governo Federal, Portaria Interministerial nº 424, de 30 de dezembro de 2016.
            </p>
<!--
            <h4>CRONOGRAMA</h4>
                <div class="table-responsive">	
                    <table class="table table-bordered table-sm tab_executivo">
                        <thead>
                            <tr>
                                <th>Tarefa</th>         
                                <th>Atribuido para</th>    
                                <th>Início</th>                                                                                                       
                                <th>Término</th>
                            </tr>
                                                
                        </thead>
                        <tbody>
                            @foreach($cronogramas as $dados)
                                @if($dados->selecao_id == 5)                        
                                    <tr>                        
                                        <td>{{$dados->dsc_tarefa}}</td>
                                        <td class="text-center">{{$dados->txt_atribuicao}}</td>
                                        <td class="text-center">{{date('d/m/Y',strtotime($dados->dte_inicio_tarefa))}}</td>
                                        <td class="text-center">{{date('d/m/Y',strtotime($dados->dte_fim_tarefa))}}</td>
                                    </tr>   
                                    @endif
                            @endforeach                                           
                            
                        </tbody>
                    </table>     
                </div>
    -->
<!--
            <h4>DOCUMENTOS</h4>
                <div class="row">
                    <div class="column col-xs-12 col-sm-6 col-md-6 text-center">
                        <a href="{{ url("/documentos/manuais/PS_Emendas_Discricionarias_4A_RP2_SNDUM.pdf") }}" target="_blank" title="Manifestação de Interesse" class="state-published">
                            <img height="50" width="50" src='{{ URL::asset("/img/icones/termo.png")}}'  class="img-thumbnail" >
                        </a></br> 
                        Manual de Processo Seletivo
                    </div>
                    <div class="column col-xs-12 col-sm-6 col-md-6 text-center">
                        <a href="https://www.gov.br/cidades/pt-br/acesso-a-informacao/acoes-e-programas/programas-projetos-acoes-obras-e-atividades/programas-e-acoes-orcamentarias/programa-2217-desenvolvimento-regional-territorial-e-urbano-ppa-2020-2023/acoes-orcamentarias-programa-2217-loa-mcid-2023" 
                        target="_blank" title="Manifestação de Interesse" class="state-published">
                            <img height="50" width="50" src='{{ URL::asset("/img/icones/termo.png")}}'  class="img-thumbnail" >
                        </a></br> 
                        Manual de Ações Orçamentárias - Programa 2217 - LOA MCID 2023
                    </div>
                </div>
            -->          

        </div>
       
            @foreach($selecao as $dados)
            
                @if($dados->id == 5 && $dados->dte_fim_cadastro_proposta >= $dataAtual)
                    <div class="card-footer">
                        <div class="d-flex" style="padding-top: 10px;"> 
                            <form class="form-horizontal" role="form" method="POST" action='{{ url("proposta/cadastrar/selecao/5") }}'>         
                                {{ csrf_field() }}
                                <input type="hidden" id="txt_cpf_usuario" name="txt_cpf_usuario" value="{{Crypt::encrypt($usuario->txt_cpf_usuario)}}">
                                <input type="hidden" id="ente_publico_id" name="ente_publico_id" value="{{Crypt::encrypt($usuario->ente_publico_id)}}">    
                                <input type="hidden" id="moduloSistema" name="moduloSistema" value="0">                          
                                                    
                                <button type="submit" class="br-button block secondary mr-3" aria-label="Ícone ilustrativo">
                                    <i class="fas fa-edit" aria-hidden="true"></i>Cadastrar Proposta
                                </button>                          
                            </form>
                        </div>
                    </div>                  
                @endif
            @endforeach

    </div><!-- br-card -->

    <span class="br-divider my-3"></span>
    
        <div class="br-card">
            <div class="card-header">
            <div class="d-flex"><span class="br-avatar mt-1" title="Fulano da Silva"><span class="content">
                <img height="50" width="50" src='{{ URL::asset("/img/icones/termo.png")}}' alt="Avatar"/></span></span>
                <div class="ml-3">
                <div class="text-weight-semi-bold text-up-02">
                    Programa 2219   
                </div>

                <div>
                    Mobilidade Urbana
                </div>
                </div>
                <div class="ml-auto">
                <!--
                <button class="br-button circle" type="button" aria-label="Ícone ilustrativo"><i class="fas fa-ellipsis-v" aria-hidden="true"></i>
                </button>
            -->
                </div>
            </div>
            </div>
            <div class="card-content">
                
                <h4>OBJETIVO</h4>
                <p>
                    O Programa 2219 – Mobilidade Urbana possui objetivos consoantes com a
                    Política Nacional de Mobilidade Urbana, instituída pela Lei nº 12.587, de 3 de janeiro de 2012. 
                </p>
                <p>
                    As ações que integram este manual destinam-se a reduzir as desigualdades e
                    promover a inclusão social, promover o acesso aos serviços básicos e equipamentos
                    sociais, proporcionar melhoria nas condições urbanas da população no que se refere à
                    acessibilidade e à mobilidade, promover o desenvolvimento sustentável com a
                    mitigação dos custos ambientais e socioeconômicos dos deslocamentos de pessoas e
                    cargas nas cidades, e consolidar a gestão democrática como instrumento e garantia da
                    construção contínua do aprimoramento da mobilidade urbana.
                </p>
            <!--    
                <h4>DIRETRIZES</h4>
                <p>
                    As propostas cadastradas devem ser compatíveis com:
                </p>
                <p>
                    a) O Plano de Mobilidade Urbana do Município;
                </br>  
                    b) O Plano Diretor Municipal e os demais planos locais;
                </br>  
                    c) A legislação municipal, estadual e federal;
                </br>  
                    d) As normas técnicas da Associação Brasileira de Normas Técnicas – ABNT; e
                </br>  
                    e) Demais regramentos aplicáveis.
                </p>
            
                <p>
                    Os processos de cadastramento, enquadramento, seleção e execução de
                    propostas no âmbito do Programa 2219 – Mobilidade Urbana devem ser compatíveis
                    com os cadernos, cartilhas e demais referências técnicas publicadas no sítio eletrônico
                    do Ministério das Cidades.
                </p>    
            -->
                <h4>PARTICIPANTES E ATRIBUIÇÕES</h4>
                <P>
                    Constituem-se participantes da ação orçamentária:
                </P>
                <p>
                    a)	Gestor/Concedente, representado pelo Ministério das Cidades;</br>
                    b)	Mandatária da União, representada pela Caixa Econômica Federal e</br>
                    c)	Proponentes/Compromissários:</br>
                    I. O chefe do Poder Executivo dos Estados, do Distrito Federal e dos Municípios, ou seu representante legal.</br>
                    II. O representante legal dos Consórcios Públicos.</br>
                    d)	Interveniente: órgão ou entidade da Administração Pública direta ou indireta de qualquer esfera de governo, ou entidade privada que participa do instrumento para manifestar consentimento ou assumir obrigações em nome próprio.</br>
                </p>
                <p>
                As competências e responsabilidades dos participantes estão preconizadas nos manuas específicos do Ministério das Cidades e na legislação sobre convênios do Governo Federal, Portaria Interministerial nº 424, de 30 de dezembro de 2016.
                    
                </p>
<!--
                <h4>CRONOGRAMA</h4>
                <div class="table-responsive">	
                    <table class="table table-bordered table-sm tab_executivo">
                        <thead>
                            <tr>
                                <th>Tarefa</th>         
                                <th>Atribuido para</th>    
                                <th>Início</th>                                                                                                       
                                <th>Término</th>
                            </tr>
                                                
                        </thead>
                        <tbody>
                            @foreach($cronogramas as $dados)
                                @if($dados->selecao_id == 1)                        
                                    <tr>                        
                                        <td>{{$dados->dsc_tarefa}}</td>
                                        <td class="text-center">{{$dados->txt_atribuicao}}</td>
                                        <td class="text-center">{{date('d/m/Y',strtotime($dados->dte_inicio_tarefa))}}</td>
                                        <td class="text-center">{{date('d/m/Y',strtotime($dados->dte_fim_tarefa))}}</td>
                                    </tr>   
                                    @endif
                            @endforeach                                           
                            
                        </tbody>
                    </table>     
                </div>
            -->             
                
                <h4>DOCUMENTOS</h4>
                <div class="row">
                    <div class="column col-xs-12 col-sm-6 col-md-6 text-center">
                        <a href="https://www.gov.br/cidades/pt-br/cadastramento/PS_Emendas_Discricionrias_4A_RP2_MOBILIDADE_rev3.pdf" title="Manifestação de Interesse" class="state-published">
                            <img  height="50" width="50" src='{{ URL::asset("/img/icones/termo.png")}}'  class="img-thumbnail" >
                        </a></br> 
                        Manual de Processo Seletivo
                    </div>
                    <div class="column col-xs-12 col-sm-6 col-md-6 text-center">
                        <a href="{{ url('admin/pcva_parcerias/termo/filtro') }}" title="Manifestação de Interesse" class="state-published">
                            <img height="50" width="50" src='{{ URL::asset("/img/icones/termo.png")}}'  class="img-thumbnail" >
                        </a></br> 
                        Manual do Programa 2219 – Mobilidade Urbana
                    </div>
                </div>

            </div>
            <div class="card-footer">
            <div class="d-flex" style="padding-top: 10px;">                         
                <form class="form-horizontal" role="form" method="POST" action='{{ url("proposta/cadastrar/selecao/1") }}'>         
                    {{ csrf_field() }}
                    <input type="hidden" id="txt_cpf_usuario" name="txt_cpf_usuario" value="{{Crypt::encrypt($usuario->txt_cpf_usuario)}}">
                    <input type="hidden" id="ente_publico_id" name="ente_publico_id" value="{{Crypt::encrypt($usuario->ente_publico_id)}}">   
                    <input type="hidden" id="moduloSistema" name="moduloSistema" value="{{$moduloSistema}}">                       

                    <button type="submit" class="br-button block secondary mr-3" aria-label="Ícone ilustrativo" >
                        <i class="fas fa-edit" aria-hidden="true"></i>Cadastrar Proposta
                    </button>                          
                </form>                         
            </div>
            </div>                  
        </div><!-- br-card -->

        <span class="br-divider my-3"></span>
     

    <div class="br-card">
        <div class="card-header">
        <div class="d-flex"><span class="br-avatar mt-1" title="Fulano da Silva"><span class="content">
            <img height="50" width="50" src='{{ URL::asset("/img/icones/termo.png")}}' alt="Avatar"/></span></span>
            <div class="ml-3">
            <div class="text-weight-semi-bold text-up-02">
                Programa 2222
            </div>

            <div>
                Saneamento Básico
            </div>
            </div>
            <div class="ml-auto">
            <!--
            <button class="br-button circle" type="button" aria-label="Ícone ilustrativo"><i class="fas fa-ellipsis-v" aria-hidden="true"></i>
            </button>
        -->
            </div>
        </div>
        </div>
        <div class="card-content">
            
            <h4>OBJETIVO</h4>
            <p>
                O Programa 2222 – Saneamento Básico possui objetivos consoantes com a Política Nacional de Saneamento Básico, instituída pela lei nº 11.445, de 
                5 de janeiro de 2007.
            </p>
            <p>
                Apoio a estados e municípios para promoção da universalização do saneamento no Brasil, por meio de ações e intervenções de qualificação de 
                abastecimento de água potável, esgotamento sanitário, limpeza urbana e manejo de resíduos sólidos e drenagem e manejo das águas pluviais urbanas.
            </p>
        <!--    
            <h4>DIRETRIZES</h4>
            <p>
                As propostas cadastradas devem ser compatíveis com:
            </p>
            <p>
                a)	O Plano Diretor;
            </br>  
            b)	Ações planejadas e sustentáveis que visem atender as necessidades das comunidades de forma eficiente e eficaz;
            </br>  
            c)	Pedido que considere a integralidade das ações de saneamento básico;
            </br>  
            d)	Município com baixo Índice de Desenvolvimento Humano Municipal (IDH-M), com elevados indicadores de enfermidades 
            evitáveis pelo saneamento e com grave condição de insalubridade ambiental;
            </br>  
            e)	Menor receita corrente líquida per capita do município;
            </br>  
            f)	Pedido que considere a compatibilidade do empreendimento com a disponibilidade hídrica dos mananciais e com a capacidade de suporte dos corpos 
            receptores, em sintonia com o planejamento e a gestão dos recursos hídricos;
            </p>
        -->
            <h4>PARTICIPANTES E ATRIBUIÇÕES</h4>
            <P>
                Constituem-se participantes da ação orçamentária:
            </P>
            <p>
            a)	Gestor/Concedente, representado pelo Ministério das Cidades;</br>  
            b)	Mandatária da União, representada pela Caixa Econômica Federal e</br>  
            c)	Proponentes/Compromissários:</br>  
            I.	O chefe do Poder Executivo dos Estados, do Distrito Federal e dos Municípios, ou seu representante legal.</br>  
            II.	O representante legal dos Consórcios Públicos.</br>  
            d)	Interveniente: órgão ou entidade da Administração Pública direta ou indireta de qualquer esfera de governo, ou entidade privada que participa do instrumento para manifestar consentimento ou assumir obrigações em nome próprio.
            </p>

            <p>
                As competências e responsabilidades dos participantes estão preconizadas nos manuais específicos do Ministério das Cidades e na legislação sobre convênios do Governo Federal, Portaria Interministerial nº 424, de 30 de dezembro de 2016.
            </p>
    <!--        
            <h4>CRONOGRAMA</h4>
                <div class="table-responsive">	
                    <table class="table table-bordered table-sm tab_executivo">
                        <thead>
                            <tr>
                                <th>Tarefa</th>         
                                <th>Atribuido para</th>    
                                <th>Início</th>                                                                                                       
                                <th>Término</th>
                            </tr>
                                                
                        </thead>
                        <tbody>
                            @foreach($cronogramas as $dados)
                                @if($dados->selecao_id == 3)                        
                                    <tr>                        
                                        <td>{{$dados->dsc_tarefa}}</td>
                                        <td class="text-center">{{$dados->txt_atribuicao}}</td>
                                        <td class="text-center">{{date('d/m/Y',strtotime($dados->dte_inicio_tarefa))}}</td>
                                        <td class="text-center">{{date('d/m/Y',strtotime($dados->dte_fim_tarefa))}}</td>
                                    </tr>   
                                    @endif
                            @endforeach                                           
                            
                        </tbody>
                    </table>     
                </div>
            -->
            <h4>DOCUMENTOS</h4>
                <div class="row">
                    <div class="column col-xs-12 col-sm-4 col-md-4 text-center">
                        <a href="{{ url("/documentos/manuais/PS_Emendas_Discricionarias_4A_RP2_SNSA.pdf") }}" target="_blank" title="Manifestação de Interesse" class="state-published">
                            <img height="50" width="50" src='{{ URL::asset("/img/icones/termo.png")}}'  class="img-thumbnail" >
                        </a></br> 
                        Manual de Processo Seletivo
                    </div>
                    <div class="column col-xs-12 col-sm-4 col-md-4 text-center">
                        <a href="http://www.funasa.gov.br/documents/20182/38564/manualdeorientacoestecnicasparaelaboracaodepropostasmelhoriassanitariasdomiciliares.pdf/907ae2d8-a1da-4c1f-9330-969f1f474615" 
                        target="_blank" title="Manifestação de Interesse" class="state-published">
                            <img height="50" width="50" src='{{ URL::asset("/img/icones/termo.png")}}'  class="img-thumbnail" >
                        </a></br> 
                        Manual da Ação 21CI
                    </div>
                    <div class="column col-xs-12 col-sm-4 col-md-4 text-center">
                        <a href="http://www.funasa.gov.br/documents/20182/34981/manualdeorientacoestecnicasparaelaboracaodepropostasresiduossolidos.pdf/d84790e5-647b-47c6-b393-bfd89a322563" 
                        target="_blank" title="Manifestação de Interesse" class="state-published">
                            <img height="50" width="50" src='{{ URL::asset("/img/icones/termo.png")}}'  class="img-thumbnail" >
                        </a></br> 
                        Manual da Ação 21CC
                    </div>
                </div>

            </br>

                <p>
                    A Ação 21C9 previa o apoio a diferentes iniciativas, por essa razão não conta com manual específico.
                </p>
                <p>
                    De acordo com o sistemática que vinha sendo adotada, para orientar a aplicação de recursos na Ação 21C9 deviam ser observados os seguintes manuais e normativos:
                </p>

            </br>
<div class="br-list" role="list">
    
    
    <div class="br-item" role="listitem">
      <div class="row align-items-center">
        <div class="col-auto">
            <a href="http://www.funasa.gov.br/documents/20182/38564/MNL_PROPOSTAS_SAA_10_03_2017.pdf/9c649bec-f5f4-4b4e-9a63-fac73f248c38" target="_blank" title="Manifestação de Interesse" class="state-published">
                <img height="50" width="50" src='{{ URL::asset("/img/icones/termo.png")}}'  class="img-thumbnail" >
            </a> 
        </div>
        <div class="col">
            Manual de Orientações Técnicas para Elaboração e Apresentação de Propostas e Projetos para Sistemas de Abastecimento de Água – Ação 21CA;
        </div>
       
      </div>
    </div>
    <div class="br-item" role="listitem">
        <div class="row align-items-center">
          <div class="col-auto">
              <a href="http://www.funasa.gov.br/documents/20182/38564/MNL_PROPOSTAS_SES_10_03_2017.pdf/0f872826-26af-4a96-b448-72e71615f0c6" target="_blank" title="Manifestação de Interesse" class="state-published">
                  <img height="50" width="50" src='{{ URL::asset("/img/icones/termo.png")}}'  class="img-thumbnail" >
              </a> 
          </div>
          <div class="col">
            Manual de Orientações Técnicas para Elaboração e Apresentação de Propostas e Projetos para Sistemas de Esgotamento Sanitário;
          </div>
         
        </div>
      </div>
      <div class="br-item" role="listitem">
        <div class="row align-items-center">
          <div class="col-auto">
              <a href="http://www.funasa.gov.br/documents/20182/38564/orientacoesparapadronizacaodedocumentostecnicos.pdf/ee4530f0-6c91-4d32-bb7d-f2bcdfeed5c8" target="_blank" title="Manifestação de Interesse" class="state-published">
                  <img height="50" width="50" src='{{ URL::asset("/img/icones/termo.png")}}'  class="img-thumbnail" >
              </a> 
          </div>
          <div class="col">
            Manual de Orientações Técnicas para Elaboração e Apresentação de Propostas e Projetos para Sistemas de Esgotamento Sanitário;
            
          </div>
         
        </div>
      </div>
      <div class="br-item" role="listitem">
        <div class="row align-items-center">
          <div class="col-auto">
              <a href="http://www.funasa.gov.br/documents/20182/38564/manualdeorientacoestecnicasparaelaboracaodepropostasmelhoriassanitariasdomiciliares.pdf/907ae2d8-a1da-4c1f-9330-969f1f474615" target="_blank" title="Manifestação de Interesse" class="state-published">
                  <img height="50" width="50" src='{{ URL::asset("/img/icones/termo.png")}}'  class="img-thumbnail" >
              </a> 
          </div>
          <div class="col">
            Manual de Orientações Técnicas para Elaboração de Propostas para o Programa de Melhorias Sanitárias Domiciliares;
            
          </div>
         
        </div>
      </div>
      <div class="br-item" role="listitem">
        <div class="row align-items-center">
          <div class="col-auto">
              <a href="http://www.funasa.gov.br/documents/20182/38564/manual_execucao_convenios_termos_compromisso_servico_engenharia.pdf/3a6f9ee9-120f-48d9-86e1-f1e23218e805" target="_blank" title="Manifestação de Interesse" class="state-published">
                  <img height="50" width="50" src='{{ URL::asset("/img/icones/termo.png")}}'  class="img-thumbnail" >
              </a> 
          </div>
          <div class="col">
            Manual de Procedimentos para Execução de Convênios ou Termos de Compromisso e para Obras e Serviços de Engenharia Executados Direta ou Indiretamente pela Funasa
            
          </div>
         
        </div>
      </div>
    
  </div>
  


        </div>
        <div class="card-footer">
        <div class="d-flex" style="padding-top: 10px;">                         
            <form class="form-horizontal" role="form" method="POST" action='{{ url("proposta/cadastrar/selecao/3") }}'>         
                {{ csrf_field() }}
                <input type="hidden" id="txt_cpf_usuario" name="txt_cpf_usuario" value="{{Crypt::encrypt($usuario->txt_cpf_usuario)}}">
                <input type="hidden" id="ente_publico_id" name="ente_publico_id" value="{{Crypt::encrypt($usuario->ente_publico_id)}}">    
                <input type="hidden" id="moduloSistema" name="moduloSistema" value="{{$moduloSistema}}">                       
                                    
                <button type="submit" class="br-button block secondary mr-3" aria-label="Ícone ilustrativo" >
                    <i class="fas fa-edit" aria-hidden="true"></i>Cadastrar Proposta
                </button>                          
            </form>                         
        </div>
        </div>                  
    </div><!-- br-card -->

    <div class="br-card">
        <div class="card-header">
        <div class="d-flex"><span class="br-avatar mt-1" title="Fulano da Silva"><span class="content">
            <img height="50" width="50" src='{{ URL::asset("/img/icones/termo.png")}}' alt="Avatar"/></span></span>
            <div class="ml-3">
            <div class="text-weight-semi-bold text-up-02">
                Programa 2220
            </div>

            <div>
                Habitação
            </div>
            </div>
            <div class="ml-auto">
            <!--
            <button class="br-button circle" type="button" aria-label="Ícone ilustrativo"><i class="fas fa-ellipsis-v" aria-hidden="true"></i>
            </button>
        -->
            </div>
        </div>
        </div>
        <div class="card-content">
            
            <h4>OBJETIVO</h4>
            <p>
                O Programa 2220 – Moradia Digna tem como objetivo promover o acesso e a melhoria das condições de moradia.
            </p>
           
            <h4>PARTICIPANTES E ATRIBUIÇÕES</h4>
            <P>
                Constituem-se participantes da ação orçamentária:
            </P>
            <p>
            a)	Gestor/Concedente, representado pelo Ministério das Cidades;</br>  
            b)	Mandatária da União, representada pela Caixa Econômica Federal e</br>  
            c)	Proponentes/Compromissários:</br>  
            I.	O chefe do Poder Executivo dos Estados, do Distrito Federal e dos Municípios, ou seu representante legal.</br>  
            II.	O representante legal dos Consórcios Públicos.</br>  
            d)	Interveniente: órgão ou entidade da Administração Pública direta ou indireta de qualquer esfera de governo, ou entidade privada que participa do instrumento para manifestar consentimento ou assumir obrigações em nome próprio.
            </p>

            <p>
                As competências e responsabilidades dos participantes estão preconizadas nos manuais específicos do Ministério das Cidades e na legislação sobre convênios do Governo Federal, Portaria Interministerial nº 424, de 30 de dezembro de 2016.
            </p>
   
            <h4>DOCUMENTOS</h4>
                <div class="row">
                    
                    <div class="column col-xs-12 col-sm-4 col-md-4 text-center">
                        <a href="https://www.gov.br/cidades/pt-br/acesso-a-informacao/acoes-e-programas/programas-projetos-acoes-obras-e-atividades/programas-finalisticos-e-acoes-orcamentarias/plano-plurianual-ppa-2020-2023/programa-2220-moradia-digna-ppa-2020-2023/acoes-orcamentarias-programa-2220-do-ppa-2020-2023-loa-mcid-2023/relatorio-siop-acao-00cw-2023.pdf" 
                        target="_blank" title="Manifestação de Interesse" class="state-published">
                            <img height="50" width="50" src='{{ URL::asset("/img/icones/termo.png")}}'  class="img-thumbnail" >
                        </a></br> 
                        Relatório SIOP Ação 00CW
                    </div>
                    
                </div>

 


        </div>
        <div class="card-footer">
        <div class="d-flex" style="padding-top: 10px;">                         
            <form class="form-horizontal" role="form" method="POST" action='{{ url("proposta/cadastrar/selecao/6") }}'>         
                {{ csrf_field() }}
                <input type="hidden" id="txt_cpf_usuario" name="txt_cpf_usuario" value="{{Crypt::encrypt($usuario->txt_cpf_usuario)}}">
                <input type="hidden" id="ente_publico_id" name="ente_publico_id" value="{{Crypt::encrypt($usuario->ente_publico_id)}}">    
                <input type="hidden" id="moduloSistema" name="moduloSistema" value="{{$moduloSistema}}">                       
                                    
                <button type="submit" class="br-button block secondary mr-3" aria-label="Ícone ilustrativo" >
                    <i class="fas fa-edit" aria-hidden="true"></i>Cadastrar Proposta
                </button>                          
            </form>                         
        </div>
        </div>                  
    </div><!-- br-card -->

    
    <div class="p-3 text-right">
        <button class="br-button danger mr-3" type="button" onclick="window.location.href='/home_ente_publico'">Fechar
        </button>
      </div> 
   

</div>
@endsection
