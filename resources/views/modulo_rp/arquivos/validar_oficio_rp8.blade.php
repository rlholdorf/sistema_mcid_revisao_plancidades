@extends('layouts.app')



@section('content')



<historico-navegacao :url="'{{ url('/home') }}'" 
        :telanterior01="'Resultado Primário'" 
        :telanterior02="'Arquivos'" 
        :telatual="'Validar Ofício RP8'">

</historico-navegacao>

<cabecalho-relatorios
    :titulo="'{{$oficioEmendas->txt_num_oficio_completo_congresso}}'"   
    :subtitulo1="'{{$oficioEmendas->txt_casa_legislativa}}'"            
    :subtitulo2="'{{$oficioEmendas->txt_comissao}}'"            
    :subtitulo3="'{{$oficioEmendas->txt_presidente}}'"  
    :subtitulo4="'{{$oficioEmendas->cod_programa}} - {{$oficioEmendas->txt_nome_programa}}'"  
    
    
    :linkcompartilhar="'{{ url("/rp/arquivo/validar/rp8/oficio//$oficioEmendas->id") }}'"
    :barracompartilhar="true">

    <div class="text-center">
        @if($oficioEmendas->situacao_oficio_id == 2)
             <span class="feedback success" role="alert">
                 <i class="fas fa-times-circle" aria-hidden="true"></i>{{$oficioEmendas->txt_situacao_oficio}}
             </span>
         @elseif($oficioEmendas->situacao_oficio_id == 7 || $oficioEmendas->situacao_oficio_id == 3)
             <span class="feedback danger" role="alert">
                 <i class="fas fa-times-circle" aria-hidden="true"></i>{{$oficioEmendas->txt_situacao_oficio}}
             </span>
         @elseif($oficioEmendas->situacao_oficio_id == 6)
             <span class="feedback warning" role="alert">
                 <i class="fas fa-times-circle" aria-hidden="true"></i>{{$oficioEmendas->txt_situacao_oficio}}
             </span>
         @else
            <span class="feedback info" role="alert">
                <i class="fas fa-times-circle" aria-hidden="true"></i>{{$oficioEmendas->txt_situacao_oficio}}
            </span>
         @endif
    </div>
</cabecalho-relatorios>

