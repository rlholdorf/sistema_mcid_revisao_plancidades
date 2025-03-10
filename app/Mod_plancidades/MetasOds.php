<?php

namespace App\Mod_plancidades;

use Illuminate\Database\Eloquent\Model;

class MetasOds extends Model
{

   protected $connection  = 'pgsql_corp';

   protected $table = 'mcid_plancidades.opc_metas_ods';

   public $timestamps = false; // tabela não possui coluna de data de criação/atualização


}
