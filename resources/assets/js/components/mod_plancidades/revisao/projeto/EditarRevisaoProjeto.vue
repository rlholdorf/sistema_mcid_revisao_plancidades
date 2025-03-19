<template>
    <div>
        <div class="form-group">
            <p class="text-center"><b>Detalhamento do Projeto</b></p>
            <div class="row mt-3">
                <div class="column col-6 col-xs-12">
                    <label for="txt_enunciado_projeto">Enunciado do Projeto</label>
                    <p v-text="dadosProjeto.txt_enunciado_projeto"></p>
                </div>
            
                <div class="column col-6 col-xs-12 br-textarea">
                    <label>Novo Enunciado do Projeto</label>
                        <textarea class="input-medium" id="txt_enunciado_projeto_nova" name="txt_enunciado_projeto_nova" rows="2">
                        </textarea>
                </div>
            </div>

             <div class="row mt-3">
                <div class="column col-6 col-xs-12">
                    <label for="dsc_objetivo_projeto">Objetivo do Projeto</label>
                    <p v-text="dadosProjeto.dsc_objetivo_projeto"></p>
                </div>
            
                <div class="column col-6 col-xs-12 br-textarea">
                    <label>Novo Objetivo do Projeto</label>
                    <textarea class="input-medium" id="dsc_objetivo_projeto_nova" name="dsc_objetivo_projeto_nova" rows="5">
                    </textarea>
                </div>
            </div>
            
            <div class="row mt-3">
                <div class="column col-6 col-xs-12">
                    <label for="txt_titulo_objetivo_estrategico_pei">Objetivo Estratégico Vinculado</label>
                    <p v-text="dadosProjeto.txt_titulo_objetivo_estrategico_pei"></p>
                </div>
            
                <div class="column col-6 col-xs-12 br-textarea">
                    <label>Nova Objetivo Estratégico Vinculado</label>
                    <select id="txt_titulo_objetivo_estrategico_pei_nova" class="form-select br-select" name="txt_titulo_objetivo_estrategico_pei_nova" v-model="objetivoEstrategico">
                        <option value="" v-text="textoEscolhaObjetivoEstrategico"></option>
                        <option v-for="item in objetivosEstrategicos" v-text="item.txt_titulo_objetivo_estrategico_pei" :value="item.txt_titulo_objetivo_estrategico_pei" 
                        :key="item.id"></option>
                    </select> <!-- Teria que reordenar os órgãos, ou algo que o valha, para poder ficar em uma ordem mais inteligível. Estudar apresentar primeiro escolher o órgao e, onchange, escolher a subunidade -->
                </div>
            </div>

            <div class="row mt-3">
                <div class="column col-6 col-xs-12">
                    <label for="txt_unidade_responsavel">Unidade Responsável</label>
                    <p v-text="dadosProjeto.txt_unidade_responsavel"></p>
                </div>
            
                <div class="column col-6 col-xs-12 br-textarea">
                    <label>Nova Unidade Responsável</label>
                    <select id="txt_unidade_responsavel_nova" class="form-select br-select" name="txt_unidade_responsavel_nova" v-model="unidadeResponsavel">
                        <option value="" v-text="textoEscolhaUnidadeResponsavel"></option>
                        <option v-for="item in unidadesResponsaveis" v-text="item.txt_unidade_responsavel" :value="item.txt_unidade_responsavel" 
                        :key="item.id"></option>
                    </select> <!-- Teria que reordenar os órgãos, ou algo que o valha, para poder ficar em uma ordem mais inteligível. Estudar apresentar primeiro escolher o órgao e, onchange, escolher a subunidade -->
                </div>
            </div>

            <div class="row mt-3">
                <div class="column col-6 col-xs-12">
                    <label for="bln_ppa">É Medida Institucional e Normativa do PPA?</label>
                    <p v-text="dadosProjeto.bln_ppa ? 'Sim': 'Não'"></p>
                </div>
            
                <div class="column col-6 col-xs-12 br-textarea">
                    <label>Nova identificação de Medida Institucional e Normativa do PPA</label>
                    <select id="bln_ppa_nova" class="form-select br-select" name="bln_ppa_nova"
                    v-model="boleanoppa"> <!-- É necessário esse v-model? -->
                    <option>Sim</option>
                    <option>Não</option>
                    </select>
                </div>
            </div>
            
            <div class="row mt-3" v-if="dadosProjeto.bln_ppa">
                <div class="column col-6 col-xs-12">
                    <label for="dsc_min_ppa">Descrição da MIN PPA</label>
                    <p v-text="dadosProjeto.dsc_min_ppa"></p>
                </div>
            
                <div class="column col-6 col-xs-12 br-textarea">
                    <label>Nova Descrição da MIN PPA</label>
                    <textarea class="input-medium" id="dsc_min_ppa_nova" name="dsc_min_ppa_nova" rows="2">
                    </textarea>
                </div>
            </div>

            <div class="row mt-3">
                <div class="column col-6 col-xs-12">
                    <label for="dsc_beneficios">Benefícios do Projeto</label>
                    <p v-text="dadosProjeto.dsc_beneficios"></p>
                </div>
            
                <div class="column col-6 col-xs-12 br-textarea">
                    <label>Nova Descrição de Benefícios do Projeto</label>
                    <textarea class="input-medium" id="dsc_beneficios_nova" name="dsc_beneficios_nova" rows="5">
                    </textarea>
                </div>
            </div>            

            <div class="row mt-3">
                <div class="column col-6 col-xs-12">
                    <label for="dsc_premissas">Premissas do Projeto</label>
                    <p v-text="dadosProjeto.dsc_premissas"></p>
                </div>
            
                <div class="column col-6 col-xs-12 br-textarea">
                    <label>Nova Descrição de Premissas do Projeto</label>
                    <textarea class="input-medium" id="dsc_premissas_nova" name="dsc_premissas_nova" rows="2">
                    </textarea>
                </div>
            </div>

            <div class="row mt-3">
                <div class="column col-6 col-xs-12">
                    <label for="dsc_restricoes">Restrições do Projeto</label>
                    <p v-text="dadosProjeto.dsc_restricoes"></p>
                </div>
            
                <div class="column col-6 col-xs-12 br-textarea">
                    <label>Nova Descrição de Restrições do Projeto</label>
                    <textarea class="input-medium" id="dsc_restricoes_nova" name="dsc_restricoes_nova" rows="2">
                    </textarea>
                </div>
            </div>

            <div class="row mt-3">
                <div class="column col-6 col-xs-12">
                    <label>Patrocinador(a) do Projeto</label>
                    <p class="mt-2" v-text="'Nome: '+dadosProjeto.dsc_nome_patrocinador"></p>
                    <p class="mt-4" v-text="'Cargo: '+dadosProjeto.dsc_cargo"></p>
                    <p class="mt-4" v-text="'Unidade: '+dadosProjeto.txt_unidade_responsavel_patrocinador"></p>
                </div>
            
                <div class="column col-6 col-xs-12 br-textarea">
                    <label>Novo(a) Patrocinador(a) do Projeto</label>
                    <textarea class="input-medium" id="dsc_nome_patrocinador_nova" name="dsc_nome_patrocinador_nova" placeholder="Escreva o novo nome..." rows="1"></textarea>
                    <textarea class="input-medium" id="dsc_cargo_nova" name="dsc_cargo_nova" placeholder="Escreva o cargo do novo patrocinador..." rows="1"></textarea>
                    <textarea class="input-medium" id="txt_unidade_responsavel_patrocinador_nova" name="txt_unidade_responsavel_patrocinador_nova" rows="1"></textarea> <!-- Mudar para Select -->
                </div>
            </div>
