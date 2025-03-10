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
      :telanterior03="'Dados da Propostas'"  
      :telatual="'Selecionar Proposta'"
      >
     
</historico-navegacao>


<div class="main-content pl-sm-3 mt-5" id="main-content">

    <cabecalho-relatorios
        :titulo="'{{$proposta->entePublico->txt_ente_publico}}'"
        :subtitulo1="'Protocolo: {{$proposta->txt_protocolo}}'"   
        :subtitulo2="'{{$proposta->entePublico->municipio->txt_nome_sem_acento}} - {{$proposta->entePublico->municipio->uf->txt_sigla_uf}}'"   
        :subtitulo3="'Valor Intervenção Cadastrado R$ {{number_format( ($proposta->vlr_intervencao), 2, ',' , '.')}}'"   
        :subtitulo4="'{{$proposta->selecao->txt_selecao}} - Seleção nº {{$proposta->selecao->num_selecao}}'"   
        
          
        @if($proposta->updated_at)
            :dataatualizacao="'{{date('d/m/Y',strtotime($proposta->updated_at))}}'"               
        @elseif($proposta->created_at)
            :dataatualizacao="'{{date('d/m/Y',strtotime($proposta->updated_at))}}'"               
        @endif
         barracompartilhar="true"
        >

         <div class="text-center">
            @if($proposta->situacao_proposta_id  == 4 || $proposta->situacao_proposta_id  == 6)
                 <span class="feedback danger" role="alert">
                     <i class="fas fa-times-circle" aria-hidden="true"></i>{{$proposta->situacaoProposta->txt_situacao_proposta}}
                 </span>
             @elseif($proposta->situacao_proposta_id  == 2 || $proposta->situacao_proposta_id  == 3)
                 <span class="feedback success" role="alert">
                     <i class="fas fa-check-circle" aria-hidden="true"></i>{{$proposta->situacaoProposta->txt_situacao_proposta}}
                    </span>
            @elseif($proposta->situacao_proposta_id  == 1)
                 <span class="feedback warning" role="alert">
                     <i class="fas fa-exclamation-triangle" aria-hidden="true"></i>{{$proposta->situacaoProposta->txt_situacao_proposta}}
                    </span>
             @else 
                 <span class="feedback info" role="alert">
                     <i class="fas fa-info-circle" aria-hidden="true"></i>{{$proposta->situacaoProposta->txt_situacao_proposta}}
                    </span>
             @endif
            
             
            </div>
    


    </cabecalho-relatorios> 
   
    
        
    <div class="form-group">  
        

       <selecionar-proposta
       :url="'{{ url('/') }}'" 
       v-bind:proposta="{{json_encode($proposta)}}"
       v-bind:itens="{{json_encode($itensFinanciveis)}}"
       v-bind:acoes="{{json_encode($acoes)}}"
       
       v-bind:blnbotao="true"
        >

       </selecionar-proposta>

        <span class="br-divider lg my-3"></span>

       
       
       

          


</div>
@endsection


