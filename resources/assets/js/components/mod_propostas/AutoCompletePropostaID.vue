<template>
 <div class="autocomplete">
    <div class="input-group">
        <input type="text" name="txt_num_apf" placeholder="Ex.: 1254863 (sem os zeros a esquerda e sem caracteres especiais)" 
            v-model="query" v-on:keyup="autoComplete" class="form-control" autocomplete="off" required>
        <div class="input-group-append">
            <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
        </div>      
    </div>          
  <div class="panel-footer" v-if="results.length">

   <ul class="list-group autocomplete-results"
      id="autocomplete-results"
      v-show="isOpen">
    <li class="list-group-item autocomplete-result" 
    
        @click="setResult(result)"
        v-for="result in results" required>{{ result.num_apf }}</li>
   </ul>
  </div>
 </div>
</template>


<script>
    export default {
        props:['url'],
        data(){
            return{
                isOpen: true,
                query: '',
                results: []
            }        
        },
        methods:{
            autoComplete() {
                this.results = [];
                if(this.query.length > 2){
                    axios.get(this.url + '/api/proposta/search/' + this.query).then(response => {
                        this.results = response.data;
                    }).catch(error => {
                        console.log(error);
                    });        
                }
            },
            setResult(result) {
                this.query = result.num_apf;       
                 this.isOpen = false;
            }    
        }
    }
</script>
