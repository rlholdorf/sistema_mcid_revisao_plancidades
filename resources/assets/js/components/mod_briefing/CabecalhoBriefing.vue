<template>
    <div id="cabecalho_briefing" class="cabecalho_briefing">
        <div class="text-center">
            <img v-bind:src="url + '/img/briefing/banner_briefing.png'" alt="Imagem ilustrativa"/>
        </div>

        <p class="titulo-cabecalho-briefing  text-center">{{titulo}} </p>
        <p  class="h5-subtitulo text-blue-70 text-center">{{subtitulo1}} </p>
        <p  class="h4-subtitulo text-gray-70 text-center">{{subtitulo2}} </p>
        <p  class="h3-subtitulo text-gray-70 text-center">{{subtitulo3}} </p>
        <p  class="text-gray-70 text-center">{{subtitulo4}} </p>
        <p  class="text-gray-70 text-center">{{subtitulo5}} </p>
        <slot>

        </slot>   
        <div class="image-card-briefing text-center">
            <img v-bind:src="url + '/img/briefing/paleta_cores_bm.png'" alt="Imagem ilustrativa"/>
        </div>
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
       
    </div>
    <!-- div content-->    
</template>

<script>
    export default {
        props:['url','linkcompartilhar','barracompartilhar','titulo','subtitulo1','subtitulo2','subtitulo3','subtitulo4','subtitulo5','dataatualizacao'],
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
