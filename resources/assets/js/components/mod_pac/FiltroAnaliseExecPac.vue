<template>
    <div class="form-group">
       <div class="row">               
           <div class="col col-xs-12 col-sm-2 br-input">
               <label for="uf">UF</label>           
               <select 
                   id="cod_uf"
                   class="form-select br-select" 
                   name="cod_uf" 
                   @change="onChangeEstado"
                   v-model="estado"  
                        
               >
                   <option value="">Escolha uma UF:</option>
                   <option v-for="estado in estados" 
                       v-text="estado.txt_sigla_uf" 
                       :value="estado.txt_sigla_uf" :key="estado.txt_sigla_uf">
                   </option>
               </select>
           </div>
           <div class="column col-xs-12 col-sm-4 ">
            <!-- municipio -->    
                <label for="municipio">Município Principal</label>
                <select 
                    id="municipio"
                    class="form-select br-select" 
                    name="municipio"
                    :disabled="estado == '' || buscando"
                    v-model="municipio"
                    >
                    <option value="" v-text="textoEscolhaMunicipio"></option>
                    <option v-for="municipio in municipios" v-text="municipio.ds_municipio" :value="municipio.ds_municipio" :key="municipio.ds_municipio"></option>
                </select>    
            </div>   
            <div class="col col-xs-12 col-sm-6">
                <label for="fase_novo_pac">Fase</label>           
                <select 
                    id="fase_novo_pac"
                    class="form-select br-select" 
                    name="fase_novo_pac"  
                    v-model="fase_novo_pac"  
                >
                    <option value="">Escolha uma Fase:</option>
                    <option v-for="fase in fases_novo_pac" 
                        v-text="fase.dsc_fase" 
                        :value="fase.dsc_fase" :key="fase.dsc_fase">
                    </option>
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

            fases_novo_pac:'',
            fase_novo_pac:'',

               estado: '',
               estados: '',
               municipio:'',
               municipios:'',
                textoEscolhaMunicipio: 'Filtre o Estado',
             }
       }, 
       methods: {
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
                       
                   }).catch(error => {
                       console.log(error);
                   });                  

                  
                 
               } else {
                   this.buscando = false;
                   this.municipio = '';
                   this.textoEscolhaMunicipio = "Filtre o Estado"
                   this.textoEscolhaEmpreendimento = "Filtre o Estado"
               } 
           }
       },        
       mounted() {
           console.log('Component mounted.')

             //retorna as fontes
           axios.get(this.url + '/api/pac/fases').then(resposta => {                
               this.fases_novo_pac = resposta.data;
              
               console.log(this.fases_novo_pac);
           }).catch(erro => {
               console.log(erro);
           }); 


             //retorna as secretarias
             axios.get(this.url + '/api/sistema/secretarias').then(resposta => {
               
               this.secretarias = resposta.data.filter(item => item.id >= 11);

           }).catch(erro => {
               console.log(erro);
           }); 


            //retorna as estados
            axios.get(this.url + '/api/estados').then(resposta => {                
               this.estados = resposta.data;
           }).catch(erro => {
               console.log(erro);
           }); 

           

           //retorna as fontes
           axios.get(this.url + '/api/carteira_investimento/fonte').then(resposta => {                
               this.fontes = resposta.data;
           }).catch(erro => {
               console.log(erro);
           }); 

           axios.get(this.url + '/api/carteira_investimento/origem').then(resposta => {
                //console.log(resposta.data);
                this.origens = resposta.data;
                this.origem = '';
                }).catch(erro => {
                    console.log(erro);
                })

       }
   }
</script>
