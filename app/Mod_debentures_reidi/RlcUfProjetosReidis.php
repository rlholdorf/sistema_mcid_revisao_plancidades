<?php

namespace App\Mod_debentures_reidi;

use Illuminate\Database\Eloquent\Model;

class RlcUfProjetosReidis extends Model

{

   protected $connection   = 'pgsql_corp';

   protected $table = 'mcid_debentures_reidi.rlc_uf_projeto_reidi';


   public $timestamps = false; // tabela não possui coluna de data de criação/atualização

}
