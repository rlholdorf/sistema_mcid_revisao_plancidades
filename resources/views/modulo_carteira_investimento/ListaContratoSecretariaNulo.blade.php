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
      :telatual="'Lista de Contratos de Secretaria não informada'"
      >

</historico-navegacao>

<cabecalho-relatorios
        :titulo="'Lista de Contratos de Secretaria não informada'"
        
       barracompartilhar="false">
    </cabecalho-relatorios> 

<div class="main-content" id="main-content" style="min-height: 100% width 100%">
    <div class="form-group">                     
        
        <div class="table-responsive-sm">
            <table class="table table-hover table-sm">
                <thead>
                    <tr class="text-center" >
                        <th>UF</th>
                        <th>Município</th>
                        <th>Nº Convênio</th>
                        <th>Código Contrato</th>
                        <th>Carteira MCID</th>
                        <th>Carteira MCID Ativa</th>
                        <th>Em andamento</th>
                        <th>Origem</th>
                        <th>Tipo Instrumento</th>
                        <th>Objeto</th>
                        <th class="text-center">Ação</th>                    
                    
                    </tr>
                </thead>
                <tbody> 
                    @foreach($contratos as $dados) 
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
                                <td>{{$dados->bln_carteira_mcid}}</td>
                                <td>{{$dados->bln_carteira_ativa_mcid}}</td>
                                <td>{{$dados->bln_carteira_andamento}}</td>
                                <td>{{$dados->txt_origem}}</td>
                                <td>{{$dados->txt_tipo_instrumento}}</td>
                                <td>{{$dados->dsc_objeto_instrumento}}</td>
                               
                                
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
       
           
            {{ $contratos->links() }}
       
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


