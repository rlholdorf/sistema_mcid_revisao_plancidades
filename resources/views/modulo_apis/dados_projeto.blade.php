@extends('layouts.app')

@section('scriptscss')
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/custom.css')}}"  media="screen" />
<link rel="stylesheet" type="text/css" href="{{ asset('css/relatorio_executivo.css') }}"  media="screen" > 

@endsection

@section('content')


<historico-navegacao :url="'{{ url('/home') }}'" 
    :telanterior01="'Debentures'"
    :telanterior02="'Consultar projetos debentures'"
    :telatual="'Dados do Projeto'">

</historico-navegacao>


<div class="main-content pl-sm-1 mt-1 container-fluid" id="main-content">

    <cabecalho-relatorios
        titulo="Carta Consulta: {{$projetoDebenture->cod_carta_consulta}}"          
        :subtitulo1="'{{$projetoDebenture->txt_modalidade_projeto}}'"   
        :subtitulo2="'{{$projetoDebenture->num_ano_cadastramento}}'"   
        :subtitulo3="'{{$projetoDebenture->txt_normativo_enquadramento}}'"   
        
        @if($projetoDebenture->updated_at)
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
            @elseif($projetoDebenture->situacao_enquadramento_id == 3 || $projetoDebenture->situacao_enquadramento_id == 6)
                <span class="feedback danger" role="alert">
                    <i class="fas fa-times-circle" aria-hidden="true"></i>{{$projetoDebenture->txt_situacao_enquadramento}}
                </span>
            @elseif($projetoDebenture->situacao_enquadramento_id == 5)
                <span class="feedback success" role="alert">
                    <i class="fas fa-check-circle" aria-hidden="true"></i>{{$projetoDebenture->txt_situacao_enquadramento}}
                </span>
            @elseif($projetoDebenture->situacao_enquadramento_id == 1)
                <span class="feedback info" role="alert">
                    <i class="fas fa-info-circle" aria-hidden="true"></i>{{$projetoDebenture->txt_situacao_enquadramento}}
                   </span>
            @endif
        </div>
    </cabecalho-relatorios> 
        <div class="form-group">            
            <div class="card">
                <div class="card-header bg-green-cool-vivid-60 text-white">Dados do projeto</div>
                <div class="card-body">
                    <div class="form-group">
                        <div class="row">                        
                            <div class="col-md-4 text-center">
                                <label for="dte_cadastramento" class="control-label">Data de Cadastramento</label>
                                <input id="dte_cadastramento" type="text" 
                                    class="form-control text-center" name="dte_cadastramento" value="{{date('d/m/Y',strtotime($projetoDebenture->dte_cadastramento))}}" disabled>
                            </div>
                            <div class="col-md-4 text-center">
                                <label for="txt_portaria_aprovacao" class="control-label">Portaria</label>
                                <input id="txt_portaria_aprovacao" type="text" 
                                    class="form-control text-center" name="txt_portaria_aprovacao" value="{{$projetoDebenture->txt_portaria_aprovacao}}" disabled>
                            </div>
                            <div class="col-md-4 text-center">
                                <label for="dte_validade_pgfn" class="control-label">Validade PGFN</label>
                                <input id="dte_validade_pgfn" type="text" 
                                    class="form-control text-center" name="dte_validade_pgfn" value="@if($projetoDebenture->dte_validade_pgfn) {{date('d/m/Y',strtotime($projetoDebenture->dte_validade_pgfn))}}@endif"  disabled>
                            </div>
                        </div><!--row-->
                        <div class="br-textarea ">
                            <label for="dsc_projeto_investimento" class="control-label">Projeto de Investimento</label>
                            <textarea class="form-control" 
                            id="dsc_projeto_investimento" 
                            name="dsc_projeto_investimento"  
                            disabled>{{$projetoDebenture->dsc_projeto_investimento}}</textarea>
                        </div><!--text-area-->
                   
                        <div class="row">
                            <div class="col col-xs-12 col-sm-4 br-input">
                                <label for="vlr_investimento_projeto" class="control-label">Investimento Projeto</label>
                                <input id="vlr_investimento_projeto" type="text" 
                                    class="form-control" name="vlr_investimento_projeto" value="{{number_format( ($projetoDebenture->vlr_investimento_projeto), 2, ',' , '.')}}" disabled>
                            </div>
                            <div class="col col-xs-12 col-sm-4 br-input">
                                <label for="vlr_debentures" class="control-label">Debentures</label>
                                <input id="vlr_debentures" type="text" 
                                    class="form-control" name="vlr_debentures" value="{{number_format( ($projetoDebenture->vlr_debentures), 2, ',' , '.')}}" disabled>
                            </div>
                            <div class="col col-xs-12 col-sm-4 br-input">
                                <label for="vlr_fdic" class="control-label">FDIC</label>
                                <input id="vlr_fdic" type="text" 
                                    class="form-control" name="vlr_fdic" value="{{number_format( ($projetoDebenture->vlr_fdic), 2, ',' , '.')}}" disabled>
                            </div>
                        </div><!--row-->
                        <div class="row">
                            <div class="col col-xs-12 col-sm-4 br-input">
                                <label for="vlr_cri" class="control-label">CRI</label>
                                <input id="vlr_cri" type="text" 
                                    class="form-control" name="vlr_cri" value="{{number_format( ($projetoDebenture->vlr_cri), 2, ',' , '.')}}" disabled>
                            </div>
                            <div class="col col-xs-12 col-sm-4 br-input">
                                <label for="vlr_recursos_proprios" class="control-label">Recursos Próprios</label>
                                <input id="vlr_recursos_proprios" type="text" 
                                    class="form-control" name="vlr_recursos_proprios" value="{{number_format( ($projetoDebenture->vlr_recursos_proprios), 2, ',' , '.')}}" disabled>
                            </div>
                            <div class="col col-xs-12 col-sm-4 br-input">
                                <label for="vlr_outras_fontes" class="control-label">Outras Fontes</label>
                                <input id="vlr_outras_fontes" type="text" 
                                    class="form-control" name="vlr_outras_fontes" value="{{number_format( ($projetoDebenture->vlr_outras_fontes), 2, ',' , '.')}}" disabled>
                            </div>
                        </div><!--row-->
                   
                   
                    
                        
                        <div class="row">                            
                            <div class="column col-xs-12 col-md-6">
                                <div class="titulo">
                                    <h5>Grupo Controlador</h5> 
                                </div>
                                @foreach($grupoControlador as $dados)
                                    <div class="row">
                                        <div class="column col-xs-12 col-md-8">
                                            {{$dados->concessionaria->txt_nome_concessionaria}} ({{$dados->concessionaria->tipoConcessionaria->txt_tipo_concessionaria}})
                                        </div>
                                        <div class="column col-xs-12 col-md-4 text-center">
                                            @if($dados->bln_original && $dados->bln_atual) 
                                                <span class="badge badge-pill badge-success">Atual / Original</span>
                                            @elseif($dados->bln_original && !$dados->bln_atual) 
                                                <span class="badge badge-pill badge-primary">Original</span> 
                                            @else
                                                <span class="badge badge-pill badge-success">Atual</span>
                                            @endif
                                        </div>
                                    
                                    </div>
                                @endforeach
                            </div>
                            <div class="column col-xs-12 col-md-6">
                                <div class="titulo">
                                    <h5>Titular Projeto</h5> 
                                </div>
                                @foreach($titularProjeto as $dados)
                                    <div class="row">
                                        <div class="column col-xs-12 col-md-8">
                                            {{$dados->concessionaria->txt_nome_concessionaria}} ({{$dados->concessionaria->tipoConcessionaria->txt_tipo_concessionaria}})
                                        </div>
                                        <div class="column col-xs-12 col-md-4 text-center">
                                            @if($dados->bln_original && $dados->bln_atual) 
                                                <span class="badge badge-pill badge-success">Atual / Original</span>
                                            @elseif($dados->bln_original && !$dados->bln_atual) 
                                                <span class="badge badge-pill badge-primary">Original</span> 
                                            @else
                                                <span class="badge badge-pill badge-success">Atual</span>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div><!--row-->
                    
                        <div class="p-3 text-right">
                            <button type="button" class="br-button bg-green-cool-vivid-60 text-white mr-3" aria-label="Ícone ilustrativo"  onclick='window.location.href="{{ url("apis/dados_projeto/debenture/$projetoDebenture->projeto_debenture_id")}}"'>
                                <i class="fas fa-edit" aria-hidden="true"></i>Editar Dados do Projeto
                            </button> 
                        </div>
                    </div><!--form-roup-->
                </div><!--card-body-->
            </div><!--card-->
        </div><!--form-roup-->
