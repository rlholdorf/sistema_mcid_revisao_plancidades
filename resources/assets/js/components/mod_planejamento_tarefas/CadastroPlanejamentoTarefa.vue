<template>
    <div class="container">
        <div class="well"> 
            <div class="form-group">
                <div class="row">
                    <div class="col col-xs-12 col-sm-6 br-input">
                        <label for="txt_nome_planejamento" class="control-label">Nome do Planejamento</label>
                        <input id="txt_nome_planejamento" 
                            type="text" 
                            class="form-control" 
                            name="txt_nome_planejamento" 
                            v-model="txt_nome_planejamento"
                            required>
                    </div>
                    <div class="col col-xs-12 col-sm-6 ">
                        <label for="secretaria">Secretaria</label>           
                        <select 
                            id="secretaria"
                            class="form-select br-select" 
                            name="secretaria"  
                            v-model="secretaria"   
                           required
                        >
                            <option value="" >Escolha uma Secretaria</option>
                            <option v-for="secretaria in secretarias" v-text="secretaria.txt_nome_secretaria" :value="secretaria.id" :key="secretaria.id"></option>
                        </select>
                    </div>
                </div><!-- row -->
                <div class="row ">
                    <div class="col col-xs-12 br-textarea">
                        <label for="dsc_planejamento_tarefa" class="control-label">Descrição do Planejamento</label>
                        <textarea class="form-control" 
                        id="dsc_planejamento_tarefa" 
                        name="dsc_planejamento_tarefa"  
                        v-model="dsc_planejamento_tarefa"
                        rows="10" required></textarea>
                    </div>
               </div>
            </div><!-- form-group -->
        </div><!-- well -->        
    </div>
</template>

<script>
    export default {
        props:['url'],
        data() {
            return {
                
                    txt_nome_planejamento: '',
                    dsc_planejamento_tarefa: '',
                    cod_secretaria: null,
                    bln_ativo: true,
                    user_id:'', 
                    secretarias:'',
                
            };
        },
        mounted() {
             //retorna as secretarias
             axios.get(this.url + '/api/sistema/secretarias/').then(resposta => {
                this.textoEscolhaDepartamento = "Escolha uma secretaria:";
                this.buscando = false;
                this.secretarias = resposta.data;
                
            }).catch(error => {
                console.log(error);
            });
        }
    }
</script>
