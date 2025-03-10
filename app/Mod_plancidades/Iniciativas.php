<?php

namespace App\Mod_plancidades;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Iniciativas extends Model
{

   protected $connection   = 'pgsql_corp';

   protected $table = 'mcid_plancidades.tab_iniciativas';

   public $timestamps = false; // tabela possui coluna de data de criação/atualização

   public $incrementing = false;

   public function Indicador(): HasOne
   {
      return $this->hasOne(IndicadoresIniciativa::class);
   }
}
