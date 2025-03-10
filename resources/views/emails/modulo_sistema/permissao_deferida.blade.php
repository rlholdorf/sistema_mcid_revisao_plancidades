@component('mail::message')
# Confirmação de Recebimento - Cadastro de Ente Público Validado com Sucesso

<p>Prezado(a) {{ $permissao->user->nome }} {{ $permissao->user->sobrenome }},</p>
<br>
<br>
<p>Gostaríamos de informar que o cadastro do Ente Público relacionado ao {{ $usuario->entePublico->txt_ente_publico }} refetente ao município 
   {{ $usuario->entePublico->municipio->txt_nome_sem_acento}}-{{ $usuario->entePublico->municipio->uf->txt_sigla_uf }} foi validado com sucesso! 
</p>
<p>
   Com a validação concluída, o cadastro do Ente Público agora está ativo no sistema, permitindo o acesso e o uso das funcionalidades disponíveis.
</p>
<p>
   Para acessar o sistema, siga os seguintes passos:
</p>
<p>
   1. Acesse a seguinte URL: <a href="http://sistema.cidades.gov.br/login" target="_blank">http://sistema.cidades.gov.br/login</a>;<br>

   2. Utilize o email {{ $permissao->user->email}} como login e a senha temporária "123456" para realizar o primeiro acesso; e<br>

   2. Após efetuar o login pela primeira vez, o sistema solicitará que você crie uma nova senha pessoal. Por razões de segurança, recomendamos que escolha 
   uma senha forte e única.
</p>
<p>
   Lembramos que é fundamental manter a confidencialidade de suas credenciais de acesso e nunca compartilhá-las com terceiros. Caso suspeite de qualquer 
   atividade suspeita em sua conta, por favor, entre em contato com nossa equipe de suporte imediatamente.
</p>

 

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
