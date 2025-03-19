@extends('layouts.app')

@section('scriptscss')
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/custom.css')}}"  media="screen" />
<link rel="stylesheet" type="text/css" href="{{ asset('css/relatorio_executivo.css') }}"  media="screen" > 

@endsection

@section('content')


    <historico-navegacao :url="'{{ url('/home') }}'" 
        :telanterior02="'Consultar Projetos para Revisão'"
        :link2="'{{url('/plancidades/revisao/projeto/consulta')}}'"
        :telanterior01="'PlanCidades'" 
        :link1="'{{url('/plancidades')}}'"
        :telatual="'Revisar Projeto Estratégico'">

    </historico-navegacao>


    <div class="main-content pl-sm-3 mt-5 container-fluid" id="main-content">

        <cabecalho-relatorios :botaoEditar='false' titulo="{{$dadosProjeto->txt_enunciado_projeto}}"
            :linkcompartilhar="'{{ url("/") }}'"
            :barracompartilhar="false">
        </cabecalho-relatorios>
        <p>
           Nesta página, você poderá visualizar todas as informações do Projeto e suas etapas.
           <br>
           Ao lado de cada atributo, existe um campo para informar alterações que devam ser feitas no projeto.
           <br>
           Ao final da página, clique em Salvar Revisão para enviar para análise.
        </p>
        
        <hr>
        <!-- <form role="form" method="POST" action='{{ route("plancidades.revisao.objetivoEstrategico.salvar") }}'> -->
            <!-- @csrf -->
            <editar-revisao-projeto 
            :url="'{{ url('/') }}'"
            :dados-projeto="{{json_encode($dadosProjeto)}}"
            :dados-etapas="{{json_encode($dadosEtapas)}}"
            >

            <button type="button" class="btn btn-warning btn-block"> <!-- Adicionar modal no estilo data-bs-toggle="modal" data-bs-target="#addRestricao" ?-->
                        Adicionar Etapa
                    </button> <!-- Teria que ver como que apresentaríamos as novas etapas, caso elas existam, porque viriam de duas tabelas diferentes -->


            </editar-revisao-projeto>
            <span class="br-divider sm my-3"></span>
        <!-- </form> -->
    </div>
@endsection