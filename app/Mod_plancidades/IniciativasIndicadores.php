<?php

namespace App\Mod_plancidades;

use Illuminate\Database\Eloquent\Model;

class IniciativasIndicadores extends Model
{

   protected $connection   = 'pgsql_corp';

   protected $table = 'mcid_plancidades.tab_indicadores_iniciativas';

   public $timestamps = false; // tabela possui coluna de data de criação/atualização

   public function Iniciativas()
   {
      $this->belongsTo(Iniciativas::class, 'id', 'iniciativa_id');
   }
}
