<?php

namespace App\Mod_plancidades;

use Illuminate\Database\Eloquent\Model;

class MetasObjetivosEspecificos extends Model
{

   protected $connection   = 'pgsql_corp';

   protected $table = 'mcid_plancidades.tab_metas_objetivos_estrategicos';

   public $timestamps = true; // tabela possui coluna de data de criação/atualização


}
