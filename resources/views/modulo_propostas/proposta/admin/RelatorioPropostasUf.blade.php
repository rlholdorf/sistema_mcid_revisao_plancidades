@extends('layouts.app')

@section('scriptscss')
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/custom.css')}}"  media="screen" />
<link rel="stylesheet" type="text/css" href="{{ asset('css/relatorio_executivo.css') }}"  media="screen" > 

@endsection


@section('content')




<historico-navegacao
      :url="'{{ url('/home') }}'"      
      :telanterior01="'Propostas'"  
      :telanterior02="'relatórios'"  
      :telatual="'Resumo de Propostas por UF'"
      >

</historico-navegacao>


<div class="main-content pl-sm-3 mt-5" id="main-content">

    <cabecalho-relatorios
        :titulo="'Resumo de Propostas por UF'"     
                      
         barracompartilhar="false">
    </cabecalho-relatorios> 
    
    @can('eConsulta')
    <div class="br-card">
        <div class="card-header">
        <div class="d-flex"><span class="br-avatar mt-1" title="Fulano da Silva"><span class="content">
            <img height="50" width="50" src='{{ URL::asset("/img/icones/termo.png")}}' alt="Avatar"/></span></span>
            <div class="ml-3">
            <div class="text-weight-semi-bold text-up-02">
                Seleção de Propostas
            </div>

            <div>
                Resumo
            </div>
            </div>
            <div class="ml-auto">
            <!--
            <button class="br-button circle" type="button" aria-label="Ícone ilustrativo"><i class="fas fa-ellipsis-v" aria-hidden="true"></i>
            </button>
        -->
            </div>
        </div>
        </div>
        <div class="card-content">            
            
                <div class="table-responsive">	
                    <table class="table table-bordered table-sm tab_executivo">
                        <thead>
                            <tr class="text-center">
                                <th class="text-center">Modalidade</th>         
                            <!--    <th class="text-center">Seleção</th>    -->
                                <th class="text-center">Propostas</th>    
                                <th class="text-center">Valor</th>  
                            <!--
                                <th class="text-center">Envio Sist</th>    
                                <th class="text-center">Valor Env Sist</th>    
                                <th class="text-center">Envio Forms</th>    
                                <th class="text-center">Valor Env Forms</th>    
                            -->
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
                            @foreach($propostasCadastradas as $dados)                                        
                            <tr>                        
                                <td>{{$dados->txt_modalidade_participacao}}</td>
                               <!-- <td class="text-center">{{$dados->num_selecao}}ª</td>-->
                                <td class="text-center">{{number_format( ($dados->num_propostas), 0, ',' , '.')}}</td>
                                <td class="text-center">{{number_format( ($dados->vlr_total),2 , ',' , '.')}}</td>
                              <!--  <td class="text-center">{{number_format( ($dados->num_propostas_enviadas_sistema), 0, ',' , '.')}}</td>
                                <td class="text-center">{{number_format( ($dados->vlr_intervencao_enviadas_sistema), 2, ',' , '.')}}</td>
                                <td class="text-center">{{number_format( ($dados->num_propostas_enviadas_forms), 0, ',' , '.')}}</td>
                                <td class="text-center">{{number_format( ($dados->vlr_intervencao_enviadas_forms), 2, ',' , '.')}}</td>
                              -->
                                <td class="text-center">{{number_format( ($dados->num_propostas_ac), 0, ',' , '.')}}</td>                                
                                <td class="text-center">{{number_format( ($dados->num_propostas_al), 0, ',' , '.')}}</td>  
                                <td class="text-center">{{number_format( ($dados->num_propostas_am), 0, ',' , '.')}}</td>                                
                                <td class="text-center">{{number_format( ($dados->num_propostas_ap), 0, ',' , '.')}}</td>                                
                                <td class="text-center">{{number_format( ($dados->num_propostas_ba), 0, ',' , '.')}}</td>                                
                                <td class="text-center">{{number_format( ($dados->num_propostas_ce), 0, ',' , '.')}}</td>                                
                                <td class="text-center">{{number_format( ($dados->num_propostas_df), 0, ',' , '.')}}</td>                                
                                <td class="text-center">{{number_format( ($dados->num_propostas_es), 0, ',' , '.')}}</td>                                
                                <td class="text-center">{{number_format( ($dados->num_propostas_go), 0, ',' , '.')}}</td>                                
                                <td class="text-center">{{number_format( ($dados->num_propostas_ma), 0, ',' , '.')}}</td>                                
                                <td class="text-center">{{number_format( ($dados->num_propostas_mg), 0, ',' , '.')}}</td>                                
                                <td class="text-center">{{number_format( ($dados->num_propostas_ms), 0, ',' , '.')}}</td>                                
                                <td class="text-center">{{number_format( ($dados->num_propostas_mt), 0, ',' , '.')}}</td>                                
                                <td class="text-center">{{number_format( ($dados->num_propostas_pa), 0, ',' , '.')}}</td>                                
                                <td class="text-center">{{number_format( ($dados->num_propostas_pb), 0, ',' , '.')}}</td>                                
                                <td class="text-center">{{number_format( ($dados->num_propostas_pe), 0, ',' , '.')}}</td>                                
                                <td class="text-center">{{number_format( ($dados->num_propostas_pi), 0, ',' , '.')}}</td>                                
                                <td class="text-center">{{number_format( ($dados->num_propostas_pr), 0, ',' , '.')}}</td>                                
                                <td class="text-center">{{number_format( ($dados->num_propostas_rj), 0, ',' , '.')}}</td>                                
                                <td class="text-center">{{number_format( ($dados->num_propostas_rn), 0, ',' , '.')}}</td>                                
                                <td class="text-center">{{number_format( ($dados->num_propostas_ro), 0, ',' , '.')}}</td>                                
                                <td class="text-center">{{number_format( ($dados->num_propostas_rr), 0, ',' , '.')}}</td>                                
                                <td class="text-center">{{number_format( ($dados->num_propostas_rs), 0, ',' , '.')}}</td>                                
                                <td class="text-center">{{number_format( ($dados->num_propostas_sc), 0, ',' , '.')}}</td>                                
                                <td class="text-center">{{number_format( ($dados->num_propostas_se), 0, ',' , '.')}}</td>                                
                                <td class="text-center">{{number_format( ($dados->num_propostas_sp), 0, ',' , '.')}}</td>                                
                                <td class="text-center">{{number_format( ($dados->num_propostas_to), 0, ',' , '.')}}</td>                                
                            </tr>   
                            @endforeach     
                            <tr class="total text-weight-semi-bold">                         
                                <td colspan="1" class="text-center">TOTAL</td>
                                <td class="text-center">{{number_format( ($totalProposta['total_propostas']), 0, ',' , '.')}}</td>    
                                <td class="text-center">{{number_format( ($totalProposta['total_intervencao']), 0, ',' , '.')}}</td>  
                                <!--
                                <td class="text-center">{{number_format( ($totalProposta['total_propostas_sistema']), 0, ',' , '.')}}</td>    
                                <td class="text-center">{{number_format( ($totalProposta['total_intervencao_sistema']), 0, ',' , '.')}}</td>
                                <td class="text-center">{{number_format( ($totalProposta['total_propostas_forms']), 0, ',' , '.')}}</td>    
                                <td class="text-center">{{number_format( ($totalProposta['total_intervencao_forms']), 0, ',' , '.')}}</td>    
                                -->                              
                                <td class="text-center">{{number_format( ($totalProposta['total_num_propostas_ac']), 0, ',' , '.')}}</td>                                 
                                <td class="text-center">{{number_format( ($totalProposta['total_num_propostas_al']), 0, ',' , '.')}}</td>   
                                <td class="text-center">{{number_format( ($totalProposta['total_num_propostas_am']), 0, ',' , '.')}}</td>                                 
                                <td class="text-center">{{number_format( ($totalProposta['total_num_propostas_ap']), 0, ',' , '.')}}</td>                                 
                                <td class="text-center">{{number_format( ($totalProposta['total_num_propostas_ba']), 0, ',' , '.')}}</td>                                 
                                <td class="text-center">{{number_format( ($totalProposta['total_num_propostas_ce']), 0, ',' , '.')}}</td>                                 
                                <td class="text-center">{{number_format( ($totalProposta['total_num_propostas_df']), 0, ',' , '.')}}</td>                                 
                                <td class="text-center">{{number_format( ($totalProposta['total_num_propostas_es']), 0, ',' , '.')}}</td>                                 
                                <td class="text-center">{{number_format( ($totalProposta['total_num_propostas_go']), 0, ',' , '.')}}</td>                                 
                                <td class="text-center">{{number_format( ($totalProposta['total_num_propostas_ma']), 0, ',' , '.')}}</td>                                 
                                <td class="text-center">{{number_format( ($totalProposta['total_num_propostas_mg']), 0, ',' , '.')}}</td>                                 
                                <td class="text-center">{{number_format( ($totalProposta['total_num_propostas_ms']), 0, ',' , '.')}}</td>                                 
                                <td class="text-center">{{number_format( ($totalProposta['total_num_propostas_mt']), 0, ',' , '.')}}</td>                                 
                                <td class="text-center">{{number_format( ($totalProposta['total_num_propostas_pa']), 0, ',' , '.')}}</td>                                 
                                <td class="text-center">{{number_format( ($totalProposta['total_num_propostas_pb']), 0, ',' , '.')}}</td>                                 
                                <td class="text-center">{{number_format( ($totalProposta['total_num_propostas_pe']), 0, ',' , '.')}}</td>                                 
                                <td class="text-center">{{number_format( ($totalProposta['total_num_propostas_pi']), 0, ',' , '.')}}</td>                                 
                                <td class="text-center">{{number_format( ($totalProposta['total_num_propostas_pr']), 0, ',' , '.')}}</td>                                 
                                <td class="text-center">{{number_format( ($totalProposta['total_num_propostas_rj']), 0, ',' , '.')}}</td>                                 
                                <td class="text-center">{{number_format( ($totalProposta['total_num_propostas_rn']), 0, ',' , '.')}}</td>                                 
                                <td class="text-center">{{number_format( ($totalProposta['total_num_propostas_ro']), 0, ',' , '.')}}</td>                                 
                                <td class="text-center">{{number_format( ($totalProposta['total_num_propostas_rr']), 0, ',' , '.')}}</td>                                 
                                <td class="text-center">{{number_format( ($totalProposta['total_num_propostas_rs']), 0, ',' , '.')}}</td>                                 
                                <td class="text-center">{{number_format( ($totalProposta['total_num_propostas_sc']), 0, ',' , '.')}}</td>                                 
                                <td class="text-center">{{number_format( ($totalProposta['total_num_propostas_se']), 0, ',' , '.')}}</td>                                 
                                <td class="text-center">{{number_format( ($totalProposta['total_num_propostas_sp']), 0, ',' , '.')}}</td>                                 
                                <td class="text-center">{{number_format( ($totalProposta['total_num_propostas_to']), 0, ',' , '.')}}</td>      
                            </tr>                                      
                          
                        </tbody>
                    </table>     
                </div><!-- fim table-responsive-->

           
            

        </div>
        <div class="card-footer">
            <div class="d-flex" style="padding-top: 10px;"> 
                
                               
                                         
                    <button type="button" class="br-button block secondary mr-3" aria-label="Ícone ilustrativo"  onclick="window.location.href='/selecao/propostas/consultar'">
                        <i class="fas fa-eye" aria-hidden="true"></i>Consultar Propostas
                    </button>                          
                
            </div>
        </div>                  
    </div><!-- br-card -->
@endcan
</div>
@endsection


