<template>
    <div class="row">
        <div class="col col-xs-12 col-sm-12 br-input">
            <p class="label mb-0">3. Selecione as ações orçamentárias do programa:</p>
            <span class="feedback danger" role="alert" v-if="this.bln_erros && this.errors.item_financiavel">
                <i class="fas fa-times-circle" aria-hidden="true"></i>Campo deve ter uma opção selecionada.
            </span>

            
            <div class="br-checkbox">
                <input
                    id="checkbox37"
                    name="itens_financiaveis[]"
                     v-bind:value='37' 
                    v-model='item_financiavel'
                    type="checkbox"
                        @change="onChangeItem"
                  
                />
                <label for="checkbox37">20AM - Implementação de Projetos de Coleta, Triagem e Reciclagem de Resíduos Sólidos</label>
            </div>
            <div class="br-checkbox">
                <input
                    id="checkbox34"
                    name="itens_financiaveis[]"
                     v-bind:value='34' 
                    v-model='item_financiavel'
                    type="checkbox"
                        @change="onChangeItem"
                  
                />
                <label for="checkbox34">21C9 - Saneamento Básico em Áreas Rurais e Comunidades Tradicionais</label>
            </div>
            <div class="br-checkbox">
                <input
                    id="checkbox35"
                    name="itens_financiaveis[]"
                     v-bind:value='35' 
                    v-model='item_financiavel'
                    type="checkbox"
                        @change="onChangeItem"
                  
                />
                <label for="checkbox35">21CA - Implantação, Ampliação e Melhoria de Sistemas Públicos de Abastecimento de Água em Municípios com até 50.000 Habitantes, Exclusive em Regiões Metropolitanas (RM) ou Regiões Integradas de Desenvolvimento Econômico (RIDE).</label>
            </div>

            <div class="br-checkbox">
                <input
                    id="checkbox36"
                    name="itens_financiaveis[]"
                     v-bind:value='36' 
                    v-model='item_financiavel'
                    type="checkbox"
                    @change="onChangeItem"
                  
                />
                <label for="checkbox36">21CB - Implantação, Ampliação e Melhoria de Sistemas Públicos de Esgotamento Sanitário em Municípios com até 50.000 Habitantes, Exclusive em Regiões Metropolitanas (RM) ou Regiões Integradas de Desenvolvimento Econômico (RIDE).</label>
            </div> 
            <div class="br-checkbox">
                <input
                    id="checkbox33"
                    name="itens_financiaveis[]"
                     v-bind:value='33' 
                    v-model='item_financiavel'
                    type="checkbox"
                        @change="onChangeItem"
                  
                />
                <label for="checkbox33">21CC - Sistemas Públicos de Manejo de Resíduos Sólidos</label>
            </div>
            <div class="br-checkbox">
                <input
                    id="checkbox32"
                    name="itens_financiaveis[]"
                     v-bind:value='32' 
                    v-model='item_financiavel'
                    type="checkbox"
                        @change="onChangeItem"
                    aria-label="opção 32"
                    titulo="Visa melhorar as condições de deslocamento de pedestres e ciclistas das vias
                    públicas urbanas."
                   
                />
                <label for="checkbox32">21CI - Implantação de Melhorias Sanitárias Domiciliares</label>
            </div>
            
        
           
            
           
            
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
                    id="checkbox41"
                    name="itens_financiaveis[]"
                     v-bind:value='41' 
                    v-model='item_financiavel'
                    type="checkbox"
                        @change="onChangeItem"
                  
                />
                <label for="checkbox41">00TM - Apoio a Empreendimentos de Saneamento Integrado em Municípios com População Superior a 50 mil Habitantes ou Municípios Integrantes de Regiões Metropolitanas ou de Regiões Integradas de Desenvolvimento.</label>
            </div>

            <div class="br-checkbox">
                <input
                    id="checkbox45"
                    name="itens_financiaveis[]"
                     v-bind:value='45' 
                    v-model='item_financiavel'
                    type="checkbox"
                        @change="onChangeItem"
                  
                />
                <label for="checkbox45">00TN - Apoio à Implantação, Ampliação ou Melhorias em Sistemas de Abastecimento de Água em Municípios com População Superior a 50 mil Habitantes ou Municípios Integrantes de Regiões Metropolitanas ou de Regiões Integradas de Desenvolvimento.</label>
            </div>
       
            <div class="br-checkbox">
                <input
                    id="checkbox44"
                    name="itens_financiaveis[]"
                     v-bind:value='44' 
                    v-model='item_financiavel'
                    type="checkbox"
                        @change="onChangeItem"
                  
                />
                <label for="checkbox44">00TO - Apoio à Implantação, Ampliação ou Melhorias de Sistemas de Esgotamento Sanitário em Municípios com População Superior a 50 mil Habitantes ou Municípios Integrantes de Regiões Metropolitanas ou de Regiões Integradas de Desenvolvimento.</label>
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

