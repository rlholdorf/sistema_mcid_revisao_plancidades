@extends('layouts.app')

@section('scriptscss')
<link rel="stylesheet" type="text/css" href="{{ asset('css/relatorio_executivo.css') }}" media="screen">
@endsection
@section('content')


<historico-navegacao :url="'{{ url('/home') }}'" :telanterior01="'Plancidades'"
    :telatual="'Cadastrar Monitoramento de Indicador'">

</historico-navegacao>


<div class="main-content pl-sm-3 mt-5 container-fluid" id="main-content">

    <cabecalho-relatorios :titulo="'Cadastrar Monitoramento de Indicador'" :linkcompartilhar="'{{ url('/') }}'" :barracompartilhar="false">
    </cabecalho-relatorios>
    <p>
        Selecione um Objetivo Estratégico ou uma Unidade Responsável para filtrar os indicadores. 
        Depois, selecione um indicador e o período que deseja monitorar. 
        Por fim, adicione o valor apurado a análise do monitoramento, detalhando nos campos correspondentes
        a análise do indicador, as causas e impedimentos para o não atingimento da meta e quais serão os desafios e próximos passos.
    </p>

    <form role="form" method="POST" action='{{ route('plancidades.obj_est.salvar') }}'>
        @csrf
        <cadastro-monitoramento-indicador :editando="true" :cadastrando="true" :url="'{{ url('/') }}'">
        </cadastro-monitoramento-indicador>
        <span class="br-divider sm my-3"></span>
    </form>
</div>
@endsection