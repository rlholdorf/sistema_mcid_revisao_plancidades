@extends('layouts.app')


@section('content')


<historico-navegacao :url="'{{ url('/home') }}'" :telanterior01="'Plancidades'"
    :telatual="'Cadastrar Iniciativa de Projetos'">

</historico-navegacao>


<div class="main-content pl-sm-3 mt-5 container-fluid" id="main-content">

    <cabecalho-relatorios :titulo="'titulo'"
        :subtitulo1="'titulo'" :linkcompartilhar="'{{ url("/") }}'"
        :barracompartilhar="false">
    </cabecalho-relatorios>
    <p>
        A presente ficha é para a descrição de iniciativas que apresentam como projetos, ou seja, iniciativas que
        possuem início e fim e se
        destinam à criação de um produto ou serviço único.
    </p>
    <form role="form" method="POST" action='{{ url("plancidades/iniciativa/projeto/salvar") }}'>
        @csrf
        <editar-monitoramento-projeto :url="'{{ url('/') }}'" >
        </editar-monitoramento-projeto>
    </form>

</div>




@endsection