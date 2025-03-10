<template>
<div>
   
   <div class="well"> 
        <div class="form-group">
            <div class="row">
                <div class="col col-xs-12 col-sm-2 br-input">
                    <label for="dte_solicitacao" class="control-label">Data de Solicitação</label>
                    <input id="dte_solicitacao" 
                        type="date" 
                        class="form-control" 
                        name="dte_solicitacao" 
                        v-model="dte_solicitacao" 
                        :disabled="this.dados">
                </div>
                <div class="col col-xs-12 col-sm-3">
                    <label for="situacao">Situação da demanda</label>           
                    <select 
                        id="situacao"
                        class="form-select br-select" 
                        name="situacao"
                        required
                        :disabled="!this.dados"
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
                        :disabled="this.situacaoDemanda != 1"
                        required
                        v-model="tipoDemanda">
                        <option value="">Escolha um Tipo:</option>
                        <option v-for="tipoDemanda in tiposDemanda" v-text="tipoDemanda.txt_tipo_demanda" :value="tipoDemanda.id" :key="tipoDemanda.id"></option>
                    </select>                                  
                </div>
                <div class="col col-xs-12 col-sm-2">
                    <label for="tipo_atendimento">Tipo de Atendimento</label>           
                    <select 
                        id="tipo_atendimento"
                        class="form-select br-select" 
                        name="tipo_atendimento"
                        required
                        :disabled="this.situacaoDemanda != 1"
                        v-model="tipoAtendimento">
                        <option value="">Escolha um Tipo</option>
                        <option v-for="tipoAtendimento in tiposAtendimento" v-text="tipoAtendimento.txt_tipo_atendimento" :value="tipoAtendimento.id" :key="tipoAtendimento.id"></option>
                    </select>   
                </div> 
                <div class="col col-xs-12 col-sm-2">
                    <label for="bln_documento_sei">Documentos no SEI</label>
                    <select 
                        id="bln_documento_sei"
                        class="form-select br-select" 
                        name="bln_documento_sei"
                        required                        
                        v-model="bln_documento_sei">
                        <option value="" >Possui Documentos no SEI?</option>
                        <option value="0" >Não</option>
                        <option value="1" >Sim</option>

                    </select> 
                </div>               
            </div><!-- fim row -->
            <div class="row"> 
                <div class="col col-xs-12 col-sm-3">
                    <label for="secretaria">Secretaria Demandada</label>           
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
                <div class="col col-xs-12 col-sm-3">
                    <label for="departamento">Departamento Demandado</label>           
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
                <div class="col col-xs-12 col-sm-3">
                    <label for="setor">Setor Demandado</label>           
                    <select 
                        id="setor"
                        class="form-select br-select" 
                        name="setor"  
                        v-model="setor"   
                        @change="onChangeSetor"  
                        :disabled="(this.departamento == '')"   
                        required
                    >
                        <option value=""  v-text="textoEscolhaSetor"></option>
                        <option v-for="setor in setores" v-text="setor.txt_sigla_setor" :value="setor.id" :key="setor.id"></option>
                    </select>
                </div>
                <div class="col col-xs-12 col-sm-3">
                    <label for="usuario">Demandado</label>           
                    <select 
                        id="usuario"
                        class="form-select br-select" 
                        name="usuario"  
                        v-model="usuario"   
                        :disabled="(this.setor == '')" 
                        required
                    >
                        <option value=""  v-text="textoEscolhaUsuario"></option>
                        <option v-for="usuario in usuarios" v-text="usuario.name + ' (' + usuario.email+')'" :value="usuario.id" :key="usuario.id"></option>
                    </select>
                </div>   
            </div><!-- fim row -->
            <div class="row">           
                <div class="col col-xs-12 col-sm-6">
                    <label for="tema">Tema</label>           
                    <select 
                        id="tema"
                        class="form-select br-select" 
                        name="tema"
                        required
                        :disabled="this.situacaoDemanda != 1"
                         @change="onChangeTema"
                        v-model="tema">
                        <option value="">Escolha um Tema:</option>
                        <option v-for="tema in temas" v-text="tema.txt_tema" :value="tema.id" :key="tema.id"></option>
                    </select>     
                </div>
                <div class="col col-xs-12 col-sm-6">
                    <label for="subTema">SubTema</label>
                    <select 
                        id="subTema"
                        class="form-select br-select" 
                        name="subTema"
                        required
                        :disabled="(tema == '' || buscando) || this.situacaoDemanda != 1"
                        v-model="subTema">
                        <option value="" v-text="textoEscolhaTema"></option>
                        <option v-for="subTema in subTemas" v-text="subTema.txt_sub_tema" :value="subTema.id" :key="subTema.id"></option>
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
                        required
                        :disabled="this.situacaoDemanda == 2"
                        v-model="tipoInteressado">
                        <option value="">Escolha um Tipo Interessado:</option>
                        <option v-for="tipoInteressado in tiposInteressado" v-text="tipoInteressado.txt_tipo_interessado" :value="tipoInteressado.id" :key="tipoInteressado.id"></option>
                    </select>     
                </div>
                <div class="col col-xs-12 col-sm-8 br-input">
                      <label for="txt_nome_interessado" class="control-label">Nome do Interessado Externo</label>
                      <input id="txt_nome_interessado" type="text" class="form-control" name="txt_nome_interessado" v-model="nomeInteressado">    
                </div>                
            </div> 
        </div>


         <div class="form-group">
            <div class="row" v-if="this.tipoDemanda != 1">
                 <div class="col col-xs-12 col-sm-3">
                   <label for="uf">UF</label>           
                    <select 
                        id="estado"
                        class="form-select br-select" 
                        name="estado"
                        required
                        :disabled="this.situacaoDemanda != 1"
                        @change="onChangeEstado"
                        v-model="estado">
                        <option value="">Escolha um Estado:</option>
                        <option v-for="estado in estados" v-text="estado.txt_uf" :value="estado.id" :key="estado.id"></option>
                    </select>   
                </div>  
                 <div class="col col-xs-12 col-sm-9">
                   <!-- municipio -->    
                    <label for="municipio">Município</label>
                    <select 
                        id="municipio"
                        class="form-select br-select" 
                        name="municipio"
                        :disabled="(estado == '' || buscando) || this.situacaoDemanda != 1"
                        v-model="municipio">
                        <option value="" v-text="textoEscolhaMunicipio"></option>
                        <option v-for="municipio in municipios" v-text="municipio.ds_municipio" :value="municipio.id" :key="municipio.id"></option>
                    </select>   
                </div> 
            </div>
        </div>
        <div class="form-group br-textarea">
             <label for="dsc_demanda" class="control-label">Descrição da Demanda</label>
             <textarea class="form-control" 
                id="txt_descricao_demanda" 
                name="txt_descricao_demanda"  
                v-model="dscDemanda"
                rows="10" required></textarea>
        </div>
        <div class="form-group br-textarea">
            <label for="dsc_resposta_demanda" class="control-label">Resposta da Demanda</label>
            <textarea class="form-control" 
               id="dsc_resposta_demanda" 
               name="dsc_resposta_demanda"  
               v-model="dsc_resposta_demanda"
               rows="10"></textarea>
       </div>
        <div class="form-group">
             <div class="row">      
                <div class="col col-xs-12 col-sm-5">
                    <label for="prioridade">Prioridade</label>           
                    <select 
                        id="prioridade"
                        class="form-select br-select" 
                        name="prioridade"
                        required
                        :disabled="this.situacaoDemanda != 1"
                        @change="onChangePrioridade"
                        v-model="prioridade">
                        <option value="">Escolha um Prioridade:</option>
                        <option v-for="prioridade in prioridades" v-text="prioridade.txt_prioridade" :value="prioridade.id" :key="prioridade.id"></option>
                    </select>     
                </div>              
                <div class="col col-xs-12 col-sm-2 br-input">
                    <label for="qtd_dias_conclusao" class="control-label">Qtde Dias </label>
                        <input id="qtd_dias_conclusao" type="text" class="form-control" name="qtd_dias_conclusao" 
                            @change="onChangeDias" 
                            :disabled="this.situacaoDemanda != 1"
                            v-model="diasConclusao">    
                </div>  
                <!--
                <div class="col col-xs-12 col-sm-3 br-input">
                    <label for="dte_previsao_conclusao" class="control-label">Data de Previsão de Conclusão</label>
                    <input id="dte_previsao_conclusao" type="date" class="form-control" name="dte_previsao_conclusao" :value="this.dte_previsao_conclusao" :disabled="this.dados">
                </div>
                -->
                <div class="col col-xs-12 col-sm-5 br-input">
                    <label for="dte_conclusao" class="control-label">Data de Conclusão</label>
                    <input id="dte_conclusao" type="date" class="form-control" name="dte_conclusao" :value="this.dte_conclusao" :required="this.situacaoDemanda == 7">
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
                situacaoDemanda:'1',
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
                textoEscolhaDepartamento: "Escolha uma secretaria:",
                textoEscolhaSetor: "Filtre um departamento:",                
                textoEscolhaUsuario:'Escolha um setor',
                prioridade:1,
                prioridades:'',
                dte_previsao_conclusao: '',
                diasConclusao: 10,
                dte_solicitacao:'',
                dte_previsao_conclusao:'',
                dte_conclusao:'',
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
                usuario:'',
                usuarios:'',
                area: '',
                areas: '',
                dscDemanda:'',
                bln_documento_sei:'',
                dsc_resposta_demanda:'',
                dte_resposta_demanda:''
            }        
        },
        computed:{
            
        },
        methods:{
            adicionarDiasData(){
                let hoje        = new Date();
                let dataVenc    = new Date(hoje.getTime() + (this.diasConclusao * 24 * 60 * 60 * 1000));
                let novaData =  dataVenc.getFullYear() + "-" + (dataVenc.getMonth() + 1) + "-" + dataVenc.getDate()  ;
                this.dte_previsao_conclusao = novaData;
                
            },
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
                  this.dte_previsao_conclusao = this.adicionarDiasData();
            }
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


              

            // data atual
             
            this.dte_solicitacao = new Date().toLocaleDateString('en-CA');;
           this.dte_previsao_conclusao = this.adicionarDiasData();
            
           
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

          
                this.situacaoDemanda = 1;

            if(this.dados){

                this.situacaoDemanda = this.dados.situacao_id;
                
                this.tipoDemanda = this.dados.tipo_demanda_id;

                this.dscDemanda = this.dados.txt_descricao_demanda;
                
                this.estado = this.dados.uf_id;

                this.onChangeEstado();
                
                this.municipio = this.dados.municipio_id;
                
                
                
                
                this.tipoAtendimento = this.dados.tipo_atendimento_id;
                
                this.tema = this.dados.tema_id;

                this.onChangeTema();
                
                this.subTema = this.dados.subtema_id;
                
                
                this.prioridade = this.dados.prioridade_id,
                
                this.dte_previsao_conclusao = this.dados.dte_previsao_conclusao
                this.diasConclusao = this.dados.qtd_dias_conclusao;
                this.dte_solicitacao = this.dados.dte_solicitacao;

                this.dte_precisao_conclusao = this.dados.dte_precisao_conclusao;

                this.dte_conclusao = this.dados.dte_conclusao;

                this.dsc_resposta_demanda = this.dados.dsc_resposta_demanda;

                
                
                this.tipoInteressado = this.dados.tipo_interessado_id;
                
                this.nomeInteressado = this.dados.txt_nome_interessado;        

                this.modalidade = this.dados.modalidade_demanda_id;
                
                this.secretaria = this.dados.secretaria_id;
                this.onChangeSecretaria();

                this.departamento = this.dados.departamento_id;
                this.onChangeDepartamento();

                this.setor = this.dados.setor_id;
                this.onChangeSetor();

                this.usuario = this.dados.user_id_demandado;


                
                if(this.dados.bln_documento_sei)
                    this.bln_documento_sei = 1;
                else
                    this.bln_documento_sei = 0;


            }



        }
    }
</script>
