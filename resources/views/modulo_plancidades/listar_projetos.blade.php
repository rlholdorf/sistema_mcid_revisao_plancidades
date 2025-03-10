@extends('layouts.app')

@section('scriptscss')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/relatorio_executivo.css') }}"  media="screen" > 
@endsection
@section('content')


<historico-navegacao
      :url="'{{ url('/home') }}'"      
      :telanterior01="'Plancidades'"      
      :telatual="'Lista de Projetos'"
      >

</historico-navegacao>


<div class="main-content pl-sm-3 mt-5 container-fluid" id="main-content">

  <cabecalho-relatorios
            :titulo="'Lista de Projetos'"
            :linkcompartilhar="'{{ url("/") }}'"
            :barracompartilhar="false">
  </cabecalho-relatorios>
<p>
  Lista com as fichas para a descrição de iniciativas que apresentam como projetos, ou seja, iniciativas que possuem início e fim e se 
  destinam à criação de um produto ou serviço único.
  <br>
  Clique em "criar novo" para iniciar um novo monitoramento, ou em "exibir anteriores" para ver monitoramentos já preenchidos.
</p>


<div class="table-responsive">
  <table class="table table-striped table-hover table-sm">
      <thead  class="text-center">
          <tr class="text-center ">
              <th>ID</th>
              <th>Objetivo Estratégico</th>
              <th>Nome do Projeto</th>
              <th class="text-center">Unidade Responsável</th>
              <th class="text-center ">Último Monitoramento</th>
              <th class="acao text-center">Criar Novo</th>
              <th class="acao text-center">Exibir Anteriores</th>
          </tr>
      </thead>
      <tbody>
          @foreach($projetos as $projeto)
            <tr  class="conteudoTabela" >
              <td>{{$projeto->projeto_id}}</td>
              <td>{{$projeto->txt_titulo_objetivo_estrategico_pei}}</td>
              <td>{{$projeto->txt_enunciado_projeto}}</td>
              <td class="text-center">{{$projeto->txt_sigla_unidade_responsavel}}</td>
              <td class="text-center">{{ ($projeto->created_at != null) ? ($projeto->periodo_ultimo_monitoramento) : 'Não monitorado'  }}</td>
              <td class="acao text-center"><a class="br-button circle primary small"
                href='{{ route("plancidades.monitoramentos.projeto.novoMonitoramento", ['projeto_id'=>$projeto->projeto_id])}}'>
                  <i class="fas fa-plus"></i></a></td>                              
              <td class="acao text-center"><a class="br-button circle primary small"
                href='{{ route("plancidades.monitoramentos.projeto.listarMonitoramentos", ['projeto_id'=>$projeto->projeto_id])}}'>
                  <i class="fas fa-eye"></i></a></td>
          </tr>
          @endforeach
      </tbody>
  </table> 
</div>
  
    <span class="br-divider sm my-3"></span>
     
     
    <div class="p-3 text-right">      
      
    <button class="br-button primary mr-3" type="button" name="Imprimir" onclick="window.print();">Imprimir
    </button>
      

    <button class="br-button danger mr-3" type="button" onclick="window.location.href='/plancidades/monitoramento/processo/iniciativa_projetos/consultar'">Voltar
    </button>
    </div> 

  

</div>




@endsection