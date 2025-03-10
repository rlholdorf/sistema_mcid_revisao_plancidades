@extends('layouts.app')

@section('scriptscss')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/relatorio_executivo.css') }}"  media="screen" > 
@endsection

@section('content')



<historico-navegacao :url="'{{ url('/home') }}'" 
        :telanterior01="'Resultado Primário'" 
        :telanterior02="'Ofício'" 
        :telatual="'Ofício Validado'">

</historico-navegacao>

<cabecalho-relatorios
    :titulo="'{{$oficioEmendas->txt_num_oficio_completo_congresso}} - {{date('d/m/Y', strtotime($oficioEmendas->dte_oficio_congresso))}}'"   
    :subtitulo1="'{{$oficioEmendas->txt_casa_legislativa}}'"            
    :subtitulo2="'{{$oficioEmendas->txt_comissao}}'"            
    :subtitulo3="'{{$oficioEmendas->txt_presidente}}'"  
    :subtitulo4="'{{$oficioEmendas->cod_programa}} - {{$oficioEmendas->txt_nome_programa}}'"  
    
    
    :linkcompartilhar="'{{ url("/rp/rp8/validado/oficio/$oficioEmendas->oficio_emenda_id") }}'"
    :barracompartilhar="true">



    <div class="text-center">
        @if($oficioEmendas->situacao_oficio_id == 2)
             <span class="feedback success" role="alert">
                 <i class="fas fa-times-circle" aria-hidden="true"></i>{{$oficioEmendas->txt_situacao_oficio}}
             </span>
        @elseif($oficioEmendas->situacao_oficio_id == 3 || $oficioEmendas->situacao_oficio_id == 7)
             <span class="feedback danger" role="alert">
                 <i class="fas fa-times-circle" aria-hidden="true"></i>{{$oficioEmendas->txt_situacao_oficio}}
             </span>
         @elseif($oficioEmendas->situacao_oficio_id == 4)
             <span class="feedback bg-green-cool-vivid-20" role="alert">
                 <i class="fas fa-times-circle" aria-hidden="true"></i>{{$oficioEmendas->txt_situacao_oficio}}
             </span>
        @elseif($oficioEmendas->situacao_oficio_id == 5 || $oficioEmendas->situacao_oficio_id == 6)
             <span class="feedback warning" role="alert">
                 <i class="fas fa-times-circle" aria-hidden="true"></i>{{$oficioEmendas->txt_situacao_oficio}}
             </span>
         @else
            <span class="feedback info" role="alert">
                <i class="fas fa-times-circle" aria-hidden="true"></i>{{$oficioEmendas->txt_situacao_oficio}}
            </span>
         @endif
    </div>
</cabecalho-relatorios>

<div class="main-content pl-sm-3 mt-5" id="main-content">
    
<form action="{{ url('/rp/oficio/atualizar') }}" role="form" method="POST" enctype="multipart/form-data">
        @csrf
    <input type="hidden" id="oficio_emenda_id" name="oficio_emenda_id" value="{{$oficioEmendas->oficio_emenda_id}}">
    <div class="form-group">
        <div class="row">
            <div class="col col-xs-12 col-sm-4 br-input">
                <label >Nº Processo SEI</label>
                <input id="num_processo_sei" 
                    type="text" 
                    name="num_processo_sei"  
                    value="{{$oficioEmendas->txt_num_processo_sei}}" 
                    required>                   
            </div>
            <div class="col col-xs-12 col-sm-4 br-input">
                <label >Nº Documento SEI</label>
                <input id="num_documento_sei_oficio_congresso" 
                    type="text" 
                    name="num_documento_sei_oficio_congresso"  
                    value="{{$oficioEmendas->num_documento_sei_oficio_congresso}}" 
                    required>                   
            </div>
            <div class="column col-xs-12 col-md-4">
                <select-component 
                    :dados="{{$situacaoOficio}}"
                    textolabel="Situação"
                    nomecampo="situacao_oficio_id"
                    textoescolha="Escolha uma Situação"
                    :selecionado="{{$oficioEmendas->situacao_oficio_id}}"
                >
                </select-compenent>
            </div>
        </div>
        <label >Observação</label>
        <textarea class="form-control" 
                    id="dsc_observacao" 
                    name="dsc_observacao"                  
                    rows="10">  {{$oficioEmendas->dsc_observacao}}
                </textarea>
    </div>
    
    
