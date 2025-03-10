@extends('layouts.app')

@section('scriptscss')
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/custom.css')}}"  media="screen" />
<link rel="stylesheet" type="text/css" href="{{ asset('css/relatorio_executivo.css') }}"  media="screen" > 

@endsection


@section('content')




<historico-navegacao
      :url="'{{ url('/') }}'"      
      :telanterior01="'Propostas'"  
      :telanterior02="'Consultar Propostas Transferegov'"  
      :telatual="'Propostas Transferegov'"
      >

</historico-navegacao>


<div class="main-content pl-sm-3 mt-5" id="main-content" style="min-height: 100% width 100%">
  
    <cabecalho-relatorios
        :titulo="'Propostas Transferegov'"
        
       barracompartilhar="false">
    </cabecalho-relatorios> 

    
    <div class="form-group">   
            

      
        @if(count($propostasTransferegov) > 0)

        
        <div class="table-responsive-sm">
            <table class="table table-hover">
                <thead>                   
                    <tr class="text-center">   
                        <th>#</th>
                        <th>ID</th>
                        @if($validaCnpj != 'Sim')
                        <th>UF Sistema</th>
                        <th>Município Sistema</th>
                        <th>CNPJ Sistema</th>                        
                        <th>Programa Sistema</th>                        
                        <th>Situação Sistema</th>                        
                        <th>Num Proposta Sistema</th>                        
                        <th>Valor Repasse</th>
                        @endif         
                        <th>Num Proposta Transferegov</th> 
                        <th>UF Transf</th>           
                        <th>Município Transf</th>                     
                        <th>Ação Transferegov</th>                        
                        <th>Programa Transferegov</th>                                     
                        <th>CNPJ Transferegov</th>                        
                        <th>Valor Transferegov</th>         
                        <th>Situação Ajustada</th>                                       
                        <th>Sistema vs Transferegov</th>                                       
                        <th>Valida CNPJ</th>                                       
                    </tr>
                </thead>
                <tbody> 
                    @foreach($propostasTransferegov as $dados)                    
                        @if($dados->valida_cnpj == 'Beneficiário diferente no sistema de seleção e no TransfereGOV')                        
                            <tr class="text-center table-danger">   
                        @elseif($dados->valida_cnpj == 'Verificar')
                            <tr class="text-center table-warning">   
                        @else
                                <tr class="text-center">   
                        @endif   
                        <td>{{$loop->index+1}}       </td>
                       <td>{{$dados->id_sistema}}</td>
                       @if($validaCnpj != 'Sim')
                        <td>{{$dados->uf_sistema}}</td>
                            <td>{{$dados->municipio_sistema}}</td>
                            <td>{{$dados->cnpj_sistema}}</td>    
                            <td>{{$dados->programa_sistema}}</td>    
                            <td>{{$dados->situacao_proposta_sistema}}</td>                        
                            <td>{{$dados->num_proposta_transferegov_sistema}}</td>  
                            <td>{{number_format( ($dados->vlr_final_transferegov_sistema), 2, ',' , '.')}}</td>    
                        @endif
                        <td>
                            <a class="menu-item" target="_blank" href='{{ url("https://discricionarias.transferegov.sistema.gov.br/voluntarias/ConsultarProposta/ResultadoDaConsultaDePropostaDetalharProposta.do?idProposta=$dados->cod_proposta&Usr=guest&Pwd=guest/")}}'>
                                {{$dados->num_proposta_transferegov}}     
                            </a>
                            </td>    
                        <td>{{$dados->uf_transferegov}}</td>                            
                        <td>{{$dados->municipio_transferegov}}</td>                                                    
                        <td>{{$dados->acao_orcamentaria}}</td>  
                        <td>{{$dados->programa_transferegov}}</td>                          
                        <td>{{$dados->identif_proponente_transferegov}}</td>                            
                        <td>{{number_format( ($dados->vlr_repasse_transferegov), 2, ',' , '.')}}</td>    
                        <td>{{$dados->situacao_ajustada}}</td>    
                        <td>{{$dados->sistema_x_transferegov}}</td>    
                        <td>
                            @if($dados->valida_cnpj == 'Verificar')
                                @if($dados->num_propostas_cnpj_transferegov > 0)
                                <form class="form-horizontal" role="form" method="POST" action='{{ url("admin/proposta/transferegov/visualizar/") }}'>         
                                    {{ csrf_field() }}
                                    <input type="hidden" id="num_proposta_transferegov" name="num_proposta_transferegov" value="{{$dados->num_proposta_transferegov}}">
                                     
                                            <button type="submit"  class="br-button  small mr-3" >
                                                {{$dados->valida_cnpj}} ({{$dados->num_propostas_cnpj_transferegov}})  
                                            </button> 
                                                                     </form>
                                                      
                                @else
                                    {{$dados->valida_cnpj}} ({{$dados->num_propostas_cnpj_transferegov}})     
                                @endif
                            @else
                                {{$dados->valida_cnpj}}
                            @endif
                        </td>    
                    </tr>  
                    @endforeach
                </tbody><!-- fechar tbody-->
            </table><!-- fechar table-->
        </div> <!-- table-responsive-sm -->  
     @endif              

     <div class="p-3 text-right">
        <button class="br-button primary mr-3" type="button" name="imprimir" value="Imprimir" onclick="window.print();">Imprimir
        </button>
        <button class="br-button danger mr-3" type="button"  onclick="javascript:window.history.go(-1)">Fechar
        </button>
      </div> 
       


      
     
    </div>   

                        
   

   

</div>
@endsection


