<div class="br-card">
    <div class="card-header ">
        <div class="d-flex">
            <span class="br-avatar mt-1" title="Situação">
                <span class="content">
                    <img src='{{ URL::asset("/img/icones/relatorios.png  ")}}' alt="Imagem ilustrativa" />
                </span>
            </span>
            <div class="ml-3">
                <div class="text-weight-semi-bold text-up-02">Resumo da Carteira de Investimento</div>
                <div>
                    Secretaria
                </div>
            </div>
            <div class="ml-auto">

            </div>
        </div>
    </div>
    <!--card-header  -->
    <div class="card-content">
        <div class="row">


            <div class="table-responsive">
                <table class="table table-sm border-light">
                    <thead>
                        <tr class="text-center table-primary">
                            <th class="text-center  align-middle" rowspan="2">Secretaria</th>
                            <th class="text-center" colspan="2">Transferegov</th>
                            <th class="text-center" colspan="2">DB Gestores</th>
                            <th class="text-center" colspan="2">FGTS</th>
                            <th class="text-center" colspan="2">MCMV</th>
                            <th class="text-center" colspan="2">BNDES</th>
                            <th class="text-center  align-middle" colspan="3">TOTAL</th>
                        </tr>
                        <tr>
                            <th class="text-center table-primary">Ativos</th>
                            <th class="text-center table-primary">Inativo</th>
                            <th class="text-center table-primary">Ativos</th>
                            <th class="text-center table-primary">Inativo</th>
                            <th class="text-center table-primary">Ativos</th>
                            <th class="text-center table-primary">Inativo</th>
                            <th class="text-center table-primary">Ativos</th>
                            <th class="text-center table-primary">Inativo</th>
                            <th class="text-center table-primary">Ativos</th>
                            <th class="text-center table-primary">Inativo</th>
                            <th class="text-center table-primary">Ativos</th>
                            <th class="text-center table-primary">Inativo</th>
                            <th class="text-center table-primary">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($resumoSecretaria as $dados)

                        <tr class="text-center">

                            <td class="text-center">
                                @if($dados->txt_sigla_secretaria == 'NÃO INFORMADA')
                                    <a href='{{ url("/carteira_investimento/constratos/secretarias/nao_informadas") }}' target="_blank" rel="nofollow"> {{$dados->txt_sigla_secretaria}}</a>
                                @else
                                    {{$dados->txt_sigla_secretaria}}
                                @endif
                            </td>
                            <td class="text-center">
                                {{number_format($dados->num_contratos_ativos_transferegov, 0, ',' , '.')}}
                            </td>
                            <td class="text-center">
                                {{number_format($dados->num_contratos_inativos_transferegov, 0, ',' , '.')}}
                            </td>
                            <td class="text-center">
                                {{number_format($dados->num_contratos_ativos_db_gestores, 0, ',' , '.')}}
                            </td>
                            <td class="text-center">
                                {{number_format($dados->num_contratos_inativos_db_gestores, 0, ',' , '.')}}
                            </td>
                            <td class="text-center">{{number_format($dados->num_contratos_ativos_fgts, 0, ',' , '.')}}
                            </td>
                            <td class="text-center">{{number_format($dados->num_contratos_inativos_fgts, 0, ',' , '.')}}
                            </td>
                            <td class="text-center">{{number_format($dados->num_contratos_ativos_mcmv, 0, ',' , '.')}}
                            </td>
                            <td class="text-center">{{number_format($dados->num_contratos_inativos_mcmv, 0, ',' , '.')}}
                            </td>
                            <td class="text-center">{{number_format($dados->num_contratos_ativos_bndes, 0, ',' , '.')}}
                            </td>
                            <td class="text-center">
                                {{number_format($dados->num_contratos_inativos_bndes, 0, ',' , '.')}}
                            </td>
                            <td class="text-center border-secondary bg-gray-10">{{number_format($dados->num_contratos_ativos, 0, ',' , '.')}}</td>
                            <td class="text-center border-secondary bg-gray-10">{{number_format($dados->num_contratos_inativos, 0, ',' , '.')}}</td>
                            <td class="text-center border-secondary bg-gray-10">{{number_format($dados->num_contratos, 0, ',' , '.')}}</td>

                        </tr>
                        @endforeach
                        <tr class="text-center totalFaixa">
                            <td class="text-center tabelaNumero">SUBTOTAL</td>
                            <td class="text-center tabelaNumero">
                                {{number_format($resumoTipoInstrumento->SUM('num_contratos_ativos_transferegov'), 0, ',' , '.')}}
                            </td>
                            <td class="text-center tabelaNumero">
                                {{number_format($resumoTipoInstrumento->SUM('num_contratos_inativos_transferegov'), 0, ',' , '.')}}
                            </td>
                            <td class="text-center tabelaNumero">
                                {{number_format($resumoTipoInstrumento->SUM('num_contratos_ativos_db_gestores'), 0, ',' , '.')}}
                            </td>
                            <td class="text-center tabelaNumero">
                                {{number_format($resumoTipoInstrumento->SUM('num_contratos_inativos_db_gestores'), 0, ',' , '.')}}
                            </td>
                            <td class="text-center tabelaNumero">
                                {{number_format($resumoTipoInstrumento->SUM('num_contratos_ativos_fgts'), 0, ',' , '.')}}
                            </td>
                            <td class="text-center tabelaNumero">
                                {{number_format($resumoTipoInstrumento->SUM('num_contratos_inativos_fgts'), 0, ',' , '.')}}
                            </td>
                            <td class="text-center tabelaNumero">
                                {{number_format($resumoTipoInstrumento->SUM('num_contratos_ativos_mcmv'), 0, ',' , '.')}}
                            </td>
                            <td class="text-center tabelaNumero">
                                {{number_format($resumoTipoInstrumento->SUM('num_contratos_inativos_mcmv'), 0, ',' , '.')}}
                            </td>
                            <td class="text-center tabelaNumero">
                                {{number_format($resumoTipoInstrumento->SUM('num_contratos_ativos_bndes'), 0, ',' , '.')}}
                            </td>
                            <td class="text-center tabelaNumero">
                                {{number_format($resumoTipoInstrumento->SUM('num_contratos_inativos_bndes'), 0, ',' , '.')}}
                            </td>
                            <td class="text-center">
                                {{number_format($resumoTipoInstrumento->SUM('num_contratos_ativos'), 0, ',' , '.')}}
                            </td>
                            <td class="text-center">
                                {{number_format($resumoTipoInstrumento->SUM('num_contratos_inativos'), 0, ',' , '.')}}
                            </td>
                            <td class="text-center">
                                {{number_format($resumoTipoInstrumento->SUM('num_contratos'), 0, ',' , '.')}}
                            </td>
                        </tr>
                        <tr class="text-center total">
                            <td class="text-center tabelaNumero">TOTAL</td>
                            <td class="text-center tabelaNumero" colspan="2">
                                {{number_format($resumoTipoInstrumento->SUM('num_contratos_ativos_transferegov')+$resumoTipoInstrumento->SUM('num_contratos_inativos_transferegov'), 0, ',' , '.')}}
                            </td>
                            <td class="text-center tabelaNumero" colspan="2">
                                {{number_format($resumoTipoInstrumento->SUM('num_contratos_ativos_db_gestores')+$resumoTipoInstrumento->SUM('num_contratos_inativos_db_gestores'), 0, ',' , '.')}}
                            </td>
                            <td class="text-center tabelaNumero" colspan="2">
                                {{number_format($resumoTipoInstrumento->SUM('num_contratos_ativos_fgts')+$resumoTipoInstrumento->SUM('num_contratos_inativos_fgts'), 0, ',' , '.')}}
                            </td>
                            <td class="text-center tabelaNumero" colspan="2">
                                {{number_format($resumoTipoInstrumento->SUM('num_contratos_ativos_mcmv')+$resumoTipoInstrumento->SUM('num_contratos_inativos_mcmv'), 0, ',' , '.')}}
                            </td>
                            <td class="text-center tabelaNumero" colspan="2">
                                {{number_format($resumoTipoInstrumento->SUM('num_contratos_ativos_bndes')+$resumoTipoInstrumento->SUM('num_contratos_inativos_bndes'), 0, ',' , '.')}}
                            </td>
                            <td class="text-center tabelaNumero">
                                {{number_format($resumoTipoInstrumento->SUM('num_contratos_ativos'), 0, ',' , '.')}}
                            </td>
                            <td class="text-center tabelaNumero">
                                {{number_format($resumoTipoInstrumento->SUM('num_contratos_inativos'), 0, ',' , '.')}}
                            </td>
                            <td class="text-center tabelaNumero">
                                {{number_format($resumoTipoInstrumento->SUM('num_contratos'), 0, ',' , '.')}}
                            </td>
                        </tr>
                    </tbody><!-- fechar tbody-->
                </table><!-- fechar table-->
            </div> <!-- table-responsive-sm -->

        </div>

    </div>
    <!--card-content  -->

</div>
<!--br-card  -->