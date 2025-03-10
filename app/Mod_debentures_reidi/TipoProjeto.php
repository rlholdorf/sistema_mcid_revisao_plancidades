<?php

namespace App\Mod_debentures_reidi;

use Illuminate\Database\Eloquent\Model;

class TipoProjeto extends Model

{

   protected $connection   = 'pgsql_corp';

   protected $table = 'mcid_debentures_reidi.opc_tipo_projeto';


   public $timestamps = false; // tabela não possui coluna de data de criação/atualização

   public function projetosDebentures()
   {
      return $this->hasMany(ProjetosDebentures::class);
   }

   public function projetosReidis()
   {
      return $this->hasMany(projetosReidis::class);
   }
}
