@extends('layouts.app')

@section('content')
<div id="content">
    <div id="viewlet-above-content-title"></div>
    <h1 class="documentFirstHeading">Lista de Arquivos</h1>
    <div id="viewlet-below-content-title">
       
    </div> <!-- viewlet-below-content-title-->

    <div id="viewlet-above-content-body"></div>
    <div id="content-core">
         
        <div class="titulo">
            <h5>Dados do Arquivo</h5> 
        </div>
        <div class="form-group">           
                <div class="table-responsive-sm">
                    <table class="table table-hover">
                        <thead>
                            <tr class="text-center" >
                                <th>Cód.</th>
                                <th>nome Arquivo</th>
                                <th>Qtde Registros</th>
                                <th>Situação</th>
                                <th>Data de Importação</th>
                                <th>Data Validação</th>
                                <th>Secretaria</th>                                
                                <th>Ver</th>                                
                                <th>Excluir</th>                                
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($arquivos as $dados)
                            @if($dados->situacaoArquivo->cod_situacao_arquivo == 2) 
                                <tr class="text-center table-success"> 
                            @elseif($dados->situacaoArquivo->cod_situacao_arquivo == 3)         
                                <tr class="text-center table-danger">  
                            @else 
                                <tr class="text-center table-light">
                            @endif
                            
                                <td>{{$dados->cod_arquivos_selecao_secretaria}}</td>
                                <td>{{$dados->txt_nome_arquivo}}</td>
                                <td>{{$dados->num_registros}}</td>
                                <td>{{$dados->situacaoArquivo->dsc_situacao_arquivo}}</td>
                                <td>{{date('d/m/Y',strtotime($dados->created_at))}}</td>
                                <td>{{date('d/m/Y',strtotime($dados->dte_validacao))}}</td>
                                <td>{{$dados->secretaria->dsc_secretaria}}</td>
                                <td>
                                    <a href='{{ url("/saci/proposta/importada/$dados->cod_arquivos_selecao_secretaria")}}' type="button" class="btn btn-link">
                                        <i class="fas fa-search"></i></a>
                                </td>        
                                <td>
                                        <botao-acao-icone  
                                        :url="'{{ url("/saci/proposta/arquivo/excluir")}}'" 
                                        registro="{{$dados->cod_arquivos_selecao_secretaria}}"                               
                                        mensagem="Deseja excluir o arquivo?" 
                                        titulo="Atenção!"
                                        txtbotaoconfirma="Sim"
                                        txtbotaocancela="Cancelar"
                                        cssbotao="btn btn-link text-danger"                               
                                        cssicone="fas fa-trash" 
                                        
                                    ></botao-acao-icone>

                                   
                                </td>
                            </tr>    
                                @endforeach    
                            </tbody><!-- fechar tbody-->
                        </table><!-- fechar table-->
                    </div> <!-- table-responsive-sm -->
            
        </div>

        <div class="row">
                
            
            <div class="col col-xs-12 col-sm-12">                   
                    <input class="btn btn-lg btn-danger btn-block" type="button-danger" value="Voltar" onclick="javascript:window.history.go(-1)">  
               
            </div>
    </div><!-- content-core-->


</div><!-- content-->

@section('scriptsjs')
    <script type="text/javascript" language="javascript">
        function checkfile(sender) {
            var validExts = new Array(".xlsx", ".xls");
            var fileExt = sender.value;
            fileExt = fileExt.substring(fileExt.lastIndexOf('.'));
            if (validExts.indexOf(fileExt) < 0) {
                Swal({
                            title: 'Atenção!',
                            text: "Arquivo inválido, os arquivos válidos são dos tipos " + validExts.toString() + " types.",
                            type: 'warning',
                            showCancelButton: false,
                            cancelButtonColor: '#dc3545',
                            cancelButtonText: 'OK',
                            }).then((result) => {
                                if (result.value ) {
                                    this.textoErroArquivo = '';
                                    return;
                                }
                            })
                     
                    
            return false;
            }
            else return true;
        }
        </script>

@endsection

@endsection