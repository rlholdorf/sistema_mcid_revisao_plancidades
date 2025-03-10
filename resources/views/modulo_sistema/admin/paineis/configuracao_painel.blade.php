@extends('layouts.app')

@section('scriptscss')
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/custom.css')}}"  media="screen" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/relatorio_executivo.css') }}"  media="screen" > 
@endsection


@section('content')  
   
        <historico-navegacao
        :url="'{{ url('/home') }}'"
        :telanterior01="'Administrador'"
        :telanterior02="'Painéis'"
        :telanterior03="'Lista de Painéis'"
        :telatual='"Paínel {{$dadosPainel->txt_nome_painel}}"'
        >
        </historico-navegacao>  
        <cabecalho-relatorios
                :titulo='"Paínel {{$dadosPainel->txt_nome_painel}}"'
                :subtitulo1="'Configurações'"
                @if($dadosPainel->updated_at) 
                    :dataatualizacao="'{{date('d/m/Y',strtotime($dadosPainel->updated_at))}}'"
                @else 
                    :dataatualizacao="'{{date('d/m/Y',strtotime($dadosPainel->created_at))}}'"
                 @endif
                 
                :linkcompartilhar="'{{ url("/admin/painel/show/$dadosPainel->id") }}'"
                :barracompartilhar="true">
        </cabecalho-relatorios> 

    <div class="main-content pl-sm-3 mt-5" id="main-content">

        <form role="form" method="POST" action='{{ url("admin/painel/atualizar") }}'>
            @csrf
            <input type="hidden" id="painel_id" name="painel_id" value="{{$dadosPainel->id}}">
            <configuracao_painel 
            :url="'{{ url('/') }}'"
            v-bind:dados="{{json_encode($dadosPainel)}}" 
            ></configuracao_painel>
                

                <div class="p-3 text-right">
                    <button class="br-button primary mr-3" type="submit" name="salvar">Salvar
                    </button>
                    <button class="br-button danger mr-3" type="button" onclick="javascript:window.history.go(-1)">Voltar
                    </button>
                  </div> 

        </form>     
       
    </div>

@endsection


