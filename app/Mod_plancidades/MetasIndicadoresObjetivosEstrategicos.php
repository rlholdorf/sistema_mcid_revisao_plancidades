<?php

namespace App\Mod_plancidades;

use Illuminate\Database\Eloquent\Model;

class MetasIndicadoresObjetivosEstrategicos extends Model
{

   protected $connection   = 'pgsql_corp';

   protected $table = 'mcid_plancidades.tab_meta_objetivos_estrategicos';

   public $timestamps = true; // tabela possui coluna de data de criação/atualização

   public $incrementing = false;

   public function indicador()
   {
      return $this->belongsTo(IndicadoresObjetivosEstrategicos::class);
   }
}
