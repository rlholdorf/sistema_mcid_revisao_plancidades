<template>
    <div class="form-group">
        <div class="row mt-3" v-if="this.meta_iniciativa">   
            <div class="titulo">
                <h3>Valores esperados da meta</h3> 
            </div>                  
            <div class="col col-xs-12 col-sm-3 br-input">
                <label>Valor meta 2024 </label>
                <input id="vlr_esperado_ano_1" 
                    type="text" 
                    name="vlr_esperado_ano_1"    
                    :value="this.meta_iniciativa.vlr_esperado_ano_1"                 
                    disabled>
            </div>
            <div class="col col-xs-12 col-sm-3 br-input">
                <label>Valor meta 2025 </label>
                <input id="vlr_esperado_ano_2" 
                    type="text" 
                    name="vlr_esperado_ano_2"    
                    :value="this.meta_iniciativa.vlr_esperado_ano_2"                 
                    disabled>
            </div>  
            <div class="col col-xs-12 col-sm-3 br-input">
                <label>Valor meta 2026 </label>
                <input id="vlr_esperado_ano_3" 
                    type="text" 
                    name="vlr_esperado_ano_3"    
                    :value="this.meta_iniciativa.vlr_esperado_ano_3"                 
                    disabled>
            </div>
            <div class="col col-xs-12 col-sm-3 br-input">
                <label>Valor meta final </label>
                <input id="vlr_meta_final_cenario_atual" 
                    type="text" 
                    name="vlr_meta_final_cenario_atual"    
                    :value="this.meta_iniciativa.vlr_meta_final_cenario_atual"                 
                    disabled>
            </div>                   
        </div>
        <div class="row mt-3"  v-if="this.meta_iniciativa">                    
            <div class="col col-xs-12 col-sm-4 br-input">
                <label>Período Monitoramentos</label>
                <input id="dsc_periodo_monitoramento" 
                    type="text" 
                    name="dsc_periodo_monitoramento"    
                    :value="this.dsc_periodo_monitoramento"                 
                    disabled>
            </div>
            <div class="col col-xs-12 col-sm-4 br-input">
                <label>Ano</label>
                <input id="num_ano_periodo_monitoramento" 
                    type="text" 
                    name="num_ano_periodo_monitoramento"    
                    :value="this.num_ano_periodo_monitoramento"                 
                    disabled>
            </div>
            <div class="col col-xs-12 col-sm-4 br-input">
                <label>Valor apurado</label>
                <input id="vlr_apurado_global" 
                    type="number" 
                    name="vlr_apurado_global"
                    step=".01"
                    v-model.number="vlr_apurado_global"
                    required> <!--/^\d+\.\d{2,2}$/ -->
            </div>
        </div>

        <input type="hidden" id="bln_meta_regionalizada" name="bln_meta_regionalizada" :value="this.meta_iniciativa.bln_meta_regionalizada ? true : false">

    </div>
</template>

<script>
    export default {
        props: ['url', 'meta_iniciativa','dsc_periodo_monitoramento','num_ano_periodo_monitoramento'],
        data() {
            return {       
                vlr_apurado_global:'',
            }
        },
        methods: {
        },
        mounted() {
        }
    }
</script>
