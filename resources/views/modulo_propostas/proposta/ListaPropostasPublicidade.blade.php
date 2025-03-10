@extends('layouts.app')

@section('scriptscss')
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/custom.css')}}"  media="screen" />
<link rel="stylesheet" type="text/css" href="{{ asset('css/relatorio_executivo.css') }}"  media="screen" > 

@endsection


@section('content')




<historico-navegacao
      :url="'{{ url('/home') }}'"      
      :telanterior01="'Propostas'"  
      :telanterior02="'Consultar Propostas'"  
      :telatual="'Propostas Apresentadas'"
      >

</historico-navegacao>


<div class="main-content pl-sm-3 mt-5" id="main-content">
  
    <cabecalho-relatorios
        :titulo="'Propostas Apresentadas'"
        @if($subtitulo1) :subtitulo1="'{{$subtitulo1}}'"@endif
        @if($subtitulo2) :subtitulo2="'{{$subtitulo2}}'"@endif
        :subtitulo3="'{{count($propostas)}} propostas'"
        
       barracompartilhar="false">

    </cabecalho-relatorios> 

    
    <div class="form-group">               
        
    @if(count($propostas) > 0)

        <div class="titulo"><h3>Propostas Cadastradas</h3> </div>  
        <div class="table-responsive-sm">
            <table class="table table-hover">
                <thead>
                    <tr class="text-center" >
                   
                        <th>ID</th>
                         <th>UF</th>
                        <th>Município</th>
                        <th>CNPJ</th>                        
                        <th>Ente Público</th>                        
                        <th>Açöes</th>                       
                        <th>Modalidade</th>
                        <th>Situação</th>
                        <th>Valor Cadastrado</th>
                        <th>Valor Selecionado</th>                         
                    </tr>
                </thead>
                <tbody> 
                    @foreach($propostas as $dados) 
                            <?php
                            
                            $transferegov = json_decode($dados->propostas_transferegov);
                             foreach($transferegov as $key => $value) {
                                if(!empty($value)){
                                    if($key == 0)
                                        $propostas_transferegov = $value;
                                    else
                                        $propostas_transferegov = $propostas_transferegov . ' - ' . $value;
                                }
                            }
                        
                            $acoesProposta = json_decode($dados->lista_acoes);
                            $acoes_propostas = '';
                            foreach($acoesProposta as $key => $value) {
                                if($key == 0)
                                    $acoes_propostas = $value;
                                else
                                    $acoes_propostas = $acoes_propostas . ' - ' . $value;
                            }

                            
                        // agora a nosa $arr possui os valores (3, 6, 9, 12)
                        ?>
                        <tr class="text-center">   
                       <td>{{$dados->proposta_id}}</td>
                       <td>{{$dados->sg_uf}}</td>
                        <td>{{$dados->ds_municipio}}</td>
                        <td>{{$dados->ente_publico_id}}</td>    
                        <td>{{$dados->txt_ente_publico}}</td>   
                        <td><?php print_r($acoes_propostas) ?></td> 
                        <td>{{$dados->txt_modalidade_participacao}}</td>                        
                        <td>{{$dados->txt_situacao_proposta}}</td>    
                        <td>{{number_format( ($dados->vlr_intervencao), 2, ',' , '.')}}</td>    
                        <td>{{number_format( ($dados->vlr_repasse), 2, ',' , '.')}}</td>    
                  
                    </tr>  
                    @endforeach
                </tbody><!-- fechar tbody-->
            </table><!-- fechar table-->
        </div> <!-- table-responsive-sm -->  
     @endif              

     <div class="p-3 text-right">
        
        <button class="br-button primary mr-3" type="button" name="imprimir" value="Imprimir" onclick="window.print();">Imprimir
        </button>
        <button class="br-button danger mr-3" type="button" onclick="javascript:window.history.go(-1)">Fechar
        </button>
      </div> 
   

</div>
@endsection


