<template>
    <div class="form-group">  
                <div class="row">
            <div class="col col-xs-12 col-sm-12 br-textarea">
                <label >1. Objeto da Intervenção<span class="text-obrigatorio"></span></label>
                
                <textarea class="input-medium" 
                        id="dsc_obj_intervencao" 
                        name="dsc_obj_intervencao"  
                        type="text"
                        rows="10"                         
                        v-model="dsc_obj_intervencao"
                        required    
                            >
                </textarea>
                <span class="feedback danger" role="alert" v-if="this.bln_erros && this.errors.dsc_obj_intervencao">
                    <i class="fas fa-times-circle" aria-hidden="true"></i>Campo deve ser preenchido.
                </span>
                

            </div>    
        </div><!-- div row -->

        <span class="br-divider my-3"></span>

        <div class="row">
            <div class="col col-xs-12 col-sm-12 br-input">
                <label >2. Valor da Intervenção</label>
                <input id="vlr_intervencao" 
                    type="number"                    
                    step=".01"
                    minlength="250000"
                    name="vlr_intervencao"    
                    v-model="vlr_intervencao" 
                    required                                     >
                    <span class="feedback danger" role="alert" v-if="this.bln_erros && this.errors.vlr_intervencao">
                        <i class="fas fa-times-circle" aria-hidden="true"></i>{{ this.erro_vlr_intervencao }} 
                    </span>
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
                <span class="feedback danger" role="alert" v-if="this.bln_erros && this.errors.dsc_justificativa">
                    <i class="fas fa-times-circle" aria-hidden="true"></i>Campo deve ser preenchido.
                </span>

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
                <span class="feedback danger" role="alert" v-if="this.bln_erros && this.errors.dsc_problema_resolver">
                    <i class="fas fa-times-circle" aria-hidden="true"></i>Campo deve ser preenchido.
                </span>
            </div>    
        </div><!-- div row -->

        <span class="br-divider my-3"></span>

        <div class="row">
            <div class="col col-xs-12 col-sm-12 br-textarea">
                <label >5. Benefícios da intervenção quanto aos aspectos urbano e de empregabilidade<span class="text-obrigatorio"></span></label>
                <textarea class="input-medium" 
                        id="dsc_beneficios_intervencao" 
                        name="dsc_beneficios_intervencao"  
                        rows="10" 
                        v-model="dsc_beneficios_intervencao"                 
                        required                         
                            >
                </textarea>
                <span class="feedback danger" role="alert" v-if="this.bln_erros && this.errors.dsc_beneficios_intervencao">
                    <i class="fas fa-times-circle" aria-hidden="true"></i>Campo deve ser preenchido.
                </span>
            </div>    
        </div><!-- div row -->

        <span class="br-divider my-3"></span>

        <div class="row">
            <div class="col col-xs-12 col-sm-12 br-input">
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
                <span class="feedback danger" role="alert" v-if="this.bln_erros && this.errors.bln_projeto_basico">
                    <i class="fas fa-times-circle" aria-hidden="true"></i>Campo deve ter uma opção selecionada.
                </span>
            </div>
        </div>
        <span class="br-divider my-3"></span>
        <div class="row">
            <div class="col col-xs-12 col-sm-12 br-input">
                <p class="label mb-0">7. Selecione os itens financiáveis das ações orçamentárias do programa de Mobilidade urbana previstos no projeto básico:</p>
                <span class="feedback danger" role="alert" v-if="this.bln_erros && this.errors.item_financiavel">
                    <i class="fas fa-times-circle" aria-hidden="true"></i>Campo deve ter uma opção selecionada.
                </span>
                
                <div class="br-checkbox">
                    <input
                        id="checkbox37"
                        name="itens_financiaveis[]"
                         v-bind:value='47' 
                        v-model='item_financiavel'
                        type="checkbox"
                      
                    />
                    <label for="checkbox37">00CW - Subvenção Econômica Destinada a Ampliação do Acesso ao Financiamento Habitacional</label>
                </div>
            </div>
        </div>
        <!-- div row -->
        
  



        <div class="p-3 text-right">
            <button class="br-button primary mr-3" name="Salvar" v-on:click="checkForm" v-if="this.blnbotao">Salvar
            </button>
            <slot>
                
            </slot>

        </div>

        

        

</div>
</template>

