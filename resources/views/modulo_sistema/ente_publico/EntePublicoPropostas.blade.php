@extends('layouts.app')

@section('scriptscss')
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/custom.css')}}"  media="screen" />
<link rel="stylesheet" type="text/css" href="{{ asset('css/relatorio_executivo.css') }}"  media="screen" > 

@endsection


@section('content')




<historico-navegacao
      :url="'{{ url('/home') }}'"      
      :telanterior01="'Ente Público'"  
      :telatual="'Propostas'"
      >

</historico-navegacao>


<div class="main-content pl-sm-3 mt-5" id="main-content">
  
    <cabecalho-relatorios
        :titulo="'{{$usuario->name}}'"
        :subtitulo1="'{{$usuario->tipoUsuario->txt_tipo_usuario}}'"
        subtitulo2="{{$usuario->entePublico->txt_ente_publico}}"
        subtitulo3="{{$usuario->entePublico->municipio->txt_nome_sem_acento}}-{{$usuario->entePublico->municipio->uf->txt_sigla_uf}}"
        :dataatualizacao="'{{date('d/m/Y',strtotime($usuario->updated_at))}}'"
       barracompartilhar="false">

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


    </cabecalho-relatorios> 

    
    <div class="form-group">               
        <div class="titulo"><h3>Dados do Usuário</h3> </div>             
        
        <div class="row">
            <div class="column col-xs-12 col-md-3">
                <label class="control-label label-relatorio">CPF</label>
                <input id="txt_cpf_usuario" type="text" class="form-control input-relatorio" name="txt_cpf_usuario" value="{{empty(old('txt_cpf_usuario')) ? mascaraCnpjCpf($usuario->txt_cpf_usuario) : old('txt_cpf_usuario')}}" disabled>
            </div>
            <div class="column col-xs-12 col-md-6">
                <label class="control-label label-relatorio">Nome</label>
                <input id="txt_nome" type="text" class="form-control input-relatorio" name="txt_nome" value="{{empty(old('txt_nome')) ? $usuario->name : old('txt_nome')}}"  disabled>
            </div>
            
            <div class="column col-xs-12 col-md-3">
                <label class="control-label label-relatorio">Cargo</label>
                <input id="txt_cargo" type="text" class="form-control input-relatorio" name="txt_cargo" value="{{empty(old('txt_cargo')) ? $usuario->txt_cargo : old('txt_cargo')}}"  disabled>
            </div>
                
        </div>

        <div class="row">
            <div class="column col-xs-12 col-md-5">
                <label class="control-label label-relatorio">Email</label>
                <input id="email" type="text" class="form-control input-relatorio" name="email" value="{{empty(old('email')) ? $usuario->email : old('email')}}"  disabled>
            </div>
            <div class="column col-xs-12 col-md-2">
                <label class="control-label label-relatorio">DDD</label>
                <input id="txt_ddd_fixo" type="text" maxlength="2" class="form-control input-relatorio" name="txt_ddd_fixo" value="{{empty(old('txt_ddd_fixo')) ? $usuario->txt_ddd_fixo : old('txt_telefone_fixo')}}"  disabled>
            </div>
            <div class="column col-xs-12 col-md-5">
                <label class="control-label label-relatorio">Telefone</label>
                <input id="txt_telefone_fixo" type="text" maxlength="9" class="form-control input-relatorio" name="txt_telefone_fixo" value="{{empty($usuario->txt_telefone_fixo) ? old('txt_telefone_fixo'): $usuario->txt_telefone_fixo}}"  disabled>
            </div>
           
           
        </div>   
              
        <div class="row">
            <div class="titulo"><h3>Documentos </h3> </div>   
            
            @if(count($dadosArquivoOficio) > 0)
                    <div class="table-responsive-sm">
                        <table class="table table-hover">
                            <thead>
                                <tr class="text-center" >                                    
                                    <th>Tipo</th>
                                    <th>Data de Envio</th>
                                    <th>Situação</th>
                                    <th>Motivo Indeferimento</th>
                                    <th>Sugestão de providência</th>
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
                                        <td> {{$dados->dsc_providencia}} </td>    

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
                    <span class="br-divider my-3"></span>
                    @if($dados->bln_documento_analisado && !$dados->bln_documento_validado)
                        <P>
                            Pedimos a gentileza de revisar e corrigir as informações conforme a sugestão na tabela acima, a fim de que possamos realizar uma nova validação com sucesso.
                        </P>  
                        <form action="{{ url('/ente_publico/oficio/reenviar') }}" role="form" method="POST" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <input type="hidden" id="txt_cpf_usuario" name="txt_cpf_usuario" value="{{Crypt::encrypt($usuario->txt_cpf_usuario)}}">
                                <input type="hidden" id="ente_publico_id" name="ente_publico_id" value="{{Crypt::encrypt($usuario->ente_publico_id)}}">   
                            <upload-arquivo
                                :url="'{{ url('/') }}'">
                            </upload-arquivo>

                            <button type="submit" class="br-button block secondary mr-3" aria-label="Ícone ilustrativo">
                                <i class="fas fa-upload" aria-hidden="true"></i>Enviar Ofício Corrigido
                            </button> 

                        
                        </form> 
                    @endif

            @else
                    <P>
                        Solicitamos que nos envie um ofício oficial, devidamente assinado pela autoridade máxima do ente público (Prefeito/Governador), autorizando a inclusão 
                        e acesso aos dados do nosso município/estado no sistema. Após a validação do ofício o usuária receberá um email para criação de senha para posterior acesso ao sistema.    
                    </P>  
                    <form action="{{ url('/ente_publico/oficio/enviar') }}" role="form" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="hidden" id="txt_cpf_usuario" name="txt_cpf_usuario" value="{{Crypt::encrypt($usuario->txt_cpf_usuario)}}">
                        <input type="hidden" id="ente_publico_id" name="ente_publico_id" value="{{Crypt::encrypt($usuario->ente_publico_id)}}">   
                    <upload-arquivo
                        :url="'{{ url('/') }}'">
                    </upload-arquivo>

                    <button type="submit" class="br-button block secondary mr-3" aria-label="Ícone ilustrativo">
                        <i class="fas fa-upload" aria-hidden="true"></i>Enviar Ofício
                    </button> 

                
                </form> 
            @endif
            
        </div> 
    </div> 
    
    

    @if(count($propostas) > 0)

        <div class="titulo"><h3>Propostas Cadastradas</h3> </div>  
        <div class="table-responsive-sm">
            <table class="table table-hover">
                <thead>
                    <tr class="text-center" >
                   
                    <th>Protocolo</th>
                    <th>Modalidade</th>
                    <th>Objeto</th>
                    <th>Valor</th>
                    <th>Situação</th>
                    <th>Cadastrada por</th>
                    <th>Data</th>
                    <th class="text-center" colspan="2">Ação</th>                    
                    
                    </tr>
                </thead>
                <tbody> 
                    @foreach($propostas as $dados) 
                    @if($dados->modalidade_participacao_id == 1)
                        <tr class="text-center table-primary">   
                    @elseif($dados->modalidade_participacao_id == 2)
                        <tr class="text-center table-success">   
                    @elseif($dados->modalidade_participacao_id == 3)
                        <tr class="text-center table-warning"> 
                    @elseif($dados->modalidade_participacao_id == 5)
                            <tr class="text-center table-info"> 
                    @else
                            <tr class="text-center">   
                    @endif
                        
                        <td>{{$dados->txt_protocolo}}</td>
                        <td>{{$dados->modalidadeParticipacao->txt_modalidade_participacao}}</td>
                        <td>{{$dados->dsc_obj_intervencao}}</td>    
                        <td>{{number_format( ($dados->vlr_intervencao), 2, ',' , '.')}}</td>    
                        <td>{{$dados->situacaoProposta->txt_situacao_proposta}}</td> 
                        <td>{{$dados->usuario->name}}</td>    
                        <td> {{date('d/m/Y',strtotime($dados->created_at))}} </td>    
                        <td class="p-3 text-center">
                           @if($dados->situacao_proposta_id == 1)
                            @if($dados->selecao->dte_fim_cadastro_proposta >= $dataAtual)
                                @if($dados->user_id == $usuario->id)
                                    <botao-acao-icone  
                                        :url="'{{ url("usuario/$dados->user_id/$usuario->id/proposta/excluir")}}'" 
                                        registro="{{$dados->id}}"                               
                                        mensagem="Deseja excluir a proposta?" 
                                        titulo="Atenção!!!"
                                        txtbotaoconfirma="Sim"
                                        txtbotaocancela="Cancelar"
                                        cssbotao="br-button danger circle mr-3 small"                               
                                        cssicone="fas fa-trash" 
                                    
                                    ></botao-acao-icone>                         
                                @endif
                            @endif  
                            @endif  
                           
                            
                        </td>  
                        <td class="p-3 text-center">
                            <button type="button" class="br-button circle secondary small mr-3" aria-label="Ícone ilustrativo" 
                            onclick='window.location.href="{{ url("usuario/$dados->user_id/proposta/$dados->id")}}"'>
                                <i class="fas fa-eye" aria-hidden="true"></i>
                            </button>     
                        </td>
                    </tr>  
                    @endforeach
                </tbody><!-- fechar tbody-->
            </table><!-- fechar table-->
        </div> <!-- table-responsive-sm -->  
     @endif              

    <div class="titulo"><h3>Seleção de propostas em andamento</h3> </div>    
    <p>
        Abaixo estão listadas as modalidades de seleção de propostas disponíveis em nosso sistema. Solicitamos a gentileza de se atentar aos prazos de 
        cadastro das propostas em cada modalidade para garantir a participação nos processos seletivos. Estamos à disposição para esclarecer qualquer 
        dúvida e oferecer suporte durante o processo.
    </p>
    
