<?php

namespace App\Mod_debentures_reidi;

use Illuminate\Database\Eloquent\Model;

class ViewProjetosReidis extends Model

{

   protected $connection   = 'pgsql_corp';

   protected $table = 'mcid_debentures_reidi.view_projetos_reidis';


   public $timestamps = false; // tabela não possui coluna de data de criação/atualização





}
