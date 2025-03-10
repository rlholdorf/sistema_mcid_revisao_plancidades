<?php

use App\Mod_codem\RelacaoDemandas;
use App\Mod_codem\ViewEncaminhamentoDemanda;
use Illuminate\Support\Facades\Auth;

function strParaBD($str)
{
  if (!get_magic_quotes_gpc()) {
    $str = addslashes($str);
  }
  return $str;
}

function flash($titulo = null, $mensagem = null)
{
  $flash = app('App\Http\Flash');

  if (func_num_args() == 0) {
    return $flash;
  }

  return $flash->info($titulo, $mensagem);
}

function converterMaiuscula($value)
{
  return mb_strtoupper($value);
}

function pegarPrimeiraLetraUser($nameUser = "")
{

  $partesNome = explode(" ", $nameUser);

  is_array($partesNome) && $partesNome > 1 ? $sigla = mb_substr($partesNome[0], 0, 1, 'UTF-8') . mb_substr($partesNome[count($partesNome) - 1], 0, 1, 'UTF-8') : $sigla = mb_substr($partesNome[count($partesNome) - 1], 0, 1, 'UTF-8');

  return $sigla;
}

function retornarDoisPrimeiroNome($nome)
{


  $arr = explode(' ', $nome);

  return collect($arr)->slice(0, 2)->implode(' ');
}




function retornarQtdEncaminhamentos()
{

  $usuarioID = Auth::user()->id;

  $where = [];
  $where[] = ['usuario_id_demandado', $usuarioID];
  $where[] = ['bln_visualizado', false];

  $encaminhamentoDemanda = ViewEncaminhamentoDemanda::where($where)->get();

  $whereDemandado = [];
  $whereDemandado[] = ['user_id_demandado', $usuarioID];
  $whereDemandado[] = ['bln_visualizada', false];

  $demandas = RelacaoDemandas::where($whereDemandado)->get();

  return count($encaminhamentoDemanda) + count($demandas);
}

function demandasAtasadas()
{

  $usuarioID = Auth::user()->id;

  $whereDemandado = [];
  $whereDemandado[] = ['user_id_demandado', $usuarioID];
  $whereDemandado[] = ['qtd_dias_atraso', '>', 0];

  $demandas = RelacaoDemandas::where($whereDemandado)->get();

  return count($demandas);
}


function retornarPrimeiroUltimoNome($nome)
{


  $nomeSeparados = explode(' ', $nome);

  return $nomeSeparados[0] . ' ' . $nomeSeparados[count($nomeSeparados) - 1];
}

function mascaraCnpjCpf($value)
{
  $CPF_LENGTH = 11;
  $cnpj_cpf = preg_replace("/\D/", '', $value);

  if (strlen($cnpj_cpf) === $CPF_LENGTH) {
    return preg_replace("/(\d{3})(\d{3})(\d{3})(\d{2})/", "\$1.\$2.\$3-\$4", $cnpj_cpf);
  }

  return preg_replace("/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/", "\$1.\$2.\$3/\$4-\$5", $cnpj_cpf);
}

function senhaValida($senha)
{
  return preg_match('/[a-z]/', $senha) // tem pelo menos uma letra minúscula
    && preg_match('/[A-Z]/', $senha) // tem pelo menos uma letra maiúscula
    && preg_match('/[0-9]/', $senha) // tem pelo menos um número
    && preg_match('/^[\w$@]{6,}$/', $senha); // tem 6 ou mais caracteres
}

function convertaDataExtenso($data)
{

  $meses = array(1 => "Janeiro", 2 => "Fevereiro", 3 => "Março", 4 => "Abril", 5 => "Maio", 6 => "Junho", 7 => "Julho", 8 => "Agosto", 9 => "Setembro", 10 => "Outubro", 11 => "Novembro", 12 => "Dezembro");

  $diasdasemana = array(1 => "Segunda-Feira", 2 => "Terça-Feira", 3 => "Quarta-Feira", 4 => "Quinta-Feira", 5 => "Sexta-Feira", 6 => "Sábado", 0 => "Domingo");

  $dataConverter = $data;

  $dia = $dataConverter["mday"];
  $mes = $dataConverter["mon"];
  $nomemes = $meses[$mes];
  $ano = $dataConverter["year"];

  $diadasemana = $dataConverter["wday"];
  $nomediadasemana = $diasdasemana[$diadasemana];

  return "$nomediadasemana, $dia de $nomemes de $ano";
}

function adicionarDiasData($data, $dias, $meses = 0, $ano = 0)
{
  //passe a data no formato yyyy-mm-dd
  $data = explode("-", $data);
  $newData = date("Y-m-d", mktime(0, 0, 0, $data[1] + $meses, $data[2] + $dias, $data[0] + $ano));
  return $newData;
}

function getUsuarioLogado()
{

  return Auth::user();
}
