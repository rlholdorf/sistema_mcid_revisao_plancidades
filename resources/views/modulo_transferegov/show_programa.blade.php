@extends('layouts.app')

@section('scriptscss')
<link rel="stylesheet" type="text/css" href="{{ asset('css/relatorio_executivo.css') }}" media="screen">
@endsection
@section('content')


<historico-navegacao :url="'{{ url('/home') }}'" 
    :telanterior01="'Consultar Programas'"
    :link1="'{{url('/transferegov/programas/listar')}}'">

</historico-navegacao>


<div class="main-content pl-sm-3 mt-5 container-fluid">

    <cabecalho-relatorios :titulo="'Programas TransfereGov'" 
    :linkcompartilhar="'{{ url("/") }}'"
        :barracompartilhar="false">
    </cabecalho-relatorios>


    <div class="">
        <div class="row mt-3">
            <div class="d-flex">
                <!-- coluna 1 -->
                <div class="column col-3">
                    <div class="row mt-3">
                        <div class="column col-12">
                            <label>Nome do Programa</label>
                            <p>{{ $programaCidades->nom_programa }}</p>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="column col-12">
                            <div class="row">
                                <div class="column col">
                                    <label>Número do Programa</label>
                                    <p>{{ $programaCidades->cod_programa }}</p>
                                </div>

                                <div class="column col">
                                    <label>Ação Orçamentária</label>
                                    <p>{{ $programaCidades->num_acao_orcamentaria }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="column col-12">
                            <div class="row">
                                <div class="column col">
                                    <label>Ano</label>
                                    <p>{{ $programaCidades->num_ano_disponiblizacao }}</p>
                                </div>

                                <div class="column col">
                                    <label>Situação</label>
                                    <p>{{ $programaCidades->dsc_sit_programa }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <span class="br-divider vertical mx-3"></span>

                <!-- coluna 2 -->
                <div class="column col-9">
                    <div class="row mt-3">
                        <div class="column col-4">
                            <label>Ações</label>
                            <p>{{$programaCidades->cod_acao}}</p>
                        </div>

                        <div class="column col-4">
                            <label for="rp">Resultado Primário</label>
                            <p>{{$programaCidades->txt_rp}}</p>
                        </div>

                        <div class="column col-4">
                            <label>Novo PAC</label>
                            <p>{{$programaCidades->bln_novo_pac ? 'Sim':'Não'}}</p>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="column col-12">
                            <label for="secretaria">Secretaria</label>
                            <p>{{$programaCidades->secretaria->txt_nome_secretaria}}</p>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="column col-6">
                            <label for="eixo">Eixo</label>
                            <p>{{$programaCidades->txt_eixo ? $programaCidades->txt_eixo : 'Não se aplica'}}</p>
                        </div>

                        <div class="column col-6">
                            <label for="subeixo">Sub-eixo</label>
                            <p>{{$programaCidades->txt_subeixo ? $programaCidades->txt_subeixo : 'Não se aplica'}}</p>
                        </div>
                    </div>

                    <div class="row mt-3">
                        
                        <div class="column col-6">
                            <label>Modalidade</label>
                            <p>{{$programaCidades->txt_modalidade ? $programaCidades->txt_modalidade : 'Não se aplica'}}</p>
                        </div>

                        <div class="column col-6">
                            <label>Grupo Modalidade</label>
                            <p>{{$programaCidades->txt_grupo_modalidade ? $programaCidades->txt_grupo_modalidade : 'Não se aplica'}}</p>
                        </div>
                    </div>

                    
                </div>
            </div>
        </div>

        <div class="row">
            <div class="column">
                <div class="p-3 text-right">
                    <a class="br-button primary mr-3" href="{{route('transferegov.editar', $programaCidades->cod_programa)}}">Editar
                    </a>

                    <button class="br-button danger mr-3" type="button"
                        onclick="javascript:window.history.go(-1)">Voltar
                    </button>
                </div>
            </div>
        </div>
    </div>

    
</div>
@endsection