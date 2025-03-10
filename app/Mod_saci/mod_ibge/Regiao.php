<?php

namespace App\Mod_saci\mod_ibge;

use Illuminate\Database\Eloquent\Model;

class Regiao extends Model
{

   protected $connection   = 'pgsql_corp';

   protected $table = 'ibge.tab_regiao';

   protected $primaryKey = 'id_regiao';


   public $timestamps = false; // tabela não possui coluna de data de criação/atualização

   public function ufs()
   {
      return $this->hasMany(Uf::class, 'id_uf', 'id_uf'); //possui muitos
   }
}
