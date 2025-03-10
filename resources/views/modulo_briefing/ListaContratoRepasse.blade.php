@extends('layouts.app')

@section('scriptscss')
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/fichaAudiencia.css')}}"  media="screen" />
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/relatorio_executivo.css')}}"  media="screen" />


@endsection

@section('scriptsjs')

<link rel="stylesheet" type="text/css" href="{{ asset('css/graficos.css') }}"  media="screen" > 
<script src="{{URL::asset('js/fichaAudiencia.js')}}"></script>


@endsection


@section('content')

<historico-navegacao
      :url="'{{ url('/home') }}'"      
      :telanterior01="'Briefing Ministerial'"  
       :telanterior02="'Consultar Município'"  
       :telanterior03="'Ficha Briefing'"  
      :telatual="'Contratos de repasse'"
      >

</historico-navegacao>


<div class="main-content pl-sm-3 mt-5 container-fluid" id="main-content">
    <div class="text-center">
        <img src='{{ URL::asset("/img/briefing/banner_briefing.png")}}' alt="Imagem ilustrativa"/>
    </div>
    
        <cabecalho-relatorios
            titulo="Contratos de Repasse"            
            :subtitulo1="'{{$municipio->ds_municipio}} - {{$municipio->uf->txt_sigla_uf}}'"            
            
            :linkcompartilhar="'{{ url("/api/briefing/ficha_briefing/pesquisar/estado/$estado->id/municipio/$municipio->id") }}'"
            :barracompartilhar="true">
        </cabecalho-relatorios>

    <div class="form-group">
        <div class="table-responsive-sm">
            <table class="table table-hover table-sm">
                <thead>
                    <tr class="text-center" >
                        <th>#</th>
                        <th>Convênio</th>
                        <th>Proposta</th>
                        <th>Objeto</th>
                        <th>Ano Contrato</th>
                        <th>Gestão Atual</th>
                        <th>Secretaria</th>                
                        <th>Situação Objeto</th>                
                        <th>Situação Contrato</th>                
                        <th>Valor Repasse</th>                
                        <th>Valor Contrapartida</th>                
                        <th>Valor Investimento</th>                                        
                        <th>Valor Empenhado</th>                                        
                        <th>Ação</th>                
                    </tr>
                </thead>
                <tbody> 
                    @foreach($contratoRepasseMunic as $dados) 
                            <tr class="text-center">
                                <td>{{$loop->index+1}}</td>
                                <td>{{$dados->num_convenio}}</td>
                                <td>{{$dados->num_proposta}}</td>
                                <td>{{$dados->objeto_instrumento}}</td>
                                <td>{{$dados->ano_contrato}}</td>
                                <td>{{$dados->bln_contratadas_gestao_atual}}</td>
                                <td>{{$dados->secretaria}}</td>
                                <td>{{$dados->dsc_situacao_objeto_mcid}}</td>
                                <td>{{$dados->dsc_situacao_contrato_mcid}}</td>
                                <td class="text-center">{{number_format($dados->vlr_repasse, 2, ',' , '.')}}</td>      
                                <td class="text-center">{{number_format($dados->vlr_contrapartida, 2, ',' , '.')}}</td>      
                                <td class="text-center">{{number_format($dados->vlr_investimento, 2, ',' , '.')}}</td>    
                                <td class="text-center">{{number_format($dados->vlr_empenhado, 2, ',' , '.')}}</td>    
                                <td>
                                    <button type="submit" class="br-button circle secondary mr-3" aria-label="Ícone ilustrativo"
                                    onclick='window.location.href="{{ url("/carteira_investimento/contrato_tci/cod_tci/$dados->cod_tci")}}"'>
                                        <i class="fas fa-eye" aria-hidden="true"></i>
                                    </button>       
                                </td>  
                                
                       @endforeach
                       <tr class="text-center total">   
                        <td colspan="10" > TOTAL</td>
                        <td class="text-center">{{number_format($contratoRepasseMunic->SUM('vlr_repasse'), 0, ',' , '.')}}</td>
                        <td class="text-center">{{number_format($contratoRepasseMunic->SUM('vlr_contrapartida'), 0, ',' , '.')}}</td>
                        <td class="text-center">{{number_format($contratoRepasseMunic->SUM('vlr_investimento'), 2, ',' , '.')}}</td>
                        <td></td>
                       </tr>
                </tbody><!-- fechar tbody-->
            </table><!-- fechar table-->
        </div> <!-- table-responsive-sm -->  
    </div>
    

<br>
  
    <div class="p-3 text-right">
        <button class="br-button primary mr-3" type="button" name="imprimir" value="Imprimir" onclick="window.print();">Imprimir
        </button>
        <button class="br-button danger mr-3" type="button"  onclick="javascript:window.history.go(-1)">Voltar
        </button>
    </div>   

</div>

@endsection



