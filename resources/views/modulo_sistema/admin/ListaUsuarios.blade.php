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
            :telanterior03="'Filtro de Usuários'"
            :link3="'{{ url('/admin/usuarios/filtro') }}'"
            :telatual='"Relação de Usuários"'
            >
            </historico-navegacao>  
            <cabecalho-form
                    :titulo="'Relação de Usuários'"
                    @if($subtitulo1) subtitulo1="{{$subtitulo1}} " @endif
                    
                    :barracompartilhar="true">
            </cabecalho-form> 
            <div class="form-group">               
                <table class="table table-hover">
                    <thead>
                        <tr class="text-center" >
                        <th>UF</th>
                        <th>Município</th>
                        <th>Ente Público</th>
                        <th>Nome do Usuário</th>
                        <th>Tipo Usuário</th>    
                        <th>Status Usuário</th>    
                        <th>Data Aceite</th>   
                        <th>Cadastrado via</th>   
                        <th>Ver</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($usuarios as $usuario)
                            <tr class="text-center" >
                            <td>{{$usuario->txt_sigla_uf}}</td>
                            <td>{{$usuario->ds_municipio}}</td>
                            <!-- verifica se existe resposaveis cadastrados e mostra apenas o ativo-->
                            <td>{{$usuario->txt_ente_publico}}</td> 
                            <td>{{$usuario->name}}</td> 
                            <td>{{$usuario->txt_tipo_usuario}}</td>
                            <td><span class="label label-danger">{{$usuario->txt_status_usuario}}</span></td>
                            <td> @if($usuario->dte_aceite_termo) {{date('d/m/Y',strtotime($usuario->dte_aceite_termo))}} @endif </td>
                            <td>@if(!$usuario->bln_user_forms_google) Via sistema @else Via formulário do google @endif</td>
                            <td>
                                <a href='{{ url("admin/usuario/$usuario->usuario_id")}}' type="button"  class="btn  btn-sm"><i class="fas fa-eye"></i></a>
                            </td>            
                           </tr>                     
                    @endforeach
                    </tbody>
                    </table><!-- fechar table-->
            </div>   
        
            <div class="form-group">
                <div class="row">
                    <div class="column col-xs-12 col-md-6">
                        <input class="btn btn-lg btn-info btn-block" type="button" name="imprimir" value="Imprimir" onclick="window.print();">    
                    </div>
                    <div class="column col-xs-12 col-md-6">
                        <input class="btn btn-lg btn-danger btn-block" type="button-danger" value="Voltar" onclick="javascript:window.history.go(-1)">  
                    </div>    
                </div>
            </div> 
    </div>   
    <!-- content-core -->
</div>    
<!-- content -->
@endsection


