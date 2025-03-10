<?php

namespace App\Mod_plancidades;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class MonitoramentoProjetos extends Model
{

   protected $connection   = 'pgsql_corp';

   protected $table = 'mcid_plancidades.tab_monitoramento_projetos';

   public $timestamps = true; // tabela possui coluna de data de criação/atualização


}