<!--------------------------MUNICÍPIOS BENEFICIADOS--------------------->

<div class="form-group">            
    <div class="card">
        <div class="card-header bg-green-cool-vivid-60 text-white">Municípios beneficiados</div>
        <div class="card-body">
            <div class="table-responsive-sm">
                <table class="table table-hover">
                    <thead>                                    
                    <tr class="text-center">   
                            <th>#</th>
                            <th>Município</th>
                            <th>UF</th>
                            <th>Região</th>
                            <th>RM / RIDE</th>                                    
                        </tr>
                    </thead>
                    <tbody> 
                        @foreach($municipiosBeneficiados as $dados) 
                            <tr>
                                <td>{{$loop->index+1}}</td>                            
                                <td>{{$dados->ds_municipio}}</td>
                                <td>{{$dados->sg_uf}}</td>
                                <td>{{$dados->ds_regiao}}</td>
                                <td>{{$dados->txt_rm_ride}}</td>
                            </tr>  
    
                        @endforeach
                    </tbody><!-- fechar tbody-->
                </table><!-- fechar table-->
            </div> <!-- table-responsive-sm --> 
            <hr>
            <div class=" mt-1 mb-1 text-right">
                <button type="button" class="br-button bg-green-cool-vivid-60  text-white mr-5" aria-label="Ícone ilustrativo" onclick='window.location.href="{{ url("apis/municipios_beneficiados/debenture/$projetoDebenture->projeto_debenture_id")}}"'>
                    <i class="fas fa-edit" aria-hidden="true"></i>Editar Municípios
                </button>
            </div>
        </div><!--card-body-->
    </div><!--card-->
