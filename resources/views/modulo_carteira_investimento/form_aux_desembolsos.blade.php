<div class="form-group">

    <div class="table-responsive-sm">
        <table class="table table-hover table-sm">
            <thead>
                <tr class="text-center">
                    <th>Nº Ordem Bancária</th>
                    <th>Data</th>
                    <th>Valor</th>
                </tr>
            </thead>
            <tbody>
                @foreach($desembolsos as $dados)
                    <tr class="text-center">
                        <td>{{$dados->num_ordem_bancaria}}</td>
                        <td>{{date('d/m/Y',strtotime($dados->dte_ordem_bancaria))}}</td>
                        <td>{{number_format($dados->vlr_ordem_bancaria, 2, ',' , '.')}}</td>
                        @endforeach
                    <tr class="text-center total">
                        <td colspan="2"> TOTAL</td>
                        <td>{{number_format($desembolsos->SUM('vlr_ordem_bancaria'), 2, ',' , '.')}}</td>
                    </tr>
            </tbody><!-- fechar tbody-->
        </table><!-- fechar table-->
    </div> <!-- table-responsive-sm -->
</div>