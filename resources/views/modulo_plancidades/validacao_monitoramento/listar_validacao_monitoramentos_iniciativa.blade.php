@extends('layouts.app')

@section('content')
<historico-navegacao :url="'{{ url('/home') }}'" 
    :telanterior02="'Consultar Monitoramentos Preenchidos'"
    :link2="'{{url('/plancidades/monitoramentos/validacao/consulta')}}'"
    :telanterior01="'PlanCidades'" 
    :link1="'{{url('/plancidades')}}'"
    :telatual="'Lista de Monitoramento de Iniciativas'">
</historico-navegacao>


<div class="main-content pl-sm-3 mt-5 container-fluid" id="main-content">

    <cabecalho-relatorios :titulo="'Lista de Monitoramento de Iniciativas'" :linkcompartilhar="'{{ url('/') }}'" :barracompartilhar="false">
    </cabecalho-relatorios>


    @if(count($monitoramentos) > 0)
        <div class="form-group row">
            <div class="col col-xs-12 col-sm-12">

                <div class="table-responsive">
                    <table class="table table-striped table-hover table-sm">
                        <thead class="text-center">
                            <tr class="text-center ">
                                <th>ID</th>
                                <th>Objetivo Estratégico</th>
                                <th class="text-center">Unidade Responsável</th>
                                <th>Denominação Iniciativa</th>
                                <th class="text-center">Período de Monitoramento</th>
                                <th class="text-center">Data Cadastro</th>
                                <th class="text-center">Situação do Monitoramento</th>
                                <th class="text-center acao">Exibir Monitoramento</th>
                                <th class="text-center acao">Alterar Situação</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($monitoramentos as $monitoramento)
                                {{-- @if ($demanda->qtd_dias_atraso > 0) --}}

                                <tr class="conteudoTabela">
                                    <td>{{ $monitoramento->monitoramento_iniciativa_id}}</td>
                                    <td>{{ $monitoramento->txt_titulo_objetivo_estrategico_pei}}</td>
                                    <td class="text-center">{{ $monitoramento->txt_sigla_orgao}}</td>
                                    <td>{{ $monitoramento->txt_enunciado_iniciativa}}</td>
                                    <td class="text-center">{{($monitoramento->dsc_periodo_monitoramento != null ) ? ($monitoramento->dsc_periodo_monitoramento)."/".($monitoramento->num_ano_periodo_monitoramento) : 'Não monitorado'}}</td>
                                    <td class="text-center">{{($monitoramento->created_at) ? date('d/m/Y',strtotime($monitoramento->created_at)) : ''}}</td>
                                    <td class="text-center">{{$monitoramento->txt_situacao_monitoramento}}</td>
                                    <td class="text-center acao"><a class="br-button circle primary small"
                                        href='{{ route("plancidades.monitoramentos.iniciativa.show", ['indicadorId' => $monitoramento->monitoramento_iniciativa_id]) }}' target="_blank"><i
                                            class="fas fa-eye"></i></a></td>
                                    <td class="text-center acao"><a class="br-button circle primary small" 
                                        href='{{ route("plancidades.monitoramentos.validacao.iniciativas.editar", ['monitoramentoIniciativaid' => $monitoramento->monitoramento_iniciativa_id]) }}'><i
                                            class="fas fa-pen"></i></a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @else
        <div>
            <p class="text-center"><strong>Não existem monitoramentos a serem analisados</strong></p>
        </div>
    @endif

    
    <div class="p-3 text-right">
        <button class="br-button primary mr-3" type="button" name="Imprimir" onclick="window.print();">Imprimir
        </button>

        <a class="br-button danger mr-3" type="button" href="{{url('plancidades/monitoramentos/validacao/consulta')}}">Voltar
        </a>
    </div>

</div>
@endsection