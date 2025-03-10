<?php

namespace App\Mod_plancidades;

use Illuminate\Database\Eloquent\Model;

class ObjetivosPPA extends Model
{

   protected $connection   = 'pgsql_corp';

   protected $table = 'mcid_plancidades_bck.opc_objetivos_ppa';

   public $timestamps = false; // tabela não possui coluna de data de criação/atualização


}
