

    @extends('layouts.app')

    @section('scriptscss')
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/custom.css')}}"  media="screen" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/relatorio_executivo.css') }}"  media="screen" > 
    
    @endsection
    
    @section('content')   
    
        <historico-navegacao :url="'{{ url('/home') }}'" 
            :telanterior01="'Debentures'"
            :telanterior02="'Consultar projetos debentures'"
            :telatual="'Dados do Projeto'">        
        </historico-navegacao>
        
    
        <div class="main-content pl-sm-3 mt-5 container-fluid" id="main-content">
    
            <cabecalho-relatorios
                titulo="Carta Consulta: {{$projetoDebenture->cod_carta_consulta}}"          
                :subtitulo1="'{{$projetoDebenture->txt_modalidade_projeto}}'"   
                :subtitulo2="'{{$projetoDebenture->num_ano_cadastramento}}'"   
                :subtitulo3="'{{$projetoDebenture->txt_normativo_enquadramento}}'"                   
                @if($projetoDebenture->updated_at)
                    :dataatualizacao="'{{date('d/m/Y',strtotime($projetoDebenture->updated_at))}}'"               
                @elseif($projetoDebenture->created_at)
                    :dataatualizacao="'{{date('d/m/Y',strtotime($projetoDebenture->created_at))}}'"               
                @endif
                barracompartilhar="true"
                >
        
                <div class="text-center">
                    @if($projetoDebenture->situacao_enquadramento_id == 2 || $projetoDebenture->situacao_enquadramento_id == 4)
                        <span class="feedback warning" role="alert">
                            <i class="fas fa-exclamation-triangle" aria-hidden="true"></i>{{$projetoDebenture->txt_situacao_enquadramento}}
                        </span>
                    @elseif($projetoDebenture->situacao_enquadramento_id == 3 || $projetoDebenture->situacao_enquadramento_id == 6)
                        <span class="feedback danger" role="alert">
                            <i class="fas fa-times-circle" aria-hidden="true"></i>{{$projetoDebenture->txt_situacao_enquadramento}}
                        </span>
                    @elseif($projetoDebenture->situacao_enquadramento_id == 5)
                        <span class="feedback success" role="alert">
                            <i class="fas fa-check-circle" aria-hidden="true"></i>{{$projetoDebenture->txt_situacao_enquadramento}}
                        </span>
                    @else 
                        <span class="feedback info" role="alert">
                            <i class="fas fa-info-circle" aria-hidden="true"></i>{{$projetoDebenture->txt_situacao_enquadramento}}
                        </span>
                    @endif
                </div>
            </cabecalho-relatorios> 

    <div class="form-group">          
        <div class="card">
            <div class="card-header bg-indigo-cool-vivid-80 text-white">Dados do projeto</div>
            <div class="card-body">
                <form class="form-horizontal" role="form" method="POST" action='{{ url("apis/debenture/enquadramento/atualizar/") }}'>         
                    {{ csrf_field() }}
                    <input type="hidden" id="projeto_debenture_id" name="projeto_debenture_id" value="{{$projetoDebenture->projeto_debenture_id}}">
                            
                    <editar-enquadramento
                        :url="'{{ url("/")}}'" 
                        v-bind:dados="{{json_encode($projetoDebenture)}}" >
                    </editar-enquadramento>
                    <div class="p-3 text-right">      
                        <button class="br-button primary mr-3" type="submit" name="Salvar Edição">Salvar 
                        </button>           
    
                        <button class="br-button danger mr-3" type="button" onclick="window.location.href='/apis/debentures/{{$projetoDebenture->projeto_debenture_id}}'">Voltar
                        </button>
                    </div> 
            </form>
            </div><!--card-body-->
        </div>  <!--card-->      
    </div><!--form-group-->

</div>
@endsection