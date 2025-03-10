<?php

namespace App\Mod_plancidades;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class MonitoramentoIndicadores extends Model
{

   protected $connection   = 'pgsql_corp';

   protected $table = 'mcid_plancidades.tab_monitoramento_indicadores';

   public $timestamps = true; // tabela possui coluna de data de criação/atualização

   public function periodoMonitoramento()
   {
      return $this->hasOne(PeriodosMonitoramento::class, 'id', 'periodo_monitoramento_id');
   }
}
