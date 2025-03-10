<?php

namespace App\Mod_transferegov;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Rps extends Model
{

   protected $connection   = 'pgsql_corp';

   protected $table = 'mcid_orcamento_financeiro.opc_resultado_primario';

   public $timestamps = false; // tabela possui coluna de data de criação/atualização

   public $incrementing = false;
}
