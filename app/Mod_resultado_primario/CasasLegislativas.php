<?php

namespace App\Mod_resultado_primario;

use Illuminate\Database\Eloquent\Model;

class CasasLegislativas extends Model

{

   protected $connection   = 'pgsql_corp';

   protected $table = 'mcid_resultado_primario.opc_casas_legislativas';

   public $timestamps = false; // tabela não possui coluna de data de criação/atualização


}
