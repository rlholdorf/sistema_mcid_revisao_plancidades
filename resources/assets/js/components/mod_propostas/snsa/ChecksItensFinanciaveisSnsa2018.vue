<template>
    <div class="row">
        <div class="col col-xs-12 col-sm-12 br-input">
            <p class="label mb-0">3. Selecione as ações orçamentárias do programa:</p>
            <span class="feedback danger" role="alert" v-if="this.bln_erros && this.errors.item_financiavel">
                <i class="fas fa-times-circle" aria-hidden="true"></i>Campo deve ter uma opção selecionada.
            </span>

            
           
            <div class="br-checkbox">
                <input
                    id="checkbox42"
                    name="itens_financiaveis[]"
                     v-bind:value='42' 
                    v-model='item_financiavel'
                    type="checkbox"
                        @change="onChangeItem"
                  
                />
                <label for="checkbox42">00TK - Apoio a Sistemas de Drenagem Urbana Sustentável e de Manejo de Águas Pluviais em Municípios Críticos Sujeitos a Eventos Recorrentes de Inundações, Enxurradas e Alagamentos.</label>
            </div>
            <div class="br-checkbox">
                <input
                    id="checkbox43"
                    name="itens_financiaveis[]"
                     v-bind:value='43' 
                    v-model='item_financiavel'
                    type="checkbox"
                        @change="onChangeItem"
                  
                />
                <label for="checkbox43">00TL - Apoio à Implantação, Ampliação ou Melhorias em Sistemas de Abastecimento de Água em Municípios Integrantes da Região do Semiárido.</label>
            </div>
            <div class="br-checkbox">
                <input
                    id="checkbox46"
                    name="itens_financiaveis[]"
                     v-bind:value='46' 
                    v-model='item_financiavel'
                    type="checkbox"
                        @change="onChangeItem"
                  
                />
                <label for="checkbox46">8865 - Apoio à Execução de Projetos e Obras de Contenção de Encostas em Áreas Urbanas.</label>
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
    <!-- div row -->
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

