@extends('layouts.app')

@section('scriptscss')
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/custom.css')}}" media="screen" />
<link rel="stylesheet" type="text/css" href="{{ asset('css/relatorio_executivo.css') }}" media="screen">

@endsection


@section('content')




<historico-navegacao :url="'{{ url('/home') }}'" :telanterior01="'Propostas'" :telatual="'Consultar Resultados'">

</historico-navegacao>


<div class="main-content pl-sm-3 mt-5" id="main-content" style="min-height: 100% width 100%">
    <div class="form-group">
        <cabecalho-relatorios :titulo="'Propopstas selecionadas'" barracompartilhar="false">
        </cabecalho-relatorios>


        <span class="br-divider my-3"></span>

        <p>
            Abaixo estão listadas as propostas selecionadas. O proponente da proposta deve ficar atento
            à`data de cadastro da Proposta de Trabalho no Transferegov.

        </p>

        <div class="table-responsive-sm">
            <table class="table table-hover">
                <thead>
                    <tr class="text-center">
                        <th>#</th>
                        <th>UF</th>
                        <th>Município</th>
                        <th>Protocolo</th>
                        <th>CNPJ</th>
                        <th>Ente Público</th>
                        <th>Etapa/Programa</th>
                        <th>Açäo</th>
                        <th>Data Resultado</th>
                        <th>Valor Repasse</th>
                        <th>Valor Final - Transferegov*</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($listaResultado as $dados)
                    <tr class="text-center">
                        <td>{{$loop->index+1}} </td>
                        <td>{{$dados->sg_uf}}</td>
                        <td>{{$dados->ds_municipio}}</td>
                        <td>{{$dados->txt_protocolo}}</td>
                        <td>{{$dados->ente_publico_id}}</td>
                        <td>{{$dados->txt_ente_publico}}</td>
                        <td>{{$dados->num_etapa}}ª Etapa {{$dados->txt_modalidade_participacao}} </td>
                        <td>{{$dados->acao_programa_id}}</td>
                        <td>{{date('d/m/Y',strtotime($dados->dte_resultado))}}</td>
                        <td class="text-center">{{number_format( ($dados->vlr_repasse), 2, ',' , '.')}}</td>
                        <td class="text-center">{{number_format( ($dados->vlr_final_transferegov), 2, ',' , '.')}}</td>
                    </tr>
                    @endforeach

                </tbody><!-- fechar tbody-->
            </table><!-- fechar table-->
        </div> <!-- table-responsive-sm -->


    </div>

    <span class="br-divider lg my-3"></span>
    <div class="p-3 text-right">
        <button class="br-button primary mr-3" type="button" name="imprimir" value="Imprimir"
            onclick="window.print();">Imprimir
        </button>
        <button class="br-button danger mr-3" type="button" onclick="javascript:window.history.go(-1)">Voltar
        </button>
    </div>







</div>
@endsection