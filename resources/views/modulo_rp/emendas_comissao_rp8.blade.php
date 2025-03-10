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
    
<form action="{{ url('/rp/arquivo/atualizar/registro/emenda/') }}" role="form" method="POST" enctype="multipart/form-data">
        @csrf
    <input type="hidden" id="emenda_comissao_id" name="emenda_comissao_id" value="{{$emendaComissao->id}}">
    <emendas-comissao-rp8
        :url="'{{ url('/') }}'"
        v-bind:dados="{{json_encode($emendaComissao)}}" 
        blnindicacao="{{$blnIndicacao}}">

    </emendas-comissao-rp8>
    </form>
</div>
@endsection