@extends('layouts.app')

@section('scriptscss')
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/custom.css')}}"  media="screen" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/relatorio_executivo.css') }}"  media="screen" > 
@endsection


@section('content')

  
    <div id="content"> 
        
        <div id="content-core"> 
            <historico-navegacao
                :url="'{{ url('/') }}'"  
                :telanterior01="'Acesso à Informação'"
                :telanterior02="'Painéis de informações'"
                :telatual="'Painéis Internos'"          
            >
            </historico-navegacao>  

          
<div class="main-content pl-sm-3 mt-5" id="main-content">

    <cabecalho-relatorios
            :titulo="'Painéis Internos'"            
            :dataatualizacao="''"
            :linkcompartilhar="'{{ url("/paineis/internos") }}'"
          
            :barracompartilhar="true"           
            >  
            
    </cabecalho-relatorios> 

    
    <span class="br-divider my-3"></span>   
             
        <div class="card">        
            <div class="card-body">  
                

                <div class="form-group">
                    <div class="row">
                        @foreach($dadosPaineis as $dados)    
                        <div class="col-sm-6 col-md-4 col-lg-4">
                            <div class="br-card">
                              <div class="card-header">
                                <div class="d-flex"><span class="br-avatar mt-1" title="Fulano da Silva"><span class="content"><img src="https://picsum.photos/id/823/400" alt="Avatar"/></span></span>
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
                                <img src='{{ URL::asset("$dados->txt_caminho_imagem_painel")}}'  class="img-thumbnail" >
                              </div>
                              <div class="card-footer">
                                <div class="d-flex">
                                </br>
                                    <button type="button" class="br-button block secondary mr-3" aria-label="Ícone ilustrativo" 
                                        onclick='window.location.href="{{ url("/painel/visualizar/$dados->id")}}"'>
                                            <i class="fas fa-eye" aria-hidden="true"></i>Visualisar</button>  
                                 
                                 
                                </div>
                              </div>
                            </div>
                          </div>
                        @endforeach
                        
                    </div>                    
                </div><!-- fechar form-group-->
            </div>            
        </div>   
        
        <div class="p-3 text-right">
            <button class="br-button primary mr-3" type="button" name="imprimir" value="Imprimir" onclick="window.print();">Imprimir
            </button>
            <button class="br-button danger mr-3" type="button" onclick="javascript:window.history.go(-1)">Voltar
            </button>
          </div> 
       
</div>

@endsection


