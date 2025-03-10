@extends('layouts.app')

@section('scriptscss')
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/custom.css')}}"  media="screen" />

@endsection


@section('content')




<historico-navegacao
      :url="'{{ url('/home') }}'"      
      :telanterior01="'Seleção de Propostas'"  
      :telatual="'Selecionar Proposta'"
      >
     
</historico-navegacao>


<div class="main-content pl-sm-3 mt-5" id="main-content">

    <cabecalho-relatorios
        :titulo="'Selecionar Proposta'"
        
        >

    


    </cabecalho-relatorios> 
   
    
        <p>
            Este formulário permite que você consulte as seleções de propostas realizadas como também iniciar uma nova seleção de proposta. 
        </p>
    <div class="form-group">  
        @if($numSelecaoAndamento == 0)
            <button type="button" class="br-button block secondary mr-3" aria-label="Ícone ilustrativo" onclick="window.location.href='/admin/selecao/propostas/selecionar/nova'">
                <i class="fas fa-edit" aria-hidden="true"></i>Criar Nova Seleção
            </button>    
        @endif

        <span class="br-divider  my-3"></span>
        <div class="table-responsive">	
            <table class="table table-striped  table-hover">
                <thead>
                    <tr>
                        <th>#</th>         
                        <th>Data</th>         
                        <th>Nº Propostas</th>    
                        <th>Situação</th>                                                                                                       
                        <th>Realizada por</th>                                               
                        <th colspan="2" class="text-center">Ação</th>                       
                    </tr>
                                        
                </thead>
                <tbody>
                    @foreach($selecaoProposta as $dados)                                        
                    <tr>                        
                        <td>{{$dados->id}}</td>
                        <td>@if($dados->dte_resultado){{date('d/m/Y',strtotime($dados->dte_resultado))}}@endif</td>
                        <td>{{number_format( ($dados->num_propostas), 0, ',' , '.')}}</td>    
                        <td>@if($dados->bln_selecao_concluida) Concluída @else Em Andamento @endif</td>
                        <td>@if($dados->user) {{$dados->user->name}} @endif</td>
                       
                            @if($dados->bln_selecao_concluida) 
                            <td>
                                <button type="button" class="br-button circle secondary small mr-3" aria-label="Ícone ilustrativo"  title="Visualizar" 
                                    onclick='window.location.href="{{ url("admin/propostas/selecionadas/lista/$dados->id")}}"'>
                                    <i class="fas fa-eye" aria-hidden="true"></i>
                                </button>   
                            </td>     
                            <td></td>  
                            @else 
                            <td>
                            <button type="button" class="br-button circle success small mr-3" aria-label="Ícone ilustrativo" title="Editar" 
                                onclick='window.location.href="{{ url("admin/propostas/selecionadas/lista/$dados->id")}}"'>
                                <i class="fas fa-edit" aria-hidden="true"></i>
                            </button>
                            </td>
                            
                            <td>
                            <botao-acao-icone  
                                :url="'{{ url("/admin/proposta/selecionada/excluir/lista")}}'" 
                                registro="{{$dados->id}}"                               
                                mensagem="Deseja excluir a seleção?" 
                                titulo="Atenção!!!"
                                txtbotaoconfirma="Sim"
                                txtbotaocancela="Cancelar"
                                cssbotao="br-button circle danger small mr-3"                               
                                cssicone="fas fa-trash" 
                            
                            ></botao-acao-icone>           
                            @endif
                        </td>
                    
                    </tr>   
                           
                    @endforeach                                                       
                    
                </tbody>
            </table>     
        </div><!-- fim table-responsive-->


        

       
       
       

          


</div>
@endsection


