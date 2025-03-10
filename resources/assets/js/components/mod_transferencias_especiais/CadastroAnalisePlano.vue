<template>
    <div class="form-group">
        <div class="row">
            <div class="col col-xs-12 col-sm-3 br-input">
                <label for="dte_analise" class="control-label">Data Análise</label>
                <input id="dte_analise" 
                    type="date" 
                    class="form-control" 
                    name="dte_analise" 
                    v-model="dte_analise" >
            </div>
            <div class="col col-xs-12 col-sm-3 br-input">
                <label for="dte_envio" class="control-label">Data Envio</label>
                <input id="dte_envio" 
                    type="date" 
                    class="form-control" 
                    name="dte_envio" 
                    v-model="dte_envio" >
            </div>
            <div class="col col-xs-12 col-sm-3 br-input">
                <label for="txt_resultado_analise" class="control-label">Resultado</label>
                <input id="txt_resultado_analise" 
                    type="text" 
                    class="form-control" 
                    name="txt_resultado_analise" 
                    v-model="txt_resultado_analise" >
            </div>
            <div class="col col-xs-12 col-sm-3 br-input">
                <label for="txt_secretaria" class="control-label">Secretaria</label>
                <input id="txt_secretaria" 
                    type="text" 
                    class="form-control" 
                    name="txt_secretaria" 
                    v-model="txt_secretaria" >
            </div>           
        </div>
        <div class="row">
            <div class="col col-xs-12 col-sm-6 br-input">
                <label for="txt_cpf_responsavel_analise" class="control-label">CPF Responsável</label>
                <input id="txt_cpf_responsavel_analise" 
                    type="text" 
                    class="form-control" 
                    name="txt_cpf_responsavel_analise" 
                    v-model="txt_cpf_responsavel_analise" >
            </div>
            <div class="col col-xs-12 col-sm-6 br-input">
                <label for="txt_nome_responsavel_analise" class="control-label">Responsável</label>
                <input id="txt_nome_responsavel_analise" 
                    type="text" 
                    class="form-control" 
                    name="txt_nome_responsavel_analise" 
                    v-model="txt_nome_responsavel_analise" >
            </div>          
        </div>
        <div class="form-group br-textarea">
            <label for="dsc_parecer" class="control-label">Parecer</label>
            <textarea class="form-control" 
               id="dsc_parecer" 
               name="dsc_parecer"                 
               v-model="dsc_parecer"                 
               rows="10" required></textarea>
       </div>
    </div>
</template>

<script>
    export default {
        props:['url','colinput','collabel'],
        data(){
            return{
                secretaria:'',
                secretarias:['SDR','SEDEC','SEMOB','SNDUM','SNH','SNP','SNSA','SNSH'],
                analise:''
            }        
        },
        methods:{
            onChangeSecretaria() {
                this.textoEscolhaDepartamento = "Buscando...";
                this.departamento = '';
                this.buscando = true;
                if(this.secretaria != '') {
                    //Implementação correta após arrumar tabela dos municipios
                    axios.get(this.url + '/api/planos_acoes/responsavel/secretaria/' + this.secretaria).then(resposta => {
                        this.textoEscolhaDepartamento = "Escolha um departamento:";                        
                        this.buscando = false;
                        this.departamentos = resposta.data;                        
                        this.textoEscolhaSetor = "Escolha um departamento:";
                        console.log(this.departamentos);                   
                    }).catch(error => {
                        console.log(error);
                    });
                  
                } else {
                    this.buscando = false;
                    this.departamento = '';
                    this.textoEscolhaDepartamento = "Filtre a Secretaria"
                }            
            }
        },    
        mounted() {

             
             
          
        }
    }
</script>

