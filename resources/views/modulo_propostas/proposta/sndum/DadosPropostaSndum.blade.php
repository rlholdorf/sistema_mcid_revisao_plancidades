@extends('layouts.app')

@section('scriptscss')
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/custom.css')}}"  media="screen" />
<link rel="stylesheet" type="text/css" href="{{ asset('css/relatorio_executivo.css') }}"  media="screen" > 

@endsection


@section('content')




<historico-navegacao
      :url="'{{ url('/home') }}'"      
      :telanterior01="'Ente Público'"  
      :telanterior02="'Propostas'"  
      :telatual="'Dados da Proposta'"
      >

</historico-navegacao>


<div class="main-content pl-sm-3 mt-5" id="main-content">

    <cabecalho-relatorios
        :titulo="'{{$proposta->txt_protocolo}}'"
       
        :subtitulo1="'{{$proposta->selecao->txt_selecao}}'"   
        :subtitulo2="'Cadastrada por: {{$proposta->usuario->name}}'"   
        :dataatualizacao="'{{date('d/m/Y',strtotime($proposta->updated_at))}}'"               
         barracompartilhar="true">
    </cabecalho-relatorios> 
    <p>
        A inserção de propostas não se constitui garantia de acesso a recursos pelo
        proponente, que deverá atestar ciência da natureza discricionária da requisição
        conforme modelo disponível no sítio eletrônico do Ministério das Cidades 
        (<a href="https://www.gov.br/cidades/pt-br/cadastramento/PS_Emendas_Discricionrias_4A_RP2_MOBILIDADE_rev3.pdf" target="_blank"> 7.1.1 do Manual disciplina rito para acesso aos recursos discricionários</a>).
    </p>
    <form id="form_cad_proposta_sndum" class="form-horizontal" role="form" method="POST" action='{{ url("proposta/sndum/editar") }}'>         
        {{ csrf_field() }}
        <input type="hidden" id="txt_cpf_usuario" name="txt_cpf_usuario" value="{{Crypt::encrypt($cpfUsuario)}}">
        <input type="hidden" id="ente_publico_id" name="ente_publico_id" value="{{Crypt::encrypt($entePublicoId)}}"> 
        <input type="hidden" id="ente_publico_id" name="proposta_id" value="{{$proposta->id}}">
            
        
           <cadastrar-proposta-sndum
                    :url="'{{ url('/') }}'" 
                    v-bind:proposta="{{json_encode($proposta)}}"
                    v-bind:itens="{{json_encode($itensFinanciveis)}}"
                    v-bind:blnbotao="false"

                    >
            
                    
                    
                    @if($moduloSistema == 1)
                    <button class="br-button danger mr-3" type="button" onclick="window.location.href='/selecao/ente_publico/propostas'">
                        Fechar
                        </button>
                    @else
                            <button class="br-button danger mr-3" type="button" onclick="javascript:window.history.go(-1)">
                                Fechar
                        </button>
                    @endif
                    

            </cadastrar-proposta-sndum> 



            
    </form>
</div>
@endsection