<h4>Dúvidas sobre preenchimento da proposta:</h4>
                        
<p>- telefone para contato<strong>(61) 3314-6182</strong></p>
<p>- Encaminhar email para <strong>cadastramento.mcid@mdr.gov.br</strong></p>

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
        @foreach($selecao as $dados)
            @if($dados->id == 2 && $dados->dte_fim_cadastro_proposta >= $dataAtual)
                <div class="card-footer">
                    <div class="d-flex" style="padding-top: 10px;">             
                        <form class="form-horizontal" role="form" method="POST" action='{{ url("proposta/cadastrar/selecao/2") }}'>         
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
                    Programa 2220   
                </div>
    
                <div>
                    Moradia Digna
                </div>
                </div>
                <div class="ml-auto">
              
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
                    I. O chefe do Poder Executivo dos Estados, do Distrito Federal e dos Municípios, ou seu representante legal.</br>
                    II. O representante legal dos Consórcios Públicos.</br>
                    d)	Interveniente: órgão ou entidade da Administração Pública direta ou indireta de qualquer esfera de governo, ou entidade privada que participa do instrumento para manifestar consentimento ou assumir obrigações em nome próprio.</br>
                    
                </p>
    
                <p>
                    As competências e responsabilidades dos participantes estão preconizadas nos manuas específicos do Ministério das Cidades e na legislação sobre convênios do Governo Federal, Portaria Interministerial nº 424, de 30 de dezembro de 2016.
                </p>
     
    
            </div>
                @foreach($selecao as $dados)
                
                    @if($dados->id == 6 && $dados->dte_fim_cadastro_proposta >= $dataAtual)
                        <div class="card-footer">
                            <div class="d-flex" style="padding-top: 10px;"> 
                                <form class="form-horizontal" role="form" method="POST" action='{{ url("proposta/cadastrar/selecao/6") }}'>         
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
            @foreach($selecao as $dados)
                @if($dados->id == 1 && $dados->dte_fim_cadastro_proposta >= $dataAtual)
                    <div class="card-footer">
                        <div class="d-flex" style="padding-top: 10px;">                         
                            <form class="form-horizontal" role="form" method="POST" action='{{ url("proposta/cadastrar/selecao/1") }}'>         
                                {{ csrf_field() }}
                                <input type="hidden" id="txt_cpf_usuario" name="txt_cpf_usuario" value="{{Crypt::encrypt($usuario->txt_cpf_usuario)}}">
                                <input type="hidden" id="ente_publico_id" name="ente_publico_id" value="{{Crypt::encrypt($usuario->ente_publico_id)}}">   
                                <input type="hidden" id="moduloSistema" name="moduloSistema" value="0">                                        

                                <button type="submit" class="br-button block secondary mr-3" aria-label="Ícone ilustrativo" >
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
        @foreach($selecao as $dados)
            @if($dados->id == 3 && $dados->dte_fim_cadastro_proposta >= $dataAtual)
                <div class="card-footer">
                    <div class="d-flex" style="padding-top: 10px;">                         
                        <form class="form-horizontal" role="form" method="POST" action='{{ url("proposta/cadastrar/selecao/3") }}'>         
                            {{ csrf_field() }}
                            <input type="hidden" id="txt_cpf_usuario" name="txt_cpf_usuario" value="{{Crypt::encrypt($usuario->txt_cpf_usuario)}}">
                            <input type="hidden" id="ente_publico_id" name="ente_publico_id" value="{{Crypt::encrypt($usuario->ente_publico_id)}}">   
                            <input type="hidden" id="moduloSistema" name="moduloSistema" value="0">                          

                            <button type="submit" class="br-button block secondary mr-3" aria-label="Ícone ilustrativo" >
                                <i class="fas fa-edit" aria-hidden="true"></i>Cadastrar Proposta
                            </button>                          
                        </form>                         
                    </div>
                </div>                  
            @endif
        @endforeach
    </div><!-- br-card -->

    

    

   

</div>
@endsection


