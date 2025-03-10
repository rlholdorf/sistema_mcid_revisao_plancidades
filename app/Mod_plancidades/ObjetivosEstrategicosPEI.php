<?php

namespace App\Mod_plancidades;

use Illuminate\Database\Eloquent\Model;

class ObjetivosEstrategicosPEI extends Model
{

   protected $connection  = 'pgsql_corp';

   protected $keyType = 'string';

   protected $table = 'mcid_plancidades.opc_objetivos_estrategicos_pei';

   public $timestamps = false; // tabela não possui coluna de data de criação/atualização

   
}