@extends('layouts.app')

@section('content')


<historico-navegacao
      :url="'{{ url('/home') }}'"      
      :telanterior01="'debentures e Reidi'"      
      :telanterior01="'Consultar Reidi'"      
      :telatual="'Lista Reidi'"
      >

</historico-navegacao>


<div class="main-content pl-sm-3 mt-5 container-fluid" id="main-content">

  <cabecalho-relatorios
            :titulo="'Lista Reidi'"            
            :linkcompartilhar="'{{ url("/") }}'"
            :barracompartilhar="false">
  </cabecalho-relatorios>

  @if(count($projetos) > 0)

        
        <div class="table-responsive-sm">
            <table class="table table-hover">
                <thead>
                    
                   <tr class="text-center" >
                   
                    <th> 
                        ID
                    </th>
                    <th>UF</th>
                    <th>Setor</th>
                    <th>Titular do Projeto</th>
                    <th>Nome do Projeto</th>
                    <th>Número e ano portaria</th>
                    <th>Data da Portaria</th>
                    <th>Valor do Investimento</th>
                    <th>Valor do Projeto sem Reidi</th>
                    <th>Valor do Projeto com Reidi</th>
                    <th>Valor Estimado do benefício</th>                    
                    <th>Última Atualização</th>                    
                    <th class="text-center">Ação</th>                    
                    
                    </tr>
                </thead>
                <tbody> 
                    @foreach($projetos as $dados) 
                        
                            @if($dados->updated_at)
                                <tr class="text-center" >
                            @else
                                <tr class="text-center table-danger" >
                            @endif                       
                                <td>
                                    {{$dados->id}}        
                                </td>
                                <td>{{$dados->sg_uf}}</td>
                                <td>{{$dados->txt_setor_projeto}}</td>  
                                <td>{{$dados->txt_titular_projeto}}</td>  
                                <td>{{$dados->txt_nome_projeto}}</td>  
                                <td>{{$dados->num_ano_portaria}}</td>  
                                <td> {{date('d/m/Y',strtotime($dados->dte_portaria))}} </td>    
                                <td>{{number_format( ($dados->vlr_investimento_projeto), 2, ',' , '.')}}</td>    
                                <td>{{number_format( ($dados->vlr_projeto_sem_reidi), 2, ',' , '.')}}</td>    
                                <td>{{number_format( ($dados->vlr_projeto_com_reidi), 2, ',' , '.')}}</td>    
                                <td>{{number_format( ($dados->vlr_estimado_beneficio), 2, ',' , '.')}}</td>   
                                <td>@if($dados->updated_at) {{date('d/m/Y',strtotime($dados->updated_at))}} @endif</td>    
                                
                                <td class="p-3 text-right">
                                    <button type="button" class="br-button circle secondary small mr-3" aria-label="Ícone ilustrativo" 
                                    onclick='window.location.href="{{ url("debentures_reidi/projeto/reidis/$dados->id")}}"'>
                                        <i class="fas fa-eye" aria-hidden="true"></i>
                                    </button> 

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
      

      <button class="br-button danger mr-3" type="button" onclick="javascript:window.history.go(-1)">Voltar
      </button>
    </div> 



</div>




@endsection