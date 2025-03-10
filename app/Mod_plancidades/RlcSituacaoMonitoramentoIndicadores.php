<?php

namespace App\Mod_plancidades;

use Illuminate\Database\Eloquent\Model;

class RlcSituacaoMonitoramentoIndicadores extends Model
{

   protected $connection  = 'pgsql_corp';

   protected $table = 'mcid_plancidades.rlc_situacao_monitoramento_indicadores';

   public $timestamps = false; // tabela possui coluna de data de criação/atualização

}