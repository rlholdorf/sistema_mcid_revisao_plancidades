@extends('layouts.app')

@section('content')  


<div class="main-content" id="main-content">    
    
    


@include('modulo_sistema.gerais.carteira_investimento.resumo_tci_tipo_instrumento')

<span class="br-divider dashed my-3"></span>

@include('modulo_sistema.gerais.carteira_investimento.resumo_tci_secretaria')

<span class="br-divider dashed my-3"></span>

@include('modulo_sistema.gerais.carteira_investimento.resumo_tci_situacao_contrato')


        
    @if($configuracao->dte_termino_funcionalidade > $dataAtual)
            <div class="br-card">
                <div class="card-header">
                <div class="d-flex"><span class="br-avatar mt-1" title="Fulano da Silva"><span class="content">
                    <img src='{{ URL::asset("/img/icones/termo.png")}}' alt="Avatar"/></span></span>
                    <div class="ml-3">
                    <div class="text-weight-semi-bold text-up-02">
                        Cadastro de propostas
                    </div>

                    <div>
                        Ministério das Cidades
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
                    

                    <p>
                        O Ministério das Cidades informa que o cadastro de novas propostas permanecerá aberto por tempo indeterminado, à critério desta pasta.
                    </p>
                    <p> 
                        Cabe destacar que a inserção de propostas não constitui garantia de acesso a recursos pelo proponente, que deverá atestar ciência da natureza 
                        discricionária da requisição conforme modelo disponível neste sistema.
                    </p>
                    <p>
                        Ademais, faz-se necessário os seguintes esclarecimentos:</br>
                        1. As propostas cadastradas na outra plataforma original, Microsoft Forms, foram incorporadas pelo sistema atual e permanecem aptas para serem 
                        selecionadas;</br>
                        2.	Após a seleção de sua proposta, o proponente ficará responsável por subir a proposta contempladas na plataforma 
                        Transferegov:  <a href="https://idp.transferegov.sistema.gov.br/idp/" 
                        target="_blank" title="Manifestação de Interesse" class="state-published">https://idp.transferegov.sistema.gov.br/idp/</a></br>
                        3.	O valor a ser cadastrado deve ser o valor selecionado pelo Ministério das Cidades e divulgado no link: Propostas Selecionadas 
                        — Ministério das Cidades (<a href="https://www.gov.br/cidades/pt-br/cadastramento" 
                        target="_blank" title="Manifestação de Interesse" class="state-published">https://www.gov.br/cidades/pt-br/cadastramento</a>); </br>
                        4.	Destaca-se que serão publicadas novas lista, sempre que houver um conjunto de novas propostas selecionadas; e</br>
                        Para eventuais dúvidas quanto à utilização da plataforma Transferegov, o Ministério da Gestão e da Inovação em Serviços – MGI, disponibilizou 
                        em seu sítio eletrônico os manuais para este fim. Que poderá ser acessado no link: Transferegov.br (<a href="https://www.gov.br/transferegov/pt-br/manuais/transferegov" 
                        target="_blank" title="Manifestação de Interesse" class="state-published">https://www.gov.br/transferegov/pt-br/manuais/transferegov</a>).
                        </p>
<!--
                        <p>
                        O <span class="feedback info" role="alert">Programa 2222 - Saneamento Básico, ação orçamentária 20AM - Implementação de Projetos de Coleta, Triagem e Reciclagem de Resíduos Sólidos</span>,  
                        que contempla intervenções que visam contribuir para aumentar os postos de trabalho e a capacidade de beneficiamento dos resíduos passíveis de reciclagem,
                         bem como melhorar as condições de trabalho e a renda dos catadores, terá seu cronograma para cadastramento de propostas 
                        <span class="feedback danger" role="alert">prorrogado até 30/09/2023.</span>
                        </p>

                        <p>
                            O <span class="feedback info" role="alert">Programa 2218  - Gestão de Riscos e Desastres</span>,  
                            possui objetivo de Investir na Compreensão e Redução do Risco, Ampliar a Preparação e Reduzir os Efeitos dos Desastres, 
                            terá seu cronograma para cadastramento de propostas 
                            <span class="feedback danger" role="alert">prorrogado até 13/09/2023.</span>
    
                            </p>
                        -->
                        <h4>Demais dúvidas ou sugestões poderão ser enviadas para:</h4>
                                
                        <p>- Telefone para contato: <strong> (61) 20344908</strong> </p>
                        <p>- Encaminhar email para <strong>cadastramento.mcid@mdr.gov.br</strong></p>
                    
                </div>
                <div class="card-footer">
                <div class="d-flex" style="padding-top: 10px;">                         
                        <button type="button" class="br-button block secondary mr-3" aria-label="Ícone ilustrativo" 
                        onclick='window.location.href="{{ url("/proposta/ente_publico/cadastro")}}"'>
                            <i class="fas fa-edit" aria-hidden="true"></i>Cadastre-se

                            
                        </button>                          
                </div>
                </div>                  
            </div><!-- br-card -->

        <span class="br-divider my-3"></span>
    @endif


    <div class="br-card">
        <div class="card-header">
        <div class="d-flex"><span class="br-avatar mt-1" title="Fulano da Silva"><span class="content">
            <img src='{{ URL::asset("/img/icones/pesquisa.png")}}' alt="Avatar"/></span></span>
            <div class="ml-3">
            <div class="text-weight-semi-bold text-up-02">
                Propostas 2023
            </div>

            <div>
                Consulta
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
            

            <p>
                Este formulário permite que você filtre as propostas cadastradas selecionando as opções de filtro ou todas as propostas caso não selecione nenhum filtro. Nesse caso será disponibilizado uma lista de proposta com base
                nos parâmetros selecionados.
               </p>

                          
                    
                <span class="br-divider my-3"></span>
                <form action="{{ url('/selecao/propostas/cadastradas/pesquisar') }}" role="form" method="POST">
                 {{ csrf_field() }}
                     <div class="row">
                         <filtro-propostas-publicidade
                         url='{{ url("/") }}'
                         >
                             </filtro-propostas-publicidade>      
                             
                     </div>
         
                    
                 </form>
         
         
               
            
                
                  

        </div>
        <div class="card-footer">
        <div class="d-flex" style="padding-top: 10px;">                         
                                       
        </div>
        </div>                  
    </div><!-- br-card -->


    <span class="br-divider my-3"></span>  
    <h4></h4>
   
</div>


<!--
    <div class="br-card">
        <div class="card-header">
        <div class="d-flex"><span class="br-avatar mt-1" title="Fulano da Silva"><span class="content">
            <img src='{{ URL::asset("/img/icones/pesquisa.png")}}' alt="Avatar"/></span></span>
            <div class="ml-3">
            <div class="text-weight-semi-bold text-up-02">
                Propostas Selecionadas 2023
            </div>

            <div>
                Consulta
            </div>
            </div>
            <div class="ml-auto">
     
            </div>
        </div>
        </div>
        <div class="card-content">
            <p>
                O Ministério das Cidades informa que devido ao número elevado de propostas, até o momento foram recebidas mais 12 mil, as propostas selecionadas serão 
                publicadas conforme forem analisadas. Destaca-se que com o lançamento do sistema de cadastro de propostas discricionárias, a divulgação dos resultados
                 passou por um processo evolutivo, sempre visando maior confiabilidade, transparência e isonomia do processo.
            </p>

            <p>
                Este formulário permite que você filtre as propostas selecionadas selecionando as opções de filtro ou todas as propostas caso não selecione nenhum filtro. Nesse caso será disponibilizado uma lista de proposta com base
                nos parâmetros selecionados.
               </p>

                          
                    
                <span class="br-divider my-3"></span>
                <form action="{{ url('/selecao/propostas/selecionadas/pesquisar') }}" role="form" method="POST">
                 {{ csrf_field() }}
                     <div class="row">
                         <filtro-propostas
                         url='{{ url("/") }}'
                         :blnsituacaopropostas='false'
                         :blnprotocolo='false' 
                         :blnsistema='false' 
                         :blnselecao='false' 
                         :blnbtnpesquisar='false' 
                         >
                             </filtro-propostas>      
                             
                     </div>
         
                    
                 </form>
         
         
               
            
                
                  

        </div>
        <div class="card-footer">
        <div class="d-flex" style="padding-top: 10px;">                         
                                       
        </div>
        </div>                  
    </div>
</div>
-->
        <!-- about section -->
    @if($dadosPaineis)
        <span class="br-divider my-3"></span>  
        <h4>PAINÉIS PÚBLICOS</h4>
        <span class="br-divider my-3"></span> 
        <p>
            Logo abaixo você terá à sua disposição os Painéis de Informações do Ministérios das Cidades para consultar. 
            Os Painéis disponibilizam informações de diversos produtos do Ministério entregues à população de forma transparente, intuitiva, flexível e rápida, 
            para apoiar o processo de tomada de decisão.
        </p>
                 
            <div class="card">        
                <div class="card-body">  
                    
    
                    <div class="form-group">
                        <div class="row">
                            @foreach($dadosPaineis as $dados)    
                            <div class="col-xs-12 col-sm-6 col-md-3 ">
                                <div class="br-card">
                                  <div class="card-header">
                                    <div class="d-flex"><span class="br-avatar mt-1" title="Fulano da Silva"><span class="content"><img src="{{ URL::asset("/img/icones/relatorios.png")}}" alt="Avatar"/></span></span>
                                      <div class="ml-3">
                                        <div class="text-weight-semi-bold text-up-02">{{$dados->txt_nome_painel}}</div>
                                        <div>{{$dados->txt_secretaria}}</div>
                                      </div>
                                      <div class="ml-auto">
                                        <button class="br-button circle" type="button" aria-label="Ícone ilustrativo"><i class="fas fa-share-alt" aria-hidden="true"></i>
                                        </button>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="card-content">
                                    @if($dados->bln_manutencao)
                                        <img src='{{ URL::asset("img\paineis\img_manutencao.png")}}'  class="img-thumbnail" >
                                    @else
                                        <img src='{{ URL::asset("$dados->txt_caminho_imagem_painel")}}'  class="img-thumbnail" >
                                    @endif
                                  </div>
                                  <div class="card-footer">
                                    <div class="d-flex">
                                    </br>
                                    
                                        <button type="button" class="br-button block secondary mr-3" aria-label="Ícone ilustrativo" 
                                             @if($dados->bln_manutencao) disabled @else onclick='window.location.href="{{ url("/painel/externo/visualizar/$dados->id")}}"' @endif>
                                                <i class="fas fa-eye" aria-hidden="true" ></i>Visualisar</button>  
                                     
                                     
                                    </div>
                                  </div>
                                </div>
                              </div>
                            @endforeach
                            
                        </div>                    
                    </div>
                </div>            
            </div>   
    
    </div> 
    @endif       
        
@endsection