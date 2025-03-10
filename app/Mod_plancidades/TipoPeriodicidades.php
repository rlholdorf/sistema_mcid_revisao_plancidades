<?php

namespace App\Mod_plancidades;

use Illuminate\Database\Eloquent\Model;

class TipoPeriodicidades extends Model
{

   protected $connection   = 'pgsql_corp';

   protected $table = 'mcid_plancidades.opc_tipo_periodicidades';

   public $timestamps = false; // tabela não possui coluna de data de criação/atualização


}
