<?php

namespace App\Mod_debentures_reidi;

use Illuminate\Database\Eloquent\Model;

class SetorProjeto extends Model

{

   protected $connection   = 'pgsql_corp';

   protected $table = 'mcid_debentures_reidi.opc_setor_projeto';


   public $timestamps = false; // tabela não possui coluna de data de criação/atualização

   public function projetosDebendures()
   {
      return $this->hasMany(ProjetosDebentures::class);
   }

   public function projetosReidis()
   {
      return $this->hasMany(ProjetosReidis::class);
   }
}
