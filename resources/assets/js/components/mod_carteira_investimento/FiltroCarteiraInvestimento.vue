<template>
  <div class="form-group">
    <div class="row" v-if="!(estado || municipio)">
      <div class="column col-xs-12 col-md-6">
        <label for="codigo_base">Código da Base</label>
        <select
          id="codigo_base"
          class="form-select br-select"
          name="codigo_base"
          v-model="codigo_base"
        >
          <option value="">Escolha um Código:</option>
          <option
            v-for="cod in codigo_consulta"
            v-text="cod.txt_codigo"
            :value="cod.codigo"
            :key="cod.codigo"
          ></option>
        </select>
      </div>
      <div class="column col-xs-12 col-md-6">
        <div class="br-input">
          <label for="codigo">Código Contrato</label>
          <input
            id="codigo"
            name="codigo"
            type="text"
            v-model="codigo"
            placeholder="Digite o Código da Base"
          />
        </div>
      </div>
    </div>

    <span class="br-divider my-3"></span>
    <div class="row" v-if="!codigo_base">
      <div class="column col-xs-12 col-md-2">
        <label for="uf">UF</label>
        <select
          id="estado"
          class="form-select br-select"
          name="estado"
          @change="onChangeEstado"
          v-model="estado"
        >
          <option value="">Escolha um Estado:</option>
          <option
            v-for="estado in estados"
            v-text="estado.txt_sigla_uf"
            :value="estado.id"
            :key="estado.id"
          ></option>
        </select>
      </div>
      <div class="column col-xs-12 col-md-4">
        <!-- municipio -->
        <label for="municipio">Município</label>
        <select
          id="municipio"
          class="form-select br-select"
          name="municipio"
          @change="onChangeMunicipio"
          :disabled="estado == '' || buscando"
          v-model="municipio"
        >
          <option value="" v-text="textoEscolhaMunicipio"></option>
          <option
            v-for="municipio in municipios"
            v-text="municipio.ds_municipio"
            :value="municipio.id"
            :key="municipio.id"
          ></option>
        </select>
      </div>
      <div class="column col-xs-12 col-md-2">
        <label for="bln_carteira_mcid">Carteira MCID?</label>
        <select
          id="bln_carteira_mcid"
          class="form-select br-select"
          name="bln_carteira_mcid"
          v-model="bln_carteira_mcid"
        >
          <option value="">Escolha uma opção:</option>
          <option value="true">Sim</option>
          <option value="false">Não</option>
        </select>
      </div>
      <div class="column col-xs-12 col-md-2">
        <label for="bln_carteira_ativa_mcid">Carteira MCID Ativa?</label>
        <select
          id="bln_carteira_ativa_mcid"
          class="form-select br-select"
          name="bln_carteira_ativa_mcid"
          v-model="bln_carteira_ativa_mcid"
        >
          <option value="">Escolha uma opção:</option>
          <option value="true">Sim</option>
          <option value="false">Não</option>
        </select>
      </div>
      <div class="column col-xs-12 col-md-2">
        <label for="bln_carteira_andamento">Em andamento?</label>
        <select
          id="bln_carteira_andamento"
          class="form-select br-select"
          name="bln_carteira_andamento"
          v-model="bln_carteira_andamento"
        >
          <option value="">Escolha uma opção:</option>
          <option value="true">Sim</option>
          <option value="false">Não</option>
        </select>
      </div>
    </div>

    <div class="row" v-if="!codigo_base">
      <div class="column col-xs-12 col-md-3">
        <label for="situacao_contrato">Situação Contrato</label>
        <select
          id="situacao_contrato"
          class="form-select br-select"
          name="situacao_contrato"
          v-model="situacao_contrato"
        >
          <option value="">Escolha uma Situação</option>
          <option
            v-for="situacao_contrato in situacao_contratos"
            v-text="situacao_contrato.dsc_situacao_contrato_mcid"
            :value="situacao_contrato.cod_situacao_contrato_mcid"
            :key="situacao_contrato.cod_situacao_contrato_mcid"
          ></option>
        </select>
      </div>
      <div class="column col-xs-12 col-md-3">
        <label for="situacao_objeto">Situação Objeto</label>
        <select
          id="situacao_objeto"
          class="form-select br-select"
          name="situacao_objeto"
          v-model="situacao_objeto"
        >
          <option value="">Escolha uma Situação</option>
          <option
            v-for="situacao_objeto in situacao_objetos"
            v-text="situacao_objeto.dsc_situacao_objeto_mcid"
            :value="situacao_objeto.cod_situacao_objeto_mcid"
            :key="situacao_objeto.cod_situacao_objeto_mcid"
          ></option>
        </select>
      </div>
      <div class="column col-xs-12 col-md-3">
        <label for="tipo_instrumento">Tipo de Instrumento</label>
        <select
          id="tipo_instrumento"
          class="form-select br-select"
          name="tipo_instrumento"
          v-model="tipo_instrumento"
        >
          <option value="">Escolha um Tipo de Instrumento</option>
          <option
            v-for="tipo_instrumento in tipo_instrumentos"
            v-text="tipo_instrumento.txt_tipo_instrumento"
            :value="tipo_instrumento.cod_tipo_instrumento"
            :key="tipo_instrumento.cod_tipo_instrumento"
          ></option>
        </select>
      </div>
      <div class="column col-xs-12 col-md-3">
        <label for="secretaria">Secretaria</label>
        <select
          id="secretaria"
          class="form-select br-select"
          name="secretaria"
          v-model="secretaria"
        >
          <option value="">Escolha uma Secretaria</option>
          <option
            v-for="item in secretarias"
            v-text="item.txt_sigla_secretaria"
            :value="item.id"
            :key="item.id"
          ></option>
        </select>
      </div>
    </div>

    <div class="row" v-if="!codigo_base">
      
      <div class="column col-xs-12 col-md-2">
        <label for="origem">Origem</label>
        <select
          id="origem"
          class="form-select br-select"
          name="origem"
          v-model="origem"
        >
          <option value="">Escolha uma Origem</option>
          <option
            v-for="origem in origens"
            v-text="origem.txt_origem"
            :value="origem.cod_origem"
            :key="origem.cod_origem"
          ></option>
        </select>
      </div>
      <div class="column col-xs-12 col-md-2">
        <label for="fonte">Fonte</label>
        <select
          id="fonte"
          class="form-select br-select"
          name="fonte"
          @change="onChangeFonte"
          v-model="fonte"
        >
          <option value="">Escolha uma Fonte</option>
          <option
            v-for="fonte in fontes"
            v-text="fonte.dsc_fonte"
            :value="fonte.cod_fonte"
            :key="fonte.cod_fonte"
          ></option>
        </select>
      </div>
      <div class="column col-xs-12 col-md-2">
        <label for="sub_fonte">Subfonte</label>
        <select
          id="sub_fonte"
          class="form-select br-select"
          name="sub_fonte"
          :disabled="fonte == ''"
          v-model="sub_fonte"
        >
          <option value="" v-text="textoEscolhaSubfonte"></option>
          <option
            v-for="sub_fonte in sub_fontes"
            v-text="sub_fonte.dsc_sub_fonte"
            :value="sub_fonte.cod_sub_fonte"
            :key="sub_fonte.cod_sub_fonte"
          ></option>
        </select>
      </div>
      <div class="column col-xs-12 col-md-2">
        <label for="fase_pac">Fases PAC</label>
        <select
          id="fase_pac"
          class="form-select br-select"
          name="fase_pac"
          v-model="fase_pac"
        >
          <option value="">Escolha uma fase_pac</option>
          <option
            v-for="fase_pac in fases_pac"
            v-text="fase_pac.dsc_fase"
            :value="fase_pac.cod_fase"
            :key="fase_pac.cod_fase"
          ></option>
        </select>
      </div>
    </div>
    <div class="p-3 text-right">
      <button
        class="br-button primary mr-3"
        type="submit"
        :disabled="
          estado == '' &&
            municipio == '' &&
            codigo_base == '' &&
            bln_carteira_mcid == '' &&
            bln_carteira_ativa_mcid == '' &&
            bln_carteira_andamento == '' &&
            situacao_contrato == '' &&
            situacao_objeto == '' &&
            origem == '' &&
            secretaria == '' &&
            tipo_instrumento == '' &&
            sub_fonte == '' &&
            fase_pac == ''
        "
      >
        Pesquisar
      </button>
      <button
        class="br-button danger mr-3"
        type="button"
        onclick="javascript:window.history.go(-1)"
      >
        Voltar
      </button>
    </div>
  </div>
