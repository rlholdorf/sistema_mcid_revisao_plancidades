<template>
<div>
   
   <div class="well"> 
        <div class="form-group">
            <div class="row">
                
                <div class="col col-xs-12 col-sm-3">
                    <label for="situacao">Situação da demanda</label>           
                    <select 
                        id="situacao"
                        class="form-select br-select" 
                        name="situacao"
                     
                        v-model="situacaoDemanda">
                        <option value="">Escolha uma situação da demanda:</option>
                        <option v-for="situacaoDemanda in situacaoDemandas" v-text="situacaoDemanda.txt_situacao" :value="situacaoDemanda.id" :key="situacaoDemanda.id"></option>
                    </select>                                  
                </div>
                <div class="col col-xs-12 col-sm-3">
                    <label for="tipoDemanda">Tipo de demanda</label>           
                    <select 
                        id="tipo_demanda"
                        class="form-select br-select" 
                        name="tipo_demanda"
                       
                        v-model="tipoDemanda">
                        <option value="">Escolha um Tipo:</option>
                        <option v-for="tipoDemanda in tiposDemanda" v-text="tipoDemanda.txt_tipo_demanda" :value="tipoDemanda.id" :key="tipoDemanda.id"></option>
                    </select>                                  
                </div>
                <div class="col col-xs-12 col-sm-3">
                    <label for="tipo_atendimento">Tipo de Atendimento</label>           
                    <select 
                        id="tipo_atendimento"
                        class="form-select br-select" 
                        name="tipo_atendimento"
                        v-model="tipoAtendimento">
                        <option value="">Escolha um Tipo</option>
                        <option v-for="tipoAtendimento in tiposAtendimento" v-text="tipoAtendimento.txt_tipo_atendimento" :value="tipoAtendimento.id" :key="tipoAtendimento.id"></option>
                    </select>   
                </div> 
                <div class="col col-xs-12 col-sm-3">
                    <label for="bln_documento_sei">Documentos no SEI</label>
                    <select 
                        id="bln_documento_sei"
                        class="form-select br-select" 
                        name="bln_documento_sei"   
                        v-model="bln_documento_sei">
                        <option value="" >Possui Documentos no SEI?</option>
                        <option value="0" >Não</option>
                        <option value="1" >Sim</option>

                    </select> 
                </div>               
            </div><!-- fim row -->
            <div class="row"> 
                <div class="col col-xs-12 col-sm-4">
                    <label for="secretaria">Secretaria Demandada</label>           
                    <select 
                        id="secretaria"
                        class="form-select br-select" 
                        name="secretaria"  
                        v-model="secretaria"   
                        @change="onChangeSecretaria"
                    >
                        <option value="" >Escolha uma Secretaria</option>
                        <option v-for="secretaria in secretarias" v-text="secretaria.txt_nome_secretaria" :value="secretaria.id" :key="secretaria.id"></option>
                    </select>
                </div>
                <div class="col col-xs-12 col-sm-4">
                    <label for="departamento">Departamento Demandado</label>           
                    <select 
                        id="departamento"
                        class="form-select br-select" 
                        name="departamento"  
                        v-model="departamento"   
                        @change="onChangeDepartamento"
                    >
                        <option value=""  v-text="textoEscolhaDepartamento"></option>
                        <option v-for="departamento in departamentos" v-text="departamento.txt_sigla_departamento" :value="departamento.id" :key="departamento.id"></option>
                    </select>
                </div>
                <div class="col col-xs-12 col-sm-4">
                    <label for="setor">Setor Demandado</label>           
                    <select 
                        id="setor"
                        class="form-select br-select" 
                        name="setor"  
                        v-model="setor"    
                    >
                        <option value=""  v-text="textoEscolhaSetor"></option>
                        <option v-for="setor in setores" v-text="setor.txt_sigla_setor" :value="setor.id" :key="setor.id"></option>
                    </select>
                </div>
                   
            </div><!-- fim row -->
            <div class="row">           
                <div class="col col-xs-12 col-sm-4">
                    <label for="tema">Tema</label>           
                    <select 
                        id="tema"
                        class="form-select br-select" 
                        name="tema"
                         @change="onChangeTema"
                        v-model="tema">
                        <option value="">Escolha um Tema:</option>
                        <option v-for="tema in temas" v-text="tema.txt_tema" :value="tema.id" :key="tema.id"></option>
                    </select>     
                </div>
                <div class="col col-xs-12 col-sm-4">
                    <label for="subTema">SubTema</label>
                    <select 
                        id="subTema"
                        class="form-select br-select" 
                        name="subTema"
                        :disabled="(tema == '' || buscando)"
                        v-model="subTema">
                        <option value="" v-text="textoEscolhaTema"></option>
                        <option v-for="subTema in subTemas" v-text="subTema.txt_sub_tema" :value="subTema.id" :key="subTema.id"></option>
                    </select> 
                </div>  
                <div class="col col-xs-12 col-sm-4">
                    <label for="prioridade">Prioridade</label>           
                    <select 
                        id="prioridade"
                        class="form-select br-select" 
                        name="prioridade"
                        v-model="prioridade">
                        <option value="">Escolha um Prioridade:</option>
                        <option v-for="prioridade in prioridades" v-text="prioridade.txt_prioridade" :value="prioridade.id" :key="prioridade.id"></option>
                    </select>     
                </div>                 
            </div> 
        </div>            
        <div class="form-group">
             <div class="row" v-if="this.tipoDemanda == 2">      
                <div class="col col-xs-12 col-sm-4">
                    <label for="tipoInteressado">Tipo Interessado Externo</label>           
                    <select 
                        id="tipoInteressado"
                        class="form-select br-select" 
                        name="tipoInteressado"
                        v-model="tipoInteressado">
                        <option value="">Escolha um Tipo Interessado:</option>
                        <option v-for="tipoInteressado in tiposInteressado" v-text="tipoInteressado.txt_tipo_interessado" :value="tipoInteressado.id" :key="tipoInteressado.id"></option>
                    </select>     
                </div>
               
                 <div class="col col-xs-12 col-sm-4">
                   <label for="uf">UF</label>           
                    <select 
                        id="estado"
                        class="form-select br-select" 
                        @change="onChangeEstado"
                        v-model="estado">
                        <option value="">Escolha um Estado:</option>
                        <option v-for="estado in estados" v-text="estado.txt_uf" :value="estado.id" :key="estado.id"></option>
                    </select>   
                </div>  
                 <div class="col col-xs-12 col-sm-4">
                   <!-- municipio -->    
                    <label for="municipio">Município</label>
                    <select 
                        id="municipio"
                        class="form-select br-select" 
                        name="municipio"
                        :disabled="(estado == '' || buscando)"
                        v-model="municipio">
                        <option value="" v-text="textoEscolhaMunicipio"></option>
                        <option v-for="municipio in municipios" v-text="municipio.ds_municipio" :value="municipio.id" :key="municipio.id"></option>
                    </select>   
                </div> 
            </div>
        </div>
    </div>  
