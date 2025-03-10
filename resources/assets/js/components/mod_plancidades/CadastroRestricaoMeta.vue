<template>
    <div class="form-group">
        <div class="row mt-3">
            <div class="column col-xs-12">
                <label for="restricao">Restrições ao atingimento da meta</label>
                <select id="restricao_atingimento_meta_id" class="form-select br-select" name="restricao_atingimento_meta_id" 
                    @change="onChangeRestricao" v-model="restricaoAtingimentoMeta" required>
                    <option value="">Escolha uma Restrição:</option>
                    <option v-for="item in restricoes" v-text="item.txt_item_restricao_atingimento_meta" :value="item.id"
                        :key="item.id"></option>
                </select>
            </div>
        </div>
        <div class="row mt-3" v-if="restricaoAtingimentoMeta == 99">
            <div class="col col-xs-12 col-sm-12 br-input">
                <label >Nome outra restrição 
                        <span class="br-tag count bg-info" 
                            title="Nome da restrição caso seja selecionado o item Outras. "><span aria-hidden="true">?</span>
                        </span>
                </label>
                <input id="dsc_outra_restricao" 
                    type="text" 
                    name="dsc_outra_restricao"    
                    v-model="dsc_outra_restricao"                 
                     >
            </div>
        </div><!-- div row -->
        <div class="row mt-3" v-if="restricaoAtingimentoMeta == 1 || restricaoAtingimentoMeta == 2">
            <div class="col col-xs-12 col-sm-12 br-input">
                <label >Valor da insuficiência de recursos
                        <span class="br-tag count bg-info" 
                            title="Detalhamento dos valores da insuficiência de recursos, caso seja selecionada a restrição Insuficiência Orçamentária ou Insuficiência de recursos não orçamentários "><span aria-hidden="true">?</span>
                        </span>
                </label>
                <input id="vlr_insuficiencia_recurso" 
                    type="number" 
                    name="vlr_insuficiencia_recurso"    
                    step="0.01"
                    v-model="vlr_insuficiencia_recurso"                 
                    required >
            </div>
        </div><!-- div row -->
        <div class="row mt-3">
            <div class="col col-xs-12 br-textarea">
                <label>Detalhamento Restrição
                    <span class="br-tag count bg-info" 
                    title="Informações que subsidiam a escolha da restrição selecionada (até 2.000 caracteres).. "><span aria-hidden="true">?</span>
                </span>

                </label>
                <textarea :disabled='this.editando==false' 
                          class="input-medium" 
                          id="dsc_detalhamento_restricao" name="dsc_detalhamento_restricao" 
                          rows="5"
                          maxlength="2000"
                    v-model="dsc_detalhamento_restricao" required>
                </textarea>
            </div>
        </div><!-- div row -->
        <div class="row mt-3">
            <div class="col col-xs-12 br-textarea">
                <label>Providências implementadas para a superação da restrição
                    <span class="br-tag count bg-info" 
                    title="Providências que foram, serão ou estão sendo adotadas para superação da referida restrição (até 2.000 caracteres). "><span aria-hidden="true">?</span>
                </span>
                </label>
                <textarea :disabled='this.editando==false' 
                          class="input-medium" 
                          id="dsc_providencias_superacao_restricao" name="dsc_providencias_superacao_restricao" 
                          rows="5"
                          maxlength="2000"
                    v-model="dsc_providencias_superacao_restricao" required>
                </textarea>
            </div>
        </div><!-- div row -->
    </div>
</template>

<script>
    export default {
        props: ['url', 'dados', 'editando', 'cadastrando'],
        data() {
            return {          
                restricoes: '',
                restricaoAtingimentoMeta:'',
                dsc_outra_restricao:'',
                dsc_detalhamento_restricao:'',
                dsc_providencias_superacao_restricao:'',
                vlr_insuficiencia_recurso:0
            }
        },
        methods: {
            onChangeRestricao() {
            }
        },
        mounted() {
           //retorna as restrições
            axios.get(this.url + '/api/plancidades/restricoes_atingimento_meta').then(resposta => {
                this.restricoes = resposta.data;
            }).catch(error => {
                console.log(error);
            });
        }
    }
</script>
