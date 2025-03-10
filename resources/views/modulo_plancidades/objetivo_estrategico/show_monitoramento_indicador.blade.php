@extends('layouts.app')

@section('scriptscss')
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/custom.css')}}"  media="screen" />
<link rel="stylesheet" type="text/css" href="{{ asset('css/relatorio_executivo.css') }}"  media="screen" > 

@endsection

@section('content')


    <historico-navegacao :url="'{{ url('/home') }}'" 
        :telanterior03="'Indicador {{$dados_monitoramento->indicador_objetivo_estrategico_id}}'"
        :link3="'{{url('/plancidades/monitoramentos/objetivo_estrategico/indicadores/'.$dados_monitoramento->indicador_objetivo_estrategico_id)}}'"
        :telanterior02="'Consultar Monitoramento de Indicador'"
        :link2="'{{url('/plancidades/monitoramentos/objetivo_estrategico/consulta')}}'"
        :telanterior01="'PlanCidades'" 
        :link1="'{{url('/plancidades')}}'"
        :telatual="'Visualizar Monitoramento Indicador'">

    </historico-navegacao>


    <div class="main-content pl-sm-3 mt-5 container-fluid" id="main-content">

        <cabecalho-relatorios :botaoEditar='false' 
            :titulo="'Monitoramento do Indicador'" 
            subtitulo1="{{$dados_monitoramento->txt_denominacao_indicador}}"
            subtitulo2="Mês de Referência: {{$dados_monitoramento->dsc_periodo_monitoramento}}/{{$dados_monitoramento->num_ano_periodo_monitoramento}}"
            :linkcompartilhar="'{{ url("/") }}'"
            :barracompartilhar="false">
        </cabecalho-relatorios>
        <p>
           Nesta página, você poderá visualizar todos os detalhes do monitoramento.
        </p>
        <hr>

        <show-monitoramento-indicador 
            :resumo-apuracao="{{json_encode($resumoApuracaoMeta)}}"
            v-bind:dados-monitoramento="{{json_encode($dados_monitoramento)}}"
            :meta-indicador="{{json_encode($metaIndicador)}}"
            :situacao-monitoramento="{{json_encode($situacao_monitoramento)}}"
            :url="'{{ url('/') }}'"
            >
            

            <div class="titulo">
                <h3>Metas do Indicador </h3> 
            </div>

            {{-- @if($dados_monitoramento->bln_meta_atingida)
                <div class="alert alert-success text-center" role="alert">
                    Meta Atingida
                </div>
            @elseif($dados_monitoramento->bln_restricao) 
                <div class="alert alert-danger text-center" role="alert">
                    Meta não atingida
                </div>
            @else
                <div class="alert alert-secondary  text-center" role="alert">
                    Monitoramento da meta em preenchimento
                </div>
            @endif --}}

            <div class="row mt-3">
                <div class="col col-xs-12 br-input">
                    <label>Meta </label>
                    <p> {{$metaIndicador->txt_dsc_meta}} </p>
                </div>                   
            </div>

            <div class="row mt-3">                    
                <div class="col col-xs-12 col-sm-3 br-input">
                    <label>Valor esperado 2024 {{$dados_monitoramento->unidade_medida_simbolo}}</label>
                    <input id="vlr_esperado_ano_1" 
                        type="text" 
                        name="vlr_esperado_ano_1"
                        class="bg-gray-10"    
                        value="{{$metaIndicador->vlr_esperado_ano_1}}"
                        readonly = "true"                 
                        >
                </div>
                <div class="col col-xs-12 col-sm-3 br-input">
                    <label>Valor esperado 2025 {{$dados_monitoramento->unidade_medida_simbolo}}</label>
                    <input id="vlr_esperado_ano_2" 
                        type="text" 
                        name="vlr_esperado_ano_2"
                        class="bg-gray-10"    
                        value="{{$metaIndicador->vlr_esperado_ano_2}}" 
                        readonly = "true"                
                        >
                </div>  
                <div class="col col-xs-12 col-sm-3 br-input">
                    <label>Valor esperado 2026 {{$dados_monitoramento->unidade_medida_simbolo}}</label>
                    <input id="vlr_esperado_ano_3" 
                        type="text" 
                        name="vlr_esperado_ano_3"
                        class="bg-gray-10"    
                        value="{{$metaIndicador->vlr_esperado_ano_3}}"   
                        readonly = "true"              
                        >
                </div>
                <div class="col col-xs-12 col-sm-3 br-input">
                    <label>Valor esperado final {{$dados_monitoramento->unidade_medida_simbolo}}</label>
                    <input id="vlr_meta_final_cenario_alternativo" 
                        type="text" 
                        name="vlr_meta_final_cenario_alternativo"
                        class="bg-gray-10"    
                        value="{{$metaIndicador->vlr_meta_final_cenario_alternativo}}"  
                        readonly = "true"               
                        >
                </div>                   
            </div>

            {{--CAMPOS VALOR APURADO TOTAL--}}                
            <div class="row mt-3 mb-3">                    
                <div class="col col-xs-12 col-sm-3 br-input">
                    <label>Valor apurado {{$dados_monitoramento->unidade_medida_simbolo}}</label>
                    <input
                        id="vlr_apurado" 
                        type="text" 
                        name="vlr_apurado" 
                        class="bg-gray-10"   
                        value="{{$dados_monitoramento->vlr_apurado_global}}"
                        readonly="true">
                </div>
            </div>

            @if($metaIndicador->bln_meta_regionalizada)
                <div class="titulo">
                    <h5>Regionalização das metas</h5>
                </div>

                <div class="table-responsive">
                    <table class="table table-striped table-hover table-sm">
                        <thead class="text-center">
                            <tr class="text-center">
                                <th class="text-center">Regionalização</th>
                                <th class="text-center">Valor Meta 2024 {{$dados_monitoramento->unidade_medida_simbolo}}</th>
                                <th class="text-center">Valor Meta 2025 {{$dados_monitoramento->unidade_medida_simbolo}}</th>
                                <th class="text-center">Valor Meta 2026 {{$dados_monitoramento->unidade_medida_simbolo}}</th>
                                <th class="text-center">Valor Meta 2027 {{$dados_monitoramento->unidade_medida_simbolo}}</th>
                                <th class="text-center">Valor Apurado {{$dados_monitoramento->unidade_medida_simbolo}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($regionalizacaoMetas as $dados)
                                {{-- @if ($demanda->qtd_dias_atraso > 0) --}}
                                @if ($dados_monitoramento->num_ano_periodo_monitoramento == 2024 && ($dados->vlr_esperado_ano_1 > $dados->vlr_apurado))
                                    <tr class="conteudoTabela">
                                @else
                                    <tr class="conteudoTabela">
                                @endif
                                    <td class="text-center">{{ $dados->regionalizacao->txt_regionalizacao }}</td>
                                    <td class="text-center">{{$dados->vlr_esperado_ano_1}}</td>
                                    <td class="text-center">{{$dados->vlr_esperado_ano_2}}</td>
                                    <td class="text-center">{{$dados->vlr_esperado_ano_3}}</td>
                                    <td class="text-center">{{$dados->vlr_meta_final_cenario_atual}}</td>
                                    <td class="text-center">{{($dados->vlr_apurado != null ) ? $dados->vlr_apurado : 'Não monitorado'}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif

            @if(count($restricoes)>0 && $dados_monitoramento->bln_ppa)
                <div class="titulo">
                    <h3>Restrições ao atingimento da meta</h3> 
                </div>

                <div class="table-responsive">
                    <table class="table table-striped table-hover table-sm">
                        <thead class="text-center">
                            <tr class="text-center ">
                                <th>ID</th>                        
                                <th>Indicador de Objetivo Estratégico</th>
                                <th>Restrições</th>
                                <th>Detalhamento</th>
                                <th>Providências</th>
                                <th >Valor Insuficiência</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($restricoes as $dados)
                            {{-- @if ($demanda->qtd_dias_atraso > 0) --}}
    
                            <tr class="conteudoTabela">
                                <td>{{ $dados->id }}</td>
                                <td>{{ $dados->monitoramentoIndicador->indicador_objetivo_estrategico_id }}</td>
                                <td>
                                    @if($dados->restricao_atingimento_meta_id == 99)
                                        Outras: {{ $dados->dsc_outra_restricao }}
                                    @else
                                        {{ $dados->restricaoAtingimentoMeta->txt_item_restricao_atingimento_meta }}
                                    @endif
                                </td>
                                <td>{{ $dados->dsc_detalhamento_restricao }}</td>
                                <td>{{ $dados->dsc_providencias_superacao_restricao }}</td>
                                <td>{{number_format( ($dados->vlr_insuficiencia_recurso), 2, ',' , '.')}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>          
            @endif
        </show-monitoramento-indicador>
        <span class="br-divider sm my-3"></span>

    </div>
@endsection