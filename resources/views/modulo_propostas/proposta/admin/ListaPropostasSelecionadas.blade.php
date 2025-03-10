@extends('layouts.app')

@section('scriptscss')
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/custom.css')}}"  media="screen" />
<link rel="stylesheet" type="text/css" href="{{ asset('css/relatorio_executivo.css') }}"  media="screen" > 

@endsection


@section('content')




<historico-navegacao
      :url="'{{ url('/') }}'"      
      :telanterior01="'Propostas'"  
      :telanterior02="'Consultar Propostas Selecionadas'"  
      :telatual="'Propostas Selecionadas'"
      >

</historico-navegacao>


<div class="main-content pl-sm-3 mt-5" id="main-content">
  
    <cabecalho-relatorios
        :titulo="'Propostas Selecionadas'"
        :subtitulo2="' {{count($propostas)}} propostas' "  
        
       barracompartilhar="false">

    </cabecalho-relatorios> 

    
    <div class="form-group">               
        
    @if(count($propostas) > 0)

        
        <div class="table-responsive-sm">
            <table class="table table-hover">
                <thead>
                    <tr class="text-center" >
                        <th>#</th>
                        <th>ID</th>
                        <th>UF</th>
                        <th>Município</th>
                        <th>CNPJ</th>                        
                        <th>Ente Público</th>                        
                        <th>Ação</th>                        
                        <th>Situação</th>
                        <th>Valor Repasse</th>                        
                        <th>Valor Transferegov</th>                        
                    </tr>
                </thead>
                <tbody> 
                    @foreach($propostas as $dados) 
                   
                        <tr class="text-center">   
                            <td>{{$loop->index+1}}</td> 
                       <td>{{$dados->proposta_id}}</td>
                       <td>{{$dados->sg_uf}}</td>
                        <td>{{$dados->ds_municipio}}</td>
                        <td>{{$dados->ente_publico_id}}</td>    
                        <td>{{$dados->txt_ente_publico}}</td>    
                        <td>{{$dados->acao_programa_id}}</td>                        
                        <td>{{$dados->txt_situacao_proposta}}</td>    
                        <td>{{number_format( ($dados->vlr_repasse), 2, ',' , '.')}}</td>    
                        <td>{{number_format( ($dados->vlr_final_transferegov), 2, ',' , '.')}}</td>    
                        
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
@endsection


