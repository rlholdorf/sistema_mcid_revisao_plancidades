<?php

namespace App\Mod_plancidades;

use Illuminate\Database\Eloquent\Model;

class SituacoesMonitoramentos extends Model
{

   protected $connection   = 'pgsql_corp';

   protected $table = 'mcid_plancidades.opc_situacao_monitoramento';

   public $timestamps = false; // tabela possui coluna de data de criação/atualização

   public $incrementing = false;
}
