<?php

namespace App\Mod_plancidades;

use Illuminate\Database\Eloquent\Model;

class Periodicidades extends Model
{
   protected $connection  = 'pgsql_corp';

   protected $table = 'mcid_plancidades.opc_periodicidades';

   public $timestamps = false; // tabela não possui coluna de data de criação/atualização

   public $incrementing = false;
}