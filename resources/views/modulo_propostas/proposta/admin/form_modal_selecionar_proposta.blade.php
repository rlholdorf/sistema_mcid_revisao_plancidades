<!-- Modal -->
    <div class="modal fade" id="novaProposta{{$dados->proposta_id}}" tabindex="-1" aria-labelledby="novaPropostaLabel{{$dados->proposta_id}}" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="novaPropostaLabel">Adicionar Proposta de id: {{$dados->proposta_id}}</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="form-horizontal" role="form" method="POST" action='{{ url("admin/proposta/selecionada/adicionar/") }}'>         
                {{ csrf_field() }}
                <input type="hidden" id="selecao_proposta_id" name="selecao_proposta_id" value="{{$selecaoPropostaID}}">
                <div class="modal-body">
                    <selecionar-proposta
                    url='{{ url("/") }}' 
                    :blnsituacaopropostas='true'
                    :blnbtnpesquisar='true'                
                    :idproposta='{{$dados->proposta_id}}'
                    :numpropostatransferegov="'{{$numPropTransferegov}}'"
                    
                    >
            
                    </selecionar-proposta>
                </div>
                <div class="modal-footer">
                    <!--
                <button type="button" class="br-button danger mr-3" data-bs-dismiss="modal">Fechar</button>
                <button type="submit" class="br-button primary mr-3">Salvar</button>
                    -->
                </div>
            </form>
          </div>
        </div>
      </div>
</div>