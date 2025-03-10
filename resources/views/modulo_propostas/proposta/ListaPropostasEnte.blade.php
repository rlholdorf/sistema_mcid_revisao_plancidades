@extends('layouts.app')

@section('scriptscss')
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/custom.css')}}"  media="screen" />
<link rel="stylesheet" type="text/css" href="{{ asset('css/relatorio_executivo.css') }}"  media="screen" > 

@endsection


@section('content')




<historico-navegacao
      :url="'{{ url('/home') }}'"      
      :telanterior01="'Ente Público'"  
      :telatual="'Propostas Cadastradas'"
      >

</historico-navegacao>


<div class="main-content pl-sm-3 mt-5" id="main-content">
  
    <cabecalho-relatorios
        :titulo="'Propostas Cadastradas'"
        :subtitulo1="'{{$usuario->entePublico->txt_ente_publico}}'"
        :subtitulo2="'{{$usuario->entePublico->municipio->txt_nome_sem_acento}}-{{$usuario->entePublico->municipio->uf->txt_sigla_uf}}'"
        :dataatualizacao="'{{date('d/m/Y',strtotime($usuario->updated_at))}}'"
       barracompartilhar="false">

    </cabecalho-relatorios> 

    
    <div class="form-group">               
        
    @if(count($propostas) > 0)

        <div class="titulo"><h3>Propostas Cadastradas</h3> </div>  
        <div class="table-responsive-sm">
            <table class="table table-hover">
                <thead>
                    <tr class="text-center" >
                    <th> 
                       
                    </th>
                    <th>Protocolo</th>
                    <th>Modalidade</th>
                    <th>Objeto</th>
                    <th>Valor</th>
                    <th>Cadastrada por</th>
                    <th>Data</th>
                    <th class="text-center">Ação</th>                    
                    
                    </tr>
                </thead>
                <tbody> 
                    @foreach($propostas as $dados) 
                        @if($dados->situacao_proposta_id == 4 || $dados->situacao_proposta_id == 8)                        
                            <tr class="text-center table-danger">   
                        @elseif($dados->modalidade_participacao_id == 1)                        
                                <tr class="text-center table-primary">   
                        @elseif($dados->modalidade_participacao_id == 2)
                            <tr class="text-center table-success">   
                        @elseif($dados->modalidade_participacao_id == 3)
                            <tr class="text-center table-warning"> 
                        @elseif($dados->modalidade_participacao_id == 5)
                                <tr class="text-center table-info"> 
                        @else
                            <tr class="text-center table-warning">   
                        @endif
                                <td>
                                    <button type="button" class="br-button circle secondary small mr-3" aria-label="Ícone ilustrativo" 
                                    onclick='window.location.href="{{ url("selecao/proposta/$dados->id")}}"'>
                                        <i class="fas fa-eye" aria-hidden="true"></i>
                                    </button>          
                                </td>
                                <td>{{$dados->txt_protocolo}}</td>
                                <td>{{$dados->modalidadeParticipacao->txt_modalidade_participacao}}</td>
                                <td>{{$dados->dsc_obj_intervencao}}</td>  
                                <td>{{number_format( ($dados->vlr_intervencao), 2, ',' , '.')}}</td>    
                                <td>{{$dados->usuario->name}}</td>    

                                <td> {{date('d/m/Y',strtotime($dados->created_at))}} </td>    
                                <td class="p-3 text-right">
                                    @if($dados->situacao_proposta_id == 1)
                                        @if($dados->selecao->dte_fim_cadastro_proposta >= $dataAtual)
                                            @if($dados->user_id == $usuario->id)
                                                <botao-acao-icone  
                                                    :url="'{{ url("selecao/proposta/excluir")}}'" 
                                                    registro="{{$dados->id}}"                               
                                                    mensagem="Deseja excluir a proposta?" 
                                                    titulo="Atenção!!!"
                                                    txtbotaoconfirma="Sim"
                                                    txtbotaocancela="Cancelar"
                                                    cssbotao="br-button danger circle mr-3 small"                               
                                                    cssicone="fas fa-trash" 
                                                
                                                ></botao-acao-icone>                         
                                            @endif
                                        @endif
                                    @endif

                                </td>  
                            </tr>  
                        
                    @endforeach
                </tbody><!-- fechar tbody-->
            </table><!-- fechar table-->
        </div> <!-- table-responsive-sm -->  
     @endif              

     <div class="p-3 text-right">
        <button class="br-button primary mr-3" type="button" name="imprimir" value="Imprimir" onclick="window.print();">Imprimir
        </button>
        <button class="br-button danger mr-3" type="button" onclick="window.location.href='/home_ente_publico'">Fechar
        </button>
      </div> 
   

</div>
@endsection


