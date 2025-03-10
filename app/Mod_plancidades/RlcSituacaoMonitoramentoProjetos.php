<?php

namespace App\Mod_plancidades;

use Illuminate\Database\Eloquent\Model;

class RlcSituacaoMonitoramentoProjetos extends Model
{

   protected $connection   = 'pgsql_corp';

   protected $table = 'mcid_plancidades.rlc_situacao_monitoramento_projetos';

   public $timestamps = false; // tabela possui coluna de data de criação/atualização


}
