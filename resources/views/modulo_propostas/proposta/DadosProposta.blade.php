@extends('layouts.app')

@section('scriptscss')
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/custom.css')}}"  media="screen" />
<link rel="stylesheet" type="text/css" href="{{ asset('css/relatorio_executivo.css') }}"  media="screen" > 

@endsection


@section('content')




<historico-navegacao
      :url="'{{ url('/home') }}'"      
      :telanterior01="'Ente Público'"  
      :telanterior02="'Propostas'"  
      :telatual="'Dados da Proposta'"
      >
     
</historico-navegacao>


<div class="main-content pl-sm-3 mt-5" id="main-content">

    <cabecalho-relatorios
        titulo="{{$proposta->entePublico->txt_ente_publico}}"
        :subtitulo1="'Protocolo: {{$proposta->txt_protocolo}}'"   
        :subtitulo2="'{{$proposta->entePublico->municipio->txt_nome_sem_acento}} - {{$proposta->entePublico->municipio->uf->txt_sigla_uf}}'"   
        :subtitulo3="'{{$proposta->selecao->txt_selecao}} - Seleção nº {{$proposta->selecao->num_selecao}}'"   
        :subtitulo4="'@if($proposta->bln_propostas_recebidas_sistema == true) Cadastrada Via Sistema @else Cadastrada Via Forms @endif'"                
        :subtitulo5="'CNPJ: {{$proposta->ente_publico_id}}'"   

        @if($proposta->usuario):subtitulo3="'Cadastrada por: {{$proposta->usuario->name}}'" @endif  
        @if($proposta->updated_at)
            :dataatualizacao="'{{date('d/m/Y',strtotime($proposta->updated_at))}}'"               
        @elseif($proposta->created_at)
            :dataatualizacao="'{{date('d/m/Y',strtotime($proposta->created_at))}}'"               
        @endif
         barracompartilhar="true"
        >

         <div class="text-center">
            @if($proposta->situacao_proposta_id  == 4 || $proposta->situacao_proposta_id  == 6)
                 <span class="feedback danger" role="alert">
                     <i class="fas fa-times-circle" aria-hidden="true"></i>{{$proposta->situacaoProposta->txt_situacao_proposta}}
                 </span>
             @elseif($proposta->situacao_proposta_id  == 2 || $proposta->situacao_proposta_id  == 3)
                 <span class="feedback success" role="alert">
                     <i class="fas fa-check-circle" aria-hidden="true"></i>{{$proposta->situacaoProposta->txt_situacao_proposta}}
                    </span>
            @elseif($proposta->situacao_proposta_id  == 1 || $proposta->situacao_proposta_id  == 10)
                 <span class="feedback warning" role="alert">
                     <i class="fas fa-exclamation-triangle" aria-hidden="true"></i>{{$proposta->situacaoProposta->txt_situacao_proposta}}
                    </span>
             @else 
                 <span class="feedback info" role="alert">
                     <i class="fas fa-info-circle" aria-hidden="true"></i>{{$proposta->situacaoProposta->txt_situacao_proposta}}
                    </span>
             @endif
            
             
            </div>
    


    </cabecalho-relatorios> 
    <p>
        A inserção de propostas não se constitui garantia de acesso a recursos pelo
        proponente, que deverá atestar ciência da natureza discricionária da requisição
        conforme modelo disponível no sítio eletrônico do Ministério das Cidades 
        (<a href="https://www.gov.br/cidades/pt-br/cadastramento/PS_Emendas_Discricionrias_4A_RP2_MOBILIDADE_rev3.pdf" target="_blank"> 7.1.1 do Manual disciplina rito para acesso aos recursos discricionários</a>).
    </p>
    
    
    <div class="titulo"><h3>Dados da Proposta</h3> </div>  
    <div class="form-group">          

        @if($proposta->modalidade_participacao_id == 1)
            @include('modulo_propostas.proposta.form_dados_proposta_sndum')
        @elseif($proposta->modalidade_participacao_id == 2 || $proposta->modalidade_participacao_id == 4 )
            @include('modulo_propostas.proposta.form_dados_proposta_snsa')
        @else
            @include('modulo_propostas.proposta.form_dados_proposta_semob')
        @endif
        
