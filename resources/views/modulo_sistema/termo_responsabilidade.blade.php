@extends('layouts.app')

@section('scriptscss')
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/custom.css')}}"  media="screen" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/relatorio_executivo.css') }}"  media="screen" > 
@endsection

@section('content')

<historico-navegacao
      :url="'{{ url('/home') }}'"      
      :telanterior01="'Propostas'"  
      :telatual="'Proposta Ente'"
      >

</historico-navegacao>

<div class="main-content pl-sm-3 mt-5" id="main-content">
  
    <cabecalho-relatorios
            :titulo="'Termo de Responsabilidade'"
            subtitulo1="{{$usuario->entePublico->txt_ente_publico}}"
            subtitulo2="{{$usuario->entePublico->municipio->txt_nome_sem_acento}}-{{$usuario->entePublico->municipio->uf->txt_sigla_uf}}"
            @if($usuario->dte_aceite_termo)
                :dataatualizacao="'{{date('d/m/Y',strtotime($usuario->dte_aceite_termo))}}'"
            @else
                :dataatualizacao="'{{date('d/m/Y',strtotime($usuario->created_at))}}'"
            @endif
            :barracompartilhar="true"
                    >
                        
            </cabecalho-relatorios> 

            <form class="form-horizontal" role="form" method="POST" action='{{ url("/usuario/termo_responsabilidade/aceite") }}'>
        
                @csrf
                    <div class="form-group">
                        <p>
                            Eu, <strong>{{strtoupper($usuario->name)}}, {{strtoupper($usuario->txt_cargo)}}, nº CPF {{$usuario->txt_cpf_usuario}},</strong> declaro estar ciente da habilitação
                        que me foi conferida para manuseio de dados utilizados pelo Sistema de Gerenciamento da Habitação.
                            </p>
                            <p>
                            No tocante às atribuições a mim conferidas, no âmbito do Termo de Responsabilidade acima
                        referido, comprometo-me a:
                            </p>
                
                            <p>
                            a) manusear as bases de dados deste sistema apenas por necessidade de
                        serviço, ou em caso de determinação expressa, desde que legal, de superior hierárquico;
                            </p>
                            
                            <p>
                            b) manter a absoluta cautela quando da exibição de dados em tela, impressora, ou, ainda, na
                        gravação em meios eletrônicos, a fim de evitar que deles venham a tomar ciência pessoas não
                        autorizadas; 
                            </p>
                
                            <p>
                            c) não me ausentar do terminal sem encerrar a sessão de uso das bases, garantindo assim a
                        impossibilidade de acesso indevido por pessoas não autorizadas; e
                            </p>
                
                            
                            <p>
                            d) manter sigilo dos dados ou informações sigilosas obtidas por força de minhas atribuições,
                        abstendo-me de revelá-los ou divulgá-los, sob pena de incorrer nas sanções civis e penais
                        decorrentes de eventual divulgação. 
                            </p>
                            <br/>
                            <br/>
                            <br/>
                            <br/>
                            <p class="text-center"> {{$dataExtenso}}</p>
                         
                            <br/>
                            <br/>
                            <p class="text-center">{{strtoupper($usuario->name)}}</p> 
                            <p class="text-center">{{strtoupper($usuario->txt_cargo)}}</p>  
                            <br/>
                            <br/><br/>
                            <br/>
                </div><!-- fechar primeiro form-group-->
        
          
            
        
            @if(Auth::user()->bln_aceite_termo)
            <div class="form-group">
                        <a type="submit"  class="br-button block danger mr-3"  href='{{ url("/home")}}'>Fechar</a>
                    </div><!-- fechar quarto form-group--> 
            @else
           
        
                    <div class="form-group">
                    <div class="checkbox">
                        <label>
                        <input type="checkbox" name="termo" value="true" required>  Declaro que li e estou de acordo com o disposto nos normativos vigentes do Programa.
                        </label>
                    </div>   
                </div><!-- fechar segundo form-group-->
        
                    <div class="form-group">
                        <button type="submit" class="br-button block success mr-3" aria-label="Ícone ilustrativo">
                            <i class="fas fa-check" aria-hidden="true"></i>Aceitar Termo
                        </button> 


                    </div><!-- fechar quarto form-group-->
            @endif
                </form>

</div>
  
@endsection


