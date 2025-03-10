<template>
   <div class="form-group">  
        <div class="row" v-if="!(estado || municipio || codigo_saci)">
            <div class="column col-xs-12 col-md-12">           
                <div class="br-input" >
                    <label for="cod_contrato">Código Contrato</label>
                    <input id="cod_contrato" name="cod_contrato" type="text"  v-model="cod_contrato" placeholder="Digite o Código do Empreendimentos no Ministério das Cidades. Ex: 01000501001"/>            
                </div>
            </div>
        
        </div> 
        <div class="row" v-if="!(estado || municipio || cod_contrato)">
            <div class="column col-xs-12 col-md-12">           
                <div class="br-input" >
                    <label for="codigo_saci">Código SACI</label>
                    <input id="codigo_saci" name="codigo_saci" type="text"  v-model="codigo_saci" placeholder="Digite o Código do SACI. Ex: 0100050"/>            
                </div>
            </div>

        </div> 
        
        <span class="br-divider my-3"></span>
        <div class="row"  v-if="!(codigo_saci || cod_contrato)">        
            <div class="column col-xs-12 col-md-3">
                <label for="uf">UF</label>           
                <select 
                    id="estado"
                    class="form-select br-select" 
                    name="estado"                   
                    @change="onChangeEstado"
                    v-model="estado">
                    <option value="">Escolha um Estado:</option>
                    <option v-for="estado in estados" v-text="estado.txt_sigla_uf" :value="estado.id" :key="estado.id"></option>
                </select>                                  
            </div>        
            <div class="column col-xs-12 col-md-9">
    <!-- municipio -->    
                <label for="municipio">Município</label>                
                <select 
                    id="municipio"
                    class="form-select br-select" 
                    name="municipio"                    
                    @change="onChangeMunicipio"
                    :disabled="estado == '' || buscando"
                    v-model="municipio">
                    <option value="" v-text="textoEscolhaMunicipio"></option>
                    <option v-for="municipio in municipios" v-text="municipio.ds_municipio" :value="municipio.id" :key="municipio.id"></option>
                </select>    
            </div>
        </div>

        <div class="row" v-if="!(codigo_saci || cod_contrato)">
            <div class="column col-xs-12 col-md-3">
                <label for="andamento">Andamento</label>                
                <select 
                    id="andamento"
                    class="form-select br-select" 
                    name="andamento"
                    v-model="andamento">
                    <option value="">Escolha um Andamento</option>
                    <option v-for="andamento in andamentos" v-text="andamento.txt_andamento" :value="andamento.id" :key="andamento.id"></option>
                </select>    
            </div>
        </div>
        <div class="p-3 text-right">
            <button class="br-button primary mr-3" type="submit" :disabled="estado == '' && municipio == '' && cod_contrato == '' && codigo_saci == '' ">Pesquisar
            </button>
            <button class="br-button danger mr-3" type="button" onclick="javascript:window.history.go(-1)">Voltar
            </button>
        </div> 
    </div>    
</template>

<script>
    export default {
        props:['url','requermunicipio','requeruf','complementonomelabelmun'],
        data(){
            return{
                cod_contrato:'',
                codigo_saci:'',
                estados:'',
                estado:'',
                municipios: '',
                municipio:'',
                textoEscolhaMunicipio: "Filtre o Estado",
                andamentos:'',
                andamento:'',
                codigo_consulta: ['cod_tci','cod_saci','cod_contrato']
               
            }        
        },
        methods:{
           
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
                        console.log(this.municipios);
                    }).catch(error => {
                        console.log(error);
                    });
                  
                } else {
                    this.buscando = false;
                    this.municipio = '';
                    this.textoEscolhaMunicipio = "Filtre o Estado"
                }            
            },
            onChangeMunicipio() {
                this.textoEscolhaEnte = "Buscando...";
                this.entepublico = '';
                this.buscandoEnte = true;
                if(this.municipio != '') {
                    //busca dados no banco de dados para carregar no componente
                    axios.get(this.url + '/api/bnde/municipios/' + this.municipio).then(resposta => {
                        this.textoEscolhaEnte = "Escolha um municipio:";
                        this.buscandoEnte = false;
                        this.entespublicos = resposta.data;                       
                    }).catch(error => {
                        console.log(error);
                    });
                  
                } else {
                    this.buscandoEnte = false;
                    this.entepublico = '';
                    this.textoEscolhaEnte = "Filtre o Município"
                }            
                
            }
        },
        mounted() {
            //console.log(this.form._token);
            axios.get(this.url + '/api/ufs').then(resposta => {
                //console.log(resposta.data);
                this.estados = resposta.data;
                this.estado = '';
                this.municipio = '';                
                }).catch(erro => {
                    console.log(erro);
                })
           


            axios.get(this.url + '/api/bndes/andamento').then(resposta => {
                //console.log(resposta.data);
                this.andamentos = resposta.data;
                this.andamento = '';
                }).catch(erro => {
                    console.log(erro);
                })

                
                
        }
       
            
    }
</script>