@if($oficioEmendas->situacao_oficio_id == 2)
    <p>
        Gostaríamos de informar sobre as validações realizadas nos CNPJs contidos no {{$oficioEmendas->txt_num_oficio_completo_congresso}}. 
        Após uma análise minuciosa, foram identificadas as seguintes situações:
    </p>
    @if(count($dadosHabManual) > 0)
    <p>
        - CNPJs a Habilitar Manualmente: Após a validação dos dados, foi constatado que os CNPJs abaixo requerem uma habilitação 
        manual no Transferegov. 
    </p>
    <div class="table-responsive-sm">
        <table class="table table-hover">
            <thead>
                <tr class="text-center" >           
                    <th>Nº emenda</th>
                    <th>RP</th>
                    <th>Programa</th>
                    <th>Beneficiário Ofício</th>
                    <th>CNPJ Ofício</th>            
                    <th>Valor Emenda</th>
                    <th>Valor Tarifa</th>
                    <th>Valor Transferegov</th>   
                </tr>
            </thead>
            <tbody> 
            @foreach ($dadosHabManual as $dados)
                <tr>
                    <td class="text-center align-middle">{{$dados->num_emenda}}</td>            
                    <td  class="align-middle">{{$dados->txt_resultado_primario}}</td>
                    <td  class="align-middle">{{$dados->cod_programa}}</td>
                    <td  class="align-middle">{{$dados->txt_beneficiario}}</td>
                    <td  class="align-middle">{{$dados->txt_cnpj}}</td>
                    <td  class="align-middle">{{number_format( ($dados->vlr_emenda), 2, ',' , '.')}}</td>    
                    <td  class="align-middle">{{number_format( ($dados->vlr_tarifa), 2, ',' , '.')}}</td>    
                    <td  class="align-middle">{{number_format( ($dados->vlr_transferegov), 2, ',' , '.')}}</td>             
                </tr>
            @endforeach
            <tr class="total">
                <td  colspan="5" class="text-right"><strong>TOTAL</strong></td>    
                <td class="text-center align-middle">{{number_format( ($totalDadosHabManual['vlr_emenda']), 2, ',' , '.')}}</td>
                <td class="text-center align-middle">{{number_format( ($totalDadosHabManual['vlr_tarifa']), 2, ',' , '.')}}</td>
                <td class="text-center align-middle">{{number_format( ($totalDadosHabManual['vlr_transferegov']), 2, ',' , '.')}}</td>
            </tr>
        </tbody><!-- fechar tbody-->
    </table><!-- fechar table-->
    </div> <!-- table-responsive-sm -->  
    @endif
    
    @if(count($dadosHabLote) > 0)
    <p>
        - CNPJs a Habilitar em Lote: Segue abaixo a lista dos CNPJs que podem ser habilitados em lote no 
        Transferegov (<a targer="_Blank" href="https://discricionarias.transferegov.sistema.gov.br/voluntarias/execucao/ImportarEmendaParlamentar/ImportarEmendaParlamentar.do">Habilitação em Lote</a>). 
    </p>
    <div class="table-responsive-sm">
        <table class="table table-hover">
            <thead>
                <tr class="text-center" >           
                    <th>Nº emenda</th>
                    <th>RP</th>
                    <th>Programa</th>
                    <th>Beneficiário Ofício</th>
                    <th>CNPJ Ofício</th>            
                    <th>Valor Emenda</th>
                    <th>Valor Tarifa</th>
                    <th>Valor Transferegov</th>   
                </tr>
            </thead>
            <tbody> 
            @foreach ($dadosHabLote as $dados)
                <tr>
                    <td class="text-center align-middle">{{$dados->num_emenda}}</td>            
                    <td  class="align-middle">{{$dados->txt_resultado_primario}}</td>
                    <td  class="align-middle">{{$dados->cod_programa}}</td>
                    <td  class="align-middle">{{$dados->txt_beneficiario}}</td>
                    <td  class="align-middle">{{$dados->txt_cnpj}}</td>
                    <td  class="align-middle">{{number_format( ($dados->vlr_emenda), 2, ',' , '.')}}</td>    
                    <td  class="align-middle">{{number_format( ($dados->vlr_tarifa), 2, ',' , '.')}}</td>    
                    <td  class="align-middle">{{number_format( ($dados->vlr_transferegov), 2, ',' , '.')}}</td>   
                </tr>          
            @endforeach
            <tr class="total">
                <td  colspan="5" class="text-right"><strong>TOTAL</strong></td>    
                <td class="text-center align-middle">{{number_format( ($totalDadosHabLote['vlr_emenda']), 2, ',' , '.')}}</td>
                <td class="text-center align-middle">{{number_format( ($totalDadosHabLote['vlr_tarifa']), 2, ',' , '.')}}</td>
                <td class="text-center align-middle">{{number_format( ($totalDadosHabLote['vlr_transferegov']), 2, ',' , '.')}}</td>
            </tr>
        </tbody><!-- fechar tbody-->
    </table><!-- fechar table-->
    <a class="br-button block secondary border-success text-success mr-3" name="cancelar" href='{{ url("/rp/rp8/habiliacao/lote/oficio/$oficioEmendas->oficio_emenda_id") }}'>Download Arquivo
    </a>
    <br/>
    </div> <!-- table-responsive-sm -->  
   
    @endif
    
    @if(count($dadosHabInvalidada) > 0)
    <p>
        - CNPJs Invalidados para Correção: Durante a validação dos registros, identificamos alguns CNPJs que apresentam 
        inconsistências ou informações incorretas. Esses CNPJs foram invalidados e requerem correção antes de serem habilitados em nosso sistema. 
    </p>
    <div class="table-responsive-sm">
        <table class="table table-hover">
            <thead>
                <tr class="text-center" >           
                    <th>Nº emenda</th>
                    <th>RP</th>
                    <th>Programa</th>
                    <th>Beneficiário Ofício</th>
                    <th>CNPJ Ofício</th>          
                </tr>
            </thead>
            <tbody> 
            @foreach ($dadosHabInvalidada as $dados)
                <tr>
                    <td class="text-center align-middle">{{$dados->num_emenda}}</td>            
                    <td  class="align-middle">{{$dados->txt_resultado_primario}}</td>
                    <td  class="align-middle">{{$dados->cod_programa}}</td>
                    <td  class="align-middle">{{$dados->txt_beneficiario}}</td>
                    <td  class="align-middle">{{$dados->txt_cnpj}}</td>           
                </tr>
            @endforeach
        </tbody><!-- fechar tbody-->
    </table><!-- fechar table-->
    </div> <!-- table-responsive-sm -->  
    @endif
