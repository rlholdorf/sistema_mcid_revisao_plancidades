<?php

namespace App\Mod_plancidades;

use Illuminate\Database\Eloquent\Model;

class RlcRestricaoMetaMonitoramentoInic extends Model
{

   protected $connection  = 'pgsql_corp';

   protected $table = 'mcid_plancidades.rlc_restricao_meta_monitoramento_iniciativas';

   public $timestamps = false; // tabela possui coluna de data de criação/atualização

   public function monitoramentoIniciativa()
   {
      return $this->belongsTo(MonitoramentoIniciativas::class);
   }

   public function restricaoAtingimentoMeta()
   {
      return $this->belongsTo(RestricoesAtingimentoMetas::class);
   }
}
