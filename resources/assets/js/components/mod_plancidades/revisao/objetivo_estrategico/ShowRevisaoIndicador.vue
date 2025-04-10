<template>
    <div>
        <div class="form-group">
            <p class="text-center"><b>Informações da Revisão</b></p>
            <div class="row mt-3">
                <div class="column col-xs-12 col-sm-3">
                    <label>Ano da Revisão</label>
                    <p v-text="dadosIndicador.num_ano_periodo_revisao"></p>
                </div>

                <div class="column col-xs-12 col-sm-3">
                    <label>Periodo da Revisão</label>
                    <p v-text="dadosIndicador.dsc_periodo_monitoramento"></p>
                </div>

                <div class="column col-xs-12 col-sm-3">
                    <label for="situacaoRevisao">Situação da Revisão</label>
                    <p v-text="txt_situacao_revisao"></p>
                </div>

                <div class="column col-xs-12 col-sm-12">
                    <label for="observacaoRevisao">Observações CGPI sobre a Revisão</label>
                    <p v-text="situacao_revisao_observacao"></p>
                </div>
            </div><!-- div row -->

            <hr>

            <p class="text-center"><b>Detalhamento do Indicador</b></p>
            <div class="row mt-3">
                <div class="column col-6 col-xs-12">
                    <input type="hidden" id="indicador_objetivo_estrategico_id" name="indicador_objetivo_estrategico_id" :value="dadosIndicador.id">
                    <input type="hidden" id="meta_indicador_objetivo_estrategico_id" name="meta_indicador_objetivo_estrategico_id" :value="dadosIndicador.objetivo_estrategico_meta_id">
                    <label for="txt_denominacao_indicador">Denominação do Indicador</label>
                    <p v-text="dadosIndicador.txt_denominacao_indicador"></p>
                </div>
            
                <div class="column col-6 col-xs-12 br-textarea">
                    <label>Nova Denominação do Indicador</label>
                        <textarea disabled class="input-medium" id="txt_denominacao_indicador_nova" name="txt_denominacao_indicador_nova" rows="2">
                        </textarea>
                </div>
            </div>

            <div class="row mt-3">
                <div class="column col-6 col-xs-12">
                    <label for="dsc_indicador">Descrição do Indicador</label>
                    <p v-text="dadosIndicador.dsc_indicador"></p>
                </div>
            
                <div class="column col-6 col-xs-12 br-textarea">
                    <label>Nova Descrição do Indicador</label>
                        <textarea disabled class="input-medium" id="dsc_indicador_nova" name="dsc_indicador_nova" rows="5">
                        </textarea>
                </div>
            </div>
            
            <div class="row mt-3">
                <div class="column col-6 col-xs-12">
                    <label for="txt_sigla_indicador">Sigla do Indicador</label>
                    <p v-text="dadosIndicador.txt_sigla_indicador"></p>
                </div>
            
                <div class="column col-6 col-xs-12 br-textarea">
                    <label>Nova Sigla do Indicador</label>
                        <textarea disabled class="input-medium" id="txt_sigla_indicador_nova" name="txt_sigla_indicador_nova" rows="1">
                        </textarea>
                </div>
            </div>

            <div class="row mt-3">
                <div class="column col-6 col-xs-12">
                    <label for="vlr_indice_referencia">Valor de Referência</label>
                    <p v-text="dadosIndicador.vlr_indice_referencia"></p>
                </div>
            
                <div class="column col-6 col-xs-12 br-textarea">
                    <label>Novo Valor de Referência</label>
                        <textarea disabled class="input-medium" id="vlr_indice_referencia_nova" name="vlr_indice_referencia_nova" rows="1">
                        </textarea>
                </div>
            </div>

            <div class="row mt-3">
                <div class="column col-6 col-xs-12">
                    <label for="txt_unidade_medida">Unidade de Medida</label>
                    <p v-text="dadosIndicador.txt_unidade_medida"></p>
                </div>
            
                <div class="column col-6 col-xs-12 br-textarea">
                    <label>Nova Unidade de Medida</label>
                        <select disabled id="txt_unidade_medida_nova" class="form-select br-select" name="txt_unidade_medida_nova"
                        @change="onChangeUnidadeMedida" v-model="unidadeMedida">
                            <option value="" v-text="textoEscolhaUnidadeMedida"></option>
                            <option v-for="item in unidadesMedida" v-text="item.txt_unidade_medida" :value="item.id"
                                :key="item.id"></option>
                        </select>
                </div>
            </div>

            <div class="row mt-3">
                <div class="column col-6 col-xs-12">
                    <label for="txt_data_divulgacao_ou_disponibilizacao">Data de Divulgação ou Disponibilidade</label>
                    <p v-text="dadosIndicador.txt_data_divulgacao_ou_disponibilizacao"></p>
                </div>
            
                <div class="column col-6 col-xs-12 br-textarea">
                    <label>Novo Data de Divulgação ou Disponibilidade</label>
                        <textarea disabled class="input-medium" id="txt_data_divulgacao_ou_disponibilizacao_nova" name="txt_data_divulgacao_ou_disponibilizacao_nova" rows="1">
                        </textarea>
                </div>
            </div>

            <div class="row mt-3">
                <div class="column col-6 col-xs-12">
                    <label for="dsc_periodicidades">Periodicidade</label>
                    <p v-text="dadosIndicador.dsc_periodicidades"></p>
                </div>
            
                <div class="column col-6 col-xs-12 br-textarea">
                    <label>Nova Periodicidade</label>
                        <select disabled id="periodicidades_id_nova" class="form-select br-select" name="periodicidades_id_nova"
                        v-model="periodicidade">
                            <option value="" v-text="textoEscolhaPeriodicidade"></option>
                            <option v-for="item in periodicidades" v-text="item.dsc_periodicidades" :value="item.id"
                                :key="item.id"></option>
                        </select>
                </div>
            </div>

            <div class="row mt-3">
                <div class="column col-6 col-xs-12">
                    <label for="txt_polaridade">Polaridade do Indicador</label>
                    <p v-text="dadosIndicador.txt_polaridade"></p>
                </div>
            
                <div class="column col-6 col-xs-12 br-textarea">
                    <label>Nova Polaridade do Indicador</label>
                    <select disabled id="polaridades_id_nova" class="form-select br-select" name="polaridades_id_nova"
                    v-model="polaridade">
                        <option value="" v-text="textoEscolhaPolaridade"></option>
                        <option v-for="item in polaridades" v-text="item.txt_polaridade" :value="item.id"
                            :key="item.id"></option>
                    </select>
                </div>
            </div>

            <div class="row mt-3">
                <div class="column col-6 col-xs-12">
                    <label for="txt_formula_calculo">Fórmula de Cálculo do Indicador</label>
                    <p v-text="dadosIndicador.txt_formula_calculo"></p>
                </div>
            
                <div class="column col-6 col-xs-12 br-textarea">
                    <label>Nova Fórmula de Cálculo do Indicador</label>
                    <textarea disabled class="input-medium" id="txt_formula_calculo_nova" name="txt_formula_calculo_nova" rows="5">
                    </textarea>
                </div>
            </div>

            <div class="row mt-3">
                <div class="column col-6 col-xs-12">
                    <label for="txt_fonte_dados_variaveis_calculo">Fonte de Dados das Variáveis do Indicador</label>
                    <p v-text="dadosIndicador.txt_fonte_dados_variaveis_calculo"></p>
                </div>
            
                <div class="column col-6 col-xs-12 br-textarea">
                    <label>Nova Fonte de Dados das Variáveis do Indicador</label>
                    <textarea disabled class="input-medium" id="txt_fonte_dados_variaveis_calculo_nova" name="txt_fonte_dados_variaveis_calculo_nova" rows="5">
                    </textarea>
                </div>
            </div>

            <div class="row mt-3">
                <div class="column col-6 col-xs-12">
                    <label for="txt_forma_disponibilizacao">Forma de Disponibilização do Indicador</label>
                    <p v-text="dadosIndicador.txt_forma_disponibilizacao"></p>
                </div>
            
                <div class="column col-6 col-xs-12 br-textarea">
                    <label>Nova Forma de Disponibilização do Indicador</label>
                    <textarea disabled class="input-medium" id="txt_forma_disponibilizacao_nova" name="txt_forma_disponibilizacao_nova" rows="5">
                    </textarea>
                </div>
            </div>

            <div class="row mt-3">
                <div class="column col-6 col-xs-12">
                    <label for="dsc_procedimento_calculo">Procedimento de Cálculo do Indicador</label>
                    <p v-text="dadosIndicador.dsc_procedimento_calculo"></p>
                </div>
            
                <div class="column col-6 col-xs-12 br-textarea">
                    <label>Nova Procedimento de Cálculo do Indicador</label>
                    <textarea disabled class="input-medium" id="dsc_procedimento_calculo_nova" name="dsc_procedimento_calculo_nova" rows="5">
                    </textarea>
                </div>
            </div>

            <hr>

            <p class="text-center"><b>Detalhamento da Meta do Indicador</b></p>
            <div class="row mt-3">
                <div class="column col-6 col-xs-12">
                    <label for="txt_dsc_meta">Denominação da Meta</label>
                    <p v-text="dadosIndicador.txt_dsc_meta"></p>
                </div>
            
                <div class="column col-6 col-xs-12 br-textarea">
                    <label>Nova Denominação da Meta</label>
                    <textarea disabled class="input-medium" id="txt_dsc_meta_nova" name="txt_dsc_meta_nova" rows="2">
                    </textarea>
                </div>
            </div>
                        
            <div class="row mt-3">
                <div class="column col-6 col-xs-12">
                    <label disabled for="bln_meta_cumulativa">Cumulatividade da Meta</label>
                    <p v-text="dadosIndicador.bln_meta_cumulativa ? 'Sim': 'Não'"></p>
                </div>
        
                <div class="column col-6 col-xs-12 br-textarea">
                    <label>Nova Cumulatividade da Meta</label>
                    <select disabled id="bln_meta_cumulativa_nova" class="form-select br-select" name="bln_meta_cumulativa_nova">
                    <option value="">Selecione se a meta é ou não cumulativa</option>
                    <option value="true">Sim</option>
                    <option value="false">Não</option>
                    </select>
                </div>
            </div>

            <div class="row mt-3">
                <div class="column col-6 col-xs-12">
                    <label for="vlr_esperado_ano_2">Meta para 2025 {{dadosIndicador.unidade_medida_simbolo}}</label>
                    <p v-text="dadosIndicador.vlr_esperado_ano_2"></p>
                </div>
            
                <div class="column col-6 col-xs-12 br-textarea">
                    <label>Nova Meta para 2025 {{novaUnidadeMedida}}</label>  <!--Faria sentido ter um OnChange para, se selecionado outro tipo de Unidade de Medida acima.-->
                    <br>
                    <input disabled id="vlr_esperado_ano_2_nova" 
                    type="number" 
                    name="vlr_esperado_ano_2_nova"
                    step="0.01"
                    >
                </div>
            </div>    

            <div class="row mt-3">
                <div class="column col-6 col-xs-12">
                    <label for="vlr_esperado_ano_3">Meta para 2026 {{dadosIndicador.unidade_medida_simbolo}}</label>
                    <p v-text="dadosIndicador.vlr_esperado_ano_3"></p>
                </div>
            
                <div class="column col-6 col-xs-12 br-textarea">
                    <label>Nova Meta para 2026 {{novaUnidadeMedida}}</label>
                    <br>
                    <input disabled id="vlr_esperado_ano_3_nova" 
                    type="number" 
                    name="vlr_esperado_ano_3_nova"
                    step="0.01"
                    >
                </div>
            </div>

            <div class="row mt-3">
                <div class="column col-6 col-xs-12">
                    <label for="vlr_meta_final_cenario_atual">Meta para 2027 {{dadosIndicador.unidade_medida_simbolo}}</label>
                    <p v-text="dadosIndicador.vlr_meta_final_cenario_atual"></p>
                </div>
            
                <div class="column col-6 col-xs-12 br-textarea">
                    <label>Nova Meta para 2027 {{novaUnidadeMedida}}</label>
                    <br>
                    <input disabled id="vlr_esperado_ano_4_nova" 
                    type="number" 
                    name="vlr_esperado_ano_4_nova"
                    step="0.01"
                    >
                </div>
            </div>

            <div class="row mt-3">
                <div class="column col-6 col-xs-12">
                    <label for="bln_meta_regionalizada">A meta é regionalizada?</label>
                    <p v-text="dadosIndicador.bln_meta_regionalizada ? 'Sim': 'Não'"></p>
                </div>
            
                <div class="column col-6 col-xs-12 br-textarea">
                    <label>A meta será regionalizada?</label>
                    <select disabled id="bln_meta_regionalizada_nova" class="form-select br-select" name="bln_meta_regionalizada_nova">
                    <option value="">Selecione se a meta é ou não regionalizada</option>
                    <option value="true">Sim</option>
                    <option value="false">Não</option>
                    </select>
                </div>
            </div>

            <div class="row mt-3">
                <div class="column col-6 col-xs-12">
                    <label for="dsc_justificativa_ausencia_regionalizacao">Justificativa para não regionalização</label>
                    <p v-text="dadosIndicador.dsc_justificativa_ausencia_regionalizacao"></p>
                </div>
            
                <div class="column col-6 col-xs-12 br-textarea">
                    <label>Nova Justificativa para não regionalização</label>
                    <textarea disabled class="input-medium" id="dsc_justificativa_ausencia_regionalizacao_nova" name="dsc_justificativa_ausencia_regionalizacao_nova" rows="5">
                    </textarea>
                </div>
            </div>
            
            <hr>
            
            <!-- <div class="mt-5">
                <div class="text-center">
                    <span class="fs-5 fw-bold">Metas Regionalizadas</span>
                </div>
                <div class="table-responsive mt-3">
                    <table>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Região</th>
                                <th class="text-center">Meta para 2025</th>
                                <th class="text-center">Nova Meta para 2025</th>
                                <th class="text-center">Meta para 2026</th>
                                <th class="text-center">Nova Meta para 2026</th>
                                <th class="text-center">Meta para 2027</th>
                                <th class="text-center">Nova Meta para 2027</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(item, index) in dadosRegionalizacao">
                                <td>{{ (index+1) }}</td>
                                <td>{{ item.txt_sigla_objetivos_estrategicos_metas_region }}</td>
                                <td class="text-center">{{ item.vlr_esperado_ano_2 }}</td>
                                <td class="text-center">
                                    <input style="width: 150px;" id="vlr_esperado_ano_2_nova" 
                                    type="number" 
                                    ame="vlr_esperado_ano_2_nova"
                                    step="0.01"
                                    ></td>
                                <td class="text-center">{{ item.vlr_esperado_ano_3 }}</td>
                                <td class="text-center">
                                    <input id="vlr_esperado_ano_3_nova" 
                                    type="number" 
                                    name="vlr_esperado_ano_3_nova"
                                    step="0.01"
                                    ></td>
                                <td class="text-center">{{ item.vlr_meta_final_cenario_alternativo }}</td>
                                <td class="text-center">
                                    <input id="vlr_meta_final_cenario_alternativo_nova" 
                                    type="number" 
                                    name="vlr_meta_final_cenario_alternativo_nova"
                                    step="0.01"
                                    ></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div> -->


            <!-- Botões Formulário -->
            <div class="row">
                <div class="col col-xs-12 col-sm-12">
                    <div class="p-3 text-right">
                        <button class="br-button primary mr-3" :disabled="this.situacao_revisao_id == '3' || this.situacao_revisao_id == '5' || this.situacao_revisao_id == '6'" @click="IrParaEdicao(dadosIndicador.revisao_indicador_id)">
                        Editar
                        </button>

                        <a class="br-button danger mr-3" type="button" :href='this.url+"/plancidades/revisao/objetivo_estrategico/indicadores/"+ this.dadosIndicador.indicador_objetivo_estrategico_id'>Voltar
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['url', 'dadosIndicador', 'dadosRegionalizacao'],
    data() {
        return {
        //----Campos Select
            bln_meta_regionalizada_nova:'',
            unidadesMedida:'',
            unidadeMedida:'',
            novaUnidadeMedida:this.dadosIndicador.unidade_medida_simbolo,
            periodicidades:'',
            periodicidade:'',
            polaridades:'',
            polaridade:'',

            //----Validação Revisão
            txt_situacao_revisao: '',
            situacao_revisao_observacao: '',
            situacao_revisao_id: '',

            //----Textos de Escolhas
            textoEscolhaUnidadeMedida: "Escolha uma nova Unidade de Medida:",
            textoEscolhaPeriodicidade: "Escolha uma nova Periodicidade:",
            textoEscolhaPolaridade: "Escolha uma nova Polaridade:",
        }
    },
    methods: {
        onChangeUnidadeMedida(){
            this.novaUnidadeMedida = this.unidadeMedida;
            switch (this.novaUnidadeMedida){
            case 1:
                this.novaUnidadeMedida = '(R$)';
                break;
            case 2:
                this.novaUnidadeMedida = '(%)';
                break;
            case 3:
                this.novaUnidadeMedida = '(ADI)';
                break;
            case 4:
                this.novaUnidadeMedida = '(m²)';
                break;
            case 5:
                this.novaUnidadeMedida = '(UN)';
                break;
            default:
                this.novaUnidadeMedida = '';
            }
        },

        IrParaEdicao(revisaoId){
            window.location.href = "/plancidades/revisao/objetivo_estrategico/"+revisaoId+"/editar";
        }
        
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

        if (this.situacaoRevisao != null){
            this.situacao_revisao_id = this.situacaoRevisao.situacao_revisao_id;
            this.txt_situacao_revisao = this.situacaoRevisao.txt_situacao_revisao;
            this.situacao_revisao_observacao = this.situacaoRevisao.situacao_revisao_observacao;
        }
        else {
            this.situacao_revisao_id = '';
            this.txt_situacao_revisao = 'Em revisão';
            this.situacao_revisao_observacao = '';
        };

    }
}
</script>
