

    @extends('layouts.app')

    @section('scriptscss')
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/custom.css')}}"  media="screen" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/relatorio_executivo.css') }}"  media="screen" > 
    
    @endsection
    
    @section('content')
    
    
    <historico-navegacao :url="'{{ url('/home') }}'" 
        :telanterior01="'Debentures'"
        :telanterior02="'Consultar projetos debentures'"
        :telatual="'Dados do Projeto'">
    
    </historico-navegacao>
    
    
    <div class="main-content pl-sm-3 mt-5 container-fluid" id="main-content">
    
        <cabecalho-relatorios
            titulo="Carta Consulta: {{$projetoDebenture->cod_carta_consulta}}"          
            :subtitulo1="'{{$projetoDebenture->txt_modalidade_projeto}}'"   
            :subtitulo2="'{{$projetoDebenture->num_ano_cadastramento}}'"   
            :subtitulo3="'{{$projetoDebenture->txt_normativo_enquadramento}}'"   
            
            @if($projetoDebenture->updated_at)
                :dataatualizacao="'{{date('d/m/Y',strtotime($projetoDebenture->updated_at))}}'"               
            @elseif($projetoDebenture->created_at)
                :dataatualizacao="'{{date('d/m/Y',strtotime($projetoDebenture->created_at))}}'"               
            @endif
             barracompartilhar="true"
            >
    
            <div class="text-center">
                @if($projetoDebenture->situacao_enquadramento_id == 2 || $projetoDebenture->situacao_enquadramento_id == 4)
                    <span class="feedback warning" role="alert">
                        <i class="fas fa-exclamation-triangle" aria-hidden="true"></i>{{$projetoDebenture->txt_situacao_enquadramento}}
                    </span>
                @elseif($projetoDebenture->situacao_enquadramento_id == 3 || $projetoDebenture->situacao_enquadramento_id == 6)
                    <span class="feedback danger" role="alert">
                        <i class="fas fa-times-circle" aria-hidden="true"></i>{{$projetoDebenture->txt_situacao_enquadramento}}
                    </span>
                @elseif($projetoDebenture->situacao_enquadramento_id == 5)
                    <span class="feedback success" role="alert">
                        <i class="fas fa-check-circle" aria-hidden="true"></i>{{$projetoDebenture->txt_situacao_enquadramento}}
                    </span>
                @else 
                    <span class="feedback info" role="alert">
                        <i class="fas fa-info-circle" aria-hidden="true"></i>{{$projetoDebenture->txt_situacao_enquadramento}}
                       </span>
                @endif
            </div>
        </cabecalho-relatorios> 

    <div class="form-group">  
        
        <div class="card">
            <div class="card-header bg-green-cool-vivid-60 text-white">Municípios Beneficiados</div>
            <div class="card-body">
                
                    <button type="button" class="br-button block secondary mr-3" disabled aria-label="Ícone ilustrativo" data-bs-toggle="modal" data-bs-target="#adicionarMunicipios">
                        <i class="fas fa-plus" aria-hidden="true"></i>Adicionar Municípios
                    </button>           
                    <div class="table-responsive-sm">
                        <table class="table table-hover">
                            <thead>                                    
                            <tr class="text-center">   
                                    <th></th>
                                    <th>UF</th>
                                    <th>Código IBGE</th>
                                    <th>Município</th>
                                    <th>Região</th>
                                    <th>RM / RIDE</th>                                    
                                    <th>Ação</th>                                    
                                </tr>
                            </thead>
                            <tbody> 
                                @foreach($municipiosBeneficiados as $dados) 
                                    <tr>
                                        <td>{{$loop->index+1}}</td>                            
                                        <td>{{$dados->sg_uf}}</td>
                                        <td>{{$dados->municipio_id}}</td>
                                        <td>{{$dados->ds_municipio}}</td>
                                        <td>{{$dados->ds_regiao}}</td>
                                        <td>{{$dados->txt_rm_ride}}</td>
                                        <td>
                                            <botao-acao-icone  
                                            :url="'{{ url("apis/debenture/excluir/municipio/")}}'" 
                                            registro="{{$dados->municipio_beneficiado_debenture_id}}"                               
                                            mensagem="Deseja excluir este município?" 
                                            titulo="Atenção!!!"
                                            txtbotaoconfirma="Sim"
                                            txtbotaocancela="Cancelar"
                                            cssbotao="br-button danger mr-3"                               
                                            cssicone="fas fa-trash"                                                 
                                        ></botao-acao-icone>
                                        </td>
                                    </tr>  
            
                                @endforeach
                            </tbody><!-- fechar tbody-->
                        </table><!-- fechar table-->
                    </div> <!-- table-responsive-sm --> 
                    <div class="p-3 text-right">     
                      
                        <button class="br-button danger mr-3" type="button" onclick="window.location.href='/apis/debentures/{{$projetoDebenture->projeto_debenture_id}}'">Voltar
                        </button>
                    </div> 

            </div>
        </div>        
    </div>

</div>

<!-- Modal acompanhamento -->
<div class="modal fade" id="adicionarMunicipios" tabindex="-1" aria-labelledby="adicionarMunicipiosLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="adicionarMunicipiosLabel">Municipípios Beneficiados</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form class="form-horizontal" role="form" method="POST" action='{{ url("apis/debenture/municipios_beneficiados/adicionar/") }}'>         
            {{ csrf_field() }}
            <input type="hidden" id="projeto_debenture_id" name="projeto_debenture_id" value="{{$projetoDebenture->projeto_debenture_id}}">
            <div class="modal-body">
                <adicionar-municipios
                    :url="'{{ url("/")}}'">
                </adicionar-municipios>
            </div>
            <div class="modal-footer">
                
            <button type="button" class="br-button danger mr-3" data-bs-dismiss="modal">Fechar</button>
            <button type="submit" class="br-button primary mr-3">Adicionar</button>
                
            </div>
        </form>
      </div>
    </div>
  </div>



@endsection