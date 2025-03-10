<?php

namespace App\Mod_plancidades;

use Illuminate\Database\Eloquent\Model;

class TiposPublicos extends Model
{

   protected $connection   = 'pgsql_corp';

   protected $table = 'mcid_plancidades.opc_tipos_publicos';

   public $timestamps = false; // tabela não possui coluna de data de criação/atualização


}
