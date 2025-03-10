@extends('layouts.app')

@section('content')
<historico-navegacao :url="'{{ url('/home') }}'"
    :telanterior02="'Consultar Monitoramento de Indicador'"
    :link2="'{{url('/plancidades/monitoramentos/objetivo_estrategico/consulta')}}'"
    :telanterior01="'PlanCidades'" 
    :link1="'{{url('/plancidades')}}'"
    :telatual="'Listar Monitoramento de Indicador'">
</historico-navegacao>


<div class="main-content pl-sm-3 mt-5 container-fluid" id="main-content">

    <cabecalho-relatorios :titulo="'Lista de Monitoramento de Indicadores'" :linkcompartilhar="'{{ url('/') }}'" :barracompartilhar="false">
    </cabecalho-relatorios>


    <div class="form-group row">
        <div class="col col-xs-12 col-sm-12">

            <div class="table-responsive">
                <table class="table table-striped table-hover table-sm">
                    <thead class="text-center">
                        <tr class="text-center ">
                            <th>ID</th>
                            <th>Objetivo Estratégico</th>
                            <th class="text-center">Unidade Responsável</th>
                            <th>Denominação Indicador</th>
                            <th class="text-center">Período de Monitoramento</th>
                            <th class="text-center">Situação do Monitoramento</th>
                            <th class="text-center">Data Cadastro</th>
                            <th class="acao">Exibir</th>
                            <th class="acao">Editar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($monitoramentos as $monitoramento)
                            <tr class="conteudoTabela">
                                <td>{{ $monitoramento->monitoramento_indicador_id}}</td>
                                <td>{{ $monitoramento->txt_titulo_objetivo_estrategico_pei}}</td>
                                <td class="text-center">{{ $monitoramento->txt_sigla_orgao}}</td>
                                <td>{{ $monitoramento->txt_denominacao_indicador}}</td>
                                <td class="text-center">{{($monitoramento->dsc_periodo_monitoramento != null ) ? ($monitoramento->dsc_periodo_monitoramento)."/".($monitoramento->num_ano_periodo_monitoramento) : 'Não monitorado'}}</td>
                                <td class="text-center">{{($monitoramento->txt_situacao_monitoramento != null ) ? ($monitoramento->txt_situacao_monitoramento) : ''}}</td>
                                <td class="text-center">{{($monitoramento->created_at) ? date('d/m/Y',strtotime($monitoramento->created_at)) : ''}}</td>
                                <td class="acao"><a class="br-button circle primary small"
                                    href='{{ route("plancidades.monitoramentos.objetivoEstrategico.show", ['indicadorId' => $monitoramento->monitoramento_indicador_id]) }}'><i
                                        class="fas fa-eye"></i></a></td>
                                <td class="acao" {{(($monitoramento->situacao_monitoramento_id == '3' ) || ($monitoramento->situacao_monitoramento_id == '5' ) || ($monitoramento->situacao_monitoramento_id == '6')) ? 'disabled' : '' }}><a class="br-button circle primary small"
                                    href='{{ route("plancidades.monitoramentos.objetivoEstrategico.editar", ['indicadorId' => $monitoramento->monitoramento_indicador_id]) }}'><i
                                        class="fas fa-pen"></i></a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    




    <div class="p-3 text-right">
        <button class="br-button primary mr-3" type="button" name="Imprimir" onclick="window.print();">Imprimir
        </button>

        <a class="br-button danger mr-3" type="button" href="/plancidades/monitoramentos/objetivo_estrategico/consulta">Voltar
        </a>
    </div>

</div>
@endsection