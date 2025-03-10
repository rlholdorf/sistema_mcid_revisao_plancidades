<?php

namespace App\Mod_debentures_reidi;

use Illuminate\Database\Eloquent\Model;

class ViewUfProjetosDebentures extends Model

{

   protected $connection   = 'pgsql_corp';

   protected $table = 'mcid_debentures_reidi.view_estados_projetos_debentures';


   public $timestamps = false; // tabela não possui coluna de data de criação/atualização

}