</div>  <!--form-group-->
<!--------------------------ENQUADRAMENTO------------------------------->
        <div class="form-group">            
            <div class="card">
                <div class="card-header bg-indigo-cool-vivid-80 text-white">Enquadramento</div>
                <div class="card-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="column col-xs-12 col-md-3">
                                <label for="txt_situacao_analise" class="control-label">Status Análise - Técnica(o)</label>
                                <input id="txt_situacao_analise" type="text" 
                                    class="form-control text-center" name="txt_situacao_analise" value="{{$projetoDebenture->txt_situacao_analise}}"  disabled>
                            </div>
                            <div class="column col-xs-12 col-md-3">
                                <label for="dte_enquadranento_dfin" class="control-label">Data de Enquadramento - Técnica(o)</label>
                                <input id="dte_enquadranento_dfin" type="text" 
                                    class="form-control text-center" name="dte_enquadranento_dfin" value="@if($projetoDebenture->dte_enquadranento_dfin) {{date('d/m/Y',strtotime($projetoDebenture->dte_enquadranento_dfin))}}@endif"  disabled>
                            </div>
                            <div class="column col-xs-12 col-md-3">
                                <label for="dte_emissao_enquadramento_sns" class="control-label">Data Emissão - SNS</label>
                                <input id="dte_emissao_enquadramento_sns" type="text" 
                                    class="form-control text-center" name="dte_emissao_enquadramento_sns" value="@if($projetoDebenture->dte_emissao_enquadramento_sns) {{date('d/m/Y',strtotime($projetoDebenture->dte_emissao_enquadramento_sns))}}@endif"  disabled>
                            </div>
                            <div class="column col-xs-12 col-md-3">
                                <label for="txt_situacao_enquadramento" class="control-label">Situação do Enquadramento</label>
                                <input id="txt_situacao_enquadramento" type="text" 
                                    class="form-control text-center" name="txt_situacao_enquadramento" value="{{$projetoDebenture->txt_situacao_enquadramento}}"  disabled>
                            </div>
                        </div><!--form-roup-->
                        <div class="br-textarea">
                            <label for="txt_motivo_nao_enquadramento" class="control-label">Motivo não enquadramento</label>
                            <textarea class="form-control" 
                            id="txt_motivo_nao_enquadramento" 
                            name="txt_motivo_nao_enquadramento"  
                            disabled>{{$projetoDebenture->txt_motivo_nao_enquadramento}}</textarea>
                        </div><!--text-area-->
                        <div class="row">
                            <div class="column col-xs-12 col-md-4">
                                <label for="txt_situacao_conjur" class="control-label">Situação CONJUR</label>
                                <input id="txt_situacao_conjur" type="text" 
                                    class="form-control text-center" name="txt_situacao_conjur" value="{{$projetoDebenture->txt_situacao_conjur}}"  disabled>
                            </div>
                            <div class="column col-xs-12 col-md-4">
                                <label for="dte_aprovacao_conjur" class="control-label">Data aprovação CONJUR</label>
                                <input id="dte_aprovacao_conjur" type="text" 
                                    class="form-control text-center" name="dte_aprovacao_conjur" value="@if($projetoDebenture->dte_aprovacao_conjur) {{date('d/m/Y',strtotime($projetoDebenture->dte_aprovacao_conjur))}}@endif"  disabled>
                            </div>
                            <div class="column col-xs-12 col-md-4">
                                <label for="txt_situacao_enquadramento" class="control-label">Status Final Enquadramento</label>
                                <input id="txt_situacao_enquadramento" type="text" 
                                    class="form-control text-center" name="txt_situacao_enquadramento" value="{{$projetoDebenture->txt_situacao_enquadramento}}"  disabled>
                            </div>
                        </div><!--form-roup-->
                        <div class="row">
                            <div class="column col-xs-12 col-md-4">
                                <label for="txt_situacao_envio_publicacao_sns" class="control-label">Situação Envio SNS Publicação</label>
                                <input id="txt_situacao_envio_publicacao_sns" type="text" 
                                    class="form-control text-center" name="txt_situacao_envio_publicacao_sns" value="{{$projetoDebenture->txt_situacao_envio_publicacao_sns}}"  disabled>
                            </div>
                            <div class="column col-xs-12 col-md-4">
                                <label for="txt_situacao_publicacao_portaria" class="control-label">Situação Publicação</label>
                                <input id="txt_situacao_publicacao_portaria" type="text" 
                                    class="form-control text-center" name="txt_situacao_publicacao_portaria" value="{{$projetoDebenture->txt_situacao_publicacao_portaria}}"  disabled>
                            </div>
                            <div class="column col-xs-12 col-md-4">
                                <label for="dte_publicacao_portaria" class="control-label">Data Publicação</label>
                                <input id="dte_publicacao_portaria" type="text" 
                                    class="form-control text-center" name="dte_publicacao_portaria" value="@if($projetoDebenture->dte_publicacao_portaria) {{date('d/m/Y',strtotime($projetoDebenture->dte_enquadranento_dfin))}}@endif"  disabled>
                            </div>
                            <div class="column col-xs-12 col-md-4">
                                <label for="txt_portaria_aprovacao" class="control-label">Portaria de Aprovação</label>
                                <input id="txt_portaria_aprovacao" type="text" 
                                    class="form-control text-center" name="txt_portaria_aprovacao" value="{{$projetoDebenture->txt_portaria_aprovacao}}"  disabled>
                            </div>
                        </div><!--form-roup-->
                    
                        <div class="p-3 text-right">
                            <button type="button" class="br-button bg-indigo-cool-vivid-80 text-white mr-3" aria-label="Ícone ilustrativo" onclick='window.location.href="{{ url("apis/enquadramento/debenture/$projetoDebenture->projeto_debenture_id")}}"'>
                                <i class="fas fa-edit" aria-hidden="true"></i>Editar Enquadramento
                            </button>
                        </div>
                    </div><!--form-group-->
                </div><!--card-body-->
            </div><!--card-->
        </div><!--form-group-->

