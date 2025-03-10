<template>
    <div class="form-group">  
    <div class="row">
        <div class="column col-sm-6">
            <div class="card">
                <div class="card-body">
                    <div id="viewlet-above-content-title"></div>
                    <h3 class="documentFirstHeading text-center">
                        PROCESSO SELETIVO - PROPOSTAS
                        </h3>
                    <span class="br-divider my-3"></span>
                    
                    <div class="row">                      
                        <blockquote class="blockquote">   
                            <strong><h3 class="text-dark">Quais são as modalidades de participação?</h3></strong>                    
                            
                            <p>
                                <strong>Programa 2217 – Desenvolvimento Urbano e Metropolitano </strong>- possui objetivo de Fomentar transformações urbanísticas estruturais 
                                e urbanização acessível orientadas pelas funções sociais da cidade e da propriedade.</br>                        
                            </p>

                            <p>
                                <strong>Programa 2218 - Gestão de Riscos e Desastres </strong>- possui objetivo de Investir na Compreensão e Redução do Risco, Ampliar a 
                                Preparação e Reduzir os Efeitos dos Desastres.</br>                        
                            </p>
                            
                            <p>
                                <strong>Programa 2219 – Mobilidade Urbana </strong>- possui objetivos consoantes com a
                                Política Nacional de Mobilidade Urbana, instituída pela Lei nº 12.587, de 3 de janeiro de
                                2012. ; e </p>

                             <p>
                                <strong>Programa 2222 – Saneamento Básico </strong>- possui objetivos consoantes com a Política Nacional de Saneamento Básico, 
                                instituída pela lei nº 11.445, de 5 de janeiro de 2007.</br>                        
                            </p>
                        </blockquote>

                        <blockquote class="blockquote">      
                              <strong><h3 class="text-dark">Quem pode enviar propostas?</h3></strong>                   
                            <p>
                               Entes Públicos locais (municípios, estados e Distrito Federal) direta ou indiretamente, por meio de companhias, autarquias ou agências habitacionais. 
                            </p>
                            
                        </blockquote>

                        <blockquote class="blockquote">                            
                            <strong><h3 class="text-dark">Como se registrar para acessar o sistema?</h3></strong>
                            <p>
                                Deve ser enviado ofício pelo proponente, assinado pelo Chefe do Poder Executivo quando a proposta for enviada pelo Ente Público diretamente, ou pelo Presidente 
                                da companhia, autarquia ou agência habitacional no caso de proposta apresentada por órgão da administração indireta. Os documentos devem ser elaborados em papel 
                                timbrado, digitalizados e enviados por intermédio do sistema, conforme os modelos disponibilizados abaixo:
                            </p>
                            
                        </blockquote>

                        <blockquote class="blockquote">                            
                            <strong><h3 class="text-dark">Modelo de Ofício</h3></strong>
                            <div class="row text-center">
                                <div class="column col-xs-12 text-center">
                                    <img v-bind:src="url + '/img/icones/termo.png'"  class="img-thumbnail" ></br>
                                    <a class="modeloOficio" v-bind:href="url + '/documentos/modelos/oficios/Modelo_Oficio_RP2.pdf'"  target="_blank">
                                        Entes Públicos Locais (Subnacionais)
                                    </a>
                                </div>
                               
                            </div>                          
                            
                        </blockquote>

                    
                        

                        <blockquote class="blockquote"> 
                         
                            <h4>Passo a passo para registro no sistema:</h4>
                                <p class="text-muted">
                                
                                1. Informe qual Proponente representará;</br>
                                2. Informe os dados do representante máximo do órgão responsável pela proposta;</br>                        
                                3. Informe os dados do usuário responsável pelo cadastramento da proposta;</br>
                                4. Clique em enviar; 
                                5. Na tela principal informe qual modalidade deseja participar e cadastre a proposta;</br>                        
                                6. Não esqueça de anexar o ofício necessário conforme vínculo direto com a 
                                administração do órgão responsável pela proposta 
                                (Verifique o conteúdo necessário conforme os modelo disponibilizado acima);</br>                                                          </br>
                                7. Aguarde o envio de confirmação de aprovação do cadastro por e-mail;</br>
                                8. Acesse o sistema pro meio do botão ENTRAR e redefina a senha padrão;</br> 
                                
                                </p>
                        </blockquote>  

                        <blockquote class="blockquote">   
                            <h4>Dúvidas sobre preenchimento da proposta:</h4>
                        
                            <p>- telefone para contato<strong>(61) 3314-6182</strong></p>
                            <p>- Encaminhar email para <strong>cadastramento.mcid@mdr.gov.br</strong></p>
                            <p>- <a 
                                class="modeloOficio" 
                                v-bind:href="url + '/documentos/manuais/manual_uso_sistema.pdf'"
                                target="_blank">Manual de Utilização do Sistema </a></p>
                        </blockquote> 
                        
                        <blockquote class="blockquote">   
                            <h4>Suporte Técnico:</h4>
                            <span class="br-divider dashed my-3"></span>
                        
                            <p>Encaminhar email para <strong>cadastramento.mcid@mdr.gov.br</strong></p>
                            
                        </blockquote>                               
                    </div>
                    <!--fim row-->

                </div><!--fim card-body-->
            </div><!--fim card-->
        </div><!--fim column col-sm-6-->
        
        <div class="column col-sm-6">
            <div class="card">
                <div class="card-body">
                <form v-bind:class="css" v-bind:action="action " v-bind:method="metodo" v-bind:enctype="enctype">
                
                <input v-if="token" type="hidden" name="_token" v-bind:value="token">
        
                    <div id="viewlet-above-content-title"></div>

                        <h3 class="documentFirstHeading text-center">
                            Formulário de Cadastro
                        </h3>
                        <span class="br-divider my-3"></span>
