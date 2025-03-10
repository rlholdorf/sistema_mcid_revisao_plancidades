<template>
    <div class="form-group">
        <div class="row">
            <div class="column col-xs-12 col-md-6">                
                <label for="programa">Programas</label>                
                <select 
                    id="programa"
                    class="form-select br-select" 
                    name="programa"  
                    @change="onChangePrograma"                    
                    v-model="programa">
                    <option value="">Escolha um Programa</option>
                    <option v-for="item in programas" v-text="item.txt_programa" :value="item.id" :key="item.id"></option>
                </select>    
            </div>
            <div class="column col-xs-12 col-md-6">                
                <label for="perspectivaPEI">perspectivaPEIs</label>                
                <select 
                    id="perspectivaPEI"
                    class="form-select br-select" 
                    name="perspectivaPEI"    
                    @change="onChangePerspectiva"                 
                    v-model="perspectivaPEI">
                    <option value="">Escolha uma Perspectiva</option>
                    <option v-for="item in perspectivasPEI" v-text="item.txt_perspectivas_pei" :value="item.id" :key="item.id"></option>
                </select>    
            </div>
        </div>
        <div class="row">
            <div class="column col-xs-12">                
                <label for="objetivoPPA">Objetivos Estratégicos</label>                
                <select 
                    id="objetivoPPA"
                    class="form-select br-select" 
                    name="objetivoPPA"                    
                    v-model="objetivoPPA">
                    <option value="">Escolha um Objetivo</option>
                    <option v-for="item in objetivosPPA" v-text="item.txt_titulo_objetivo_ppa" :value="item.id" :key="item.id"></option>
                </select>    
            </div>
        </div>

        <div class="titulo"><h5>Informações Básicas </h5> </div> 
        <span class="br-divider sm my-3"></span>

        <div class="row">
            <div class="col col-xs-12 col-sm-12 br-input">
                <label >Denominação 
                        <span class="br-tag count bg-info" 
                            title="Título da Iniciativa, ou seja, o nome daquilo que se pretende medir. Ex.: Capacitação dos servidores do Ministério; Execução orçamentária dos Programas Finalísticos. "><span aria-hidden="true">?</span></span>
                </label>
                <input id="txt_denominacao" 
                    type="text" 
                    name="txt_denominacao"    
                    v-model="txt_denominacao"                 
                    required >
            </div>
        </div><!-- div row -->

        <div class="row">
            <div class="col col-xs-12 col-sm-12 br-textarea">
                <label >Descrição da Iniciativa</label>
                <textarea class="input-medium" 
                        id="dsc_iniciativa_projeto" 
                        name="dsc_iniciativa_projeto"  
                        rows="5" 
                        v-model="dsc_iniciativa_projeto"                 
                        required                         
                            >
                </textarea>

            </div>    
        </div><!-- div row -->
        <div class="row"> 
            <div class="col col-xs-12 col-sm-4">
                <label for="secretaria">Secretaria</label>           
                <select 
                    id="secretaria"
                    class="form-select br-select" 
                    name="secretaria"  
                    v-model="secretaria"   
                    @change="onChangeSecretaria"
                    required
                >
                    <option value="" >Escolha uma Secretaria</option>
                    <option v-for="secretaria in secretarias" v-text="secretaria.txt_nome_secretaria" :value="secretaria.id" :key="secretaria.id"></option>
                </select>
            </div>
            <div class="col col-xs-12 col-sm-4">
                <label for="departamento">Departamento</label>           
                <select 
                    id="departamento"
                    class="form-select br-select" 
                    name="departamento"  
                    v-model="departamento"   
                    @change="onChangeDepartamento"  
                    :disabled="(this.secretaria == '')"
                    required
                >
                    <option value=""  v-text="textoEscolhaDepartamento"></option>
                    <option v-for="departamento in departamentos" v-text="departamento.txt_sigla_departamento" :value="departamento.id" :key="departamento.id"></option>
                </select>
            </div>
            <div class="col col-xs-12 col-sm-4">
                <label for="unidade_responsavel">Unidade Responsável
                    <span class="br-tag count bg-info" 
                    title="Informar, por extenso e com a sigla, qual a unidade interna que deverá ser responsável pela Iniciativa (nas Secretarias, detalhar o Departamento e Coordenação-Geral). O titular dessa unidade será o Gerente do Projeto, exceto se designada outra pessoa, formalmente. "><span aria-hidden="true">?</span></span>

                </label>           
                <select 
                    id="unidade_responsavel"
                    class="form-select br-select" 
                    name="unidade_responsavel"  
                    v-model="setor"   
                    @change="onChangeSetor"  
                    :disabled="(this.departamento == '')"   
                    required
                >
                    <option value=""  v-text="textoEscolhaSetor"></option>
                    <option v-for="setor in setores" v-text="setor.txt_sigla_setor" :value="setor.id" :key="setor.id"></option>
                </select>
            </div>
        </div><!-- fim row -->
        <div class="row"> 
            <div class="col col-xs-12 col-sm-6">
                <label for="bln_pac">Iniciativa descrita no PAC? </label>           
                <select 
                    id="bln_pac"
                    class="form-select br-select" 
                    name="bln_pac"  
                    v-model="bln_pac"                      
                    required
                >
                    <option value="" >Escolha um item</option>                    
                    <option value="0" >Não</option>                    
                    <option value="1" >Sim</option>                    
                </select>
            </div>
            <div class="col col-xs-12 col-sm-6">
                <label for="bln_min_ppa">Iniciativa oriunda de uma Medida Institucional ou Normativa do PPA 2024-2027? </label>           
                <select 
                    id="bln_min_ppa"
                    class="form-select br-select" 
                    name="bln_min_ppa"  
                    v-model="bln_min_ppa"   
                    required
                >
                <option value="" >Escolha um item</option>                    
                    <option value="0" >Não</option>                    
                    <option value="1" >Sim</option>     
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col col-xs-12 col-sm-12 br-textarea">
                <label >Observações</label>
                <textarea class="input-medium" 
                        id="txt_observacao" 
                        name="txt_observacao"  
                        rows="5" 
                        v-model="txt_observacao"                 
                        required                         
                            >
                </textarea>

            </div>    
        </div><!-- div row -->
        
    </div>
