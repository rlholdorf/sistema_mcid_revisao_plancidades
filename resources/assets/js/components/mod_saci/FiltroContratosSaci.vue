<template>
     <div class="form-group">
        <div class="row">               
            <div class="col col-xs-12 col-sm-1 br-input">
                <label for="uf">UF</label>           
                <select 
                    id="cod_uf"
                    class="form-select br-select" 
                    name="cod_uf" 
                    @change="onChangeEstado"
                    v-model="estado"  
                         
                >
                    <option value="">Escolha uma UF:</option>
                    <option v-for="estado in estados" 
                        v-text="estado.txt_sigla_uf" 
                        :value="estado.id" :key="estado.id">
                    </option>
                </select>
            </div>
            <div class="column col-xs-12 col-sm-3 br-input">
            <!-- municipio -->    
                <label for="municipio">Município Principal</label>
                <select 
                    id="municipio"
                    class="form-select br-select" 
                    name="municipio"
                    :disabled="estado == '' || buscando"
                    v-model="municipio"
                    >
                    <option value="" v-text="textoEscolhaMunicipio"></option>
                    <option v-for="municipio in municipios" v-text="municipio.ds_municipio" :value="municipio.cod_ibge_7_dig" :key="municipio.cod_ibge_7_dig"></option>
                </select>    
            </div>
            <!--
            <div class="col col-xs-12 col-sm-3">
                <label for="secretaria">Secretaria</label>           
                <select 
                    id="cod_secretaria"
                    class="input-medium" 
                    name="cod_secretaria"  
                    v-model="secretaria"  
                     @change="onChangeSecretaria"    
                     
                >
                    <option value="">Escolha uma Secretaria:</option>
                    <option v-for="secretaria in secretarias" 
                        v-text="secretaria.txt_sigla_secretaria" 
                        :value="secretaria.cod_secretaria" :key="secretaria.cod_secretaria">
                    </option>
                </select>
            </div>
        -->
            <div class="col col-xs-12 col-sm-2 br-input">
                <label for="area">Area</label>           
                <select 
                    id="cod_area"
                    class="form-select br-select" 
                    name="cod_area"  
                    v-model="area"    
                    @change="onChangeArea"
                      
                >
                    <option value="" >Escolha uma Area</option>
                    <option v-for="area in areas" 
                         v-text="area.txt_sigla_area" 
                        :value="area.cod_area" :key="area.cod_area">
                    </option>
                </select>
            </div>
            
            <div class="col col-xs-12 col-sm-3 br-input">
                <label for="monitor">Monitor</label>           
                <select 
                    id="monitor"
                    class="form-select br-select" 
                    name="monitor"       
                    v-model="monitor"    
                    :disabled="area == ''|| buscando || this.monitores.length==0"       
                      
                >
                    <option value=""  v-text="textoEscolhaMonitor" ></option>
                     <option v-for="monitor in monitores" 
                        v-text="monitor.txt_nome" 
                        :value="monitor.cod_usuario" :key="monitor.cod_usuario">
                    </option>
                </select>
            </div>
            <div class="col col-xs-12 col-sm-3 br-input">
                <label for="cod_fase">Fase</label>           
                <select 
                    id="cod_fase"
                    class="form-select br-select" 
                    name="fase"    
                     v-model="fase"    
                       
                >
                    <option value="">Escolha uma Fase:</option>
                    <option v-for="fase in fases" 
                        v-text="fase.dsc_fase" 
                        :value="fase.cod_fase" :key="fase.cod_fase">
                    </option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col col-xs-12 col-sm-2 br-input">
                <label for="modalidade">Modalidade</label>           
                <select 
                    id="cod_modalidade"
                    class="form-select br-select" 
                    name="cod_modalidade"    
                     v-model="modalidade"   
                     @change="onChangeModalidade" 
                     :disabled="area == '' || buscando" 
                                                   
                >
                   <option value="" v-text="textoEscolhaModalidade" ></option>
                   <option v-for="modalidade in modalidades" 
                        v-text="modalidade.dsc_modalidade" 
                        :value="modalidade.cod_modalidade" :key="modalidade.cod_modalidade">
                    </option>
                </select>
            </div>
            <div class="col col-xs-12 col-sm-2 br-input">
                <label for="submodalidade">Submodalidade</label>           
                <select 
                    id="cod_submodalidade"
                    class="form-select br-select" 
                    name="cod_submodalidade"  
                     v-model="submodalidade"      
                    :disabled="modalidade == '' || buscando || this.submodalidades.length==0" 
                           
                >
                   <option value="" v-text="textoEscolhaSubmodalidade" ></option>
                     <option v-for="submodalidade in submodalidades" 
                        v-text="submodalidade.dsc_submodalidade" 
                        :value="submodalidade.cod_submodalidade" :key="submodalidade.cod_submodalidade">
                    </option>
                </select>
            </div>
            
            <div class="col col-xs-12 col-sm-2 br-input">
                <label for="fonte">Fonte</label>           
                <select 
                    id="cod_fonte"
                    class="form-select br-select" 
                    name="cod_fonte"  
                    v-model="fonte"  
                     @change="onChangeFonte" 
                    :disabled="area == '' || buscando"
                      
                >
                    <option value="" v-text="textoEscolhaFonte"></option>
                   <option v-for="fonte in fontes" 
                         v-text="fonte.dsc_fonte" 
                        :value="fonte.cod_fonte" :key="fonte.cod_fonte">
                    </option>
                </select>
            </div>
            <div class="col col-xs-12 col-sm-3 br-input">
                <label for="situacao_contrato">Situação Contrato</label>           
                <select 
                    id="situacao_contrato"
                    class="form-select br-select" 
                    name="situacao_contrato"  
                    v-model="situacaoContrato"   
                       
                >
                    <option value="">Escolha uma Situacao Contrato:</option>
                    <option v-for="situacaoContrato in situacaoContratos" 
                        v-text="situacaoContrato.dsc_situacao_contrato" 
                        :value="situacaoContrato.cod_situacao_contrato" :key="situacaoContrato.cod_situacao_contrato">
                    </option>
                </select>
            </div>
            <div class="col col-xs-12 col-sm-3 br-input">
                <label for="situacao_obra">Situação Obra</label>           
                <select 
                    id="situacao_obra"
                    class="form-select br-select" 
                    name="situacao_obra" 
                    v-model="situacaoObra" 
                           
                >
                    <option value="">Escolha uma Situação Obra:</option>
                    <option v-for="situacaoObra in situacaoObras" 
                        v-text="situacaoObra.dsc_situacao_obra" 
                        :value="situacaoObra.cod_situacao_obra" :key="situacaoObra.cod_situacao_obra">
                    </option>
                </select>
            </div>
        </div><!-- div row -->
        <div class="row">
            <div class="col col-xs-12 col-sm-3 br-input">
                <label for="programa">Programa</label>           
                <select 
                    id="programa"
                    class="form-select br-select" 
                    name="programa" 
                    v-model="programa" 
                        
                >
                    <option value="">Escolha um Programa:</option>
                    <option v-for="programa in programas" 
                        v-text="programa.dsc_programa" 
                        :value="programa.cod_programa" :key="programa.cod_programa">
                    </option>
                </select>
            </div>
            <div class="col col-xs-12 col-sm-2 br-input">
                <label for="bln_ativo">Ativo</label>           
                <select 
                    id="bln_ativo"
                    class="form-select br-select" 
                    name="bln_ativo" 
                    v-model="bln_ativo" 
                        
                >
                <option value="">Contrato ativo?</option>
                <option value="1">Sim</option>
                <option value="0">Não</option>
                    
                </select>
            </div>
        </div><!-- div row -->
    </div>
