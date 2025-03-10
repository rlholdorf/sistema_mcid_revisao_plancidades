@extends('layouts.app')

@section('content')


<historico-navegacao
      :url="'{{ url('/home') }}'"      
      :telanterior01="'debentures e Reidi'"      
      :telanterior02="'Consultar debentures e Reidi'"      
      :telanterior03="'Lista debentures e Reidi'"      
      :telatual="'Dados do Projeto'"
      >

</historico-navegacao>


<div class="main-content pl-sm-3 mt-5 container-fluid" id="main-content" >

  <cabecalho-relatorios
            titulo="{{$projeto->txt_titular_projeto}}"    
            :subtitulo1="'Debentures'"           
            :subtitulo2="'{{$projeto->setorProjeto->txt_setor_projeto}}'"           
            :subtitulo3="'{{$projeto->sg_uf}}'"                    
            :linkcompartilhar="'{{ url("/debentures_reidi/projeto/debentures/".$projeto->id) }}'"
            @if($projeto->updated_at)
                :dataatualizacao="'{{date('d/m/Y',strtotime($projeto->updated_at))}}'"               
            @elseif($projeto->created_at)
                :dataatualizacao="'{{date('d/m/Y',strtotime($projeto->created_at))}}'"               
            @endif
            :barracompartilhar="true">
  </cabecalho-relatorios>

  <form role="form" method="POST" action='{{ url("debentures_reidi/projeto/debentures/update") }}'>
    @csrf
    <input type="hidden" id="projeto_id" name="projeto_id" value="{{$projeto->id}}">

    <projeto-debentures 
        :url="'{{ url('/') }}'"
        v-bind:dados="{{json_encode($projeto)}}" 
        ></projeto-debentures>
        <label>Estados Beneficiados</label>
        <span class="br-divider my-3">
          <button type="button" class="btn btn-block btn-outline-primary btn-lg" data-bs-toggle="modal" data-bs-target="#addEstado">Adicionar Estado</button>
         
        @if(count($estados)>0)
        <div class="table-responsive-sm">
          <table class="table table-hover">
              <thead>
                  
                <tr class="text-center" >
                
                  <th>ID</th>
                  <th>UF</th>                      
                  <th class="text-center">Ação</th>                                          
                </tr>
              </thead>
              <tbody> 
                  @foreach($estados as $dados) 
                      
                         
                           <tr class="text-center" >
                        
                              <td>{{$dados->id}}</td>
                              <td>{{$dados->ds_uf}}</td>
                              <td class="p-3 text-center">
                                <botao-acao-icone  
                                  :url="'{{ url("/debentures_reidi/projeto/debentures/excluir")}}'" 
                                  registro="{{$dados->id}}"                               
                                  mensagem="Deseja excluir o Estado?" 
                                  titulo="Atenção!!!"
                                  txtbotaoconfirma="Sim"
                                  txtbotaocancela="Cancelar"
                                  cssbotao="br-button circle danger small mr-3"                               
                                  cssicone="fas fa-trash" 
                            
                            ></botao-acao-icone>   
  
                              </td>  
                          </tr>  
                      
                  @endforeach
              </tbody><!-- fechar tbody-->
          </table><!-- fechar table-->
      </div> <!-- table-responsive-sm -->  
  @endif    
    <div class="p-3 text-right">      
        <button class="br-button primary mr-3" type="submit">Atualizar
        </button>        
        <button class="br-button danger mr-3" type="button" onclick="javascript:window.history.go(-1)">Voltar
        </button>       
    </div> 
  </form>

  
  

 

<!-- Modal -->
<div class="modal fade" id="addEstado" tabindex="-1" aria-labelledby="addEstadoLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addEstadoLabel">Adicione um estado</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form role="form" method="POST" action='{{ url("debentures_reidi/estado/debentures/add") }}'>
          @csrf
          <input type="hidden" id="projeto_id" name="projeto_id" value="{{$projeto->id}}">
              <add-estado 
              :url="'{{ url('/') }}'"
              :habilitaselect="true"
              :habilitabotao="false">
              </add-estado>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
        
      </div>
    </div>
  </div>
</div>


</div>




@endsection