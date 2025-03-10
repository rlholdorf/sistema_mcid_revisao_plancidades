@component('mail::message')
# Confirmação de Recebimento - Cadastro de Ente Público Invalidado

<p>Prezado(a) {{ $permissao->user->nome }} {{ $permissao->user->sobrenome }},</p>
<br>
<br>
<p>Gostaríamos de informar que o cadastro do Ente Público relacionado ao {{ $usuario->entePublico->txt_ente_publico }} refetente ao município 
   {{ $usuario->entePublico->municipio->txt_nome_sem_acento}}-{{ $usuario->entePublico->municipio->uf->txt_sigla_uf }} pôde ser validado devido a algumas 
   inconsistências encontradas. 
</p>
<p>
    <strong>Motivo da invalidação</strong> {{$permissao->tipoIndeferimento->txt_tipo_indeferimento}}.
</p>
<p>
    Entendemos que podem ocorrer equívocos e alterações nos dados, e, por isso, gostaríamos de oferecer uma sugestão 
    para resolver a questão: {{$permissao->tipoIndeferimento->dsc_providencia}}.
</p>
<p>
    Pedimos a gentileza de revisar e corrigir as informações conforme a sugestão acima, a fim de que possamos realizar uma nova validação com sucesso.
</p>
<p>
    Caso tenha alguma dúvida ou precise de auxílio para efetuar as correções, nossa equipe de suporte está à disposição para ajudar em todo o processo.
</p>
<p>
    Contamos com a sua colaboração para manter os dados do Ente Público precisos e atualizados em nosso sistema.
</p>

 



Atenciosamente,<br>
<br>
<br>
<strong>Secretaria Executiva</strong>
<strong>Ministério das Cidades</strong>

<hr>

@endcomponent
