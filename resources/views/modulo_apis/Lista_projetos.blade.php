@extends('layouts.app')

@section('content')


<historico-navegacao
      :url="'{{ url('/home') }}'"      
      :telanterior01="'Debentures'"      
      :telanterior01="'Consultar projetos debentures'"      
      :telatual="'Lista debentures'"
      >

</historico-navegacao>


<div class="main-content pl-sm-3 mt-5 container-fluid" id="main-content">

  <cabecalho-relatorios-filtros
            :titulo="'Lista debentures'"    
            v-bind:subtitulos="{{json_encode($subtitulos)}}"        
            :linkcompartilhar="'{{ url("/") }}'"
            :barracompartilhar="false">
  </cabecalho-relatorios-filtros>

  @if(count($projetosDebentures) > 0)

  <div class="table-responsive-sm">
    <table class="table table-hover ">
        <thead>
            
           <tr class="text-center table-success" >
           
            <th class="text-center align-middle">Projetos</th>
            <th class="text-center align-middle">Investimento (R$)</th>
            <th class="text-center align-middle">Debêtures (R$)</th>
            <th class="text-center align-middle">População Beneficiada</th>
            <th class="text-center align-middle">Captado (R$)</th>
            <th class="text-center align-middle">Saldo a Emitir (R$)</th>
                            
            
            </tr>
        </thead>
        <tbody> 
            
                    <tr class="text-center align-middle" >                        
                        <td class="text-center align-middle">{{ number_format( count($projetosDebentures), 0, ',' , '.')}}</td>
                        <td class="text-center align-middle">{{number_format( ($projetosDebentures->sum('vlr_investimento_projeto')), 2, ',' , '.')}}</td>
                        <td class="text-center align-middle">{{number_format( ($projetosDebentures->sum('vlr_debentures')), 2, ',' , '.')}}</td>
                        <td class="text-center align-middle">{{number_format( ($projetosDebentures->sum('num_populacao_beneficiada')), 0, ',' , '.')}}</td>
                        <td class="text-center align-middle">{{number_format( ($projetosDebentures->sum('vlr_captado')), 2, ',' , '.')}}</td>
                        <td class="text-center align-middle">{{number_format( ($projetosDebentures->sum('vlr_saldo_a_emitir')), 2, ',' , '.')}}</td>
                        
                    </tr> 
                        
                    <tr class="text-center align-middle table-secondary" >                            
                        <td class="text-center align-middle">{{number_format((count($projetosDebentures)/$projetosCadastrados->num_propostas)*100, 2, ',' , '.')}}%</td>
                        <td class="text-center align-middle">
                            @if($projetosCadastrados->vlr_investimento_projeto > 0) 
                                {{number_format( ($projetosDebentures->sum('vlr_investimento_projeto')/$projetosCadastrados->vlr_investimento_projeto)*100, 2, ',' , '.')}}%
                            @else
                                0,00 %
                            @endif
                        </td>
                        <td class="text-center align-middle">
                            @if($projetosCadastrados->vlr_debentures > 0) 
                                {{number_format( ($projetosDebentures->sum('vlr_debentures')/$projetosCadastrados->vlr_debentures)*100, 2, ',' , '.')}}%
                            @else
                                0,00 %
                            @endif
                        </td>
                       
                        <td class="text-center align-middle">
                            @if($projetosCadastrados->num_populacao_beneficiada > 0) 
                                {{number_format( ($projetosDebentures->sum('num_populacao_beneficiada')/$projetosCadastrados->num_populacao_beneficiada)*100, 0, ',' , '.')}}%
                            @else
                                0,00 %
                            @endif
                        </td>
                        
                        <td class="text-center align-middle">
                            @if($projetosCadastrados->vlr_recursos_proprios > 0) 
                                {{number_format( ($projetosDebentures->sum('vlr_captado')/$projetosCadastrados->vlr_captado)*100, 2, ',' , '.')}}%
                            @else
                                0,00 %
                            @endif
                        </td>
                        <td class="text-center align-middle">
                            @if($projetosCadastrados->vlr_outras_fontes > 0) 
                                {{number_format( ($projetosDebentures->sum('vlr_saldo_a_emitir')/$projetosCadastrados->vlr_saldo_a_emitir)*100, 2, ',' , '.')}}%
                            @else
                                0,00 %
                            @endif
                        </td>
                       
                    </tr>   
                               
            
        </tbody><!-- fechar tbody-->
    </table><!-- fechar table-->
