@extends('layouts.app')

@section('scriptscss')
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/custom.css')}}"  media="screen" />
<link rel="stylesheet" type="text/css" href="{{ asset('css/relatorio_executivo.css') }}"  media="screen" > 

@endsection


@section('content')




<historico-navegacao
      :url="'{{ url('/home_bndes') }}'"      
      :telanterior01="'Bndes'"  
      :telanterior02="'Empreendimentos'"  
      :telatual="'Consultar Empreendimentos'"
      >

</historico-navegacao>


<div class="main-content pl-sm-3 mt-5" id="main-content" style="min-height: 100% width 100%">
  
    <cabecalho-relatorios
        :titulo="'Consulta Empreendimentos'"
        
       barracompartilhar="false">
    </cabecalho-relatorios> 

    
    <div class="form-group">               
       <p>
        Este formulário permite que você filtre os empreendimentos inseridos pelo BNDES. Ele permite que consulte
        um empreendimento específico, por meio do código do empreendimento no Ministério das Cidades, ou selecionando as opções de filtro, 
        nesse caso será disponibilizado uma lista de empreendimentos com base nos parâmetros selecionados.
       </p>
       <span class="br-divider my-3"></span>
       <form action="{{ url('/bndes/empreendimentos/pesquisar') }}" role="form" method="POST">
        {{ csrf_field() }}
            <div class="row">
                <filtro-empreendimentos-bndes
                url='{{ url("/") }}' >
                    </filtro-empreendimentos-bndes>      
                    
            </div>
            <h4>Lista de Empreendimentos <em>({{$dadosBndes->count()}} contratos)</em></h4> 
            <span class="br-divider sm my-3"></span>

            <div class="form-group">   
                <p>
                    Na tabela abaixo estão relacionados os empreendimentos que encontram-se com seguinte andamento: <strong>Em contratação, Iniciada, Ação Preparatória e Em licitação.</strong>  
                   </p>                  
        
                <div class="table-responsive-sm">
                    <table class="table table-hover table-sm">
                        <thead>
                            <tr class="text-center" >
                           
                                <th>Código Bndes</th>
                                <th>Código SACI</th>
                                <th>Código MDR</th>
                                <!--<th>Nº Carta-Consulta</th>-->
                                <th>Nº Contrato</th>
                                <th>Código Projeto</th>                        
                                <th>Nº Operações</th>                        
                                <th>Chamada</th>
                                <th>UF</th>                        
                                <th>Município</th>
                                <th>Modalidade</th>
                                <th>Andamento</th>
                                <th>Situação Contrato</th>
                                <th>Situação Obra</th>                                
                                <th>Novo PAC</th>
                                <th>Data Atualização</th>
                                <th class="text-center">Ação</th>                    
                            
                            </tr>
                        </thead>
                        <tbody> 
                            @foreach($dadosBndes as $dados) 
                           
                                <tr class="text-center">   
                               <td>{{$dados->cod_bndes}}</td>
                               <td>{{$dados->cod_saci}}</td>
                               <td>{{$dados->cod_mcidades}}</td>
                               <!--<td>{{$dados->num_carta_consulta_m_cidades}}</td>-->
                               <td>{{$dados->num_contrato}}</td>
                               <td>{{$dados->cod_projeto}}</td>
                               <td>{{$dados->num_operacoes}}</td>
                               <td>{{$dados->num_chamada}}</td>
                               <td>{{$dados->sg_uf}}</td>
                               <td>{{$dados->txt_municipio_principal}}</td>
                               <td>{{$dados->txt_modalidade}}</td>
                               <td>{{$dados->txt_andamento}}</td>
                               <td>{{$dados->txt_situacao_contrato}}</td>
                               <td>{{$dados->txt_situacao_obra}}</td>
                               <td>@if($dados->bln_novo_pac)Sim @else Não @endif</td>
                               <td>{{date('d/m/Y',strtotime($dados->dte_atualizacao_sintese_atual_do_projeto))}}</td>
                               
                               <td>
                                <button type="button" class="br-button circle secondary small mr-3" aria-label="Ícone ilustrativo" 
                                onclick='window.location.href="{{ url("/bndes/empreendimento/dados/$dados->cod_bndes")}}"'>
                                    <i class="fas fa-eye" aria-hidden="true"></i>
                                </button>
                               </td>
                               @endforeach
                        </tbody><!-- fechar tbody-->
                    </table><!-- fechar table-->
                </div> <!-- table-responsive-sm -->  
                     
            </div>   <!-- form-group -->

           
        </form>


      
     
    </div>   

                        
   

   

</div>
@endsection


