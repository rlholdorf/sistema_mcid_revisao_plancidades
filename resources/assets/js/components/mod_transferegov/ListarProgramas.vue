<template>
    <div class="row justify-content-center" >
        <div class="col col-sm-12 col-md-4" >
            <div class="br-card mb-3" >
                <div class="card-content" >
                    <div style="height:75vh">
                        <div class="row justify-content-between">
                            <div class="column col-3">
                                <p class="text-weight-semi-bold text-up-02">Filtros</p>
                            </div>
                        </div>                    
                        <hr>
                        <div class="d-flex flex-column">
                            <div class="mb-3">
                                <div class="br-input">
                                    <label for="txt_busca">Filtrar por texto</label>
                                    <input class="br-input" name="txt_busca" id="txt_busca" placeholder="Insira um texto para pesquisa..." v-model="txt_busca">
                                    <button class="br-button" type="button" aria-label="Buscar" @click="filtrarProgramas"><i class="fas fa-search" aria-hidden="true"></i>
                                    </button>
                                </div>
                            </div>

                            <hr>

                            <div class="row">
                                <div class="col-4 mb-3">
                                    <label for="ano">Ano</label>
                                    <select class="form-select br-select" name="ano" id="ano" v-model="ano">
                                        <option value="">-</option>
                                        <option :value="2024" :key="2024">2024</option>
                                        <option :value="2025" :key="2025">2025</option>
                                    </select>
                                </div>
                                
                                <div class="col-4 mb-3">
                                    <label for="acao">Ação</label>
                                    <select class="form-select br-select" name="acao" id="acao" v-model="acao">
                                        <option value="">-</option>
                                        <option v-for="item in acoes" v-text="item.cod_acao_governo" :key="item.cod_acao_governo"
                                            :value="item.cod_acao_governo"></option>
                                    </select>
                                </div>

                                <div class="col-4 mb-3">
                                    <label for="rp">Resultado Primário</label>
                                    <select class="form-select br-select" name="rp" id="rp" v-model="rp">
                                        <option value="">-</option>
                                        <option v-for="item in rps" v-text="item.txt_rp" :key="item.cod_resultado_primario"
                                            :value="item.cod_resultado_primario"></option>
                                    </select>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-6 mb-3">
                                    <label for="secretaria">Secretaria</label>
                                    <select class="form-select br-select" name="secretaria" id="secretaria" v-model="secretaria">
                                        <option value="">-</option>
                                        <option v-for="item in secretarias"
                                            v-text="item.txt_sigla_secretaria"
                                            :key="item.id" :value="item.id"></option>
                                    </select>
                                </div>

                                <div class="col-6 mb-3">
                                    <label for="bln_novo_pac">Novo PAC</label>
                                    <select class="form-select br-select" name="bln_novo_pac" id="bln_novo_pac" v-model="bln_novo_pac">
                                        <option value="">-</option>
                                        <option :value="true">Sim</option>
                                        <option :value="false">Não</option>
                                    </select>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="eixo">Eixo</label>
                                <select class="form-select br-select" name="eixo" id="eixo" v-model="eixo">
                                    <option value="">-</option>
                                    <option v-for="item in eixos" v-text="item.txt_eixo" :key="item.cod_eixo"
                                        :value="item.cod_eixo"></option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="subeixo">Sub-Eixo</label>
                                <select class="form-select br-select" name="subeixo" id="subeixo" v-model="subeixo">
                                    <option value="">-</option>
                                    <option v-for="item in subeixos" v-text="item.txt_subeixo" :key="item.cod_subeixo"
                                        :value="item.cod_subeixo"></option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="modalidade">Modalidade</label>
                                <select class="form-select br-select" name="modalidade" id="modalidade" v-model="modalidade">
                                    <option value="">-</option>
                                    <option v-for="item in modalidades" v-text="item.txt_modalidade" :key="item.cod_modalidade"
                                        :value="item.cod_modalidade"></option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="grupo">Grupo Modalidade</label>
                                <select class="form-select br-select" name="grupo" id="grupo" v-model="grupo">
                                    <option value="">-</option>
                                    <option v-for="item in grupos" v-text="item.txt_grupo_modalidade" :key="item.cod_grupo_modalidade"
                                        :value="item.cod_grupo_modalidade"></option>
                                </select>
                            </div>
                        </div>

                        <hr>

                        <div class="d-flex flex-column align-items-end">
                            <div class="row">
                                <button class="br-button secondary mr-3" type="button" @click="limparFiltros">Limpar</button>
                                <button class="br-button primary mr-3" type="button" @click="filtrarProgramas">Aplicar</button>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
        
        <div class="col col-sm-8">
            <div class="br-card">
                <div class="card-content">
                    <div class='overflow-scroll py-3' style="height:75vh">

                        <div v-if="buscando">
                            <h2 class="text-center">Buscando<i class="fa fa-spinner fa-spin"></i></h2>
                        </div>
                        
                        <div v-else>
                            <div v-if="programas.length > 0">
                                <div v-for="programa in programas">
                                    <div class="br-card mb-4">
                                        <div class="row"></div>
                                            <div class="card-header bg-primary-300 p-0">
                                                <div class="d-flex">
                                                <div class="ml-3">
                                                    <div class="text-weight-semi-bold py-3">Cod. Programa {{programa.cod_programa}}</div>
                                                </div>
                                                </div>
                                            </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-8">
                                                    <div class="d-flex align-items-baseline">
                                                        <label class="card-title">Ação: {{programa.num_acao_orcamentaria}}</label>
                                                            <span v-if="programa.dsc_sit_programa == 'INATIVO'" class="ml-3 br-tag bg-danger">
                                                                <p class="text-white">Inativo</p>
                                                            </span>

                                                            <span v-else-if="!programa.cod_programa_cidades" class="ml-3 br-tag bg-warning">
                                                                <p class="">Registro pendente</p>
                                                            </span>
                                                            <span v-else class="ml-3 br-tag bg-success">
                                                                <p class="text-white">Concluído</p>
                                                            </span>
                                                    </div>
                                                    <p class="card-text">{{programa.nom_programa}}</p>
                                                </div>

                                                <div class="col-4 d-flex justify-content-end align-items-end">
                                                    <div v-if="programa.dsc_sit_programa == 'DISPONIBILIZADO'">
                                                        <div v-if="!programa.cod_programa_cidades">
                                                            <div class="col-6">
                                                                <a class="br-button primary" type="button" :href="url + '/transferegov/programas/' + programa.cod_programa + '/create'">Registrar</a>
                                                            </div>
                                                        </div>
                                                        <div v-else>
                                                            <div class="row">
                                                                <div class="col-6">
                                                                    <a class="br-button primary" type="button" :href="url + '/transferegov/programas/' + programa.cod_programa + '/show'"><i class="bi bi-eye mr-3"></i>Exibir</a>
                                                                </div>
                                                                <div class="col-6">
                                                                    <a class="br-button primary" type="button" :href="url + '/transferegov/programas/' + programa.cod_programa + '/editar'"><i class="bi bi-pencil mr-3"></i>Editar</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div v-else>
                                <div class="br-message danger">
                                    <div class="icon"><i class="fas fa-times-circle fa-lg" aria-hidden="true"></i>
                                    </div>
                                    <div class="content" aria-label="Data de início do afastamento inválida. A data não pode ser superior à data atual." role="alert">
                                        <span class="message-title">Nenhum Programa Encontrado</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['url'],
        data() {
            return {
                //FILTROS
                ano: '',
                acoes:'',
                acao:'',
                rps: '',
                rp: '',
                bln_novo_pac:'',
                secretarias: '',
                secretaria: '',
                eixos: '',
                eixo: '',
                subeixos: '',
                subeixo: '',
                modalidades: '',
                modalidade: '',
                grupos:'',
                grupo: '',
                txt_busca: '',
                

                //PROGRAMAS
                programas: '',
                buscando: true
            }
        },
        methods: {
            filtrarProgramas(){
                const filtros = {
                    ano: this.ano,
                    acao: this.acao,
                    rp: this.rp,
                    bln_novo_pac: this.bln_novo_pac,
                    secretaria: this.secretaria,
                    eixo: this.eixo,
                    subeixo: this.subeixo,
                    modalidade: this.modalidade,
                    grupo: this.grupo,
                    txt_busca: this.txt_busca,
                };
                
                console.log(filtros)

                this.buscando = true;
                axios.get(this.url + '/api/transferegov/programas/buscar/',{params: filtros})
                .then(resposta =>{
                    this.programas = resposta.data;
                    this.buscando = false;
                })
                .catch(error => {
                    console.log(error);
                });
            },

            buscarRP(){
                axios.get(this.url + '/api/transferegov/programas/rps').then(resposta => {
                    this.rps = resposta.data;
                }).catch(error => {
                    console.log(error);
                });
            },

            buscarSecretarias(){
                axios.get(this.url + '/api/transferegov/programas/secretarias').then(resposta => {
                    this.secretarias = resposta.data;
                }).catch(error => {
                    console.log(error);
                });
            },

            buscarAcoes(){
                axios.get(this.url + '/api/transferegov/programas/acoes').then(resposta => {
                    this.acoes = resposta.data;
                }).catch(error => {
                    console.log(error);
                });
            },

            buscarEixos(){
                axios.get(this.url + '/api/transferegov/programas/eixos').then(resposta => {
                    this.eixos = resposta.data;
                }).catch(error => {
                    console.log(error);
                });
            },

            buscarSubeixos(){
                axios.get(this.url + '/api/transferegov/programas/subeixos').then(resposta => {
                    this.subeixos = resposta.data;
                }).catch(error => {
                    console.log(error);
                });
                
            },

            buscarModalidades(){
                axios.get(this.url + '/api/transferegov/programas/modalidades').then(resposta => {
                    this.modalidades = resposta.data;
                }).catch(error => {
                    console.log(error);
                });
            },

            buscarGrupos(){
                axios.get(this.url + '/api/transferegov/programas/grupos').then(resposta => {
                    this.grupos = resposta.data;
                }).catch(error => {
                    console.log(error);
                });
            },
            limparFiltros(){
                this.ano = '';
                this.acao ='';
                this.rp = '';
                this.bln_novo_pac ='';
                this.secretaria = '';
                this.eixo = '';
                this.subeixo = '';
                this.modalidade = '';
                this.grupo = '';
                this.txt_busca = '';
            }
        },

        mounted() {
            this.filtrarProgramas();
            this.buscarRP();
            this.buscarSecretarias();
            this.buscarAcoes();
            this.buscarEixos();
            this.buscarSubeixos();
            this.buscarModalidades();
            this.buscarGrupos();
        }
    }
</script>
