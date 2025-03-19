@extends('layouts.app')

@section('scriptscss')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/relatorio_executivo.css') }}"  media="screen" > 
@endsection
@section('content')


<historico-navegacao
      :url="'{{ url('/home') }}'"      
      :telanterior02="'Consultar Projetos para Revisão'"
      :link2="'{{url('/plancidades/revisao/projeto/consulta')}}'"
      :telanterior01="'PlanCidades'" 
      :link1="'{{url('/plancidades')}}'"    
      :telatual="'Lista de Projetos para Revisão'"
      >

</historico-navegacao>


<div class="main-content pl-sm-3 mt-5 container-fluid" id="main-content">

  <cabecalho-relatorios
            :titulo="'Lista de Projetos para Revisão'"
            :linkcompartilhar="'{{ url("/") }}'"
            :barracompartilhar="false">
  </cabecalho-relatorios>
<p>
  Lista com os projetos em andamento no PEI Cidades disponíveis para Revisão.
  <br>
  Clique em "Nova Revisão" para iniciar uma revisão.
</p>

<div class="form-group row">
  <div class="col col-xs-12 col-sm-12">
      <div class="table-responsive">
        <table class="table table-striped table-hover table-sm">
          <thead class="text-center">
            <tr class="text-center ">
              <th>ID</th>
              <th>Objetivo Estratégico</th>
              <th>Nome do Projeto</th>
              <th class="text-center">Unidade Responsável</th>
              <th class="text-center ">PPA</th>
              <!-- <th class="text-center ">Última Revisão</th>
              <th class="text-center ">Situação da Revisão</th> -->
              <th class="text-center acao">Nova Revisão</th>
              <!-- <th class="text-center acao">Exibir Anteriores</th> -->
            </tr>
          </thead>
            <tbody>
                @foreach ($projetos as $projeto)
                    <tr class="conteudoTabela">
                      <td>{{ $projeto->projeto_id}}</td>
                      <td>{{ $projeto->txt_titulo_objetivo_estrategico_pei}}</td>
                      <td>{{ $projeto->txt_enunciado_projeto}}</td>
                      <td class="text-center">{{ $projeto->txt_sigla_orgao}}</td>
                      <td class="text-center">{{ $projeto->bln_ppa ? "Sim" : "Não"}}</td>
                      <!-- <td class="text-center">{{ ($projeto->monitoramento_created_at != null) ? ($projeto->periodo_ultimo_monitoramento) : 'Não monitorado'  }}</td>
                      <td class="text-center">{{ ($projeto->txt_situacao_monitoramento != null) ? ($projeto->txt_situacao_monitoramento) : ''  }}</td> -->
                      <td class="text-center acao"><a class="br-button circle primary small"
                          href='{{ route("plancidades.revisao.projeto.iniciarRevisao", ['projetoId' =>$projeto->projeto_id]) }}'><i
                              class="fas fa-plus"></i></a></td>
                    </tr>
                @endforeach
            </tbody>
        </table> {{-- Código para paginação funcionar com os filtros da query--}}
      </div>
    </div>
  </div>
  <span class="br-divider sm my-3"></span>
  
  
  <div class="p-3 text-right">      
    
    <button class="br-button primary mr-3" type="button" name="Imprimir" onclick="window.print();">Imprimir
    </button>
      

    <a class="br-button danger mr-3" type="button" href="/plancidades/revisao/projeto/consulta">Voltar
    </a>
  </div>

  

</div>




@endsection