@extends('layouts.app')

@section('scriptscss')
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/custom.css')}}"  media="screen" />
<link rel="stylesheet" type="text/css" href="{{ asset('css/relatorio_executivo.css') }}"  media="screen" > 

@endsection


@section('content')




<historico-navegacao
      :url="'{{ url('/home') }}'"      
      :telanterior01="'Propostas'"  
      :telatual="'Cadastrar Proposta'"
      >

</historico-navegacao>


<div class="main-content pl-sm-3 mt-5" id="main-content">

    <cabecalho-relatorios
        :titulo="'Cadastro de propostas discricionárias'"
        :subtitulo1="'{{$selecao->txt_selecao}}'"        
        :subtitulo3="'{{$selecao->dsc_objetivo_selecao}}'"        
         barracompartilhar="false">
    </cabecalho-relatorios> 
    <p>
        A inserção de propostas não se constitui garantia de acesso a recursos pelo
        proponente, que deverá atestar ciência da natureza discricionária da requisição
        conforme disponível no sítio eletrônico do 
        (<a href="https://www.gov.br/cidades/pt-br/cadastramento/saneamento/1a-selecao" target="_blank"> Ministério das Cidades</a>).
    </p>
    <form id="form_cad_proposta_snsa" class="form-horizontal" role="form" method="POST" action='{{ url("proposta/snsa/2018/salvar") }}'>         
        {{ csrf_field() }}

        <input type="hidden" id="txt_cpf_usuario" name="txt_cpf_usuario" value="{{Crypt::encrypt($cpfUsuario)}}">
        <input type="hidden" id="ente_publico_id" name="ente_publico_id" value="{{Crypt::encrypt($entePublicoId)}}"> 
        <input type="hidden" id="selecao_id" name="selecao_id" value="5">  
        <input type="hidden" id="moduloSistema" name="moduloSistema" value="{{$moduloSistema}}"> 
        
           <cadastrar-proposta-snsa-2218
                    :url="'{{ url('/') }}'" 
                    
                    v-bind:blnbotao="true"
                    
                    >

                    
                    

                    @if($moduloSistema == 1)
                    <button class="br-button danger mr-3" type="button" onclick="window.location.href='/selecao/andamento'">
                        Fechar
                        </button>
                    @else
                            <button class="br-button danger mr-3" type="button" onclick="javascript:window.history.go(-1)">
                                Fechar
                        </button>
                    @endif

            </cadastrar-proposta-snsa-2218> 
    </form>
</div>
@endsection


