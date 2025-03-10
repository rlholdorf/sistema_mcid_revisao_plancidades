@extends('layouts.app')

@section('scriptscss')
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/custom.css')}}"  media="screen" />
<link rel="stylesheet" type="text/css" href="{{ asset('css/relatorio_executivo.css') }}"  media="screen" > 

@endsection


@section('content')




<historico-navegacao
      :url="'{{ url('/home') }}'"      
      :telanterior01="'Transferências Especiais'"        
      :telanterior02="'Consultar Contratos'"        
      :telanterior03="'Lista de Planos de Ações'"        
      :telatual="'Plano de Ação'"
      >
     
</historico-navegacao>


<div class="main-content pl-sm-3 mt-5" id="main-content">

    <cabecalho-relatorios
        :titulo="'{{$plano->cod_plano_acao}}'"        
        :subtitulo1="'{{$plano->situacaoAnalise->txt_situacao_analise}}'"
        :subtitulo2="'Situação do PT: {{$plano->txt_situacao_plano_trabalho}}'"
        :linkcompartilhar="'{{ url("/") }}'"                       
         barracompartilhar="false">
    </cabecalho-relatorios> 

    <div class="form-group">
        <div class="row">
            <div class="col col-xs-12 col-sm-2 br-input">
                <label for="dte_analise" class="control-label">Data Análise</label>
                <input id="dte_analise" 
                    type="date" 
                    class="form-control" 
                    name="dte_analise" 
                    value="{{$plano->dte_analise}}" 
                   >
            </div>
            <div class="col col-xs-12 col-sm-8 br-input">
                
            </div>
            <div class="col col-xs-12 col-sm-2 br-input">
                <label for="dte_envio" class="control-label">Data Envio</label>
                <input id="dte_envio" 
                    type="date" 
                    class="form-control" 
                    name="dte_envio" 
                    value="{{$plano->dte_envio}}" 
                    >
            </div>
        </div>
        <div class="row">
            <div class="col col-xs-12 col-sm-2 br-input">
                <label for="txt_uf_beneficiario" class="control-label">UF</label>
                <input id="txt_uf_beneficiario" 
                    type="text" 
                    class="form-control" 
                    name="txt_uf_beneficiario" 
                    value="{{$plano->txt_uf_beneficiario}}" 
                   >
            </div>
            <div class="col col-xs-12 col-sm-2 br-input">
                <label for="num_ano_acao" class="control-label">Ano</label>
                <input id="num_ano_acao" 
                    type="text" 
                    class="form-control" 
                    name="num_ano_acao" 
                    value="{{$plano->num_ano_acao}}" 
                    >
            </div>
            <div class="col col-xs-12 col-sm-3 br-input">
                <label for="dte_inicio_execucao_pt" class="control-label">Início</label>
                <input id="dte_inicio_execucao_pt" 
                    type="date" 
                    class="form-control" 
                    name="dte_inicio_execucao_pt" 
                    value="{{$plano->dte_inicio_execucao_pt}}" 
                    >
            </div>
            <div class="col col-xs-12 col-sm-3 br-input">
                <label for="dte_fim_execucao_pt" class="control-label">Término</label>
                <input id="dte_fim_execucao_pt" 
                    type="date" 
                    class="form-control" 
                    name="dte_fim_execucao_pt" 
                    value="{{$plano->dte_fim_execucao_pt}}" 
                    >
            </div>
            <div class="col col-xs-12 col-sm-2 br-input">
                <label for="num_prazo_execucao" class="control-label">Prazo Execução</label>
                <input id="num_prazo_execucao" 
                    type="text" 
                    class="form-control" 
                    name="num_prazo_execucao" 
                    value="{{$plano->num_prazo_execucao}}" 
                    >
            </div>
           
        </div>
    </div>
    <div class="titulo">
        <h5>METAS</h5>
    </div>
    <p>Nº Finalidades: {{$plano->qtd_total_finalidade}}</p>
    <p>Nº Metas: {{$plano->qtd_total_meta}}</p>
    <div class="form-group">                      
        <div class="table-responsive">
            <table class="table table-hover">
                <thead  class="text-center">
                    <tr class="text-center ">                        
                        <th class="text-center">Executor</th>
                        <th>Finalidade</th>
                        <th>Meta</th>
                        <th class="text-center">Ministérios</th>
                        <th class="text-center">Objeto</th>
                        <th class="text-center">Secretarias</th>                        
                    </tr>
                </thead>
                <tbody>
                    @foreach($metas as $meta)
                        <tr  class="conteudoTabela" >
                            <td class="text-center">{{$meta->txt_executor}}</td>
                            <td>{{$meta->txt_finalidade}}</td>
                            <td>{{$meta->txt_meta}} (Unid. Med. {{$meta->txt_unidade_meta}})</td>
                            <td class="text-center">{{$meta->txt_ministerio}}</td>
                            <td class="text-center">{{$meta->dsc_objeto}}</td>
                            <td class="text-center">{{$meta->txt_secretaria_objeto}} {{$meta->txt_secretaria_meta}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table> 
        </div>     
    </div>

    <div class="titulo">
        <h5>ANÁLISE DO PLANO DE AÇÃO</h5>
    </div>
    
    @if(!empty($analise))
   
    <div class="form-group">
        <div class="row">
            <div class="col col-xs-12 col-sm-3 br-input">
                <label for="dte_analise" class="control-label">Data Análise</label>
                <input id="dte_analise" 
                    type="date" 
                    class="form-control" 
                    name="dte_analise" 
                    value="{{$analise->dte_analise}}" >
            </div>
            <div class="col col-xs-12 col-sm-3 br-input">
                <label for="dte_envio" class="control-label">Data Envio</label>
                <input id="dte_envio" 
                    type="date" 
                    class="form-control" 
                    name="dte_envio" 
                    value="{{$analise->dte_envio}}" >
            </div>
            <div class="col col-xs-12 col-sm-3 br-input">
                <label for="txt_resultado_analise" class="control-label">Resultado</label>
                <input id="txt_resultado_analise" 
                    type="text" 
                    class="form-control" 
                    name="txt_resultado_analise" 
                    value="{{$analise->txt_resultado_analise}}" >
            </div>
            <div class="col col-xs-12 col-sm-3 br-input">
                <label for="txt_secretaria" class="control-label">Secretaria</label>
                <input id="txt_secretaria" 
                    type="text" 
                    class="form-control" 
                    name="txt_secretaria" 
                    value="{{$analise->txt_secretaria}}" >
            </div>           
        </div>
        <div class="row">
            <div class="col col-xs-12 col-sm-6 br-input">
                <label for="txt_cpf_responsavel_analise" class="control-label">CPF Responsável</label>
                <input id="txt_cpf_responsavel_analise" 
                    type="text" 
                    class="form-control" 
                    name="txt_cpf_responsavel_analise" 
                    value="{{$analise->txt_cpf_responsavel_analise}}" >
            </div>
            <div class="col col-xs-12 col-sm-6 br-input">
                <label for="txt_nome_responsavel_analise" class="control-label">Responsável</label>
                <input id="txt_nome_responsavel_analise" 
                    type="text" 
                    class="form-control" 
                    name="txt_nome_responsavel_analise" 
                    value="{{$analise->txt_nome_responsavel_analise}}" >
            </div>          
        </div>
        <div class="form-group br-textarea">
            <label for="dsc_parecer" class="control-label">Parecer</label>
            <textarea class="form-control" 
               id="dsc_parecer" 
               name="dsc_parecer"                 
               rows="10" required>{{$analise->dsc_parecer}}</textarea>
       </div>
    </div>
    @else
    <cadastro-analise-plano>
        
    </cadastro-analise-plano>

    @endif
        
        <div class="p-3 text-right">      
            <button class="br-button primary mr-3" type="submit" name="Pesquisar">Pesquisar 
            </button>
        
  
        <button class="br-button danger mr-3" type="button" onclick="javascript:window.history.go(-1)">Voltar
        </button>
      </div> 
     
</div>
@endsection


