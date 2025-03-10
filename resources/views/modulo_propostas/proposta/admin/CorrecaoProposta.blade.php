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
        :titulo="'{{$proposta->entePublico->txt_ente_publico}}'"
        :subtitulo1="'Protocolo: {{$proposta->txt_protocolo}}'"   
        :subtitulo2="'{{$proposta->entePublico->municipio->txt_nome_sem_acento}} - {{$proposta->entePublico->municipio->uf->txt_sigla_uf}}'"   
        :subtitulo3="'{{$proposta->selecao->txt_selecao}} - Seleção nº {{$proposta->selecao->num_selecao}}'"   
       
         barracompartilhar="true"
        >      


    </cabecalho-relatorios> 
    <form id="form_cancelar_proposta" class="form-horizontal" role="form" method="POST" action='{{ url("admin/proposta/correcao/salvar") }}'>         
        {{ csrf_field() }}
        <input type="hidden" id="proposta_id_corrigida" name="proposta_id_corrigida" value="{{$proposta->id}}">

        
    <div class="form-group">  
        <p>
            Este formulário permite que você corrija alguns dados da propostas desde que ela ainda não tenha sido selecionada.  Objerve sempre o objeto, 
            justificativa  da intervenção e o problema a ser resolvidor antes de alterar o PRograma e a Ação.
           </p>
         
                <cancelamento-proposta
                        url='{{ url("/") }}' 
                        v-bind:proposta="{{json_encode($proposta)}}"
                        v-bind:itens="{{json_encode($itensFinanciveis)}}"
                >

                

                </cancelamento-proposta>
        

       
        


    </div>
    </div>

       
       

          


</div>
@endsection


