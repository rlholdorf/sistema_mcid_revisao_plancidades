@extends('layouts.app')

@section('scriptscss')
    <!-- Styles -->
    <link href="{{ asset('bootstrap/5/css/bootstrap.min.css') }}" rel="stylesheet">

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
        :titulo="'@if(empty($dadosBndes->txt_municipio_principal)){{$dadosBndes->txt_municipios_sem_tratamento}} @else {{$dadosBndes->txt_municipio_principal}}-{{$dadosBndes->sg_uf}} @endif '"
        :subtitulo1="'Andamento: {{$dadosBndes->txt_andamento}} ({{number_format( ($dadosBndes->prc_execucao_atual), 2, ',' , '.')}}%)'"   
        :subtitulo2="'Código SACI: {{$dadosBndes->cod_saci}}'"   
        :subtitulo3="'Código Cidades: {{$dadosBndes->cod_mcidades}}'"   
      
        @if($dadosBndes->txt_monitor_mcidades):subtitulo4="'Monitor: {{$dadosBndes->txt_monitor_mcidades}}'" @endif  
        :dataatualizacao="'{{date('d/m/Y',strtotime($dadosBndes->dte_atualizacao_sintese_atual_do_projeto))}}'"               
       
         barracompartilhar="true">

         <div class="text-center">
            @if($dadosBndes->situacao_obra_id  == 5 || $dadosBndes->situacao_obra_id  == 7 || $dadosBndes->situacao_obra_id  == 8|| $dadosBndes->situacao_obra_id  == 2)
                 <span class="feedback danger" role="alert">
                     <i class="fas fa-times-circle" aria-hidden="true"></i><strong>Situação Obras: </strong>{{$dadosBndes->txt_situacao_obra}}
                 </span>
             @elseif($dadosBndes->situacao_obra_id  == 9 || $dadosBndes->situacao_obra_id  == 10 || $dadosBndes->situacao_obra_id  == 11)
                 <span class="feedback success" role="alert">
                     <i class="fas fa-check-circle" aria-hidden="true"></i><strong>Situação Obras: </strong>{{$dadosBndes->txt_situacao_obra}}
                    </span>
            @elseif($dadosBndes->situacao_obra_id  == 2 || $dadosBndes->situacao_obra_id  == 3)
                 <span class="feedback warning" role="alert">
                     <i class="fas fa-exclamation-triangle" aria-hidden="true"></i><strong>Situação Obras: </strong>{{$dadosBndes->txt_situacao_obra}}
                    </span>
             @else 
                 <span class="feedback info" role="alert">
                     <i class="fas fa-info-circle" aria-hidden="true"></i><strong>Situação Obras: </strong>{{$dadosBndes->txt_situacao_obra}}
                    </span>
             @endif
            
             
            </div>

        

    </cabecalho-relatorios> 
    
    <form id="form_edit_bndes" name="form_edit_bndes"role="form" method="POST" action='{{ url("bndes/empreendimento/salvar") }}'>         
        {{ csrf_field() }}
        <input type="hidden" id="cod_bndes" name="cod_bndes" value="{{$dadosBndes->cod_bndes}}">

        <dados-empreendimento-bndes
                url='{{ url("/") }}'
                v-bind:tipousuario="{{json_encode($usuario->tipo_usuario_id)}}" 
                v-bind:dados="{{json_encode($dadosBndes)}}" 
                v-bind:municipiosbeneficiados="{{json_encode($municipiosBeneficiados)}}" 
                action='{{ url("/bndes/empreendimento/municipio_beneficiado/salvar") }}' 
                token="{{ csrf_token() }}"

                
            >

        </dados-empreendimento-bndes>
    </form>
       

</div>
@endsection


