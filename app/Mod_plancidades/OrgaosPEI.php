<?php

namespace App\Mod_plancidades;

use Illuminate\Database\Eloquent\Model;

class OrgaosPEI extends Model
{
   protected $connection   = 'pgsql_corp';

   protected $table = 'mcid_plancidades.opc_orgao_pei';

   public $timestamps = false; // tabela não possui coluna de data de criação/atualização

   public $incrementing = false;

}
