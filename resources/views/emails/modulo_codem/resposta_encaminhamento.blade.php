@component('mail::message')
# Confirmação de Recebimento - Resposta à Sua Demanda Nº {{$encaminhamento->demanda_id}}

<p>Prezado(a) {{ $usuario->name }},</p>
<br>
<br>
<p>
   Gostaríamos de informar que sua demanda, identificada pelo número {{$encaminhamento->demanda_id}}, foi revisada e respondida. 
</p>
<p>
   Abaixo estão os detalhes da resposta:
</p>
<p>
   <strong>Data da Resposta: </strong>{{date('d/m/Y',strtotime($encaminhamento->dte_resposta))}}   
</p>
<p>
   <strong>Descrição da Resposta: </strong>   
</p>
<p>
   {{$encaminhamento->txt_resposta_encaminhamento}}
</p>
<p>
   Se tiver mais perguntas ou precisar de esclarecimentos adicionais, por favor, não hesite em entrar em contato conosco. Estamos à 
   disposição para ajudar.
</p>
<p>
   Agradecemos pela sua paciência e compreensão durante este processo.
</p>

 

@component('mail::button', ['url' => $url . '/' . $encaminhamento->id])
Acessar o sistema
@endcomponent

Atenciosamente,<br>
<br>
<br>

<strong>Ministério das Cidades</strong>

<hr>
<p><small>Se estiver com dificuldade para clicar no link, copie e cole esta url no seu browser: http://sistema.cidades.gov.br/codem/demanda/encaminhamento/dados/{{$encaminhamento->id}}</small></p>
@endcomponent
