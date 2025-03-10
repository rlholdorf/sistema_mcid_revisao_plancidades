<div class="card">    
    <div class="card-body">    
        <div class="form-group">
            <div class="row">
                <div class="col col-sm-3">
                    <div class="br-input">
                        <label class="control-label" >Cód Contrato</label>
                        <input class="br-input" type="text" id="cod_contrato" name="cod_contrato" value="{{$dadosContrato->cod_contrato}}" readonly="">
                    </div>
                </div>
                <div class="col col-sm-3">
                    <div class="br-input">
                        <label class="control-label" >Nº Convênio</label>
                        <input class="br-input" type="text" id="num_convenio" name="num_convenio" value="{{$dadosContrato->num_convenio}}" readonly="">
                    </div>
                </div>
                <div class="col col-sm-3">
                    <div class="br-input">
                        <label class="control-label" >Fonte</label>
                        <input class="br-input" type="text" id="txt_sub_fonte" name="txt_sub_fonte" value="{{$dadosContrato->txt_sub_fonte}}" readonly="">
                    </div>
                </div>
                <div class="col col-sm-3">
                    <div class="br-input">
                        <label class="control-label" >Tomador</label>
                        <input class="br-input" type="text" id="tomador_agrupado" name="tomador_agrupado" value="{{$dadosContrato->tomador_agrupado}}" readonly="">
                    </div>
                </div>
                
            </div><!-- row -->
            <div class="row">
                <div class="col col-sm-2">
                    <div class="br-input">
                        <label class="control-label" >UF</label>
                        <input class="br-input" type="text" id="uf" name="uf" value="{{$dadosContrato->uf}}" readonly="">
                        <p class="help-block help-block-error"></p>
                    </div>
                </div>
                <div class="col col-sm-4">
                    <div class="br-input">
                        <label class="control-label" >Municípios</label>
                        <input class="br-input" type="text" id="municipio" name="municipio" value="{{$dadosContrato->municipio}}" readonly="">
                        <p class="help-block help-block-error"></p>
                    </div>
                </div>
                <div class="col col-sm-3">
                    <div class="br-input">
                        <label class="control-label" >Data Início</label>
                        <input class="br-input" type="text" id="data_inicio_obra" name="data_inicio_obra" value="@if($dadosContrato->data_inicio_obra){{date('d/m/Y',strtotime($dadosContrato->data_inicio_obra))}}@endif" readonly="">
                        <p class="help-block help-block-error"></p>
                    </div>
                </div>
                <div class="col col-sm-3">
                    <div class="br-input">
                        <label class="control-label" >Data Previsão Conclusão</label>
                        <input class="br-input" type="text" id="data_previsao_termino_pela_gidur" name="data_previsao_termino_pela_gidur" value="@if($dadosContrato->data_fim_obra){{date('d/m/Y',strtotime($dadosContrato->data_fim_obra))}}@endif" readonly="">
                        <p class="help-block help-block-error"></p>
                    </div>
                </div>
            </div><!-- row -->
           
           <div class="row">
            <div class="col col-sm-2">
                <div class="br-input">
                    <label class="control-label" >Fase</label>
                    <input class="br-input" type="text" id="txt_fase_pac" name="txt_fase_pac" value="{{$dadosContrato->txt_fase_pac}}" readonly="">
                </div>
            </div>
            <div class="col col-sm-2">
                <div class="br-input">
                    <label class="control-label" >Tipo Instrumento</label>
                    <input class="br-input" type="text" id="tipo_instrumento" name="tipo_instrumento" value="{{$dadosContrato->tipo_instrumento}}" readonly="">
                </div>
            </div>
            <div class="col col-sm-4">
                <div class="br-input">
                    <label class="control-label" >Eixo</label>
                    <input class="br-input" type="text" id="txt_eixo" name="txt_eixo" value="{{$dadosContrato->eixo}}" readonly="">
                </div>
            </div>
            <div class="col col-sm-2">
                <div class="br-input">
                    <label class="control-label" >SubEixo</label>
                    <input class="br-input" type="text" id="subeixo" name="subeixo" value="{{$dadosContrato->subeixo}}" readonly="">
                </div>
            </div>
            <div class="col col-sm-2">
                <div class="br-input">
                    <label class="control-label" >SubEixo 2</label>
                    <input class="br-input" type="text" id="subeixo2" name="subeixo2" value="{{$dadosContrato->subeixo}}" readonly="">
                </div>
            </div>
            
        </div><!-- row -->
        </div>
    </div><!-- card-body -->
</div>