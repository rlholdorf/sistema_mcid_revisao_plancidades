@extends('layouts.app')

@section('scriptscss')
    
@endsection

@section('content')

<div class="br-card">
    <div class="card-header">
    <div class="d-flex"><span class="br-avatar mt-1" title="Fulano da Silva"><span class="content">
        <img src='{{ URL::asset("/img/icones/pesquisa.png")}}' alt="Avatar"/></span></span>
        <div class="ml-3">
        <div class="text-weight-semi-bold text-up-02">
            Debêntures
        </div>

        <div>
            Consulta Propostas
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
            Este formulário permite que você filtre as propostas cadastradas selecionando as opções de filtro ou todas as propostas caso não selecione nenhum filtro. Nesse caso será disponibilizado uma lista de proposta com base
            nos parâmetros selecionados.
           </p>

                      
                
            <span class="br-divider my-3"></span>
            <form role="form" method="POST" action='{{ url("apis/debentures/pesquisar") }}'>
                @csrf
            
                  <filtro-projetos-debentures 
                        :url="'{{ url('/') }}'">
                  </filtro-projetos-debentures>
            
                  <div class="form-group row">
                    <div class="column col-xs-12 col-md-6">
                      <div class="p-3 text-left">      
                          @if(Auth::user()->setor_id == 47)
                            <button class="br-button success mr-3" type="button" onclick="window.location.href='/apis/debentures/adicionar'">Adicionar Proposta
                            </button>
                          @endif         
                      </div> 
                    </div>
                    <div class="column col-xs-12 col-md-6">
                      <div class="p-3 text-right">      
                        
                        <button class="br-button primary mr-3" type="submit" name="Salvar Edição">Pesquisar 
                        </button>
                        
                  
                        <button class="br-button danger mr-3" type="button" onclick="javascript:window.history.go(-1)">Voltar
                        </button>
                      </div> 
                  </div>
            
              </form>
     
     
           
        
            
              

    </div>
    <div class="card-footer">
    <div class="d-flex" style="padding-top: 10px;">                         
                                   
    </div>
    </div>                  
</div><!-- br-card -->

@endsection

