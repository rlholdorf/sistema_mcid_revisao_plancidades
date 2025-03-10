@extends('layouts.app')

@section('content')


<historico-navegacao
      :url="'{{ url('/home') }}'"      
      :telanterior01="'Controle de Demandas'"      
      :telatual="'Minhas Demandas'"
      >

</historico-navegacao>


<div class="main-content pl-sm-3 mt-5 container-fluid" id="main-content">

  <cabecalho-relatorios
            :titulo="'Minhas Demandas'"            
            :linkcompartilhar="'{{ url("/") }}'"
            :barracompartilhar="false">
  </cabecalho-relatorios>

  @if(count($demandasUsuario)>0)
        <div class="titulo">
            <h5>Minhas Solicitações</h5> 
        </div><!-- titulo-->
        <div class="form-group row">
            <div class="col col-xs-12 col-sm-12">
                <button type="submit" class="br-button block secondary mr-3" aria-label="Ícone ilustrativo" onclick="window.location.href='/codem/demanda/nova'">
                    <i class="fas fa-edit" aria-hidden="true"></i>Nova demanda
                </button>
                <div class="table-responsive">
                    <table class="table table-striped table-hover table-sm">
                        <thead  class="text-center">
                            <tr class="text-center ">
                                <th>#</th>  
                                <th>ID</th>  
                                <th>Secretaria Demandada</th>  
                                <th>Departamento Demandado</th>  
                                <th>Setor Demandado</th>  
                                <th>Demandado</th>  
                                <th>Tema</th>  
                                <th>Subtema</th>  
                                <th>Situação</th>  
                                <th>Data Solicitação</th>  
                                <th>Prazo em dias</th>  
                                <th>Previsão Conclusão</th>  
                                <th>Atraso</th>  
                                <th>Interessado (s)</th>  
                                <th class="acao">Ação</th>
                            </tr>
                        </thead>
                        <tbody> 
                            @foreach($demandasUsuario as $demanda)  
                                    @if($demanda->qtd_dias_atraso>0)
                                        <tr  class="conteudoTabela table-danger" >                            
                                    @else
                                        <tr  class="conteudoTabela" >                            
                                    @endif               
                            
                                    <td>
                                        @if($demanda->bln_visualizada)
                                            <i class="fas fa-envelope-open fa-2x" style="color:green;"></i>                                   
                                        @else
                                            <i class="fas fa-envelope fa-2x" style="color:gray;"></i>                                   
                                        @endif
                                    </td>
                                    <td>{{$demanda->demanda_id}}</td>                                   
                                    <td>{{$demanda->txt_nome_secretaria}}</td>
                                    <td>{{$demanda->txt_sigla_departamento}}</td>
                                    <td>{{$demanda->txt_sigla_setor}}</td>
                                    <td>{{mb_convert_case($demanda->nome_demandado, MB_CASE_TITLE, 'UTF-8')}}</td>
                                    <td>{{$demanda->txt_tema}}</td>
                                    <td>{{$demanda->txt_sub_tema}}</td>
                                    <td>{{$demanda->txt_situacao}}</td>
                                    <td>{{($demanda->dte_solicitacao) ? date('d/m/Y',strtotime($demanda->dte_solicitacao)) : ''}}</td>
                                    <td>{{$demanda->num_max_dias}}</td>

                                    <td>{{($demanda->dte_previsao_conclusao) ? date('d/m/Y',strtotime($demanda->dte_previsao_conclusao)) : ''}}</td>
                                    <td>{{($demanda->qtd_dias_atraso)>0 ? $demanda->qtd_dias_atraso : 0}}</td>
                                    <td>{{$demanda->txt_nome_interessado}}</td>
                                    <td class="acao"><a class="br-button circle primary small" href='{{ url("codem/demanda/dados/$demanda->demanda_id/demanda")}}'><i class="fas fa-eye"></i></a></td>                              
                                </tr>                              
                            @endforeach        
                        </tbody>
                    </table> 
                </div>
            </div>    
        </div> 
    @endif

    @if(count($demandasUsuarioDemandado)>0)
        <div class="titulo">
            <h5>Demandas a responder</h5> 
        </div><!-- titulo-->
        <div class="form-group row">
            <div class="col col-xs-12 col-sm-12">
                <button type="submit" class="br-button block secondary mr-3" aria-label="Ícone ilustrativo" onclick="window.location.href='/codem/demanda/nova'">
                    <i class="fas fa-edit" aria-hidden="true"></i>Nova demanda
                </button>
                <div class="table-responsive">
                    <table class="table table-striped table-hover table-sm">
                        <thead  class="text-center">
                            <tr class="text-center ">
                                <th>#</th>  
                                <th>ID</th>  
                                <th>Secretaria Demandada</th>  
                                <th>Departamento Demandado</th>  
                                <th>Setor Demandado</th>  
                                <th>Demandado</th>  
                                <th>Tema</th>  
                                <th>Subtema</th>  
                                <th>Situação</th>  
                                <th>Data Solicitação</th>  
                                <th>Prazo em dias</th>  
                                <th>Previsão Conclusão</th>  
                                <th>Atraso</th>  
                                <th>Interessado (s)</th>  
                                <th class="acao">Ação</th>
                            </tr>
                        </thead>
                        <tbody> 
                            @foreach($demandasUsuarioDemandado as $demanda)  
                                    @if($demanda->qtd_dias_atraso>0)
                                        <tr  class="conteudoTabela table-danger" >                            
                                    @else
                                        <tr  class="conteudoTabela" >                            
                                    @endif               
                            
                                    <td>
                                        @if($demanda->bln_visualizada)
                                            <i class="fas fa-envelope-open fa-2x" style="color:green;"></i>                                   
                                        @else
                                            <i class="fas fa-envelope fa-2x" style="color:gray;"></i>                                   
                                        @endif
                                    </td>
                                    <td>{{$demanda->demanda_id}}</td>                                   
                                    <td>{{$demanda->txt_nome_secretaria}}</td>
                                    <td>{{$demanda->txt_sigla_departamento}}</td>
                                    <td>{{$demanda->txt_sigla_setor}}</td>
                                    <td>{{mb_convert_case($demanda->nome_demandado, MB_CASE_TITLE, 'UTF-8')}}</td>
                                    <td>{{$demanda->txt_tema}}</td>
                                    <td>{{$demanda->txt_sub_tema}}</td>
                                    <td>{{$demanda->txt_situacao}}</td>
                                    <td>{{($demanda->dte_solicitacao) ? date('d/m/Y',strtotime($demanda->dte_solicitacao)) : ''}}</td>
                                    <td>{{$demanda->num_max_dias}}</td>

                                    <td>{{($demanda->dte_previsao_conclusao) ? date('d/m/Y',strtotime($demanda->dte_previsao_conclusao)) : ''}}</td>
                                    <td>{{($demanda->qtd_dias_atraso)>0 ? $demanda->qtd_dias_atraso : 0}}</td>
                                    <td>{{$demanda->txt_nome_interessado}}</td>
                                    <td class="acao"><a class="br-button circle primary small" href='{{ url("codem/demanda/dados/$demanda->demanda_id/demanda")}}'><i class="fas fa-eye"></i></a></td>                              
                                </tr>                              
                            @endforeach        
                        </tbody>
                    </table> 
                </div>
            </div>    
        </div> 
    @endif
    
    @if(count($encaminhamentoDemanda)>0)
        <div class="titulo">
            <h5>Encaminhamentos de demandas a responder</h5> 
        </div><!-- titulo-->
        <div class="form-group row">
            <div class="col col-xs-12 col-sm-12">            
            
                <table class="table table-condensed">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>ID</th>
                        <th>Data do encaminhamento</th>
                        <th>Secretaria Demandante</th>
                        <th>Departamento Demandante</th>
                        <th>Setor Demandante</th>
                        <th>Demandante</th>
                        <th>Concluído?</th>
                        <th>Data da Resposta?</th>
                        <th class="text-center">Ação</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($encaminhamentoDemanda as $dados)
                    <tr>
                        <td>
                        @if($dados->bln_visualizado)
                            <i class="fas fa-envelope-open fa-2x" style="color:green;"></i>                                   
                        @else
                            <i class="fas fa-envelope fa-2x" style="color:gray;"></i>                                   
                        @endif
                    </td>
                        <td>{{$dados->id}}</td>
                        <td>{{date('d/m/Y',strtotime($dados->dte_encaminhamento))}}</td>
                        <td>{{$dados->txt_nome_secretaria}}</td>
                        <td>{{$dados->txt_sigla_departamento}}</td>
                        <td>{{$dados->txt_sigla_setor}}</td>
                        <td>{{mb_convert_case($dados->nome_usuario_demandante, MB_CASE_TITLE, 'UTF-8')}}</td>
                        <td>@if($dados->bln_concluido) Sim @else Não @endif</td>
                        <td>@if($dados->dte_resposta){{date('d/m/Y',strtotime($dados->dte_resposta))}}@endif</td>
                    <td>
                        <a class="br-button circle primary small" href='{{ url("codem/demanda/encaminhamento/dados/$dados->id")}}'><i class="fas fa-eye  fa-1x"></i></a>
                        </td>
                      
                        
                    </tr>   
                    @endforeach                                 
                    </tbody>
                </table>  
                
            
            </div>
        </div>
    @endif

    
  @if(count($demandasSetorUsuario)>0)
  <div class="titulo">
      <h5>Solicitações do Setor</h5> 
  </div><!-- titulo-->
  <div class="form-group row">
      <div class="col col-xs-12 col-sm-12">
          <button type="submit" class="br-button block secondary mr-3" aria-label="Ícone ilustrativo" onclick="window.location.href='/codem/demanda/nova'">
              <i class="fas fa-edit" aria-hidden="true"></i>Nova demanda
          </button>
          <div class="table-responsive">
              <table class="table table-striped table-hover table-sm">
                  <thead  class="text-center">
                      <tr class="text-center ">
                          <th>#</th>  
                          <th>ID Demanda</th>  
                          <th>Secretaria Demandada</th>  
                          <th>Departamento Demandado</th>  
                          <th>Setor Demandado</th>  
                          <th>Demandado</th>  
                          <th>Tema</th>  
                          <th>Subtema</th>  
                          <th>Situação</th>  
                          <th>Data Solicitação</th>  
                          <th>Prazo em dias</th>  
                          <th>Previsão Conclusão</th>  
                          <th>Atraso</th>  
                          <th>Interessado (s)</th>  
                          <th class="acao">Ação</th>
                      </tr>
                  </thead>
                  <tbody> 
                      @foreach($demandasSetorUsuario as $demanda)  
                              @if($demanda->qtd_dias_atraso>0)
                                  <tr  class="conteudoTabela table-danger" >                            
                              @else
                                  <tr  class="conteudoTabela" >                            
                              @endif               
                      
                              <td>
                                  @if($demanda->bln_visualizada)
                                      <i class="fas fa-envelope-open fa-2x" style="color:green;"></i>                                   
                                  @else
                                      <i class="fas fa-envelope fa-2x" style="color:gray;"></i>                                   
                                  @endif
                              </td>
                              <td>{{$demanda->demanda_id}}</td>                                   
                              <td>{{$demanda->txt_nome_secretaria}}</td>
                              <td>{{$demanda->txt_sigla_departamento}}</td>
                              <td>{{$demanda->txt_sigla_setor}}</td>
                              <td>{{mb_convert_case($demanda->nome_demandado, MB_CASE_TITLE, 'UTF-8')}}</td>
                              <td>{{$demanda->txt_tema}}</td>
                              <td>{{$demanda->txt_sub_tema}}</td>
                              <td>{{$demanda->txt_situacao}}</td>
                              <td>{{($demanda->dte_solicitacao) ? date('d/m/Y',strtotime($demanda->dte_solicitacao)) : ''}}</td>
                              <td>{{$demanda->num_max_dias}}</td>

                              <td>{{($demanda->dte_previsao_conclusao) ? date('d/m/Y',strtotime($demanda->dte_previsao_conclusao)) : ''}}</td>
                              <td>{{($demanda->qtd_dias_atraso)>0 ? $demanda->qtd_dias_atraso : 0}}</td>
                              <td>{{$demanda->txt_nome_interessado}}</td>
                              <td class="acao"><a class="br-button circle primary small" href='{{ url("codem/demanda/dados/$demanda->demanda_id/demanda")}}'><i class="fas fa-eye"></i></a></td>                              
                          </tr>                              
                      @endforeach        
                  </tbody>
              </table> 
          </div>
      </div>    
  </div> 
@endif


    
    <div class="p-3 text-right">      
        <button class="br-button primary mr-3" type="button" name="Imprimir" onclick="window.print();">Imprimir 
        </button>

        <button class="br-button danger mr-3" type="button" onclick="window.location.href='/home'">Voltar
        </button>
    </div>

</div>




@endsection
