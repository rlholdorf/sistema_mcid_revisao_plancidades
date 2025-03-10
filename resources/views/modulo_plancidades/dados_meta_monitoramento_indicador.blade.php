@extends('layouts.app')

@section('scriptscss')
<link rel="stylesheet" type="text/css" href="{{ asset('css/relatorio_executivo.css') }}" media="screen">
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/custom.css')}}"  media="screen" />

@endsection
@section('content')


<historico-navegacao :url="'{{ url('/home') }}'" :telanterior01="'Plancidades'"
    :telatual="'Cadastrar Monitoramento Indicador'">

</historico-navegacao>


<div class="main-content pl-sm-3 mt-5 container-fluid" id="main-content">

    <cabecalho-relatorios :botaoEditar='false' titulo="Editar Monitoramento da Regionalização"     
        :subtitulo1="'{{$dados_meta_monitoramento->txt_enunciado_objetivo_especifico}}'"
    :linkcompartilhar="'{{ url("/") }}'"
        :barracompartilhar="false">

       

    </cabecalho-relatorios>
   
    <form role="form" method="POST" action='{{ route('plancidades.apuracaoMetaIndicador.editar', ['regionalizacaoMetaId' => $dados_meta_monitoramento->id]) }}'>
        @csrf

        <div class="form-group">
            <div class="row mt-3">
                <div class="col col-xs-12">
                    <div class="br-input">
                        <label for="input-default">Meta</label>
                        <input id="input-default" type="text" placeholder="Placeholder" value="{{$dados_meta_monitoramento->metaIndicador->txt_dsc_meta}}" disabled="true" />                    
                    </div>                    
                </div>
            </div>  
            <div class="row mt-3">
                <div class="col col-xs-12">
                    <div class="br-input">
                        <label for="input-default">Regionalização</label>
                        <input id="input-default" type="text" placeholder="Placeholder" value="{{$dados_meta_monitoramento->regionalizacaoMetaIndicador->regionalizacao->txt_regionalizacao}}" disabled="true" />                    
                      </div>
                    
                    
                </div>
            </div> 
                
            <div class="row mt-3">   
                <div class="titulo">
                    <h3>Valores esperados da meta</h3> 
                </div>                  
                <div class="col col-xs-12 col-sm-3 br-input">
                    <label>Meta da Regionalização para 2024 </label>
                    <input id="vlr_esperado_ano_1" 
                        type="text" 
                        name="vlr_esperado_ano_1"    
                        value="{{$dados_meta_monitoramento->regionalizacaoMetaIndicador->vlr_esperado_ano_1}}"                 
                        disabled>
                </div>
                <div class="col col-xs-12 col-sm-3 br-input">
                    <label>Meta da Regionalização para 2025 </label>
                    <input id="vlr_esperado_ano_2" 
                        type="text" 
                        name="vlr_esperado_ano_2"    
                        value="{{$dados_meta_monitoramento->regionalizacaoMetaIndicador->vlr_esperado_ano_2}}"                 
                        disabled>
                </div>  
                <div class="col col-xs-12 col-sm-3 br-input">
                    <label>Meta da Regionalização para 2026 </label>
                    <input id="vlr_esperado_ano_3" 
                        type="text" 
                        name="vlr_esperado_ano_3"    
                        value="{{$dados_meta_monitoramento->regionalizacaoMetaIndicador->vlr_esperado_ano_3}}"                 
                        disabled>
                </div>
                <div class="col col-xs-12 col-sm-3 br-input">
                    <label>Meta Final da Regionalização </label>
                    <input id="vlr_meta_final_cenario_atual" 
                        type="text" 
                        name="vlr_meta_final_cenario_atual"    
                        value="{{$dados_meta_monitoramento->regionalizacaoMetaIndicador->vlr_meta_final_cenario_alternativo}}"                 
                        disabled>
                </div>                   
            </div>
            <div class="row mt-3" >
                <div class="col col-xs-12 col-sm-3 br-input">
                    <label>Período de Monitoramento</label>
                    <input id="dsc_periodo_monitoramento" 
                        type="text" 
                        name="dsc_periodo_monitoramento"    
                        value="{{$dados_meta_monitoramento->monitoramentoIndicadores->periodoMonitoramento->dsc_periodo_monitoramento}}"                 
                        disabled>
                </div>
                <div class="col col-xs-12 col-sm-3 br-input">
                    <label>Ano</label>
                    <input id="num_ano_periodo_monitoramento" 
                        type="text" 
                        name="num_ano_periodo_monitoramento"    
                        value="{{$dados_meta_monitoramento->monitoramentoIndicadores->num_ano_periodo_monitoramento}}"                 
                        disabled>
                </div>
                <div class="col col-xs-12 col-sm-3 br-input">

                </div>
                <div class="col col-xs-12 col-sm-3 br-input">
                    <label>Valor apurado</label>
                    <input
                        id="vlr_apurado" 
                        type="number" 
                        name="vlr_apurado"    
                        step="0.01"
                        value="{{empty(old('vlr_apurado')) ? $dados_meta_monitoramento->vlr_apurado : old('vlr_apurado')}}"                
                        >
                </div>
            </div>

            <div class="row">
                
                    <div class="p-3 text-right">
                        <button class="br-button primary mr-3" type="submit" name="Salvar Edição" >Salvar
                        </button>
    
    
                        <button class="br-button danger mr-3" type="button"
                            onclick="javascript:window.history.go(-1)">Voltar
                        </button>
                    </div>
               
            </div>
    
        </div>
        <span class="br-divider sm my-3"></span>
    </form>

</div>




  
@endsection