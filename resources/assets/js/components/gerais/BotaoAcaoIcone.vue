<template>
<div>    

<input v-if="!cssicone" v-bind:class="cssbotao" type="button" @click="onClickEnviar()" v-model="textobotao">
    <button v-if="cssicone" v-bind:class="cssbotao" type="button" @click="onClickEnviar()" aria-hidden="true" :disabled="btndisabled"><i v-bind:class="cssicone"></i>{{this.textobotao}}</button>    
</div>
</template>


<script>
    export default {
        props:['url','registro','acao','mensagem','titulo','classbotao','icone','txtbotaoconfirma','txtbotaocancela','cssbotao','cssicone','textobotao','tipo','btndisabled'],
        methods:{
            onClickEnviar() {   
                             
               
                    Swal({
                       title: this.titulo,
                        text: this.mensagem,
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#28a745',
                        cancelButtonColor: '#dc3545',
                        confirmButtonText: this.txtbotaoconfirma,
                        cancelButtonText: this.txtbotaocancela,
                        }).then((result) => {
                            if (result.value ) {
                                 window.location.href= this.url + '/'+ this.registro;
                            }else{
                             
                            }
                        })
               
            }        
        }
    }
</script>
