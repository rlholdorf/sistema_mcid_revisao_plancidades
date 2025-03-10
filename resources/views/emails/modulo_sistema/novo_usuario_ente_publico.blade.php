@component('mail::message')
# Registro de Novo Usuário

<p>Prezados,</p>
<p>Um novo usuário acaba de se registrar no <strong>sistema </strong> para representar o <b>{{ $usuario->entePublico->txt_ente_publico }}</b>. Por favor analise a permissão do usuário.</p>

<p>Dados do Usuário:</p>
<ul>
    <li><b>Nome:</b> {{ $usuario->name }} {{ $usuario->sobrenome }}</li>
    <li><b>Email:</b> {{ $usuario->email }}</li>
    <li><b>CPF:</b> {{ mascaraCnpjCpf($usuario->txt_cpf_usuario) }}</li>
    <li><b>Cargo:</b> {{ $usuario->txt_cargo }}</li>
    <li><b>Telefone:</b> ({{ $usuario->txt_ddd_fixo }}) {{ $usuario->txt_telefone_fixo }}</li>
</ul>


@component('mail::button', ['url' => $url])
Analisar Permissão
@endcomponent


<hr>
<p><small>Se estiver com dificuldade para clicar no link, copie e cole esta url no seu browser: <a href="{{ $url }}">{{ $url }}</a></small></p>
@endcomponent
