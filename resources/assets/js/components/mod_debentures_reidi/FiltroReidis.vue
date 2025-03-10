<template>
    <div class="form-group">
        <div class="row"  >        
            <div class="column col-xs-12 col-md-6">
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
            
            <div class="column col-xs-12 col-md-6">
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
                setor_projetos:'',
                setor_projeto:'',
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
            axios.get(this.url + '/api/reidis/ufs').then(resposta => {
                //console.log(resposta.data);
                this.estados = resposta.data;
                this.estado = '';
                this.municipio = '';                
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
