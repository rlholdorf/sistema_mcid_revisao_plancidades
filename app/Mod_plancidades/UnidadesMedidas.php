<?php

namespace App\Mod_plancidades;

use Illuminate\Database\Eloquent\Model;

class UnidadesMedidas extends Model
{

   protected $connection   = 'pgsql_corp';

   protected $table = 'mcid_plancidades.opc_unidades_medidas';

   public $timestamps = false; // tabela não possui coluna de data de criação/atualização

   public $incrementing = false;

}
