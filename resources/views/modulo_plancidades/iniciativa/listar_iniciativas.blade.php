@extends('layouts.app')

@section('content')
<historico-navegacao :url="'{{ url('/home') }}'" 
    :telanterior02="'Consultar Monitoramento de Iniciativa'"
    :link2="'{{url('/plancidades/monitoramentos/iniciativas/consulta')}}'"
    :telanterior01="'PlanCidades'" 
    :link1="'{{url('/plancidades')}}'"
    :telatual="'Lista de Iniciativas'">
</historico-navegacao>


<div class="main-content pl-sm-3 mt-5 container-fluid" id="main-content">

    <cabecalho-relatorios :titulo="'Lista de Iniciativas'" :linkcompartilhar="'{{ url('/') }}'" :barracompartilhar="false">
    </cabecalho-relatorios>


    <div class="form-group row">
        <div class="col col-xs-12 col-sm-12">

            <div class="table-responsive">
                <table class="table table-striped table-hover table-sm">
                    <thead class="text-center">
                        <tr class="text-center ">
                            <th scope="col">Objetivo Estratégico</th>
                            <th>Iniciativa</th>
                            <th>Indicador</th>
                            <th>PPA</th>
                            <th>PAC</th>
                            <th class="text-center ">Unidade Responsável</th>
                            <th class="text-center ">Último Monitoramento</th>
                            <th class="text-center ">Situação do Monitoramento</th>
                            <th class="text-center acao">Criar Novo</th>
                            <th class="text-center acao">Exibir Anteriores</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($iniciativas as $iniciativa)
                            {{-- @if ($demanda->qtd_dias_atraso > 0) --}}

                            <tr class="conteudoTabela">
                                <td>{{ $iniciativa->txt_titulo_objetivo_estrategico_pei}}</td>
                                <td>{{ $iniciativa->txt_enunciado_iniciativa}}</td>
                                <td>{{ $iniciativa->txt_denominacao_indicador}}</td>
                                <td class="text-center">{{$iniciativa->bln_ppa ? 'Sim' : 'Não'}}</td>
                                <td class="text-center">{{$iniciativa->bln_pac ? 'Sim' : 'Não'}}</td>
                                <td class="text-center">{{ $iniciativa->txt_sigla_orgao}}</td>
                                <td class="text-center">{{ ($iniciativa->monitoramento_created_at != null) ? ($iniciativa->periodo_ultimo_monitoramento) : 'Não monitorado'  }}</td>
                                <td class="text-center">{{ ($iniciativa->txt_situacao_monitoramento != null) ? ($iniciativa->txt_situacao_monitoramento) : ''  }}</td> 
                                <td class="text-center acao" {{(($iniciativa->situacao_monitoramento_id == null) || ($iniciativa->situacao_monitoramento_id == '5' ) || ($iniciativa->situacao_monitoramento_id == '6')) ? '' : 'disabled' }}><a class="br-button circle primary small"
                                    href='{{ route("plancidades.monitoramentos.iniciativa.criarMonitoramento", ['iniciativaId' =>$iniciativa->iniciativa_id]) }}'><i
                                        class="fas fa-plus"></i></a></td>
                                <td class="text-center acao"><a class="br-button circle primary small"
                                    href='{{ route('plancidades.monitoramentos.iniciativa.listarMonitoramentos', ['iniciativaId' => $iniciativa->iniciativa_id]) }}'><i
                                        class="fas fa-eye"></i></a></td>
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

        <a class="br-button danger mr-3" href="/plancidades/monitoramentos/iniciativas/consulta">Voltar
        </a>
    </div>

</div>
@endsection