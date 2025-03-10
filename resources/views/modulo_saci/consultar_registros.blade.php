@extends('layouts.app')

@section('scriptscss')
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/custom.css')}}"  media="screen" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/relatorio_executivo.css') }}"  media="screen" > 
@endsection


@section('content')

<historico-navegacao
      :url="'{{ url('/home') }}'"      
      :telanterior01="'SACI WEB'"      
      :telatual="'Consultar registros importados/Cadastrados'"
      >

</historico-navegacao>


<div class="main-content pl-sm-3 mt-5" id="main-content">
  
    <cabecalho-form
       :titulo="'Consultar registros importados/Cadastrados'"
       :linkcompartilhar="'{{ url("/saci/propostas/") }}'"
       barracompartilhar="true">
    </cabecalho-form> 

    <form action="{{ url('/saci/registros/pesquisar/') }}" role="form" method="POST">
        @csrf
        <form-cons-registro 
                :url="'{{ url('/') }}'" >
        </form-cons-registro>

        <div class="p-3 text-right">
            <button class="br-button primary mr-3" type="submit" name="Pesquisar">Pesquisar
            </button>
            <button class="br-button danger mr-3" type="button" onclick="javascript:window.history.go(-1)">Voltar
            </button>
          </div> 
    
          <span class="br-divider sm my-3"></span>
    
        
            <h4>Meus Registros</h4> 
            <span class="br-divider sm my-3"></span>
        <div class="form-group">           
                <div class="table-responsive-sm">
                    <table class="table table-hover">
                        <thead>
                            <tr class="text-center" >
                                <th>Cód.</th>
                                <th>Contrato</th>
                                <th>Data Carga</th>
                                <th>Tipo Carga</th>                                
                                <th>Usuário</th>                                
                                <th>Ver</th>                                
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($registros as $dados)                                   
                            <tr class="text-center">
                                <td>{{$dados->cod_contrato_pac}}</td>
                                <td>{{$dados->cod_contrato}}</td>
                                <td>{{date('d/m/Y',strtotime($dados->dte_carga))}}</td>
                                <td>@if($dados->bln_importado_por_arquivo == true) Registro importado por arquivo @else Registro cadastro pelo formulário @endif</td>
                                <td>{{$dados->txt_login_usuario}}</td>
                                <td>
                                    <a href='{{ url("/saci/contrato/$dados->cod_contrato_pac")}}' type="button" class="br-button circle secondary mr-3">
                                        <i class="fas fa-eye"></i></a>
                                </td>
                            </tr>    
                                @endforeach    
                            </tbody><!-- fechar tbody-->
                        </table><!-- fechar table-->
                    </div> <!-- table-responsive-sm -->
            
        </div>
    </form> 

</div>

@endsection


