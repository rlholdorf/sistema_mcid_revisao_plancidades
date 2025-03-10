<template>
<div>    
    <div v-bind:class="tipo" role="alert'">
        <div class="icon"><i v-bind:class="icone" aria-hidden="true"></i>
        </div>
        <div class="content">
            <span class="message-title">{{titulonegrito}}</span>
            <span class="message-body"> {{mensagem}}</span></div>
        <div class="close" v-if="botaofechar">
          <button class="br-button circle small" type="button" aria-label="Fechar"><i class="fas fa-times" aria-hidden="true"></i>
          </button>
        </div>
      </div>   
</div>
</template>


<script>
    export default {
        props:['url','tipo','titulonegrito','mensagem','botaofechar','icone'],
        methods:{
                   
        }
    }
</script>
