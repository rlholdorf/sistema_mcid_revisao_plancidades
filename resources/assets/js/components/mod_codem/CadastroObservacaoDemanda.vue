<template>
<div>
   
        <div class="form-group">
            
            <div class="br-textarea">
                <label for="txt_observacao" class="control-label">Observação</label>
                <textarea class="form-control" 
                   id="txt_observacao" 
                   name="txt_observacao"  
                   v-model="dscObservacao"
                   rows="10" required></textarea>
           </div>

        </div>  
       
    
</div>
</template>

<script>
    export default {
        props:['url','dados'],
        data(){
            return{
                dscObservacao: '',
            }        
        },
       
        methods:{
            
            
        },
        mounted() {

               
        }
    }
</script>
