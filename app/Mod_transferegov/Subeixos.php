<?php

namespace App\Mod_transferegov;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Subeixos extends Model
{

   protected $connection   = 'pgsql_corp';

   protected $table = 'mcid_pac.opc_subeixos';

   public $timestamps = false; // tabela possui coluna de data de criação/atualização

   public $incrementing = false;
}
