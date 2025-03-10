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
                :telanterior01="'Ente Público'"
                :telatual="'Seleção Propostas'"          
            >
            </historico-navegacao>  

          
<div class="main-content pl-sm-3 mt-5" id="main-content">

    <cabecalho-relatorios
            :titulo="'Seleção Propostas'"
            
            :barracompartilhar="false"           
            >                        
    </cabecalho-relatorios> 

    
                
        <div class="br-card">
            <div class="card-header">
            <div class="d-flex"><span class="br-avatar mt-1" title="Fulano da Silva"><span class="content">
                <img src='{{ URL::asset("/img/icones/pesquisa.png")}}' alt="Avatar"/></span></span>
                <div class="ml-3">
                <div class="text-weight-semi-bold text-up-02">
                    Seleção de Propostas
                </div>
    
                <div>
                    Acesso aos Dados do Cadastro - Usuários Não Ativados
                </div>
                </div>
                <div class="ml-auto">
                <!--
                <button class="br-button circle" type="button" aria-label="Ícone ilustrativo"><i class="fas fa-ellipsis-v" aria-hidden="true"></i>
                </button>
            -->
                </div>
            </div>
            </div>
            <div class="card-content">
                
    
                <p>
                    Bem-vindo ao formulário de acesso aos dados do cadastro! Este formulário destina-se exclusivamente aos usuários que ainda não foram ativados
                        no sistema. Por meio dele, o Ente Público pode solicitar acesso aos dados cadastrais utilizando o CPF do usuário e o CNPJ do ente público. <strong> Para o
                        cadastramento de propostas o usuário não precisa estar ativo no sistema podendo enviar o ofício a qualquer tempo.</strong>
                </p>
                <p>
                    Ao preencher este formulário, o Ente Público assume a responsabilidade de utilizar os dados do cadastro somente para fins autorizados e estritamente 
                    relacionados às suas atividades oficiais. O uso inadequado ou não autorizado dos dados está sujeito a penalidades legais.
                </p>
                <p>
                    Por favor, preencha os campos abaixo com as informações necessárias
                    </p>
    
                    
                        <form class="row" method="POST" action="{{url('/selecao/ente_publico/consulta')}}">
                            @csrf
                        <div class="col-auto">
                            <label for="staticEmail2" class="visually-hidden">CPF</label>
                            <input id="txt_cpf_usuario" type="text" maxlength="11" class="form-control input-relatorio"name="txt_cpf_usuario" placeholder="CPF do Usuário" value="{{ old('txt_cpf_usuario') }}" required>
                            @if ($errors->has('txt_cpf_usuario'))
                        <span class="feedback danger" role="alert">
                            <i class="fas fa-times-circle" aria-hidden="true"></i>{{ $errors->first('txt_cpf_usuario') }}
                        </span>
                    @endif
                        </div>
                        <div class="col-auto">
                            <label for="inputPassword2" class="visually-hidden">CNPJ</label>
                            <input id="ente_publico_id" type="text" maxlength="14"  class="form-control input-relatorio" name="ente_publico_id" placeholder="CNPJ do Ente Público"  value="{{ old('ente_publico_id') }}" required>
                            @if ($errors->has('ente_publico_id'))
                        <span class="feedback danger" role="alert">
                            <i class="fas fa-times-circle" aria-hidden="true"></i>{{ $errors->first('ente_publico_id') }}
                        </span>
                    @endif
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="br-button block secondary mr-3" aria-label="Ícone ilustrativo" >
                                <i class="fas fa-search" aria-hidden="true"></i>Consultar                   
                            </button>
                        </div>
                        </form>
                    
    
            </div>
            <div class="card-footer">
            <div class="d-flex" style="padding-top: 10px;">                         
                                            
            </div>
            </div>                  
        </div><!-- br-card -->
                
              
                  
        <div class="p-3 text-right">
            
            <button class="br-button danger mr-3" type="button" onclick="window.location.href='/'">Fechar
            </button>
        </div> 
               
</div>

@endsection


