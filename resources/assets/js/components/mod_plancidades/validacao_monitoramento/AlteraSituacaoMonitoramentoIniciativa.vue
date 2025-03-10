<template>
    <div>
        <div class="form-group">
            <div class="row mt-3">
                <div class="column col-3 col-xs-12">
                    <label>Órgão Responsável</label>
                    <p v-text="dadosMonitoramento.dsc_orgao"></p>
                </div>
            
                <div class="column col-9 col-xs-12">
                    <label>Objetivo Estratégico</label>
                    <p v-text="dadosMonitoramento.txt_titulo_objetivo_estrategico_pei"></p>
                </div>
            </div><!--row-->
            
            <div class="row mt-3">
                <div class="column col-xs-12">
                    <label>Indicador de Objetivo Estratégico</label>
                    <p v-text="dadosMonitoramento.txt_enunciado_iniciativa"></p>
                </div>
            </div><!-- div row -->


            <div class="row mt-3">
                <div class="column col-xs-12">
                    <label>Descrição da Meta</label>
                    <p v-text="metaIniciativa.txt_dsc_meta"></p>
                </div>
            </div><!-- div row -->

            <div class="row mt-3">

                <div class="column col-xs-12 col-sm-2">
                    <label>Consta no PPA:</label> 
                    <p v-text="dadosMonitoramento.bln_ppa ? 'Sim':'Não' "></p>
                </div>

                <div class="column col-xs-12 col-sm-10">
                    <label>Possui Meta Regionalizada:</label> 
                    <p v-text="metaIniciativa.bln_meta_regionalizada ? 'Sim': 'Não'"></p>
                </div>
            </div><!-- div row -->



            <div class="row mt-3">
                <div class="column col-xs-12 col-sm-2">
                    <label>Ano do Monitoramento</label>
                    <p v-text="dadosMonitoramento.num_ano_periodo_monitoramento"></p>
                </div>

                <div class="column col-xs-12 col-sm-2">
                    <label>Periodo de Monitoramento</label>
                    <p v-text="dadosMonitoramento.dsc_periodo_monitoramento"></p>
                </div>

                <div class="column col-xs-12 col-sm-8">
                    <label>Usuário Responsável pelo Monitoramento </label>
                    <p v-text="usuarioPreenchimento.name"></p>
                </div>
            </div><!-- div row -->
        </div><!--form-group-->
        
        <slot>
        
        </slot>

        <div v-if="dadosMonitoramento.bln_meta_apurada">
            <div class="row mt-3">
                <div class="col col-xs-12">
                    <label>Análise Crítica</label>
                    <p v-text="dadosMonitoramento.dsc_analise_indicador"></p>
                </div>
            </div><!-- div row -->
        </div>

    
        <div class="row">
            <div class="titulo">
                <h3>Análise do Monitoramento</h3> 
            </div>
            <div class="column col-xs-12 col-sm-6">
                <label for="situacao_monitoramento">Situação Atual do Monitoramento</label>
                <p v-text="monitoramentos.txt_situacao_monitoramento"></p>
            </div>
            <div class="column col-xs-12 col-sm-6">
                <label for="situacao_monitoramento_id">Situação do Monitoramento após Análise</label>
                <select id="situacao_monitoramento_id"
                    @change="situacaoMonitoramento" class="form-select br-select" name="situacao_monitoramento_id" required>
                    <option value="" v-text="textoEscolhaSituacao"></option>
                    <option v-for="item in situacoesMonitoramento" v-text="item.txt_situacao_monitoramento" :value="item.id"
                    :key="item.id"></option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col col-xs-12 br-textarea">
                <label for="situacao_monitoramento">Observações de Análise do Monitoramento</label>
                <textarea class="input-medium" id="txt_observacao" name="txt_observacao"
                          rows="5" v-model="monitoramentos.txt_observacao" required>
                </textarea>
            </div>
        </div>

        <div class="row">
            <div  class="col col-xs-12 col-sm-6">                    
            </div>

            <div class="col col-xs-12 col-sm-6">
                <div class="p-3 text-right">
                    <button class="br-button primary mr-3" type="submit" name="botao_salvar" :value="true">Salvar
                    </button>
                    
                    <button class="br-button danger mr-3" type="button"
                    onclick="javascript:window.history.go(-1)">Voltar
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    props: ['url', 'dadosMonitoramento', 'metaIniciativa', 'monitoramentos', 'usuarioPreenchimento'],
    data() {
        return {
        situacoesMonitoramento:'',
        situacaoMonitoramento:'',
        textoEscolhaSituacao:"Escolha a nova situação do Monitoramento",
        }
    },
    methods: {
               
    },
    mounted() {
        axios.get(this.url + '/api/plancidades/situacao_monitoramento').then(resposta=>{
            this.situacoesMonitoramento = resposta.data;
            }).catch(error=>{
            console.log(error);
        });
    }
}
</script>
