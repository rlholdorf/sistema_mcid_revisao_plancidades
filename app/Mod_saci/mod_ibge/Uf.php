<?php

namespace App\Mod_saci\mod_ibge;

use Illuminate\Database\Eloquent\Model;

class Uf extends Model
{

   protected $connection   = 'pgsql_corp';

   protected $table = 'ibge.tab_uf';

   protected $primaryKey = 'id_uf';


   public $timestamps = false; // tabela não possui coluna de data de criação/atualização

   public function municipios()
   {
      return $this->hasMany(Municipio::class); //possui muitos
   }

   public function regiao()
   {
      return $this->belongsTo(Regiao::class); //possui muitos
   }
}
