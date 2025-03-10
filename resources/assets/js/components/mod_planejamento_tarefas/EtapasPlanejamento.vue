<template>
    
        
<div class="col col-xs-12 col-sm-3">
    <div class="br-card">
      <div class="card-header">
        <div class="d-flex">    
           <!-- 
            <span class="br-avatar mt-1" title="Fulano da Silva">
                <span class="content">
           <img src="https://picsum.photos/id/823/400"/> 
                </span>
            </span>
            -->
          <div class="ml-3">
            <div class="text-weight-semi-bold text-up-02">{{txt_nome_etapa_planejamento}}</div>            
          </div>
          <div class="ml-auto">
            <button class="br-button circle" type="button" aria-label="Ícone ilustrativo">
                <i class="fas fa-ellipsis-v" aria-hidden="true"></i>
            </button>
          </div>
        </div>
      </div>
      <div class="card-content">
        <div class="p-0">
            <button class="br-button secondary block small" type="button" data-bs-toggle="modal" data-bs-target="#addTarefa">
                <i class="fas fa-plus" aria-hidden="true"></i>Adicionar Tarefa
            </button>
          </div>
      </div>
      <div class="card-footer">
        <div> 
          <div class="br-list mt-3"  v-for="tarefa in tarefasEtapas" :key="tarefa.id">            
            <a style="text-decoration: none" v-bind:href="url + '/tarefa_etapa/tarefa/'+ tarefa.id">
                <div class="br-item">
                    <div class="row">
                        <div class="col">
                            <span class="badge bg-warning">{{tarefa.secretaria.txt_sigla_secretaria}}</span>
                            <p class="m-0">{{tarefa.txt_tarefa_etapa}}</p>
                          <br>                          
                      </div>  
                    </div>
                </div>
                <span class="br-divider"></span>                           
            </a>
            
            </div>
            
        </div>
      </div>
    </div>

    

<!-- Modal -->
<div class="modal fade" id="addTarefa" tabindex="-1" aria-labelledby="addTarefaLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addTarefaLabel">Adicionar Tarefa</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="" role="form" method="POST">
       
      <div class="modal-body">
        
          <input type="hidden" id="planejamento_tarefa_id" name="planejamento_tarefa_id"  />
                    
          
            <div class="br-input">              
              <label for="input-default">Nome da Etapa</label>
              <input id="txt_nome_etapa_planejamento" name="txt_nome_etapa_planejamento" type="text" required/>              
            </div>
        
      </div>
      <div class="modal-footer">
        <button type="submit" class="br-button primary mb-3">Adicionar</button>
        <button type="button" class="br-button danger mr-3" data-bs-dismiss="modal">Fechar</button>
        
      </div>
      </form>
    </div>
  </div>
</div>
  </div>
      

</template>

<script>
    export default {
        props:['url','etapas'],
        data() {
            return {
                
                cod_etapa_planejamento: '',
                txt_nome_etapa_planejamento: '',
                bln_ativa: null,
                user_id: null,
                usuario:'',
                created_at:'', // Ajuste conforme o ID do usuário autenticado
                updated_at:'',
                tarefaEtapa:'',
                tarefasEtapas:'',
                
            };
        },
        mounted() {
            

            if(this.etapas){
                this.cod_etapa_planejamento = this.etapas.id;
                this.txt_nome_etapa_planejamento = this.etapas.txt_nome_etapa_planejamento;
                this.bln_ativa = this.etapas.bln_ativa;
                this.user_id = this.etapas.user_id;
                this.usuario = this.etapas.name;
                this.created_at = this.etapas.created_at;
                this.updated_at = this.etapas.created_at;

                 
                    axios.get(this.url + '/api/tarefas_etapas/'+ this.cod_etapa_planejamento).then(resposta => {
                       
                        this.tarefasEtapas = resposta.data;
                        
                    }).catch(erro => {
                        console.log(erro);
                    });

            }
        }
    }
</script>
