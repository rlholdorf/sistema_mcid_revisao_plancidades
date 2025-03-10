
  <nav>
      <div class="nav nav-tabs" id="nav-tab" role="tablist">
          <button class="nav-item nav-link active" id="nav-caracterizacao-tab" data-toggle="tab" href="#nav-caracterizacao" role="tab" aria-controls="nav-caracterizacao" aria-selected="true">
            <i class="fas fa-list" aria-hidden="true"></i>Caracterização
          </button>

          <button class="nav-item nav-link" id="nav-contrato-tab" data-toggle="tab" href="#nav-contrato" role="tab" aria-controls="nav-contrato" aria-selected="false">
            <i class="fas fa-list" aria-hidden="true"></i>Contrato
          </button>     

          <button class="nav-item nav-link" id="nav-administrativo-tab" data-toggle="tab" href="#nav-administrativo" role="tab" aria-controls="nav-administrativo" aria-selected="false">
            <i class="fas fa-list" aria-hidden="true"></i>Administrativo
          </button> 
      </div>
  </nav>
  
  <div class="tab-content" id="nav-tabContent">
      <div class="tab-pane fade show active" id="nav-caracterizacao" role="tabpanel" aria-labelledby="nav-caracterizacao-tab">
        <div class="card">        
          <div class="card-body"> 
            @include('modulo_saci.form_aux_dados_gerais_caracterizacao') 
          </div>
        </div>
    
      </div><!--nav-caracterizacao -->

      <div class="tab-pane fade show" id="nav-contrato" role="tabpanel" aria-labelledby="nav-contrato-tab">
        <div class="card">        
          <div class="card-body"> 
            @include('modulo_saci.form_aux_dados_gerais_contrato') 
          </div>
        </div>          
       </div><!--nav-contrato -->

       <div class="tab-pane fade show" id="nav-administrativo" role="tabpanel" aria-labelledby="nav-administrativo-tab">
        @include('modulo_saci.form_aux_dados_gerais_administrativo') 
     </div><!--nav-administrativo -->
  </div>
