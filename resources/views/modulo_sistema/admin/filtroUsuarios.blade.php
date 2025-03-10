@extends('layouts.app')

@section('scriptscss')
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/custom.css')}}"  media="screen" />
<link rel="stylesheet" type="text/css" href="{{ asset('css/relatorio_executivo.css') }}"  media="screen" > 

@endsection


@section('content')

  
    <div id="content"> 
        
        <div id="content-core"> 
            <historico-navegacao
                :url="'{{ url('/home') }}'"
                :telanterior01="'Administrador'"
                :telanterior02="'Usuários'"
                :telatual='"Filtro de Usuários"'
                >
            </historico-navegacao>
            <cabecalho-form
                    :titulo="'Usuários'"
                    :linkcompartilhar="'{{ url("/admin/usuarios/filtro") }}'"
                    :barracompartilhar="true">
            </cabecalho-form> 
            <form action="{{ url('/admin/usuarios/pesquisar') }}" method="POST">
            <b>Este formulário permite que você filtre os usuários cadastrados no sistema a partir dos parâmetros selecionados.</b>
            <div class="form-group">
                
                     @csrf
                     <div class="well">
                         <div class="box">                                                                                 
                            <filtro-usuarios 
                                :url="'{{ url('/') }}'">
                            </filtro-usuarios>
                         </div>
                     </div>    
                    
                 
               
           </div><!--form-group -->  
           <div class="form-group">
            <div class="row">                                                    
                <div class="column col-xs-12 col-md-12">
                    <button type="submit" class="btn btn-primary btn-block">Pesquisar</button>  
                </div>
            </div><!--form-group -->  
        </form> 
        </div>     
    </div>   
    <!-- content-core -->
</div>    
<!-- content -->
@endsection


