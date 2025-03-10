<template>

    
    <div class="form-group">
        <div class="row mt-3">
            <div class="column col-xs-12">
                <label for="regionalizacao_meta_indicador_id">Regionalização</label>
                <select id="regionalizacao_meta_indicador_id" class="form-select br-select" name="regionalizacao_meta_indicador_id" 
                @change="onChangeRegionalizacao" v-model="regionalizacaoMeta" required>
                    <option value="">Escolha uma Regionalização da meta:</option>
                    <option v-for="item in regionalizacoesMetas" v-text="item.txt_regionalizacao" :value="item.regionalizacao_metas_objetivos_estrategicos_id"
                        :key="item.id"></option>
                </select>
            </div>
        </div>  
            
        <div class="row mt-3" v-if="this.regionalizacaoMeta">   
            <div class="titulo">
                <h3>Valores esperados da meta</h3> 
            </div>                  
            <div class="col col-xs-12 col-sm-3 br-input">
                <label>Valor meta 2024 </label>
                <input id="vlr_esperado_ano_1" 
                    type="text" 
                    name="vlr_esperado_ano_1"    
                    :value="this.dadosMeta.vlr_esperado_ano_1"                 
                    disabled>
            </div>
            <div class="col col-xs-12 col-sm-3 br-input">
                <label>Valor meta 2025 </label>
                <input id="vlr_esperado_ano_2" 
                    type="text" 
                    name="vlr_esperado_ano_2"    
                    :value="this.dadosMeta.vlr_esperado_ano_2"                 
                    disabled>
            </div>  
            <div class="col col-xs-12 col-sm-3 br-input">
                <label>Valor meta 2026 </label>
                <input id="vlr_esperado_ano_3" 
                    type="text" 
                    name="vlr_esperado_ano_3"    
                    :value="this.dadosMeta.vlr_esperado_ano_3"                 
                    disabled>
            </div>
            <div class="col col-xs-12 col-sm-3 br-input">
                <label>Valor meta final </label>
                <input id="vlr_meta_final_cenario_atual" 
                    type="text" 
                    name="vlr_meta_final_cenario_atual"    
                    :value="this.dadosMeta.vlr_meta_final_cenario_atual"                 
                    disabled>
            </div>                   
        </div>
        <div class="row mt-3"  v-if="this.regionalizacaoMeta">                    
            <div class="col col-xs-12 col-sm-4 br-input">
                <label>Período Monitoramento</label>
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
                <input id="vlr_apurado" 
                    type="number" 
                    name="vlr_apurado"
                    step="0.01"
                    v-model.number="vlr_apurado"
                    required
                >
            </div>
        </div>
        
        <input type="hidden" id="bln_meta_regionalizada" name="bln_meta_regionalizada" :value="this.meta_indicador.bln_meta_regionalizada ? true : false">
        
    </div>
</template>

<script>
    export default {
        props: ['url', 'meta_indicador','monitoramento_id','dsc_periodo_monitoramento','num_ano_periodo_monitoramento'],
        data() {
            return {          
                regionalizacoesMetas:'',
                regionalizacaoMeta:'',
                dadosMeta:'',
                vlr_apurado:'',

            }
        },
        methods: {
            onChangeRegionalizacao() {
                if (this.regionalizacaoMeta != '') {           
                    axios.get(this.url + '/api/plancidades/regionalizacaoMetaIndicador/regionalizacao/'+ this.regionalizacaoMeta).then(resposta => {
                       this.dadosMeta = resposta.data;                    
                    }).catch(error => {
                        console.log(error);
                    });
                }else{
                    this.regionalizacaoMeta = '';
                    
                }        
            }
        },
        mounted() {
        //retorna as Unidades Responsáveis
            axios.get(this.url + '/api/plancidades/regionalizacao/meta_indicador/' + this.meta_indicador.id+ '/' + this.monitoramento_id).then(resposta => {
                this.regionalizacoesMetas = resposta.data;
            }).catch(error => {
                console.log(error);
            });   
            
            if(!this.meta_indicador.bln_meta_regionalizada){
                this.dadosMeta = this.meta_indicador
            }
        }
    }
</script>
