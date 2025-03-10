@extends('layouts.app')

@section('scriptscss')
<link rel="stylesheet" type="text/css" href="{{ asset('css/relatorio_executivo.css') }}" media="screen">
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/custom.css')}}"  media="screen" />

@endsection
@section('content')


    <historico-navegacao :url="'{{ url('/home') }}'" 
        :telanterior03="'Iniciativa {{$dados_monitoramento->iniciativa_id}}'"
        :link3="'{{url('/plancidades/monitoramentos/iniciativas/'.$dados_monitoramento->iniciativa_id)}}'"
        :telanterior02="'Consultar Monitoramento de Indicador'"
        :link2="'{{url('/plancidades/monitoramentos/iniciativas/consulta')}}'"
        :telanterior01="'PlanCidades'" 
        :link1="'{{url('/plancidades')}}'"
        :telatual="'Visualizar Monitoramento Iniciativa'">

    </historico-navegacao>


    <div class="main-content pl-sm-3 mt-5 container-fluid" id="main-content">

        <cabecalho-relatorios :botaoEditar='false' titulo="Monitoramento da Iniciativa"     
            subtitulo1="{{$dados_monitoramento->txt_enunciado_iniciativa}}"
            subtitulo2="Mês de Referência: {{$dados_monitoramento->dsc_periodo_monitoramento}}/{{$dados_monitoramento->num_ano_periodo_monitoramento}}"
            :linkcompartilhar="'{{ url("/") }}'"
            :barracompartilhar="false">
        </cabecalho-relatorios>

        <p>
            Clique em "Adicionar Apuração Global" para informar o resultado do monitoramento para a meta global (sem regionalizações). 
            Caso haja regionalizações, clique em "Adicionar Apuração da Regionalização", selecione a regionalização e digite o valor da apuração para aquele recorte.
            Se a meta global não for atingida e o indicador estiver no PPA, será necessário cadastrar, ao menos, uma restrição, clicando no botão "Adicionar restrição".
            Clique em Salvar para avançar para a próxima página, onde será necessário adicionar a avaliação qualitativa, composta por um item:
        </p>
        <p>
            - Análise Crítica: descrever as principais informações que influenciam o resultado do indicador.
        </p>
        <p>
            Caso queira salvar, mas não sair da tela de monitoramento, clique em Salvar. Se quiser salvar e voltar para a lista de monitoramentos desta iniciativa,
            clique em Finalizar. Caso não deseje continuar preenchendo, clique em voltar (as últimas informações preenchidas não serão salvas).
        </p>
         <hr>
    
        <form role="form" method="POST" action='{{ route('plancidades.monitoramentos.iniciativa.atualizar', ['monitoramentoId'=> $dados_monitoramento->monitoramento_iniciativa_id]) }}'>
            @csrf
            <editar-monitoramento-iniciativa
                :resumo-apuracao="{{json_encode($resumoApuracaoMeta)}}"
                :dados-monitoramento="{{json_encode($dados_monitoramento)}}"
                :dados-meta="{{json_encode($metaIniciativa)}}"
                :situacao-monitoramento="{{json_encode($situacao_monitoramento)}}"
                :url="'{{ url('/') }}'">

                <div class="titulo">
                    <h3>Metas da Iniciativa </h3>
                </div>
            
                <div class="row mt-3">
                    <div class="col col-xs-12 br-input">
                        <label>Meta </label>
                        <p>{{$metaIniciativa->txt_dsc_meta}}</p>
                    </div>                   
                </div>
                
                <div class="row mt-3">                    
                    <div class="col col-xs-12 col-sm-3 br-input">
                        <label>Valor esperado 2024 {{$dados_monitoramento->unidade_medida_simbolo}}</label>
                        <input id="vlr_esperado_ano_1" 
                            type="text" 
                            name="vlr_esperado_ano_1" 
                            class="bg-gray-10"  
                            value="{{$metaIniciativa->vlr_esperado_ano_1}}"
                            readonly = "true"                 
                            >
                    </div>
                    <div class="col col-xs-12 col-sm-3 br-input">
                        <label>Valor esperado 2025 {{$dados_monitoramento->unidade_medida_simbolo}}</label>
                        <input id="vlr_esperado_ano_2" 
                            type="text" 
                            name="vlr_esperado_ano_2"
                            class="bg-gray-10"     
                            value="{{$metaIniciativa->vlr_esperado_ano_2}}"
                            readonly = "true"                 
                            >
                    </div>  
                    <div class="col col-xs-12 col-sm-3 br-input">
                        <label>Valor esperado 2026 {{$dados_monitoramento->unidade_medida_simbolo}}</label>
                        <input id="vlr_esperado_ano_3" 
                            type="text" 
                            name="vlr_esperado_ano_3"
                            class="bg-gray-10"     
                            value="{{$metaIniciativa->vlr_esperado_ano_3}}"
                            readonly = "true"                 
                            >
                    </div>
                    <div class="col col-xs-12 col-sm-3 br-input">
                        <label>Valor esperado final {{$dados_monitoramento->unidade_medida_simbolo}}</label>
                        <input id="vlr_meta_final_cenario_alternativo" 
                            type="text" 
                            name="vlr_meta_final_cenario_alternativo"
                            class="bg-gray-10"
                            value="{{$metaIniciativa->vlr_meta_final_cenario_alternativo}}"
                            readonly = "true"                 
                            >
                    </div>                   
                </div>

                <div class="row mt-3">                    
                    <div class="col col-xs-12 col-sm-3 br-input">
                        <label>Valor apurado {{$dados_monitoramento->unidade_medida_simbolo}}</label>
                        <input
                            id="vlr_apurado_global" 
                            type="text" 
                            name="vlr_apurado_global"
                            class="bg-gray-10"  
                            placeholder="Clique no botão ao lado para monitorar"   
                            value="{{$dados_monitoramento->vlr_apurado_global}}"
                            readonly = "true"                 
                            >
                    </div>

                    <div class="col col-xs-12 col-sm-3 mt-4 pt-1" >
                        <button type="button" class="btn btn-primary btn-block" data-bs-toggle="modal" data-bs-target="#addApuracaoGlobal">
                            Adicionar Apuração Global
                        </button>
                    </div>
                </div>


                @if($metaIniciativa->bln_meta_regionalizada)
                    
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
                                    <th class="text-center">Ação</th>     
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($regionalizacaoMetas as $dados)
                                    <tr class="conteudoTabela">
                                        <td class="text-center">{{ $dados->regionalizacao->txt_regionalizacao }}</td>
                                        <td class="text-center">{{$dados->vlr_esperado_ano_1}}</td>
                                        <td class="text-center">{{$dados->vlr_esperado_ano_2}}</td>
                                        <td class="text-center">{{$dados->vlr_esperado_ano_3}}</td>
                                        <td class="text-center">{{$dados->vlr_meta_final_cenario_atual}}</td>
                                        <td class="text-center">{{($dados->vlr_apurado != null ) ? $dados->vlr_apurado : 'Não monitorado'}}</td>
                                        <td class="text-center" {{($dados->vlr_apurado != null ) ? '':'disabled' }}>
                                            <a class="br-button circle primary small" href='{{ route('plancidades.apuracaoMetaIniciativa.show', ['regionalizacaoMonitoramentoId' => $dados->id]) }}'><i class="fas fa-pen"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @if($resumoApuracaoMeta->qtd_metas_apuradas < $resumoApuracaoMeta->qtd_metas)
                        <button type="button" class="btn btn-primary btn-block" data-bs-toggle="modal" data-bs-target="#addApuracaoRegionalizada">
                            Adicionar Apuração da Regionalização
                        </button>
                    @endif
                @endif

                
                @if(count($restricoes)>0 && $dados_monitoramento->bln_restricao && $dados_monitoramento->bln_ppa)
                    <div class="titulo">
                        <h3>Restrições ao atingimento da meta</h3> 
                    </div>
                    
                        
                    <div class="table-responsive">
                        <table class="table table-striped table-hover table-sm">
                            <thead class="text-center">
                                <tr class="text-center ">
                                    <th>ID</th>                        
                                    <th>Iniciativa</th>
                                    <th>Restrições</th>
                                    <th>Detalhamento</th>
                                    <th>Providências</th>
                                    <th class="text-center">Valor Insuficiência</th>
                                    <th class="text-center">Ação</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($restricoes as $dados)
                                {{-- @if ($demanda->qtd_dias_atraso > 0) --}}
        
                                <tr class="conteudoTabela">
                                    <td>{{ $dados->id }}</td>
                                    <td>{{ $dados->monitoramentoIniciativa->iniciativa_id }}</td>
                                    <td>
                                        @if($dados->restricao_atingimento_meta_id == 99)
                                            Outras: {{ $dados->dsc_outra_restricao }}
                                        @else
                                            {{ $dados->restricaoAtingimentoMeta->txt_item_restricao_atingimento_meta }}
                                        @endif
                                    </td>
                                    <td>{{ $dados->dsc_detalhamento_restricao }}</td>
                                    <td>{{ $dados->dsc_providencias_superacao_restricao }}</td>
                                    <td class="text-center">{{number_format( ($dados->vlr_insuficiencia_recurso), 2, ',' , '.')}}</td>
                                    <td class="acao">
                                        {{-- @if(Auth::user()->id == $dados_monitoramento->user_id) --}}
                                            <botao-acao-icone  
                                                :url="'{{ url("/plancidades/monitoramentos/restricao_meta_iniciativa/excluir") }}'" 
                                                registro="{{$dados->id}}"                               
                                                mensagem="Deseja excluir a restrição?" 
                                                titulo="Atenção!!!"
                                                txtbotaoconfirma="Sim"
                                                txtbotaocancela="Cancelar"
                                                cssbotao="br-button circle danger small mr-3"
                                                cssicone="fas fa-trash" 
                                            ></botao-acao-icone> 
                                        {{-- @endif --}}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>         
                @endif        
                
                @if (!$dados_monitoramento->bln_meta_atingida && $dados_monitoramento->bln_ppa && $dados_monitoramento->vlr_apurado_global != null)
                    <button type="button" class="btn btn-warning btn-block" data-bs-toggle="modal" data-bs-target="#addRestricao">
                        Adicionar Restrição
                    </button>
                @endif
            </editar-monitoramento-iniciativa>
            <span class="br-divider sm my-3"></span>
        </form>

    </div>


    <!-- Modal Restrição -->
    <div class="modal fade" id="addRestricao" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <form role="form" method="POST" action='{{ url("/plancidades/monitoramentos/restricao_meta_iniciativa/salvar/".$dados_monitoramento->monitoramento_iniciativa_id) }}'>
                @csrf
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Adicionar Restrições ao atingimento da meta</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    
                    <input id="meta_iniciativa_id" 
                        type="hidden" 
                        name="meta_iniciativa_id"    
                        value="{{$metaIniciativa->id}}">
                <cadastro-restricao-meta :url="'{{ url('/') }}'">
                </cadastro-restricao-meta>
                </div>
                <div class="modal-footer">
                    <button class="br-button primary mr-3" type="submit" name="Salvar Edição" >Salvar
                    </button>
                    <button class="br-button danger mr-3" type="button" data-bs-dismiss="modal">Fechar
                    </button>
                    
                    
                </div>
            </form>
        </div>
        </div>
    </div>


    <!-- Modal Monitoramento Meta Global-->
    <div class="modal fade" id="addApuracaoGlobal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <form role="form" method="POST" action='{{ route('plancidades.monitoramentos.iniciativa.atualizar', ['monitoramentoId'=> $dados_monitoramento->monitoramento_iniciativa_id]) }}'>
                @csrf
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Adicionar Apuração da meta</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="meta_iniciativa_id" name="meta_iniciativa_id" value="{{$metaIniciativa->id}}">
                <cadastro-apuracao-iniciativa-global 
                    v-bind:meta_iniciativa="{{json_encode($metaIniciativa)}}" 
                    dsc_periodo_monitoramento="{{$dados_monitoramento->dsc_periodo_monitoramento}}"
                    num_ano_periodo_monitoramento="{{$dados_monitoramento->num_ano_periodo_monitoramento}}"
                    :url="'{{ url('/') }}'"
                >
                </cadastro-apuracao-iniciativa-global>
                </div>
                <div class="modal-footer">
                    <button class="br-button primary mr-3" type="submit" name="botao_salvar" :value="true" >Salvar
                    </button>
                    <button class="br-button danger mr-3" type="button" data-bs-dismiss="modal">Fechar
                    </button>
                    
                    
                </div>
            </form>
        </div>
        </div>
    </div>

    <!-- Modal Monitoramento Meta Regionalizada-->
    <div class="modal fade" id="addApuracaoRegionalizada" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <form role="form" method="POST" action='{{ route('plancidades.apuracaoMetaIniciativa.atualizar', ['monitoramentoId' => $dados_monitoramento->monitoramento_iniciativa_id]) }}'>
                    @csrf
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Adicionar Apuração da meta</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="meta_iniciativa_id" name="meta_iniciativa_id" value="{{$metaIniciativa->id}}">
                    <cadastro-apuracao-iniciativa-regionalizada
                        v-bind:meta_iniciativa="{{json_encode($metaIniciativa)}}"
                        :monitoramento_id="{{$dados_monitoramento->monitoramento_iniciativa_id}}"
                        dsc_periodo_monitoramento="{{$dados_monitoramento->dsc_periodo_monitoramento}}"
                        num_ano_periodo_monitoramento="{{$dados_monitoramento->num_ano_periodo_monitoramento}}"
                        :url="'{{ url('/') }}'"
                    >
                    </cadastro-apuracao-iniciativa-regionalizada>
                    </div>
                    <div class="modal-footer">
                        <button class="br-button primary mr-3" type="submit" name="Salvar Edição" >Salvar
                        </button>
                        <button class="br-button danger mr-3" type="button" data-bs-dismiss="modal">Fechar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
  
@endsection