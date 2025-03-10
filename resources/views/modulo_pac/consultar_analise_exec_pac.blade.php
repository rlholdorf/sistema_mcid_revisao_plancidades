@extends('layouts.app')

@section('content')


<historico-navegacao
      :url="'{{ url('/home') }}'"      
      :telanterior01="'Balanço PAC'"      
      :telatual="'Consultar Análise Execução'"
      >

</historico-navegacao>


<div class="main-content pl-sm-3 mt-5 container-fluid" id="main-content">

  <cabecalho-relatorios
            :titulo="'Consultar  Análise Execução'"            
            :linkcompartilhar="'{{ url("/") }}'"
            :barracompartilhar="false">
  </cabecalho-relatorios>

  <p>
    Este formulário permite que você filtre os contratos do Balanço do PAC selecionando as opções de filtro ou todas as propostas caso não selecione nenhum filtro. Nesse caso será disponibilizado uma lista de proposta com base
    nos parâmetros selecionados.
   </p>

              
        
    <span class="br-divider my-3"></span>
    <form role="form" method="POST" action='{{ url("pac/analise_execucao/pesquisar") }}'>
        @csrf
    
          <filtro-analise-exec-pac 
                :url="'{{ url('/') }}'">
          </filtro-analise-exec-pac>
    
        <div class="p-3 text-right">      
              <button class="br-button primary mr-3" type="submit" name="Salvar Edição">Pesquisar 
              </button>
          
    
          <button class="br-button danger mr-3" type="button" onclick="javascript:window.history.go(-1)">Voltar
          </button>
        </div> 
    
      </form>

</div>




@endsection