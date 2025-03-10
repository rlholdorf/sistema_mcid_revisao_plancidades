@extends('layouts.app')

@section('scriptscss')
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/custom.css')}}"  media="screen" />

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


<div class="main-content pl-sm-3 mt-5" id="main-content">
  
    <cabecalho-relatorios
                    :titulo="'Dados da Proposta'"
                    subtitulo1="Contrato: {{$contrato->cod_contrato}}"
                    :linkcompartilhar="'{{ url("/saci/contrato/25/$contrato->cod_contrato_pac") }}'"
                    :barracompartilhar="true">
                    @if ($contrato->cod_situacao_contrato == 58)
                        <span class="feedback success text-center" role="alert">
                            <i class="fas fa-check-circle" aria-hidden="true"></i>
                            {{$contrato->situacaoContrato->dsc_situacao_contrato }}
                        </span>                        
                    @elseif ($contrato->cod_situacao_contrato == 55)
                        <span class="feedback default text-center" role="alert">
                            <i class="fas fa-info-circle" aria-hidden="true"></i>
                            Contratado - Em situação normal
                        </span>     
                        
                    @elseif ($contrato->cod_situacao_contrato == 50)
                        <span class="feedback secondary text-center" role="alert">
                            <i class="fas fa-info-circle" aria-hidden="true"></i>
                            Em contratação
                        </span>  
                       
                    @elseif ($contrato->cod_situacao_contrato == 52)
                        <span class="feedback info text-center" role="alert">
                            <i class="fas fa-info-circle" aria-hidden="true"></i>
                            Contratado - Cláusula resolutiva
                        </span>    
                      
                    @else
                        <span class="feedback danger text-center" role="alert">
                            <i class="fas fa-times-circle" aria-hidden="true"></i>
                            {{$contrato->situacaoContrato->dsc_situacao_contrato }}
                        </span>    
                                  
                    @endif

            </cabecalho-relatorios> 

            <h4>Registros Importados/Cadastrados</h4> 
            <span class="br-divider sm my-3"></span>
            <form action="{{ url('/saci/propostas/atualizar/') }}" role="form" method="POST" enctype="multipart/form-data">
                <input type="hidden" class="form-control" id="cod_contrato_pac" name="cod_contrato_pac" value="{{$contrato->cod_contrato_pac}}">                                                                                                          
                @csrf
                <form-cad-contratos-pac
                            :url="'{{ url('/') }}'" 
                            v-bind:dadoscontrato="{{json_encode($contrato)}}"
                            v-bind:municipiobeneficiados="{{json_encode($municipioBen)}}">

                            <div class="p-3 text-right">
                                @if($usuarioPAC->cod_nivel == 9)
                                    <button class="br-button primary mr-3" type="submit" name="Salvar Edição">Salvar Edição
                                    </button>
                                @else
                                    <button class="br-button primary mr-3" type="button" name="imprimir" value="Imprimir" onclick="window.print();">Imprimir
                                    </button>
                                @endif

                                <button class="br-button danger mr-3" type="button" onclick="javascript:window.history.go(-1)">Voltar
                                </button>
                              </div> 
                              
                              
                            
                </form-cad-contratos-pac>
    
                
            
                
           

               
            </form> 


</div>

@endsection


