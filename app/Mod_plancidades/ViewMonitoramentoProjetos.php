<?php

namespace App\Mod_plancidades;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ViewMonitoramentoProjetos extends Model
{

   protected $connection   = 'pgsql_corp';

   protected $primaryKey = 'monitoramento_projeto_id';

   protected $table = 'mcid_plancidades.view_monitoramento_projetos';

   public $timestamps = true; // tabela possui coluna de data de criação/atualização

   public $incrementing = false;
}