<!--                        
                            <h4>Modalidade de Participação</h4> 
                            <span class="br-divider my-3"></span>

                        <div class="row">  
                            <div class="column col-xs-12 col-md-12">
                                <label for="modalidade_participacao">Modalidade de Participação</label>     
                                <select 
                                    id="modalidade_participacao"
                                     class="form-select br-select"  
                                    name="modalidade_participacao"
                                    v-model="modalidade_participacao" 
                                    required>            
                                    <option for="participacao" value="">Escolha uma modalidade:</option>                
                                    <option v-for="item in modalidades_participacao" v-text="item.txt_modalidade_participacao" :value="item.id" :key="item.id"></option>   
                                    
                                </select>
                            </div>                        
                        </div>
    -->                    
                            <h4>Dados do Proponente</h4> 
                            <span class="br-divider my-3"></span>     
                        
                        <div class="row">        
                            <div class="column col-xs-12 col-md-4">
                                    <label for="uf">UF</label>           
                                    <select 
                                        id="estado"
                                        class="form-select br-select"  
                                        name="estado"
                                        required
                                        
                                        @change="onChangeEstado"
                                        v-model="estado">
                                        <option value="">Escolha um Estado:</option>
                                        <option v-for="estado in estados" v-text="estado.txt_uf" :value="estado.id" :key="estado.id"></option>
                                    </select>                                  
                                </div>        
                                <div class="column col-xs-12 col-md-8">
                        <!-- municipio -->    
                                    <label for="municipio">Município (Sede do Proponente)</label>
                                    <select 
                                        id="municipio"
                                        class="form-select br-select"  
                                        name="municipio"
                                        required
                                        :disabled="estado == '' || buscando"
                                        v-model="municipio">
                                        <option value="" v-text="textoEscolhaMunicipio"></option>
                                        <option v-for="municipio in municipios" v-text="municipio.ds_municipio" :value="municipio.id" :key="municipio.id"></option>
                                    </select>    
                                </div>
                            </div>
                        <slot>

                        </slot>
                        
                           
                            
                           

                        <span class="br-divider my-3"></span>
                            
                        
  
                          <!--
                        <div class="row">
                            <div class="column col-xs-12 col-md-12">
                                <label for="caminho_doc_cartorio">Anexar Ofício Assinado</label>
                                <input type="file" class="form-control-file" id="txt_caminho_oficio" name="txt_caminho_oficio" accept="image/* , application/pdf" required>
                            </div>
                           
                        </div> 
                        -->     
                            
                             <span class="br-divider my-3"></span>
                            <div class="row">
                                <div class="checkbox">
                                    <label>       
                                    <input type="checkbox" name="termo" v-model="bln_aceite" required>  
                                    estou de acordo que a inserção de propostas não se constitui garantia de acesso a recursos pelo
                                    proponente, que deverá atestar ciência da natureza discricionária da requisição
                                    conforme modelo disponível no sítio eletrônico do Ministério das Cidades.
                                    </label>
                                </div>   
                            </div><!-- fechar segundo form-group-->    
                            <span class="br-divider my-3"></span>
                            <strong>As informações constantes neste Formulário de Intenção têm validade até 31/12/2023.</strong>
                            <div class="row">
                             <input v-if='bln_aceite == true' class="btn btn-lg btn-primary btn-block" type="submit" value="Enviar">   
                             </div>
                       
                    </form> 
                </div><!--fim card-body-->
            </div><!--fim card-->
        </div><!--fim column col-sm-6-->
    </div>
    <!--fim row--> 
</div>


</template>

<script>
    export default {
        props:['url','errorshas','errorsfirst', 'token','enctype','metodo','css','action','show','estadoselecionado','municipioselecionado'],
        data(){
            return{
                modalidade_participacao:4,
                modalidades_participacao:'',
                tipo_contrapartidas:'',
                tipo_contrapartida:'',               
                tipo_proponente_id:'',
                estados:'',
                estado:'',
                municipios: '',
                municipio:'',
                municipiosbeneficiados: '',
                municipiobeneficiado:'',
                textoEscolhaMunicipio: 'Filtre o Estado',
                buscando: false,
                bln_aceite:'',
               

                
                
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
                        this.municipiosbeneficiados = resposta.data;
                    }).catch(error => {
                        console.log(error);
                    });
                  
                } else {
                    this.buscando = false;
                    this.municipio = '';
                    this.municipiobaneficiado = '';
                    this.textoEscolhaMunicipio = "Filtre o Estado"
                }            
            }
        },
        mounted() {
            axios.get(this.url + '/api/modalidade_participacao').then(resposta => {
                console.log(resposta.data);
                this.modalidades_participacao = resposta.data;
            }).catch(erro => {
                console.log(erro);
            });

            //console.log(this.form._token);
            axios.get(this.url + '/api/ufs').then(resposta => {
                //console.log(resposta.data);
                this.estados = resposta.data;
            }).catch(erro => {
                console.log(erro);
            });

            if(this.estadoselecionado){
                this.estado = this.estadoselecionado
                this.onChangeEstado
            }

            

            if(this.municipioselecionado){
                this.municipio = this.municipioselecionado
            }

            
        }
    }
</script>
