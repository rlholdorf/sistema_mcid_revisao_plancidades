<?php

namespace App\Mod_plancidades;

use Illuminate\Database\Eloquent\Model;

class Projetos extends Model
{

   protected $connection   = 'pgsql_corp';

   protected $table = 'mcid_plancidades.view_projetos';

   public $timestamps = true; // tabela possui coluna de data de criação/atualização

   public $incrementing = false;
}
