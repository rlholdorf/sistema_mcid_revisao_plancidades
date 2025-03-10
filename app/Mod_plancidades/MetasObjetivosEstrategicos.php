<?php

namespace App\Mod_plancidades;

use Illuminate\Database\Eloquent\Model;

class MetasObjetivosEstrategicos extends Model
{

   protected $connection   = 'pgsql_corp';

   protected $keyType = 'string';

   protected $table = 'mcid_plancidades.tab_metas_objetivos_estrategicos';

   public $timestamps = true; // tabela possui coluna de data de criação/atualização

   public function indicador()
   {
      return $this->hasOne(ObjetivosEstrategicos::class, 'id', 'indicador_objetivo_estrategico_id');
   }
}
