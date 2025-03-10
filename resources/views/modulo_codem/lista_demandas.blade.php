@extends('layouts.app')

@section('content')


<historico-navegacao
      :url="'{{ url('/home') }}'"      
      :telanterior01="'Controle de Demandas'"      
      :telatual="'Lista de Demandas'"
      >

</historico-navegacao>


<div class="main-content pl-sm-3 mt-5 container-fluid" id="main-content">

  <cabecalho-relatorios
            :titulo="'Lista de Demandas'"            
            :linkcompartilhar="'{{ url("/") }}'"
            :barracompartilhar="false">
  </cabecalho-relatorios>

 
        
        <div class="form-group row">
            <div class="col col-xs-12 col-sm-12">
                

                <div class="table-responsive">
                    <table class="table table-striped table-hover table-sm">
                        <thead  class="text-center">
                            <tr class="text-center ">
                                <th>#</th>  
                                <th>ID</th>  
                                
                                <th>Tema</th>  
                                <th>Subtema</th>  
                                <th>Situação</th>  
                                <th>Tipo Interessado</th>  
                                <th>Data Solicitação</th>  
                                <th>Previsão Conclusão</th>  
                                <th>Atraso</th>  
                                <th>Interessado (s)</th>  
                                <th>Descrição</th>  
                                <th class="acao">Ação</th>
                            </tr>
                        </thead>
                        <tbody> 
                            @foreach($demandas as $demanda)  
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
                                    <td>{{$demanda->txt_tema}}</td>
                                    <td>{{$demanda->txt_sub_tema}}</td>
                                    <td>{{$demanda->txt_situacao}}</td>
                                    <td>{{$demanda->txt_tipo_interessado}}</td>
                                    <td>{{($demanda->dte_solicitacao) ? date('d/m/Y',strtotime($demanda->dte_solicitacao)) : ''}}</td>
                                    <td>{{($demanda->dte_previsao_conclusao) ? date('d/m/Y',strtotime($demanda->dte_previsao_conclusao)) : ''}}</td>
                                    <td>{{($demanda->qtd_dias_atraso)>0 ? $demanda->qtd_dias_atraso : 0}}</td>
                                    <td>{{$demanda->txt_nome_interessado}}</td>
                                    <td>{{$demanda->txt_descricao_demanda}}</td>
                                    <td class="acao"><a class="br-button circle primary small" href='{{ url("codem/demanda/dados/$demanda->demanda_id/demanda")}}'><i class="fas fa-eye"></i></a></td>                              
                                </tr>                              
                            @endforeach        
                        </tbody>
                    </table> 
                </div>
            </div>    
        </div> 
    
    

    
    <div class="p-3 text-right">      
        <button class="br-button primary mr-3" type="button" name="Imprimir" onclick="window.print();">Imprimir 
        </button>

        <button class="br-button danger mr-3" type="button" onclick="window.location.href='/home'">Voltar
        </button>
    </div>

</div>




@endsection
