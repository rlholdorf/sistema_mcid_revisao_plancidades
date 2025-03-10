@extends('layouts.app')

@section('scriptscss')
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/custom.css')}}" media="screen" />
<link rel="stylesheet" type="text/css" href="{{ asset('css/relatorio_executivo.css') }}" media="screen">

@endsection

@section('content')


<historico-navegacao :url="'{{ url('/home') }}'" :telanterior01="'Debentures'" :telanterior02="'Consultar projetos debentures'" :telatual="'Dados do Projeto'">

</historico-navegacao>


<div class="main-content pl-sm-3 mt-5 container-fluid" id="main-content">

    <cabecalho-relatorios titulo="Editar Condição Emissão"
       
        barracompartilhar="false"
        >

        
    </cabecalho-relatorios>

    <div class="form-group">

        <div class="card">
            <div class="card-header bg-violet-warm-60  text-white">Dados da Condição da Emissão</div>
            <div class="card-body">
                <form class="form-horizontal" role="form" method="POST" action='{{ url("apis/debenture/condicao_emissao/atualizar/") }}'>
                    {{ csrf_field() }}
                    <input type="hidden" id="condicao_emissao_id" name="condicao_emissao_id" value="{{$condicoesEmissao->id}}">

                    <cadastrar-condicao-emissao  
                        :url="'{{ url("/")}}'" 
                        v-bind:dados="{{json_encode($condicoesEmissao)}}"
                        :btnbuttons="false">
                    </cadastrar-condicao-emissao>
                    <div class="p-3 text-right">
                        <button class="br-button primary mr-3" type="submit" name="Salvar Edição">Salvar
                        </button>

                        <button class="br-button danger mr-3" type="button" onclick="window.location.href='/apis/debenture/emissao/{{$condicoesEmissao->emissao_debenture_id}}'">Voltar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>




@endsection