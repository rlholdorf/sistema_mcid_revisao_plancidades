@extends('layouts.app')

@section('scriptscss')
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/custom.css')}}"  media="screen" />
<link rel="stylesheet" type="text/css" href="{{ asset('css/relatorio_executivo.css') }}"  media="screen" > 

@endsection


@section('content')




<historico-navegacao
      :url="'{{ url('/home') }}'"      
      :telanterior01="'Carteira Invesrtimento'"  
      :telanterior02="'Contratos'"        
      :telanterior03="'Consultar Contratos'"  
      :link3="'{{url('carteira_investimento/contratos/consultar')}}'"
      :telatual="'Lista de Contratos'"
      >

</historico-navegacao>

<cabecalho-relatorios
        :titulo="'Lista de Contratos'"
        subtitulo1="{{$dadosContratos->total()}} contratos"
       barracompartilhar="false">
    </cabecalho-relatorios> 

<div class="main-content" id="main-content" style="min-height: 100% width 100%">
    <div class="form-group">  
        <div class="p-3 text-right">  
            @if($dadosContratos->lastPage() == $dadosContratos->currentPage())                 
            {{$dadosContratos->total()}}/{{$dadosContratos->total()}} contratos 
            @else
                {{$dadosContratos->count() * $dadosContratos->currentPage()}}/{{$dadosContratos->total()}} contratos 
            @endif
        </div>
        <div class="table-responsive-sm">
            <table class="table table-hover table-sm">
                <thead>
                    <tr class="text-center" >
                        <th>UF</th>
                        <th>Município</th>
                        <th>Nº Convênio</th>
                        <th>Nº Contrato</th>
                        <th>Carteira Ativa</th>
                        <th>Objeto</th>
                        <th>Em andamento</th>
                        <th>Tipo Instrumento</th>
                        <th>Secretaria</th>   
                        <th>Situaçáo do Contrato</th>                                             
                        <th>Situaçáo do Objeto</th>                                             
                        <th>Execuçäo Física</th>                        
                        <th>Valor Investimento</th>
                        <th>Data Atualização</th>
                        <th class="text-center">Ação</th>                    
                    
                    </tr>
                </thead>
                <tbody> 
                    @foreach($dadosContratos as $dados) 
                        @if($dados->cod_situacao_objeto_mcid == 7)
                            <tr class="text-center table-danger align-middle">
                        @elseif($dados->cod_situacao_objeto_mcid == 2)
                            <tr class="text-center table-success align-middle">
                        @elseif(($dados->cod_situacao_objeto_mcid == 6) || ($dados->cod_situacao_objeto_mcid == 4))
                            <tr class="text-center table-warning align-middle">
                        @elseif(($dados->cod_situacao_objeto_mcid == 1) || ($dados->cod_situacao_objeto_mcid == 5))
                            <tr class="text-center table-secondary align-middle">
                        @else
                            <tr class="text-center">   
                        @endif
                                <td>{{$dados->txt_uf}}</td>
                                <td>{{$dados->txt_municipio}}</td>
                                <td>{{$dados->num_convenio}}</td>
                                <td>{{$dados->cod_contrato}}</td>
                                <td>{{$dados->bln_carteira_ativa_mcid}}</td>
                                <td>{{$dados->dsc_objeto_instrumento}}</td>
                                <td>{{$dados->bln_carteira_andamento}}</td>
                                <td>{{$dados->txt_tipo_instrumento}}</td>
                                <td>{{$dados->txt_sigla_secretaria}}</td>
                                <td>{{$dados->dsc_situacao_contrato_mcid}}</td>
                                <td>{{$dados->dsc_situacao_objeto_mcid}}</td>
                                <td>{{number_format($dados->prc_execucao_fisica, 2, ',' , '.')}}</td>
                                <td>{{number_format($dados->vlr_investimento, 2, ',' , '.')}}</td>
                                <td>
                                    @if($dados->dte_controle)
                                        {{date('d/m/Y',strtotime($dados->dte_controle))}}
                                    @else
                                    {{date('d/m/Y',strtotime($dados->dte_carga))}}
                                    @endif
                                
                                </td>
                                
                                <td>    
                                             
                                    @if($dados->cod_contrato) 
                                    <button type="submit" class="br-button circle secondary mr-3" aria-label="Ícone ilustrativo"
                                    onclick='window.location.href="{{ url("/carteira_investimento/contrato/$dados->cod_contrato")}}"'>
                                        <i class="fas fa-eye" aria-hidden="true"></i>
                                    </button>                          
                                @else
                                    <button type="submit" class="br-button circle secondary mr-3" aria-label="Ícone ilustrativo"
                                    onclick='window.location.href="{{ url("/carteira_investimento/convenio/$dados->num_convenio")}}"'>
                                        <i class="fas fa-eye" aria-hidden="true"></i>
                                    </button>                          
                                @endif                        
                                </td>
                       @endforeach
                </tbody><!-- fechar tbody-->
            </table><!-- fechar table-->
        </div> <!-- table-responsive-sm -->  
        
    <div align="center">
       
           
            {{ $dadosContratos->links() }}
       
    </div>
        
          

  

        <div class="p-3 text-right">
            <button class="br-button primary mr-3" type="button" name="imprimir" value="Imprimir" onclick="window.print();">Imprimir
            </button>
            <button class="br-button danger mr-3" type="button"  onclick="javascript:window.history.go(-1)">Voltar
            </button>
          </div> 
     
    </div>   <!-- form-group -->

                        
   

   

</div>
@endsection


