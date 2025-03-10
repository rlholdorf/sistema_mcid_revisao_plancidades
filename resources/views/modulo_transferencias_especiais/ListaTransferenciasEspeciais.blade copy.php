@extends('layouts.app')

@section('scriptscss')
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/custom.css')}}" media="screen" />
<link rel="stylesheet" type="text/css" href="{{ asset('css/relatorio_executivo.css') }}" media="screen">

@endsection


@section('content')




<historico-navegacao :url="'{{ url('/home') }}'" :telanterior01="'Transferências Especiais'"
    :telanterior02="'Consultar Contratos'" :telatual="'Planos de Ações'">

</historico-navegacao>


<div class="main-content pl-sm-3 mt-5" id="main-content">

    <cabecalho-relatorios :titulo="'Lista de Planos de Ações'" :linkcompartilhar="'{{ url("/") }}'"
        barracompartilhar="false">
    </cabecalho-relatorios>

    <div class="form-group">
        <div class="table-responsive">
            <table class="table table-striped table-hover table-sm">
                <thead class="text-center">
                    <tr class="text-center ">
                        <th>Código</th>
                        <th>Ano</th>
                        <th class="text-center">UF</th>
                        <th class="text-center">Objeto</th>
                        <th class="text-center">Início Execução</th>
                        <th class="text-center">Término Execução</th>
                        <th class="text-center">Situação Análise</th>
                        <th class="text-center">Data Análise</th>
                        <th class="text-center">Data Envio</th>
                        <th class="text-center">Ação</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($planos as $plano)
                    <tr class="conteudoTabela">
                        <td>{{$plano->cod_plano_acao}}</td>
                        <td>{{$plano->num_ano_acao}}</td>
                        <td class="text-center">{{$plano->txt_uf_beneficiario}}</td>
                        <td class="text-center">{{$plano->dsc_objeto}}</td>
                        <td class="text-center">
                            {{($plano->dte_inicio_execucao_pt) ? date('d/m/Y',strtotime($plano->dte_inicio_execucao_pt)) : ''}}
                        </td>
                        <td class="text-center">
                            {{($plano->dte_fim_execucao_pt) ? date('d/m/Y',strtotime($plano->dte_fim_execucao_pt)) : ''}}
                        </td>
                        <td class="text-center">{{$plano->situacaoAnalise->txt_situacao_analise}}</td>
                        <td class="text-center">
                            {{($plano->dte_analise) ? date('d/m/Y',strtotime($plano->dte_analise)) : ''}}</td>
                        <td class="text-center">
                            {{($plano->dte_envio) ? date('d/m/Y',strtotime($plano->dte_envio)) : ''}}</td>
                        <td class="acao"><a class="br-button circle primary small"
                                href='{{ url("transferencias_especiais/plano_acao/$plano->cod_plano_acao")}}'><i
                                    class="fas fa-eye"></i></a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div align="center">
            {{ $planos->links() }}
        </div>


        <div class="p-3 text-right">
            <button class="br-button primary mr-3" type="submit" name="Pesquisar">Pesquisar
            </button>


            <button class="br-button danger mr-3" type="button" onclick="javascript:window.history.go(-1)">Voltar
            </button>
        </div>
    </div>
</div>
@endsection