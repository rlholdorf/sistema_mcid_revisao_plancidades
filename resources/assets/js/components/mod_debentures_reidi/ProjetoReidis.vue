<template>
    <div class="form-group">
        <div class="row">        
            <div class="col col-xs-12 col-sm-4 br-input">
                <label for="cod_carta_consulta" class="control-label">Código Carta Consulta</label>
                <input id="cod_carta_consulta" 
                    type="text" 
                    class="form-control" 
                    name="cod_carta_consulta" 
                    v-model="cod_carta_consulta" 
                   >
            </div>
            <div class="column col-xs-12 col-md-2">
                <label for="uf">UF</label>           
                <select 
                    id="estado"
                    class="form-select br-select" 
                    name="estado"                   
                    @change="onChangeEstado"
                    v-model="estado"
                    required
                    :disabled="this.dados">
                    <option value="">Escolha um Estado:</option>
                    <option v-for="estado in estados" v-text="estado.txt_sigla_uf" :value="estado.id" :key="estado.id"></option>
                </select>                                  
            </div> 
            
            <div class="column col-xs-12 col-md-6">
                <label for="setor_projeto">Setor de Projeto</label>           
                <select 
                    id="setor_projeto"
                    class="form-select br-select" 
                    name="setor_projeto"                   
                    v-model="setor_projeto"
                    :disabled="this.dados"
                    required>
                    <option value="">Escolha um setor projeto:</option>
                    <option v-for="setor_projeto in setor_projetos" v-text="setor_projeto.txt_setor_projeto" :value="setor_projeto.id" :key="setor_projeto.id"></option>
                </select>                                  
            </div>   
        </div>
        <div class="row">
            <div class="col col-xs-12 col-sm-12 br-input">
                <label for="titular_projeto" class="control-label">Titular do Projeto</label>
                <input id="titular_projeto" 
                    type="text" 
                    class="form-control" 
                    name="titular_projeto" 
                    v-model="titular_projeto" 
                    :disabled="this.dados"
                    required>
            </div>
        </div>
        <div class="row">
            <div class="col col-xs-12 col-sm-12 br-textarea">        
                <label for="txt_nome_projeto" class="control-label">Nome do Projeto</label>
                <textarea class="form-control" 
                        id="txt_nome_projeto" 
                        name="txt_nome_projeto"  
                        v-model="nome_projeto"
                        rows="7" 
                        :disabled="this.dados"
                        required>
                </textarea>
            </div>
       </div>
       <div class="row">
            <div class="col col-xs-12 col-sm-6 br-input">
                <label for="portaria" class="control-label">Número e Ano da Portaria</label>
                <input id="portaria" 
                    type="text" 
                    class="form-control" 
                    name="portaria" 
                    v-model="portaria" 
                    required
                    >
            </div>
            <div class="col col-xs-12 col-sm-6 br-input">
                <label for="data_portaria" class="control-label">Data da Portaria</label>
                <input id="data_portaria" 
                    type="date" 
                    class="form-control" 
                    name="data_portaria" 
                    v-model="data_portaria" 
                    :disabled="this.dados"
                    required>
            </div>
        </div>
        <div class="row">
            <div class="col col-xs-12 col-sm-3 br-input">
                <label for="vlr_investimento_projeto" class="control-label">Valor Investimento do projeto</label>
                <input id="vlr_investimento_projeto" 
                    type="text" 
                    class="form-control" 
                    name="vlr_investimento_projeto" 
                    v-model="vlr_investimento_projeto"
                    required>
            </div>
            <div class="col col-xs-12 col-sm-3 br-input">
                <label for="vlr_projeto_sem_reidi" class="control-label">Valor do projeto sem reidi</label>
                <input id="vlr_projeto_sem_reidi" 
                    type="text" 
                    class="form-control" 
                    name="vlr_projeto_sem_reidi" 
                    v-model="vlr_projeto_sem_reidi" 
                    required>
            </div>
            <div class="col col-xs-12 col-sm-3 br-input">
                <label for="vlr_projeto_com_reidi" class="control-label">Valor do projeto com reidi</label>
                <input id="vlr_projeto_com_reidi" 
                    type="text" 
                    class="form-control" 
                    name="vlr_projeto_com_reidi" 
                    v-model="vlr_projeto_com_reidi" 
                    required>
            </div>
            <div class="col col-xs-12 col-sm-3 br-input">
                <label for="vlr_estimado_beneficio" class="control-label">Valor estimado do beneficio</label>
                <input id="vlr_estimado_beneficio" 
                    type="text" 
                    class="form-control" 
                    name="vlr_estimado_beneficio" 
                    v-model="vlr_estimado_beneficio" 
                    required>
            </div>
        </div>
        
    </div>
</template>

<script>
    export default {
        props:['url','dados'],
        data(){
            return{
                cod_carta_consulta:'',
                estados:'',
                estado:'',
                tipo_projetos:'',
                tipo_projeto:'',
                setor_projetos:'',
                setor_projeto:'',
                nome_projeto:'',
                titular_projeto:'',
                nome_projeto:'',
                portaria:'',
                data_portaria:'',
                vlr_investimento_projeto:'',
                vlr_projeto_com_reidi:'',
                vlr_projeto_sem_reidi:'',
                vlr_estimado_beneficio:'',
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
                       console.log(this.municipios);
                   }).catch(error => {
                       console.log(error);
                   });
                 
               } else {
                   this.buscando = false;
                   this.municipio = '';
                   this.textoEscolhaMunicipio = "Filtre o Estado"
               }            
           },
           
             formatarData(data) {
                if (data) {   
                    const novaData = data.toLocaleDateString('pt-BR');
                    return novaData;
                } else {
                    return '';
                }
            },
            formatarValor(valor,casas) {
                if (valor) {
                    let val = (valor/1).toFixed(casas).replace('.', ',')
                    return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
                } else {
                    return '0.00';
                }
            }
        } ,
        mounted() {
            //console.log(this.form._token);
            axios.get(this.url + '/api/ufs').then(resposta => {
                //console.log(resposta.data);
                this.estados = resposta.data; 
                }).catch(erro => {
                    console.log(erro);
                })
            

            //tipo projeto
            axios.get(this.url + '/api/debentures/tipo_projeto').then(resposta => {
                //console.log(resposta.data);
                this.tipo_projetos = resposta.data; 
                }).catch(erro => {
                    console.log(erro);
                })

            //setor projeto
            axios.get(this.url + '/api/debentures/setor_projeto').then(resposta => {
                //console.log(resposta.data);
                this.setor_projetos = resposta.data; 
                }).catch(erro => {
                    console.log(erro);
                })

                if(this.dados){
                    console.log(this.dados.sg_uf);
                    this.cod_carta_consulta = this.dados.cod_carta_consulta;
                    this.estado = this.dados.uf_id;
                    this.setor_projeto = this.dados.setor_projeto_id;
                    this.nome_projeto = this.dados.txt_nome_projeto;
                    this.titular_projeto = this.dados.txt_titular_projeto;
                    this.nome_projeto = this.dados.txt_nome_projeto;
                    this.portaria = this.dados.num_ano_portaria;
                    this.data_portaria = this.dados.dte_portaria;
                    this.vlr_investimento_projeto = this.dados.vlr_investimento_projeto;
                    this.vlr_projeto_com_reidi = this.dados.vlr_projeto_com_reidi;
                    this.vlr_projeto_sem_reidi = this.dados.vlr_projeto_sem_reidi;
                    this.vlr_estimado_beneficio = this.dados.vlr_estimado_beneficio;
                    
              
                }
            }

        
    }
</script>
