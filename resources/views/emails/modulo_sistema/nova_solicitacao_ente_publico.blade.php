@component('mail::message')
# Confirmação de Recebimento - Solicitação de Cadastro no Sistema de Gerenciamento do Cidades

<p>Prezado(a) {{$usuario->name}}, {{$usuario->txt_cargo}} do </p>
<p> {{$usuario->entePublico->txt_ente_publico}}</p>

<p>Informamos que recebemos com sucesso sua solicitação de cadastro no sistema. Para prosseguir com a validação, solicitamos que nos envie um ofício oficial,
     devidamente assinado pela autoridade máxima do ente público (Prefeito/Governador), autorizando a inclusão e acesso aos dados do município/estado 
     no sistema.
</p>
<p>
    O ofício poderá ser encaminhado digitalmente pelo link abaixo:
</p>
<p>
    <a href="{{ $url }}">{{ $url }}</a>.
</p>
<p>
    Agradecemos pela sua cooperação e interesse em utilizar o Sistema de Gerenciamento do Cidades. Estamos ansiosos para colaborar com o sucesso de seu 
    município/estado.
</p>

Atenciosamente,<br>
<br>
<strong>Secretaria Executiva</strong>
<strong>Ministério das Cidades</strong>

<hr>
<p><small>Se estiver com dificuldade para clicar no link, copie e cole esta url no seu browser: <a href="{{ $url }}">{{ $url }}</a></small></p>
@endcomponent
