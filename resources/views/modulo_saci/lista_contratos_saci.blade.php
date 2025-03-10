@extends('layouts.app')

@section('scriptscss')
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/custom.css')}}"  media="screen" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/relatorio_executivo.css') }}"  media="screen" > 
@endsection


@section('content')

<historico-navegacao
      :url="'{{ url('/home') }}'"      
      :telanterior01="'SACI WEB'"      
      :telatual="'Lista contratos SACI'"
      >

</historico-navegacao>


<div class="main-content pl-sm-3 mt-5" id="main-content">
  
    <cabecalho-relatorios
       :titulo="'Lista contratos SACI'"
       subtitulo1="{{$contratosPAC->count()}} contratos"
       :linkcompartilhar="'{{ url("/saci/propostas/") }}'"
       barracompartilhar="true">
    </cabecalho-relatorios> 

    <div class="form-group">
        <div class="row">	
          
          <div class="table-responsive">
            <table class="table table-hover">
                 <thead>
                  <tr>
                        <th>#</th>
                       <th>Contrato</th>
                      <th>UF</th>
                      <th>Município</th>
                      <th>Fonte </th>
                      <th>Área</th>                                    				
                      <th>Fase</th>                                    				
                      <th>Programa</th>                                    				
                      <th>Monitor</th>                                    				
                      <th>Ativo</th>                                    				
                      <th>Situação Obra</th>                                    				
                      <th>%</th>                                    				
                      <th>Investimento</th>                                    				
                      <th>Repasse</th>                                    				
                      <th>Contrapartida</th>                                    				
                      <th>Ação</th>                                    				
                  </tr>
              </thead>										
              <tbody>
                  @foreach($contratosPAC as $contrato)
                      @if($contrato->cod_situacao_obra == 6 || $contrato->cod_situacao_obra == 17 || $contrato->cod_situacao_obra == 29)
                          <tr class="text-center table-success">
                      @elseif($contrato->cod_situacao_obra == 3 || $contrato->cod_situacao_obra == 19 || $contrato->cod_situacao_obra == 29)
                          <tr class="text-center table-danger">
                      @elseif($contrato->cod_situacao_obra == 2 || $contrato->cod_situacao_obra == 16 || $contrato->cod_situacao_obra == 31)
                          <tr class="text-center">
                         @else	
                             <tr class="text-center table-warning">
                      @endif	                                
                      <td>{{$loop->index+1}}</td>
                      <td>{{$contrato->cod_contrato}}</td>                                    
                      <td>{{$contrato->txt_sigla_uf}}</td>                                    
                      <td>{{$contrato->dsc_municipio}}</td>                                    
                      <td>{{$contrato->dsc_fonte}}</td>                                    
                      <td>{{$contrato->txt_sigla_area}}</td>                                    
                      <td>{{$contrato->dsc_fase}}</td>                                    
                      <td>{{$contrato->dsc_programa}}</td>                                    
                      <td>{{$contrato->monitor}}</td>                                    
                      <td>@if($contrato->bln_ativo) Sim @else Não @endif</td>                                    
                      <td>{{$contrato->dsc_situacao_obra}}</td>                                    
                      <td>{{number_format( ($contrato->prc_execucao), 0, ',' , '.')}}</td>                                    
                      <td>{{number_format( ($contrato->vlr_investimento), 2, ',' , '.')}}</td>                                    
                      <td>{{number_format( ($contrato->vlr_repasse), 2, ',' , '.')}}</td>                                    
                      <td>{{number_format( ($contrato->vlr_contrapartida), 2, ',' , '.')}}</td>                                    
                      <td>
                        <a href='{{ url("/saci/contrato/pac/$contrato->cod_contrato_pac")}}' type="button" class="btn btn-link">
                            <i class="fas fa-search"></i></a>
                    </td> 
                      
                  </tr>    
                  @endforeach                                                                    
               </tbody>	
            </table>                          
          </div><!-- div table 1-->
       </div><!-- row-->
       
  </div>	<!--/form group--> 

    

</div>

@endsection


