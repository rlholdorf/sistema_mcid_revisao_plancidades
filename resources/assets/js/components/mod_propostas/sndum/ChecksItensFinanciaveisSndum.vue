<template>
    <div class="row">
            <div class="col col-xs-12 col-sm-12 br-input">
                <p class="label mb-0">8. Selecione as ações orçamentárias do programa:</p>
                <span class="feedback danger" role="alert" v-if="this.bln_erros && this.errors.item_financiavel">
                    <i class="fas fa-times-circle" aria-hidden="true"></i>Campo deve ter uma opção selecionada.
                </span>

                
                <div class="br-checkbox">
                    <input
                        id="checkbox30"
                        name="itens_financiaveis[]"
                         v-bind:value='30' 
                        v-model='item_financiavel'
                        type="checkbox"
                        @change="onChangeItem"
                        aria-label="opção 30"
                       required
                       
                    />
                    <label for="checkbox30">00SY - Apoio a Projetos e Obras de Reabilitação, de Acessibilidade e Modernização Tecnológica em Áreas Urbanas</label>
                </div>
            </div>
            <div class="p-3 text-right">
                <button class="br-button primary mr-3" name="Salvar"  v-if="this.countItens > 0">Salvar
                </button>
                 <button class="br-button danger mr-3" type="button" onclick="javascript:window.history.go(-1)">
                    Fechar
                </button>
            </div>
        </div>
</template>

<script>
    export default {
        props:['url','itens','proposta','blnbotao'],
        data(){
            return{
                itensFinanciaveis:'',
                itemFinanciavel:'',
                bln_erros:'',
                item_financiavel:[],
                countItens:0,
            }
        },
        methods:{
            onChangeItem(){
                this.countItens = this.item_financiavel.length;
                console.log(this.countItens);
            }
        },
        mounted() {
            this.item_financiavel = [];
            this.countItens = this.item_financiavel.length;
            console.log('Component mounted.')
        }
    }
</script>

