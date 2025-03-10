<?php

namespace App\Mod_debentures_reidi;

use Illuminate\Database\Eloquent\Model;

class ProjetosReidis extends Model

{

   protected $connection   = 'pgsql_corp';

   protected $table = 'mcid_debentures_reidi.tab_projetos_reidis';


   public $timestamps = true; // tabela não possui coluna de data de criação/atualização

   public function setorProjeto()
   {
      return $this->belongsTo(SetorProjeto::class);
   }
}
