@component('mail::message')
# Nova Demanda Recebida - Nº {{$demanda->demanda_id}}

<p>Prezado(a) {{ $usuario->name }},</p>
<br>
<br>
<p>
   Gostaríamos de informar que uma nova demanda foi recebida em nosso sistema para o setor {{$demanda->txt_sigla_setor}}. Detalhes sobre 
   a demanda estão disponíveis abaixo:
</p>

<p>
   <strong>Data de Recebimento: </strong>{{date('d/m/Y',strtotime($demanda->dte_solicitacao))}}   
</p>
<p>
   <strong>Descrição da Deamanda: </strong>   
</p>
<p>
   {{$demanda->txt_descricao_demanda}}
</p>
<p>
   Por favor, tome as medidas necessárias para revisar e iniciar o processo de encaminhamento ou execução conforme as políticas e 
   procedimentos estabelecidos para o seu setor.
</p>
<p>
   Se precisar de mais informações ou esclarecimentos, sinta-se à vontade para entrar em contato conosco.
</p>
<p>
   Agradecemos antecipadamente pela sua atenção e cooperação.
</p>
 

@component('mail::button', ['url' => $url])
Acessar o sistema
@endcomponent

Atenciosamente,<br>
<br>
<br>

<strong>Ministério das Cidades</strong>

<hr>
<p><small>Se estiver com dificuldade para clicar no link, copie e cole esta url no seu browser: http://sistema.cidades.gov.br/codem/demanda/dados/{{$demanda->demanda_id}}/demanda</small></p>
@endcomponent