</template>

<script>
    export default {
        props:['url','dados'],
        data(){
            return{
                objetivosPPA:'',                              
                objetivoPPA:'',    
                programas:'',                              
                programa:'',  
                perspectivasPEI:'',                              
                perspectivaPEI:'',                            
                secretaria:'',
                secretarias:'',
                departamento:'',
                departamentos:'',
                textoEscolhaDepartamento: "Escolha uma secretaria:",
                textoEscolhaSetor: "Filtre um departamento:",                
                textoEscolhaUsuario:'Escolha um setor',
                usuario:'',
                usuarios:'',
                setor:'',
                setores:'',                
                txt_denominacao:'',
                txt_observacao:'',
                bln_pac:'',
                bln_min_ppa:'',
                txt_objetivo:'',
                txt_justificativa:'',
                txt_gerente:'',
                vlr_custo:'',
                dsc_iniciativa_projeto:''
            }
        },
        methods:{
            onChangePrograma() {
                this.objetivoPPA = '';
                this.buscando = true;
                if(this.programa != '') {
                    //Implementação correta após arrumar tabela dos municipios
                    axios.get(this.url + '/api/plancidades/objetivosPPA/programa/' + this.programa).then(resposta => {
                        this.buscando = false;
                        this.objetivosPPA = resposta.data;                 
                    }).catch(error => {
                        console.log(error);
                    });
                  
                } else {
                    this.buscando = false;
                    this.objetivoPPA = '';
                }            
            },
            onChangePerspectiva() {
                this.objetivoPPA = '';
                this.buscando = true;
                if(this.perspectiva != '') {
                    //Implementação correta após arrumar tabela dos municipios
                    axios.get(this.url + '/api/plancidades/objetivosPPA/perspectiva/' + this.perspectiva).then(resposta => {
                        this.buscando = false;
                        this.objetivosPPA = resposta.data;                 
                    }).catch(error => {
                        console.log(error);
                    });
                  
                } else {
                    this.buscando = false;
                    this.objetivoPPA = '';
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
                    this.textoEscolhaDepartamento = "Escolha uma Secretaria"
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
                    this.textoEscolhaSetor = "Escolha um Departamento"
                }            
            },
            onChangeSetor() {
                this.textoEscolhaUsuario = "Buscando...";
                
                this.buscando = true;
                if(this.setor != '') {
                    //Implementação correta após arrumar tabela dos municipios
                    axios.get(this.url + '/api/sistema/usuario/setor/' + this.setor).then(resposta => {
                        this.textoEscolhaUsuario = "Escolha um demandado:";
                        this.buscando = false;
                        this.usuarios = resposta.data;               
                    }).catch(error => {
                        console.log(error);
                    });
                  
                } else {
                    this.buscando = false;
                    this.usuario = '';
                    this.textoEscolhaUsuario = "Escolha um setor"
                }            
            },
        },
        mounted() {

            //retorna as secretarias
            axios.get(this.url + '/api/sistema/secretarias/').then(resposta => {
                this.textoEscolhaDepartamento = "Escolha uma secretaria:";
                this.buscando = false;
                this.secretarias = resposta.data;
                
            }).catch(error => {
                console.log(error);
            });
            axios.get(this.url + '/api/plancidades/programas').then(resposta => {
                this.programas = resposta.data;                
                }).catch(erro => {
                    console.log(erro);
                })

            axios.get(this.url + '/api/plancidades/perspectivasPEI').then(resposta => {
                this.perspectivasPEI = resposta.data;                
                }).catch(erro => {
                    console.log(erro);
                })

            axios.get(this.url + '/api/plancidades/objetivosPPA').then(resposta => {
                this.objetivosPPA = resposta.data;                
                }).catch(erro => {
                    console.log(erro);
                })

                if(this.dados){

                    
                    this.objetivoPPA = this.dados.objetivo_ppa_id;
                    this.programa = this.dados.programa_id;  
                    this.perspectivaPEI = this.dados.perspectiva_pei_id;                            
                    this.secretaria = this.dados.secretaria_id;
                    this.onChangeSecretaria();
                    this.departamento = this.dados.departamento_id;
                    this.onChangeDepartamento();
                    this.setor = this.dados.unidade_responsavel_id;
                    this.txt_denominacao = this.dados.txt_denominacao_iniciativa;
                    this.txt_observacao = this.dados.txt_observacao;
                    if(this.bln_pac){
                        this.bln_pac = 1;
                    }                        
                    else{
                        this.bln_pac = 0;
                    }  
                    
                    if(this.bln_min_ppa){
                        this.bln_min_ppa = 1;
                    }                        
                    else{
                        this.bln_min_ppa = 0;
                    }  

                    this.txt_objetivo = this.dados.txt_objetivo;
                    this.txt_justificativa = this.dados.txt_justificativa;
                    this.txt_gerente = this.dados.txt_gerente;
                    this.vlr_custo = this.dados.vlr_custo;
                    this.dsc_iniciativa_projeto = this.dados.dsc_iniciativa_projeto;
                }
        }
    }
</script>
