<?php

namespace App\Mod_plancidades;

use Illuminate\Database\Eloquent\Model;

class TabProjetos extends Model
{

   protected $connection   = 'pgsql_corp';

   protected $table = 'mcid_plancidades.tab_projetos';

   public $timestamps = false; // tabela possui coluna de data de criação/atualização

   public $incrementing = false;
}
