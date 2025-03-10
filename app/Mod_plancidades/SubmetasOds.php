<?php

namespace App\Mod_plancidades;

use Illuminate\Database\Eloquent\Model;

class Submetas extends Model
{

   protected $connection   = 'pgsql_corp';

   protected $table = 'mcid_plancidades.opc_submetas_ods';

   public $timestamps = false; // tabela não possui coluna de data de criação/atualização


}
