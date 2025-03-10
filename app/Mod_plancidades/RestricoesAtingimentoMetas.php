<?php

namespace App\Mod_plancidades;

use Illuminate\Database\Eloquent\Model;

class RestricoesAtingimentoMetas extends Model
{

   protected $connection  = 'pgsql_corp';

   protected $table = 'mcid_plancidades.opc_restricoes_atingimento_metas';

   public $timestamps = false; // tabela possui coluna de data de criação/atualização


}
