<template>
    <div class="form-group">
        <div class="row">
            <div class="column col-xs-12 col-sm-3">                
                <label for="casa_legislativa">Casa legislativa</label>           
                <select 
                    id="casa_legislativa"
                    class="form-select br-select" 
                    name="casa_legislativa"                   
                    @change="onChangeCasaLegislativa"
                    v-model="casa_legislativa">
                    <option value="">Escolha uma casa legislativa:</option>
                    <option v-for="casa_legislativa in casas_legislativas" v-text="casa_legislativa.txt_casa_legislativa" :value="casa_legislativa.id" :key="casa_legislativa.id"></option>
                </select>                                                      
            </div> 
            <div class="column col-xs-12 col-sm-3">                
                <label for="comissao">Comissão</label>           
                <select 
                    id="comissao"
                    class="form-select br-select" 
                    name="comissao"
                    v-model="comissao"
                    @change="onChangeComissao"
                    :disabled="casa_legislativa == '' || buscando">
                    <option value="">{{this.textoEscolhaComissao}}</option>
                    <option v-for="comissao in comissoes" v-text="comissao.txt_comissao" :value="comissao.id" :key="comissao.id"></option>
                </select>                                                      
            </div>
            <div class="col col-xs-12 col-sm-3 br-input">
                <label >Presidente</label>
                <input id="txt_presidente" 
                    type="text" 
                    name="txt_presidente"   
                    
                    v-model="txt_presidente" >                   
            </div>
            <div class="col col-xs-12 col-sm-3 br-input">
                <label >Partido</label>
                <input id="txt_partido_presidente" 
                    type="text" 
                    name="txt_partido_presidente"                       
                    v-model="txt_partido_presidente">                   
            </div>
        </div>
        <div class="row">
            <div class="col col-xs-12 col-sm-3 br-input">
                <label >Nº do Ofício da Presidência</label>
                <input id="num_oficio_congresso" 
                    type="number" 
                    name="num_oficio_congresso"  
                    v-model="num_oficio_congresso" 
                    required>                   
            </div>
            <div class="col col-xs-12 col-sm-3 br-input">
                <label >Nº completo Ofício</label>
                <input id="txt_num_oficio_completo_congresso" 
                    type="text" 
                    name="txt_num_oficio_completo_congresso"  
                    v-model="txt_num_oficio_completo_congresso" 
                    required>                   
            </div>
            <div class="col col-xs-12 col-sm-3 br-input">
                <label >Data Ofício</label>
                <input id="dte_oficio_congresso" 
                    type="date" 
                    name="dte_oficio_congresso"  
                    v-model="dte_oficio_congresso" 
                    required>                   
            </div>
            <div class="col col-xs-12 col-sm-3 br-input">
                <label >Nº Documento SEI</label>
                <input id="num_documento_sei_oficio_congresso" 
                    type="text" 
                    name="num_documento_sei_oficio_congresso"  
                    v-model="num_documento_sei_oficio_congresso" 
                    required>                   
            </div>
        </div>

        <div class="row">
            <div class="col col-xs-12 col-sm-12 br-input">
                <label >Nº Processo SEI</label>
                <input id="num_processo_sei" 
                    type="text" 
                    name="num_processo_sei"  
                    v-model="num_processo_sei" 
                    required>                   
            </div>
        </div>
        <div class="row">
            <div class="column col-xs-12 col-sm-6">                
                <label for="acao">Ação</label>           
                <select 
                    id="acao"
                    class="form-select br-select" 
                    name="acao"   
                    @change="onChangeAcao"                
                    v-model="acao">
                    <option value="">Escolha uma ação:</option>
                    <option v-for="acao in acoes" v-text="acao.id + ' - ' +acao.txt_acao_programa" :value="acao.id" :key="acao.id"></option>
                </select>                                                      
            </div> 
            <div class="column col-xs-12 col-sm-6">                
                <label for="programa">Programa</label>           
                <select 
                    id="programa"
                    class="form-select br-select" 
                    name="programa"   
                    :disabled="acao == ''"                
                    v-model="programa">
                    <option value="">{{this.txt_escolha_programa}}</option>
                    <option v-for="programa in programas" v-text="programa.txt_nome_programa" :value="programa.cod_programa" :key="programa.cod_programa"></option>
                </select>                                                      
            </div> 
        </div>

        
    </div>
