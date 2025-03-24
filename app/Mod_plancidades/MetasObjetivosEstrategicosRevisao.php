<?php

namespace App\Mod_plancidades;

use Illuminate\Database\Eloquent\Model;

class MetasObjetivosEstrategicosRevisao extends Model
{

   protected $connection   = 'pgsql_corp';

   protected $table = 'mcid_hom_plancidades.tab_metas_objetivos_estrategicos_revisao';

   public $timestamps = true; // tabela possui coluna de data de criação/atualização


}