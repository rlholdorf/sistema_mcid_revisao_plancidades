<?php

namespace App\Mod_resultado_primario;

use Illuminate\Database\Eloquent\Model;

class SituacoesOficios extends Model

{

   protected $connection   = 'pgsql_corp';

   protected $table = 'mcid_resultado_primario.opc_situacao_oficios';

   public $timestamps = true; // tabela não possui coluna de data de criação/atualização


}