<br/>

        @if(!empty($propostaCancelada))
        <div class="titulo"><h3>Dados da Proposta Antiga</h3> </div>  
       
            <div class="row">
                <div class="col col-xs-12 col-sm-3 br-input input-highlight">        
                    <p><strong>1. Id Antigo</strong></p>
                    <input id="input-highlight-labeless" type="text" placeholder="Placeholder" value="{{$propostaCancelada->proposta_id}}" />
                    <span class="br-divider my-3">
                </div>    
                
           
                <div class="col col-xs-12 col-sm-9 br-input input-highlight">        
                    <p><strong>2. Programa</strong></p>
                    <input id="input-highlight-labeless" type="text" placeholder="Placeholder" value="{{$propostaCancelada->txt_selecao}}" />
                    <span class="br-divider my-3">
                </div>    
                
            </div><!-- div row -->
            <div class="row">
                <div class="col col-xs-12 col-sm-12 br-input input-highlight">        
                    <p><strong>3. Itens financiáveis das ações orçamentárias do programa previstos no projeto básico:</strong></p>
                    
                </div>    
                
            </div><!-- div row -->
            <div class="br-list" role="list">
                @foreach($itensFinanciveisCancelados as $dados)
                    <div class="br-item" role="listitem">
                        <div class="row align-items-center">
                           
                            <div class="col">
                                <li>{{$dados->acao}} - {{$dados->txt_acao_programa}} / {{$dados->txt_item_financiavel}}  </li>
                            </div>
                        
                        </div>
                    </div>                
                @endforeach    
              </div>
        @endif
        <span class="br-divider my-3"></span>
    @if(!empty($propostaSelecionada))
        <div class="titulo"><h3>Dados da Seleção</h3> </div>  
        <div class="row">
            <div class="col col-xs-12 col-sm-6 br-input input-highlight">        
                <p><strong>1. Ação</strong></p>
                <input id="input-highlight-labeless" type="text" placeholder="Placeholder" value="{{$propostaSelecionada->acao_programa_id}}- {{$propostaSelecionada->txt_acao_programa}}"/>
                 
            </div>   
               
            <div class="col col-xs-12 col-sm-3 br-input input-highlight">        
                <p><strong>2. Valor Repasse</strong></p>
                <input id="input-highlight-labeless" type="text" placeholder="Placeholder" value="{{number_format( ($propostaSelecionada->vlr_repasse), 2, ',' , '.')}}" />
            </div>    
            <div class="col col-xs-12 col-sm-3 br-input input-highlight">        
                <p><strong>2. Valor Transferegov</strong></p>
                <input id="input-highlight-labeless" type="text" placeholder="Placeholder" value="{{number_format( ($propostaSelecionada->vlr_final_transferegov), 2, ',' , '.')}}" />
            </div>    
        </div>
        <span class="br-divider  my-3"></span>
        @can('eGestao')
            @if($totalValorTransferegov < $propostaSelecionada->vlr_final_transferegov)
                <div class="scrimutilexemplo">
                    <button class="br-button block secondary mr-3" type="button"><i class="fas fa-plus" aria-hidden="true"></i>Cadastrar Proposta Transferegov
                    </button>
                </div>
            @endif
        @endcan

        @if($totalValorTransferegov > 0)
        <div class="table-responsive-sm">
            <table class="table table-hover">
                <thead>
                    <tr class="text-center" >                    
                        <th>#</th>
                        <th>Num Proposta</th>
                        <th>Valor Transferegov</th>
                        @can('eMaster')
                            <th class="text-center">Excluir</th>
                        @endcan
                    </tr>
                </thead>
                <tbody> 
                    @foreach($dadosTransfereGov as $dados) 
                        <tr class="text-center">                           
                            <td>{{$dados->id}}</td>
                            <td>{{$dados->num_proposta_transferegov}}</td>
                            <td>{{number_format( ($dados->vlr_proposta_transferegov), 2, ',' , '.')}}</td>     
                            @can('eGestao')
                                <td class="text-center">
                                    <botao-acao-icone  
                                        :url="'{{ url("proposta/transferegov/excluir")}}'" 
                                        registro="{{$dados->id}}"                               
                                        mensagem="Deseja excluir a proposta?" 
                                        titulo="Atenção!!!"
                                        txtbotaoconfirma="Sim"
                                        txtbotaocancela="Cancelar"
                                        cssbotao="br-button danger circle mr-3 small"                               
                                        cssicone="fas fa-trash" 
                                    
                                    ></botao-acao-icone>                                                           
                                </td>                       
                                @endcan
                        </tr>                              
                    @endforeach
                </tbody><!-- fechar tbody-->
            </table><!-- fechar table-->
        </div> <!-- table-responsive-sm --> 

        @endif
            <br/>
    @endif
        <span class="br-divider lg my-3"></span>
        <div class="row">
            <div class="col col-xs-12 col-sm-6">  
                <div class="p-3 text-left">
                    @if(($usuario->tipo_usuario_id == 1 || $usuario->tipo_usuario_id == 2 || $usuario->tipo_usuario_id == 6) && $proposta->situacao_proposta_id != 9 && $proposta->situacao_proposta_id != 5)
                        <button class="br-button danger mr-3" type="button" name="cancelar" onclick="window.location.href='/admin/proposta/cancelar/{{$proposta->id}}'">Corrigir Proposta
                        </button>
                    @endif
                </div>
            </div>
            <div class="col col-xs-12 col-sm-6">  
                <div class="p-3 text-right">
                    
                    <button class="br-button primary mr-3" type="button" name="imprimir" value="Imprimir" onclick="window.print();">Imprimir
                    </button>
                    <button class="br-button danger mr-3" type="button" onclick="javascript:window.history.go(-1)">Voltar
                    </button>
                  </div> 
            </div>
        </div>

