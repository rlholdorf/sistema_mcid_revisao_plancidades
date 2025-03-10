@extends('layouts.app')



@section('content')



<historico-navegacao :url="'{{ url('/home') }}'" 
    :telanterior01="'Resultado Primário'" 
    :telanterior02="'Emendas RP8'" :telatual="'Lista de emendas CNPJ'">

</historico-navegacao>

<cabecalho-relatorios :titulo="'Lista de emendas CNPJ'" :barracompartilhar="false">


</cabecalho-relatorios>

<div class="main-content pl-sm-3 mt-5" id="main-content">

    <div class="table-responsive-sm">
        <table class="table table-hover">
            <thead>
                <tr class="text-center">
                    <th>Beneficiário</th>
                    <th>Nº Emenda</th>
                    <th>Programa</th>
                    <th>CNPJ</th>
                    <th>Ofício</th>
                    <th>Data do Ofício</th>
                    <th>Casa Legislativa</th>
                    <th>Comissão</th>
                    <th>Presidente</th>                    
                    <th>Ação Governo</th>
                    <th>Valor Emendas</th>
                    <th>Valor Tarifa</th>
                    <th>Valor Transferegov</th>                    
                    <th class="text-center">Ação</th>
                </tr>
            </thead>
            <tbody>
                @foreach($emendasCnpj as $dados)
                    <tr class="text-center align-middle">              

                    <td class="text-center align-middle">{{$dados->txt_beneficiario}} </td>
                    <td class="align-middle">{{$dados->num_emenda}}</td>
                    <td class="align-middle">{{$dados->cod_programa}}</td>
                    <td class="align-middle">{{$dados->txt_cnpj}}</td>
                    <td class="align-middle">{{$dados->oficioEmenda->txt_num_oficio_completo_congresso}}</td>
                    <td class="align-middle">{{date('d/m/Y',strtotime($dados->oficioEmenda->dte_oficio_congresso))}}</td>
                    <td class="align-middle">{{$dados->oficioEmenda->txt_casa_legislativa}}</td>
                    <td class="align-middle">{{$dados->oficioEmenda->txt_comissao}}</td>
                    <td class="align-middle">{{$dados->oficioEmenda->txt_presidente}}</td>
                    <td class="align-middle">{{$dados->oficioEmenda->cod_acao_governo}}</td>
                    <td  class="align-middle">{{number_format( ($dados->vlr_emenda), 2, ',' , '.')}}</td>    
                    <td  class="align-middle">{{number_format( ($dados->vlr_tarifa), 2, ',' , '.')}}</td>    
                    <td  class="align-middle">{{number_format( ($dados->vlr_transferegov), 2, ',' , '.')}}</td>    
                                       
                    <td>
                        
                        <button type="button" class="br-button circle secondary small mr-3" aria-label="Ícone ilustrativo" onclick='window.location.href="{{ url("/rp/rp8/validado/oficio/$dados->oficio_emenda_id")}}"'>
                            <i class="fas fa-eye" aria-hidden="true"></i>
                        </button>
                    </td>
                </tr>
                @endforeach
                <tr class="total">
                    <td  colspan="10" class="text-right"><strong>TOTAL</strong></td>    
                    <td class="text-center align-middle">{{number_format( $emendasCnpj->sum('vlr_emenda'), 2, ',' , '.')}}</td>
                    <td class="text-center align-middle">{{number_format( $emendasCnpj->sum('vlr_tarifa'), 2, ',' , '.')}}</td>
                    <td class="text-center align-middle">{{number_format( $emendasCnpj->sum('vlr_transferegov'), 2, ',' , '.')}}</td>
                </tr>
            </tbody><!-- fechar tbody-->
        </table><!-- fechar table-->
    </div> <!-- table-responsive-sm -->
    <div class="row">


        <div class="p-3 text-right">
            <button class="br-button primary mr-3" type="button" name="imprimir" value="Imprimir" onclick="window.print();">Imprimir
            </button>
            <button class="br-button danger mr-3" type="button" onclick="javascript:window.history.go(-1)">Fechar
            </button>
        </div>


    </div>
    @endsection