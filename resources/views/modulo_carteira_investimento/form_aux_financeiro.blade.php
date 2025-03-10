<div class="card">
    <div class="card-header text-white text-green-10 bg-green-60">
        <strong>Valores R$</strong>
    </div>
    <div class="card-body">
        <div class="container-fluid">

            <div class="row">
                <div class="col col-xs-12 col-sm-4 br-input">
                    <label for="input-default">Investimento</label>
                    <input id="vlr_investimento" name="vlr_investimento" type="text"
                        value="{{number_format($carteira->vlr_investimento, 2, ',' , '.')}}" readonly="">
                </div>
                <div class="col col-xs-12 col-sm-4 br-input">
                    <label for="input-default">Repasse</label>
                    <input id="vlr_repasse" name="vlr_repasse" type="text"
                        value="{{number_format($carteira->vlr_repasse, 2, ',' , '.')}}" readonly="">
                </div>
                <div class="col col-xs-12 col-sm-4 br-input">
                    <label for="input-default">Contrapartida</label>
                    <input id="vlr_contrapartida" name="vlr_contrapartida" type="text"
                        value="{{number_format($carteira->vlr_contrapartida, 2, ',' , '.')}}" readonly="">
                </div>
            </div><!-- row -->
            <div class="row">
                <div class="col col-xs-12 col-sm-4 br-input">
                    <label for="input-default">Empenhado</label>
                    <input id="vlr_empenhado" name="vlr_empenhado" type="text"
                        value="{{number_format($carteira->vlr_empenhado, 2, ',' , '.')}}" readonly="">
                </div>
                <div class="col col-xs-12 col-sm-4 br-input">
                    <label for="input-default">Desembolsado</label>
                    <input id="vlr_desembolsado" name="vlr_desembolsado" type="text"
                        value="{{number_format($carteira->vlr_desembolsado, 2, ',' , '.')}}" readonly="">
                </div>
                <div class="col col-xs-12 col-sm-4 br-input">
                    <label for="input-default">Desbloqueado (Executado)</label>
                    <input id="vlr_desbloqueado" name="vlr_desbloqueado" type="text"
                        value="{{number_format($desbloqueios->SUM('vlr_desbloqueado'), 2, ',' , '.')}}" readonly="">
                </div>
            </div><!-- row -->

        </div>
    </div>
</div>

<span class="br-divider my-3"></span>

@if(count($empenhos)>0)
    <div class="card">  
        <div class="card-header text-white text-green-50 bg-green-10">
            <strong>Empenhos</strong>
        </div>      
        <div class="card-body">
            <div class="form-group">
                @include('modulo_carteira_investimento.form_aux_empenhos')
            
            </div>
        </div>
    </div>
    <span class="br-divider my-3"></span>
@endif

@if(count($desembolsos)>0)
<div class="card">  
        <div class="card-header text-white text-green-50 bg-green-10">
            <strong>Desembolsos</strong>
        </div>  
        <div class="card">        
            <div class="card-body">
                <div class="form-group">
                    @include('modulo_carteira_investimento.form_aux_desembolsos')
                
                </div>
            </div>
        </div>
</div> 
@endif

@if(count($desembolsos)>0)
<div class="card">  
        <div class="card-header text-white text-green-50 bg-green-10">
            <strong>Desbloqueios</strong>
        </div>  
        <div class="card">        
            <div class="card-body">
                <div class="form-group">
                    @include('modulo_carteira_investimento.form_aux_desbloqueios')
                
                </div>
            </div>
        </div>
</div>
@endif
