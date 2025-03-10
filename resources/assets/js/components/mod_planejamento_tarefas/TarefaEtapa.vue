<template>
    
        
    <div class="container">
      <div class="well"> 
          <div class="form-group">
              <div class="row">
                <div class="col col-xs-12 col-sm-4">
                  <label for="etapa_planejamento_id">Etapa Planejamento</label>           
                  <select 
                      id="etapa_planejamento_id"
                      class="form-select br-select" 
                      name="etapa_planejamento_id"  
                      v-model="etapa_planejamento"   
                     required
                  >
                      <option value="" >Escolha uma Etapa</option>
                      <option v-for="etapa in etapas_planejamentos" v-text="etapa.txt_nome_etapa_planejamento" :value="etapa.id" :key="etapa.id"></option>
                  </select>
                </div>
                <div class="col col-xs-12 col-sm-4">
                  <label for="progresso_id">Progresso</label>           
                  <select 
                      id="progresso_id"
                      class="form-select br-select" 
                      name="progresso_id"  
                      v-model="progresso"   
                     required
                  >
                      <option value="" >Escolha um progresso</option>
                      <option v-for="item in progressos" v-text="item.txt_progresso" :value="item.id" :key="item.id"></option>
                  </select>
                </div>
                <div class="col col-xs-12 col-sm-4">
                  <label for="prioridade_id">Prioridade</label>           
                  <select 
                      id="prioridade_id"
                      class="form-select br-select" 
                      name="prioridade_id"  
                      v-model="prioridade"   
                     required
                  >
                      <option value="" >Escolha uma Prioridade</option>
                      <option v-for="item in prioridades" v-text="item.txt_prioridade" :value="item.id" :key="item.id"></option>
                  </select>
                </div>
              </div><!-- row -->
              <div class="row">
                <div class="col col-xs-12 col-sm-4 br-input">
                  <label for="dte_inicio_tarefa" class="control-label">Data de Início</label>
                  <input id="dte_inicio_tarefa" 
                      type="date" 
                      class="form-control" 
                      name="dte_inicio_tarefa" 
                      v-model="dte_inicio_tarefa">
              </div>
              <div class="col col-xs-12 col-sm-4 br-input">
                <label for="dte_conclusao_tarefa" class="control-label">Data de Conclusão</label>
                <input id="dte_conclusao_tarefa" 
                    type="date" 
                    class="form-control" 
                    name="dte_conclusao_tarefa" 
                    v-model="dte_conclusao_tarefa">
            </div>
                <div class="col col-xs-12 col-sm-4">
                  <label for="periodizacao_id">Periodização</label>           
                  <select 
                      id="periodizacao_id"
                      class="form-select br-select" 
                      name="periodizacao_id"  
                      v-model="periodizacao"   
                     required
                  >
                      <option value="" >Escolha uma Periodização</option>
                      <option v-for="item in periodizacoes" v-text="item.txt_periodizacao" :value="item.id" :key="item.id"></option>
                  </select>
                </div>
              </div><!-- row -->
              <div class="row ">
                  <div class="col col-xs-12 br-textarea">
                      <label for="dsc_anotacoes" class="control-label">Anotações</label>
                      <textarea class="form-control" 
                      id="dsc_anotacoes" 
                      name="dsc_anotacoes"  
                      v-model="dsc_anotacoes"
                      rows="10" required></textarea>
                  </div>
             </div>
            </div><!-- form-group -->
        </div><!-- well -->   
        
        
    </div>
        
  
  </template>
  
  <script>
      export default {
          props:['url','tarefa'],
          data() {
              return {
                  
                tarefas_etapa_id: '',
                txt_tarefa_etapa: '',
                etapa_planejamento: '',
                etapas_planejamentos:'',
                tarefas_etapa: '',
                progresso: '',
                progressos:'',
                prioridade: '',
                prioridades:'',
                dte_inicio_tarefa: '',
                dte_conclusao_tarefa: '',
                periodizacao: '',
                periodizacoes: '',
                dsc_anotacoes: '',
                user_id: '',
                secretaria_id: '',
                created_at: '',
                updated_at: ''
                  
              };
          },
          mounted() {
  
            
            axios.get(this.url + '/api/planejamento_tarefa/etapas').then(resposta => {
                  this.etapas_planejamentos = resposta.data;                
              }).catch(error => {
                  console.log(error);
              });
  
              axios.get(this.url + '/api/planejamento_tarefa/progressos').then(resposta => {
                  this.progressos = resposta.data;                
              }).catch(error => {
                  console.log(error);
              });
  
              axios.get(this.url + '/api/planejamento_tarefa/prioridades').then(resposta => {
                  this.prioridades = resposta.data;                
              }).catch(error => {
                  console.log(error);
              });
  
              axios.get(this.url + '/api/planejamento_tarefa/periodizacoes').then(resposta => {
                  this.periodizacoes = resposta.data;                
              }).catch(error => {
                  console.log(error);
              });
              
  
              if(this.tarefa){
                  this.tarefas_etapa_id = this.tarefa.id;
                  this.txt_tarefa_etapa = this.tarefa.txt_tarefa_etapa;
                  this.etapa_planejamento = this.tarefa.etapa_planejamento_id;
                  this.progresso = this.tarefa.progresso_id;
                  this.prioridade = this.tarefa.prioridade_id;
                  this.dte_inicio_tarefa = this.tarefa.dte_inicio_tarefa;
                  this.dte_conclusao_tarefa = this.tarefa.dte_conclusao_tarefa;
                  this.periodizacao = this.tarefa.periodizacao_id;
                  this.dsc_anotacoes = this.tarefa.dsc_anotacoes;
                  this.user_id = this.tarefa.user_id;
                  this.secretaria_id = this.tarefa.secretaria_id;
                  this.created_at = this.tarefa.created_at;
                  this.updated_at = this.tarefa.updated_at;
                  
              }
          }
      }
  </script>
  