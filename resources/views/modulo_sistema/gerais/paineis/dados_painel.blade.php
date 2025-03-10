@extends('layouts.app')

@section('scriptscss')
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/custom.css')}}"  media="screen" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/relatorio_executivo.css') }}"  media="screen" > 
@endsection


@section('content')

  
    <div id="content"> 
        
        <div id="content-core"> 
            <historico-navegacao
                :url="'{{ url('/') }}'"  
                :telanterior01="'Acesso à Informação'"
                :telanterior02="'Painéis de informações'"
                :telanterior02="'@if($dadosPainel->bln_acesso_externo) Painéis Externos @else Painéis Internos @endif'"
                :telatual="'{{$dadosPainel->txt_nome_painel}}'"          
            >
            </historico-navegacao>  

          


    <cabecalho-relatorios
            :titulo="'{{$dadosPainel->txt_nome_painel}}'"            
            :subtitulo1="'{{$dadosPainel->txt_secretaria}}'"
            :subtitulo2="'{{$dadosPainel->txt_elaborado_por}}'"
            :dataatualizacao="'@if($dadosPainel->updated_at) {{$dadosPainel->updated_at->format('d/m/Y')}} @else {{$dadosPainel->created_at->format('d/m/Y')}} @endif'"
            :linkcompartilhar="'{{ url("/painel/visualizar/$dadosPainel->id") }}'"
          
            :barracompartilhar="true"           
            >  
            
    </cabecalho-relatorios> 

    <div class="main-content pl-sm-3 mt-5" id="main-content">
    <span class="br-divider my-3"></span>   
             
         
                <iframe 
                width="1500"
                height="1080"
                    @if($dadosPainel->txt_key_power_bi)
                        src="{{$dadosPainel->txt_caminho_painel}}{{$dadosPainel->txt_key_power_bi}}"
                    @else 
                    src="{{$dadosPainel->txt_caminho_painel}}"
                    @endif
                    frameborder="0"
                    allowFullScreen="true">
                    
                </iframe>

                <div class="p-3 text-right">
                    <button class="br-button primary mr-3" type="button" name="imprimir" value="Imprimir" onclick="window.print();">Imprimir
                    </button>
                    <button class="br-button danger mr-3" type="button" onclick="javascript:window.history.go(-1)">Voltar
                    </button>
                  </div> 

                
       
</div>

@endsection


