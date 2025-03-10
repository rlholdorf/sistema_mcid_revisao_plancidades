<?php

namespace App\Mod_plancidades;

use Illuminate\Database\Eloquent\Model;

class IndicadoresObjetivosEspecificos extends Model
{

   protected $connection   = 'pgsql_corp';

   protected $table = 'mcid_plancidades.tab_indicadores_objetivos_especificos';

   public $timestamps = true; // tabela possui coluna de data de criação/atualização


}
