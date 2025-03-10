<?php

namespace App\Mod_plancidades;

use Illuminate\Database\Eloquent\Model;

class MonitoramentoIniciativas extends Model
{

   protected $connection   = 'pgsql_corp';

   protected $table = 'mcid_plancidades.tab_monitoramento_iniciativas';

   public $timestamps = true; // tabela possui coluna de data de criação/atualização

   public function periodoMonitoramento()
   {
      return $this->hasOne(PeriodosMonitoramento::class, 'id', 'periodo_monitoramento_id');
   }
}