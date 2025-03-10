<div class="form-group">
    
    <div class="table-responsive-sm">
        <table class="table table-hover table-sm">
            <thead>
                <tr class="text-center">
                    @if($carteira->cod_origem == 1)
                    <th>Nº Ordem Bancária</th>
                    @endif
                    <th>Tipo</th>
                    <th>Data</th>
                    <th>Valor</th>
                </tr>
            </thead>
            <tbody>
                @foreach($desbloqueios as $dados)
                    @if($dados->cod_tipo_recurso_desbloqueio == 1)
                        <tr class="text-center">
                            @if($carteira->cod_origem == 1)
                                <td>{{$dados->num_ob_desbloqueada}}</td>
                            @endif
                            <td>{{$dados->dsc_tipo_recurso_desbloqueio}}</td>
                            <td>{{date('d/m/Y',strtotime($dados->dte_cadastro))}}</td>                    
                            <td>{{number_format($dados->vlr_desbloqueado, 2, ',' , '.')}}</td>
                            @endif
                    @endforeach
                            <tr class="text-center totalFaixa">
                                @if($carteira->cod_origem == 1)
                                    <td colspan="3" class="text-right"> 
                                @else
                                    <td colspan="2" class="text-right"> 
                                @endif
                                 Subtotal Ordem Bancária</td>
                                <td>{{number_format($desbloqueios->where('cod_tipo_recurso_desbloqueio',1)->SUM('vlr_desbloqueado'), 2, ',' , '.')}}</td>
                            </tr>
                            @foreach($desbloqueios as $dados)
                    @if($dados->cod_tipo_recurso_desbloqueio == 2)
                        <tr class="text-center">
                            @if($carteira->cod_origem == 1)
                            <td>{{$dados->num_ob_desbloqueada}}</td>
                        @endif
                            <td>{{$dados->dsc_tipo_recurso_desbloqueio}}</td>
                            <td>{{date('d/m/Y',strtotime($dados->dte_cadastro))}}</td>                    
                            <td>{{number_format($dados->vlr_desbloqueado, 2, ',' , '.')}}</td>
                            @endif
                    @endforeach        
                            <tr class="text-center totalFaixa">
                                @if($carteira->cod_origem == 1)
                                    <td colspan="3" class="text-right"> 
                                @else
                                    <td colspan="2" class="text-right"> 
                                @endif
                                    Subtotal Ingresso Contrapartida</td>
                                <td>{{number_format($desbloqueios->where('cod_tipo_recurso_desbloqueio',2)->SUM('vlr_desbloqueado'), 2, ',' , '.')}}</td>
                            </tr><tr class="text-center total">
                                @if($carteira->cod_origem == 1)
                                <td colspan="3"> TOTAL
                                @else
                                <td colspan="2"> TOTAL
                                @endif
                               </td>
                                <td>{{number_format($desbloqueios->SUM('vlr_desbloqueado'), 2, ',' , '.')}}</td>
                            </tr>
                            
            </tbody><!-- fechar tbody-->
        </table><!-- fechar table-->
    </div> <!-- table-responsive-sm -->
</div>