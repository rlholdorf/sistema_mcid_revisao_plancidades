<div class="card">
    <div class="card-body">
        <div class="form-group">
            <div class="row">
                <div class="col col-xs-12 col-sm-3">
                    <div class="br-input">
                        <label class="control-label">Id Proposta</label>
                        <input class="br-input" type="text" id="cod_proposta" name="cod_proposta"
                            value="{{$proposta->cod_proposta}}" readonly="">
                        <p class="help-block help-block-error"></p>
                    </div>
                </div>
                <div class="col col-xs-12 col-sm-3">
                    <div class="br-input">
                        <label class="control-label">Nº da Proposta</label>
                        <input class="br-input" type="text" id="num_proposta" name="num_proposta"
                            value="{{$proposta->num_proposta}}" readonly="">
                        <p class="help-block help-block-error"></p>
                    </div>
                </div>
                <div class="col col-xs-12 col-sm-3">
                    <div class="br-input">
                        <label class="control-label">Data</label>
                        <input class="br-input" type="text" id="dte_proposta" name="dte_proposta"
                            value="@if($proposta->dte_proposta){{date('d/m/Y',strtotime($proposta->dte_proposta))}}@endif"
                            readonly="">
                        <p class="help-block help-block-error"></p>
                    </div>
                </div>
                <div class="col col-xs-12 col-sm-3">
                    <div class="br-input">
                        <label class="control-label">Modalidade</label>
                        <input class="br-input" type="text" id="dsc_modalidade" name="dsc_modalidade"
                            value="{{$proposta->dsc_modalidade}}"
                            readonly="">
                        <p class="help-block help-block-error"></p>
                    </div>
                </div>
            </div><!-- row -->
            <div class="row">
                <div class="col col-xs-12 col-sm-4">
                    <div class="br-input">
                        <label class="control-label">Situação Proposta</label>
                        <input class="br-input" type="text" id="dsc_situacao_proposta" name="dsc_situacao_proposta"
                            value="{{$proposta->dsc_situacao_proposta}}" readonly="">
                        <p class="help-block help-block-error"></p>
                    </div>
                </div>
                <div class="col col-xs-12 col-sm-4">
                    <div class="br-input">
                        <label class="control-label">Situação Projeto Básico</label>
                        <input class="br-input" type="text" id="dsc_situacao_projeto_basico" name="dsc_situacao_projeto_basico"
                            value="{{$proposta->dsc_situacao_projeto_basico}}" readonly="">
                        <p class="help-block help-block-error"></p>
                    </div>
                </div>
                <div class="col col-xs-12 col-sm-4">
                    <div class="br-input">
                        <label class="control-label">Situação Conta</label>
                        <input class="br-input" type="text" id="dsc_situacao_conta" name="dsc_situacao_conta"
                            value="{{$proposta->dsc_situacao_conta}}" readonly="">
                        <p class="help-block help-block-error"></p>
                    </div>
                </div>
            </div><!-- row -->
            <div class="row">
                <div class="col col-xs-12 col-sm-3">
                    <div class="br-input">
                        <label class="control-label">CNPJ</label>
                        <input class="br-input" type="text" id="num_identif_proponente" name="num_identif_proponente"
                            value="{{$proposta->num_identif_proponente}}" readonly="">
                        <p class="help-block help-block-error"></p>
                    </div>
                </div>
                <div class="col col-xs-12 col-sm-9">
                    <div class="br-input">
                        <label class="control-label">Proponente</label>
                        <input class="br-input" type="text" id="nom_proponente" name="nom_proponente"
                            value="{{$proposta->nom_proponente}}" readonly="">
                        <p class="help-block help-block-error"></p>
                    </div>
                </div>
            </div><!-- row -->
            <div class="row">
                <div class="col col-sm-12 br-textarea">
                    <label for="dsc_motivo" class="control-label">Objeto</label>
                    <textarea class="form-control" id="txt_objeto_proposta" name="txt_objeto_proposta" rows="5">
                    {{ltrim($proposta->txt_objeto_proposta)}}

                    </textarea>
                </div>
            </div>
           
           
        </div><!-- form-group -->
    </div><!-- card-body -->
</div>