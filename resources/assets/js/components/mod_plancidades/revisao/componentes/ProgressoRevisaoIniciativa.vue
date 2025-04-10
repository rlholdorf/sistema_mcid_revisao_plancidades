<template>
        <div class="my-5">
            <div class="text-center mb-3">
                <span class="text-bold">Progresso da Revisão</span>
            </div>
            <nav class="br-step" data-initial="" data-label="top" data-scroll="data-scroll" role="none">
                <div class="step-progress" role="listbox" aria-orientation="horizontal" aria-label="Lista de Opções">
                <button :class="{'step-progress-btn':true, 'active':iniciativa}" role="option" aria-posinset="1" aria-setsize="5" type="button" :data-alert="dadosRevisao.bln_iniciativa?'success':'info'" @click="irParaPagina('/plancidades/revisao/iniciativa/' + dadosRevisao.id + '/criar', iniciativa)"><span class="step-info">Iniciativa</span><span class="step-alert"></span></button>
                <button :class="{'step-progress-btn':true, 'active':indicador}" role="option" aria-posinset="2" aria-setsize="5" type="button" :data-alert="dadosRevisao.bln_indicador?'success':'info'" @click="irParaPagina('/plancidades/revisao/indicador/iniciativa/' + dadosRevisao.id + '/criar', indicador)" :disabled="!dadosRevisao.bln_iniciativa"><span class="step-info">Indicador da Iniciativa</span><span class="step-alert"></span></button>
                <button :class="{'step-progress-btn':true, 'active':metas}" role="option" aria-posinset="3" aria-setsize="5" type="button" :data-alert="dadosRevisao.bln_metas?'success':'info'" @click="irParaPagina('/plancidades/revisao/meta/iniciativa/' + dadosRevisao.id + '/criar', metas)" :disabled="!dadosRevisao.bln_indicador"><span class="step-info">Detalhamento da Meta</span><span class="step-alert"></span></button>
                <button v-if="this.metaRegionalizada()" :class="{'step-progress-btn':true, 'active':regionalizacao}" role="option" aria-posinset="4" aria-setsize="5" type="button" :data-alert="dadosRevisao.bln_regionalizacao?'success':'info'" @click="irParaPagina('/plancidades/revisao/regionalizacao/iniciativa/' + dadosRevisao.id + '/criar', regionalizacao)" :disabled="!dadosRevisao.bln_metas"><span class="step-info">Regionalização</span><span class="step-alert"></span></button>
                <button :class="{'step-progress-btn':true, 'active':finalizar}" role="option" aria-posinset="4" aria-setsize="5" type="button" data-alert="warning" @click="irParaPagina('/plancidades/revisao/iniciativa/exibir/' + dadosRevisao.id, finalizar)"><span class="step-info">Finalizar</span><i class="step-icon fas fa-check" aria-hidden="true"></i><span class="step-alert"></span></button>
                </div>
            </nav>
        </div>
</template>

<script>
export default {
    props: ['url', 'dadosRevisao', 'active', 'dadosMetaRevisao'],
    data() {
        return {
            iniciativa:false,
            indicador:false,
            metas:false,
            regionalizacao:false,
            finalizar:false
        }
    },
    methods: {
        irParaPagina(destino, paginaAtual){
            if(paginaAtual){
                return;
            }
            window.location.href = this.url + destino;
        },

        metaRegionalizada(){
            if(this.dadosMetaRevisao){
                return this.dadosMetaRevisao.bln_meta_regionalizada ? true:false
            }else{
                return false;
            }
        },

        setActive(){
            if(this.active=='iniciativa'){
                this.iniciativa = true;
            }
            if(this.active=='indicador'){
                this.indicador = true;
            }
            if(this.active=='metas'){
                this.metas = true;
            }
            if(this.active=='regionalizacao'){
                this.regionalizacao = true;
            }
            if(this.active=='finalizar'){
                this.finalizar = true;
            }
            
        },
        //debug
        printDadosRevisao(){
            console.log(this.dadosRevisao);
        }
    },
    mounted() {
        this.setActive();
    }
}
</script>
