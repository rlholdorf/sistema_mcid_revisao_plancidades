<template>
    <div class="form-group">  
        <div class="row">
            <div class="col col-xs-12 col-sm-12 br-textarea">
                <label >1. Objeto da Intervenção<span class="text-obrigatorio"></span></label>
                <textarea class="input-medium" 
                        id="dsc_obj_intervencao" 
                        name="dsc_obj_intervencao"  
                        rows="10" 
                        v-model="dsc_obj_intervencao"
                        required                         
                            >
                </textarea>

            </div>    
        </div><!-- div row -->

        <span class="br-divider my-3"></span>

        <div class="row">
            <div class="col col-xs-12 col-sm-12 br-input">
                <label >2. Valor da Intervenção</label>
                <input id="vlr_intervencao" 
                    type="text" 
                    name="vlr_intervencao"    
                    v-model="vlr_intervencao"                 
                    required >
            </div>
        </div><!-- div row -->

        <span class="br-divider my-3"></span>

        <div class="row">
            <div class="col col-xs-12 col-sm-12 br-textarea">
                <label >3. Justificativa da importância da intervenção<span class="text-obrigatorio"></span></label>
                <textarea class="input-medium" 
                        id="dsc_justificativa" 
                        name="dsc_justificativa"  
                        rows="10" 
                        v-model="dsc_justificativa"                 
                        required                         
                            >
                </textarea>

            </div>    
        </div><!-- div row -->

     <span class="br-divider my-3"></span>

        <div class="row">
            <div class="col col-xs-12 col-sm-12 br-textarea">
                <label >4. Descrição do problema a ser resolvido<span class="text-obrigatorio"></span></label>
                <textarea class="input-medium" 
                        id="dsc_problema_resolver" 
                        name="dsc_problema_resolver"  
                        rows="10" 
                        v-model="dsc_problema_resolver"                 
                        required                         
                            >
                </textarea>

            </div>    
        </div><!-- div row -->

        <span class="br-divider my-3"></span>

        <div class="row">
            <div class="col col-xs-12 col-sm-12 br-textarea">
                <label >5. Benefícios da intervenção (aspecto urbano e de empregabilidade)<span class="text-obrigatorio"></span></label>
                <textarea class="input-medium" 
                        id="dsc_beneficios_intervencao" 
                        name="dsc_beneficios_intervencao"  
                        rows="10" 
                        v-model="dsc_beneficios_intervencao"                 
                        required                         
                            >
                </textarea>

            </div>    
        </div><!-- div row -->

        <span class="br-divider my-3"></span>

        <div class="row">
            <div class="col col-xs-12 col-sm-6 br-input">
                <label for="bln_projeto_basico">6. O projeto básico referente à intervenção já está elaborado?</label>           
                <select 
                    id="bln_projeto_basico"
                    class="form-select br-select" 
                    name="bln_projeto_basico"     
                        v-model="bln_projeto_basico"                 
                        required     
                    >
                    <option value="">Escolha um Opção:</option>
                    <option value="1">Sim</option>
                    <option value="0">Não</option>

                    
                </select>
            </div>
            <div class="col col-xs-12 col-sm-6 br-input">
                <label for="bln_pb_acessibilidade">7. O projeto básico contempla aspectos relacionados ao desenvolvimento sustentável e acessibilidade?</label>           
                <select 
                    id="bln_pb_acessibilidade"
                    class="form-select br-select" 
                    name="bln_pb_acessibilidade"     
                        v-model="bln_pb_acessibilidade"                 
                        required     
                    >
                    <option value="">Escolha um Opção:</option>
                    <option value="1">Sim</option>
                    <option value="0">Não</option>

                    
                </select>
            </div>
        </div><!-- div row -->

        <span class="br-divider my-3"></span>

        <div class="row">
            <div class="col col-xs-12 col-sm-12 br-input">
                <p class="label mb-0">8. Selecione os itens itens financiáveis das ações orçamentárias do programa de Mobilidade urbana previstos no projeto básico:</p>
        
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
        </div>
        <!-- div row -->
        
  

        <span class="br-divider my-3"></span>

        <div class="row">
            <div class="col col-xs-12 col-sm-12 br-input">
                <label for="bln_plano_mobilidade_aprovado">9. Plano de mobilidade urbana aprovado ou com minuta concluída na Plataforma do Ministério das Cidades?</label>           
                <select 
                    id="bln_plano_mobilidade_aprovado"
                    class="form-select br-select" 
                    name="bln_plano_mobilidade_aprovado"  
                    v-model="bln_plano_mobilidade_aprovado"   
                    required     
                    >
                    <option value="">Escolha um Opção:</option>
                    <option value="1">Sim</option>
                    <option value="0">Não</option>
                </select>
            </div>
        </div><!-- div row -->

        

</div>
</template>

<script>
    export default {
        props:['url','itens','proposta','botaofechar'],
        data(){
            return{
                obj_intervencao:'',
                bln_botao:false,
                dsc_obj_intervencao:'',
                vlr_intervencao:'',
                dsc_justificativa:'',
                dsc_problema_resolver:'',
                dsc_beneficios_intervencao:'',
                bln_projeto_basico:'',
                bln_pb_acessibilidade:'',
                bln_plano_mobilidade_aprovado:'',
                item_financiavel:[],


                

                
                
            }        
        },
        methods:{
             
           
        },
        mounted() {

            console.log(this.proposta);

            if(this.proposta){
                this.dsc_obj_intervencao = this.proposta.dsc_obj_intervencao;
                this.vlr_intervencao = this.proposta.vlr_intervencao;
                this.dsc_justificativa = this.proposta.dsc_justificativa;
                this.dsc_problema_resolver = this.proposta.dsc_problema_resolver;
                this.dsc_beneficios_intervencao = this.proposta.dsc_beneficios_intervencao;
               
                if(this.proposta.bln_projeto_basico == true){
                    this.bln_projeto_basico = 1;
                }else{
                    this.bln_projeto_basico = 0;
                }

                if(this.proposta.bln_pb_acessibilidade == true){
                    this.bln_pb_acessibilidade = 1;
                }else{
                    this.bln_pb_acessibilidade = 0;
                }

                if(this.proposta.bln_plano_mobilidade_aprovado == true){
                    this.bln_plano_mobilidade_aprovado = 1;
                }else{
                    this.bln_plano_mobilidade_aprovado = 0;
                }
            }

            if(this.itens){
                for (let i = 0; i < this.itens.length; i++) {

                    this.item_financiavel.push(this.itens[i].item_financiavel_id);
                }
            }
           
        }
    }
</script>
