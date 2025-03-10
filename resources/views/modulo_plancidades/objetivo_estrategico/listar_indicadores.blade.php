@extends('layouts.app')

@section('content')
<historico-navegacao :url="'{{ url('/home') }}'" 
    :telanterior02="'Consultar Monitoramento de Indicador'"
    :link2="'{{url('/plancidades/monitoramentos/objetivo_estrategico/consulta')}}'"
    :telanterior01="'PlanCidades'" 
    :link1="'{{url('/plancidades')}}'"
    :telatual="'Indicadores de Objetivos Estratégicos'">
</historico-navegacao>


<div class="main-content pl-sm-3 mt-5 container-fluid" id="main-content">

    <cabecalho-relatorios :titulo="'Lista de Indicadores de Objetivos Estratégicos'" :linkcompartilhar="'{{ url('/') }}'" :barracompartilhar="false">
    </cabecalho-relatorios>


    <div class="form-group row">
        <div class="col col-xs-12 col-sm-12">

            <div class="table-responsive">
                <table class="table table-striped table-hover table-sm">
                    <thead class="text-center">
                        <tr class="text-center ">
                            <th>Objetivo Estratégico</th>
                            <th>Denominação Indicador</th>
                            <th class="text-center ">Unidade Responsável</th>
                            <th class="text-center ">PPA</th>
                            <th class="text-center ">Último Monitoramento</th>
                            <th class="text-center ">Situação do Monitoramento</th>
                            <th class="text-center acao">Criar Novo</th>
                            <th class="text-center acao">Exibir Anteriores</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($indicadores as $indicador)
                            {{-- @if ($demanda->qtd_dias_atraso > 0) --}}

                            <tr class="conteudoTabela">
                                <td>{{ $indicador->txt_titulo_objetivo_estrategico_pei}}</td>
                                <td>{{ $indicador->txt_denominacao_indicador}}</td>
                                <td class="text-center">{{ $indicador->txt_sigla_orgao}}</td>
                                <td class="text-center">{{ $indicador->bln_ppa ? "Sim" : "Não"}}</td>
                                <td class="text-center">{{ ($indicador->monitoramento_created_at != null) ? ($indicador->periodo_ultimo_monitoramento) : 'Não monitorado'  }}</td>
                                <td class="text-center">{{ ($indicador->txt_situacao_monitoramento != null) ? ($indicador->txt_situacao_monitoramento) : ''  }}</td>
                                <td class="text-center acao" {{(($indicador->situacao_monitoramento_id == null) || ($indicador->situacao_monitoramento_id == '5' ) || ($indicador->situacao_monitoramento_id == '6')) ? '' : 'disabled' }}><a class="br-button circle primary small"
                                    href='{{ route("plancidades.monitoramentos.objetivoEstrategico.criarMonitoramento", ['indicadorId' =>$indicador->id]) }}'><i
                                        class="fas fa-plus"></i></a></td>
                                <td class="text-center acao"><a class="br-button circle primary small"
                                    href='{{ route('plancidades.monitoramentos.objetivoEstrategico.listarMonitoramentos', ['indicadorId' => $indicador->id]) }}'><i
                                        class="fas fa-eye"></i></a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table> {{-- Código para paginação funcionar com os filtros da query--}}
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