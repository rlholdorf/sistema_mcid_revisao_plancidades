@extends('layouts.app')

@section('content')

<historico-navegacao
      :url="'{{ url('/home') }}'"      
      :telanterior01="'Balanço PAC'"      
      :telanterior02="'Consultar contratos'"      
      :telatual="'Dados do Contrato'"
      >

</historico-navegacao>


<div class="main-content pl-sm-3 mt-5 container-fluid" id="main-content" style="max-width:'100%';">
  
    <cabecalho-relatorios
            :titulo="'{{$dadosContrato->nome_empreendimento}}'"
            subtitulo1="Nº Contrato: {{$dadosContrato->cod_contrato}}"
            subtitulo2="{{$dadosContrato->secretaria}}"
            subtitulo3="Execução Física: {{$dadosContrato->prc_execucao_fisica}}%"
            subtitulo4="Fonte: {{$dadosContrato->txt_sub_fonte}}"
            :linkcompartilhar="'{{ url("/pac/contrato/$dadosContrato->cod_contrato") }}'"
            :barracompartilhar="true">



            <div class="text-center">
                @if($dadosContrato->dsc_situacao_objeto_mcid == 'CONCLUIDA')
                    <span class="feedback success text-center" role="alert">
                        <i class="fas fa-check-circle" aria-hidden="true"></i>
                        {{$dadosContrato->dsc_situacao_objeto_mcid }}
                    </span>                        
            @elseif($dadosContrato->dsc_situacao_objeto_mcid == 'NAO INICIADA')
                    <span class="feedback warning text-center" role="alert">
                        <i class="fas fa-info-circle" aria-hidden="true"></i>
                        {{$dadosContrato->dsc_situacao_objeto_mcid }}
                    </span>     
                    
            @elseif($dadosContrato->dsc_situacao_objeto_mcid == 'ATRASAD' || $dadosContrato->dsc_situacao_objeto_mcid == 'PARALISADA')
                    <span class="feedback danger text-center" role="alert">
                        <i class="fas fa-info-circle" aria-hidden="true"></i>
                        {{$dadosContrato->dsc_situacao_objeto_mcid }}
                    </span>  
                
                @else
                    <span class="feedback info text-center" role="alert">
                        <i class="fas fa-times-circle" aria-hidden="true"></i>
                        {{$dadosContrato->dsc_situacao_objeto_mcid }}
                    </span>    
                            
                @endif
            </div>

    </cabecalho-relatorios> 

    <div class="br-tab">
      <nav class="tab-nav">
        <ul>
          <li class="tab-item active">
            <button type="button" data-panel="panel-dados-projeto-icon"><span class="name"><span class="d-flex flex-column flex-sm-row"><span class="icon mb-1 mb-sm-0 mr-sm-1"><i class="fas fa-image" aria-hidden="true"></i></span><span class="name">DADOS DO PROJETO</span></span></span></button>
          </li>

          @if(!empty($proposta))
          <li class="tab-item">
            <button type="button" data-panel="panel-proposta-icon"><span class="name"><span class="d-flex flex-column flex-sm-row"><span class="icon mb-1 mb-sm-0 mr-sm-1"><i class="fas fa-image" aria-hidden="true"></i></span><span class="name">PROPOSTA</span></span></span></button>
          </li>
          @endif

          <!-- etapas -->
          @if(count($dadosContrato->etapasPacs)>0 || count($metas)> 0)
          <li class="tab-item">
            <button type="button" data-panel="panel-etapa-icon"><span class="name"><span class="d-flex flex-column flex-sm-row"><span class="icon mb-1 mb-sm-0 mr-sm-1"><i class="fas fa-image" aria-hidden="true"></i></span>
              @if($dadosContrato->cod_fase_pac == 9)
                <span class="name">ETAPAS E METAS</span></span></span></button>
                @else
                 <span class="name">METAS E ETAPAS</span></span></span></button>
                @endif
          </li>
          @endif
          @if(!empty($dadosFinanceiros))
          <li class="tab-item">
            <button type="button" data-panel="panel-financeiro-icon"><span class="name"><span class="d-flex flex-column flex-sm-row"><span class="icon mb-1 mb-sm-0 mr-sm-1"><i class="fas fa-image" aria-hidden="true"></i></span><span class="name">FINANCEIRO</span></span></span></button>
          </li>
          @endif
          @if($dadosContrato->dsc_situacao_objeto_mcid == 'PARALISADA')
            <li class="tab-item">
              <button type="button" data-panel="panel-paralisada-icon"><span class="name"><span class="d-flex flex-column flex-sm-row"><span class="icon mb-1 mb-sm-0 mr-sm-1"><i class="fas fa-image" aria-hidden="true"></i></span><span class="name">PARALISADA</span></span></span></button>
            </li>
            @endif
            @if(!empty($contratoPac->observacoesContratos))
              <li class="tab-item">
                <button type="button" data-panel="panel-obervacao-icon"><span class="name"><span class="d-flex flex-column flex-sm-row"><span class="icon mb-1 mb-sm-0 mr-sm-1"><i class="fas fa-image" aria-hidden="true"></i></span><span class="name">OBSERVAÇÕES SACI</span></span></span></button>
              </li>
              @endif
        </ul>
      </nav>
      <div class="tab-content">
        <div class="tab-panel active" id="panel-dados-projeto-icon">
          @include('modulo_pac.form_dados_projeto')
        </div>

        @if(!empty($proposta))
          <div class="tab-panel" id="panel-proposta-icon">
            @include('modulo_pac.form_proposta')
          </div>
        @endif

        @if(count($dadosContrato->etapasPacs)>0 || count($metas)> 0)
          <div class="tab-panel" id="panel-etapa-icon">

            @if($dadosContrato->cod_fase_pac == 9)
              @include('modulo_pac.form_etapas_metas_projeto')
            @else
               @include('modulo_pac.form_metas_etapas_projeto')
            @endif

            
          </div>
        @endif

        @if(!empty($dadosFinanceiros))
          <div class="tab-panel" id="panel-financeiro-icon">
            @include('modulo_pac.form_dados_financeiros')
          </div>
          @endif

          @if($dadosContrato->dsc_situacao_objeto_mcid == 'PARALISADA')
          <div class="tab-panel" id="panel-paralisada-icon">
            @include('modulo_pac.form_paralisadas')
          </div>
          @endif

          @if(!empty($contratoPac->observacoesContratos))
            <div class="tab-panel" id="panel-obervacao-icon">
              @include('modulo_pac.form_observacoes_saci')
            </div>
            @endif
      </div>
    </div>

    
    
    <div class="form-group">                            
      <div class="row">
          <div class="col col-xs-12 col-sm-6">      
              <div class="p-3 text-left">
                  @if (!empty($proposta))
                  <a class="menu-item" target="_blank" href='{{ url("https://discricionarias.transferegov.sistema.gov.br/voluntarias/ConsultarProposta/ResultadoDaConsultaDePropostaDetalharProposta.do?idProposta=$dadosContrato->cod_proposta&Usr=guest&Pwd=guest/")}}'>
                      <img  src='{{ URL::asset("/img/logo_portal_transferegov.png")}}'>
                    </a>    
                  @endif
                  
              </div> 
          </div>
          <div class="col col-xs-12 col-sm-6 ">      
              <div class="p-3 text-right">
                  <button class="br-button primary mr-3" type="button" name="imprimir" value="Imprimir" onclick="window.print();">Imprimir
                  </button>
                  <button class="br-button danger mr-3" type="button" onclick="javascript:window.history.go(-1)">Voltar
                  </button>
              </div> 
          </div>
      </div><!-- row -->
  </div><!-- form-group -->
      



    
        
</div>

@endsection

@section('scriptsjs')
<script src="{{URL::asset('bootstrap/5/js/bootstrap.min.js')}}"></script>



@endsection