<!-----------------------EMISSÃO ------------------------->        
        <div class="form-group">            
            <div class="card">
                <div class="card-header bg-violet-warm-60 text-white">Emissão</div>
                <div class="card-body">
                    @if(empty($emissaoDebentures))
                        <button type="button" class="br-button block secondary mr-3" aria-label="Ícone ilustrativo" data-bs-toggle="modal" data-bs-target="#registrarEmissao">
                            <i class="fas fa-plus" aria-hidden="true"></i>Adicionar Emissão
                        </button>  
                    @endif

                    @if(!empty($emissaoDebentures))
                        <div class="form-group">
                            <div class="row">
                                <div class="column col-xs-12 col-md-3">
                                    <label for="txt_situacao_emissao" class="control-label">Situação Emissão</label>
                                    <input id="txt_situacao_emissao" type="text" 
                                        class="form-control text-center" name="txt_situacao_emissao" value="{{$emissaoDebentures->txt_situacao_emissao}}"  disabled>
                                </div>
                                <div class="column col-xs-12 col-md-3">
                                    <label for="dte_emissao" class="control-label">Data Emissão</label>
                                    <input id="dte_emissao" type="text" 
                                        class="form-control text-center" name="dte_emissao" value="@if($emissaoDebentures->dte_emissao) {{date('d/m/Y',strtotime($emissaoDebentures->dte_emissao))}}@endif"  disabled>
                                </div>
                                <div class="column col-xs-12 col-md-3">
                                    <label for="dte_distribuicao" class="control-label">Data Distribuição</label>
                                    <input id="dte_distribuicao" type="text" 
                                        class="form-control text-center" name="dte_distribuicao" value="@if($emissaoDebentures->dte_distribuicao) {{date('d/m/Y',strtotime($emissaoDebentures->dte_distribuicao))}}@endif"  disabled>
                                </div>
                                <div class="column col-xs-12 col-md-3">
                                    <label for="dte_encerramento_oferta_publica" class="control-label">Data Encerramento Oferta Pública</label>
                                    <input id="dte_encerramento_oferta_publica" type="text" 
                                        class="form-control text-center" name="dte_encerramento_oferta_publica" value="@if($emissaoDebentures->dte_encerramento_oferta_publica) {{date('d/m/Y',strtotime($emissaoDebentures->dte_encerramento_oferta_publica))}}@endif"  disabled>
                                </div>
                            </div><!--row-->
                            <div class="row">
                                <div class="column col-xs-12 col-md-2">
                                    <label for="vlr_captado" class="control-label">Valor Captado</label>
                                    <input id="vlr_captado" type="text" 
                                        class="form-control text-center" name="vlr_captado" value="{{number_format( ($emissaoDebentures->vlr_captado), 2, ',' , '.')}}"  disabled>
                                </div>
                                <div class="column col-xs-12 col-md-4">
                                    <label for="agente_fiduciario_id" class="control-label">Cnpj Agente Fiduciário</label>
                                    <input id="agente_fiduciario_id" type="text" 
                                        class="form-control text-center" name="agente_fiduciario_id" value="{{$emissaoDebentures->agente_fiduciario_id}}"  disabled>
                                </div>
                                <div class="column col-xs-12 col-md-5">
                                    <label for="txt_agente_fiduciario" class="control-label">Agente Fiduciário</label>
                                    <input id="txt_agente_fiduciario" type="text" 
                                        class="form-control text-center" name="txt_agente_fiduciario" value="{{$emissaoDebentures->txt_agente_fiduciario}}"  disabled>
                                </div>
                            </div>
                            <hr>
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
                                        
                                        </div>
                                    </div>
                                </div>
            
                                @endforeach
                            </div><!--row-->
                            @endif
                            <hr>
                            <div class=" mt-1 mb-1 text-right">
                                <button type="button" class="br-button bg-violet-warm-60  text-white mr-5" aria-label="Ícone ilustrativo" onclick='window.location.href="{{ url("apis/debenture/emissao/$emissaoDebentures->emissao_debenture_id")}}"'>
                                    <i class="fas fa-edit" aria-hidden="true"></i>Editar Emissão
                                </button>
                            </div>
                        </div><!--form-group-->
                    @endif    
                </div><!--card-body-->
            </div><!--card-->
        </div><!--form-group-->
        
        
