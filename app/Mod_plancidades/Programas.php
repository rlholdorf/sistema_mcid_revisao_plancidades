<?php

namespace App\Mod_plancidades;

use Illuminate\Database\Eloquent\Model;

class Programas extends Model
{

   protected $connection   = 'pgsql_corp';

   protected $table = 'mcid_plancidades.opc_programas';

   public $timestamps = true; // tabela possui coluna de data de criação/atualização


}
