<?php

namespace App\Mod_saci\mod_ibge;

use Illuminate\Database\Eloquent\Model;

class Municipio extends Model
{

   protected $connection   = 'pgsql_corp';

   protected $table = 'ibge.tab_municipios';

   protected $primaryKey = 'id_municipio';


   public $timestamps = false; // tabela não possui coluna de data de criação/atualização

   public function uf()
   {
      return $this->belongsTo(Uf::class, 'id_uf', 'id_uf'); //possui muitos
   }
}
