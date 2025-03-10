@extends('layouts.app')

@section('content')


<historico-navegacao
      :url="'{{ url('/home') }}'"      
      :telanterior01="'Balanço PAC'"      
      :telatual="'Consultar Contratos'"
      >

</historico-navegacao>


<div class="main-content pl-sm-3 mt-5 container-fluid" id="main-content">

  <cabecalho-relatorios
            :titulo="'Consultar Contratos'"            
            :linkcompartilhar="'{{ url("/") }}'"
            :barracompartilhar="false">
  </cabecalho-relatorios>

  <p>
    Este formulário permite que você filtre os contratos do Balanço do PAC selecionando as opções de filtro ou todas as propostas caso não selecione nenhum filtro. Nesse caso será disponibilizado uma lista de proposta com base
    nos parâmetros selecionados.
   </p>

              
        
    <span class="br-divider my-3"></span>
    <form role="form" method="POST" action='{{ url("pac/balanco_pac/pesquisar") }}'>
        @csrf
    
          <filtro-contratos-pac 
                :url="'{{ url('/') }}'">
          </filtro-contratos-pac>
    
          <div class="table-responsive">
            <table class="table table-sm border-light">
                <thead>
                    <tr class="text-center table-primary">
                        <th class="text-center  align-middle" rowspan="2">Secretaria</th>
                        <th class="text-center  align-middle" rowspan="2">Municípios</th>
                        <th class="text-center  align-middle" rowspan="2">Contratos</th>
                        <th class="text-center" colspan="7">Não PAC</th>
                        <th class="text-center" colspan="7">PAC Migrado</th>
                        <th class="text-center" colspan="7">Seleção PAC</th>
                    </tr>
                    <tr>
                        <th class="text-center table-primary">Contratos</th>
                        <th class="text-center table-primary">Investimento</th>
                        <th class="text-center table-primary">Repasse</th>
                        <th class="text-center table-primary">Contrapartida</th>
                        <th class="text-center table-primary">Empenhado</th>
                        <th class="text-center table-primary">Liberado</th>
                        <th class="text-center table-primary">Desbloqueado</th>
                        <th class="text-center table-primary">Contratos</th>
                        <th class="text-center table-primary">Investimento</th>
                        <th class="text-center table-primary">Repasse</th>
                        <th class="text-center table-primary">Contrapartida</th>
                        <th class="text-center table-primary">Empenhado</th>
                        <th class="text-center table-primary">Liberado</th>
                        <th class="text-center table-primary">Desbloqueado</th>
                        <th class="text-center table-primary">Contratos</th>
                        <th class="text-center table-primary">Investimento</th>
                        <th class="text-center table-primary">Repasse</th>
                        <th class="text-center table-primary">Contrapartida</th>
                        <th class="text-center table-primary">Empenhado</th>
                        <th class="text-center table-primary">Liberado</th>
                        <th class="text-center table-primary">Desbloqueado</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($resumoPac as $dados)

                    <tr class="text-center">

                        <td class="text-center">{{$dados->secretaria}}</td>
                        <td class="text-center">{{number_format($dados->num_municipios, 0, ',' , '.')}}</td>
                        <td class="text-center">{{number_format($dados->num_contratos, 0, ',' , '.')}}</td>
                        <td class="text-center">{{number_format($dados->num_contrato_nao_pac_migrado, 0, ',' , '.')}}</td>
                        <td class="text-center">{{number_format($dados->vlr_investimento_nao_pac_migrado, 2, ',' , '.')}}</td>
                        <td class="text-center">{{number_format($dados->vlr_repasse_nao_pac_migrado, 2, ',' , '.')}}</td>
                        <td class="text-center">{{number_format($dados->vlr_contrapartida_nao_pac_migrado, 2, ',' , '.')}}</td>
                        <td class="text-center">{{number_format($dados->vlr_empenhado_nao_pac_migrado, 2, ',' , '.')}}</td>
                        <td class="text-center">{{number_format($dados->vlr_liberado_nao_pac_migrado, 2, ',' , '.')}}</td>
                        <td class="text-center">{{number_format($dados->vlr_desbloqueado_nao_pac_migrado, 2, ',' , '.')}}</td>
                        <td class="text-center">{{number_format($dados->num_contrato_pac_migrado, 0, ',' , '.')}}</td>
                        <td class="text-center">{{number_format($dados->vlr_investimento_pac_migrado, 2, ',' , '.')}}</td>
                        <td class="text-center">{{number_format($dados->vlr_repasse_pac_migrado, 2, ',' , '.')}}</td>
                        <td class="text-center">{{number_format($dados->vlr_contrapartida_pac_migrado, 2, ',' , '.')}}</td>
                        <td class="text-center">{{number_format($dados->vlr_empenhado_pac_migrado, 2, ',' , '.')}}</td>
                        <td class="text-center">{{number_format($dados->vlr_liberado_pac_migrado, 2, ',' , '.')}}</td>
                        <td class="text-center">{{number_format($dados->vlr_desbloqueado_pac_migrado, 2, ',' , '.')}}</td>
                        <td class="text-center">{{number_format($dados->num_contrato_pac_selecao, 0, ',' , '.')}}</td>
                        <td class="text-center">{{number_format($dados->vlr_investimento_pac_selecao, 2, ',' , '.')}}</td>
                        <td class="text-center">{{number_format($dados->vlr_repasse_pac_selecao, 2, ',' , '.')}}</td>
                        <td class="text-center">{{number_format($dados->vlr_contrapartida_pac_selecao, 2, ',' , '.')}}</td>
                        <td class="text-center">@if(!$dados->vlr_empenhado_pac_selecao){{number_format($dados->vlr_empenhado_pac_selecao, 2, ',' , '.')}} @else 0,00 @endif</td>
                        <td class="text-center">{{number_format($dados->vlr_liberado_pac_selecao, 2, ',' , '.')}}</td>
                        <td class="text-center">{{number_format($dados->vlr_desbloqueado_pac_selecao, 2, ',' , '.')}}</td>
                    </tr>
                    @endforeach
                    
                </tbody><!-- fechar tbody-->
            </table><!-- fechar table-->
        </div> <!-- table-responsive-sm -->

        <div class="p-3 text-right">      
              <button class="br-button primary mr-3" type="submit" name="Salvar Edição">Pesquisar 
              </button>
          
    
          <button class="br-button danger mr-3" type="button" onclick="javascript:window.history.go(-1)">Voltar
          </button>
        </div> 
    
      </form>

</div>




@endsection