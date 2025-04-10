<template>
    <div>
        <progresso-revisao-iniciativa
        :url="url"
        :dados-revisao="dadosRevisao"
        :active="'regionalizacao'"
        :dados-meta-revisao="dadosMetaRevisao"
        >
        </progresso-revisao-iniciativa>

        <hr>
        

        <div class="form-group">
            <div class="mt-5">
                <div class="text-center">
                    <span class="fs-5 fw-bold">Metas Regionalizadas</span>
                </div>

                <div class="table-responsive mt-3">
                    
                    <table>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Região</th>
                                <th class="text-center">Meta para 2025 {{this.formatarUnidadeMedida(this.dadosIniciativa.unidade_medida_id)}}</th>
                                <th class="text-center">Nova Meta para 2025 {{this.formatarUnidadeMedida(this.dadosIndicadorRevisao.unidade_medida_id)}}</th>
                                <th class="text-center">Meta para 2026 {{this.formatarUnidadeMedida(this.dadosIniciativa.unidade_medida_id)}}</th>
                                <th class="text-center">Nova Meta para 2026 {{this.formatarUnidadeMedida(this.dadosIndicadorRevisao.unidade_medida_id)}}</th>
                                <th class="text-center">Meta para 2027 {{this.formatarUnidadeMedida(this.dadosIniciativa.unidade_medida_id)}}</th>
                                <th class="text-center">Nova Meta para 2027 {{this.formatarUnidadeMedida(this.dadosIndicadorRevisao.unidade_medida_id)}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            <tr v-for="(item, index) in dadosRegionalizacao">
                                <input type="hidden" :name="`novaRegionalizacao[${index}][regionalizacao_id]`" v-model="dadosRegionalizacaoRevisao[index].regionalizacao_id">
                                <td>{{ (index+1) }}</td>
                                <td>{{ item.txt_sigla_iniciativas_metas_region }}</td>
                                <td class="text-center">{{ item.vlr_esperado_ano_2 }}</td>
                                <td class="text-center">
                                    <input style="width: 150px;"
                                    type="number" 
                                    :name="`novaRegionalizacao[${index}][vlr_esperado_ano_2]`"
                                    step="0.01"
                                    v-model="dadosRegionalizacaoRevisao[index].vlr_esperado_ano_2"
                                    >
                                </td>
                                <td class="text-center">{{ item.vlr_esperado_ano_3 }}</td>
                                <td class="text-center">
                                    <input 
                                    type="number" 
                                    :name="`novaRegionalizacao[${index}][vlr_esperado_ano_3]`"
                                    step="0.01"
                                    v-model="dadosRegionalizacaoRevisao[index].vlr_esperado_ano_3"
                                    
                                    >
                                </td>
                                <td class="text-center">{{ item.vlr_meta_final_cenario_alternativo }}</td>
                                <td class="text-center">
                                    <input
                                    type="number" 
                                    :name="`novaRegionalizacao[${index}][vlr_esperado_ano_4]`"
                                    step="0.01"
                                    v-model="dadosRegionalizacaoRevisao[index].vlr_esperado_ano_4"
                                    >
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>


    <!-- Botões Formulário -->
            <div class="row">
                <div class="col col-xs-12 col-sm-12">
                    <div class="p-3 text-right">
                        <button class="br-button primary mr-3" type="submit">Salvar
                        </button>

                        <a class="br-button danger mr-3" type="button" :href='this.url+"/plancidades/revisao/objetivo_estrategico/consulta"'>Voltar
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    props: ['url', 'dadosRevisao', 'dadosIniciativa', 'dadosIndicadorRevisao', 'dadosRegionalizacao', 'dadosRegionalizacaoRevisao', 'revisaoCadastrada', 'dadosMetaRevisao'],
    data() {
        return {
        //----Campos Select
            bln_meta_regionalizada_nova:'',
            unidadesMedida:'',
            unidadeMedida:'',
            novaUnidadeMedida:this.dadosIniciativa.unidade_medida_simbolo,
            periodicidades:'',
            periodicidade:'',
            polaridades:'',
            polaridade:'',
            novaRegionalizacao:[],

            //----Textos de Escolhas
            textoEscolhaUnidadeMedida: "Escolha uma nova Unidade de Medida:",
            textoEscolhaPeriodicidade: "Escolha uma nova Periodicidade:",
            textoEscolhaPolaridade: "Escolha uma nova Polaridade:",
        }
    },
    methods: {
        formatarUnidadeMedida(unidadeMedidaId){
            switch (unidadeMedidaId){
            case 1:
                return '(R$)';
            case 2:
                return '(%)';
            case 3:
                return '(ADI)';
            case 4:
                return '(m²)';
            case 5:
                return '(UN)';
            default:
                return '';
        }

        },

        // montarNovaRegionalizacao(){
        //     this.dadosRegionalizacao.forEach((item, index) => {
        //         this.novaRegionalizacao[index] = {
        //             'regionalizacao_id':item.regionalizacao_id,
        //             'vlr_esperado_ano_2':null,
        //             'vlr_esperado_ano_3':null,
        //             'vlr_esperado_ano_4':null
        //         };
        //     });
        // }
        
    },
    mounted() {
        axios.get(this.url + '/api/plancidades/unidadesMedida').then(resposta=>{
            this.unidadesMedida = resposta.data;
        }).catch(error=>{
            console.log(error);
        });

        axios.get(this.url + '/api/plancidades/periodicidades').then(resposta=>{
            this.periodicidades = resposta.data;
        }).catch(error=>{
            console.log(error);
        });

        axios.get(this.url + '/api/plancidades/polaridades').then(resposta=>{
            this.polaridades = resposta.data;
        }).catch(error=>{
            console.log(error);
        });
        console.log(this.dadosIniciativa);
    }
}
</script>
