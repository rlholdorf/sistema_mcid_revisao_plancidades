<template>
    <div class="form-group">
        <div class="row"  >        
            <div class="column col-xs-12 col-md-2">
                <label for="uf">UF</label>           
                <select 
                    id="estado"
                    class="form-select br-select" 
                    name="estado"                   
                    @change="onChangeEstado"
                    v-model="estado">
                    <option value="">Escolha um Estado:</option>
                    <option v-for="estado in estados" v-text="estado.sg_uf" :value="estado.sg_uf" :key="estado.sg_uf"></option>
                </select>                                  
            </div> 
            <div class="column col-xs-12 col-md-4">
                <label for="tipo_projeto">Tipo de Projeto</label>           
                <select 
                    id="tipo_projeto"
                    class="form-select br-select" 
                    name="tipo_projeto"                   
                    v-model="tipo_projeto">
                    <option value="">Escolha um tipo projeto:</option>
                    <option v-for="tipo_projeto in tipo_projetos" v-text="tipo_projeto.txt_tipo_projeto" :value="tipo_projeto.id" :key="tipo_projeto.id"></option>
                </select>                                  
            </div>   
            <div class="column col-xs-12 col-md-4">
                <label for="setor_projeto">Setor de Projeto</label>           
                <select 
                    id="setor_projeto"
                    class="form-select br-select" 
                    name="setor_projeto"                   
                    v-model="setor_projeto">
                    <option value="">Escolha um setor projeto:</option>
                    <option v-for="setor_projeto in setor_projetos" v-text="setor_projeto.txt_setor_projeto" :value="setor_projeto.id" :key="setor_projeto.id"></option>
                </select>                                  
            </div>  
            <div class="column col-xs-12 col-md-2">
                <label for="bln_contabilizar_valores">Contabilizar Valores</label>           
                <select 
                    id="bln_contabilizar_valores"
                    class="form-select br-select" 
                    name="bln_contabilizar_valores"  
                    v-model="bln_contabilizar_valores"
                    >
                    <option value="">Escolha uma opção:</option>
                    <option value="1">Sim</option>
                    <option value="0">Não</option>
                    
                </select>                                  
            </div>  
        </div>
    </div>
</template>

<script>
    export default {
        props:['url'],
        data(){
            return{
                estados:'',
                estado:'',
                tipo_projetos:'',
                tipo_projeto:'',
                setor_projetos:'',
                setor_projeto:'',
                bln_contabilizar_valores:''
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
           }
        } ,
        mounted() {
            //console.log(this.form._token);
            axios.get(this.url + '/api/debentures/ufs').then(resposta => {
                //console.log(resposta.data);
                this.estados = resposta.data;
                this.estado = '';
                this.municipio = '';                
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
            }

        
    }
</script>
