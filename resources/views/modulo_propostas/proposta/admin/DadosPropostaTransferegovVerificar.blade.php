@extends('layouts.app')

@section('scriptscss')
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/custom.css')}}"  media="screen" />
<link rel="stylesheet" type="text/css" href="{{ asset('css/relatorio_executivo.css') }}"  media="screen" > 

@endsection


@section('content')




<historico-navegacao
      :url="'{{ url('/home') }}'"      
      :telanterior01="'Propostas'"  
      :telanterior02="'Consultar Propostas Transferegov'"  
      :telatual="'Propostas Transferegov'"
      >

</historico-navegacao>


<div class="main-content pl-sm-3 mt-5" id="main-content">
  
    <cabecalho-relatorios
        :titulo="'Proposta n. {{$propostaTransferegov->num_proposta_transferegov}}'"
        subtitulo1="{{$entePublico->txt_ente_publico}}"        
        :subtitulo2="'{{$propostaTransferegov->identif_proponente_transferegov}}'" 
        subtitulo3="{{$propostaTransferegov->municipio_transferegov}}-{{$propostaTransferegov->uf_transferegov}}" 

       barracompartilhar="false">

    </cabecalho-relatorios> 

    
    <div class="form-group">   
        <div class="titulo"><h3>Proposta Transferegov</h3> </div>  
        <div class="row">
            <div class="col col-xs-12 col-sm-3 br-input input-highlight">        
                <p><strong>1. Número Proposta</strong></p>
                <input id="input-highlight-labeless" type="text" placeholder="Placeholder" value="{{$propostaTransferegov->num_proposta_transferegov}}" />
                 <span class="br-divider my-3">
            </div>
            <div class="col col-xs-12 col-sm-3 br-input input-highlight">        
                <p><strong>2. Programa</strong></p>
                <input id="input-highlight-labeless" type="text" placeholder="Placeholder" value="{{$propostaTransferegov->programa_transferegov}}" />
                 <span class="br-divider my-3">
            </div>
            <div class="col col-xs-12 col-sm-3 br-input input-highlight">        
                <p><strong>3. Ação Orçamentária</strong></p>
                <input id="input-highlight-labeless" type="text" placeholder="Placeholder" value="{{$propostaTransferegov->acao_orcamentaria}}" />
                 <span class="br-divider my-3">
            </div>
            <div class="col col-xs-12 col-sm-3 br-input input-highlight">        
                <p><strong>4. RP</strong></p>
                <input id="input-highlight-labeless" type="text" placeholder="Placeholder" value="{{$propostaTransferegov->rp_transferegov}}" />
                 <span class="br-divider my-3">
            </div>
        </div>
        <div class="row">
            <div class="col col-xs-12 col-sm-12 br-textarea input-highligh">        
                <p><strong>5. Objeto da Intervenção</strong></p>
                <textarea  id="input-highlight-labeless" placeholder="Placeholder" >{{$propostaTransferegov->objeto_proposta_transferegov}}</textarea>
                 <span class="br-divider my-3">
            </div>    
           
        </div><!-- div row -->
        <div class="row">
            <div class="col col-xs-12 col-sm-6 br-input input-highlight">        
                <p><strong>6. Valor do Repasse</strong></p>
                <input id="input-highlight-labeless" type="text" placeholder="Placeholder" value="{{number_format( ($propostaTransferegov->vlr_repasse_transferegov), 2, ',' , '.')}}" />
                 <span class="br-divider my-3">
            </div>  
            <div class="col col-xs-12 col-sm-6 br-input input-highlight">        
                <p><strong>7. Valor da Contrapartida</strong></p>
                <input id="input-highlight-labeless" type="text" placeholder="Placeholder" value="{{number_format( ($propostaTransferegov->vlr_contrapartida_transferegov), 2, ',' , '.')}}" />
                 <span class="br-divider my-3">
            </div>    
           
        </div><!-- div row -->            
        
    @if(count($propostas) > 0)

        <div class="titulo"><h3>Propostas Cadastradas</h3> </div>  
        <div class="table-responsive-sm">
            <table class="table table-hover">
                <thead>
                    <tr class="text-center" >
                   
                        <th>ID</th>
                        <th>Proposta Transferegov</th>
                        <th>UF</th>
                        <th>Município</th>
                        <th>CNPJ</th>                        
                        <th>Ente Público</th>                        
                        <th>Açöes</th>                       
                        <th>Modalidade</th>                        
                        
                        <th>Situação</th>
                        <th>Valor Cadastrado</th>
                        <th>Valor Selecionado</th>                                                
                       <!-- <th>Data</th> -->
                        <th>Via Sistema</th>
                        <th class="text-center">Ação</th>                    
                    
                    </tr>
                </thead>
                <tbody> 
                    @foreach($propostas as $dados) 
                            <?php
                            
                            $transferegov = json_decode($dados->propostas_transferegov);
                            $propostas_transferegov = '';
                            foreach($transferegov as $key => $value) {
                                if(!empty($value)){
                                    if($key == 0)
                                        $propostas_transferegov = $value;
                                    else
                                        $propostas_transferegov = $propostas_transferegov . ' - ' . $value;
                                }
                            }
                        
                            $acoesProposta = json_decode($dados->lista_acoes);
                            $acoes_propostas = '';
                            foreach($acoesProposta as $key => $value) {
                                if($key == 0)
                                    $acoes_propostas = $value;
                                else
                                    $acoes_propostas = $acoes_propostas . ' - ' . $value;
                            }

                            
                        // agora a nosa $arr possui os valores (3, 6, 9, 12)
                        ?>
                        @if($dados->situacao_proposta_id == 5)
                            <tr class="text-center table-info">   
                        @elseif($dados->situacao_proposta_id == 8)
                            <tr class="text-center table-danger">   
                        @else
                                <tr class="text-center">   
                        @endif    
                       <td>{{$dados->proposta_id}}</td>
                       <td>{{$propostas_transferegov}}</td>
                       <td>{{$dados->sg_uf}}</td>
                        <td>{{$dados->ds_municipio}}</td>
                        <td>{{$dados->ente_publico_id}}</td>    
                        <td>{{$dados->txt_ente_publico}}</td>   
                        <td>{{$acoes_propostas}}</td> 
                        <td>{{$dados->txt_modalidade_participacao}}</td>                        
                        <td>{{$dados->txt_situacao_proposta}}</td>    
                        <td>{{number_format( ($dados->vlr_intervencao), 2, ',' , '.')}}</td>    
                        <td>{{number_format( ($dados->vlr_repasse), 2, ',' , '.')}}</td>    
                    <!--    <td>@if($dados->created_at) {{date('d/m/Y',strtotime($dados->created_at))}} @endif</td>   --> 
                        <td>@if($dados->bln_propostas_recebidas_sistema) Sim @else Não @endif</td>                            
                        
                        <td class="text-center">
                            @can('eGestao')
                                @if($dados->situacao_proposta_id != 5 && $dados->situacao_proposta_id != 8 ) 
                                                            
                                    <form class="form-horizontal" role="form" method="POST" action='{{ url("admin/proposta/transferegov/adicionar/") }}'>         
                                        {{ csrf_field() }}
                                        
                                            @if($selecaoProposta)
                                            <input type="hidden" id="selecao_proposta_id" name="selecao_proposta_id" value="{{$selecaoPropostaID}}">
                                                <button type="button" title="Selecionar Propostas" class="br-button circle success small mr-3" aria-label="Ícone ilustrativo" data-bs-toggle="modal" data-bs-target="#novaProposta{{$dados->proposta_id}}">
                                                    <i class="fas fa-plus" aria-hidden="true"></i>
                                                </button> 
                                            @endif     
                                @endif
                            @endcan    
                                <button type="button" title="Visualizar Propostas" class="br-button circle secondary small mr-3" aria-label="Ícone ilustrativo" 
                                onclick='window.location.href="{{ url("admin/selecao/proposta/$dados->proposta_id")}}"'>
                                    <i class="fas fa-eye" aria-hidden="true"></i>
                                </button>
                            @include('modulo_propostas.proposta.admin.form_modal_selecionar_proposta')
                        </td> 
                        
                        </form>
                    </tr>  
                    @endforeach
                </tbody><!-- fechar tbody-->
            </table><!-- fechar table-->
        </div> <!-- table-responsive-sm -->  
     @endif              

     <div class="p-3 text-right">
        
        <button class="br-button primary mr-3" type="button" name="imprimir" value="Imprimir" onclick="window.print();">Imprimir
        </button>
        <button class="br-button danger mr-3" type="button" onclick="javascript:window.history.go(-1)">Voltar
        </button>
      </div> 
   

    
@endsection