<!---------ACOMPANHAMENTO ----->
            
        
        <div class="form-group">            
            <div class="card">
                <div class="card-header bg-warning">Acompanhamento</div>
                <div class="card-body">
                    
                        <button type="button" class="br-button block secondary mr-3" aria-label="Ícone ilustrativo" data-bs-toggle="modal" data-bs-target="#registrarAcompanhamento">
                            <i class="fas fa-plus" aria-hidden="true"></i>Adicionar Acompanhamento
                        </button>   
                    

                    @if(count($acompanhamento)>0)
                        <div class="table-responsive-sm">
                            <table class="table table-hover">
                                <thead>                                    
                                <tr class="text-center">   
                                        
                                        <th>Data</th>
                                        <th>Analista</th>
                                        <th>Andamento</th>
                                        <th>Ação</th>                                    
                                    </tr>
                                </thead>
                                <tbody> 
                                    @foreach($acompanhamento as $dados) 
                                        <tr>
                                                                
                                            <td>{{date('d/m/Y',strtotime($dados->created_at))}}</td>
                                            <td>{{$dados->usuario->name}}</td>
                                            <td>{{$dados->dsc_acompanhamento}}</td>
                                            <td>
                                                @if(Auth::user()->id == $dados->user_id)
                                                    <botao-acao-icone  
                                                        :url="'{{ url("/apis/debenture/acompanhamento/excluir")}}'" 
                                                        registro="{{$dados->id}}"                               
                                                        mensagem="Deseja excluir o acompanhamento?" 
                                                        titulo="Atenção!!!"
                                                        txtbotaoconfirma="Sim"
                                                        txtbotaocancela="Cancelar"
                                                        cssbotao="br-button circle danger small mr-3"                               
                                                        cssicone="fas fa-trash" 
                                                    
                                                    ></botao-acao-icone> 
                                                @endif

                                            </td>
                                        </tr>  
                
                                    @endforeach
                                </tbody><!-- fechar tbody-->
                            </table><!-- fechar table-->
                        </div> <!-- table-responsive-sm --> 
                    @endif
                </div><!--card-body-->
            </div><!--card-->
        </div>  <!--form-group-->
           

        <div class="p-3 text-right">
            <button class="br-button primary mr-3" type="submit" name="Salvar Edição">Pesquisar
            </button>


            <button class="br-button danger mr-3" type="button" onclick="javascript:window.history.go(-1)">Voltar
            </button>
        </div>

   

