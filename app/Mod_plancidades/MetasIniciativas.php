<?php

namespace App\Mod_plancidades;

use Illuminate\Database\Eloquent\Model;

class MetasIniciativas extends Model
{

   protected $connection   = 'pgsql_corp';

   protected $keyType = 'string';

   protected $table = 'mcid_plancidades.tab_metas_iniciativas';

   public $timestamps = true; // tabela possui coluna de data de criação/atualização


   public function iniciativa()
   {
      return $this->hasOne(Iniciativas::class, 'id', 'iniciativa_id');
   }
}