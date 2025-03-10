<div class="form-group">                     
        
    <div class="table-responsive-sm">
        <table class="table table-hover table-sm">
            <thead>
                <tr class="text-center" >
                    <th>Nº Nota de Empenhos</th>
                    <th>Tipo</th>
                    <th>Situação</th>
                    <th>Data de emissão</th>
                    <th>Natureza de Despesa</th>
                    <th>Fonte de recurso</th>
                    <th>Ação orçamentária</th>
                    <th>Valor</th>                
                </tr>
            </thead>
            <tbody> 
                @foreach($empenhos as $dados) 
                    @if($dados->vlr_empenho <= 0)
                        <tr class="text-center table-danger align-middle">
                    @else
                        <tr class="text-center">   
                    @endif
                            <td>{{$dados->num_nota_empenho}}</td>
                            <td>{{$dados->dsc_tipo_nota}}</td>
                            <td>{{$dados->dsc_situacao_empenho}}</td>
                            <td>{{date('d/m/Y',strtotime($dados->dte_emissao_ne))}}</td>
                            <td>{{$dados->cod_natureza_despesa}}</td>
                            <td>{{$dados->cod_fonte_recurso}}</td>
                            <td>{{$dados->cod_acao_orcamentaria}}</td>
                            <td>{{number_format($dados->vlr_empenho, 2, ',' , '.')}}</td>      
                   @endforeach
                   <tr class="text-center total">   
                    <td colspan="7" > TOTAL</td>
                    <td>{{number_format($empenhos->SUM('vlr_empenho'), 2, ',' , '.')}}</td>
                   </tr>
            </tbody><!-- fechar tbody-->
        </table><!-- fechar table-->
    </div> <!-- table-responsive-sm -->  
</div>