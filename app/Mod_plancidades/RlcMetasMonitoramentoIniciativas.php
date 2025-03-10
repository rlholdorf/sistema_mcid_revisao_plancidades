<?php

namespace App\Mod_plancidades;

use Illuminate\Database\Eloquent\Model;

class RlcMetasMonitoramentoIniciativas extends Model
{

   protected $connection   = 'pgsql_corp';

   protected $table = 'mcid_plancidades.rlc_metas_monitoramento_iniciativas';

   public $timestamps = true; // tabela não possui coluna de data de criação/atualização

   public function monitoramentoIniciativa()
   {
      return $this->hasOne(MonitoramentoIniciativas::class, 'id', 'monitoramento_iniciativa_id');
   }

   public function metaIniciativa()
   {
      return $this->hasOne(MetasIniciativas::class, 'id', 'meta_iniciativa_id');
   }

   public function regionalizacaoMetaIniciativa()
   {
      return $this->hasOne(RegionalizacaoMetaIniciativa::class, 'id', 'regionalizacao_meta_iniciativa_id');
   }
}