@else

@if(count($dadosArquivoHabilitacao) > 0)
    <p>
        - Segue abaixo a lista dos CNPJs enviados no ofício habilitados no ofício. 
    </p>
    <div class="table-responsive-sm">
        <table class="table table-hover">
            <thead>
                <tr class="text-center" >           
                    <th>Nº emenda</th>
                    <th>RP</th>
                    <th>Programa</th>
                    <th>UF</th>
                    <th>Beneficiário Ofício</th>
                    <th>CNPJ Ofício</th>            
                    <th>Nº Indicação Congresso</th>            
                    <th>Valor Emenda</th>
                    <th>Valor Tarifa</th>
                    <th>Valor Transferegov</th>   
                    <th>Ação</th>
                </tr>
            </thead>
            <tbody> 
            @foreach ($dadosHabLote as $dados)
                <tr>
                    <td class="text-center align-middle">{{$dados->num_emenda}}</td>            
                    <td  class="align-middle">{{$dados->txt_resultado_primario}}</td>
                    <td  class="align-middle">{{$dados->cod_programa}}</td>
                    <td  class="align-middle">{{$dados->txt_uf}}</td>
                    <td  class="align-middle">{{$dados->txt_beneficiario}}</td>
                    <td  class="align-middle">{{$dados->txt_cnpj}}</td>
                    <td  class="align-middle">{{$dados->id_indicacao_congresso}}</td>
                    
                    <td  class="align-middle">{{number_format( ($dados->vlr_emenda), 2, ',' , '.')}}</td>    
                    <td  class="align-middle">{{number_format( ($dados->vlr_tarifa), 2, ',' , '.')}}</td>    
                    <td  class="align-middle">{{number_format( ($dados->vlr_transferegov), 2, ',' , '.')}}</td>   
                    <td>
                        <button class="br-button mr-3 warning small block" type="button" onclick="window.location.href='/rp/arquivo/editar/num_indicacao_congresso/emenda/{{$dados->emenda_comissao_id}}'">
                            <i class="fas fa-edit"></i>Editar Nº Indicação
                        </button>
                    </td>
                </tr>          
            @endforeach
            <tr class="total">
                <td  colspan="7" class="text-right"><strong>TOTAL</strong></td>    
                <td class="text-center align-middle">{{number_format( $dadosArquivoHabilitacao->sum('vlr_emenda'), 2, ',' , '.')}}</td>
                <td class="text-center align-middle">{{number_format( $dadosArquivoHabilitacao->sum('vlr_tarifa'), 2, ',' , '.')}}</td>
                <td class="text-center align-middle">{{number_format( $dadosArquivoHabilitacao->sum('vlr_transferegov'), 2, ',' , '.')}}</td>
                <td class="text-center align-middle"></td>
            </tr>
        </tbody><!-- fechar tbody-->
    </table><!-- fechar table-->
   
    <br/>
    </div> <!-- table-responsive-sm -->  
   
    @endif

@endif
    <div class="row">
        <div class="col col-xs-12 col-sm-6">
            <div class="p-3 text-left">
                <button class="br-button primary mr-3" type="submit" name="Salvar" value="Salvar">Salvar
                </button>
            </div>
        </div>
        <div class="col col-xs-12 col-sm-6">
            <div class="p-3 text-right">
                <button class="br-button primary mr-3" type="button" name="imprimir" value="Imprimir" onclick="window.print();">Imprimir
                </button>
                <button class="br-button danger mr-3" type="button"  onclick="window.location.href='/rp/oficio/consultar'">Fechar
                </button>
            </div> 
        </div>
    </div>
    </form>
</div>
@endsection