
    <div class="br-card">
        <div class="card-header">
        <div class="d-flex"><span class="br-avatar mt-1" title="Fulano da Silva"><span class="content">
            <img height="50" width="50" src='{{ URL::asset("/img/icones/termo.png")}}' alt="Avatar"/></span></span>
            <div class="ml-3">
            <div class="text-weight-semi-bold text-up-02">
                Situação dos Ofícios 
            </div>

            <div>
                Seleção de Propostas
            </div>
            </div>
            <div class="ml-auto">
            <!--
            <button class="br-button circle" type="button" aria-label="Ícone ilustrativo"><i class="fas fa-ellipsis-v" aria-hidden="true"></i>
            </button>
        -->
            </div>
        </div>
        </div>
        <div class="card-content">            
            

            <h4>OFÍCIOS</h4>
                <div class="table-responsive">	
                    <table class="table table-bordered table-sm tab_executivo">
                        <thead>
                            <tr>
                                <th>UF</th>         
                                <th>Ofícios Enviados</th>    
                                <th>Aguardando Análise</th>                                                                                                       
                                <th>Validado</th>
                                <th>invalidado</th>
                            </tr>
                                                
                        </thead>
                        <tbody>
                            @foreach($arquivosOficio as $dados)                                        
                            <tr>                        
                                <td>{{$dados->sg_uf}}</td>
                                <td class="text-center">{{number_format( ($dados->num_oficios), 0, ',' , '.')}}</td>
                                <td class="text-center">{{number_format( ($dados->num_aguardando_analise), 0, ',' , '.')}}</td>
                                <td class="text-center">{{number_format( ($dados->num_validado), 0, ',' , '.')}}</td>
                                <td class="text-center">{{number_format( ($dados->num_invalidado), 0, ',' , '.')}}</td>
                            </tr>   
                                   
                            @endforeach  
                            <tr class="total text-weight-semi-bold">                         
                                <td class="text-center">TOTAL</td>
                                <td class="text-center">{{number_format( ($totalOficios['total_oficios']), 0, ',' , '.')}}</td>    
                                <td class="text-center">{{number_format( ($totalOficios['total_num_aguardando_analise']), 0, ',' , '.')}}</td>                                    
                                <td class="text-center">{{number_format( ($totalOficios['total_num_validado']), 0, ',' , '.')}}</td>                                 
                                <td class="text-center">{{number_format( ($totalOficios['total_num_invalidado']), 0, ',' , '.')}}</td>   
                            </tr>                                         
                            
                        </tbody>
                    </table>     
                </div><!-- fim table-responsive-->

           
            

        </div>
        <div class="card-footer">
        <div class="d-flex" style="padding-top: 10px;"> 

                           
                                     
                <button type="button" class="br-button block secondary mr-3" aria-label="Ícone ilustrativo" onclick="window.location.href='/admin/ente_publico/oficios/consultar'">
                    <i class="fas fa-edit" aria-hidden="true"></i>Validar Ofícios
                </button>                          
        
        </div>
        </div>                  
    </div><!-- br-card -->