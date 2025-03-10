@extends('layouts.app')

@section('scriptscss')
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/custom.css')}}" media="screen" />
<link rel="stylesheet" type="text/css" href="{{ asset('css/relatorio_executivo.css') }}" media="screen">
@endsection


@section('content')

<historico-navegacao :url="'{{ url('/home') }}'" :telanterior01="'Balanço Pac'"
  :telatual="'Lista contratos Balanço Pac'">

</historico-navegacao>


<div class="main-content pl-sm-3 mt-5" id="main-content">

  <cabecalho-relatorios :titulo="'Lista contratos Balanço Pac'" subtitulo1="{{$analise->count()}} contratos"
    :linkcompartilhar="'{{ url("/saci/propostas/") }}'" barracompartilhar="true">
  </cabecalho-relatorios>

  <div class="form-group">
    <div class="row table-responsive  table-overflow">
      <div class="col col-xs-12 col-sm-4">
        <table class="table table-hover">
          
          <tbody>
            <tr>   
              <td>Investimento</td>           
              <td>{{number_format( $analise->sum('vlr_investimento'), 2, ',' , '.')}}</td>
            </tr>
            <tr>              
              <td>Repasse</td>
              <td>{{number_format( $analise->sum('vlr_repasse'), 2, ',' , '.')}}</td>
            </tr>
            <tr>                            
              <td>Desembolsado</td>
              <td class="text-left">{{number_format( $analise->sum('vlr_desembolsado'), 2, ',' , '.')}}</td>
            </tr>
            <tr>                            
              <td>A Desembolsar</td>
              <td>{{number_format( $analise->sum('vlr_a_desembolsar'), 2, ',' , '.')}}</td>
            </tr>
            <tr>                            
              <td>Desbloqueado</td>
              <td>{{number_format( $analise->sum('vlr_desbloqueado'), 2, ',' , '.')}}</td>
            </tr>
            <tr>                            
              <td>Saldo Conta</td>
              <td>{{number_format( $analise->sum('vlr_saldo_conta'), 2, ',' , '.')}}</td>
            </tr>
            
            
        </tbody>
      </table>
      </div>
      <div class="col col-xs-12 col-sm-4">
      </div>
      <div class="col col-xs-12 col-sm-4">        
          <table class="table table-hover">
            <thead>
              <tr>
                <th>03 Meses</th>
                <th>Percentual</th>
                <th>12 Meses</th>
                <th>Percentual</th>
                <th>36 Meses</th>
                <th>Percentual</th>
              </tr>
            </thead>
            <tbody>
              <tr class="text-center">              
                <td>Média</td>
                <td>{{number_format( ($analise03Meses->media), 2, ',' , '.')}}</td>
                <td>Média</td>
                <td>{{number_format( ($analise12Meses->media), 2, ',' , '.')}}</td>
                <td>Média</td>
                <td>{{number_format( ($analise36Meses->media), 2, ',' , '.')}}</td>
              </tr>
              <tr class="text-center">              
                <td>Média Mensal</td>
                <td>{{number_format( ($analise03Meses->media_mensal), 2, ',' , '.')}}</td>
                <td>Média Mensal</td>
                <td>{{number_format( ($analise12Meses->media_mensal), 2, ',' , '.')}}</td>
                <td>Média Mensal</td>
                <td>{{number_format( ($analise36Meses->media_mensal), 2, ',' , '.')}}</td>
              </tr>
              <tr class="text-center">              
                <td>Média Anual</td>
                <td>{{number_format( ($analise03Meses->media_anual), 2, ',' , '.')}}</td>
                <td>Média Anual</td>
                <td>{{number_format( ($analise12Meses->media_anual), 2, ',' , '.')}}</td>
                <td>Média Anual</td>
                <td>{{number_format( ($analise36Meses->media_anual), 2, ',' , '.')}}</td>
              </tr>
              <tr class="text-center">              
                <td>Mínimo</td>
                <td>{{number_format( ($analise03Meses->minima), 2, ',' , '.')}}</td>
                <td>Mínimo</td>
                <td>{{number_format( ($analise12Meses->minima), 2, ',' , '.')}}</td>
                <td>Mínimo</td>
                <td>{{number_format( ($analise36Meses->minima), 2, ',' , '.')}}</td>
              </tr>
              <tr class="text-center">              
                <td>Máximo</td>
                <td>{{number_format( ($analise03Meses->maxima), 2, ',' , '.')}}</td>
                <td>Máximo</td>
                <td>{{number_format( ($analise12Meses->maxima), 2, ',' , '.')}}</td>
                <td>Máximo</td>
                <td>{{number_format( ($analise36Meses->maxima), 2, ',' , '.')}}</td>
              </tr>
          </tbody>
        </table>
      </div>
    </div>
    <div class="row">
      <div class="col col-xs-12">
        
          <table class="table table-hover">
            <thead>
              <tr>
                <th>#</th>
                <th>UF</th>
                <th>Município</th>
                <th>Contrato</th>
                <th>Fase</th>
                <th>Secretaria</th>
                <th>Nome Empreendimento</th>
                <th>Ano Assinatura</th>
                <th>Situação Obra</th>
                <th>Ação</th>
                <th>Ação Orçamentária</th>             
                <th>Investimento</th>
                <th>Repasse</th>
                <th>Desembolsado</th>
                <th>A Desembolsar</th>
                <th>Desbloqueado</th>
                <th>Saldo Conta</th>
                <th>Qtd Meses Termino</th>
                <th>Execução 03 meses</th>
                <th>% 03 meses</th>
                <th>Execução 12 meses</th>
                <th>% 12 meses</th>
                <th>Execução 36 meses</th>
                <th>% 36 meses</th>
                <th>Ação</th>
              </tr>
            </thead>
            <tbody>
              @foreach($analise as $contrato)           
              <tr class="text-center">
              
                <td>{{$loop->index+1}}</td>
                <td>{{$contrato->uf}}</td>
                <td>{{$contrato->municipio}}</td>
                <td>{{$contrato->cod_operacao}}</td>
                <td>{{$contrato->txt_pac_migrado}}</td>
                <td>{{$contrato->txt_sigla_area}}</td>
                <td>{{$contrato->txt_empreendimento}}</td>
                <td>{{$contrato->ano_assinatura}}</td>
                <td>{{$contrato->dsc_situacao_obra_caixa}}</td>
                <td>{{$contrato->txt_acao}}</td>
                <td>{{$contrato->txt_acao_orçamentaria}}</td>            
                <td>{{number_format( ($contrato->vlr_investimento), 2, ',' , '.')}}</td>
                <td>{{number_format( ($contrato->vlr_repasse), 2, ',' , '.')}}</td>
                <td>{{number_format( ($contrato->vlr_desembolsado), 2, ',' , '.')}}</td>
                <td>{{number_format( ($contrato->vlr_a_desembolsar), 2, ',' , '.')}}</td>
                <td>{{number_format( ($contrato->vlr_desbloqueado), 2, ',' , '.')}}</td>
                <td>{{number_format( ($contrato->vlr_saldo_conta), 2, ',' , '.')}}</td>
                <td>{{number_format( ($contrato->qtd_meses_termino), 2, ',' , '.')}}</td>
                <td>{{number_format( ($contrato->vlr_exec_03_meses), 2, ',' , '.')}}</td>
                <td>{{number_format( ($contrato->prc_exec_03_meses), 2, ',' , '.')}}%</td>
                <td>{{number_format( ($contrato->vlr_exec_12_meses), 2, ',' , '.')}}</td>
                <td>{{number_format( ($contrato->prc_exec_12_meses), 2, ',' , '.')}}%</td>
                <td>{{number_format( ($contrato->vlr_exec_36_meses), 2, ',' , '.')}}</td>
                <td>{{number_format( ($contrato->prc_exec_36_meses), 2, ',' , '.')}}%</td>
                <td>
                  <a href='{{ url("/pac/contrato/$contrato->cod_operacao")}}' type="button"
                    class="btn btn-link">
                    <i class="fas fa-search"></i></a>
                </td>

              </tr>
              @endforeach
            </tbody>
          </table>
      </div>
    </div><!-- row-->

  </div>
  <!--/form group-->



</div>

@endsection