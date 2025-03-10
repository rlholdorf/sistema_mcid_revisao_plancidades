<template>
    <div class="row">
        <div class="col col-xs-12 col-sm-12 br-input">
            <p class="label mb-0">3. Selecione os itens financiáveis das ações orçamentárias do programa de Mobilidade urbana previstos no projeto básico:</p>
            <span class="feedback danger" role="alert" v-if="this.bln_erros && this.errors.item_financiavel">
                <i class="fas fa-times-circle" aria-hidden="true"></i>Campo deve ter uma opção selecionada.
            </span>
            
            <span class="br-divider dashed my-3"></span>
            <div class="titulo">
                <h5><strong>00SZ</strong> - Apoio ao Transporte Não Motorizado</h5>
            </div>
            <span class="br-divider dashed my-3"></span>
            <div class="br-checkbox">
                <input
                    id="checkbox1"
                    name="itens_financiaveis[]"
                     v-bind:value='1' 
                    v-model='item_financiavel'
                    type="checkbox"
                    @change="onChangeItem"
                    aria-label="opção 1"
                    titulo="Visa melhorar as condições de deslocamento de pedestres e ciclistas das vias
                    públicas urbanas."
                   
                />
                <label for="checkbox1">Bicicletários e paraciclos</label>
            </div>
            <div class="br-checkbox">
                <input
                    id="checkbox2"
                    name="itens_financiaveis[]"
                     v-bind:value='2' 
                    v-model='item_financiavel'
                    type="checkbox"
                    @change="onChangeItem"
                    aria-label="opção 1"
                    titulo="Visa melhorar as condições de deslocamento de pedestres e ciclistas das vias
                    públicas urbanas."
                />
                <label for="checkbox2">Calçadas e vias exclusivas para pedestres</label>
            </div>
            <div class="br-checkbox">
                <input
                    id="checkbox3"
                    name="itens_financiaveis[]"
                     v-bind:value='3' 
                    v-model='item_financiavel'
                    type="checkbox"
                    @change="onChangeItem"
                    aria-label="opção 1"
                    titulo="Visa melhorar as condições de deslocamento de pedestres e ciclistas das vias
                    públicas urbanas."
                />
                <label for="checkbox3">Ciclofaixas, ciclorrotas e ciclovias</label>
            </div>
            <div class="br-checkbox">
                <input
                    id="checkbox4"
                    name="itens_financiaveis[]"
                    v-bind:value='4' 
                    v-model='item_financiavel'
                    type="checkbox"
                    @change="onChangeItem"
                    aria-label="opção 1"
                    titulo="Visa melhorar as condições de deslocamento de pedestres e ciclistas das vias
                    públicas urbanas."
                />
                <label for="checkbox4">Passarelas, travessias e demais transposições para pedestres e ciclistas</label>
            </div>
            <div class="br-checkbox">
                <input
                    id="checkbox5"
                    name="itens_financiaveis[]"
                     v-bind:value='5' 
                    v-model='item_financiavel'
                    type="checkbox"
                    @change="onChangeItem"
                    aria-label="opção 1"
                    titulo="Visa melhorar as condições de deslocamento de pedestres e ciclistas das vias
                    públicas urbanas."
                />
                <label for="checkbox5">Sinalização para pedestres e ciclistas</label>
            </div>
            
    
            <div class="titulo">
                <h5><strong>00T0</strong> - Apoio a Planos de Mobilidade Urbana Locais</h5>
            </div>
            <span class="br-divider dashed my-3"></span>
            <div class="br-checkbox">
                <input
                    id="checkbox6"
                    name="itens_financiaveis[]"
                     v-bind:value='6' 
                    v-model='item_financiavel'
                    type="checkbox"
                    @change="onChangeItem"
                    aria-label="opção 1"
                    titulo="Visa apoiar a melhoria da gestão e do planejamento da mobilidade urbana nas
                    cidades e em regiões metropolitanas."
                />
                <label for="checkbox6">Estudos e planos de transporte público coletivo</label>
            </div>
            <div class="br-checkbox">
                <input
                    id="checkbox7"
                    name="itens_financiaveis[]"
                     v-bind:value='7' 
                    v-model='item_financiavel'
                    type="checkbox"
                    @change="onChangeItem"
                    aria-label="opção 1"
                    titulo="Visa apoiar a melhoria da gestão e do planejamento da mobilidade urbana nas
                    cidades e em regiões metropolitanas."
                />
                <label for="checkbox7">Estudos e planos de circulação viária e de estacionamentos</label>
            </div>
            <div class="br-checkbox">
                <input
                    id="checkbox8"
                    name="itens_financiaveis[]"
                     v-bind:value='8' 
                    v-model='item_financiavel'
                    type="checkbox"
                    @change="onChangeItem"
                    aria-label="opção 1"
                    titulo="Visa apoiar a melhoria da gestão e do planejamento da mobilidade urbana nas
                    cidades e em regiões metropolitanas."
                />
                <label for="checkbox8">Estudos e planos cicloviários</label>
            </div>
            <div class="br-checkbox">
                <input
                    id="checkbox9"
                    name="itens_financiaveis[]"
                     v-bind:value='9' 
                    v-model='item_financiavel'
                    type="checkbox"
                    @change="onChangeItem"
                    aria-label="opção 1"
                    titulo="Visa apoiar a melhoria da gestão e do planejamento da mobilidade urbana nas
                    cidades e em regiões metropolitanas."
                />
                <label for="checkbox9">Estudos e planos de acessibilidade</label>
            </div>
            <div class="br-checkbox">
                <input
                    id="checkbox10"
                    name="itens_financiaveis[]"
                     v-bind:value='10' 
                    v-model='item_financiavel'
                    type="checkbox"
                    @change="onChangeItem"
                    aria-label="opção 1"
                    titulo="Visa apoiar a melhoria da gestão e do planejamento da mobilidade urbana nas
                    cidades e em regiões metropolitanas."
                />
                <label for="checkbox10">Estudos e planos de integração</label>
            </div>
            <div class="br-checkbox">
                <input
                    id="checkbox11"
                    name="itens_financiaveis[]"
                     v-bind:value='11' 
                    v-model='item_financiavel'
                    type="checkbox"
                    @change="onChangeItem"
                    aria-label="opção 1"
                    titulo="Visa apoiar a melhoria da gestão e do planejamento da mobilidade urbana nas
                    cidades e em regiões metropolitanas."
                />
                <label for="checkbox11">Estudos e planos de logística de carga urbana</label>
            </div>
            <div class="br-checkbox">
                <input
                    id="checkbox12"
                    name="itens_financiaveis[]"
                     v-bind:value='12' 
                    v-model='item_financiavel'
                    type="checkbox"
                    @change="onChangeItem"
                    aria-label="opção 1"
                    titulo="Visa apoiar a melhoria da gestão e do planejamento da mobilidade urbana nas
                    cidades e em regiões metropolitanas."
                />
                <label for="checkbox12">Pesquisas e diagnósticos de mobilidade urbana</label>
            </div>
            <div class="br-checkbox">
                <input
                    id="checkbox13"
                    name="itens_financiaveis[]"
                     v-bind:value='13' 
                    v-model='item_financiavel'
                    type="checkbox"
                    @change="onChangeItem"
                    aria-label="opção 1"
                    titulo="Visa apoiar a melhoria da gestão e do planejamento da mobilidade urbana nas
                    cidades e em regiões metropolitanas."
                />
                <label for="checkbox13">Planos municipais e metropolitanos de mobilidade urbana</label>
            </div>
    
            <div class="titulo">
                <h5><strong>00T1</strong> - Apoio à Política Nacional de Desenvolvimento Urbano Voltado\r\nà Implantação e Qualificação Viária</h5>
            </div>
            <span class="br-divider dashed my-3"></span>
            <div class="br-checkbox">
                <input
                    id="checkbox14"
                    name="itens_financiaveis[]"
                     v-bind:value='14' 
                    v-model='item_financiavel'
                    type="checkbox"
                    @change="onChangeItem"
                    aria-label="opção 1"
                    titulo="Visa promover conforto, segurança e condições sanitárias adequadas aos
                    diversos usuários das vias públicas urbanas."
                />
                <label for="checkbox14">Adequação de vias</label>
            </div>
            <div class="br-checkbox">
                <input
                    id="checkbox15"
                    name="itens_financiaveis[]"
                     v-bind:value='15' 
                    v-model='item_financiavel'
                    type="checkbox"
                    @change="onChangeItem"
                    aria-label="opção 1"
                    titulo="Visa promover conforto, segurança e condições sanitárias adequadas aos
                    diversos usuários das vias públicas urbanas."
                />
                <label for="checkbox15">Obras de arte especiais</label>
            </div>
            <div class="br-checkbox">
                <input
                    id="checkbox16"
                    name="itens_financiaveis[]"
                     v-bind:value='16' 
                    v-model='item_financiavel'
                    type="checkbox"
                    @change="onChangeItem"
                    aria-label="opção 1"
                    titulo="Visa promover conforto, segurança e condições sanitárias adequadas aos
                    diversos usuários das vias públicas urbanas."
                />
                <label for="checkbox16">Pavimentação</label>
            </div>
    
            <div class="titulo">
                <h5><strong>00T3</strong> - Apoio a Sistemas de Transporte Público Coletivo Urbano</h5>
            </div>
            <span class="br-divider dashed my-3"></span>
            <div class="br-checkbox">
                <input
                    id="checkbox17"
                    name="itens_financiaveis[]"
                     v-bind:value='17' 
                    v-model='item_financiavel'
                    type="checkbox"
                    @change="onChangeItem"
                    aria-label="opção 1"
                    titulo="Visa apoiar a melhoria da infraestrutura da mobilidade urbana de transporte
                    público coletivo."
                />
                <label for="checkbox17">Abrigos, estações e terminais</label>
            </div>
            <div class="br-checkbox">
                <input
                    id="checkbox18"
                    name="itens_financiaveis[]"
                     v-bind:value='18' 
                    v-model='item_financiavel'
                    type="checkbox"
                    @change="onChangeItem"
                    aria-label="opção 1"
                    titulo="Visa apoiar a melhoria da infraestrutura da mobilidade urbana de transporte
                    público coletivo."
                />
                <label for="checkbox18">Centros de controle operacional</label>
            </div>
            <div class="br-checkbox">
                <input
                    id="checkbox19"
                    name="itens_financiaveis[]"
                     v-bind:value='19' 
                    v-model='item_financiavel'
                    type="checkbox"
                    @change="onChangeItem"
                    aria-label="opção 1"
                    titulo="Visa apoiar a melhoria da infraestrutura da mobilidade urbana de transporte
                    público coletivo."
                />
                <label for="checkbox19">Equipamentos e sistemas</label>
            </div>
            <div class="br-checkbox">
                <input
                    id="checkbox20"
                    name="itens_financiaveis[]"
                     v-bind:value='20' 
                    v-model='item_financiavel'
                    type="checkbox"
                    @change="onChangeItem"
                    aria-label="opção 1"
                    titulo="Visa apoiar a melhoria da infraestrutura da mobilidade urbana de transporte
                    público coletivo."
                />
                <label for="checkbox20">Obras de arte especiais</label>
            </div>
            <div class="br-checkbox">
                <input
                    id="checkbox21"
                    name="itens_financiaveis[]"
                     v-bind:value='21' 
                    v-model='item_financiavel'
                    type="checkbox"
                    @change="onChangeItem"
                    aria-label="opção 1"
                    titulo="Visa apoiar a melhoria da infraestrutura da mobilidade urbana de transporte
                    público coletivo."
                />
                <label for="checkbox21">Vias e faixas exclusivas e preferenciais, com solução de drenagem e sinalização viária</label>
            </div>
    
            <div class="titulo">
                <h5><strong>2D49</strong> - Estudos, Projetos e Desenvolvimento Institucional no Setor da\r\nMobilidade Urbana</h5>
            </div>
            <span class="br-divider dashed my-3"></span>
            <div class="br-checkbox">
                <input
                    id="checkbox22"
                    name="itens_financiaveis[]"
                     v-bind:value='22' 
                    v-model='item_financiavel'
                    type="checkbox"
                    @change="onChangeItem"
                    aria-label="opção 1"
                    titulo="Objetiva qualificar a implementação e gestão da Política Nacional de Mobilidade
                    Urbana e a concepção de empreendimentos de infraestrutura de mobilidade urbana
                    para maior efetividade em sua implantação."
                />
                <label for="checkbox22">Elaboração/revisão de projetos básicos de empreendimentos de mobilidade urbana</label>
            </div>
            <div class="br-checkbox">
                <input
                    id="checkbox23"
                    name="itens_financiaveis[]"
                     v-bind:value='23' 
                    v-model='item_financiavel'
                    type="checkbox"
                    @change="onChangeItem"
                    aria-label="opção 1"
                    titulo="Objetiva qualificar a implementação e gestão da Política Nacional de Mobilidade
                    Urbana e a concepção de empreendimentos de infraestrutura de mobilidade urbana
                    para maior efetividade em sua implantação."
                />
                <label for="checkbox23">Elaboração/revisão de projetos executivos de empreendimentos de mobilidade urbana</label>
            </div>
            <div class="br-checkbox">
                <input
                    id="checkbox24"
                    name="itens_financiaveis[]"
                     v-bind:value='24' 
                    v-model='item_financiavel'
                    type="checkbox"
                    @change="onChangeItem"
                    aria-label="opção 1"
                    titulo="Objetiva qualificar a implementação e gestão da Política Nacional de Mobilidade
                    Urbana e a concepção de empreendimentos de infraestrutura de mobilidade urbana
                    para maior efetividade em sua implantação."
                />
                <label for="checkbox24">Elaboração/revisão de estudos e planos de concepção de empreendimentos e sistemas de mobilidade urbana</label>
            </div>
            <div class="br-checkbox">
                <input
                    id="checkbox25"
                    name="itens_financiaveis[]"
                     v-bind:value='25' 
                    v-model='item_financiavel'
                    type="checkbox"
                    @change="onChangeItem"
                    aria-label="opção 1"
                    titulo="Objetiva qualificar a implementação e gestão da Política Nacional de Mobilidade
                    Urbana e a concepção de empreendimentos de infraestrutura de mobilidade urbana
                    para maior efetividade em sua implantação."
                />
                <label for="checkbox25">Elaboração/revisão de estudos e planos de concepção de empreendimentos e sistemas de mobilidade urbana - Estudos de tráfego</label>
            </div>
            <div class="br-checkbox">
                <input
                    id="checkbox26"
                    name="itens_financiaveis[]"
                     v-bind:value='26' 
                    v-model='item_financiavel'
                    type="checkbox"
                    @change="onChangeItem"
                    aria-label="opção 1"
                    titulo="Objetiva qualificar a implementação e gestão da Política Nacional de Mobilidade
                    Urbana e a concepção de empreendimentos de infraestrutura de mobilidade urbana
                    para maior efetividade em sua implantação."
                />
                <label for="checkbox26">Elaboração/revisão de estudos e planos de concepção de empreendimentos e sistemas de mobilidade urbana - Estudos de reorganização e integração do transporte público coletivo</label>
            </div>
            <div class="br-checkbox">
                <input
                    id="checkbox27"
                    name="itens_financiaveis[]"
                     v-bind:value='27' 
                    v-model='item_financiavel'
                    type="checkbox"
                    @change="onChangeItem"
                    aria-label="opção 1"
                    titulo="Objetiva qualificar a implementação e gestão da Política Nacional de Mobilidade
                    Urbana e a concepção de empreendimentos de infraestrutura de mobilidade urbana
                    para maior efetividade em sua implantação."
                />
                <label for="checkbox27">Elaboração/revisão de estudos e planos de concepção de empreendimentos e sistemas de mobilidade urbana - Estudos de demanda</label>
            </div>
            <div class="br-checkbox">
                <input
                    id="checkbox28"
                    name="itens_financiaveis[]"
                     v-bind:value='28' 
                    v-model='item_financiavel'
                    type="checkbox"
                    @change="onChangeItem"
                    aria-label="opção 1"
                    titulo="Objetiva qualificar a implementação e gestão da Política Nacional de Mobilidade
                    Urbana e a concepção de empreendimentos de infraestrutura de mobilidade urbana
                    para maior efetividade em sua implantação."
                />
                <label for="checkbox28">Elaboração/revisão de estudos e planos de concepção de empreendimentos e sistemas de mobilidade urbana - Planos operacionais</label>
            </div>
            <div class="br-checkbox">
                <input
                    id="checkbox29"
                    name="itens_financiaveis[]"
                     v-bind:value='29' 
                    v-model='item_financiavel'
                    type="checkbox"
                    @change="onChangeItem"
                    aria-label="opção 1"
                    titulo="Objetiva qualificar a implementação e gestão da Política Nacional de Mobilidade
                    Urbana e a concepção de empreendimentos de infraestrutura de mobilidade urbana
                    para maior efetividade em sua implantação."
                />
                <label for="checkbox29">
                    Elaboração/revisão de estudos e planos de concepção de empreendimentos e sistemas de mobilidade urbana - Estudo de Viabilidade Técnica, Econômica e Ambiental (EVTEA), conforme diretrizes constantes no Anexo II
                </label>
            </div>
        </div>
        <div class="p-3 text-right">
            <button class="br-button primary mr-3" name="Salvar"  v-if="this.countItens > 0">Salvar
            </button>
             <button class="br-button danger mr-3" type="button" onclick="javascript:window.history.go(-1)">
                Fechar
            </button>
        </div>
        
        <slot>
        </slot>
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
            },
            onChangeModalidade(){
                this.item_financiavel = [];
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
