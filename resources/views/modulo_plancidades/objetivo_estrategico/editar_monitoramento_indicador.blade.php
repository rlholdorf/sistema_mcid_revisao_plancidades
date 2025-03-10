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
        :telatual="'Monitoramento do Indicador'">

    </historico-navegacao>


    <div class="main-content pl-sm-3 mt-5 container-fluid" id="main-content">

        <cabecalho-relatorios :botaoEditar='false' :titulo="'Monitoramento do Indicador'" 
            subtitulo1="{{$dados_monitoramento->txt_denominacao_indicador}}"
            subtitulo2="Mês de Referência: {{$dados_monitoramento->dsc_periodo_monitoramento}}/{{$dados_monitoramento->num_ano_periodo_monitoramento}}"
            :linkcompartilhar="'{{ url("/") }}'"
            :barracompartilhar="false">
        </cabecalho-relatorios>
        <p>
            Clique em "Adicionar Apuração Global" para informar o resultado do monitoramento para a meta global (sem regionalizações). 
            Caso haja regionalizações, clique em "Adicionar Apuração da Regionalização", selecione a regionalização e digite o valor da apuração para aquele recorte.
            Se a meta global não for atingida e o indicador estiver no PPA, será necessário cadastrar, ao menos, uma restrição, clicando no botão "Adicionar restrição".
            Clique em Salvar para avançar para a próxima página, onde será necessário adicionar a avaliação qualitativa, composta por três itens:
        </p>
        <p>
            - Análise do Indicador: uma breve descrição sobre o andamento do indicador, citando os principais motivos para a os valores numéricos obtidos na apuração global.
        <br>
            - Causas e impedimentos para o não atingimento da meta: caso não se tenha atingido a meta, citar quais foram os principais impeditivos para tal situação.
        <br>        
            - Desafios e Próximos Passos:  o que se pretende fazer a seguir, em especial frente a eventuais não atingimentos das metas. Pode incluir informações relativas
            à necessidade de revisão do indicador.
        </p>
        <p>
            Caso queira salvar, mas não sair da tela de monitoramento, clique em Salvar. Se quiser salvar e voltar para a lista de monitoramentos deste indicador,
            clique em Finalizar. Caso não deseje continuar preenchendo, clique em voltar (as últimas informações preenchidas não serão salvas).
        </p>
        <hr>



        <form role="form" method="POST" action='{{ route("plancidades.monitoramentos.objetivoEstrategico.atualizar",['monitoramentoId'=> $dados_monitoramento->monitoramento_indicador_id]) }}'>
            @csrf
            <editar-monitoramento-indicador 
                :resumo-apuracao="{{json_encode($resumoApuracaoMeta)}}"
                v-bind:dados-monitoramento="{{json_encode($dados_monitoramento)}}"
                :meta-indicador="{{json_encode($metaIndicador)}}"
                :situacao-monitoramento="{{json_encode($situacao_monitoramento)}}"
                :url="'{{ url('/') }}'"
                >
                

                <div class="titulo">
                    <h3>Metas do Indicador </h3> 
                </div>

                <div class="row mt-3">
                    <div class="col col-xs-12 br-input">
                        <label>Meta </label>
                        <p>{{$metaIndicador->txt_dsc_meta}}</p>
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
                            placeholder="Clique no botão ao lado para monitorar"   
                            value="{{$dados_monitoramento->vlr_apurado_global}}"
                            readonly="true">
                    </div>
                    
                    <div class="col col-xs-12 col-sm-3 mt-4 pt-1" >
                        <button type="button" class="btn btn-primary btn-block" data-bs-toggle="modal" data-bs-target="#addApuracaoGlobal">
                            Adicionar Apuração Global
                        </button>
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
                                    <th class="text-center">Editar</th>
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
                                        <td class="text-center">{{$dados->regionalizacao->txt_regionalizacao}}</td>
                                        <td class="text-center">{{$dados->vlr_esperado_ano_1}}</td>
                                        <td class="text-center">{{$dados->vlr_esperado_ano_2}}</td>
                                        <td class="text-center">{{$dados->vlr_esperado_ano_3}}</td>
                                        <td class="text-center">{{$dados->vlr_meta_final_cenario_atual}}</td>
                                        <td class="text-center">{{($dados->vlr_apurado != null ) ? $dados->vlr_apurado : 'Não monitorado'}}</td>
                                        <td class="text-center" {{($dados->vlr_apurado != null ) ? '':'disabled' }}>
                                            <a  class="br-button circle primary small" href='{{ route("plancidades.apuracaoMetaIndicador.editar", ['regionalizacaoMetaId' => $dados->id]) }}'><i class="fas fa-pen"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @if($resumoApuracaoMeta->qtd_metas_apuradas<$resumoApuracaoMeta->qtd_metas)
                        <button type="button" class="btn btn-primary btn-block" data-bs-toggle="modal" data-bs-target="#addApuracaoRegionalizada">
                            Adicionar Apuração da Regionalização
                        </button>
                    @endif
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
                                    <th class="acao">Ação</th>
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
                                    
                                    <td class="acao">
                                        {{-- @if(Auth::user()->id == $dados_monitoramento->user_id) --}}
                                            <botao-acao-icone  
                                                :url="'{{ url("/plancidades/monitoramentos/restricao_meta_indicador/excluir")}}'" 
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
            </editar-monitoramento-indicador>
            <span class="br-divider sm my-3"></span>
        
        </form>

    </div>

    <!-- Modal Monitoramento Restrição-->
    <div class="modal fade" id="addRestricao" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <form role="form" method="POST" action='{{ route('plancidades.restricaoIndicador.salvar', ['monitoramentoIndicadorId' => $dados_monitoramento->monitoramento_indicador_id]) }}'>
                @csrf
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Adicionar Restrições ao atingimento da meta</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
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


    <!-- Modal Monitoramento Metas Regionalizadas-->
    <div class="modal fade" id="addApuracaoRegionalizada" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <form role="form" method="POST" action='{{ route('plancidades.apuracaoMetaIndicador.atualizar', ['monitoramentoId' => $dados_monitoramento->monitoramento_indicador_id]) }}'>
                @csrf
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Adicionar Apuração da meta</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="meta_indicador_id" name="meta_indicador_id" value="{{$metaIndicador->id}}">
                    
                <cadastro-apuracao-indicador-regionalizada 
                    v-bind:meta_indicador="{{json_encode($metaIndicador)}}"
                    monitoramento_id="{{$dados_monitoramento->monitoramento_indicador_id}}" 
                    dsc_periodo_monitoramento="{{$dados_monitoramento->dsc_periodo_monitoramento}}"
                    num_ano_periodo_monitoramento="{{$dados_monitoramento->num_ano_periodo_monitoramento}}"
                    :url="'{{ url('/') }}'" >
                </cadastro-apuracao-indicador-regionalizada>
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
        <form role="form" method="POST" action='{{ route("plancidades.monitoramentos.objetivoEstrategico.atualizar", ['monitoramentoId'=>$dados_monitoramento->monitoramento_indicador_id]) }}'>
            @csrf
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Adicionar Apuração da meta</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="meta_indicador_id" name="meta_indicador_id" value="{{$metaIndicador->id}}">
            <cadastro-apuracao-indicador-global 
                v-bind:meta_indicador="{{json_encode($metaIndicador)}}" 
                dsc_periodo_monitoramento="{{$dados_monitoramento->dsc_periodo_monitoramento}}"
                num_ano_periodo_monitoramento="{{$dados_monitoramento->num_ano_periodo_monitoramento}}"
                :url="'{{ url('/') }}'" >
            </cadastro-apuracao-indicador-global>
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
@endsection