</template>

<script>
    export default {
        props:['url'],
        data(){
            return{
                casa_legislativa:'',
                casas_legislativas:'',                               
                textoEscolhaComissao:'Filtre uma casa legislativa',
                comissao:'',
                comissoes:'',    
                programa:'',
                programas:'',    
                acao:'',
                acoes:'',    
                buscando: false  ,
                dadosComissao:'',  
                txt_presidente: "Filtre uma casa legislativa",
                txt_partido_presidente: "Filtre uma casa legislativa",
                txt_num_oficio_completo:'',
                txt_escolha_programa:'Filtre uma ação',
                dte_oficio:'',
                num_processo_sei:'',
                num_documento_sei:'',
                num_oficio_congresso:'',
                txt_num_oficio_completo_congresso:'',
                dte_oficio_congresso:'',
                num_documento_sei_oficio_congresso:''

            }
        },
        methods:{  
            onChangeCasaLegislativa() {
                this.textoEscolhaComissao = "Buscando...";
                this.comissao = '';
                this.buscando = true;
                if(this.casa_legislativa != '') {
                    //busca dados no banco de dados para carregar no componente
                    axios.get(this.url + '/api/comissoes/casa_legislativa/' + this.casa_legislativa).then(resposta => {
                        this.textoEscolhaComissao = "Escolha uma comissão:";
                        this.buscando = false;
                        this.comissoes = resposta.data;
                        console.log(this.comissoes);
                    }).catch(error => {
                        console.log(error);
                    });
                  
                } else {
                    this.buscando = false;
                    this.casa_legislativa = '';
                    this.textoEscolhaComissao = "Filtre uma casa legislativa"
                }   
            },
            onChangeComissao() {
                this.txt_presidente = "Buscando...";
                this.txt_partido_presidente = "Buscando...";
                this.buscando = true;
                if(this.comissao != '') {
                    //busca dados no banco de dados para carregar no componente
                    axios.get(this.url + '/api/comissao/' + this.comissao).then(resposta => {                        
                        this.buscando = false;
                        this.txt_presidente = resposta.data.txt_presidente;
                        this.txt_partido_presidente = resposta.data.txt_partido_presidente;
                        console.log(this.comissoes);
                    }).catch(error => {
                        console.log(error);
                    });
                  
                } else {
                    this.buscando = false;
                    this.txt_presidente = "'Filtre uma casa legislativa";
                    this.txt_partido_presidente = "'Filtre uma casa legislativa";
                }   
            },
            onChangeAcao() {
                this.txt_escolha_programa = "Buscando...";
                this.programa = '';
                this.buscando = true;
                if(this.acao != '') {
                    //busca dados no banco de dados para carregar no componente
                    axios.get(this.url + '/api/programas_rp/acao/' + this.acao).then(resposta => {
                        this.txt_escolha_programa = "Escolha um programa:";
                        this.buscando = false;
                        this.programas = resposta.data;
                        console.log(this.comissoes);
                    }).catch(error => {
                        console.log(error);
                    });
                  
                } else {
                    this.buscando = false;
                    this.casa_legislativa = '';
                    this.txt_escolha_programa = "Filtre uma ação"
                }   
            },
            
        } ,
        mounted() {           
            axios.get(this.url + '/api/casas_legislativas').then(resposta => {
                //console.log(resposta.data);
                this.casas_legislativas = resposta.data;
                }).catch(erro => {
                    console.log(erro);
                })

            axios.get(this.url + '/api/programas_rp').then(resposta => {
                //console.log(resposta.data);
                this.programas = resposta.data;
                }).catch(erro => {
                    console.log(erro);
                })

            axios.get(this.url + '/api/acaoPrograma').then(resposta => {
                //console.log(resposta.data);
                this.acoes = resposta.data;
                }).catch(erro => {
                    console.log(erro);
                })


                
        }
    }
</script>
