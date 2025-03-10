@extends('layouts.app')

@section('scriptscss')
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/custom.css')}}"  media="screen" />
<link rel="stylesheet" type="text/css" href="{{ asset('css/relatorio_executivo.css') }}"  media="screen" > 

@endsection


@section('content')



<historico-navegacao
      :url="'{{ url('/home') }}'"      
      :telanterior01="'Carteira Invesrtimento'"  
      :telanterior02="'Contratos'"        
      :telanterior03="'Consultar Contratos'"  
      :link3="'{{url('carteira_investimento/contratos/consultar')}}'"
       :telanterior04="'Contrato'"  
      :link4="'javascript:window.history.back()'"
      :telatual="'Dados do Contrato'"
      >

</historico-navegacao>


<div class="main-content pl-sm-3 mt-5" id="main-content">
    
    <cabecalho-relatorios
        titulo="{{$carteira->dsc_objeto_instrumento}}"
        subtitulo1="{{$carteira->txt_municipio}} - {{$carteira->txt_uf}}"
        @if($carteira->cod_contrato) 
            subtitulo2="Nº Contrato: {{$carteira->cod_contrato}}"   
        @else
            subtitulo2="Nº Convênio: {{$carteira->num_convenio}}"   
        @endif
          
        subtitulo3="{{$carteira->txt_tipo_instrumento}}"           
        subtitulo4="Execuçäo Física: {{number_format( ($carteira->prc_execucao_fisica), 0, ',' , '.')}}%"   
        subtitulo5="@if(empty($carteira->dsc_sub_fonte)) {{$carteira->txt_fonte}} @else {{$carteira->dsc_sub_fonte}} @endif"           

        linkcompartilhar="{{ url("/carteira_investimento/contrato/$carteira->cod_contrato") }}"
        @if(!empty($carteira->dte_controle)) 
            dataatualizacao="{{date('d/m/Y',strtotime($carteira->dte_controle ))}}"                       
        @else 
            dataatualizacao="{{date('d/m/Y',strtotime($carteira->dte_carga ))}}"                       
        @endif
        
         barracompartilhar="true">

         <div class="text-center">
            @if($carteira->cod_situacao_objeto_mcid == 7 || $carteira->dsc_situacao_objeto_mcid == 'CANCELADA' || $carteira->dsc_situacao_objeto_mcid == 'EM TCE')
                 <span class="feedback danger" role="alert">
                     <i class="fas fa-times-circle" aria-hidden="true"></i>{{$carteira->dsc_situacao_objeto_mcid}}
                 </span>
             @elseif($carteira->dsc_situacao_objeto_mcid == 'CONCLUIDA')
                 <span class="feedback success" role="alert">
                     <i class="fas fa-check-circle" aria-hidden="true"></i>{{$carteira->dsc_situacao_objeto_mcid}}
                    </span>
            @elseif($carteira->dsc_situacao_objeto_mcid == 'NAO INICIADA' || $carteira->dsc_situacao_objeto_mcid == 'SEM INFORMACAO')
                 <span class="feedback warning" role="alert">
                     <i class="fas fa-exclamation-triangle" aria-hidden="true"></i>{{$carteira->dsc_situacao_objeto_mcid}}
                    </span>
            @elseif($carteira->dsc_situacao_objeto_mcid == '')
                    <span class="feedback warning" role="alert">
                        <i class="fas fa-exclamation-triangle" aria-hidden="true"></i>SEM INFORMACAO
                       </span>
            @else 
                 <span class="feedback info" role="alert">
                     <i class="fas fa-info-circle" aria-hidden="true"></i>{{$carteira->dsc_situacao_objeto_mcid}}
                    </span>
             @endif
             
             
            </div>
    


    </cabecalho-relatorios> 

    <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <button class="nav-item nav-link active" id="nav-carteira-tab" data-toggle="tab" href="#nav-carteira" role="tab" aria-controls="nav-carteira" aria-selected="true"><i class="fas fa-clipboard-list fa-1x" aria-hidden="true"></i>Dados da Carteira</button>           

            @if(!empty($dadosContratoMCMV))
                <button class="nav-item nav-link" id="nav-contrato-mcmv-tab" data-toggle="tab" href="#nav-contrato-mcmv" role="tab" aria-controls="nav-contrato-mcmv" aria-selected="true"><i class="fas fa-clipboard-list fa-1x" aria-hidden="true"></i>Dados do Contrato MCMV</button>                        
            @endif<!-- nav-contrato-mcmv-->


            @if($carteira->cod_situacao_objeto_mcid == 7)
                    <button class="nav-item nav-link" id="nav-paralisada-tab" data-toggle="tab" href="#nav-paralisada" role="tab" aria-controls="nav-paralisada" aria-selected="true"><i class="fas fa-clipboard-list fa-1x" aria-hidden="true"></i>Dados da Paralisação</button>                        
            @endif<!-- nav-paralisada-->

            @if(count($empenhos) > 0 || count($desembolsos) > 0 || count($desbloqueios) > 0)
                <button class="nav-item nav-link" id="nav-financeiro-tab" data-toggle="tab" href="#nav-financeiro" role="tab" aria-controls="nav-financeiro" aria-selected="true"><i class="fas fa-clipboard-list fa-1x" aria-hidden="true"></i>Financeiro</button>                        
            @endif<!-- nav-financeiro-->
            
           


        </div><!-- nav nav-tabs-->  
        
       

    </nav><!-- nav -->

    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-carteira" role="tabpanel" aria-labelledby="nav-carteira-tab">
            <div class="card">        
              <div class="card-body">
            </br>
                @include('modulo_carteira_investimento.form_aux_dados_carteira')
              </div>
            </div>
        </div> <!-- nav-carteira-->
        

        @if(!empty($dadosContratoMCMV))
        <div class="tab-pane fade" id="nav-contrato-mcmv" role="tabpanel" aria-labelledby="nav-contrato-mcmv-tab">
            <div class="card">        
                <div class="card-body">
                    <div class="form-group">
                        @include('modulo_carteira_investimento.form_aux_dados_mcmv')
                    
                    </div>
                </div>
            </div>
        </div>   <!-- nav-contrato-mcmv-->
        @endif

        @if($carteira->cod_situacao_objeto_mcid == 7)
        <div class="tab-pane fade" id="nav-paralisada" role="tabpanel" aria-labelledby="nav-paralisada-tab">
            <div class="card">        
              <div class="card-body">
                <div class="form-group">
                    @include('modulo_carteira_investimento.form_aux_dados_paralisada')
                
                </div>
                </div>
            </div>
        </div>   <!-- nav-paralisada-->
        @endif

        @if(count($empenhos) > 0 || count($desembolsos) > 0 || count($desbloqueios) > 0)
        <div class="tab-pane fade" id="nav-financeiro" role="tabpanel" aria-labelledby="nav-financeiro-tab">
            <div class="card">        
                <div class="card-body">
                    <div class="form-group">
                        @include('modulo_carteira_investimento.form_aux_financeiro')
                    
                    </div>
                </div>
            </div>
        </div>   <!-- nav-financeiro-->
        @endif
       

    </div><!-- tab-content -->
    

  


    
            

      
        <span class="br-divider lg my-3"></span>
        

        <div class="form-group">                            
            <div class="row">
                <div class="col col-xs-12 col-sm-6">      
                    <div class="p-3 text-left">
                        @if ($carteira->cod_origem == 1)
                        <a class="menu-item" target="_blank" href='{{ url("https://discricionarias.transferegov.sistema.gov.br/voluntarias/ConsultarProposta/ResultadoDaConsultaDePropostaDetalharProposta.do?idProposta=$carteira->cod_proposta&Usr=guest&Pwd=guest/")}}'>
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


