@extends('layouts.app')

@section('scriptscss')
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/custom.css')}}"  media="screen" />
@endsection


@section('content')




<historico-navegacao
      :url="'{{ url('/') }}'"      
      :telanterior01="'Propostas'"  
      :telanterior02="'Transferegov'"  
      :telanterior02="'Consultar Execução Orçamentária'"  
      :telatual="'Execução Transferegov'"
      >

</historico-navegacao>


<div class="main-content pl-sm-3" id="main-content">
  
    <cabecalho-relatorios
        :titulo="'{{$titulo}}'"        
        @if($subtitulo1) subtitulo1="{{$subtitulo1}}" @endif      
        
       barracompartilhar="false">
    </cabecalho-relatorios> 

    
    <div class="form-group">   
            

      
        @if(count($propostasTransferegov) > 0)
            @if($acaoSelecionada == 'false')       
                <div class="table-responsive-sm">
                    <table class="table table-hover">
                        <thead>                   
                            <tr class="text-center">   
                                <th>#</th>
                                <th>UF Sistema</th>
                                <th>Município Sistema</th>
                                <th>Ação Transferegov</th>             
                                <th>Situação Ajustada</th>                                       
                                <th>Qtde Propostas</th>
                                <th>Valor Repasse</th>                                   
                            </tr>
                        </thead>
                        <tbody> 
                            @foreach($propostasTransferegov as $dados)                    
                                <tr class="text-center">                          
                                    <td>{{$loop->index+1}} </td>
                                    <td>{{$dados->uf_transferegov}}</td>
                                    <td>{{$dados->municipio_transferegov}}</td> 
                                    <td class="text-center">{{$dados->acao_orcamentaria}}</td>  
                                    <td>{{$dados->situacao_ajustada}}</td>    
                                    <td class="text-center">{{number_format( ($dados->qtd_propostas), 0, ',' , '.')}}</td>                                                                    
                                    <td class="text-center">{{number_format( ($dados->vlr_repasse_transferegov), 2, ',' , '.')}}</td>    
                                </tr>  
                            @endforeach
                            <tr class="total">
                                
                                    <td colspan="5" > <strong>TOTAL</strong></td>
                                    <td class="text-center"> <strong> {{number_format( ($propostasTransferegov->sum('qtd_propostas')),0, ',' , '.')}}</strong></td>
                                    <td class="text-center"> <strong> {{number_format( ($propostasTransferegov->sum('vlr_repasse_transferegov')), 2, ',' , '.')}}</strong></td>
                            </tr>
                        </tbody><!-- fechar tbody-->
                    </table><!-- fechar table-->
                </div> <!-- table-responsive-sm -->  
            @else
                <div class="table-responsive">	
                    <table class="table table-bordered table-sm tab_executivo">
                        <thead>
                            <tr class="text-center">
                                <th class="text-center">Ação Orçamentária</th>         
                                <th class="text-center">Situação</th>    
                                <th class="text-center">Qtde Propostas</th>
                                <th class="text-center">AC</th>
                                <th class="text-center">AL</th>
                                <th class="text-center">AM</th>
                                <th class="text-center">AP</th>
                                <th class="text-center">BA</th>
                                <th class="text-center">CE</th>
                                <th class="text-center">DF</th>
                                <th class="text-center">ES</th>
                                <th class="text-center">GO</th>
                                <th class="text-center">MA</th>
                                <th class="text-center">MG</th>
                                <th class="text-center">MS</th>
                                <th class="text-center">MT</th>
                                <th class="text-center">PA</th>
                                <th class="text-center">PB</th>
                                <th class="text-center">PE</th>
                                <th class="text-center">PI</th>
                                <th class="text-center">PR</th>
                                <th class="text-center">RJ</th>
                                <th class="text-center">RN</th>
                                <th class="text-center">RO</th>
                                <th class="text-center">RR</th>
                                <th class="text-center">RS</th>
                                <th class="text-center">SC</th>
                                <th class="text-center">SE</th>
                                <th class="text-center">SP</th>
                                <th class="text-center">TO</th>
                            </tr>
                            <tr>
                                <!--
                                @for ($i = 0; $i < 27; $i++)
                                    <th class="text-center">Quant</th>
                                    <th class="text-center">valor</th>
                                @endfor
                                -->
                                

                            </tr>
                                                
                        </thead>
                        <tbody>
                            @foreach($propostasTransferegov as $dados)                                        
                            <tr>                        
                                <td>{{$dados->acao_orcamentaria}}</td>
                                <td>{{$dados->situacao_ajustada}}</td>
                                <td class="text-center">{{number_format( ($dados->num_propostas), 0, ',' , '.')}}</td>
                                <td class="text-center">{{number_format( ($dados->vlr_intervencao_ac), 0, ',' , '.')}}</td>                                
                                <td class="text-center">{{number_format( ($dados->vlr_intervencao_al), 0, ',' , '.')}}</td>  
                                <td class="text-center">{{number_format( ($dados->vlr_intervencao_am), 0, ',' , '.')}}</td>                                
                                <td class="text-center">{{number_format( ($dados->vlr_intervencao_ap), 0, ',' , '.')}}</td>                                
                                <td class="text-center">{{number_format( ($dados->vlr_intervencao_ba), 0, ',' , '.')}}</td>                                
                                <td class="text-center">{{number_format( ($dados->vlr_intervencao_ce), 0, ',' , '.')}}</td>                                
                                <td class="text-center">{{number_format( ($dados->vlr_intervencao_df), 0, ',' , '.')}}</td>                                
                                <td class="text-center">{{number_format( ($dados->vlr_intervencao_es), 0, ',' , '.')}}</td>                                
                                <td class="text-center">{{number_format( ($dados->vlr_intervencao_go), 0, ',' , '.')}}</td>                                
                                <td class="text-center">{{number_format( ($dados->vlr_intervencao_ma), 0, ',' , '.')}}</td>                                
                                <td class="text-center">{{number_format( ($dados->vlr_intervencao_mg), 0, ',' , '.')}}</td>                                
                                <td class="text-center">{{number_format( ($dados->vlr_intervencao_ms), 0, ',' , '.')}}</td>                                
                                <td class="text-center">{{number_format( ($dados->vlr_intervencao_mt), 0, ',' , '.')}}</td>                                
                                <td class="text-center">{{number_format( ($dados->vlr_intervencao_pa), 0, ',' , '.')}}</td>                                
                                <td class="text-center">{{number_format( ($dados->vlr_intervencao_pb), 0, ',' , '.')}}</td>                                
                                <td class="text-center">{{number_format( ($dados->vlr_intervencao_pe), 0, ',' , '.')}}</td>                                
                                <td class="text-center">{{number_format( ($dados->vlr_intervencao_pi), 0, ',' , '.')}}</td>                                
                                <td class="text-center">{{number_format( ($dados->vlr_intervencao_pr), 0, ',' , '.')}}</td>                                
                                <td class="text-center">{{number_format( ($dados->vlr_intervencao_rj), 0, ',' , '.')}}</td>                                
                                <td class="text-center">{{number_format( ($dados->vlr_intervencao_rn), 0, ',' , '.')}}</td>                                
                                <td class="text-center">{{number_format( ($dados->vlr_intervencao_ro), 0, ',' , '.')}}</td>                                
                                <td class="text-center">{{number_format( ($dados->vlr_intervencao_rr), 0, ',' , '.')}}</td>                                
                                <td class="text-center">{{number_format( ($dados->vlr_intervencao_rs), 0, ',' , '.')}}</td>                                
                                <td class="text-center">{{number_format( ($dados->vlr_intervencao_sc), 0, ',' , '.')}}</td>                                
                                <td class="text-center">{{number_format( ($dados->vlr_intervencao_se), 0, ',' , '.')}}</td>                                
                                <td class="text-center">{{number_format( ($dados->vlr_intervencao_sp), 0, ',' , '.')}}</td>                                
                                <td class="text-center">{{number_format( ($dados->vlr_intervencao_to), 0, ',' , '.')}}</td>                                
                            </tr>   
                            @endforeach     
                            <tr class="total text-weight-semi-bold">                         
                                <td colspan="2" class="text-center">TOTAL</td>
                                <td class="text-center">{{number_format( ($totalPropostaTransferegov['total_propostas']), 0, ',' , '.')}}</td>    
                                <td class="text-center">{{number_format( ($totalPropostaTransferegov['total_vlr_intervencao_ac']), 0, ',' , '.')}}</td>                                 
                                <td class="text-center">{{number_format( ($totalPropostaTransferegov['total_vlr_intervencao_al']), 0, ',' , '.')}}</td>   
                                <td class="text-center">{{number_format( ($totalPropostaTransferegov['total_vlr_intervencao_am']), 0, ',' , '.')}}</td>                                 
                                <td class="text-center">{{number_format( ($totalPropostaTransferegov['total_vlr_intervencao_ap']), 0, ',' , '.')}}</td>                                 
                                <td class="text-center">{{number_format( ($totalPropostaTransferegov['total_vlr_intervencao_ba']), 0, ',' , '.')}}</td>                                 
                                <td class="text-center">{{number_format( ($totalPropostaTransferegov['total_vlr_intervencao_ce']), 0, ',' , '.')}}</td>                                 
                                <td class="text-center">{{number_format( ($totalPropostaTransferegov['total_vlr_intervencao_df']), 0, ',' , '.')}}</td>                                 
                                <td class="text-center">{{number_format( ($totalPropostaTransferegov['total_vlr_intervencao_es']), 0, ',' , '.')}}</td>                                 
                                <td class="text-center">{{number_format( ($totalPropostaTransferegov['total_vlr_intervencao_go']), 0, ',' , '.')}}</td>                                 
                                <td class="text-center">{{number_format( ($totalPropostaTransferegov['total_vlr_intervencao_ma']), 0, ',' , '.')}}</td>                                 
                                <td class="text-center">{{number_format( ($totalPropostaTransferegov['total_vlr_intervencao_mg']), 0, ',' , '.')}}</td>                                 
                                <td class="text-center">{{number_format( ($totalPropostaTransferegov['total_vlr_intervencao_ms']), 0, ',' , '.')}}</td>                                 
                                <td class="text-center">{{number_format( ($totalPropostaTransferegov['total_vlr_intervencao_mt']), 0, ',' , '.')}}</td>                                 
                                <td class="text-center">{{number_format( ($totalPropostaTransferegov['total_vlr_intervencao_pa']), 0, ',' , '.')}}</td>                                 
                                <td class="text-center">{{number_format( ($totalPropostaTransferegov['total_vlr_intervencao_pb']), 0, ',' , '.')}}</td>                                 
                                <td class="text-center">{{number_format( ($totalPropostaTransferegov['total_vlr_intervencao_pe']), 0, ',' , '.')}}</td>                                 
                                <td class="text-center">{{number_format( ($totalPropostaTransferegov['total_vlr_intervencao_pi']), 0, ',' , '.')}}</td>                                 
                                <td class="text-center">{{number_format( ($totalPropostaTransferegov['total_vlr_intervencao_pr']), 0, ',' , '.')}}</td>                                 
                                <td class="text-center">{{number_format( ($totalPropostaTransferegov['total_vlr_intervencao_rj']), 0, ',' , '.')}}</td>                                 
                                <td class="text-center">{{number_format( ($totalPropostaTransferegov['total_vlr_intervencao_rn']), 0, ',' , '.')}}</td>                                 
                                <td class="text-center">{{number_format( ($totalPropostaTransferegov['total_vlr_intervencao_ro']), 0, ',' , '.')}}</td>                                 
                                <td class="text-center">{{number_format( ($totalPropostaTransferegov['total_vlr_intervencao_rr']), 0, ',' , '.')}}</td>                                 
                                <td class="text-center">{{number_format( ($totalPropostaTransferegov['total_vlr_intervencao_rs']), 0, ',' , '.')}}</td>                                 
                                <td class="text-center">{{number_format( ($totalPropostaTransferegov['total_vlr_intervencao_sc']), 0, ',' , '.')}}</td>                                 
                                <td class="text-center">{{number_format( ($totalPropostaTransferegov['total_vlr_intervencao_se']), 0, ',' , '.')}}</td>                                 
                                <td class="text-center">{{number_format( ($totalPropostaTransferegov['total_vlr_intervencao_sp']), 0, ',' , '.')}}</td>                                 
                                <td class="text-center">{{number_format( ($totalPropostaTransferegov['total_vlr_intervencao_to']), 0, ',' , '.')}}</td>      
                            </tr>                                      
                        
                        </tbody>
                    </table>     
                </div><!-- fim table-responsive-->
            @endif              
        @endif              

    </div>  
    
    <div class="p-3 text-right">
        <button class="br-button primary mr-3" type="button" name="imprimir" value="Imprimir" onclick="window.print();">Imprimir
        </button>
        <button class="br-button danger mr-3" type="button"  onclick="javascript:window.history.go(-1)">Fechar
        </button>
      </div> 

                        
   

   

</div>
@endsection


