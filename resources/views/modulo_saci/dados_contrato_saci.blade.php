@extends('layouts.app')

@section('scriptscss')
<!--
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/saci/AdminLTE.min.css')}}"  media="screen" />
-->
@endsection


@section('content')

<historico-navegacao
      :url="'{{ url('/home') }}'"      
      :telanterior01="'SACI WEB'"      
      :telanterior02="'Consultar registros importados/Cadastrados'"      
      :link2="'{{ url("/saci/propostas/") }}'"    
      :telatual="'Registros Importados/Cadastrados'"
      >

</historico-navegacao>


<div class="main-content pl-sm-3 mt-5 container-fluid" id="main-content">
  
    <cabecalho-relatorios
            :titulo="'{{$contratoPAC->txt_empreendimento}}'"
            subtitulo1="Nº Contrato: {{$contratoPAC->cod_contrato}}"
            subtitulo2="{{$contratoPAC->dsc_municipio}}-{{$contratoPAC->txt_sigla_uf}}"
            subtitulo3="{{$contratoPAC->dsc_fase}}"
            :linkcompartilhar="'{{ url("/saci/contrato/pac/$contratoPAC->cod_contrato_pac") }}'"
            :barracompartilhar="true">

            <div class="text-center">
                @if($contratoPAC->cod_situacao_obra == 6 || $contratoPAC->cod_situacao_obra == 17 || $contratoPAC->cod_situacao_obra == 29)
                    <span class="feedback success text-center" role="alert">
                        <i class="fas fa-check-circle" aria-hidden="true"></i>
                        {{$contratoPAC->dsc_situacao_contrato }}
                    </span>                        
            @elseif($contratoPAC->cod_situacao_obra == 2 || $contratoPAC->cod_situacao_obra == 16 || $contratoPAC->cod_situacao_obra == 31)
                    <span class="feedback default text-center" role="alert">
                        <i class="fas fa-info-circle" aria-hidden="true"></i>
                        {{$contratoPAC->dsc_situacao_contrato }}
                    </span>     
                    
            @elseif($contratoPAC->cod_situacao_obra == 3 || $contratoPAC->cod_situacao_obra == 19 || $contratoPAC->cod_situacao_obra == 29)
                    <span class="feedback danger text-center" role="alert">
                        <i class="fas fa-info-circle" aria-hidden="true"></i>
                        {{$contratoPAC->dsc_situacao_contrato }}
                    </span>  
                
                @else
                    <span class="feedback warning text-center" role="alert">
                        <i class="fas fa-times-circle" aria-hidden="true"></i>
                        {{$contratoPAC->dsc_situacao_contrato }}
                    </span>    
                            
                @endif
            </div>

    </cabecalho-relatorios> 

    

      

  <div class="br-tab">
    <nav class="tab-nav">
      <ul>
        
        <li class="tab-item active">
          <button type="button" aria-label="Dados Gerais" data-panel="panel-dados-gerais" data-tooltip-text="Dados Gerais"><span class="name">
            <i class="fas fa-list" aria-hidden="true"></i>Dados Gerais</span>
        </button>
        </li>
        <li class="tab-item ">
            <button type="button" aria-label="Recursos" data-panel="panel-recursos" data-tooltip-text="Recursos"><span class="name">
              <i class="fas fa-list" aria-hidden="true"></i>Recursos</span>
          </button>
          </li>
          @if(!empty($contratoBaseCaixa))
            <li class="tab-item ">
                <button type="button" aria-label="Caixa" data-panel="panel-caixa" data-tooltip-text="Caixa"><span class="name">
                <i class="fas fa-list" aria-hidden="true"></i>Caixa</span>
            </button>
            </li>
            @endif
        
      </ul>
    </nav>
    
    <div class="tab-content">
      
      <div class="tab-panel active" id="panel-dados-gerais">
      </br>
        @include('modulo_saci.form_aux_dados_gerais')
      </div>
      <div class="tab-panel" id="panel-recursos">
        <p>Recursos</p>
      </div>
      @if(!empty($contratoBaseCaixa))
        <div class="tab-panel" id="panel-caixa">
            <div class="card">        
                <div class="card-body"> 
                @include('modulo_saci.form_aux_dados_contrato_saci_caixa') 
                </div>
            </div>
        </div>
        @endif
      
    </div>
  </div>



    
        
</div>

@endsection

@section('scriptsjs')
<script src="{{URL::asset('bootstrap/5/js/bootstrap.min.js')}}"></script>



@endsection


