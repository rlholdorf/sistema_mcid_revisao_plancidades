<?php

namespace App\Mod_plancidades;

use Illuminate\Database\Eloquent\Model;

class ObjetivosGerais extends Model
{

   protected $connection  = 'pgsql_corp';

   protected $table = 'mcid_plancidades.opc_objetivos_gerais';

   public $timestamps = true; // tabela possui coluna de data de criação/atualização

   
}