</div>


    <!-- Modal acompanhamento -->
    <div class="modal fade" id="registrarAcompanhamento" tabindex="-1" aria-labelledby="registrarAcompanhamentoLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="registrarAcompanhamentoLabel">Acompanhamento</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="form-horizontal" role="form" method="POST" action='{{ url("apis/debenture/acompanhamento/adicionar/") }}'>         
                {{ csrf_field() }}
                <input type="hidden" id="projeto_debenture_id" name="projeto_debenture_id" value="{{$projetoDebenture->projeto_debenture_id}}">
                <div class="modal-body">
                    <div class="form-group br-textarea">
                        <label for="dsc_acompanhamento" class="control-label">Acompanhamento</label>
                        <textarea class="form-control" 
                           id="dsc_acompanhamento" 
                           name="dsc_acompanhamento"  
                           required
                           rows="10"></textarea>
                   </div>
                </div>
                <div class="modal-footer">
                    
                <button type="button" class="br-button danger mr-3" data-bs-dismiss="modal">Fechar</button>
                <button type="submit" class="br-button primary mr-3">Salvar</button>
                    
                </div>
            </form>
          </div>
        </div>
      </div>

 <!-- Modal Emissão -->
 <div class="modal fade" id="registrarEmissao" tabindex="-1" aria-labelledby="registrarEmissaoLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="registrarEmissaoLabel">Emissão</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form class="form-horizontal" role="form" method="POST" action='{{ url("apis/debenture/emissao/cadastrar/") }}'>         
            {{ csrf_field() }}
            <input type="hidden" id="projeto_debenture_id" name="projeto_debenture_id" value="{{$projetoDebenture->projeto_debenture_id}}">
            <div class="modal-body">
                <cadastrar-emissao 
                    :url="'{{ url("/")}}'" >
                </cadastrar-emissao>
            </div>
            <div class="modal-footer">
                
            <button type="button" class="br-button danger mr-3" data-bs-dismiss="modal">Fechar</button>
            <button type="submit" class="br-button primary mr-3">Salvar</button>
                
            </div>
        </form>
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
                        :url="'{{ url("/")}}'" 
                        :btnbuttons="true">
                    </cadastrar-condicao-emissao>
                </div>
                
            </form>
        </div>
        </div>
    </div>
@endif

@endsection