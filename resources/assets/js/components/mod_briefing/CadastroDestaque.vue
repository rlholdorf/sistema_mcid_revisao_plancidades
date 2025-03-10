<template>
    <div class="form-group">
        <div class="row mt-3">
            <div class="col-4 mt-3">
                <label for="regiao">Região:</label>
                <select id="regiao" class="form-select br-select" name="regiao" @change="onChangeRegiao"
                    v-model="regiao" required>
                    <option value="" v-text="textoEscolhaRegiao"></option>
                    <option v-for="item in regioes" v-text="item.txt_regiao" :value="item.id" :key="item.id">
                    </option>
                </select>
            </div><!-- div row -->

            <div class="col-4 mt-3">
                <label for="uf">UF:</label>
                <select id="uf" class="form-select br-select" name="uf" @change="onChangeUF" :disabled="regiao == ''"
                    v-model="uf" required>
                    <option value="" v-text="textoEscolhaUF"></option>
                    <option v-for="item in ufs" v-text="item.txt_sigla_uf" :value="item.id" :key="item.id">
                    </option>
                </select>
            </div><!-- div row -->

            <div class="col-4 mt-3">
                <label for="municipio">Município:</label>
                <select id="municipio" class="form-select br-select" name="municipio" :disabled="uf == ''"
                    @change="onChangeMunicipio" v-model="municipio" required>
                    <option value="" v-text="textoEscolhaMunicipio"></option>
                    <option v-for="item in municipios" v-text="item.ds_municipio" :value="item.id" :key="item.id">
                    </option>
                </select>
            </div><!-- div row -->
        </div>

        <div class='row mt-3'>
            <div class="col-4">
                <label for="data">Data do Anúncio:</label>
                <br>
                <input class="input-medium" id="dteAnuncio" name="dteAnuncio" type="date" v-model="dteAnuncio" required>
            </div>
        </div>


        <div class="row mt-3">
            <div class="col col-xs-12 br-textarea">
                <label>Observações:</label>
                <textarea class="input-medium" id="observacoes" name="observacoes" rows="5"
                    v-model="observacoes" required>
                    </textarea>
            </div>
        </div><!-- div row -->

        <div class="row mt-3">
            <div class="col text-right">
                <!-- <div class="p-3 text-right"> -->
                <button class="br-button primary mr-3" type="submit" name="Salvar Edição">Salvar
                </button>


                <button class="br-button danger mr-3" type="button" onclick="javascript:window.history.go(-1)">Voltar
                </button>
                <!-- </div> -->
            </div>
        </div>

    </div>
</template>

<script>
export default {
    props: ['url', 'dados'],
    data() {
        return {

            //----Regiões/UFs/Municípios
            regioes: '',
            regiao: '',
            ufs: '',
            uf: '',
            municipios: '',
            municipio: '',

            //----Data de Anuncio/Observação
            dteAnuncio: '',
            observacoes: '',

            //----Textos de Escolha
            textoEscolhaRegiao: "Escolha a Região:",
            textoEscolhaMunicipio: "Escolha a Região:",
            textoEscolhaUF: "Escolha a Região:",
        }
    },
    methods: {
        onChangeRegiao() {
            this.uf = '';
            this.municipio = '';
            this.buscando = true;
            if (this.regiao != '') {
                axios.get(this.url + '/api/ufs/' + this.regiao).then(resposta => {
                    this.textoEscolhaUF = "Escolha a UF:";
                    this.textoEscolhaMunicipio = "Escolha a UF:";
                    this.buscando = false;
                    this.ufs = resposta.data;
                }).catch(error => {
                    console.log(error);
                });

            } else {
                this.textoEscolhaRegiao = "Escolha a Região:";
                this.textoEscolhaUF = "Escolha a Região:";
                this.textoEscolhaMunicipio = "Escolha a Região:";
                this.buscando = false;
            }
        },
        onChangeUF() {
            this.municipio = '';
            this.buscando = true;
            if (this.uf != '') {
                axios.get(this.url + '/api/municipio/estado/' + this.uf).then(resposta => {
                    this.textoEscolhaMunicipio = "Escolha o Município:";
                    this.buscando = false;
                    this.municipios = resposta.data;
                }).catch(error => {
                    console.log(error);
                });

            } else {
                this.textoEscolhaUF = "Escolha a UF:";
                this.textoEscolhaMunicipio = "Escolha a UF:";
                this.buscando = false;
            }
        },
        onChangeMunicipio() {
            this.buscando = true;
            if (this.municipio != '') {
                axios.get(this.url + '/api/plancidades/tipoPeriodicidades/periodicidade/' + this.periodicidade).then(resposta => {
                    this.textoEscolhaTipoPeriodicidade = "Escolha o tipo de Periodicidade:";
                    this.buscando = false;
                    this.tipoPeriodicidades = resposta.data;
                }).catch(error => {
                    console.log(error);
                });

            } else {
                this.buscando = false;
            }
        },
    },
    mounted() {
        //Executado ao carregar a página

        //Retorna as regiões
        axios.get(this.url + '/api/regioes').then(resposta => {
            this.buscando = false;
            this.regioes = resposta.data;

        }).catch(error => {
            console.log(error);
        });
    }
}
</script>
