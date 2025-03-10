@extends('layouts.app')

@section('scriptscss')
<link rel="stylesheet" type="text/css" href="{{URL::asset('css/custom.css')}}"  media="screen" />
<link rel="stylesheet" type="text/css" href="{{ asset('css/relatorio_executivo.css') }}"  media="screen" > 

@endsection


@section('content')




<historico-navegacao
      :url="'{{ url('/home') }}'"      
      :telanterior01="'Propostas'"  
      :telatual="'Validar Ofícios'"
      >

</historico-navegacao>


<div class="main-content pl-sm-3 mt-5" id="main-content" style="min-height: 100% width 100%">
  
    <cabecalho-relatorios
    :titulo="'{{$arquivoOficio->txt_ente_publico}}'"
    subtitulo1="{{mascaraCnpjCpf($arquivoOficio->ente_publico_id)}}"      
    subtitulo2="{{$arquivoOficio->ds_municipio}}-{{$arquivoOficio->sg_uf}}"      

    :dataatualizacao="' @if($arquivoOficio->bln_documento_validado) {{date('d/m/Y',strtotime($arquivoOficio->dte_validacao))}} @else {{date('d/m/Y',strtotime($arquivoOficio->dte_envio))}} @endif '"
   barracompartilhar="false">

            <div class="text-center">
                @if(!$arquivoOficio->bln_documento_analisado)
                     <span class="feedback warning" role="alert">
                         <i class="fas fa-times-circle" aria-hidden="true"></i>Aguardando Análise
                     </span>
                @else 
                    @if($arquivoOficio->bln_documento_analisado && $arquivoOficio->bln_documento_validado)
                        <span class="feedback success" role="alert">
                            <i class="fas fa-times-circle" aria-hidden="true"></i>Documento Validado
                        </span>
                    @else 
                        <span class="feedback danger" role="alert">
                            <i class="fas fa-times-circle" aria-hidden="true"></i>Documento Invalido: {{$arquivoOficio->dsc_motivo_validacao}}
                        </span>
                    @endif
    
             
                @endif 
            </div>


    </cabecalho-relatorios> 

    
    <div class="form-group">               
       <p>
        Para validar o arquivo clique no icone para abrir o ofício em outra janela, confira os dados do ofício com os dados desta rela e clique em validar.
       </p>
      
       <div class="titulo"><h3>Dados para validação </h3> </div>             
        
        <div class="row">
            <div class="column col-xs-12 col-md-3">
                <label class="control-label label-relatorio">CPF</label>
                <input id="txt_cpf_usuario" type="text" class="form-control input-relatorio" name="txt_cpf_usuario" value="{{mascaraCnpjCpf($arquivoOficio->txt_cpf_usuario)}}" disabled>
            </div>
            <div class="column col-xs-12 col-md-3">
                <label class="control-label label-relatorio">Nome</label>
                <input id="txt_nome" type="text" class="form-control input-relatorio" name="txt_nome" value="{{$arquivoOficio->name}}"  disabled>
            </div>
            <div class="column col-xs-12 col-md-3">
                <label class="control-label label-relatorio">Email</label>
                <input id="email" type="text" class="form-control input-relatorio" name="email" value="{{$arquivoOficio->email}}" disabled>
            </div>
            <div class="column col-xs-12 col-md-3">
                <label class="control-label label-relatorio">Email Ente</label>
                <input id="txt_email_ente_publico" type="text" class="form-control input-relatorio" name="txt_email_ente_publico" value="{{$arquivoOficio->txt_email_ente_publico}}" disabled>
            </div>                
        </div>
        <div class="titulo"><h3>Ofício</h3> </div>  
        <button type="button" class="br-button block secondary small mr-3" aria-label="Ícone ilustrativo" 
        onclick="window.open('/{{$arquivoOficio->txt_caminho_arquivo}}');">
        
            <i class="fas fa-file-pdf" aria-hidden="true"></i> Visualizar Ofício
        </button>     
       
        <form action="{{ url('/admin/ente_publico/oficios/validar/salvar') }}" role="form" method="POST">
            {{ csrf_field() }}
            <input type="hidden" id="arquivo_id" name="arquivo_id" value="{{$arquivoOficio->arquivo_id}}">
            <input type="hidden" id="permissao_id" name="permissao_id" value="{{$arquivoOficio->permissao_id}}">
                <div class="row">                    
                    <valida-oficio
                        url='{{ url("/") }}' >

                    </valida-oficio>
                </div>
                <span class="br-divider my-3"></span>   
            <div class="p-3 text-right">
                <button class="br-button primary mr-3" type="submit" >Salvar
                </button>
                <button class="br-button danger mr-3" type="button" onclick="javascript:window.history.go(-1)">Voltar
                </button>
            </div> 
        </form>
                
    </div>

        

              
    </div>   

                        
   

   

</div>
@endsection


