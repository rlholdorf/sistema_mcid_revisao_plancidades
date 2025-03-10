@component('mail::message')
# Nova Demanda Encaminhada para sua Atenção - Demanda Nº {{$encaminhamento->demanda_id}}

<p>Prezado(a) {{ $usuarioDemandado->name }},</p>
<br>
<br>
<p>
   Gostaríamos de informar que uma nova demanda foi encaminhada. Detalhes sobre a demanda estão disponíveis abaixo:
</p>
<p>
   <strong>Data do encaminhamento: </strong>{{date('d/m/Y',strtotime($encaminhamento->dte_encaminhamento))}}   
</p>
<p>
   <strong>Descrição do Encaminhamento: </strong>   
</p>
<p>
   {{$encaminhamento->dsc_encaminhamento}}
</p>
<p>
   Esta demanda foi encaminhada para o seu setor devido à sua área de expertise e responsabilidades. Pedimos que você revise a demanda e 
   tome as medidas necessárias de acordo com as políticas e procedimentos estabelecidos.
</p>
<p>
   Se precisar de mais informações ou esclarecimentos, sinta-se à vontade para entrar em contato conosco.
</p>
<p>
   Agradecemos antecipadamente pela sua atenção e colaboração.
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
