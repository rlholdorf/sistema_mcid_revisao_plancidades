@extends('layouts.app')

@section('scriptscss')
  <link rel="stylesheet" type="text/css" href="{{URL::asset('css/caixas.css')}}"  media="screen" />
@endsection

@section('content')
<div class="main-content" id="main-content">  


<span class="br-divider dashed my-3"></span>

@can('eDev')

@include('modulo_sistema.gerais.carteira_investimento.resumo_tci_tipo_instrumento')

<span class="br-divider dashed my-3"></span>

@include('modulo_sistema.gerais.carteira_investimento.resumo_tci_secretaria')

<span class="br-divider dashed my-3"></span>

@include('modulo_sistema.gerais.carteira_investimento.resumo_tci_situacao_contrato')


@endcan


<span class="br-divider dashed my-3"></span>

@include('modulo_sistema.gerais.carteira_investimento.atalhos_consultas_tci')



<span class="br-divider dashed my-3"></span>

@include('modulo_sistema.gerais.propostas.atalhos_consultas_propostas')

   


<span class="br-divider my-3"></span>  
    <h4>PAINÉIS DE INFORMAÇÕES</h4>
    <span class="br-divider my-3"></span> 
    <p>
        Logo abaixo você terá à sua disposição os Painéis de Informações do Ministérios das Cidades para consultar. 
        Os Painéis disponibilizam informações de diversos produtos do Ministério entregues à população de forma transparente, intuitiva, flexível e rápida, 
        para apoiar o processo de tomada de decisão.
    </p>
             
        <div class="card">        
            <div class="card-body">  
                

                <div class="form-group">
                    <div class="row">
                        @foreach($dadosPaineis as $dados)    
                        <div class="col-xs-12 col-sm-6 col-md-3 ">
                            <div class="br-card">
                              <div class="card-header">
                                <div class="d-flex"><span class="br-avatar mt-1" title="Fulano da Silva"><span class="content"><img src="{{ URL::asset("/img/icones/relatorios.png")}}" alt="Avatar"/></span></span>
                                  <div class="ml-3">
                                    <div class="text-weight-semi-bold text-up-02">{{$dados->txt_nome_painel}}</div>
                                    <div>{{$dados->txt_secretaria}}</div>
                                  </div>
                                  <div class="ml-auto">
                                    <button class="br-button circle" type="button" aria-label="Ícone ilustrativo"><i class="fas fa-share-alt" aria-hidden="true"></i>
                                    </button>
                                  </div>
                                </div>
                              </div>
                              <div class="card-content">
                                @if($dados->bln_manutencao)
                                        <img src='{{ URL::asset("img\paineis\img_manutencao.png")}}'  class="img-thumbnail" >
                                    @else
                                        <img src='{{ URL::asset("$dados->txt_caminho_imagem_painel")}}'  class="img-thumbnail" >
                                    @endif
                              </div>
                              <div class="card-footer">
                                <div class="d-flex">
                                </br>
                                    <button type="button" class="br-button block secondary mr-3" aria-label="Ícone ilustrativo" 
                                    @if($dados->bln_manutencao) disabled @else onclick='window.location.href="{{ url("/painel/externo/visualizar/$dados->id")}}"' @endif>
                                    <i class="fas fa-eye" aria-hidden="true" ></i>Visualisar</button>  
                                 
                                 
                                </div>
                              </div>
                            </div>
                          </div>
                        @endforeach
                        
                    </div>                    
                </div>
            </div>            
        </div>   

</div>
@endsection
