<div class="br-card mb-4">
    <div class="row"></div>
        <div class="card-header bg-primary-300 p-0">
            <div class="d-flex">
              <div class="ml-3">
                <div class="text-weight-semi-bold py-3">Cod. Programa {{$programaTransferegov->cod_programa}}</div>
              </div>
            </div>
        </div>
    <div class="card-body">
        <div class="row">
            <div class="col-10">
                <div class="d-flex align-items-baseline">
                    <label class="card-title">Ação: {{$programaTransferegov->num_acao_orcamentaria}}</label>

                    @if($programaTransferegov->dsc_sit_programa == 'INATIVO')
                        <span class="ml-3 br-tag bg-danger">
                            <p class="text-white">Inativo</p>
                        </span>
                    @else
                        @if (!$programaTransferegov->cod_programa_cidades)
                            <span class="ml-3 br-tag bg-warning">
                                <p class="">Registro pendente</p>
                            </span>
                        @else
                            <span class="ml-3 br-tag bg-success">
                                <p class="text-white">Concluído</p>
                            </span>
                        @endif
                    @endif
                </div>
                <p class="card-text">{{$programaTransferegov->nom_programa}}</p>
            </div>
            <div class="col-2 d-flex justify-content-end align-items-center">
                @if ($programaTransferegov->dsc_sit_programa == "DISPONIBILIZADO")
                    @if (!$programaTransferegov->cod_programa_cidades)
                        <a class="br-button primary mr-3" type="button" href="{{ route('transferegov.criar', [$programaTransferegov->cod_programa])}}">Registrar</a>
                    @else    
                        <a class="br-button primary mr-3" type="button" href="{{ route('transferegov.editar', [$programaTransferegov->cod_programa])}}">Visualizar</a>
                        <a class="br-button primary mr-3" type="button" href="{{ route('transferegov.editar', [$programaTransferegov->cod_programa])}}">Editar</a>
                    @endif
                @endif
            </div>
        </div>
    </div>
</div>