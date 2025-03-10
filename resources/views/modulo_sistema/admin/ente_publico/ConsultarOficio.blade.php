@extends('layouts.app')

@section('scriptscss')
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/custom.css')}}"  media="screen" />
<link rel="stylesheet" type="text/css" href="{{ asset('css/relatorio_executivo.css') }}"  media="screen" > 

@endsection


@section('content')




<historico-navegacao
      :url="'{{ url('/home') }}'"      
      :telanterior01="'Propostas'"  
      :telatual="'Consultar Ofícios'"
      >

</historico-navegacao>


<div class="main-content pl-sm-3 mt-5" id="main-content" style="min-height: 100% width 100%">
  
    <cabecalho-relatorios
        :titulo="'Consulta Ofícios'"
        
       barracompartilhar="false">
    </cabecalho-relatorios> 

    
    <div class="form-group">               
       <p>
        Este formulário permite que você filtre os ente públicos que enviaram ofícios para validarem seu acesso ao sistema. 
       </p>
       <span class="br-divider my-3"></span>
       <form action="{{ url('/admin/ente_publico/oficios/pesquisar') }}" role="form" method="POST">
        {{ csrf_field() }}
            <div class="row">
                <filtro-oficio
                url='{{ url("/") }}' >
                    </filtro-oficio>      
                    
            </div>

           
        </form>

        <span class="br-divider my-3"></span>

        <h4>OFÍCIOS</h4>

        <tabela-oficios
            v-bind:titulos="{{json_encode($cabecalhoTab)}}"
            v-bind:itens="{{json_encode($arquivosOficio)}}" 
            url='{{ url("/") }}' 
        >
        </tabela-oficios> 
    </div>   

                        
   

   

</div>
@endsection


