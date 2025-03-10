@extends('layouts.app') 

@section('scripts')
    <link href="{{ asset('css/fontastic.css') }}" rel="stylesheet">
    
    
    
@endsection 


@section('content')



<div id="viewlet-above-content-title"></div>

<div class="linha-separa"></div>
<div id="content"> 
<solicitar-adesao  
    id="formregistro" 
    css="" 
    action='{{ url("/proposta/ente_publico/salvar") }}' 
    url='{{ url("/") }}' 
    metodo="post" 
    enctype="multipart/form-data" 
    token="{{ csrf_token() }}"
    @if ($errors->has('estado'))  estadoselecionado ="{{ old('estado') }}" @endif
    @if ($errors->has('municipio'))  municipioselecionado ="{{ old('municipio') }}" @endif
    
    >
                  

<!--SLOT -->
        
        
       
            
               
        <!--fim row-->
        
        
        <div class="row">  
            <div class="column col-xs-12 col-md-4">
                <label for="cnpj">CNPJ</label>   
                <input type="text" 
                    name="txt_cnpj"   
                    class="form-control"   
                    maxlength="14" 
                    value="{{ old('txt_cnpj') }}" >

                @if ($errors->has('txt_cnpj'))
                    <span class="feedback danger" role="alert">
                        <i class="fas fa-times-circle" aria-hidden="true"></i>{{ $errors->first('txt_cnpj') }}
                    </span>
                @endif
            </div>
            <div class="column col-xs-12 col-md-8">
                <label for="nome_proponente">Proponente (Estado, DF ou Município)
                </label>   
                <input type="text" 
                    name="txt_nome_proponente"   
                    class="form-control"   
                    value="{{ old('txt_nome_proponente') }}" >

                @if ($errors->has('txt_nome_proponente'))
                    <span class="feedback danger" role="alert">
                        <i class="fas fa-times-circle" aria-hidden="true"></i>{{ $errors->first('txt_nome_proponente') }}
                    </span>
                @endif
            </div>
        </div>
        <!--fim row-->
        <div class="row">
            <div class="column col-xs-12 col-md-12">
                <label class="control-label ">Email Institucional do Proponente</label>
                <input id="txt_email_ente_publico" type="email" class="form-control" 
                    name="txt_email_ente_publico" value="{{ old('txt_email_ente_publico') }}"  >


                @if ($errors->has('txt_email_ente_publico'))
                    <span class="feedback danger" role="alert">
                        <i class="fas fa-times-circle" aria-hidden="true"></i>{{ $errors->first('txt_email_ente_publico') }}
                    </span>
                @endif
            </div>
        </div>

        
        
         <div class="row">  
            <div class="column col-xs-12 col-md-6">
                <label for="cargo_executivo">Cargo autoridade máxima</label>           
                <select 
                    id="cargo_executivo"
                     class="form-select br-select"  
                    name="cargo_executivo"               
                    value="{{ old('cargo_executivo') }}" 
                    >
                    <option value="">Escolha um cargo:</option>
                    <option value="Governador" @if(old('cargo_executivo') == "Governador") selected @endif>Governador</option>
                    <option value="Prefeito" @if(old('cargo_executivo') == "Prefeito") selected @endif>Prefeito</option>                                
                    <option value="Presidente" @if(old('cargo_executivo') == "Presidente") selected @endif>Presidente</option>                        
                </select>                             
                @if ($errors->has('cargo_executivo'))
                    <span class="feedback danger" role="alert">
                        <i class="fas fa-times-circle" aria-hidden="true"></i>{{ $errors->first('cargo_executivo') }}
                    </span>
                @endif  
            </div>
            <div class="column col-xs-12 col-md-6">
                <label for="nome_chefe_executivo">Nome da Autoridade</label>   
                <input type="text" 
                    name="txt_nome_chefe_executivo"  
                    class="form-control"   
                    value="{{ old('txt_nome_chefe_executivo') }}" >

                @if ($errors->has('txt_nome_chefe_executivo'))
                    <span class="feedback danger" role="alert">
                        <i class="fas fa-times-circle" aria-hidden="true"></i>{{ $errors->first('txt_nome_chefe_executivo') }}
                    </span>
                @endif
            </div>   
        </div>
        <!--fim row-->
       
           
                <div class="titulo">
                    <h5>Dados do responsável pelo preenchimento do formulário</h5> 
                </div>          
                <div class="row">  
                    <div class="column col-xs-12 col-md-6">
                        <label for="nome">Nome</label>   
                        <input type="text" 
                                name="txt_nome"  
                                class="form-control" 
                                value="{{ old('txt_nome') }}" >

                        @if ($errors->has('txt_nome'))
                            <span class="feedback danger" role="alert">
                                <i class="fas fa-times-circle" aria-hidden="true"></i>{{ $errors->first('txt_nome') }}
                            </span>
                        @endif
                    </div>
                     
                    <div class="column col-xs-12 col-md-6">
                        <label for="sobrenome">Sobrenome</label>   
                        <input type="text" 
                            name="txt_sobrenome"  
                            class="form-control" 
                           value="{{ old('txt_sobrenome') }}" >

                        @if ($errors->has('txt_sobrenome'))
                            <span class="feedback danger" role="alert">
                                <i class="fas fa-times-circle" aria-hidden="true"></i>{{ $errors->first('txt_sobrenome') }}
                            </span>
                        @endif
                    </div>
                </div>
                <!--fim row-->
                <div class="row">  
                    <div class="column col-xs-12 col-md-6">
                        <label for="cpf">CPF</label>   
                        <input type="text" 
                            name="txt_cpf_usuario"   
                            id="txt_cpf_usuario"   
                            class="form-control"  
                            maxlength="11" 
                            value="{{ old('txt_cpf_usuario') }}" >

                        @if ($errors->has('txt_cpf_usuario'))
                            <span class="feedback danger" role="alert">
                                <i class="fas fa-times-circle" aria-hidden="true"></i>{{ $errors->first('txt_cpf_usuario') }}
                            </span>
                        @endif
                    </div>
               
                    <div class="column col-xs-12 col-md-6">
                        <label for="cargo">Cargo</label>   
                        <input type="text" 
                            name="txt_cargo"   
                            class="form-control"   
                            value="{{ old('txt_cargo') }}" >

                        @if ($errors->has('txt_cargo'))
                            <span class="feedback danger" role="alert">
                                <i class="fas fa-times-circle" aria-hidden="true"></i>{{ $errors->first('txt_cargo') }}
                            </span>
                        @endif
                    </div>
                </div>
                <!--fim row-->
                
                <div class="row">  
                    <div class="column col-xs-12 col-md-4">
                        <label for="ddd">DDD</label>   
                        <input type="text" 
                            name="txt_ddd"   
                            class="form-control"   
                            value="{{ old('txt_ddd') }}" 
                            maxlength="2">

                        @if ($errors->has('txt_ddd'))
                            <span class="feedback danger" role="alert">
                                <i class="fas fa-times-circle" aria-hidden="true"></i>{{ $errors->first('txt_ddd') }}
                            </span>
                        @endif
                    </div>
                    <div class="column col-xs-12 col-md-8">
                        <label for="telefone">Telefone</label>   
                        <input type="text" 
                            name="txt_telefone"   
                            class="form-control"   
                            value="{{ old('txt_telefone') }}" 
                            maxlength="10">

                        @if ($errors->has('txt_telefone'))
                            <span class="feedback danger" role="alert">
                                <i class="fas fa-times-circle" aria-hidden="true"></i>{{ $errors->first('txt_telefone') }}
                            </span>
                        @endif
                    </div>
                
                    
                </div>
                <!--fim row-->
                <div class="row">  
                    <div class="column col-xs-12 col-md-12">
                        <label for="email">Email</label>   
                        <input type="email" 
                            id="email"   
                            name="email"   
                            class="form-control"   
                            value="{{ old('email') }}" >

                        @if ($errors->has('email'))
                            <span class="feedback danger" role="alert">
                                <i class="fas fa-times-circle" aria-hidden="true"></i>{{ $errors->first('email') }}
                            </span>
                        @endif
                    </div>
                </div>
                <!--fim row-->  
                
<!--FIM SLOT -->                    
 <!--fim row-->
   
      
</solicitar-adesao>   
                       
                
               

</div>
<!-- content-->



@endsection