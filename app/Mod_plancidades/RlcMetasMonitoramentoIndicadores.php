<?php

namespace App\Mod_plancidades;

use Illuminate\Database\Eloquent\Model;

class RlcMetasMonitoramentoIndicadores extends Model
{

   protected $connection   = 'pgsql_corp';

   protected $table = 'mcid_plancidades.rlc_metas_monitoramento_indicadores';

   public $timestamps = true; // tabela não possui coluna de data de criação/atualização

   public function monitoramentoIndicadores()
   {
      return $this->hasOne(MonitoramentoIndicadores::class, 'id', 'monitoramento_indicador_id');
   }

   public function metaIndicador()
   {
      return $this->hasOne(MetasObjetivosEstrategicos::class, 'id', 'meta_indicador_id');
   }

   public function regionalizacaoMetaIndicador()
   {
      return $this->hasOne(RegionalizacaoMetaObjEstr::class, 'id', 'regionalizacao_meta_indicador_id');
   }
}