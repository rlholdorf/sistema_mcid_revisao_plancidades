@extends('layouts.app')

@section('content')
<div id="content" style="width: 100%; height: auto;">
    <div id="viewlet-above-content-title"></div>
    <h1 class="documentFirstHeading">Dados importados</h1>
    <div id="viewlet-below-content-title">
        <div class="documentByLine" id="plone-document-byline">
            
            <span class="documentPublished"><span>Importado por </span> Sandro Gonçalves</span><!-- data publicaçao-->
            <span class="documentPublished"><span>em </span> {{date('d/m/Y',strtotime($dadosArquivo->created_at))}},</span><!-- data publicaçao-->
           
            @if($dadosArquivo->cod_situacao_arquivo == 1)
                    <div class="alert alert-secondary " role="alert">
                        {{$dadosArquivo->situacaoArquivo->dsc_situacao_arquivo}}
                </div>
            @elseif($dadosArquivo->cod_situacao_arquivo == 2)
                    <div class="alert alert-warning " role="alert">
                        {{$dadosArquivo->situacaoArquivo->dsc_situacao_arquivo}}
                </div>
            @elseif($dadosArquivo->cod_situacao_arquivo == 3)
                    <div class="alert alert-danger" role="alert">
                        {{$dadosArquivo->situacaoArquivo->dsc_situacao_arquivo}}<br/>
                        <strong>Justificativa: </strong>{{$dadosArquivo->txt_justificativa}}
                    </div>
            @else
                    <div class="alert alert-success" role="alert">
                        {{$dadosArquivo->situacaoArquivo->dsc_situacao_arquivo}}                        
                    </div>
            @endif    
           
            
            
        </div>
    </div> <!-- viewlet-below-content-title-->
    

    <div id="viewlet-above-content-body"></div>
    <div id="content-core">       
        <div class="form-group">
            <div class="titulo">
                <h5>Dados do Arquivo</h5> 
            </div>
            <div class="row">
                <div class="column col-xs-12 col-md-3">
                    <label class="control-label label-relatorio">Código</label>
                    <input id="cod_arquivos_selecao_secretaria" type="text" class="form-control" name="cod_arquivos_selecao_secretaria" value="{{$dadosArquivo->cod_arquivos_selecao_secretaria}}" disabled >
                </div>
                <div class="column col-xs-12 col-md-6">
                    <label class="control-label label-relatorio">Nome do arquivo</label>
                    <input id="txt_nome_arquivo" type="text" class="form-control" name="txt_nome_arquivo" value="{{$dadosArquivo->txt_nome_arquivo}}" disabled >
                </div>
                <div class="column col-xs-12 col-md-3">
                    <label class="control-label label-relatorio">Qtde Registros</label>
                    <input id="num_registros" type="text" class="form-control" name="num_registros" value="{{$dadosArquivo->num_registros}}" disabled >
                </div>
               
            </div>
            @if($dadosArquivo->bln_valido)
                <div class="row">
                    
                    <div class="column col-xs-12 col-md-12">
                        <label class="control-label label-relatorio">Observação</label>
                        <input id="txt_observacao" type="text" class="form-control" name="txt_observacao" value="{{$dadosArquivo->txt_observacao}}" disabled >
                    </div>
                    
                
                </div>
            @endif
            <div class="titulo">
                <h5>Registros importados</h5> 
            </div>
            <div class="row">
                
                <div class="table-responsive-sm">
                    <table class="table table-hover">
                        <thead>
                            <tr class="text-center" >
                                <th>cod</th>
                                <th>txt_fonte</th>
                                <th>txt_area</th>                    
                                <th>contrato</th>
                                <th>num_protocolo</th>
                                <th>sequencial</th>
                                <th>txt_situacao_contrato</th>
                                <th>txt_agefin</th>
                                <th>txt_uf</th>
                                <th>txt_entidade</th>
                                <th>txt_modalidade</th>
                                <th>txt_submodalidade</th>
                                <th>empreendimento</th>
                                <th>objeto</th>
                                <th>descricao_do_objeto</th>
                                <th>valor_de_emprestimo_r</th>
                                <th>valor_de_contrapartida_r</th>
                                <th>txt_chamada</th>
                                <th>data_da_selecao</th>
                                <th>fase</th>
                                <th>mcid</th>
                                <th>txt_situacao_obra</th>
                                <th>txt_classificacao_cor</th>
                                <th>bln_ativo</th>
                                <th>txt_entidade_tomador</th>
                                <th>txt_entidade_executora</th>
                                <th>txt_eixo</th>
                                <th>txt_subeixo</th>
                                <th>txt_tipo</th>
                                <th>txt_subtipo</th>
                                <th>txt_pt</th>
                                <th>vlr_taxa_administrativa</th>
                                <th>txt_programa</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($dadosSelecao as $dados)
                                <tr class="text-center table-light">
                                    <td>{{$dados->cod_dados_arquivo_selecao_secretaria}}</td>
                                    <td>{{$dados->txt_fonte}}</td>
                                    <td>{{$dados->txt_area}}</td>                    
                                    <td>{{$dados->txt_contrato}}</td>
                                    <td>{{$dados->txt_protocolo}}</td>
                                    <td>{{$dados->txt_sequencial}}</td>
                                    <td>{{$dados->txt_situacao_contrato}}</td>
                                    <td>{{$dados->txt_agefin}}</td>
                                    <td>{{$dados->txt_uf}}</td>
                                    <td>{{$dados->txt_entidade}}</td>
                                    <td>{{$dados->txt_modalidade}}</td>
                                    <td>{{$dados->txt_submodalidade}}</td>
                                    <td>{{$dados->txt_empreendimento}}</td>
                                    <td>{{$dados->txt_objeto}}</td>
                                    <td>{{$dados->dsc_objeto}}</td>
                                    <td>{{$dados->vlr_emprestimo}}</td>
                                    <td>{{$dados->vlr_contrapartida}}</td>
                                    <td>{{$dados->txt_chamada}}</td>
                                    <td>{{$dados->dte_selecao}}</td>
                                    <td>{{$dados->num_fase}}</td>
                                    <td>{{$dados->txt_mcid}}</td>
                                    <td>{{$dados->txt_situacao_obra}}</td>
                                    <td>{{$dados->txt_classificacao_cor}}</td>
                                    <td>{{$dados->bln_ativo}}</td>
                                    <td>{{$dados->txt_entidade_tomador}}</td>
                                    <td>{{$dados->txt_entidade_executora}}</td>
                                    <td>{{$dados->txt_eixo}}</td>
                                    <td>{{$dados->txt_subeixo}}</td>
                                    <td>{{$dados->txt_tipo}}</td>
                                    <td>{{$dados->txt_subtipo}}</td>
                                    <td>{{$dados->txt_pt}}</td>
                                    <td>{{$dados->vlr_taxa_administrativa}}</td>
                                    <td>{{$dados->txt_programa}}</td>
                                </tr>
                            @endforeach    
                        </tbody><!-- fechar tbody-->
                    </table><!-- fechar table-->
                </div> <!-- table-responsive-sm -->
            </div>
            
            @if($dadosArquivo->cod_situacao_arquivo == 1 )
            <form action="{{ url('/saci/propostas/arquivo/validar/') }}" role="form" method="POST">
                @csrf
                <input type="hidden" class="form-control" id="prototipo_id" name="cod_arquivos_selecao_secretaria" value="{{$dadosArquivo->cod_arquivos_selecao_secretaria}}">                                                        
                
                <div class="row">
                    <div class="col col-xs-12 col-sm-12">
                        <label for="validar_arquivo">Validar arquivo</label>           
                        <select 
                            id="validar_arquivo"
                            class="form-control" 
                            name="validar_arquivo" 
                            onchange="validarArquivo(this);"      
                        required>
                            <option value="">Deseja validar o arquivo?</option>
                            
                            <option value="0">Não</option>
                            <option value="1">Sim</option>
                            
                        </select>
                    </div>
                    <div id="divObs" class="col col-xs-12 col-sm-12" style="display: none;">
                        <label for="txt_justificativa">Justificativa:</label>  
                        <textarea id="textAreaObs" class="form-control" id="txt_justificativa" name="txt_justificativa"  rows="10" required></textarea>                 
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-lg btn-block">Validar</button>
            </form> 
            @else
            <div class="row">
                <div class="col col-xs-12 col-sm-12">
                    <form action="{{ url('/saci/propostas/arquivo/cancelar_validacao/') }}" role="form" method="POST">
                        @csrf
                        <input type="hidden" class="form-control" id="prototipo_id" name="cod_arquivos_selecao_secretaria" value="{{$dadosArquivo->cod_arquivos_selecao_secretaria}}">                                                        
                        
                    <button type="submit" class="btn btn-warning  btn-lg btn-block">Cancelar Validação</button>
                </form> 
                </div>
            </div>
            <div class="row">
                
                <div class="col col-xs-12 col-sm-6">
                    <form action="{{ url('/saci/propostas/arquivo/importar/dados') }}" role="form" method="POST">
                            @csrf
                            <input type="hidden" class="form-control" id="prototipo_id" name="cod_arquivos_selecao_secretaria" value="{{$dadosArquivo->cod_arquivos_selecao_secretaria}}">                                                        
                            
                        <button type="submit" class="btn btn-success btn-lg btn-block">Importar dados</button>
                    </form> 
                </div>
                <div class="col col-xs-12 col-sm-6">                   
                        <input class="btn btn-lg btn-danger btn-block" type="button-danger" value="Voltar" onclick="javascript:window.history.go(-1)">  
                   
                </div>
            </div>    
            @endif
        </div><!-- fechar form-group-->
    </div><!-- content-core-->


</div><!-- content-->

@section('scriptsjs')
    <script type="text/javascript" language="javascript">
        function validarArquivo(sender) {
            
            var valor = sender.value;
            if(valor == 0){
                document.getElementById('divObs').style.display = 'block';
                document.getElementById("textAreaObs").required = true;
            }else{
                document.getElementById('divObs').style.display = 'none';
                document.getElementById("textAreaObs").required = false;
            }
            
        }
        </script>

@endsection
@endsection