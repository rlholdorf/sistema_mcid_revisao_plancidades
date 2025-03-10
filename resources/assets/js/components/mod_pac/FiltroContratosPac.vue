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
                       :value="estado.id" :key="estado.id">
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
                    <option v-for="municipio in municipios" v-text="municipio.ds_municipio" :value="municipio.cod_ibge_7_dig" :key="municipio.cod_ibge_7_dig"></option>
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
                        :value="fase.cod_fase" :key="fase.cod_fase">
                    </option>
                </select>
            </div>
        </div>
        <div class="row">

      
           <div class="col col-xs-12 col-sm-3">
               <label for="secretaria">Secretaria</label>           
               <select 
                   id="cod_secretaria"
                   class="form-select br-select" 
                   name="cod_secretaria"  
                   v-model="secretaria"                   
                    
               >
                   <option value="">Escolha uma Secretaria:</option>
                   <option v-for="secretaria in secretarias" 
                       v-text="secretaria.txt_sigla_secretaria" 
                       :value="secretaria.txt_sigla_secretaria" :key="secretaria.txt_sigla_secretaria">
                   </option>
               </select>
           </div>
     
           
           <div class="column col-xs-12 col-md-3">
            <label for="fonte">Fonte</label>                
            <select 
                id="fonte"
                class="form-select br-select" 
                name="fonte"
                 @change="onChangeFonte"
                v-model="fonte">
                <option value="">Escolha uma Fonte</option>
                <option v-for="fonte in fontes" v-text="fonte.txt_fonte" :value="fonte.cod_fonte" :key="fonte.cod_fonte"></option>
            </select>    
        </div>
        <div class="column col-xs-12 col-md-3">
            <label for="sub_fonte">Subfonte</label>                
            <select 
                id="sub_fonte"
                class="form-select br-select" 
                name="sub_fonte"
                :disabled="fonte == ''"
                v-model="sub_fonte">
                <option value="" v-text="textoEscolhaSubfonte"></option>
                <option v-for="sub_fonte in sub_fontes" v-text="sub_fonte.dsc_sub_fonte" :value="sub_fonte.cod_sub_fonte" :key="sub_fonte.cod_sub_fonte"></option>
            </select>    
        </div>
        <div class="column col-xs-12 col-md-3">
            <label for="origem">Origem</label>                
            <select 
                id="origem"
                class="form-select br-select" 
                name="origem"
                v-model="origem">
                <option value="">Escolha uma Origem</option>
                <option v-for="origem in origens" v-text="origem.txt_origem" :value="origem.cod_origem" :key="origem.cod_origem"></option>
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
                       
               fontes:'',
                fonte:'',
                sub_fontes:'',
                sub_fonte:'',
               secretaria: '',
               secretarias: '',             
               textoEscolhaArea: 'Filtre a Secretaria',              
               textoEscolhaSubfonte: "Filtre a fonte",
                textoEscolhaMunicipio: 'Filtre o Estado',
                origens:'',
                origem:'',
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
           },
           onChangeFonte() {
                this.textoEscolhaSubfonte = "Buscando...";
                this.sub_fonte = '';                
                if(this.fonte != '') {
                    //busca dados no banco de dados para carregar no componente
                    axios.get(this.url + '/api/carteira_investimento/sub_fonte/' + this.fonte).then(resposta => {
                        this.textoEscolhaSubfonte = "Escolha uma subfonte:";
                        this.sub_fontes = resposta.data;                       
                    }).catch(error => {
                        console.log(error);
                    });
                  
                } else {
                    
                    this.sub_fonte = '';
                    this.textoEscolhaSubfonte = "Filtre uma fonte"
                }            
                
            }
          
           

       },        
       mounted() {
           console.log('Component mounted.')

             //retorna as fontes
           axios.get(this.url + '/api/pac/fases').then(resposta => {                
               this.fases_novo_pac = resposta.data.filter(fase => fase.cod_fase >= 9);
              
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