<script>
    export default {
        props:['url','itens','proposta','blnbotao'],
        data(){
            return{
                estados:'',
                estado:'',
                municipios: '',
                municipio:'',
                textoEscolhaMunicipio: 'Filtre o Estado',
                buscando: false,
                obj_intervencao:'',
                bln_botao:false,
                dsc_obj_intervencao:'',
                vlr_intervencao:'',
                erro_vlr_intervencao:'',
                dsc_justificativa:'',
                dsc_problema_resolver:'',
                dsc_beneficios_intervencao:'',
                bln_projeto_basico:'',                
                bln_valor_incorreto:false ,
                item_financiavel:[],
                errors:{dsc_obj_intervencao:false, dsc_justificativa:false,vlr_intervencao:false,dsc_problema_resolver:false,dsc_beneficios_intervencao:false,bln_projeto_basico:false, bln_pb_acessibilidade:false,item_financiavel:false},     
                bln_erros:false   ,
                bln_itens_financiaveis:''   
                
            }        
        },
        methods:{
            checkForm: function () {


                

                this.errors.item_financiavel = false
                this.bln_erros = false;

                
                if(this.item_financiavel.length == 0){
                this.errors.item_financiavel = true;
                this.bln_erros = true;                
                }

              

                

                this.errors.dsc_obj_intervencao = false
                

                if(!this.dsc_obj_intervencao){
                    this.errors.dsc_obj_intervencao = true;
                    this.bln_erros = true;
                }

                this.errors.dsc_justificativa = false
                if(!this.dsc_justificativa){
                    this.errors.dsc_justificativa = true;
                    this.bln_erros = true;
                }

                this.errors.dsc_problema_resolver = false
                if(!this.dsc_problema_resolver){
                    this.errors.dsc_problema_resolver = true;
                    this.bln_erros = true;
                }

                this.errors.dsc_beneficios_intervencao = false
                if(!this.dsc_beneficios_intervencao){
                    this.errors.dsc_beneficios_intervencao = true;
                    this.bln_erros = true;
                }

                this.errors.bln_projeto_basico = false
                if(!this.bln_projeto_basico){
                    this.errors.bln_projeto_basico = true;
                    this.bln_erros = true;
                }

                               
                
                this.errors.vlr_intervencao = false
                this.bln_valor_incorreto = false;
                if(!this.vlr_intervencao){
                    this.errors.vlr_intervencao = true;
                    this.bln_erros = true;
                    this.erro_vlr_intervencao = 'O campo Valor da Intervenção de ser preenchido.'
                }else if(this.vlr_intervencao < 250000){
                    this.errors.vlr_intervencao = true;
                    this.bln_erros = true;
                    this.erro_vlr_intervencao = 'O campo Valor da Intervenção deve ser maior que 250.000,00'
                } 
      
                if(this.bln_erros){
                    Swal({
                        title: 'Atenção!',
                        text: "Existem erros no preenchimento do cadastro.",
                        type: 'warning',
                        showCancelButton: false,
                        confirmButtonColor: '#28a745',
                        cancelButtonColor: '#dc3545',
                        confirmButtonText: 'OK',
                        cancelButtonText: 'Cancelar',
                        }).then((result) => {
                            if (result.value ) {
                               
                            }else{
                             
                            }
                        })
                }else{
                    console.log('Sem erros: ' + this.bln_valor_incorreto +' - '+ this.bln_erros);
                    document.getElementById('form_cad_proposta_semob').submit(); 
                }

                
            },
            onChangeEstado() {
                this.textoEscolhaMunicipio = "Buscando...";
                this.municipio = '';
                this.buscando = true;
                if(this.estado != '') {
                    //busca dados no banco de dados para carregar no componente
                    axios.get(this.url + '/api/municipios/' + this.estado).then(resposta => {
                        this.textoEscolhaMunicipio = "Escolha um municipio:";
                        this.buscando = false;
                        this.municipios = resposta.data;
                    }).catch(error => {
                        console.log(error);
                    });
                  
                } else {
                    this.buscando = false;
                    this.municipio = '';
                    this.textoEscolhaMunicipio = "Filtre o Estado"
                }            
            }
           
        },
        mounted() {

            console.log(this.itens);

             //console.log(this.form._token);
             axios.get(this.url + '/api/ufs').then(resposta => {
                //console.log(resposta.data);
                this.estados = resposta.data;
            }).catch(erro => {
                console.log(erro);
            });

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

                if(this.proposta.bln_itens_financiaveis == true){
                    this.bln_itens_financiaveis = 1;
                }else{
                    this.bln_itens_financiaveis = 0;
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
