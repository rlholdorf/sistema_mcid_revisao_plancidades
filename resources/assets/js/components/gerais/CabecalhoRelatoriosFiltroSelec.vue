<template>
    <div>
        <p class="h1-titulo text-blue-warm-vivid-60 text-center">{{titulo}} </p>
    
        <p  class="h4-subtitulo text-gray-70 text-center" v-for="item in subtitulos">{{item}} </p>
        
        <slot>

        </slot>   
        <span class="br-divider lg my-3"> </span>
          <div id="viewlet-below-content-title text-center"></div>
        <div id="viewlet-above-content-body" v-if="barracompartilhar">    
            <div class="row">
                <div class="column col-xs-12 col-md-6">
                    <div class="documentByLine" id="plone-document-byline" >            
                        <span class="documentModified">
                        <span ></span>
                        <span class="value" v-if="dataatualizacao">Atualizado em {{dataatualizacao}}</span>
                        <span class="value" v-if="!dataatualizacao"></span>
                        </span>
                    </div>
                </div>    
                <div class="column col-xs-12 col-md-6 text-right">
                    <div v-if="linkcompartilhar" class="social-links">
                        <label>Compartilhe: </label>
                        <a class="link-clipboard" onclick="event.preventDefault()" title="Copiar para área de transferência" v-bind:href="linkcompartilhar">
                        <span class="fas fa-link"></span>
                        </a>
                        <a v-if="linkcompartilhar" class="link-whatsapp" title="Compartilhar link pelo Whatsapp" v-bind:href="'https://api.whatsapp.com/send?text=' + linkcompartilhar" target="_blanck">
                            <span class="fab fa-whatsapp"></span>
                            <span class="sr-only">Compartilhe no Whatsapp</span>
                        </a>                        
                    </div>
                    
                </div>
                        
            </div> 
        </div>
        <!-- div viewlet-above-content-body --> 
        <span class="br-divider dashed my-3"></span>
    </div>
    <!-- div content-->    
</template>

<script>
    export default {
        props:['url','linkcompartilhar','barracompartilhar','titulo','subtitulos','subtitulo1','subtitulo2','subtitulo3','subtitulo4','subtitulo5','subtitulo6','subtitulo7','dataatualizacao'],
        data(){
            return{
                
            }        
        },
        methods:{

        },    
        mounted() {
 
        }
    }
</script>
