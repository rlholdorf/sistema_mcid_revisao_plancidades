<?php

namespace App\Mod_plancidades;

use Illuminate\Database\Eloquent\Model;

class PeriodosMonitoramento extends Model
{
   protected $connection  = 'pgsql_corp';

   protected $table = 'mcid_plancidades.opc_periodo_monitoramento';

   public $timestamps = false; // tabela não possui coluna de data de criação/atualização
   public $incrementing = false;

   public function periodicidade()
   {
      return $this->hasOne(Periodicidades::class, 'id', 'periodicidade_id');
   }
}