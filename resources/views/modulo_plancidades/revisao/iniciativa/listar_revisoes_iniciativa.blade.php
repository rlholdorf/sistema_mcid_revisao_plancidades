@extends('layouts.app')

@section('content')
<historico-navegacao :url="'{{ url('/home') }}'"
    :telanterior02="'Consultar Revisões de Iniciativa'"
    :link2="'{{url('/plancidades/revisao/iniciativa/consulta')}}'"
    :telanterior01="'PlanCidades'" 
    :link1="'{{url('/plancidades')}}'"
    :telatual="'Listar Revisões de Iniciativa'">
</historico-navegacao>


<div class="main-content pl-sm-3 mt-5 container-fluid" id="main-content">

    <cabecalho-relatorios :titulo="'Lista de Revisões de Iniciativas'" :linkcompartilhar="'{{ url('/') }}'" :barracompartilhar="false">
    </cabecalho-relatorios>


    <div class="form-group row">
        <div class="col col-xs-12 col-sm-12">

            <div class="table-responsive">
                <table class="table table-striped table-hover table-sm">
                    <thead class="text-center">
                        <tr class="text-center ">
                            <th>ID</th>
                            <th>Objetivo Estratégico</th>
                            <th>Denominação Iniciativa</th>
                            <th class="text-center">Unidade Responsável</th>
                            <th class="text-center">Período de Revisão</th>
                            <th class="text-center">Situação da Revisão</th>
                            <th class="text-center">Data Cadastro</th>
                            <th class="acao">Exibir</th>
                            <th class="acao">Editar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($revisoes as $revisao)
                            <tr class="conteudoTabela">
                                <td>{{ $revisao->revisao_iniciativa_id}}</td>
                                <td>{{ $revisao->txt_titulo_objetivo_estrategico_pei}}</td>
                                <td>{{ $revisao->iniciativa_id }} - {{ $revisao->txt_enunciado_iniciativa}}</td>
                                <td class="text-center">{{$revisao->txt_sigla_orgao}}</td>
                                <td class="text-center">{{($revisao->dsc_periodo_monitoramento	 != null ) ? ($revisao->dsc_periodo_monitoramento	)."/".($revisao->num_ano_periodo_revisao) : 'Não monitorado'}}</td>
                                <td class="text-center">{{($revisao->txt_situacao_revisao != null ) ? ($revisao->txt_situacao_revisao) : ''}}</td>
                                <td class="text-center">{{($revisao->created_at) ? date('d/m/Y',strtotime($revisao->created_at)) : ''}}</td>
                                <td class="acao"><a class="br-button circle primary small"
                                    href='{{ route("plancidades.revisao.iniciativa.show", ['revisaoId' => $revisao->revisao_iniciativa_id]) }}'><i
                                        class="fas fa-eye"></i></a></td>
                                <td class="acao" {{(($revisao->situacao_revisao_id == '3' ) || ($revisao->situacao_revisao_id == '5' ) || ($revisao->situacao_revisao_id == '6')) ? 'disabled' : '' }}><a class="br-button circle primary small"
                                    href='{{ route("plancidades.revisao.iniciativa.editar", ['revisaoId' => $revisao->revisao_iniciativa_id]) }}'><i
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

        <a class="br-button danger mr-3" type="button" href="/plancidades/revisao/objetivo_estrategico/consulta">Voltar
        </a>
    </div>

</div>
@endsection