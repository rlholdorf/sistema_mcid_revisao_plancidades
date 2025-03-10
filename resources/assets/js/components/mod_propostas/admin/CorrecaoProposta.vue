<template>
    
<div class="form-group">  
    <div class="titulo"><h3>Dados da Proposta Antiga</h3> </div>  
    <div class="row">
        <div class="col col-xs-12 col-sm-12 br-textarea">
            <label >1. Objeto da Intervenção</label>
    
            <textarea class="input-medium" 
                    id="dsc_obj_intervencao" 
                    name="dsc_obj_intervencao"  
                    type="text"
                    rows="5"                         
                    v-model="dsc_obj_intervencao"
                    required    
                        >
            </textarea>
        </div>    
    </div><!-- div row -->  
    <div class="row">
        <div class="col col-xs-12 col-sm-12 br-textarea">
            <label >2. Justificativa da importância da intervenção</label>
            <textarea class="input-medium" 
                    id="dsc_justificativa" 
                    name="dsc_justificativa"  
                    rows="5" 
                    v-model="dsc_justificativa"                 
                    required                         
                        >
            </textarea>            
        </div>    
    </div><!-- div row -->
    <div class="row">
        <div class="col col-xs-12 col-sm-12 br-textarea">
            <label >3. Descrição do problema a ser resolvido</label>
            <textarea class="input-medium" 
                    id="dsc_problema_resolver" 
                    name="dsc_problema_resolver"  
                    rows="5" 
                    v-model="dsc_problema_resolver"                 
                    required                         
                        >
            </textarea>
        </div>    
    </div><!-- div row -->  
    <div class="row">
        <div class="col col-xs-12 col-sm-12 br-input input-highlight">        
         
            <label >4. Ações orçamentárias do programa:</label>

            
        </div>    
        
    </div><!-- div row -->
    <div class="br-list" role="list" >        
            <div class="br-item" role="listitem" v-for="dados in itens" >
                <div class="row align-items-center">
                   
                    <div class="col">
                        <li>{{dados.acao}} - {{dados.txt_acao_programa}} / {{dados.txt_item_financiavel}}  </li>
                    </div>
                
                </div>
            </div>               
        
      </div>
      <div class="titulo"><h3>Dados da Proposta Nova</h3> </div>  
      <div class="row">
        <div class="column col-xs-12 col-md-6">
            <label for="selecao">1. Modalidade</label>           
            <select 
                id="selecao"
                class="form-select br-select" 
                name="selecao" 
                required               
                v-model="selecao">
                <option value="">Escolha uma modalidade:</option>
                <option v-for="selecao in selecoes" v-text="selecao.txt_selecao" :value="selecao.id" :key="selecao.id"></option>
            </select>                                  
        </div>  
        <div class="column col-xs-12 col-md-6">
            <label for="motivoCorrecao">2. Motivo</label>           
            <select 
                id="motivoCorrecao"
                class="form-select br-select" 
                name="motivoCorrecao" 
                required               
                v-model="motivoCorrecao">
                <option value="">Escolha um motivo:</option>
                <option v-for="motivoCorrecao in motivoCorrecaos" v-text="motivoCorrecao.txt_motivo_correcao" :value="motivoCorrecao.id" :key="motivoCorrecao.id"></option>
            </select>                                  
        </div>        
    </div>
    <br/>
    <checks-itens-financiaveis-semob v-if="selecao == 1">
       
    </checks-itens-financiaveis-semob>
    <checks-itens-financiaveis-sndum v-if="selecao == 2"></checks-itens-financiaveis-sndum>
    <checks-itens-financiaveis-snsa v-if="selecao == 3"></checks-itens-financiaveis-snsa>
    <checks-itens-financiaveis-snsa-2018 v-if="selecao == 5"></checks-itens-financiaveis-snsa-2018>
    <span class="br-divider lg my-3"></span>
    

</div>
</template>

<script>
    export default {
        props:['url','itens','proposta','blnbotao'],
        data(){
            return{
                dsc_obj_intervencao:'',                              
                dsc_justificativa:'',
                dsc_problema_resolver:'',
                selecao:'',
                selecoes:'',
                buscando:false,
                itensFinanciaveis:'',
                itemFinanciavel:'',
                item_financiavel:[],
                motivoCorrecao:'',
                motivoCorrecaos:'',
                errors:{item_financiavel:false},     
                bln_erros:false  ,
                bln_botao:false,

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
                        document.getElementById('form_cancelar_proposta').submit(); 
                    }


                    },onChangeSelecao() {
                
                this.buscando = true;
                if(this.selecao != '') {
                    //busca dados no banco de dados para carregar no componente
                    axios.get(this.url + '/api/itens/modalidade/' + this.selecao).then(resposta => {
                        this.buscando = false;
                        this.itensFinanciaveis = resposta.data;
                        console.log(this.municipios);
                    }).catch(error => {
                        console.log(error);
                    });
                  
                } else {
                    this.buscando = false;
                    this.selecao = '';
                    this.textoEscolhaMunicipio = "Filtre o Estado"
                }   
            }         
            },
            mounted() {

            axios.get(this.url + '/api/selecao').then(resposta => {
                //console.log(resposta.data);
                this.selecoes = resposta.data;
                this.selecao = '';
                }).catch(erro => {
                    console.log(erro);
                })

            axios.get(this.url + '/api/motivo_correcao').then(resposta => {
                //console.log(resposta.data);
                this.motivoCorrecaos = resposta.data;
                this.motivoCorrecao = '';
                }).catch(erro => {
                    console.log(erro);
                })

            if(this.proposta){                
                this.dsc_obj_intervencao = this.proposta.dsc_obj_intervencao;
                this.dsc_justificativa = this.proposta.dsc_justificativa;
                this.dsc_problema_resolver = this.proposta.dsc_problema_resolver;
            }
        }
    }
</script>
