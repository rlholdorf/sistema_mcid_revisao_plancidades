<template>
<div>
   
        <div class="form-group">
            <div class="row">
                <div class="col col-xs-12 col-sm-6">
                    <label for="tipoDocumento">Tipo de documento</label>           
                    <select 
                        id="tipoDocumento"
                        class="form-select br-select" 
                        name="tipoDocumento"
                        required
                        v-model="tipoDocumento">
                        <option value="">Escolha uma Tipo de documento:</option>
                        <option v-for="tipoDocumento in tipoDocumentos" v-text="tipoDocumento.txt_tipo_documento" :value="tipoDocumento.id" :key="tipoDocumento.id"></option>
                    </select>                                  
                </div> 
                <div class="col col-xs-12 col-sm-6 br-input">
                    <label for="num_sei" class="control-label">Número documento SEI</label>
                    <input id="num_sei" type="text" class="form-control" name="num_sei" v-model="num_sei" required :disabled="this.dados">
                </div>                                          
            </div><!-- fim row --> 
            
            <div class="row">
                
                <div class="col col-xs-12 col-sm-12 br-input">
                    <label for="txt_link_documento_sei" class="control-label">Link documento SEI</label>
                    <input id="txt_link_documento_sei" type="text" class="form-control" name="txt_link_documento_sei" :value="this.txt_link_documento_sei" :disabled="this.dados">
                </div>                                          
            </div><!-- fim row --> 
            <div class="br-textarea">
                <label for="dsc_documento" class="control-label">Descrição do documento</label>
                <textarea class="form-control" 
                   id="txt_descricao_documento" 
                   name="txt_descricao_documento"  
                   v-model="dscDocumento"
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
                num_sei:'',
                tipoDocumentos: '',
                tipoDocumento:'',
                dscDocumento: '',
                txt_link_documento_sei:''
                
            }        
        },
       
        methods:{
            
            
        },
        mounted() {

                       
            //retorna as secretarias
            axios.get(this.url + '/api/tipo_documento/').then(resposta => {
                this.buscando = false;
                this.tipoDocumentos = resposta.data;
                
            }).catch(error => {
                console.log(error);
            });




        }
    }
</script>
