@extends('layouts.app')

@section('scriptscss')
<link rel="stylesheet" type="text/css" href="{{ asset('css/relatorio_executivo.css') }}" media="screen">
@endsection
@section('content')


<historico-navegacao :url="'{{ url('/home') }}'"
    :telatual="'PlanCidades'">

</historico-navegacao>


<div class="main-content pl-sm-3 mt-5 container-fluid" id="main-content">

    <cabecalho-relatorios :titulo="'Bem-vindo(a) ao PlanCidades'" 
        :linkcompartilhar="'{{ url("/") }}'"
        :barracompartilhar="false">
    </cabecalho-relatorios>
    

    <div class="row mb-5">
        <div class="col col-xs-12 col-sm-3 text-center">
            <h4>Planejar
            <p class="text-secondary">(em desenvolvimento)</p></h4>
        </div>

        <div class="col col-xs-12 col-sm-3">
            <div class="text-center">
                <h4>Monitorar</h4>
            </div>
            <div class="text-center">
                <a class="br-button primary mt-3 " href="{{ route('plancidades.monitoramentos.objetivoEstrategico.consultar') }}">Monitoramento de Indicadores</a>
            </div>
            <div class="text-center">
                <a class="br-button primary mt-3" href="{{ route('plancidades.monitoramentos.iniciativa.consultar') }}">Monitoramento de Iniciativas</a>
            </div>
            <div class="text-center">
                <a class="br-button primary mt-3" href="{{ route('plancidades.monitoramentos.projeto.consultar') }}">Monitoramento de Projetos</a>        
            </div>
        </div>
        
        <div class="col col-xs-12 col-sm-3">
            <div class="text-center">
                <h4>Revisar</h4>
            </div>
            <div class="text-center">
                <a class="br-button primary mt-3 " href="{{ route('plancidades.revisao.objetivoEstrategico.consultar') }}">Revisão de Indicadores</a>
            </div>
            <div class="text-center">
                <a class="br-button primary mt-3" href="{{ route('plancidades.revisao.iniciativa.consultar') }}">Revisão de Iniciativas</a>
            </div>
            <div class="text-center">
                <a class="br-button primary mt-3" href="{{ route('plancidades.revisao.projeto.consultar') }}">Revisão de Projetos</a>        
            </div>
        </div>

        <div class="col col-xs-12 col-sm-3 text-center">
            <div class="text-center">
                <h4>Links Úteis</h4>
            </div>
            <div class="text-center">
                <a class="br-button primary mt-3 " href="https://www.gov.br/cidades/pt-br" target="_blank">Página do Ministério na Internet</a>
            </div>
            <div class="text-center">
                <a class="br-button primary mt-3 " href="https://www.gov.br/cidades/pt-br/acesso-a-informacao/acoes-e-programas/governanca/planejamento-estrategico" target="_blank">Central do Planejamento Estratégico</a>
            </div>
            <div class="text-center">
                <a class="br-button primary mt-3 " href="https://www.siop.planejamento.gov.br/modulo/login/index.html#/" target="_blank">Sistema SIOP</a>
            </div>
        </div>
    </div>
    <div class="row text-center">
        <div class="col mt-5">
            <img style="width: 20%" src="{{URL::asset('/img/plancidades/logo_plan_cidades.png')}}" class="img-fluid" alt="">
            <p class="mt-3">
                Coordenação-Geral de Planejamento e Informação Estratégica (CGPI/DGE/SE)
                <br>
                plancidades@cidades.gov.br
                <br>
                Telefone: (61) 2034-4909
            </p>
        </div>
    </div>
</div>
@endsection