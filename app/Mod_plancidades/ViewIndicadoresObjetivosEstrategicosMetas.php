<?php

namespace App\Mod_plancidades;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ViewIndicadoresObjetivosEstrategicosMetas extends Model
{

   protected $connection   = 'pgsql_corp';

   protected $table = 'mcid_plancidades.view_objetivos_estrategicos_indicadores_metas';

   public $timestamps = false; // tabela possui coluna de data de criação/atualização
}
