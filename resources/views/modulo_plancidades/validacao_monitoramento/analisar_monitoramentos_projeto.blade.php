@extends('layouts.app')

@section('scriptscss')
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/custom.css')}}"  media="screen" />
<link rel="stylesheet" type="text/css" href="{{ asset('css/relatorio_executivo.css') }}"  media="screen" > 

@endsection

@section('content')


    <historico-navegacao :url="'{{ url('/home') }}'" 
        :telanterior03="'Lista de Monitoramento de Projetos'"
        :link3="'{{url('/plancidades/monitoramentos/validacao/projeto/listarMonitoramentos')}}'"
        :telanterior02="'Consultar Monitoramentos Preenchidos'"
        :link2="'{{url('/plancidades/monitoramentos/validacao/consulta')}}'"
        :telanterior01="'PlanCidades'" 
        :link1="'{{url('/plancidades')}}'"
        :telatual="'Visualizar Monitoramento do Projeto'">

    </historico-navegacao>


    <div class="main-content pl-sm-3 mt-5 container-fluid" id="main-content">

        <cabecalho-relatorios :botaoEditar='false' titulo="{{$dados_monitoramento->txt_enunciado_projeto}}" 
            :linkcompartilhar="'{{ url("/") }}'"
            :barracompartilhar="false">
        </cabecalho-relatorios>
        <p>
           Nesta página, você poderá visualizar todos os detalhes do monitoramento. Leia atentamente as informações prestadas e, em caso de dúvidas, contate o preenchedor.
           <br>
           Ao final da página, selecione a nova situação do monitoramento após análise, bem como registre eventuais necessidades de ajuste antes de salvar.
        </p>
        <hr>
        <form role="form" method="POST" action='{{ route("plancidades.monitoramentos.validacao.projetos.atualizar",['monitoramentoProjetoid'=> $monitoramentos->monitoramento_projeto_id]) }}'>
            @csrf
            <altera-situacao-monitoramento-projeto 
                v-bind:dados-monitoramento="{{json_encode($dados_monitoramento)}}"
                :dados-projeto="{{json_encode($dados_projeto)}}"
                :monitoramentos="{{json_encode($monitoramentos)}}"
                :usuario-preenchimento="{{json_encode($usuarioPreenchimento)}}"
                :etapas-projeto="{{json_encode($etapas_projeto)}}"
                :etapas-preenchidas="{{json_encode($etapasPreenchidas)}}" 
                :url="'{{ url('/') }}'"
                >
            </altera-situacao-monitoramento-projeto>
            <span class="br-divider sm my-3"></span>
        </form>
    </div>
@endsection