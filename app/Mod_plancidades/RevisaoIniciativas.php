<?php

namespace App\Mod_plancidades;

use Illuminate\Database\Eloquent\Model;

class RevisaoIniciativas extends Model
{

   protected $connection   = 'pgsql_corp';

   protected $table = 'mcid_hom_plancidades.tab_revisao_iniciativas';

   public $timestamps = true; // tabela possui coluna de data de criação/atualização

}