</div>    
</template>

<script>
    export default {
        props:['url','dados'],
        data(){
            return{
                estados:'',
                estado:'',
                municipios: '',
                municipio:'',
                textoEscolhaMunicipio: 'Filtre o Estado',
                buscando: false,
                situacaoDemanda:'',
                situacaoDemandas:'',
                tipoDemanda:'',
                tiposDemanda:'',
                tipoAtendimento:'',
                tiposAtendimento:'',
                tema:'',
                temas:'',
                subTema:'',
                subTemas:'',
                textoEscolhaTema: 'Filtre o Tema',
                textoEscolhaDepartamento: "Escolha um departamento:",
                textoEscolhaSetor: "Escolha uma setor:",
                prioridade:'',
                prioridades:'',               
                tipoInteressado:'',
                tiposInteressado:'',                
                nomeInteressado:'',                
                modalidade:'',
                modalidades:'',
                secretaria:'',
                secretarias:'',
                departamento:'',
                departamentos:'',
                setor:'',
                setores:'',
                area: '',
                areas: '',
                dscDemanda:'',
                bln_documento_sei:''
            }        
        },
        computed:{
            adicionarDiasData: function(){
                let hoje        = new Date();
                let dataVenc    = new Date(hoje.getTime() + (this.diasConclusao * 24 * 60 * 60 * 1000));
                let novaData =  dataVenc.getFullYear() + "-" + (dataVenc.getMonth() + 1) + "-" + dataVenc.getDate()  ;
                this.dte_previsao_conclusao = novaData;
                return novaData;
            }
        },
        methods:{
            onChangeEstado() {
                this.textoEscolhaMunicipio = "Buscando...";
                this.municipio = '';
                this.buscando = true;
                if(this.estado != '') {
                    //Implementação correta após arrumar tabela dos municipios
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
            },
            onChangeSecretaria() {
                this.textoEscolhaDepartamento = "Buscando...";
                this.departamento = '';
                this.buscando = true;
                if(this.secretaria != '') {
                    //Implementação correta após arrumar tabela dos municipios
                    axios.get(this.url + '/api/sistema/departamento/secretaria/' + this.secretaria).then(resposta => {
                        this.textoEscolhaDepartamento = "Escolha um departamento:";
                        this.buscando = false;
                        this.departamentos = resposta.data;                        
                        console.log(this.departamentos);                   
                    }).catch(error => {
                        console.log(error);
                    });
                  
                } else {
                    this.buscando = false;
                    this.departamento = '';
                    this.textoEscolhaDepartamento = "Filtre a Departamento"
                }            
            },
            onChangeDepartamento() {
                this.textoEscolhaSetor = "Buscando...";
                this.setor = '';
                this.buscando = true;
                if(this.departamento != '') {
                    //Implementação correta após arrumar tabela dos municipios
                    axios.get(this.url + '/api/sistema/setor/departamento/' + this.departamento).then(resposta => {
                        this.textoEscolhaSetor = "Escolha um setor:";
                        this.buscando = false;
                        this.setores = resposta.data;     
                    }).catch(error => {
                        console.log(error);
                    });
                  
                } else {
                    this.buscando = false;
                    this.setor = '';
                    this.textoEscolhaSetor = "Filtre um Setor"
                }            
            },
            onChangeTema(){
                this.textoEscolhaTema = "Buscando...";
                this.subTema = '';
                this.buscando = true;

                if(this.tema != ''){
                     //retorna os temas
                    axios.get(this.url + '/api/subTema/' + this.tema).then(resposta => {
                        this.textoEscolhaTema = "Escolha um SubTema:";
                        this.buscando = false;
                        this.subTemas = resposta.data;
                    }).catch(erro => {
                        console.log(erro);
                    });

                }else{
                    this.buscando = false;                      
                    this.subTema = '';
                    this.textoEscolhaTema = "Filtre o Tema";                    
                }
            },
            onChangePrioridade(){

                   if(this.prioridade != ''){
                     //retorna os temas
                    axios.get(this.url + '/api/prioridade/' + this.prioridade).then(resposta => {
                        this.diasConclusao = resposta.data;    
                       this.dte_previsao_conclusao = this.adicionarDiasData;

                        console.log(this.adicionarDiasData);     
                    }).catch(erro => {
                        console.log(erro);
                    });

                }else{
                    this.qtd_dias_conclusao = 30;
                    this.dte_previsao_conclusao = this.adicionarDiasData;
                }

                
            },
            onChangeDias(){
                  this.dte_previsao_conclusao = this.adicionarDiasData;
            }
        },
        mounted() {

                       
                //retorna as secretarias
            axios.get(this.url + '/api/sistema/secretarias/').then(resposta => {
                this.textoEscolhaDepartamento = "Escolha uma secretaria:";
                this.textoEscolhaSetor = "Escolha uma secretaria:";
                this.buscando = false;
                this.secretarias = resposta.data;
                this.onChangeSecretaria();
                
            }).catch(error => {
                console.log(error);
            });

            axios.get(this.url + '/api/sistema/departamentos/').then(resposta => {
                this.textoEscolhaDepartamento = "Escolha uma departamento:";
                this.buscando = false;
                this.departamentos = resposta.data;
                this.onChangeSecretaria();
                
            }).catch(error => {
                console.log(error);
            });

            axios.get(this.url + '/api/sistema/setores/').then(resposta => {
                this.textoEscolhaSetor = "Escolha um Setor:";
                this.buscando = false;
                this.setores = resposta.data;
                this.onChangeSecretaria();
                
            }).catch(error => {
                console.log(error);
            });


               //retorna as areas

            axios.get(this.url + '/api/pac/areas/').then(resposta => {
                this.textoEscolhaArea = "Escolha uma Area:";
                this.textoEscolhaFonte = "Escolha uma Area:";
                this.buscando = false;
                this.areas = resposta.data;
            }).catch(error => {
                console.log(error);
            });

           
            //retorna as ufs
            axios.get(this.url + '/api/ufs').then(resposta => {
                //console.log(resposta.data);
                this.estados = resposta.data;
            }).catch(erro => {
                console.log(erro);
            });

            //retorna os tipos de demanda
            axios.get(this.url + '/api/tipoDemanda').then(resposta => {
                //console.log(resposta.data);
                this.tiposDemanda = resposta.data;
            }).catch(erro => {
                console.log(erro);
            });

            //retorna os tipos de Atendimento
            axios.get(this.url + '/api/tipoAtendimento').then(resposta => {
                //console.log(resposta.data);
                this.tiposAtendimento = resposta.data;
            }).catch(erro => {
                console.log(erro);
            });

            //retorna os temas
            axios.get(this.url + '/api/tema').then(resposta => {
                //console.log(resposta.data);
                this.temas = resposta.data;
            }).catch(erro => {
                console.log(erro);
            });

             //retorna os temas
             axios.get(this.url + '/api/situacao_demanda').then(resposta => {
                //console.log(resposta.data);
                this.situacaoDemandas = resposta.data;
            }).catch(erro => {
                console.log(erro);
            });

            //retorna os prioridades
            axios.get(this.url + '/api/prioridade').then(resposta => {
                //console.log(resposta.data);
                this.prioridades = resposta.data;
            }).catch(erro => {
                console.log(erro);
            });

            //retorna os tipos de interessados
            axios.get(this.url + '/api/tipo_interessado').then(resposta => {
                //console.log(resposta.data);
                this.tiposInteressado = resposta.data;
            }).catch(erro => {
                console.log(erro);
            });

        }
    }
</script>
