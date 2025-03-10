<?php

namespace App\Mod_plancidades;

use Illuminate\Database\Eloquent\Model;

class PerspectivasPEI extends Model
{

   protected $connection   = 'pgsql_corp';

   protected $table = 'mcid_plancidades_bck.opc_perspectivas_pei';

   public $timestamps = false; // tabela não possui coluna de data de criação/atualização


}