</div> <!-- table-responsive-sm -->  


        
        <div class="table-responsive-sm">
            <table class="table table-hover">
                <thead>
                    
                   <tr class="text-center" >
                   
                    <th>Carta Consulta</th>
                    <th>Projeto de Investimento</th>
                    <th>Data de Cadastramento</th>
                    <th>Valor Investimento</th>
                    <th>Valor Debêntures</th>
                    <th>População Beneficiada</th>
                    <th>Situacao Enquadramento</th>
                    <th>Ano Enquadramento</th>
                    <th>Portaria</th>
                    <th>Ano Portaria</th>
                    <th>Ano Emissão</th>
                    <th>Valor Emissão</th>                              
                    <th>Situação Execução</th>                       
                    <th class="text-center">Ação</th>                    
                    
                    </tr>
                </thead>
                <tbody> 
                    @foreach($projetosDebentures as $dados) 
                            <tr class="text-center align-middle" >                            
                                <td class="text-center align-middle">{{$dados->cod_carta_consulta}}</td>
                                <td class="align-middle">{{$dados->dsc_projeto_investimento}}</td>
                                <td class="text-center align-middle">{{date('d/m/Y',strtotime($dados->dte_cadastramento))}}</td>                                    
                                <td class="text-center align-middle">{{number_format( ($dados->vlr_investimento_projeto), 2, ',' , '.')}}</td>  
                                <td class="text-center align-middle">{{number_format( ($dados->vlr_debentures), 2, ',' , '.')}}</td>  
                                <td class="text-center align-middle">{{number_format( ($dados->num_populacao_beneficiada), 0, ',' , '.')}}</td>  
                                @if($dados->situacao_enquadramento_id == 2 || $dados->situacao_enquadramento_id == 4)
                                <td class="text-center align-middle bg-warning" >
                                @elseif($dados->situacao_enquadramento_id == 3 || $dados->situacao_enquadramento_id == 6)
                                    <td class="text-center align-middle text-white bg-danger" >
                                @elseif($dados->situacao_enquadramento_id == 5)
                                        <td class="text-center align-middle bg-success" >
                                @else
                                    <td class="text-center align-middle" >
                                @endif
                                    {{$dados->txt_situacao_enquadramento}}
                                </td> 
                                <td class="text-center align-middle">@if($dados->dte_cadastramento){{date('Y',strtotime($dados->dte_cadastramento))}}@endif</td>  
                                
                                <td class="align-middle">{{$dados->txt_portaria_aprovacao}}</td>
                                <td class="align-middle">{{$dados->num_ano_portaria}}</td>
                                <td class="text-center align-middle">@if($dados->dte_emissao_enquadramento_sns){{date('Y',strtotime($dados->dte_emissao_enquadramento_sns))}}@endif</td>                                    
                                <td class="text-center align-middle">{{number_format( ($dados->vlr_captado), 2, ',' , '.')}}</td>  
                                  
                                @if($dados->situacao_execucao_id == 3)
                                    <td class="text-center align-middle text-white bg-danger" >
                                @elseif($dados->situacao_execucao_id == 1)
                                    <td class="text-center align-middle bg-success" >
                                @else
                                    <td class="text-center align-middle" >
                                @endif
                                {{$dados->txt_situacao_execucao}}
                            </td>                                                                  
                                <td class="p-3 text-right">
                                    <button type="button" class="br-button circle secondary small mr-3" aria-label="Ícone ilustrativo" 
                                    onclick='window.location.href="{{ url("apis/debentures/$dados->projeto_debenture_id")}}"'>
                                        <i class="fas fa-eye" aria-hidden="true"></i>
                                    </button> 

                                </td>  
                            </tr>  
                        
                    @endforeach
                </tbody><!-- fechar tbody-->
            </table><!-- fechar table-->
        </div> <!-- table-responsive-sm -->  
            <em>Fonte: Análise CGPRC (propostas em análise e DOU)</em>

     @endif  
  
    <div class="p-3 text-right">      
        <button class="br-button primary mr-3" type="button" name="imprimir" value="Imprimir" onclick="window.print();">Imprimir
          </button>
      

      <button class="br-button danger mr-3" type="button" onclick="javascript:window.history.go(-1)">Voltar
      </button>
    </div> 



</div>




@endsection