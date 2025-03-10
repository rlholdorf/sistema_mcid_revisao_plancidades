<template>
<div class="form-group">  

    <div class="mb-3">
        <label for="formFile" class="form-label">Anexe o arquivo com o Ofício <em>(o arquivo deve estar legível, em formato pdf)</em>:</label>
        <input class="form-control" type="file" 
            id="txt_caminho_oficio" 
            name="txt_caminho_oficio" 
            accept="application/pdf" 
            @change="handleFileSelect" 
            required>
      </div>
</div>


</template>

<script>
    export default {
        props:['url','errorshas','errorsfirst', 'token','enctype','metodo','css','action','show'],
        data(){
            return{
                txt_caminho_oficio: '',
                bln_arquivo_valido:'false',
                textoValidadeOficio:'',
                textoErroArquivo:'',
                nomeArquivoFile:'',
                quantArquivos:0,
                
            }        
        },
        methods:{
            handleFileSelect(evt) {
                    let tamanhoMaximo = 2 * 1024 * 1024;
                    var files = evt.target.files; // FileList object
                    var valido = true;
                    this.nomeArquivoFile = evt.target.name;
                    
               

              
                    if(files[0].size > tamanhoMaximo) {
                        this.nomeArquivoFile = 'txt_caminho_oficio';
                        $("#txt_caminho_oficio").val("");
                        this.textoErroArquivo = "O tamanho máximo é 2MB";                               
                        valido = false;
                    }else{
                         var extPermitidas = ['pdf'];
                        if(this.verificaExtensao(files[0].name, extPermitidas)){
                                    valido = true;
                                }else{
                                    $("#txt_caminho_oficio").val("");
                                     this.textoErroArquivo = "Somente Pdfs são aceitos";
                                    valido = false;
                                }
                    }    


                    
                    if(!valido){
                     Swal({
                            title: 'Atenção!',
                            text: this.textoErroArquivo,
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
                    }        
                },
                verificaExtensao($arquivo, $extPermitidas) {
                    
                    var extArquivo = $arquivo.split("\\").pop().substring($arquivo.split("\\").pop().lastIndexOf('.')+1, $arquivo.split("\\").pop().length) || $arquivo.split("\\").pop();
                   
                    if(typeof $extPermitidas.find(function(ext){ return extArquivo == ext; }) == 'undefined') {
                        return false;
                    } else {
                        return true;
                    }
                }
            
        },
        mounted() {
           
        }
    }
</script>
