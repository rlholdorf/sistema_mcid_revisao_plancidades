<?php

namespace App\Mod_plancidades;

use Illuminate\Database\Eloquent\Model;

class RegionalizacaoMetaObjEstr extends Model
{

   protected $connection   = 'pgsql_corp';

   protected $table = 'mcid_plancidades.tab_regionalizacao_metas_objetivos_estrategicos';

   public $timestamps = true; // tabela possui coluna de data de criação/atualização

   public function metasIndicadores()
   {
      return $this->hasMany(MetasObjetivosEstrategicos::class, 'id', 'meta_objetivos_estrategicos_id');
   }

   public function regionalizacao()
   {
      return $this->hasOne(Regionalizacao::class, 'id', 'regionalizacao_id');
   }


}
