<template>
   <div class="form-group">   
        <div class="row">        
            <div class="column col-xs-12 col-md-3">
                <label for="uf">UF</label>           
                <select 
                    id="estado"
                    class="form-select br-select" 
                    name="estado"
                    :="requeruf == 'true'"
                    @change="onChangeEstado"
                    v-model="estado">
                    <option value="">Escolha um Estado:</option>
                    <option v-for="estado in estados" v-text="estado.sg_uf" :value="estado.uf_id" :key="estado.uf_id"></option>
                </select>                                  
            </div>        
            <div class="column col-xs-12 col-md-9">
    <!-- municipio -->    
                <label for="municipio">Município</label>                
                <select 
                    id="municipio"
                    class="form-select br-select" 
                    name="municipio"
                    :="requermunicipio == 'true'"
                    @change="onChangeMunicipio"
                    :disabled="estado == '' || buscando"
                    v-model="municipio">
                    <option value="" v-text="textoEscolhaMunicipio"></option>
                    <option v-for="municipio in municipios" v-text="municipio.ds_municipio" :value="municipio.municipio_id" :key="municipio.municipio_id"></option>
                </select>    
            </div>
        </div>
        <div class="row">
            <div class="col col-xs-12 col-sm-3 br-input">
                <label for="bln_analisado">Ofício Analisado</label>           
                <select 
                    id="bln_analisado"
                    class="form-select br-select" 
                    name="bln_analisado"  
                    v-model="bln_analisado"                   
                         
                    >
                    <option value="">Escolha um Opção:</option>
                    <option value="true">Sim</option>
                    <option value="false">Não</option>
                </select>
            </div>

            <div class="col col-xs-12 col-sm-3 br-input">
                <label for="bln_validado">Ofício Validado</label>           
                <select 
                    id="bln_validado"
                    class="form-select br-select" 
                    name="bln_validado"  
                    v-model="bln_validado"  
                    :disabled="bln_analisado == 'false'"                 
                         
                    >
                    <option value="">Escolha um Opção:</option>
                    <option value="true">Sim</option>
                    <option value="false">Não</option>
                </select>
            </div>
                       
            <div class="column col-xs-12 col-md-6">
                <label for="detalhamento">Motivo do Indeferimento</label>   
                <select 
                    id="tipo_indeferimento"
                    class="form-control" 
                    name="tipo_indeferimento"               
                    v-model="tipo_indeferimento"
                    :disabled="bln_validado == 'true' || bln_analisado == 'false'"
                    >
                    <option value="" selected>Escolha um Motivo do Indeferimento</option>
                    <option v-for="tipo_indeferimento in tipo_indeferimentos" v-text="tipo_indeferimento.txt_tipo_indeferimento" :value="tipo_indeferimento.id" :key="tipo_indeferimento.id"></option>
                </select>    
            </div>       
        </div>

        <div class="p-3 text-right">
            <button class="br-button primary mr-3" type="submit" :disabled="estado == '' && municipio == '' && bln_analisado  == '' && bln_validado == '' && tipo_indeferimento == ''">Pesquisar
            </button>
            <button class="br-button danger mr-3" type="button" onclick="javascript:window.history.go(-1)">Voltar
            </button>
        </div> 
    </div>    
</template>

<script>
    export default {
        props:['url','municipioselecionado','ufselecionada','coluf','colmun','requermunicipio','requeruf','complementonomelabelmun'],
        data(){
            return{
                estados:'',
                estado:'',
                municipios: '',
                municipio:'',
                tipo_indeferimentos:'',
                tipo_indeferimento:'',
                textoEscolhaMunicipio: 'Filtre o Estado',
                buscando: false,
                bln_analisado:'',
                bln_validado:'',
               // requeruf:'true',
               // requermunicipio:'true'
            }        
        },
        methods:{
            onChangeEstado() {
                this.textoEscolhaMunicipio = "Buscando...";
                this.municipio = '';
                this.buscando = true;
                if(this.estado != '') {
                    //busca dados no banco de dados para carregar no componente
                    axios.get(this.url + '/api/oficios/municipios/' + this.estado).then(resposta => {
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
            },
            onChangeMunicipio() {
                if(this.municipio){
                    this.municipioselecionado = this.municipio;
                }
                
            }
        },
        mounted() {
            //console.log(this.form._token);
            axios.get(this.url + '/api/oficios/ufs').then(resposta => {
                //console.log(resposta.data);
                this.estados = resposta.data;
                this.estado = '';
                this.municipio = '';                
                }).catch(erro => {
                    console.log(erro);
                })

                

            axios.get(this.url + '/api/tipoIndeferimento').then(resposta => {
                //console.log(resposta.data);
                this.tipo_indeferimentos = resposta.data;
            }).catch(erro => {
                console.log(erro);
            });
                this.estado = '';
                this.municipio = '';
            }
        
            
    }
</script>
