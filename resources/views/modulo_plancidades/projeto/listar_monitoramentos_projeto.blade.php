@extends('layouts.app')

@section('content')
    <historico-navegacao :url="'{{ url('/home') }}'" 
        :telanterior02="'Consultar Monitoramento de Projeto'"
        :link2="'{{url('/plancidades/monitoramentos/projetos/consulta')}}'"
        :telanterior01="'PlanCidades'" 
        :link1="'{{url('/plancidades')}}'"
        :telatual="'Consultar Monitoramentos do Projeto'">
    </historico-navegacao>


    <div class="main-content pl-sm-3 mt-5 container-fluid" id="main-content">

        <cabecalho-relatorios :titulo="'Consultar Monitoramentos do Projeto'"  :linkcompartilhar="'{{ url('/') }}'"
            :barracompartilhar="false">
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
                                <th>Enunciado Projeto</th>
                                <th class="text-center">Periodo de Monitoramento</th>
                                <th class="text-center">Situação do Monitoramento</th>
                                <th class="text-center">Data Cadastro</th>
                                <th class="acao">Exibir</th>
                                <th class="acao">Editar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($monitoramentos as $monitoramento)
                                {{-- @if ($demanda->qtd_dias_atraso > 0) --}}

                                <tr class="conteudoTabela">
                                    <td>{{ $monitoramento->monitoramento_projeto_id}}</td>
                                    <td>{{ $monitoramento->txt_titulo_objetivo_estrategico_pei}}</td>
                                    <td class="text-center">{{ $monitoramento->txt_sigla_orgao}}</td>
                                    <td>{{ $monitoramento->txt_enunciado_projeto}}</td>
                                    <td class="text-center">{{ $monitoramento->dsc_periodo_monitoramento}}/{{ $monitoramento->num_ano_periodo_monitoramento}}</td>
                                    <td class="text-center">{{($monitoramento->txt_situacao_monitoramento != null ) ? ($monitoramento->txt_situacao_monitoramento) : ''}}</td>
                                    <td class="text-center">{{($monitoramento->created_at) ? date('d/m/Y',strtotime($monitoramento->created_at)) : ''}}</td>
                                    <td class="acao"><a class="br-button circle primary small"
                                        href='{{ route("plancidades.monitoramentos.projeto.show", [$monitoramento->monitoramento_projeto_id, 'monitoramentoId']) }}'><i
                                            class="fas fa-eye"></i></a>
                                    </td>
                                    <td class="acao" {{(($monitoramento->situacao_monitoramento_id == '3' ) || ($monitoramento->situacao_monitoramento_id == '5' ) || ($monitoramento->situacao_monitoramento_id == '6')) ? 'disabled' : '' }}><a class="br-button circle primary small"
                                        href='{{ route("plancidades.monitoramentos.projeto.editar", [$monitoramento->monitoramento_projeto_id, 'monitoramentoId']) }}'><i
                                            class="fas fa-pen"></i></a>
                                    </td>
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

            <a class="br-button danger mr-3" type="button" href="/plancidades/monitoramentos/projetos/consulta">Voltar
            </a>
        </div>

    </div>
@endsection
