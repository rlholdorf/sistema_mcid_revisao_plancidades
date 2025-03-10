@extends('layouts.app')

@section('scriptscss')
  <link rel="stylesheet" type="text/css" href="{{URL::asset('css/caixas.css')}}"  media="screen" />  

@endsection

@section('content')

<div class="main-content pl-sm-3 mt-5 container-fluid" id="main-content">
    @include('modulo_bndes.atalhos_consultas')

    <div class="br-card">
        <div class="card-header">
        <div class="d-flex"><span class="br-avatar mt-1" title="Fulano da Silva"><span class="content">
            <img height="50" width="50" src='{{ URL::asset("/img/icones/termo.png")}}' alt="Avatar"/></span></span>
            <div class="ml-3">
            <div class="text-weight-semi-bold text-up-02">
                Resumo do Andamento dos Empreendimentos
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
                                <th class="text-center">Andamento</th>         
                                <th class="text-center">Empreendimentos</th>    
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
                            @foreach($resumoAndamentoBndes as $dados)                                        
                            <tr>                        
                                <td>{{$dados->txt_andamento}}</td>
                                <td class="text-center">{{number_format( ($dados->num_empreendimentos), 0, ',' , '.')}}</td>                           
                                <td class="text-center">{{number_format( ($dados->num_empreendimentos_ac), 0, ',' , '.')}}</td>                                
                                <td class="text-center">{{number_format( ($dados->num_empreendimentos_al), 0, ',' , '.')}}</td>  
                                <td class="text-center">{{number_format( ($dados->num_empreendimentos_am), 0, ',' , '.')}}</td>                                
                                <td class="text-center">{{number_format( ($dados->num_empreendimentos_ap), 0, ',' , '.')}}</td>                                
                                <td class="text-center">{{number_format( ($dados->num_empreendimentos_ba), 0, ',' , '.')}}</td>                                
                                <td class="text-center">{{number_format( ($dados->num_empreendimentos_ce), 0, ',' , '.')}}</td>                                
                                <td class="text-center">{{number_format( ($dados->num_empreendimentos_df), 0, ',' , '.')}}</td>                                
                                <td class="text-center">{{number_format( ($dados->num_empreendimentos_es), 0, ',' , '.')}}</td>                                
                                <td class="text-center">{{number_format( ($dados->num_empreendimentos_go), 0, ',' , '.')}}</td>                                
                                <td class="text-center">{{number_format( ($dados->num_empreendimentos_ma), 0, ',' , '.')}}</td>                                
                                <td class="text-center">{{number_format( ($dados->num_empreendimentos_mg), 0, ',' , '.')}}</td>                                
                                <td class="text-center">{{number_format( ($dados->num_empreendimentos_ms), 0, ',' , '.')}}</td>                                
                                <td class="text-center">{{number_format( ($dados->num_empreendimentos_mt), 0, ',' , '.')}}</td>                                
                                <td class="text-center">{{number_format( ($dados->num_empreendimentos_pa), 0, ',' , '.')}}</td>                                
                                <td class="text-center">{{number_format( ($dados->num_empreendimentos_pb), 0, ',' , '.')}}</td>                                
                                <td class="text-center">{{number_format( ($dados->num_empreendimentos_pe), 0, ',' , '.')}}</td>                                
                                <td class="text-center">{{number_format( ($dados->num_empreendimentos_pi), 0, ',' , '.')}}</td>                                
                                <td class="text-center">{{number_format( ($dados->num_empreendimentos_pr), 0, ',' , '.')}}</td>                                
                                <td class="text-center">{{number_format( ($dados->num_empreendimentos_rj), 0, ',' , '.')}}</td>                                
                                <td class="text-center">{{number_format( ($dados->num_empreendimentos_rn), 0, ',' , '.')}}</td>                                
                                <td class="text-center">{{number_format( ($dados->num_empreendimentos_ro), 0, ',' , '.')}}</td>                                
                                <td class="text-center">{{number_format( ($dados->num_empreendimentos_rr), 0, ',' , '.')}}</td>                                
                                <td class="text-center">{{number_format( ($dados->num_empreendimentos_rs), 0, ',' , '.')}}</td>                                
                                <td class="text-center">{{number_format( ($dados->num_empreendimentos_sc), 0, ',' , '.')}}</td>                                
                                <td class="text-center">{{number_format( ($dados->num_empreendimentos_se), 0, ',' , '.')}}</td>                                
                                <td class="text-center">{{number_format( ($dados->num_empreendimentos_sp), 0, ',' , '.')}}</td>                                
                                <td class="text-center">{{number_format( ($dados->num_empreendimentos_to), 0, ',' , '.')}}</td>                                
                            </tr>   
                            @endforeach     
                            <tr class="total text-weight-semi-bold">                         
                                <td colspan="1" class="text-center">TOTAL</td>
                                <td class="text-center">{{number_format( ($totalAndamento['total_empreendimentos']), 0, ',' , '.')}}</td>    
                                
                                <td class="text-center">{{number_format( ($totalAndamento['total_num_empreendimentos_ac']), 0, ',' , '.')}}</td>                                 
                                <td class="text-center">{{number_format( ($totalAndamento['total_num_empreendimentos_al']), 0, ',' , '.')}}</td>   
                                <td class="text-center">{{number_format( ($totalAndamento['total_num_empreendimentos_am']), 0, ',' , '.')}}</td>                                 
                                <td class="text-center">{{number_format( ($totalAndamento['total_num_empreendimentos_ap']), 0, ',' , '.')}}</td>                                 
                                <td class="text-center">{{number_format( ($totalAndamento['total_num_empreendimentos_ba']), 0, ',' , '.')}}</td>                                 
                                <td class="text-center">{{number_format( ($totalAndamento['total_num_empreendimentos_ce']), 0, ',' , '.')}}</td>                                 
                                <td class="text-center">{{number_format( ($totalAndamento['total_num_empreendimentos_df']), 0, ',' , '.')}}</td>                                 
                                <td class="text-center">{{number_format( ($totalAndamento['total_num_empreendimentos_es']), 0, ',' , '.')}}</td>                                 
                                <td class="text-center">{{number_format( ($totalAndamento['total_num_empreendimentos_go']), 0, ',' , '.')}}</td>                                 
                                <td class="text-center">{{number_format( ($totalAndamento['total_num_empreendimentos_ma']), 0, ',' , '.')}}</td>                                 
                                <td class="text-center">{{number_format( ($totalAndamento['total_num_empreendimentos_mg']), 0, ',' , '.')}}</td>                                 
                                <td class="text-center">{{number_format( ($totalAndamento['total_num_empreendimentos_ms']), 0, ',' , '.')}}</td>                                 
                                <td class="text-center">{{number_format( ($totalAndamento['total_num_empreendimentos_mt']), 0, ',' , '.')}}</td>                                 
                                <td class="text-center">{{number_format( ($totalAndamento['total_num_empreendimentos_pa']), 0, ',' , '.')}}</td>                                 
                                <td class="text-center">{{number_format( ($totalAndamento['total_num_empreendimentos_pb']), 0, ',' , '.')}}</td>                                 
                                <td class="text-center">{{number_format( ($totalAndamento['total_num_empreendimentos_pe']), 0, ',' , '.')}}</td>                                 
                                <td class="text-center">{{number_format( ($totalAndamento['total_num_empreendimentos_pi']), 0, ',' , '.')}}</td>                                 
                                <td class="text-center">{{number_format( ($totalAndamento['total_num_empreendimentos_pr']), 0, ',' , '.')}}</td>                                 
                                <td class="text-center">{{number_format( ($totalAndamento['total_num_empreendimentos_rj']), 0, ',' , '.')}}</td>                                 
                                <td class="text-center">{{number_format( ($totalAndamento['total_num_empreendimentos_rn']), 0, ',' , '.')}}</td>                                 
                                <td class="text-center">{{number_format( ($totalAndamento['total_num_empreendimentos_ro']), 0, ',' , '.')}}</td>                                 
                                <td class="text-center">{{number_format( ($totalAndamento['total_num_empreendimentos_rr']), 0, ',' , '.')}}</td>                                 
                                <td class="text-center">{{number_format( ($totalAndamento['total_num_empreendimentos_rs']), 0, ',' , '.')}}</td>                                 
                                <td class="text-center">{{number_format( ($totalAndamento['total_num_empreendimentos_sc']), 0, ',' , '.')}}</td>                                 
                                <td class="text-center">{{number_format( ($totalAndamento['total_num_empreendimentos_se']), 0, ',' , '.')}}</td>                                 
                                <td class="text-center">{{number_format( ($totalAndamento['total_num_empreendimentos_sp']), 0, ',' , '.')}}</td>                                 
                                <td class="text-center">{{number_format( ($totalAndamento['total_num_empreendimentos_to']), 0, ',' , '.')}}</td>      
                            </tr>                                      
                        
                        </tbody>
                    </table>     
                </div><!-- fim table-responsive-->
        </div>
        <div class="card-footer">
            <div class="d-flex" style="padding-top: 10px;"> 
                    <button type="button" class="br-button block secondary mr-3" aria-label="Ícone ilustrativo"  onclick="window.location.href='/bndes/empreendimentos/consultar'">
                        <i class="fas fa-eye" aria-hidden="true"></i>Consultar empreendimentos
                    </button>                          
                
            </div>
        </div>                  
    </div><!-- br-card -->


    <div class="br-card">
        <div class="card-header">
        <div class="d-flex"><span class="br-avatar mt-1" title="Fulano da Silva"><span class="content">
            <img height="50" width="50" src='{{ URL::asset("/img/icones/termo.png")}}' alt="Avatar"/></span></span>
            <div class="ml-3">
            <div class="text-weight-semi-bold text-up-02">
                Resumo do Situação Obra dos Empreendimentos
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
                                <th class="text-center">Situação Obra</th>         
                                <th class="text-center">Empreendimentos</th>    
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
                            @foreach($resumoSituacaoObraBndes as $dados)                                        
                            <tr>                        
                                <td>{{$dados->txt_situacao_obra}}</td>
                                <td class="text-center">{{number_format( ($dados->num_empreendimentos), 0, ',' , '.')}}</td>                           
                                <td class="text-center">{{number_format( ($dados->num_empreendimentos_ac), 0, ',' , '.')}}</td>                                
                                <td class="text-center">{{number_format( ($dados->num_empreendimentos_al), 0, ',' , '.')}}</td>  
                                <td class="text-center">{{number_format( ($dados->num_empreendimentos_am), 0, ',' , '.')}}</td>                                
                                <td class="text-center">{{number_format( ($dados->num_empreendimentos_ap), 0, ',' , '.')}}</td>                                
                                <td class="text-center">{{number_format( ($dados->num_empreendimentos_ba), 0, ',' , '.')}}</td>                                
                                <td class="text-center">{{number_format( ($dados->num_empreendimentos_ce), 0, ',' , '.')}}</td>                                
                                <td class="text-center">{{number_format( ($dados->num_empreendimentos_df), 0, ',' , '.')}}</td>                                
                                <td class="text-center">{{number_format( ($dados->num_empreendimentos_es), 0, ',' , '.')}}</td>                                
                                <td class="text-center">{{number_format( ($dados->num_empreendimentos_go), 0, ',' , '.')}}</td>                                
                                <td class="text-center">{{number_format( ($dados->num_empreendimentos_ma), 0, ',' , '.')}}</td>                                
                                <td class="text-center">{{number_format( ($dados->num_empreendimentos_mg), 0, ',' , '.')}}</td>                                
                                <td class="text-center">{{number_format( ($dados->num_empreendimentos_ms), 0, ',' , '.')}}</td>                                
                                <td class="text-center">{{number_format( ($dados->num_empreendimentos_mt), 0, ',' , '.')}}</td>                                
                                <td class="text-center">{{number_format( ($dados->num_empreendimentos_pa), 0, ',' , '.')}}</td>                                
                                <td class="text-center">{{number_format( ($dados->num_empreendimentos_pb), 0, ',' , '.')}}</td>                                
                                <td class="text-center">{{number_format( ($dados->num_empreendimentos_pe), 0, ',' , '.')}}</td>                                
                                <td class="text-center">{{number_format( ($dados->num_empreendimentos_pi), 0, ',' , '.')}}</td>                                
                                <td class="text-center">{{number_format( ($dados->num_empreendimentos_pr), 0, ',' , '.')}}</td>                                
                                <td class="text-center">{{number_format( ($dados->num_empreendimentos_rj), 0, ',' , '.')}}</td>                                
                                <td class="text-center">{{number_format( ($dados->num_empreendimentos_rn), 0, ',' , '.')}}</td>                                
                                <td class="text-center">{{number_format( ($dados->num_empreendimentos_ro), 0, ',' , '.')}}</td>                                
                                <td class="text-center">{{number_format( ($dados->num_empreendimentos_rr), 0, ',' , '.')}}</td>                                
                                <td class="text-center">{{number_format( ($dados->num_empreendimentos_rs), 0, ',' , '.')}}</td>                                
                                <td class="text-center">{{number_format( ($dados->num_empreendimentos_sc), 0, ',' , '.')}}</td>                                
                                <td class="text-center">{{number_format( ($dados->num_empreendimentos_se), 0, ',' , '.')}}</td>                                
                                <td class="text-center">{{number_format( ($dados->num_empreendimentos_sp), 0, ',' , '.')}}</td>                                
                                <td class="text-center">{{number_format( ($dados->num_empreendimentos_to), 0, ',' , '.')}}</td>                                
                            </tr>   
                            @endforeach     
                            <tr class="total text-weight-semi-bold">                         
                                <td colspan="1" class="text-center">TOTAL</td>
                                <td class="text-center">{{number_format( ($totalSituacaoObra['total_empreendimentos']), 0, ',' , '.')}}</td>    
                                
                                <td class="text-center">{{number_format( ($totalSituacaoObra['total_num_empreendimentos_ac']), 0, ',' , '.')}}</td>                                 
                                <td class="text-center">{{number_format( ($totalSituacaoObra['total_num_empreendimentos_al']), 0, ',' , '.')}}</td>   
                                <td class="text-center">{{number_format( ($totalSituacaoObra['total_num_empreendimentos_am']), 0, ',' , '.')}}</td>                                 
                                <td class="text-center">{{number_format( ($totalSituacaoObra['total_num_empreendimentos_ap']), 0, ',' , '.')}}</td>                                 
                                <td class="text-center">{{number_format( ($totalSituacaoObra['total_num_empreendimentos_ba']), 0, ',' , '.')}}</td>                                 
                                <td class="text-center">{{number_format( ($totalSituacaoObra['total_num_empreendimentos_ce']), 0, ',' , '.')}}</td>                                 
                                <td class="text-center">{{number_format( ($totalSituacaoObra['total_num_empreendimentos_df']), 0, ',' , '.')}}</td>                                 
                                <td class="text-center">{{number_format( ($totalSituacaoObra['total_num_empreendimentos_es']), 0, ',' , '.')}}</td>                                 
                                <td class="text-center">{{number_format( ($totalSituacaoObra['total_num_empreendimentos_go']), 0, ',' , '.')}}</td>                                 
                                <td class="text-center">{{number_format( ($totalSituacaoObra['total_num_empreendimentos_ma']), 0, ',' , '.')}}</td>                                 
                                <td class="text-center">{{number_format( ($totalSituacaoObra['total_num_empreendimentos_mg']), 0, ',' , '.')}}</td>                                 
                                <td class="text-center">{{number_format( ($totalSituacaoObra['total_num_empreendimentos_ms']), 0, ',' , '.')}}</td>                                 
                                <td class="text-center">{{number_format( ($totalSituacaoObra['total_num_empreendimentos_mt']), 0, ',' , '.')}}</td>                                 
                                <td class="text-center">{{number_format( ($totalSituacaoObra['total_num_empreendimentos_pa']), 0, ',' , '.')}}</td>                                 
                                <td class="text-center">{{number_format( ($totalSituacaoObra['total_num_empreendimentos_pb']), 0, ',' , '.')}}</td>                                 
                                <td class="text-center">{{number_format( ($totalSituacaoObra['total_num_empreendimentos_pe']), 0, ',' , '.')}}</td>                                 
                                <td class="text-center">{{number_format( ($totalSituacaoObra['total_num_empreendimentos_pi']), 0, ',' , '.')}}</td>                                 
                                <td class="text-center">{{number_format( ($totalSituacaoObra['total_num_empreendimentos_pr']), 0, ',' , '.')}}</td>                                 
                                <td class="text-center">{{number_format( ($totalSituacaoObra['total_num_empreendimentos_rj']), 0, ',' , '.')}}</td>                                 
                                <td class="text-center">{{number_format( ($totalSituacaoObra['total_num_empreendimentos_rn']), 0, ',' , '.')}}</td>                                 
                                <td class="text-center">{{number_format( ($totalSituacaoObra['total_num_empreendimentos_ro']), 0, ',' , '.')}}</td>                                 
                                <td class="text-center">{{number_format( ($totalSituacaoObra['total_num_empreendimentos_rr']), 0, ',' , '.')}}</td>                                 
                                <td class="text-center">{{number_format( ($totalSituacaoObra['total_num_empreendimentos_rs']), 0, ',' , '.')}}</td>                                 
                                <td class="text-center">{{number_format( ($totalSituacaoObra['total_num_empreendimentos_sc']), 0, ',' , '.')}}</td>                                 
                                <td class="text-center">{{number_format( ($totalSituacaoObra['total_num_empreendimentos_se']), 0, ',' , '.')}}</td>                                 
                                <td class="text-center">{{number_format( ($totalSituacaoObra['total_num_empreendimentos_sp']), 0, ',' , '.')}}</td>                                 
                                <td class="text-center">{{number_format( ($totalSituacaoObra['total_num_empreendimentos_to']), 0, ',' , '.')}}</td>      
                            </tr>                                      
                        
                        </tbody>
                    </table>     
                </div><!-- fim table-responsive-->
        </div>
        <div class="card-footer">
            <div class="d-flex" style="padding-top: 10px;"> 
                    <button type="button" class="br-button block secondary mr-3" aria-label="Ícone ilustrativo"  onclick="window.location.href='/bndes/empreendimentos/consultar'">
                        <i class="fas fa-eye" aria-hidden="true"></i>Consultar empreendimentos
                    </button>                          
                
            </div>
        </div>                  
    </div><!-- br-card -->
</div>
@endsection
