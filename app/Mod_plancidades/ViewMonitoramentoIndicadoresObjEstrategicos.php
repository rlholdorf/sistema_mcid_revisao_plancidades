<?php

namespace App\Mod_plancidades;

use Illuminate\Database\Eloquent\Model;

class ViewMonitoramentoIndicadoresObjEstrategicos extends Model
{

   protected $connection   = 'pgsql_corp';

   protected $primaryKey = 'monitoramento_indicador_id';

   protected $table = 'mcid_plancidades.view_monitoramento_indicadores';

   public $timestamps = true; // tabela possui coluna de data de criação/atualização


}
