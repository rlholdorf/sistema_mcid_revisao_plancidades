<template>
   <div class="form-group">   
    
    <div class="row">
        <div class="col col-xs-12 col-sm-12 br-input">
            <label for="bln_validado">O ofício valida o usuário?</label>           
            <select 
                id="bln_validado"
                class="form-select br-select" 
                name="bln_validado"  
                v-model="bln_validado"                   
                required     
                >
                <option value="">Escolha um Opção:</option>
                <option value="true">Sim</option>
                <option value="false">Não</option>
            </select>
        </div>
    </div><!-- div row -->

    <div class="row" v-if="bln_validado == 'false'">               
        <div class="column col-xs-12 col-md-12">
            <label for="detalhamento">Motivo do Indeferimento</label>   
            <select 
                id="tipo_indeferimento"
                class="form-control" 
                name="tipo_indeferimento"               
                v-model="tipo_indeferimento"
                @change="onChangeTipo"
                required>
                <option value="" selected>Escolha um Motivo do Indeferimento</option>
                <option v-for="tipo_indeferimento in tipo_indeferimentos" v-text="tipo_indeferimento.txt_tipo_indeferimento" :value="tipo_indeferimento.id" :key="tipo_indeferimento.id"></option>
            </select>    
        </div>       
    </div>
    <div class="row"  v-if="bln_validado == 'false' && tipo_indeferimento !=''">
        <div class="column col-xs-12 col-md-12">
            <label for="sistema_em_obras">Providências</label>  
        <textarea class="form-control" id="dsc_providencia" name="dsc_providencia"  rows="5" v-model="dsc_providencia" disabled></textarea>
        </div>
    </div> 
    <div class="row"  v-if="tipo_indeferimento == 99 && bln_validado == 'false'">
        <div class="column col-xs-12 col-md-12">
                <label for="sistema_em_obras">Outro Motivo Indeferimento:</label>  
                 <textarea class="form-control" id="outro_tipo_indeferimento" name="outro_tipo_indeferimento"  rows="5" v-model="outro_tipo_indeferimento" required></textarea>                 
            </div>         
    </div>
    <div class="row">
        <div class="column col-xs-12 col-md-12">
            <label for="sistema_em_obras">Observações</label>  
        <textarea class="form-control" id="txt_observacao" name="txt_observacao"  rows="10" v-model="txt_observacao"></textarea>
        </div>
    </div> 
       
    
    
    </div>    
</template>

<script>
    export default {
        props:['url','municipioselecionado','ufselecionada','coluf','colmun','requermunicipio','requeruf','complementonomelabelmun'],
        data(){
            return{
                bln_validado:'',
                dsc_motivo_validacao:'',
                tipo_indeferimento: '',
                tipo_indeferimentos: '',
                outro_tipo_indeferimento:'',
                txt_observacao:'',
                dsc_providencia:'',

            }        
        },
        methods:{
            onChangeTipo() {
                                
                if(this.tipo_indeferimento != '') {
                    axios.get(this.url + '/api/tipo_indeferimento/providencias/' + this.tipo_indeferimento).then(resposta => {
                        
                        console.log(resposta.data);
                        this.dsc_providencia = resposta.data;
                    }).catch(error => {
                        console.log(error);
                    });
                  
                }

            }
        },
        mounted() {
            
                //retorna os tipoIndeferimento
                axios.get(this.url + '/api/tipoIndeferimento').then(resposta => {
                        //console.log(resposta.data);
                        this.tipo_indeferimentos = resposta.data;

                    }).catch(erro => {
                        console.log(erro);
                    }); 


                }
    }
</script>
