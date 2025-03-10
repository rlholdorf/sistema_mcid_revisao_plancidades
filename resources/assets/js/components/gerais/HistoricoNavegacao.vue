<template>
    <div class="br-breadcrumb">
        <ul class="crumb-list">
            <li class="crumb home"><a class="br-button circle" v-bind:href="url"><span class="sr-only">Página inicial</span><i class="fas fa-home"></i></a></li>
            <li v-if="telanterior01" class="crumb">
                <i class="icon fas fa-chevron-right"></i>
                <a v-if="link1" v-bind:href="link1">{{telanterior01}}</a>
                <span v-if="!link1">{{telanterior01}}</span>
            </li>
            <li v-if="telanterior02" class="crumb">
                <i class="icon fas fa-chevron-right"></i>
                <a v-if="link2" v-bind:href="link2">{{telanterior02}}</a>                
                
                <span v-if="!link2">{{telanterior02}}</span>
            </li>
            <li v-if="telanterior03" class="crumb">
                <i class="icon fas fa-chevron-right"></i>
                <a v-if="link3" v-bind:href="link3">{{telanterior03}}</a>
                <span v-if="!link3">{{telanterior03}}</span>
            </li>
            <li v-if="telanterior04" class="crumb">
                <i class="icon fas fa-chevron-right"></i>
                <a v-if="link4" v-bind:href="link4">{{telanterior04}}</a>
                <span v-if="!link4">{{telanterior04}}</span>
            </li>
            <li v-if="telanterior05" class="crumb">
                <i class="icon fas fa-chevron-right"></i>
                <a v-if="link5" v-bind:href="link5">{{telanterior05}}</a>
                <span v-if="!link5">{{telanterior05}}</span>
            </li>
            <li v-if="telanterior06" class="crumb">
                <i class="icon fas fa-chevron-right"></i>
                <a v-if="link6" v-bind:href="link6">{{telanterior06}}</a>
                <span v-if="!link6">{{telanterior06}}</span>
            </li>
            <li v-if="titulosemlink" class="crumb" ><i class="icon fas fa-chevron-right"></i><span><strong>{{titulosemlink}}</strong></span>
            </li>
            <li class="crumb" data-active="active"><i class="icon fas fa-chevron-right"></i><span>{{telatual}}</span>
            </li>
        </ul>
    </div>
</template>

<script>
    export default {
        props:['url','link1','telanterior01','link2','telanterior02','link3','telanterior03','link4','telanterior04','link5','telanterior05','link6','telanterior06','titulosemlink','telatual'],
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

