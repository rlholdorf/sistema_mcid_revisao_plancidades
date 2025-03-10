@extends('layouts.app')

@section('content')


<historico-navegacao
      :url="'{{ url('/home') }}'"      
      :telanterior01="'Controle de Demandas'"      
      :telatual="'Dados da Demanda'"
      >

</historico-navegacao>


<div class="main-content pl-sm-3 mt-5" id="main-content">

  <cabecalho-relatorios
            :titulo="'Dados da Demanda'"            
            :linkcompartilhar="'{{ url("/codem/demanda/dados/$demanda->demanda_id") }}'"
            :barracompartilhar="false">
  </cabecalho-relatorios>

  <div class="form-group"> 
      

      <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <button class="nav-item nav-link {{($ativarAba == 'demanda') ? 'active' : ''}}" id="nav-demanda-tab" data-toggle="tab" href="#nav-demanda" role="tab" aria-controls="nav-demanda" aria-selected="true"><i class="fas fa-clipboard-list fa-1x" aria-hidden="true"></i>Demanda</button>
            <button class="nav-item nav-link {{($ativarAba == 'documento') ? 'active' : ''}}" id="nav-documento-tab" data-toggle="tab" href="#nav-documento" role="tab" aria-controls="nav-documento" aria-selected="true"><i class="fas fa-clipboard-list fa-1x" aria-hidden="true"></i>Documentos SEI</button>            
            <button class="nav-item nav-link {{($ativarAba == 'encaminhamento') ? 'active' : ''}}" id="nav-encaminhamento-tab" data-toggle="tab" href="#nav-encaminhamento" role="tab" aria-controls="nav-encaminhamento" aria-selected="true"><i class="fas fa-share-square fa-1x" aria-hidden="true"></i>Encaminhamento</button>            
            <button class="nav-item nav-link {{($ativarAba == 'observacoes') ? 'active' : ''}}" id="nav-observacoes-tab" data-toggle="tab" href="#nav-observacoes" role="tab" aria-controls="nav-observacoes" aria-selected="true"><i class="fas fa-edit fa-1x" aria-hidden="true"></i>Observações</button>
            
        </div><!-- nav nav-tabs-->                
      </nav>
      <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade {{($ativarAba == 'demanda') ? 'show active' : ''}}" id="nav-demanda" role="tabpanel" aria-labelledby="nav-demanda-tab">
          <div class="card">        
            <div class="card-body"> 
              <form role="form" method="POST" action='{{ url("codem/demanda/atualizar") }}'>
                @csrf
                <input type="hidden" id="demanda_id" name="demanda_id" value="{{$demanda->demanda_id}}">
            
                <cadastro-demanda 
                  :url="'{{ url('/') }}'"
                  v-bind:dados="{{json_encode($demanda)}}" 
                  ></cadastro-demanda>
            
                <div class="p-3 text-right">   
                  @if($demanda->user_id_demandado == Auth::user()->id || $demanda->user_id == Auth::user()->id || Auth::user()->tipo_usuario_id = 1 )   
                      <button class="br-button primary mr-3" type="submit" name="Salvar Edição">Salvar 
                      </button>
                  @endif
            
                  <button class="br-button danger mr-3" type="button" onclick="window.location.href='/codem/demanda/minhas_demandas'">Fechar
                  </button>
                </div> 
            
              </form>
            </div>
          </div>
        </div>

        <!-- inicio tab documento-->                          
        <div class="tab-pane fade {{($ativarAba == 'documento') ? 'show active' : ''}}" id="nav-documento" role="tabpanel" aria-labelledby="nav-documento-tab">          
          <div class="card container-fluid">        
            <div class="card-body"> 
              <form class="form-horizontal" role="form" method="POST" action='{{ url("codem/demanda/documento/novo") }}'>         
                {{ csrf_field() }}
                <input type="hidden" id="demanda_id" name="demanda_id" value="{{$demanda->demanda_id}}">    
                                   
                <button type="submit" class="br-button block secondary mr-3" aria-label="Ícone ilustrativo">
                    <i class="fas fa-edit" aria-hidden="true"></i>Inserir Documento
                </button>                          
            </form>
               @if(count($documentosDemanda)>0)
                <table class="table table-condensed">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Usuário</th>
                        <th>Setor</th>
                        <th>Tipo de Documento</th>
                        <th>Número</th>
                        <th>Descrição</th>
                        <th>Data Criação</th>
                        <th>Ação</th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach($documentosDemanda as $dados)
                      <tr>
                        <td>{{$dados->id}}</td>
                        <td>{{$dados->email}}</td>
                        <td>{{$dados->txt_sigla_setor}}</td>
                        <td>{{$dados->txt_tipo_documento}}</td>
                        <td>
                          @if(!empty($dados->txt_link_documento_sei)) 
                            <a href='{{ url("$dados->txt_link_documento_sei")}}' target="_blank">{{$dados->num_sei}}</a>
                          @else
                            {{$dados->num_sei}}
                            @endif
                        </td>
                        <td>{{$dados->txt_descricao_documento}}</td>
                        <td>{{date('d/m/Y',strtotime($dados->created_at))}}</td>
                        <td>
                          <botao-acao-icone  
                              :url="'{{ url("/codem/demanda/documento/excluir")}}'" 
                              registro="{{$dados->id}}"                               
                              mensagem="Deseja excluir o documento?" 
                              titulo="Atenção!!!"
                              txtbotaoconfirma="Sim"
                              txtbotaocancela="Cancelar"
                              cssbotao="br-button circle danger small mr-3"                               
                              cssicone="fas fa-trash" 
                          
                          ></botao-acao-icone>  
                      
                        </td>
                      </tr>   
                      @endforeach                                 
                    </tbody>
                  </table>  
                  @endif   
                  
                  
            </div>
          </div>
          <div class="p-3 text-right">      
            <button class="br-button danger mr-3" type="button" onclick="window.location.href='/codem/demanda/minhas_demandas'">Fechar
            </button>
          </div> 
        </div>

        <!-- inicio tab encaminhamento-->                          
        <div class="tab-pane fade {{($ativarAba == 'encaminhamento') ? 'show active' : ''}}" id="nav-encaminhamento" role="tabpanel" aria-labelledby="nav-encaminhamento-tab">          
          <div class="card">        
            <div class="card-body"> 
              <form class="form-horizontal" role="form" method="POST" action='{{ url("codem/demanda/encaminhamento/novo") }}'>         
                {{ csrf_field() }}
                <input type="hidden" id="demanda_id" name="demanda_id" value="{{$demanda->demanda_id}}">    
                                   
                <button type="submit" class="br-button block secondary mr-3" aria-label="Ícone ilustrativo">
                    <i class="fas fa-edit" aria-hidden="true"></i>Adicionar encaminhamento
                </button>                          
            </form>
               @if(count($encaminhamentoDemanda)>0)
                <table class="table table-condensed">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>ID</th>
                        <th>Data do encaminhamento</th>
                        <th>Email Usuário Demandado</th>
                        <th>Setor</th>
                        <th>Concluído?</th>
                        <th>Data da Resposta</th>
                        <th colspan="2" class="text-center">Ação</th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach($encaminhamentoDemanda as $dados)
                      <tr>
                        <td>
                          @if($dados->bln_visualizado)
                              <i class="fas fa-envelope-open fa-2x" style="color:green;"></i>                                   
                          @else
                              <i class="fas fa-envelope fa-2x" style="color:gray;"></i>                                   
                          @endif
                      </td>
                        <td>{{$dados->id}}</td>
                        <td>{{date('d/m/Y',strtotime($dados->dte_encaminhamento))}}</td>
                        <td>{{$dados->email_usuario_demandado}}</td>
                        <td>{{$dados->txt_sigla_setor}}</td>
                        <td>@if($dados->bln_concluido) Sim @else Não @endif</td>
                        <td>@if($dados->dte_resposta){{date('d/m/Y',strtotime($dados->dte_resposta))}}@endif</td>
                        <td>
                          <a class="br-button circle primary small mr-3" href='{{ url("codem/demanda/encaminhamento/dados/$dados->id")}}'><i class="fas fa-eye"></i></a>
                        </td>
                        <td>  
                          <botao-acao-icone  
                                :url="'{{ url("/codem/demanda/encaminhamento/excluir")}}'" 
                                registro="{{$dados->id}}"                               
                                mensagem="Deseja excluir o encaminhamento?" 
                                titulo="Atenção!!!"
                                txtbotaoconfirma="Sim"
                                txtbotaocancela="Cancelar"
                                cssbotao="br-button circle danger small mr-3"                               
                                cssicone="fas fa-trash" 
                                :btndisabled="'@if($dados->user_id == Auth::user()->id) true @else false @endif'"
                            
                            ></botao-acao-icone>    

                       
                        </td>
                      </tr>   
                      @endforeach                                 
                    </tbody>
                  </table>  
                  @endif    
            </div>
          </div>
          <div class="p-3 text-right">      
            <button class="br-button danger mr-3" type="button" onclick="window.location.href='/codem/demanda/minhas_demandas'">Fechar
            </button>
          </div> 
        </div>

      <!-- inicio tab observacoes-->                          
      <div class="tab-pane fade {{($ativarAba == 'observacoes') ? 'show active' : ''}}" id="nav-observacoes" role="tabpanel" aria-labelledby="nav-observacoes-tab">          
        <div class="card-body"> 
          <form class="form-horizontal" role="form" method="POST" action='{{ url("codem/demanda/observacao/nova") }}'>         
            {{ csrf_field() }}
            <input type="hidden" id="demanda_id" name="demanda_id" value="{{$demanda->demanda_id}}">    
                               
            <button type="submit" class="br-button block secondary mr-3" aria-label="Ícone ilustrativo">
                <i class="fas fa-edit" aria-hidden="true"></i>Inserir Observação
            </button>                          
        </form>
          @if(count($observacoesDemanda)>0)
           <table class="table table-condensed">
               <thead>
                 <tr>
                   <th>#</th>
                   <th>Data Criação</th>
                   <th>Usuário</th>
                   <th>Setor</th>
                   <th>Observação</th>
                   <th>Ação</th>
                 </tr>
               </thead>
               <tbody>
               @foreach($observacoesDemanda as $dados)
                 <tr>
                   <td>{{$dados->id}}</td>
                   <td>{{date('d/m/Y',strtotime($dados->dte_observacao))}}</td>
                   <td>{{$dados->email}}</td>
                   <td>{{$dados->txt_sigla_setor}}</td>
                   <td>{{$dados->txt_observacao}}</td>
                   <td>
                     <botao-acao-icone  
                     :url="'{{ url("/codem/demanda/observacao/excluir")}}'" 
                     registro="{{$dados->id}}"                               
                     mensagem="Deseja excluir a observação?" 
                     titulo="Atenção!!!"
                     txtbotaoconfirma="Sim"
                     txtbotaocancela="Cancelar"
                     cssbotao="br-button circle danger small mr-3"                               
                     cssicone="fas fa-trash" 
                 
                 ></botao-acao-icone>  
                 
                   </td>
                 </tr>   
                 @endforeach                                 
               </tbody>
             </table>  
             @endif    
       </div>
       <div class="p-3 text-right">      
        <button class="br-button danger mr-3" type="button" onclick="window.location.href='/codem/demanda/minhas_demandas'">Fechar
        </button>
      </div> 
      </div>
          
      

  

</div>




@endsection

@section('scriptsjs')
<script src="{{URL::asset('bootstrap/5/js/bootstrap.min.js')}}"></script>



@endsection