@extends('layouts.app')

@section('scriptscss')
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/custom.css')}}"  media="screen" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/relatorio_executivo.css') }}"  media="screen" > 
@endsection


@section('content')

<historico-navegacao
      :url="'{{ url('/home') }}'"      
      :telanterior01="'Balanço Pac'"      
      :telatual="'Lista contratos Balanço Pac'"
      >

</historico-navegacao>


<div class="main-content pl-sm-3 mt-5" id="main-content">
  
    <cabecalho-relatorios
       :titulo="'Lista contratos Balanço Pac'"
       subtitulo1="{{$balancoPac->count()}} contratos"
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
                        <th>Região</th>
                        <th>UF</th>
                        <th>Município</th>
                        <th>Contrato</th>
                        <th>Convênio</th>
                        <th>Nº Proposta</th>                                    				
                        <th>Fase</th>                                    				                       
                        <th>Tomador</th>
                        <th>Subfonte </th>
                        <th>Nome Empreendimento</th>                                    				
                        <th>Secretaria</th>                                    				
                        <th>Origem</th>                                    				
                        <th>Situação Obra</th>                                    				
                        <th>Ação</th>                                    				
                  </tr>
              </thead>										
              <tbody>
                  @foreach($balancoPac as $contrato)
                      
                  @if($contrato->dsc_situacao_objeto_mcid == '"CONCLUIDA"')
                        <tr class="text-center table-success">
                    @elseif($contrato->dsc_situacao_objeto_mcid == '"NAO INICIADA"')
                        <tr class="text-center table-warning">
                    @elseif($contrato->dsc_situacao_objeto_mcid == 'ATRASADA' || $contrato->dsc_situacao_objeto_mcid == 'PARALISADA')
                        <tr class="text-center table-danger">
                        @else	
                        <tr class="text-center">
                    @endif
                     <td>{{$loop->index+1}}</td>
                     <td>{{$contrato->regiao}}</td>                                    
                      <td>{{$contrato->uf}}</td>    
                      <td>{{$contrato->municipio}}</td>         
                      <td>{{$contrato->cod_contrato}}</td>                                    
                      <td>{{$contrato->num_convenio}}</td>                                    
                      <td>{{$contrato->num_proposta}}</td>                                    
                      <td>{{$contrato->txt_fase_pac}}</td>      
                      <td>{{$contrato->tomador_agrupado}}</td>                                    
                      <td>{{$contrato->txt_sub_fonte}}</td>                                    
                      <td>{{$contrato->nome_empreendimento}}</td>                                 
                      <td>{{$contrato->secretaria}}</td>                                    
                      <td>{{$contrato->txt_origem}}</td>                                    
                      <td>{{$contrato->dsc_situacao_objeto_mcid}}</td>                                  
                      <td>
                        <a href='{{ url("/pac/contrato/$contrato->cod_contrato")}}' type="button" class="btn btn-link">
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


