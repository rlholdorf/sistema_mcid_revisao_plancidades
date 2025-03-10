<div class="card">

    <div class="card-body">
        <div class="form-group">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Data</th>
                            <th>Observação</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($contratoPac->observacoesContratos as $dados)
                        <tr class="text-center">
                            <td>
                                @if($dados->dte_observacao)
                                    {{date('d/m/Y',strtotime($dados->dte_observacao))}}
                                @elseif($dados->dte_overwrite)
                                    {{date('d/m/Y',strtotime($dados->dte_overwrite))}}
                                @else
                                    {{date('d/m/Y',strtotime($dados->dte_creation))}}
                                @endif
                            <td>
                                {{$dados->dsc_obs_contrato}}
                                @if($dados->txt_info_complementares)</br>{{$dados->txt_info_complementares}} @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div><!-- div table 1-->
        </div>
    </div><!-- card-body -->
</div>