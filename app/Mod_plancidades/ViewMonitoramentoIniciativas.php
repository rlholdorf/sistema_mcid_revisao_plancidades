<?php

namespace App\Mod_plancidades;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ViewMonitoramentoIniciativas extends Model
{

   protected $connection   = 'pgsql_corp';

   protected $primaryKey = 'monitoramento_iniciativa_id';

   protected $table = 'mcid_plancidades.view_monitoramento_iniciativa';

   public $timestamps = true; // tabela possui coluna de data de criação/atualização

}
