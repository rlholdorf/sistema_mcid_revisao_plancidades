<div class="card">    
    <div class="card-body">    
        <div class="form-group">
            <div class="row">
                <div class="col col-sm-6">
                    <div class="br-input">
                        <label class="control-label" >Motivos</label>
                        <input class="br-input" type="text" id="txt_motivo_paralizacao" name="txt_motivo_paralizacao" value="{{$obrasParalisada->txt_motivo_paralizacao}}" readonly="">
                        <p class="help-block help-block-error"></p>
                    </div>
                </div>
                <div class="col col-sm-3">
                    <div class="br-input">
                        <label class="control-label" >Previsão Retomada</label>
                        <input class="br-input" type="text" id="dte_prev_ret" name="dte_prev_ret" value="@if($obrasParalisada->dte_prev_ret){{date('d/m/Y',strtotime($obrasParalisada->dte_prev_ret))}}@endif" readonly="">
                        <p class="help-block help-block-error"></p>
                    </div>
                </div>
                <div class="col col-sm-3">
                    <div class="br-input">
                        <label class="control-label" >Retomada</label>
                        <input class="br-input" type="text" id="dte_efet_ret" name="dte_efet_ret" value="@if($obrasParalisada->dte_efet_ret){{date('d/m/Y',strtotime($obrasParalisada->dte_efet_ret))}}@endif" readonly="">
                        <p class="help-block help-block-error"></p>
                    </div>
                </div>
            </div><!-- row -->
            <div class="row">
                <div class="col col-sm-12 br-textarea">
                    <label for="dsc_motivo" class="control-label">Descrição dos motivos</label>
                    <textarea class="form-control" 
                    id="dsc_motivo" 
                    name="dsc_motivo"                      
                    rows="5">
                    {{$obrasParalisada->dsc_motivo}}                    
                    
                </textarea>
                </div>
           </div>
           @if($obrasParalisada->txt_outros_motivos)
            <div class="row">
                <div class="col col-sm-12 br-textarea">
                    <label for="txt_outros_motivos" class="control-label">Outros motivos</label>
                    <textarea class="form-control" 
                    id="txt_outros_motivos" 
                    name="txt_outros_motivos"                      
                    rows="5">
                    {{$obrasParalisada->txt_outros_motivos}}                    
                    
                </textarea>
                </div>
            </div>
            @endif
            @if($obrasParalisada->dte_providencia)
                <div class="row">
                    <div class="col col-sm-2">
                        <div class="br-input">
                            <label class="control-label" >Providência</label>
                            <input class="br-input" type="text" id="dte_providencia" name="dte_providencia" value="@if($obrasParalisada->dte_providencia){{date('d/m/Y',strtotime($obrasParalisada->dte_providencia))}}@endif" readonly="">
                            <p class="help-block help-block-error"></p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col col-sm-12 br-textarea">
                        <label for="dsc_providencia" class="control-label">Descrição Providências</label>
                        <textarea class="form-control" 
                                id="dsc_providencia" 
                                name="dsc_providencia"                      
                                rows="5">
                                {{$obrasParalisada->dsc_providencia}}    
                        </textarea>
                    </div>
                </div>
            @endif
            @if($obrasParalisada->txt_obs)
            
                <div class="row">
                    <div class="col col-sm-12 br-textarea">
                        <label for="txt_obs" class="control-label">Observações</label>
                        <textarea class="form-control" 
                                id="txt_obs" 
                                name="txt_obs"                      
                                rows="5">
                                {{trim($obrasParalisada->txt_obs)}}    
                        </textarea>
                    </div>
                </div>

            @endif
        </div><!-- form-group -->
    </div><!-- card-body -->
</div>