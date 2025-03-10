@component('mail::message')
# Confirmação de Recebimento - {{$oficio->txt_num_oficio_completo_congresso}} Validado com Sucesso

<p>Prezados(as),</p>
<br>
<br>
<p>
    Gostaríamos de informar sobre as validações realizadas nos CNPJs contidos no<a href="{{$url}}" target="_blank"> {{$oficio->txt_num_oficio_completo_congresso}}</a>. 
    Após uma análise minuciosa, foram identificadas as seguintes situações:
</p>
@if(count($dadosHabManual) > 0)
<p>
    - CNPJs a Habilitar Manualmente: Após a validação dos dados, foi constatado que os CNPJs abaixo requerem uma habilitação 
    manual no Transferegov. 
</p>
<div class="table-responsive-sm">
    <table class="table table-hover">
        <thead>
            <tr class="text-center" >           
                <th>Nº emenda</th>
                <th>RP</th>
                <th>Programa</th>
                <th>Beneficiário Ofício</th>
                <th>CNPJ Ofício</th>            
                <th>Valor Emenda</th>
                <th>Valor Tarifa</th>
                <th>Valor Transferegov</th>   
            </tr>
        </thead>
        <tbody> 
        @foreach ($dadosHabManual as $dados)
            <tr>
                <td class="text-center align-middle">{{$dados->num_emenda}}</td>            
                <td  class="align-middle">{{$dados->txt_resultado_primario}}</td>
                <td  class="align-middle">{{$dados->cod_programa}}</td>
                <td  class="align-middle">{{$dados->txt_beneficiario}}</td>
                <td  class="align-middle">{{$dados->txt_cnpj}}</td>
                <td  class="align-middle">{{number_format( ($dados->vlr_emenda), 2, ',' , '.')}}</td>    
                <td  class="align-middle">{{number_format( ($dados->vlr_tarifa), 2, ',' , '.')}}</td>    
                <td  class="align-middle">{{number_format( ($dados->vlr_transferegov), 2, ',' , '.')}}</td>   
            </tr>          
        @endforeach
    </tbody><!-- fechar tbody-->
</table><!-- fechar table-->
</div> <!-- table-responsive-sm -->  
@endif

@if(count($dadosHabLote) > 0)
<p>
    - CNPJs a Habilitar em Lote: Segue abaixo a lista dos CNPJs que podem ser habilitados em lote no Transferegov. 
</p>
<div class="table-responsive-sm">
    <table class="table table-hover">
        <thead>
            <tr class="text-center" >           
                <th>Nº emenda</th>
                <th>RP</th>
                <th>Programa</th>
                <th>Beneficiário Ofício</th>
                <th>CNPJ Ofício</th>            
                <th>Valor Emenda</th>
                <th>Valor Tarifa</th>
                <th>Valor Transferegov</th>   
            </tr>
        </thead>
        <tbody> 
        @foreach ($dadosHabLote as $dados)
            <tr>
                <td class="text-center align-middle">{{$dados->num_emenda}}</td>            
                <td  class="align-middle">{{$dados->txt_resultado_primario}}</td>
                <td  class="align-middle">{{$dados->cod_programa}}</td>
                <td  class="align-middle">{{$dados->txt_beneficiario}}</td>
                <td  class="align-middle">{{$dados->txt_cnpj}}</td>
                <td  class="align-middle">{{number_format( ($dados->vlr_emenda), 2, ',' , '.')}}</td>    
                <td  class="align-middle">{{number_format( ($dados->vlr_tarifa), 2, ',' , '.')}}</td>    
                <td  class="align-middle">{{number_format( ($dados->vlr_transferegov), 2, ',' , '.')}}</td>             
            </tr>
        @endforeach
    </tbody><!-- fechar tbody-->
</table><!-- fechar table-->
</div> <!-- table-responsive-sm -->  
@endif

@if(count($dadosHabInvalidada) > 0)
<p>
    - CNPJs Invalidados para Correção: Durante a validação dos registros, identificamos alguns CNPJs que apresentam 
    inconsistências ou informações incorretas. Esses CNPJs foram invalidados e requerem correção antes de serem habilitados em nosso sistema. 
</p>
<div class="table-responsive-sm">
    <table class="table table-hover">
        <thead>
            <tr class="text-center" >           
                <th>Nº emenda</th>
                <th>RP</th>
                <th>Programa</th>
                <th>Beneficiário Ofício</th>
                <th>CNPJ Ofício</th>          
            </tr>
        </thead>
        <tbody> 
        @foreach ($dadosHabInvalidada as $dados)
            <tr>
                <td class="text-center align-middle">{{$dados->num_emenda}}</td>            
                <td  class="align-middle">{{$dados->txt_resultado_primario}}</td>
                <td  class="align-middle">{{$dados->cod_programa}}</td>
                <td  class="align-middle">{{$dados->txt_beneficiario}}</td>
                <td  class="align-middle">{{$dados->txt_cnpj}}</td>           
            </tr>
        @endforeach
    </tbody><!-- fechar tbody-->
</table><!-- fechar table-->
</div> <!-- table-responsive-sm -->  
@endif

@component('mail::button', ['url' => $url])
Acessar o sistema
@endcomponent

Atenciosamente,<br>
<br>
<br>
<strong>Secretaria Executiva</strong>
<strong>Ministério das Cidades</strong>

<hr>
<p><small>Se estiver com dificuldade para clicar no link, copie e cole esta url no seu browser: <a href="http://sistema.cidades.gov.br/login">http://sistema.cidades.gov.br/login</a></small></p>
@endcomponent
