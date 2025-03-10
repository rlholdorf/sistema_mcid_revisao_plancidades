@extends('layouts.app')

@section('scriptscss')
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/custom.css')}}" media="screen" />
<link rel="stylesheet" type="text/css" href="{{ asset('css/relatorio_executivo.css') }}" media="screen">

@endsection

@section('content')


<historico-navegacao :url="'{{ url('/home') }}'" :telanterior01="'Debentures'" :telanterior02="'Consultar projetos debentures'" :telatual="'Dados do Projeto'">

</historico-navegacao>


<div class="main-content pl-sm-3 mt-5 container-fluid" id="main-content">

    <cabecalho-relatorios titulo="Carta Consulta: {{$projetoDebenture->cod_carta_consulta}}" :subtitulo1="'{{$projetoDebenture->txt_modalidade_projeto}}'" :subtitulo2="'{{$projetoDebenture->num_ano_cadastramento}}'" :subtitulo3="'{{$projetoDebenture->txt_normativo_enquadramento}}'" @if($projetoDebenture->updated_at)
        :dataatualizacao="'{{date('d/m/Y',strtotime($projetoDebenture->updated_at))}}'"
        @elseif($projetoDebenture->created_at)
        :dataatualizacao="'{{date('d/m/Y',strtotime($projetoDebenture->created_at))}}'"
        @endif
        barracompartilhar="true"
        >

        <div class="text-center">
            @if($projetoDebenture->situacao_enquadramento_id == 2 || $projetoDebenture->situacao_enquadramento_id == 4)
            <span class="feedback warning" role="alert">
                <i class="fas fa-exclamation-triangle" aria-hidden="true"></i>{{$projetoDebenture->txt_situacao_enquadramento}}
            </span>
            @elseif($projetoDebenture->situacao_enquadramento_id == 3 || $projetoDebenture->situacao_enquadramento_id ==
            6)
            <span class="feedback danger" role="alert">
                <i class="fas fa-times-circle" aria-hidden="true"></i>{{$projetoDebenture->txt_situacao_enquadramento}}
            </span>
            @elseif($projetoDebenture->situacao_enquadramento_id == 5)
            <span class="feedback success" role="alert">
                <i class="fas fa-check-circle" aria-hidden="true"></i>{{$projetoDebenture->txt_situacao_enquadramento}}
            </span>
            @else
            <span class="feedback info" role="alert">
                <i class="fas fa-info-circle" aria-hidden="true"></i>{{$projetoDebenture->txt_situacao_enquadramento}}
            </span>
            @endif
        </div>
    </cabecalho-relatorios>

    <div class="form-group">

        <div class="card">
            <div class="card-header bg-violet-warm-60  text-white">Dados da Emissão</div>
            <div class="card-body">
                <form class="form-horizontal" role="form" method="POST" action='{{ url("apis/debenture/emissao/atualizar/") }}'>
                    {{ csrf_field() }}
                    <input type="hidden" id="emissao_debenture_id" name="emissao_debenture_id" value="{{$emissaoDebentures->emissao_debenture_id}}">

                    <cadastrar-emissao :url="'{{ url("/")}}'" v-bind:dados="{{json_encode($emissaoDebentures)}}">
                    </cadastrar-emissao>
                    <div class="p-3 text-right">
                        <button class="br-button primary mr-3" type="submit" name="Salvar Edição">Salvar
                        </button>

                        <button class="br-button danger mr-3" type="button" onclick="window.location.href='/apis/debentures/{{$projetoDebenture->projeto_debenture_id}}'">Voltar
                        </button>
                    </div>
                </form>
                @if(!empty($emissaoDebentures))
                            <button type="button" class="br-button block secondary mr-3" aria-label="Ícone ilustrativo" data-bs-toggle="modal" data-bs-target="#registrarCondicaoEmissao">
                                <i class="fas fa-plus" aria-hidden="true"></i>Adicionar Condição
                            </button>  
                        @endif
                        @if(count($condicoesEmissao) > 0)
                            <div class="titulo">
                                <h5>Condições da Emissão</h5> 
                            </div>
                            <div class="row">
                                @foreach($condicoesEmissao as $dados) 
                                <div class="column col-xs-12 col-md-6">
                                    <div class="card">
                                        <div class="card-body bg-violet-warm-20">                                    
                                            @if($dados->num_emissao)<p class="card-text"><b>Emissão: </b>{{$dados->num_emissao}}ª</p>@endif
                                            @if($dados->num_serie_emissao)<p class="card-text"><b>Série: </b>{{$dados->num_serie_emissao}}ª  @if($dados->txt_observacao_serie)({{$dados->txt_observacao_serie}})@endif</p>@endif
                                            @if($dados->bln_serie_unica)<p class="card-text"><b>Série Única </b></p>@endif
                                            @if($dados->vlr_emissao)<p class="card-text"><b>Valor Emissão: </b>{{number_format( ($dados->vlr_emissao), 2, ',' , '.')}} @if($dados->dsc_valor)({{$dados->dsc_valor}})@endif</p>@endif
                                            @if($dados->vlr_captado)<p class="card-text"><b>Valor Captado: </b>{{number_format( ($dados->vlr_captado), 2, ',' , '.')}}</p>@endif
                                            @if($dados->vlr_unitario)<p class="card-text"><b>Valor Unitário: </b>{{number_format( ($dados->vlr_unitario), 2, ',' , '.')}}</p>@endif
                                            @if($dados->dte_vencimento)<p class="card-text"><b>Vencimento: </b>{{date('d/m/Y',strtotime($dados->dte_vencimento))}}</p>@endif
                                            @if($dados->txt_taxa)<p class="card-text"><b>Taxa: </b>{{$dados->txt_taxa}}</p>@endif
                                            @if($dados->num_prazo_meses)<p class="card-text"><b>Prazo: </b>{{$dados->num_prazo_meses}} meses</p>@endif
                                            @if($dados->num_duracao_anos)<p class="card-text"><b>Duração: </b>{{$dados->num_duracao_anos}} anos</p>@endif
                                            @if($dados->num_cvm)<p class="card-text"><b>CVM: </b>{{$dados->num_cvm}}</p>@endif
                                            
                                            <div class="row">
                                                <div class="column col-xs-12 col-md-6 text-right">
                                                    <button type="button" class="br-button info mr-3"  onclick='window.location.href="{{ url("apis/debenture/condicao_emissao/$dados->id")}}"'>
                                                        <i class="fas fa-edit" aria-hidden="true"></i>
                                                    </button> 
                                                </div>
                                                <div class="column col-xs-12 col-md-6 text-left">
                                                    <botao-acao-icone  
                                                        :url="'{{ url("apis/debenture/excluir/condicao_emissao/")}}'" 
                                                        registro="{{$dados->id}}"                               
                                                        mensagem="Deseja excluir a condição?" 
                                                        titulo="Atenção!!!"
                                                        txtbotaoconfirma="Sim"
                                                        txtbotaocancela="Cancelar"
                                                        cssbotao="br-button danger mr-3"                               
                                                        cssicone="fas fa-trash"                                                 
                                                    ></botao-acao-icone>
                                                </div>
                                            
                                            </div>
                                            
                                            
                                        </div>
                                        
                                    </div>
                                     
                                </div>
            
                                @endforeach
                                
                            </div><!--row-->
                            @endif
            </div>
        </div>
    </div>

</div>



@if(!empty($emissaoDebentures))
<!-- Modal Condição Emissão -->
<div class="modal fade" id="registrarCondicaoEmissao" tabindex="-1" aria-labelledby="registrarCondicaoEmissaoLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
    <div class="modal-content">
        <div class="modal-header">
        <h1 class="modal-title fs-5" id="registrarCondicaoEmissaoLabel">Condição de Emissão</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form class="form-horizontal" role="form" method="POST" action='{{ url("apis/debenture/condicao_emissao/cadastrar/") }}'>         
            {{ csrf_field() }}
            <input type="hidden" id="emissao_debenture_id" name="emissao_debenture_id" value="{{$emissaoDebentures->emissao_debenture_id}}">
            <div class="modal-body">
                <cadastrar-condicao-emissao 
                    :url="'{{ url("/")}}'" >
                </cadastrar-condicao-emissao>
            </div>
            
        </form>
    </div>
    </div>
</div>
@endif

@endsection