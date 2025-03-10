<template>
    <div class="">
        <div class="row mt-3">
            <div class="d-flex">
                <!-- coluna 1 -->
                <div class="column col-3">
                    <div class="row mt-3">
                        <div class="column col-12">
                            <label>Nome do Programa</label>
                            <p>{{ programaTransferegov.nom_programa }}</p>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="column col-12">
                            <div class="row">
                                <div class="column col">
                                    <label>Número do Programa</label>
                                    <p>{{ programaTransferegov . cod_programa }}</p>
                                    <input name="cod_programa" id="cod_programa" type="hidden"
                                        :value="programaTransferegov.cod_programa">
                                </div>

                                <div class="column col">
                                    <label>Ação Orçamentária</label>
                                    <p>{{ programaTransferegov.num_acao_orcamentaria }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="column col-12">
                            <div class="row">
                                <div class="column col">
                                    <label>Ano</label>
                                    <p>{{ programaTransferegov.num_ano_disponiblizacao }}</p>
                                </div>

                                <div class="column col">
                                    <label>Situação</label>
                                    <p>{{ programaTransferegov.dsc_sit_programa }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <span class="br-divider vertical mx-3"></span>

                <!-- coluna 2 -->
                <div class="column col-9">
                    <div class="row mt-3">
                        <div class="column col-4">
                            <label>Ações</label>
                            <select class="form-select br-select" name="cod_acao" id="cod_acao" v-model="acao" required>
                                <option value="">Escolha uma opção:</option>
                                <option v-for="item in acoes" v-text="item.cod_acao_governo" :key="item.cod_acao_governo"
                                    :value="item.cod_acao_governo"></option>
                            </select>
                        </div>

                        <div class="column col-4">
                            <label for="rp">Resultado Primário</label>
                            <select class="form-select br-select" name="rp" id="rp" v-model="rp" required>
                                <option value="">Escolha uma opção:</option>
                                <option v-for="item in rps" v-text="item.txt_rp" :key="item.cod_resultado_primario"
                                    :value="item.cod_resultado_primario"></option>
                            </select>
                        </div>

                        <div class="column col-4">
                            <label>Novo PAC</label>
                            <select class="form-select br-select" name="bln_novo_pac" id="bln_novo_pac" v-model="bln_novo_pac" @change="onChangeNovoPac" required>
                                <option value="">Escolha uma opção:</option>
                                <option :value="true">Sim</option>
                                <option :value="false">Não</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="column col-12">
                            <label for="secretaria">Secretaria</label>
                            <select class="form-select br-select" name="secretaria" id="secretaria" v-model="secretaria" required>
                                <option value="">Escolha uma opção:</option>
                                <option v-for="item in secretarias"
                                    v-text="item.txt_sigla_secretaria + ' - ' + item.txt_nome_secretaria"
                                    :key="item.id" :value="item.id"></option>
                            </select>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="column col-6">
                            <label for="eixo">Eixo</label>
                            <select class="form-select br-select" name="eixo" id="eixo" v-model="eixo"
                                @change="onChangeEixo" :disabled="!this.bln_novo_pac" required>
                                <option value="">Escolha uma opção:</option>
                                <option v-for="item in eixos" v-text="item.txt_eixo" :key="item.cod_eixo"
                                    :value="item.cod_eixo"></option>
                            </select>
                        </div>

                        <div class="column col-6">
                            <label for="subeixo">Sub-eixo</label>
                            <select class="form-select br-select" name="subeixo" id="subeixo" v-model="subeixo"
                                :disabled="this.eixo == ''" @change="onChangeSubeixo" required>
                                <option value="">Escolha uma opção:</option>
                                <option v-for="item in subeixos" v-text="item.txt_subeixo" :key="item.cod_subeixo"
                                    :value="item.cod_subeixo"></option>
                            </select>
                        </div>
                    </div>

                    <div class="row mt-3">
                        
                        <div class="column col-6">
                            <label>Modalidade</label>
                            <select class="form-select br-select" name="modalidade" id="modalidade" v-model="modalidade"
                                :disabled="this.subeixo == ''" required>
                                <option value="">Escolha uma opção:</option>
                                <option v-for="item in modalidades" v-text="item.txt_modalidade" :key="item.cod_modalidade"
                                    :value="item.cod_modalidade"></option>
                            </select>
                        </div>

                        <div class="column col-6">
                            <label>Grupo Modalidade</label>
                            <select class="form-select br-select" name="grupo" id="grupo" v-model="grupo"
                                :disabled="this.modalidade == ''" required>
                                <option value="">Escolha uma opção:</option>
                                <option v-for="item in grupos" v-text="item.txt_grupo_modalidade" :key="item.cod_grupo_modalidade"
                                    :value="item.cod_grupo_modalidade"></option>
                            </select>
                        </div>
                    </div>

                    
                </div>
            </div>
        </div>

        <div class="row">
            <div class="column">
                <div class="p-3 text-right">
                    <button class="br-button primary mr-3" type="submit">Salvar
                    </button>

                    <button class="br-button danger mr-3" type="button"
                        onclick="javascript:window.history.go(-1)">Voltar
                    </button>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
    export default {
        props: ['url', 'programaTransferegov', 'programaCidades'],
        data() {
            return {
                //Eixos
                eixos: '',
                eixo: '',
                subeixos: '',
                subeixo: '',
                modalidades: '',
                modalidade: '',
                grupos: '',
                grupo: '',

                //Resto
                secretarias: '',
                secretaria: '',
                rps: '',
                rp: '',
                acoes: '',
                acao: '',
                bln_novo_pac:'',
            }
        },
        methods: {
            onChangeEixo() {
                this.subeixo = '';
                this.modalidade = '';

                if (this.eixo != '') {
                    axios.get(this.url + '/api/transferegov/programas/subeixos/', {params: {eixo: this.eixo}}).then(resposta => {
                        this.subeixos = resposta.data;
                    }).catch(error => {
                        console.log(error);
                    });
                }
                

            },
            onChangeSubeixo() {
                this.modalidade = '';

                if (this.subeixo != '') {
                    axios.get(this.url + '/api/transferegov/programas/modalidades/', {params: {subeixo: this.subeixo}}).then(resposta => {
                        this.modalidades = resposta.data;
                    }).catch(error => {
                        console.log(error);
                    });
                }

            },

            onChangeNovoPac(){
                this.eixo = '';
                this.modalidade='';
                this.onChangeEixo();
            },
        },


        mounted() {
            
            
            axios.get(this.url + '/api/transferegov/programas/secretarias').then(resposta => {
                this.secretarias = resposta.data;
            }).catch(error => {
                console.log(error);
            });


            axios.get(this.url + '/api/transferegov/programas/rps').then(resposta => {
                this.rps = resposta.data;
            }).catch(error => {
                console.log(error);
            });


            axios.get(this.url + '/api/transferegov/programas/eixos').then(resposta => {
                this.eixos = resposta.data;
            }).catch(error => {
                console.log(error);
            });


            axios.get(this.url + '/api/transferegov/programas/acoes').then(resposta => {
                this.acoes = resposta.data;
            }).catch(error => {
                console.log(error);
            });

            axios.get(this.url + '/api/transferegov/programas/grupos').then(resposta => {
                this.grupos = resposta.data;
            }).catch(error => {
                console.log(error);
            });

            if(this.programaCidades){
                this.secretaria = this.programaCidades.id_secretaria;
                this.rp = this.programaCidades.cod_resultado_primario;
                this.eixo = this.programaCidades.cod_eixo ? this.programaCidades.cod_eixo:'';
                this.onChangeEixo();
                this.subeixo = this.programaCidades.cod_subeixo ? this.programaCidades.cod_subeixo:'';
                this.onChangeSubeixo();
                this.modalidade = this.programaCidades.cod_modalidade ? this.programaCidades.cod_modalidade:'';
                this.acao = this.programaCidades.cod_acao;
                this.bln_novo_pac = this.programaCidades.bln_novo_pac;   
                this.grupo = this.programaCidades.cod_grupo_modalidade ? this.programaCidades.cod_grupo_modalidade:'';
            }
        }
    }
</script>
