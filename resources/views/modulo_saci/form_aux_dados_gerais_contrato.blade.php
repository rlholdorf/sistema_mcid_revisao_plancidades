<div id="dados-gerais-contrato" >
    
    <div class="row">
        <div class="col col-md-5">
            <div class="card" >
                <div class="card-header text-white text-blue-50 bg-blue-10">
                    <strong>Dados do Termo de Compromisso</strong>
                  </div>
                <div class="card-body">      
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-9">
                                <label>Execução Orçamentária (% Empenhado)</label>
                               
                                <div id="w0" class="progress-striped progress">
                                    <div class="progress-bar-success progress-bar" role="progressbar" aria-valuenow="{{$contratoPAC->prc_empenhado}}" aria-valuemin="0" aria-valuemax="100" style="width:{{$contratoPAC->prc_empenhado}}%"><span class="sr-only">{{number_format( ($contratoPAC->prc_empenhado), 2, ',' , '.')}}% Complete</span></div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <h3 style="text-align:right;">{{number_format( ($contratoPAC->prc_empenhado), 2, ',' , '.')}}%</h3>
                            </div>
                            <div class="col-md-9">
                                <label>Execução Financeira (% Financeiro)</label>
                                <div id="w1" class="progress-striped progress">
                                    <div class="progress-bar-success progress-bar" role="progressbar" aria-valuenow="{{$contratoPAC->prc_liberado}}" aria-valuemin="0" aria-valuemax="100" style="width:{{$contratoPAC->prc_liberado}}%"><span class="sr-only">{{number_format( ($contratoPAC->prc_liberado), 2, ',' , '.')}}% Complete</span></div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <h3 style="text-align:right;">{{number_format( ($contratoPAC->prc_liberado), 2, ',' , '.')}}%</h3>
                            </div>
                            <div class="col-md-9">
                                <label>Execução Física da Obra (% Físico)</label>
                                <div id="w2" class="progress-striped progress">
                                    <div class="progress-bar-info progress-bar" role="progressbar" aria-valuenow="{{$contratoPAC->prc_execucao}}" aria-valuemin="0" aria-valuemax="100" style="width:{{$contratoPAC->prc_execucao}}%"><span class="sr-only">{{number_format( ($contratoPAC->prc_execucao), 2, ',' , '.')}}% Complete</span></div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <h3 style="text-align:right;">{{number_format( ($contratoPAC->prc_execucao), 2, ',' , '.')}} %</h3>
                            </div>
                            <div class="col-md-9">
                                <label>Execução Financeira do Trabalho Social (% TTS)</label>
                                <div id="w3" class="progress-striped progress">
                                    <div class="progress-bar-warning progress-bar" role="progressbar" aria-valuenow="87.45" aria-valuemin="0" aria-valuemax="100" style="width:87.45%"><span class="sr-only">87.45% Complete</span></div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <h3 style="text-align:right;">
                                    87,45 %                                    
                                </h3>
                            </div>
                            <div class="col-md-9">
                                <label>Total desbloqueado (% desbloqueado - Repasse + Contrapartida)</label>
                                <div id="w4" class="progress-striped progress">
                                    <div class="blue progress-bar" role="progressbar" aria-valuenow="{{$contratoPAC->prc_desbloqueado}}" aria-valuemin="0" aria-valuemax="100" style="width:{{$contratoPAC->prc_desbloqueado}}%"><span class="sr-only">{{number_format( ($contratoPAC->prc_desbloqueado), 2, ',' , '.')}}% Complete</span></div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <h3 style="text-align:right;">{{number_format( ($contratoPAC->prc_desbloqueado), 2, ',' , '.')}} %</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- Card Dados do Termo de Compromisso -->
            <div class="card" >
                <div class="card-header text-white text-blue-50 bg-blue-10">
                    <strong>Indicadores de Execução Média</strong>
                  </div>
                <div class="card-body">      
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col col-sm-6">
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- Card Indicadores de Execução Média -->
            <div class="card" >
                <div class="card-header text-white text-blue-50 bg-blue-10">
                    <strong>Desempenho de Execução (EXEC)</strong>
                  </div>
                <div class="card-body">      
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col col-sm-6">
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- Card Desempenho de Execução (EXEC) -->
            <div class="card" >
                <div class="card-header text-white text-blue-50 bg-blue-10">
                    <strong>Resumo Gerencial</strong>
                  </div>
                <div class="card-body">      
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col col-sm-6">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- Resumo Gerencial -->
        <div class="col col-md-4">
            <div class="card" >
                <div class="card-header text-white text-blue-50 bg-blue-10">
                    <strong>Execução</strong>
                  </div>
                <div class="card-body">      
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col col-sm-6">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col col-md-3">
            <div class="card" >
                <div class="card-header text-white text-blue-50 bg-blue-10">
                    <strong>Calendário</strong>
                  </div>
                <div class="card-body">      
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col col-sm-6">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>