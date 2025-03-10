<div class="row">
            <div class="col col-xs-12 col-sm-12 br-textarea input-highligh">        
                <p><strong>1. Objeto da Intervenção</strong></p>
                <textarea  id="input-highlight-labeless" placeholder="Placeholder" >{{$proposta->dsc_obj_intervencao}}</textarea>
                 <span class="br-divider my-3">
            </div>    
           
        </div><!-- div row -->
        <div class="row">
            <div class="col col-xs-12 col-sm-12 br-input input-highlight">        
                <p><strong>2. Valor da Intervenção</strong></p>
                <input id="input-highlight-labeless" type="text" placeholder="Placeholder" value="{{number_format( ($proposta->vlr_intervencao), 2, ',' , '.')}}" />
                 <span class="br-divider my-3">
            </div>    
           
        </div><!-- div row -->
        <div class="row">
            <div class="col col-xs-12 col-sm-12 br-textarea input-highlight">        
                <p><strong>3. Justificativa da importância da intervenção</strong></p>
                <textarea id="input-highlight-labeless" type="text" placeholder="Placeholder">{{$proposta->dsc_justificativa}}</textarea>
                <span class="br-divider my-3">
            </div>   
           
        </div><!-- div row -->
        <div class="row">
            <div class="col col-xs-12 col-sm-12 br-textarea input-highlight">        
                <p><strong>4. Descrição do problema a ser resolvido</strong></p>
                <textarea id="input-highlight-labeless" type="text" placeholder="Placeholder">{{$proposta->dsc_problema_resolver}}</textarea>
                
                <span class="br-divider my-3">
            </div>    
           
        </div><!-- div row -->
        <div class="row">
            <div class="col col-xs-12 col-sm-12 br-textarea input-highlight">        
                <p><strong>5. Benefícios da intervenção quanto aos aspectos urbano e de empregabilidade</strong></p>
                <textarea id="input-highlight-labeless" type="text" placeholder="Placeholder">{{$proposta->dsc_beneficios_intervencao}}</textarea>
                <span class="br-divider my-3">
            </div>    
           
        </div><!-- div row -->
        <div class="row">
            <div class="col col-xs-12 col-sm-12 br-input input-highlight">        
                <p><strong>6. O projeto básico referente à intervenção já está elaborado?</strong></p>
                <input id="input-highlight-labeless" type="text" placeholder="Placeholder" value="@if($proposta->bln_projeto_basico) Sim @else Não @endif"/>
                 <span class="br-divider my-3">
            </div>    
           
        </div><!-- div row -->
        <div class="row">
            <div class="col col-xs-12 col-sm-12 br-input input-highlight">        
                <p><strong>7. O projeto básico contempla aspectos relacionados ao desenvolvimento sustentável e acessibilidade?</strong></p>
                <input id="input-highlight-labeless" type="text" placeholder="Placeholder" value="@if($proposta->bln_pb_acessibilidade) Sim @else Não @endif"/>
                 <span class="br-divider my-3">
            </div>    
           
        </div><!-- div row -->
        @if($proposta->bln_propostas_recebidas_sistema)
            <div class="row">
                <div class="col col-xs-12 col-sm-12 br-input input-highlight">        
                    <p><strong>8. Itens financiáveis das ações orçamentárias do programa de Mobilidade urbana previstos no projeto básico:</strong></p>
                    
                </div>    
                
            </div><!-- div row -->
            <div class="br-list" role="list">
                @foreach($itensFinanciveis as $dados)
                    <div class="br-item" role="listitem">
                        <div class="row align-items-center">
                           
                            <div class="col">
                                <li>{{$dados->acao}} - {{$dados->txt_acao_programa}} / {{$dados->txt_item_financiavel}}  </li>
                            </div>
                        
                        </div>
                    </div>                
                @endforeach    
              </div>
              <span class="br-divider my-3"></span>
              <div class="row">
                <div class="col col-xs-12 col-sm-12 br-input input-highlight">        
                    <p><strong>9. Plano de mobilidade urbana aprovado ou com minuta concluída na Plataforma do Ministério das Cidades?</strong></p>
                    <input id="input-highlight-labeless" type="text" placeholder="Placeholder" value="@if($proposta->bln_plano_mobilidade_aprovado) Sim @else Não @endif"/>
                     <span class="br-divider my-3">
                </div>    
               
            </div><!-- div row -->
        @else
            <span class="br-divider md my-3"></span>
              <div class="row">
                <div class="col col-xs-12 col-sm-12 br-input input-highlight">        
                    <p><strong>8. Plano de mobilidade urbana aprovado ou com minuta concluída na Plataforma do Ministério das Cidades?</strong></p>
                    <input id="input-highlight-labeless" type="text" placeholder="Placeholder" value="@if($proposta->bln_plano_mobilidade_aprovado) Sim @else Não @endif"/>
                </div>    
                
            </div><!-- div row -->
        @endif
        