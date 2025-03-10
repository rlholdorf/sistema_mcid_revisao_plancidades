<?php

namespace App\Mod_plancidades;

use Illuminate\Database\Eloquent\Model;

class RlcRestricaoMetaMonitoramentoIndic extends Model
{

   protected $connection  = 'pgsql_corp';

   protected $table = 'mcid_plancidades.rlc_restricao_meta_monitoramento_indicadores';

   public $timestamps = false; // tabela possui coluna de data de criação/atualização

   public function monitoramentoIndicador()
   {
      return $this->belongsTo(MonitoramentoIndicadores::class);
   }

   public function restricaoAtingimentoMeta()
   {
      return $this->belongsTo(RestricoesAtingimentoMetas::class);
   }
}