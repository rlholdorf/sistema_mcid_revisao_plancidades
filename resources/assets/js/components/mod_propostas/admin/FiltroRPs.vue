<template>
   <div class="form-group">  
        <div class="row">        
                                               
            <div class="column col-xs-12 col-md-2">
                <label for="txt_rp">Resultado Primário</label>           
                <select 
                    id="txt_rp"
                    class="form-select br-select" 
                    name="txt_rp"
                    v-model="txt_rp">
                    <option value="">Escolha um RP:</option>
                    <option value="RP2">RP2</option>
                    <option value="RP8">RP8</option>
                </select>                                  
            </div> 
            <div class="column col-xs-12 col-md-8">                
                <label for="situacaoProposta">Situação da Proposta</label>                
                <select 
                    id="situacaoProposta"
                    class="form-select br-select" 
                    name="situacaoProposta"                    
                    v-model="situacaoProposta">
                    <option value="">Escolha uma Situação</option>
                    <option v-for="item in situacoesPropostas" v-text="item.txt_sistuacao_proposta_ajustada" :value="item.id" :key="item.id"></option>
                </select>    
            </div>
            <div class="column col-xs-12 col-md-2">
                <label for="uf">UF</label>           
                <select 
                    id="estado"
                    class="form-select br-select" 
                    name="estado"
                    @change="onChangeEstado"
                    v-model="estado">
                    <option value="">Escolha um Estado:</option>
                    <option v-for="estado in estados" v-text="estado.txt_uf" :value="estado.id" :key="estado.id"></option>
                </select>                                  
            </div>
            
        </div>      
                    
        
        

        <div class="p-3 text-right">
            <button class="br-button primary mr-3" type="submit">Pesquisar</button>

            
            <button class="br-button danger mr-3" type="button" onclick="javascript:window.history.go(-1)">Voltar
            </button>
        </div> 
    </div>    
</template>

<script>
    export default {
        props:['url'],
        data(){
            return{
                
                estados:'',
                estado:'',
                txt_rp:'',
                textoEscolhaMunicipio: "Filtre o Estado",
                textoEscolhaEnte:"Filtre o Município",
                entespublicos: '',
                entepublico:'',
                situacoesPropostas: '',
                situacaoProposta:'',
                buscandoEnte: false,
                buscando: false,
               
            }        
        },
        methods:{
            onChangeEstado() {
                this.textoEscolhaMunicipio = "Buscando...";
                this.municipio = '';
                this.buscando = true;
                if(this.estado != '') {
                    //busca dados no banco de dados para carregar no componente
                    axios.get(this.url + '/api/rps/municipios/' + this.estado).then(resposta => {
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
           

           axios.get(this.url + '/api/rps/situacaoPropostasAjustadas').then(resposta => {
                //console.log(resposta.data);
                this.situacoesPropostas = resposta.data;
                this.situacaoProposta = '';
                }).catch(erro => {
                    console.log(erro);
                })

                
        }
       
            
    }
</script>