</template>

<script>
    export default {
        props:['url'],
        data(){
            return{
                estado: '',
                estados: '',
                municipio:'',
                municipios:'',
                area: '',
                areas: '',
                modalidade: '',
                modalidades: '',
                submodalidade: '',
                submodalidades: '',
                monitor:'',
                monitores:'',
                fase: '',
                fases: '',
                fonte: '',
                fontes: '',
                secretaria: '',
                secretarias: '',
                situacaoContrato: '',
                situacaoContratos: '',
                situacaoObra: '',
                situacaoObras: '',
                programa: '',
                programas: '',
                bln_ativo:'',
                textoEscolhaArea: 'Filtre a Secretaria',
                 textoEscolhaSubmodalidade: 'Filtre a Modalidade',
                 textoEscolhaModalidade: 'Filtre a Area',
                 textoEscolhaFonte: 'Filtre a Area',
                 textoEscolhaMonitor: 'Filtre a Area',
                 textoEscolhaMunicipio: 'Filtre o Estado',

                      }
        }, 
        methods: {
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
                    this.textoEscolhaEmpreendimento = "Filtre o Estado"
                } 
            },
            onChangeSecretaria() {
                this.textoEscolhaArea = "Buscando...";
                this.textoEscolhaModalidade = "Filtre a Area"
                
                this.area = '';
                this.fonte = '';
                this.modalidade = '';
                this.buscando = true;
               
                if(this.secretaria != '') {
                   
                    axios.get(this.url + '/api/pac/areas/' + this.secretaria).then(resposta => {
                        this.textoEscolhaArea = "Escolha uma Area:";
                        this.textoEscolhaFonte = "Escolha uma Area:";
                        this.buscando = false;
                        this.areas = resposta.data;
                    }).catch(error => {
                        console.log(error);
                    });
                  
                } else {
                    this.buscando = false;
                    this.area = '';
                    this.textoEscolhaArea = "Filtre a Secretaria"
                    this.textoEscolhaModalidade = "Filtre a Area"
                    this.textoEscolhaFonte = "Filtre a Area"

                }            
            },
            onChangeArea() {
                this.textoEscolhaModalidade = "Buscando...";                
                this.modalidade = '';
                this.buscando = true;
               
                if(this.area != '') {
                   
                    axios.get(this.url + '/api/pac/modalidades/areas/' + this.area).then(resposta => {
                        this.textoEscolhaModalidade = "Escolha uma Modalidade:";
                        this.textoEscolhaFonte = "Escolha uma Fonte:";
                        this.buscando = false;
                        this.modalidades = resposta.data;
                    }).catch(error => {
                        console.log(error);
                    });

                     axios.get(this.url + '/api/pac/monitores/areas/' + this.area).then(resposta => {
                        this.textoEscolhaMonitor = "Escolha um Monitor:";
                        this.buscando = false;
                        this.monitores = resposta.data;
                       
                    }).catch(error => {
                        console.log(error);
                    });
                  
                } else {
                    this.buscando = false;
                    this.modalidade = '';
                    this.textoEscolhaModalidade = "Filtre a Area"
                    this.textoEscolhaFonte = "Filtre a Area"
                    this.textoEscolhaMonitor = "Filtre a Area"
                }            
            },
            onChangeModalidade() {
                this.textoEscolhaSubmodalidade = "Buscando...";
                this.subModalidade = '';
                this.buscando = true;
               
                if(this.modalidade != '') {
                   
                    axios.get(this.url + '/api/pac/submodalidades/modalidade/' + this.modalidade + '/areas/' + this.area).then(resposta => {
                        this.textoEscolhaSubmodalidade = "Escolha uma Submodalidade:";
                        this.buscando = false;
                         this.submodalidades = resposta.data;
                            
                        
                        if(this.submodalidades.length==0){
                           this.textoEscolhaSubmodalidade = "Não Existe Submodalildade";
                        }                       
                        
                    }).catch(error => {
                        console.log(error);
                    });
                  
                } else {
                    this.buscando = false;
                    this.subModalidade = '';
                    this.textoEscolhaSubmodalidade = "Filtre o Modalidade"
                }            
            },   
            onChangeFonte() {
                this.textoEscolhaModalidade = "Buscando...";                
                this.chamada = '';
                this.buscando = true;
                
                if(this.fonte != '') {
                   
                    axios.get(this.url + '/api/pac/chamadas/fontes/' + this.fonte +'/areas/' + this.area).then(resposta => {
                        this.textoEscolhaChamada = "Escolha uma Chamada:";                        
                        this.buscando = false;
                        this.chamadas = resposta.data;
                    }).catch(error => {
                        console.log(error);
                    });
                  
                } else {
                    this.buscando = false;
                    this.chamada = '';
                    this.textoEscolhaChamada = "Filtre a Fonte"
                    
                }            
            },  

        },        
        mounted() {
            console.log('Component mounted.')

              //retorna as secretarias
              axios.get(this.url + '/api/pac/secretarias').then(resposta => {
                
                this.secretarias = resposta.data;

            }).catch(erro => {
                console.log(erro);
            }); 


             //retorna as estados
             axios.get(this.url + '/api/estados').then(resposta => {                
                this.estados = resposta.data;
            }).catch(erro => {
                console.log(erro);
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

            //retorna as fontes
            axios.get(this.url + '/api/pac/fontes').then(resposta => {                
                this.fontes = resposta.data;
            }).catch(erro => {
                console.log(erro);
            }); 

              //retorna as fases
              axios.get(this.url + '/api/pac/fases').then(resposta => {                
                this.fases = resposta.data;
            }).catch(erro => {
                console.log(erro);
            }); 

             //retorna as situacaoContratos
             axios.get(this.url + '/api/pac/situacao_contratos').then(resposta => {                
                this.situacaoContratos = resposta.data;
            }).catch(erro => {
                console.log(erro);
            }); 

            //retorna as situacaoObras
            axios.get(this.url + '/api/pac/situacao_obras').then(resposta => {                
                this.situacaoObras = resposta.data;
            }).catch(erro => {
                console.log(erro);
            }); 

             //retorna os programas
             axios.get(this.url + '/api/pac/programas').then(resposta => {                
                this.programas = resposta.data;
            }).catch(erro => {
                console.log(erro);
            }); 



        }
    }
</script>
