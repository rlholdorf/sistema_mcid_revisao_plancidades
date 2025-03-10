@extends('layouts.app')



@section('content')



<historico-navegacao :url="'{{ url('/home') }}'" 
        :telanterior01="'Resultado Primário'" 
        :telanterior02="'Ofícios'" :telatual="'Lista de ofícios'">

</historico-navegacao>

<cabecalho-relatorios 
    :titulo="'Lista de ofícios'"  
    :barracompartilhar="false">

   
</cabecalho-relatorios>

<div class="main-content pl-sm-3 mt-5" id="main-content">

    <div class="table-responsive-sm">
        <table class="table table-hover">
            <thead>
                <tr class="text-center">
                    <th>Nº Ofício</th>
                    <th>Ofício</th>
                    <th>Data do Ofício</th>
                    <th>Casa Legislativa</th>
                    <th>Comissão</th>
                    <th>Presidente</th>
                    <th>Programa</th>
                    <th>Ação Governo</th>
                    <th>Situação</th>
                    <th>Data Validação</th>
                    <th class="text-center">Ação</th>
                </tr>
            </thead>
            <tbody>
                @foreach($dadosOficio as $dados)
                    @if($dados->situacao_oficio_id == 2)
                        <tr class="text-center table-success align-middle">
                    @elseif($dados->situacao_oficio_id == 4)
                            <tr class="text-center bg-green-cool-vivid-20 align-middle">
                    @elseif($dados->situacao_oficio_id == 3 || $dados->situacao_oficio_id == 7)
                        <tr class="text-center table-danger align-middle">
                    @elseif($dados->situacao_oficio_id == 5 || $dados->situacao_oficio_id == 6)
                            <tr class="text-center table-warning align-middle">
                    @else
                        <tr class="text-center align-middle">
                    @endif
                   
                    <td class="text-center align-middle">{{$dados->num_oficio_congresso}}                    </td>
                    <td class="align-middle">{{$dados->txt_num_oficio_completo_congresso}}</td>
                    <td class="align-middle">@if($dados->dte_oficio_congresso)
                        {{date('d/m/Y',strtotime($dados->dte_oficio_congresso))}} @endif
                    </td>
                    <td class="align-middle">{{$dados->txt_casa_legislativa}}</td>
                    <td class="align-middle">{{$dados->txt_comissao}}</td>
                    <td class="align-middle">{{$dados->txt_presidente}}</td>
                    <td class="align-middle">{{$dados->cod_programa}}</td>
                    <td class="align-middle">{{$dados->cod_acao_governo}}</td>
                    <td class="align-middle">{{$dados->txt_situacao_oficio}}</td>
                    <td class="align-middle">@if($dados->dte_analise)
                        {{date('d/m/Y',strtotime($dados->dte_analise))}} @endif
                    </td>
                    <td>
                        @if($dados->situacao_oficio_id == 1)
                            <button type="button" class="br-button circle secondary small mr-3" aria-label="Ícone ilustrativo" 
                            onclick='window.location.href="{{ url("rp/arquivo/validar/rp8/oficio/$dados->oficio_emenda_id")}}"'>
                                <i class="fas fa-eye" aria-hidden="true"></i>
                            </button> 
                        @else
                            <button type="button" class="br-button circle secondary small mr-3" aria-label="Ícone ilustrativo" 
                            onclick='window.location.href="{{ url("/rp/rp8/validado/oficio/$dados->oficio_emenda_id")}}"'>
                                <i class="fas fa-eye" aria-hidden="true"></i>
                            </button>  
                        @endif
                    </td>
                </tr>

                @endforeach
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