<div class="main-content pl-sm-3 mt-5" id="main-content">

    <div class="table-responsive-sm">
        <table class="table table-hover">
            <thead>
                <tr class="text-center" >
                <th>#</th>
                <th>Registro Validado?</th>
                <th>Nº emenda</th>
                <th>RP</th>
                <th>Beneficiário Ofício</th>
                <th>UF</th>
                <th>Proponente</th>                
                <th>Município Proponente</th>
                <th> Beneficiário</th>
                <th> CNPJ Ofício</th>
                <th> CNPJ Beneficiário</th>
                <th> CNPJ</th>
                <th>Valor Emenda</th>
                <th>Valor Tarifa</th>
                <th>Valor Transferegov</th>
                <th>Data Validação</th>
                <th class="text-center">Ação</th>                    
                
                </tr>
            </thead>
            <tbody> 
                @foreach($emendasComissoesValidar as $dados) 
                    @if($dados->bln_registro_validado == true)                        
                        <tr class="text-center table-success align-middle">   
                    @else
                        <tr class="text-center align-middle">   
                    @endif
                    <td>{{$loop->index+1}}</td>
                        <td class="text-center align-middle">
                            @if($dados->bln_registro_validado == true)                                    
                                <div class="icon"><i class="fas fa-check-circle fa-lg text-success" aria-hidden="true"></i></div>                                    
                            @else
                                <div class="icon"><i class="fas fa-times-circle fa-lg text-danger" aria-hidden="true"></i></div>
                            @endif
                        </td>
                            <td class="text-center align-middle">
                                @if($dados->num_emenda)
                                    {{$dados->num_emenda}}
                                @else
                                    <div class="icon  align-middle"><i class="fas fa-times-circle fa-lg text-danger" aria-hidden="true"></i>
                                @endif
                                </td>
                                
                            <td  class="align-middle">{{$dados->txt_resultado_primario}}</td>
                            <td  class="align-middle">{{$dados->txt_beneficiario_ajustado}}</td>
                            <td  class="align-middle">{{$dados->sgl_uf_proponente}}</td>  
                            <td  class="align-middle">{{$dados->nom_proponente}}</td>  
                            <td  class="align-middle">{{$dados->nom_municipio_proponente}}</td>  
                            <td class="text-center align-middle">
                                @if($dados->bln_valida_beneficiario == true)
                                    <div class="icon"><i class="fas fa-check-circle fa-lg text-success" aria-hidden="true"></i>
                                @else
                                    <div class="icon"><i class="fas fa-times-circle fa-lg text-danger" aria-hidden="true"></i>
                                @endif
                            </td>
                            <td  class="align-middle">{{$dados->txt_cnpj}}</td>
                            <td  class="align-middle">{{$dados->num_identif_proponente}}</td>
                            <td class="text-center align-middle">
                                @if($dados->bln_valida_cnpj == true)                                    
                                    <div class="icon"><i class="fas fa-check-circle fa-lg text-success" aria-hidden="true"></i></div>                                    
                                @else
                                    <div class="icon"><i class="fas fa-times-circle fa-lg text-danger" aria-hidden="true"></i></div>
                                @endif
                            </td>
                            <td  class="align-middle">{{number_format( ($dados->vlr_emenda), 2, ',' , '.')}}</td>    
                            <td  class="align-middle">{{number_format( ($dados->vlr_tarifa), 2, ',' , '.')}}</td>    
                            <td  class="align-middle">{{number_format( ($dados->vlr_transferegov), 2, ',' , '.')}}</td>    
                            <td  class="align-middle">@if($dados->dte_validacao_registro) {{date('d/m/Y',strtotime($dados->dte_validacao_registro))}} @endif</td>    
                            <td class="p-3 text-right">
                                
                                @if($dados->bln_registro_validado == FALSE && $dados->bln_valida_beneficiario == false && $dados->bln_valida_cnpj == true && !empty($dados->num_emenda))                                    
                                    @if($dados->user_id == Auth::user()->id)
                                        <button class="br-button mr-3 warning small block" type="button" onclick="window.location.href='/rp/arquivo/editar/registro/emenda/{{$dados->emenda_comissao_id}}'">
                                            <i class="fas fa-edit"></i>Editar
                                        </button>
                                        <botao-acao-icone  
                                            :url="'{{ url("rp/arquivo/validar/registro/emenda")}}'" 
                                            registro="{{$dados->emenda_comissao_id}}"                               
                                            mensagem="Deseja validar o nome do beneficiário de {{$dados->txt_beneficiario_ajustado}} para {{$dados->nom_proponente}}?" 
                                            titulo="Atenção!!!"
                                            txtbotaoconfirma="Sim"
                                            txtbotaocancela="Cancelar"
                                            cssbotao="br-button info mr-1 small block"                               
                                            cssicone="fas fa-check-circle" 
                                            textobotao="Validar"
                                        ></botao-acao-icone>   
                                        <botao-acao-icone  
                                            :url="'{{ url("rp/arquivo/invalidar/registro/emenda")}}'" 
                                            registro="{{$dados->emenda_comissao_id}}"                               
                                            mensagem="Deseja invalidar o nome do beneficiário de {{$dados->txt_beneficiario_ajustado}} para {{$dados->nom_proponente}}?" 
                                            titulo="Atenção!!!"
                                            txtbotaoconfirma="Sim"
                                            txtbotaocancela="Cancelar"
                                            cssbotao="br-button danger mr-1 small block"                               
                                            cssicone="fas fa-times-circle" 
                                            textobotao="Invalidar"
                                        ></botao-acao-icone>                       
                                    @endif
                                @endif
                                

                            </td>  
                        </tr>  
                    
                @endforeach
            </tbody><!-- fechar tbody-->
        </table><!-- fechar table-->
    </div> <!-- table-responsive-sm -->  
    <div class="row">
        <div class="col col-xs-12 col-sm-6">
            <div class="p-3 text-left">
                @if($numRegistrosValidar == 0 && $oficioEmendas->situacao_oficio_id == 1)
                    <botao-acao-icone  
                        :url="'{{ url("rp/arquivo/validar/oficio/")}}'" 
                        registro="{{$dados->oficio_emenda_id}}"                               
                        mensagem="Deseja concluir a validação do Ofício Nº {{$oficioEmendas->oficio_emenda_id}}?" 
                        titulo="Atenção!!!"
                        txtbotaoconfirma="Sim"
                        txtbotaocancela="Cancelar"
                        cssbotao="br-button success mr-3"                               
                        cssicone="fas fa-check-circle" 
                        textobotao="Validar Ofício"
                ></botao-acao-icone>   
                @else  
                    @if($oficioEmendas->situacao_oficio_id == 2)                  
                        <botao-acao-icone  
                            :url="'{{ url("rp/rp8/validado/oficio/")}}'" 
                            registro="{{$dados->oficio_emenda_id}}"                               
                            mensagem="Deseja gerar os arquivos de habilitação?" 
                            titulo="Atenção!!!"
                            txtbotaoconfirma="Sim"
                            txtbotaocancela="Cancelar"
                            cssbotao="br-button warning mr-3"                               
                            cssicone="fas fa-check-circle" 
                            textobotao="Gerar Arquivos"
                        ></botao-acao-icone>  
                    @endif                    
                @endif
            </div>
        </div>
        <div class="col col-xs-12 col-sm-6">
            <div class="p-3 text-right">
                <button class="br-button primary mr-3" type="button" name="imprimir" value="Imprimir" onclick="window.print();">Imprimir
                </button>
                <button class="br-button danger mr-3" type="button"  onclick="javascript:window.history.go(-1)">Fechar
                </button>
            </div> 
        </div>

</div>
@endsection