<!-- Repetir para os demais, caso fique assim -->

            <hr>

            <p class="text-center"><b>Detalhamento das Etapas</b></p>

            <div class="table-responsive mt-3">
                <table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nome da etapa (Produto)</th>
                            <th>Marco da entrega</th>
                            <th class="text-center" style="border-left:1px">Peso relativo</th>
                            <th class="text-center" style="border-left:1px">Data de Início</th>
                            <th class="text-center">Data de Conclusão</th>
                            <th class="text-center" style="border-left:1px">Alterar</th>
                            <th class="text-center" style="border-left:1px">Excluir</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(item, index) in dadosEtapas">
                            <td>{{ (index+1) }}</td>
                            <td>{{ item.dsc_etapa }}</td>
                            <td>{{ item.dsc_marco }}</td>
                            <td class="text-center">{{ item.vlr_peso_etapa }}</td>
                            <td class="text-center">{{ formatarData(item.dte_previsao_inicio_etapa) }}</td>
                            <td class="text-center">{{ formatarData(item.dte_previsao_conclusao_etapa) }}</td>
                            <td class="text-center">
                                <button type="button" class="br-button circle primary small" title="Monitorar etapa" >
                                    <i class="fa fa-pen"></i>  <!-- Implementar, provavelmente modal -->
                                </button></td>
                            <td class="text-center">
                                <button type="button" class="br-button circle primary small" title="Monitorar etapa" >
                                    <i class="fa fa-times-circle"></i> <!-- Implementar, provavelmente modal -->
                                </button></td>
                        </tr>
                    </tbody>
                </table>

                <slot>
            
                </slot>

            </div>

    <!-- Botões Formulário -->
            <div class="row">
                <div class="col col-xs-12 col-sm-12">
                    <div class="p-3 text-right">
                        <button class="br-button primary mr-3" type="submit" name="salvar_revisão" :value="true">Salvar Revisão
                        </button>

                        <a class="br-button danger mr-3" type="button" :href='this.url+"/plancidades/revisao/projeto/consulta"'>Voltar
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['url', 'dadosProjeto', 'dadosEtapas'],
    data() {
        return {
        //----Campos Select
            objetivosEstrategicos:'',
            objetivoEstrategico:'',        
            unidadesResponsaveis:'',
            unidadeResponsavel:'',
            periodicidades:'',
            periodicidade:'',
            polaridades:'',
            polaridade:'',

            //----Textos de Escolhas
            textoEscolhaObjetivoEstrategico: "Escolha um novo Objetivo Estratégico",
            textoEscolhaUnidadeResponsavel: "Escolha uma nova Unidade Responsável:",
            textoEscolhaPeriodicidade: "Escolha uma nova Periodicidade:",
            textoEscolhaPolaridade: "Escolha uma nova Polaridade:",
        }
    },
    methods: {
        formatarData(data){
            let dataTemp = data.split("-");
            let dataFormatada = '';
            
            for (let i = (dataTemp.length-1); i >= 0; i--){
                dataFormatada += String(dataTemp[i]) 
                if (i > 0){
                    dataFormatada += '/';
                }
            }
            return dataFormatada;
        },
        
    },
    mounted() {
        
        axios.get(this.url + '/api/plancidades/objetivosEstrategicos').then(resposta=>{
            this.objetivosEstrategicos = resposta.data;
        }).catch(error=>{
            console.log(error);
        });
        
        axios.get(this.url + '/api/plancidades/unidadesResponsaveis').then(resposta=>{
            this.unidadesResponsaveis = resposta.data;
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
    }
}
</script>
