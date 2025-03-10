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
            :telanterior02="'Painéis'"
            :telatual='"Lista de Painéis"'
            >
            </historico-navegacao>  
            <cabecalho-form
                    :titulo="'Lista de Painéis'"
                   subtitulo1="Configurações"
                    
                    :barracompartilhar="true">
            </cabecalho-form> 
            <div class="form-group">               
                <table class="table table-hover">
                    <thead>
                        <tr class="text-center" >
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Ativo</th>
                        <th>Secretaria</th>
                        <th>Elaborado por</th>    
                        <th>Data Criação</th>    
                        <th>Data Atualização</th>   
                        <th>Acesso Externo</th>   
                        <th>Manuteção</th>   
                        <th>Ver</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($dadosPainel as $dados)
                            <tr class="text-center" >
                            <td>{{$dados->id}}</td>
                            <td>{{$dados->txt_nome_painel}}</td>
                            <td>@if($dados->bln_ativo) Sim @else Não @endif</td>
                            <td>{{$dados->txt_secretaria}}</td> 
                            <td>{{$dados->txt_elaborado_por}}</td> 
                            <td> @if($dados->created_at) {{date('d/m/Y',strtotime($dados->created_at))}} @endif </td>
                            <td> @if($dados->updated_at) {{date('d/m/Y',strtotime($dados->updated_at))}} @endif </td>
                            <td>@if($dados->bln_acesso_externo) Sim @else Não @endif</td>
                            <td>@if($dados->bln_manutencao) Sim @else Não @endif</td>
                            <td>
                                <a href='{{ url("admin/painel/show/$dados->id")}}' type="button"  class="btn  btn-sm"><i class="fas fa-eye"></i></a>
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


