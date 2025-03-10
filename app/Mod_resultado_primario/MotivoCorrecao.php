<?php

namespace App\Mod_resultado_primario;

use Illuminate\Database\Eloquent\Model;

class MotivoCorrecao extends Model

{

   protected $connection   = 'pgsql_corp';

   protected $table = 'mcid_resultado_primario.opc_motivo_correcao';

   public $timestamps = true; // tabela não possui coluna de data de criação/atualização


}