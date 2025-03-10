<div class="titulo">
    <h5>Dados da Paralisaçãp</h5>
</div>

<div class="form-group br-textarea">
    <label for="txt_principal_motivo_paralisacao" class="control-label">Principal Motivo</label>
    <textarea class="form-control" 
       id="txt_principal_motivo_paralisacao" 
       name="txt_principal_motivo_paralisacao"  
       rows="10">{{$carteira->txt_principal_motivo_paralisacao}}</textarea>
</div>

<div class="row">
    <div class="col col-xs-12 col-xl-4 col-sm-4 col-md-4 br-input text-center">
        <label for="input-default">Motivo Cidades</label>
        <input id="dsc_motivo_paralisacao" class="text-center" name="dsc_motivo_paralisacao" type="text"
            value="{{$carteira->dsc_motivo_paralisacao}}"/>
    </div>
    <div class="col col-xs-12 col-xl-4 col-sm-4 col-md-4 br-input text-center">
        <label for="input-default">Data da Paralisação</label>
        <input id="dte_paralisacao" class="text-center" name="dte_paralisacao" type="text"
            value="{{$carteira->dte_paralisacao}}"/>
    </div>
</div>

<div class="form-group br-textarea">
    <label for="dsc_detalhamento_motivo_paralisacao" class="control-label">Detalhamento Motivo</label>
    <textarea class="form-control" 
       id="dsc_detalhamento_motivo_paralisacao" 
       name="dsc_detalhamento_motivo_paralisacao"  
       rows="10">{{$carteira->dsc_detalhamento_motivo_paralisacao}}</textarea>
</div>
