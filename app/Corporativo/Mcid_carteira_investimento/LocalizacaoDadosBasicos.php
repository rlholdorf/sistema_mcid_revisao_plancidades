<?php

namespace App\Corporativo\Mcid_carteira_investimento;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class LocalizacaoDadosBasicos extends Model
{

   protected $connection   = 'pgsql_corp';

   protected $table = 'mcid_carteira_investimento.rlc_localizacao_dados_basicos';

   public $timestamps = false; // tabela possui coluna de data de criação/atualização

}
