@extends('layouts.app')




@section('content')




<historico-navegacao
      :url="'{{ url('/home') }}'"      
      :telanterior01="'Transferências Especiais'"        
      :telanterior02="'Consultar Contratos'"    
      :link2="'{{ url('/transferencias_especiais/consultar') }}'"    
      :telatual="'Planos de Ações'"
      >
     
</historico-navegacao>


<div class="main-content pl-sm-3 mt-5" id="main-content">

    <cabecalho-relatorios
        :titulo="'Lista de Planos de Ações'"
        :subtitulo1="'{{count( $planos)}} planos de ações'"
        
        :linkcompartilhar="'{{ url("/") }}'"                       
         barracompartilhar="false">
    </cabecalho-relatorios> 

    <button type="button" class="br-button block success small mr-3" aria-label="Ícone ilustrativo" 
    onclick='window.location.href="{{ url("transferencias_especiais/download/secretaria/$secretariaId/distribuicao/$distribuicao")}}"'>
        <i class="fas fa-download" aria-hidden="true"></i>Download para excel
        
    </button>   
    
        <div class="table-responsive">
            <table class="table table-striped table-sm align-middle">
                <thead  class="text-center">
                    <tr class="text-center">                      
                        
                        <th class="text-center">Código</th>
                        <th class="text-center">Distribuição automática</th>
                        <th class="text-center">SEMOB</th>                      
                        <th class="text-center">SNDUM</th>                      
                        <th class="text-center">SNH</th>                      
                        <th class="text-center">SNP</th>                      
                        <th class="text-center">SNSA</th>  
                        <th class="text-center">Genérico</th>  
                        @if ($distribuicao == 1)
                        <th class="text-center">Distribuído por</th>  
                        <th class="text-center">Secretaria</th>  
                        @endif   
                        <th class="text-center">Transferegov</th>                
                        <th class="text-center">Ações</th>                     
                    </tr>
                </thead>
                <tbody>
                    @foreach($planos as $plano)
                      @if($plano->bln_distribuicao_automatica)
                        <tr class="table-warning">
                      @else
                        <tr>
                      @endif                       
                            <td>{{$plano->cod_plano_acao}}</td>
                            <td>@if($plano->bln_distribuicao_automatica) Sim @else Não @endif</td>                           
                            <td class="text-center">{{$plano->txt_palavra_semob}}</td>    
                            <td class="text-center">{{$plano->txt_palavra_sndum}}</td>    
                            <td class="text-center">{{$plano->txt_palavra_snh}}</td>    
                            <td class="text-center">{{$plano->txt_palavra_snp}}</td>    
                            <td class="text-center">{{$plano->txt_palavra_snsa}}</td>    
                            <td class="text-center">{{$plano->txt_palavra_generico}}</td>    
                            @if ($distribuicao == 1)
                               @if ($plano->bln_distribuicao_automatica)
                                  <td class="text-center">Sistema</td>    
                                  @else
                                  <td class="text-center">{{$plano->name}}</td>    
                                  @endif
                            <td class="text-center">{{$plano->txt_sigla_secretaria}}</td>    
                            @endif
                            <td class="text-center">
                              <a class="br-button small" href="{{$plano->link_transferegov}}" target="_BLANK">
                                <img  src='{{ URL::asset("/img/logo_portal_transferegov.png")}}'>
                              </a></td>  
                             <td class="text-center">
                              
                               @if ($distribuicao == 0)
                                <botao-acao-icone  
                                      :url="'{{ url("transferencias_especiais/atribuir/plano_acao")}}'" 
                                      registro="{{$plano->cod_plano_acao}}"                               
                                      mensagem="Este plano será distribuído para sua Secretaria.  Deseja confirmar?" 
                                      titulo="Atenção!!!"
                                      txtbotaoconfirma="Sim"
                                      txtbotaocancela="Cancelar"
                                      cssbotao="br-button success circle mr-3 small"                               
                                      cssicone="fas fa-check" 
                                  
                                  ></botao-acao-icone>
                                  <botao-acao-icone  
                                    :url="'{{ url("transferencias_especiais/desatribuir/plano_acao")}}'" 
                                    registro="{{$plano->cod_plano_acao}}"                               
                                    mensagem="Essa distruibuição sera cancelada.  Deseja confirmar?" 
                                    titulo="Atenção!!!"
                                    txtbotaoconfirma="Sim"
                                    txtbotaocancela="Cancelar"
                                    cssbotao="br-button danger circle mr-3 small"                               
                                    cssicone="fas fa-times" 
                                
                                ></botao-acao-icone>
                                  @else
                                    @if($plano->bln_distribuicao_automatica)
                                    <botao-acao-icone  
                                    :url="'{{ url("transferencias_especiais/desatribuir/plano_acao")}}'" 
                                    registro="{{$plano->cod_plano_acao}}"                               
                                    mensagem="Essa distruibuição sera cancelada.  Deseja confirmar?" 
                                    titulo="Atenção!!!"
                                    txtbotaoconfirma="Sim"
                                    txtbotaocancela="Cancelar"
                                    cssbotao="br-button danger circle mr-3 small"                               
                                    cssicone="fas fa-times" 
                                
                                ></botao-acao-icone>
                                    @endif
                                  @endif
                               

                             </td>
                                   
                        </tr>
                        
                    @endforeach
                </tbody>
            </table> 
        </div>
      
        <div class="p-3 text-right">      
            <button class="br-button primary mr-3" type="submit" name="Pesquisar">Pesquisar 
            </button>
        
  
        <button class="br-button danger mr-3" type="button" onclick="javascript:window.history.go(-1)">Voltar
        </button>
      </div> 
    </div>   
</div>
@endsection


