@extends('layouts.app')

@section('content')
<div id="content">
    <div id="viewlet-above-content-title"></div>
    <h1 class="documentFirstHeading">Importar arquivo com dados</h1>
    <div id="viewlet-below-content-title">
       
    </div> <!-- viewlet-below-content-title-->

    <div id="viewlet-above-content-body"></div>
    <div id="content-core">
        <form action="{{ url('/saci/propostas/arquivo/importar/') }}" role="form" method="POST" enctype="multipart/form-data">
            @csrf
                <div class="row">
                    <div class="col col-xs-12 col-sm-12">
                        <label for="secretaria">Secretaria</label>           
                        <select 
                            id="secretaria"
                            class="form-control" 
                            name="secretaria"       
                           required>
                            <option value="">Escolha uma Secretaria:</option>
                            @foreach($secretaria as $dados)
                                <option value="{{$dados->cod_secretaria}}">{{$dados->txt_sigla_secretaria}} - {{$dados->dsc_secretaria}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

            <div class="row">
                <div class="col-xs-12 col-md-12">
                    
                    <label for="txt_caminho_arquivo">Importe o arquivo txt com os dados das propostas.</label>
                    <input type="file" 
                        class="form-control-file" 
                        id="txt_caminho_arquivo" 
                        name="txt_caminho_arquivo" 
                        accept=".xlsx, .xls" 
                        onchange="checkfile(this);"
                        >                                                                
                </div>  
            </div>  
            <button type="submit" class="btn btn-primary btn-lg btn-block">Salvar</button>
        </form>    
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