</div>
<!-- modal adicionar proposta transferegov -->

<div class="br-scrim-util foco  " id="scrimutilexample" data-scrim="true">
  <div class="br-modal large">
    <form class="form-horizontal" role="form" method="POST" action='{{ url("proposta/transferegov/salvar") }}'>   
        {{ csrf_field() }}    
        <input type="hidden" id="txt_cpf_usuario" name="proposta_id" value="{{$proposta->id}}">  
        <div class="br-modal-header">
            Adicionar Proposta Transferegov
            <span class="br-divider my-3"></span>
        </div>
        <div class="br-modal-body">
           
        <p>Preencha os campos com os dados da proposta cadastrada no transferegov.</p>
        
           
            <div class="form-group">
                
                <div class="row">
                    <div class="col col-xs-12 col-sm-6 br-input input-highlight">        
                        <p><strong>1. Número da Proposta</strong></p>
                        <input name="num_proposta_transferegov" type="text"  required/>
                        
                    </div>   
                    
                    <div class="col col-xs-12 col-sm-6 br-input input-highlight">        
                        <p><strong>2. Valor</strong></p>
                        <input name="vlr_proposta_transferegov" type="number"  step=".01" required/>
                    </div>  
                </div>
            </div>
        </br>
        </div>
        <div class="br-modal-footer justify-content-center">
        
        <button class="br-button primary mt-3 mt-sm-0 ml-sm-3" type="submit">Adicionar
        </button>
        <button class="br-button danger" type="button" id="scrimfechar" data-dismiss="scrimexample">Cancelar
        </button>
        </div>
    </form>
  </div>
</div>

@endsection


