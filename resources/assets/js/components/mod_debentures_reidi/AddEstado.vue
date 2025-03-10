<template>
   <div>
        <div class="row"  v-if="habilita_botao">
            <button @click="onClickAddEstado()" type="button" class="btn btn-block btn-outline-primary btn-lg">Adicionar Estado</button>
        </div>
        <hr>
        <div class="row form-group" v-if="habilita_select">
            <div class="col col-xs-12 col-sm-10">
                <select 
                    id="estado"
                    class="form-select br-select" 
                    name="estado"                   
                    @change="onChangeEstado"
                    v-model="estado"
                    required>                    
                    <option value="">Escolha um Estado:</option>
                    <option v-for="estado in estados" v-text="estado.txt_sigla_uf" :value="estado.id" :key="estado.id"></option>
                </select>  
            </div>
            <div class="col col-xs-12 col-sm-2 ">
                <button type="submit" class="btn btn-block btn-primary">Adicionar</button>
            </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props:['url','urlaction','habilitaselect','habilitabotao'],
        data(){
            return{
                buscando: false,
                habilita_select: false,
                habilita_botao:true,
                estados: '',
                estado: '',
            }
        },
        methods:{
            onClickAddEstado() {
                this.habilita_select = true;
                this.habilita_botao = false;
            }
        },
        mounted() {
            axios.get(this.url + '/api/ufs/').then(resposta => {
                //console.log(resposta.data);
                this.estados = resposta.data;
                }).catch(erro => {
                    console.log(erro);
                })


                if(this.habilitaselect && this.habilitabotao){

                }
                this.habilita_select = this.habilitaselect;
                this.habilita_botao = this.habilitabotao;


        }
    }
</script>
