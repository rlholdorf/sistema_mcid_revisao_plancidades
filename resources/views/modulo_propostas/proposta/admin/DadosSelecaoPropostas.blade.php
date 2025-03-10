@extends('layouts.app')

@section('scriptscss')
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/custom.css')}}"  media="screen" />
<link rel="stylesheet" type="text/css" href="{{ asset('css/relatorio_executivo.css') }}"  media="screen" > 

@endsection


@section('content')




<historico-navegacao
      :url="'{{ url('/home') }}'"      
      :telanterior01="'Seleção de Propostas'"  
      :telanterior02="'Selecionar Propostas'"  
      :telatual="'Dados da Seleção de Proposta'"
      >
     
</historico-navegacao>


<div class="main-content pl-sm-3 mt-5" id="main-content">
  
    <cabecalho-relatorios
        :titulo="'Propostas Selecionadas'"
        @if($selecaoProposta->dte_resultado)
            :subtitulo1="'Data Resultado: {{date('d/m/Y',strtotime($selecaoProposta->dte_resultado))}}'"   
        @else
            :subtitulo1="'Data Criação: {{date('d/m/Y',strtotime($selecaoProposta->created_at))}}'"   
        @endif
        
        :dataatualizacao="'{{date('d/m/Y',strtotime($selecaoProposta->updated_at))}}'"   
       barracompartilhar="true">
       <div class="text-center">
        @if(!$selecaoProposta->bln_selecao_concluida)
                <span class="feedback danger" role="alert">
                    <i class="fas fa-times-circle" aria-hidden="true"></i>Em Andamento
                </span>
            @else
                <span class="feedback success" role="alert">
                    <i class="fas fa-check-circle" aria-hidden="true"></i>Concluída
                    </span>
            @endif
       </div>            
    </cabecalho-relatorios> 

    <p>
        Este formulário permite que você adicione novas propostas ou edite os dados da proposta selecionada. 
    </p>
    <div class="scrimutilexemplo">
        @if(!$selecaoProposta->bln_selecao_concluida)
            <button type="button" class="br-button block secondary mr-3" aria-label="Ícone ilustrativo" data-bs-toggle="modal" data-bs-target="#novaProposta">
                <i class="fas fa-plus" aria-hidden="true"></i>Adicionar Proposta
            </button>   
        @endif
    </div>
    <span class="br-divider  my-3"></span>


    <div class="form-group">               
        
    @if(count($propostas) > 0)

        
        <div class="table-responsive-sm">
            <table class="table table-hover">
                <thead>
                    <tr class="text-center" >
                        <th>#</th>
                        <th>ID</th>
                        <th>UF</th>
                        <th>Município</th>
                        <th>Ente Público</th>                        
                        <th>Ação</th>                        
                        <th>Situação</th>
                        <th>Valor Repasse</th>                        
                        <th>Valor Tarifa</th>                        
                        <th>Valor Transferegov</th>  
                        @if(!$selecaoProposta->bln_selecao_concluida)
                        <th colspan="2" class="text-center">Ações</th>  
                        @endif
                    </tr>
                </thead>
                <tbody> 
                    @foreach($propostas as $dados) 
                   
                        <tr class="text-center">   
                            <td>{{$loop->index+1}}     </td>  
                       <td>{{$dados->proposta_id}}</td>
                       <td>{{$dados->sg_uf}}</td>
                        <td>{{$dados->ds_municipio}}</td>
                        <td>{{$dados->txt_ente_publico}}</td>    
                        <td>{{$dados->acao_programa_id}}</td>                        
                        <td>{{$dados->txt_situacao_proposta}}</td>    
                        <td>{{number_format( ($dados->vlr_repasse), 2, ',' , '.')}}</td>    
                        <td>{{number_format( ($dados->vlr_repasse - $dados->vlr_final_transferegov), 2, ',' , '.')}}</td>    
                        <td>{{number_format( ($dados->vlr_final_transferegov), 2, ',' , '.')}}</td>    
                        @if(!$selecaoProposta->bln_selecao_concluida)
                        <td>
                            <botao-acao-icone  
                                :url="'{{ url("/admin/proposta/selecionada/excluir")}}'" 
                                registro="{{$dados->lista_propostas_selecionadas_id}}"                               
                                mensagem="Deseja excluir a proposta?" 
                                titulo="Atenção!!!"
                                txtbotaoconfirma="Sim"
                                txtbotaocancela="Cancelar"
                                cssbotao="br-button circle danger small mr-3"                               
                                cssicone="fas fa-trash" 
                            
                            ></botao-acao-icone> 
                        </td>
                        <td>
                            <!--
                            <button type="button" class="br-button circle secondary small mr-3" aria-label="Ícone ilustrativo" 
                                onclick='window.location.href="{{ url("admin/propostas/selecionadas/lista/$dados->id")}}"'>
                                    <i class="fas fa-eye" aria-hidden="true"></i>
                                </button>   
                            -->
                        </td>
                        @endif
                    </tr>  
                    @endforeach
                </tbody><!-- fechar tbody-->
            </table><!-- fechar table-->
        </div> <!-- table-responsive-sm -->  
     @endif              

     <div class="row">
        <div class="column col-xs-12 col-md-6">
            <div class="p-3 text-left">
                @if(!$selecaoProposta->bln_selecao_concluida && (count($propostas) > 0))
                <form class="form-horizontal" role="form" method="POST" action='{{ url("admin/proposta/selecao/concluir/") }}'>         
                    {{ csrf_field() }}
                    <input type="hidden" id="selecao_proposta_id" name="selecao_proposta_id" value="{{$selecaoProposta->id}}">
                    <button class="br-button success mr-3" type="submit" name="Concluir Seleção" value="Concluir Seleção" >Concluir Seleção
                    </button>
                </form>
                @endif
            </div>
        </div>
        <div class="column col-xs-12 col-md-6">
            <div class="p-3 text-right">
                <button class="br-button primary mr-3" type="button" name="imprimir" value="Imprimir" onclick="window.print();">Imprimir
                </button>
                <button class="br-button danger mr-3" type="button"  onclick="window.location.href='/admin/selecao/propostas/selecionar'">Fechar
                </button>
            </div> 
        </div>
        

</div>




    <!-- Modal -->
<div class="modal fade" id="novaProposta" tabindex="-1" aria-labelledby="novaPropostaLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="novaPropostaLabel">Adicionar Proposta</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form class="form-horizontal" role="form" method="POST" action='{{ url("admin/proposta/selecionada/adicionar/") }}'>         
            {{ csrf_field() }}
            <input type="hidden" id="selecao_proposta_id" name="selecao_proposta_id" value="{{$selecaoProposta->id}}">
            <div class="modal-body">
                <selecionar-proposta
                url='{{ url("/") }}' 
                :blnsituacaopropostas='true'
                :blnprotocolo='true' 
                :blnsistema='true' 
                :blnselecao='true' 
                :blnbtnpesquisar='true' 
            
                
                v-bind:blnbotao="true"
                >
        
                </selecionar-proposta>
            </div>
            <div class="modal-footer">
                <!--
            <button type="button" class="br-button danger mr-3" data-bs-dismiss="modal">Fechar</button>
            <button type="submit" class="br-button primary mr-3">Salvar</button>
                -->
            </div>
        </form>
      </div>
    </div>
  </div>
@endsection