</template>

<script>
export default {
  props: ["url", "requermunicipio", "requeruf", "complementonomelabelmun"],
  data() {
    return {
      codigo: "",
      estados: "",
      estado: "",
      municipios: "",
      municipio: "",
      textoEscolhaMunicipio: "Filtre o Estado",
      textoEscolhaSubfonte: "Filtre a fonte",
      andamentos: "",
      andamento: "",
      codigo_base: "",
      codigo_consulta: [
        { codigo: "cod_tci", txt_codigo: "Código TCI" },
        { codigo: "cod_saci", txt_codigo: "Código SACI" },
        { codigo: "cod_contrato", txt_codigo: "Código Contrato" },
      ],
      bln_carteira_mcid: "",
      bln_carteira_ativa_mcid: "",
      bln_carteira_andamento: "",
      situacao_contratos: "",
      situacao_contrato: "",
      situacao_objetos: "",
      situacao_objeto: "",
      fontes: "",
      fonte: "",
      sub_fontes: "",
      sub_fonte: "",
      origens: "",
      origem: "",  
      tipo_instrumentos: "",
      tipo_instrumento: "",
      secretarias: "",
      secretaria: "",
      fase_pac: "",
      fases_pac: "",
    };
  },
  methods: {
    onChangeEstado() {
      this.textoEscolhaMunicipio = "Buscando...";
      this.municipio = "";
      this.buscando = true;
      if (this.estado != "") {
        //busca dados no banco de dados para carregar no componente
        axios
          .get(this.url + "/api/municipios/" + this.estado)
          .then((resposta) => {
            this.textoEscolhaMunicipio = "Escolha um municipio:";
            this.buscando = false;
            this.municipios = resposta.data;
            console.log(this.municipios);
          })
          .catch((error) => {
            console.log(error);
          });
      } else {
        this.buscando = false;
        this.municipio = "";
        this.textoEscolhaMunicipio = "Filtre o Estado";
      }
    },
    onChangeMunicipio() {
      this.textoEscolhaEnte = "Buscando...";
      this.entepublico = "";
      this.buscandoEnte = true;
      if (this.municipio != "") {
        //busca dados no banco de dados para carregar no componente
        axios
          .get(this.url + "/api/bnde/municipios/" + this.municipio)
          .then((resposta) => {
            this.textoEscolhaEnte = "Escolha um municipio:";
            this.buscandoEnte = false;
            this.entespublicos = resposta.data;
          })
          .catch((error) => {
            console.log(error);
          });
      } else {
        this.buscandoEnte = false;
        this.entepublico = "";
        this.textoEscolhaEnte = "Filtre o Município";
      }
    },
    onChangeFonte() {
      this.textoEscolhaSubfonte = "Buscando...";
      this.sub_fonte = "";
      if (this.fonte != "") {
        //busca dados no banco de dados para carregar no componente
        axios
          .get(this.url + "/api/carteira_investimento/sub_fonte/" + this.fonte)
          .then((resposta) => {
            this.textoEscolhaSubfonte = "Escolha uma subfonte:";
            this.sub_fontes = resposta.data;
          })
          .catch((error) => {
            console.log(error);
          });
      } else {
        this.sub_fonte = "";
        this.textoEscolhaSubfonte = "Filtre uma fonte";
      }
    },
  },
  mounted() {
    //console.log(this.form._token);
    axios
      .get(this.url + "/api/ufs")
      .then((resposta) => {
        //console.log(resposta.data);
        this.estados = resposta.data;
      })
      .catch((erro) => {
        console.log(erro);
      });

    axios
      .get(this.url + "/api/carteira_investimento/situacao_contrato")
      .then((resposta) => {
        //console.log(resposta.data);
        this.situacao_contratos = resposta.data;
      })
      .catch((erro) => {
        console.log(erro);
      });

    axios
      .get(this.url + "/api/carteira_investimento/situacao_objeto")
      .then((resposta) => {
        //console.log(resposta.data);
        this.situacao_objetos = resposta.data;
      })
      .catch((erro) => {
        console.log(erro);
      });

    axios
      .get(this.url + "/api/carteira_investimento/origem")
      .then((resposta) => {
        //console.log(resposta.data);
        this.origens = resposta.data;
      })
      .catch((erro) => {
        console.log(erro);
      });

    axios
      .get(this.url + "/api/carteira_investimento/fonte")
      .then((resposta) => {
        //console.log(resposta.data);
        this.fontes = resposta.data;
      })
      .catch((erro) => {
        console.log(erro);
      });

      axios
      .get(this.url + "/api/carteira_investimento/tipo_instrumento")
      .then((resposta) => {
        //console.log(resposta.data);
        this.tipo_instrumentos = resposta.data;
      })
      .catch((erro) => {
        console.log(erro);
      });

      axios
      .get(this.url + "/api/carteira_investimento/secretarias")
      .then((resposta) => {
        //console.log(resposta.data);
        this.secretarias = resposta.data;        
      })
      .catch((erro) => {
        console.log(erro);
      });

      axios
      .get(this.url + "/api/pac/fases")
      .then((resposta) => {
        //console.log(resposta.data);
        this.fases_pac = resposta.data;        
      })
      .catch((erro) => {
        console.log(erro);
      });
  },
};
</script>
