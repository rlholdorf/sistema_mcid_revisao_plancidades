<?php

namespace App\Mod_plancidades;

use Illuminate\Database\Eloquent\Model;

class Regionalizacao extends Model
{

   protected $connection  = 'pgsql_corp';

   protected $table = 'mcid_plancidades.opc_regionalizacao';

   public $timestamps = false; // tabela possui coluna de data de criação/atualização


}