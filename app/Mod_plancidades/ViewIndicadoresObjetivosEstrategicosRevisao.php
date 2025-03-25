<?php

namespace App\Mod_plancidades;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ViewIndicadoresObjetivosEstrategicosRevisao extends Model
{

   protected $connection   = 'pgsql_corp';

   protected $keyType = 'string';

   protected $table = 'mcid_hom_plancidades.view_indicadores_objetivos_estrategicos_revisao';

   public $timestamps = false; // tabela não possui coluna de data de criação/atualização

}
