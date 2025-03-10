@extends('layouts.app')

@section('scriptscss')
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/custom.css')}}"  media="screen" />
<link rel="stylesheet" type="text/css" href="{{ asset('css/relatorio_executivo.css') }}"  media="screen" > 

@endsection


@section('content')




<historico-navegacao
      :url="'{{ url('/home') }}'"      
      :telanterior01="'Carteira Investimento'"  
      :telanterior02="'Ficha Briefing'"  
      :telatual="'Consultar Contratos'"
      >
     
</historico-navegacao>


<div class="main-content pl-sm-3 mt-5" id="main-content">

    <cabecalho-relatorios
        :titulo="'Consultar Contratos'"
        :linkcompartilhar="'{{ url("/carteira_investimento/contratos/consultar") }}'"                       
         barracompartilhar="true">


    </cabecalho-relatorios> 

    <div class="form-group">               
        <p>
         Este formulário permite que você filtre os contratos da carteira de investimento do Ministério. Ele permite que consulte
         um contrato específico, por meio de um código do contrato da carteira, ou selecionando as opções de filtro, 
         nesse caso será disponibilizado uma lista de contratos com base nos parâmetros selecionados.
        </p>
        <span class="br-divider my-3"></span>
        <form action="{{ url('/carteira_investimento/contratos/pesquisar') }}" role="form" method="GET">
         {{ csrf_field() }}
             <div class="row">
                <filtro-carteira-investimento
                    url='{{ url("/") }}'
                
                    >

            </filtro-carteira-investimento>
            
        </form>
        <span class="br-divider my-3"></span>
        <div class="titulo">
            <h5>Resumo por tipo instrumento</h5> 
        </div>  
      
        <div class="table-responsive">
            <table class="table table-sm border-light">
                <thead>
                    <tr class="text-center table-primary" >
                        <th class="text-center  align-middle" rowspan="2">Tipo de Instrumento</th>
                        <th class="text-center"  colspan="2">Transferegov</th>                   
                        <th class="text-center"  colspan="2">DB Gestores</th>                   
                        <th class="text-center"  colspan="2">FGTS</th>                   
                        <th class="text-center"  colspan="2">MCMV</th>                   
                        <th class="text-center"  colspan="2">BNDES</th>                   
                        <th class="text-center  align-middle"  rowspan="2">TOTAL</th>                   
                    </tr>
                    <tr>                                         
                        <th class="text-center table-primary">Ativos</th>
                        <th class="text-center table-primary">Inativo</th>
                        <th class="text-center table-primary">Ativos</th>
                        <th class="text-center table-primary">Inativo</th>
                        <th class="text-center table-primary">Ativos</th>
                        <th class="text-center table-primary">Inativo</th>
                        <th class="text-center table-primary">Ativos</th>
                        <th class="text-center table-primary">Inativo</th>
                        <th class="text-center table-primary">Ativos</th>
                        <th class="text-center table-primary">Inativo</th>
                    </tr>
                </thead>
                <tbody> 
                    @foreach($resumoTipoInstrumento as $dados) 
                        
                        <tr class="text-center">   
                        
                                <td class="text-center">{{$dados->txt_tipo_instrumento}}</td>
                               <td class="text-center">{{number_format($dados->num_contratos_ativos_transferegov, 0, ',' , '.')}}</td>
                               <td class="text-center">{{number_format($dados->num_contratos_inativos_transferegov, 0, ',' , '.')}}</td>
                               <td class="text-center">{{number_format($dados->num_contratos_ativos_db_gestores, 0, ',' , '.')}}</td>
                               <td class="text-center">{{number_format($dados->num_contratos_inativos_db_gesstores, 0, ',' , '.')}}</td>
                               <td class="text-center">{{number_format($dados->num_contratos_ativos_fgts, 0, ',' , '.')}}</td>
                               <td class="text-center">{{number_format($dados->num_contratos_inativos_fgts, 0, ',' , '.')}}</td>
                               <td class="text-center">{{number_format($dados->num_contratos_ativos_mcmv, 0, ',' , '.')}}</td>
                               <td class="text-center">{{number_format($dados->num_contratos_inativos_mcmv, 0, ',' , '.')}}</td>
                               <td class="text-center">{{number_format($dados->num_contratos_ativos_bndes, 0, ',' , '.')}}</td>
                               <td class="text-center">{{number_format($dados->num_contratos_inativos_bndes, 0, ',' , '.')}}</td>
                               <td class="text-center">{{number_format($dados->num_contratos, 0, ',' , '.')}}</td>
                        
                        </tr>
                       @endforeach
                       <tr class="text-center totalFaixa">                           
                        <td class="text-center tabelaNumero">SUBTOTAL</td>
                        <td class="text-center tabelaNumero">{{number_format($resumoTipoInstrumento->SUM('num_contratos_ativos_transferegov'), 0, ',' , '.')}}</td>
                        <td class="text-center tabelaNumero">{{number_format($resumoTipoInstrumento->SUM('num_contratos_inativos_transferegov'), 0, ',' , '.')}}</td>
                        <td class="text-center tabelaNumero">{{number_format($resumoTipoInstrumento->SUM('num_contratos_ativos_db_gestores'), 0, ',' , '.')}}</td>
                        <td class="text-center tabelaNumero">{{number_format($resumoTipoInstrumento->SUM('num_contratos_inativos_db_gestores'), 0, ',' , '.')}}</td>
                        <td class="text-center tabelaNumero">{{number_format($resumoTipoInstrumento->SUM('num_contratos_ativos_fgts'), 0, ',' , '.')}}</td>
                        <td class="text-center tabelaNumero">{{number_format($resumoTipoInstrumento->SUM('num_contratos_inativos_fgts'), 0, ',' , '.')}}</td>
                        <td class="text-center tabelaNumero">{{number_format($resumoTipoInstrumento->SUM('num_contratos_ativos_mcmv'), 0, ',' , '.')}}</td>
                        <td class="text-center tabelaNumero">{{number_format($resumoTipoInstrumento->SUM('num_contratos_inativos_mcmv'), 0, ',' , '.')}}</td>
                        <td class="text-center tabelaNumero">{{number_format($resumoTipoInstrumento->SUM('num_contratos_ativos_bndes'), 0, ',' , '.')}}</td>
                        <td class="text-center tabelaNumero">{{number_format($resumoTipoInstrumento->SUM('num_contratos_inativos_bndes'), 0, ',' , '.')}}</td>
                        <td class="text-center tabelaNumero">{{number_format($resumoTipoInstrumento->SUM('num_contratos'), 0, ',' , '.')}}</td>
                       </tr>
                       <tr class="text-center total">                           
                        <td class="text-center tabelaNumero">TOTAL</td>
                        <td class="text-center tabelaNumero" colspan="2">{{number_format($resumoTipoInstrumento->SUM('num_contratos_ativos_transferegov')+$resumoTipoInstrumento->SUM('num_contratos_inativos_transferegov'), 0, ',' , '.')}}</td>
                        <td class="text-center tabelaNumero" colspan="2">{{number_format($resumoTipoInstrumento->SUM('num_contratos_ativos_db_gestores')+$resumoTipoInstrumento->SUM('num_contratos_inativos_db_gestores'), 0, ',' , '.')}}</td>
                        <td class="text-center tabelaNumero" colspan="2">{{number_format($resumoTipoInstrumento->SUM('num_contratos_ativos_fgts')+$resumoTipoInstrumento->SUM('num_contratos_inativos_fgts'), 0, ',' , '.')}}</td>
                        <td class="text-center tabelaNumero" colspan="2">{{number_format($resumoTipoInstrumento->SUM('num_contratos_ativos_mcmv')+$resumoTipoInstrumento->SUM('num_contratos_inativos_mcmv'), 0, ',' , '.')}}</td>
                        <td class="text-center tabelaNumero" colspan="2">{{number_format($resumoTipoInstrumento->SUM('num_contratos_ativos_bndes')+$resumoTipoInstrumento->SUM('num_contratos_inativos_bndes'), 0, ',' , '.')}}</td>
                        <td class="text-center tabelaNumero">{{number_format($resumoTipoInstrumento->SUM('num_contratos'), 0, ',' , '.')}}</td>
                       </tr>
                </tbody><!-- fechar tbody-->
            </table><!-- fechar table-->
        </div> <!-- table-responsive-sm -->  


      
     
    </div>   


</div>
@endsection


