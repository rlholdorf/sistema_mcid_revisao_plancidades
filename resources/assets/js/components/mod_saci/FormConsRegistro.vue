<template>
     <div class="form-group">
        <div class="row">
            <div class="col col-xs-12 col-sm-4">
                <label for="bln_importado_por_arquivo">Tipo de Carga</label>           
                <select 
                    id="bln_importado_por_arquivo"
                    class="form-control" 
                    name="bln_importado_por_arquivo"  
                    v-model="bln_importado_por_arquivo"                       
                >
                    <option value="">Escolha um Tipo de Carga:</option>
                    <option value="arquivo">Registro importado por arquivo</option>
                    <option value="form">Registro cadastro pelo formulário</option>

                     
                    
                </select>
            </div>
            <div class="col col-xs-12 col-sm-4">
                 <label >Data da Inicial da Carga</label>
                <input id="dte_carga_inicial" 
                       type="date" 
                       min="2021-11-29"
                       class="form-control" 
                       name="dte_carga_inicial" 
                       v-model="dte_carga_inicial" 
                       >
            </div>
            <div class="col col-xs-12 col-sm-4">
                 <label >Data da Final da Carga</label>
                <input id="dte_carga_final" 
                       type="date" 
                       :min="this.dte_carga_inicial"
                       class="form-control" 
                       name="dte_carga_final" 
                       v-model="dte_carga_final" 
                       :disabled="this.dte_carga_inicial == ''">
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props:['url'],
        data(){
            return{
                 buscando: false,
                 dte_carga_inicial:'',
                 dte_carga_final:'',
                 bln_importado_por_arquivo:'',
            }
        },         
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
