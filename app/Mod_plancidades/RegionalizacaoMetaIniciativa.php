<?php

namespace App\Mod_plancidades;

use Illuminate\Database\Eloquent\Model;

class RegionalizacaoMetaIniciativa extends Model
{

   protected $connection   = 'pgsql_corp';

   protected $table = 'mcid_plancidades.tab_regionalizacao_metas_iniciativas';

   public $timestamps = true; // tabela possui coluna de data de criação/atualização

   public function metasIniciativas()
   {
      return $this->hasMany(MetasIniciativas::class, 'id', 'meta_iniciativa_id');
   }

   public function regionalizacao()
   {
      return $this->hasOne(Regionalizacao::class, 'id', 'regionalizacao_id');
   }
}