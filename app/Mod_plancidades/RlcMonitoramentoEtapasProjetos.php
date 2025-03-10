<?php

namespace App\Mod_plancidades;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class RlcMonitoramentoEtapasProjetos extends Model
{

   protected $connection   = 'pgsql_corp';

   protected $table = 'mcid_plancidades.rlc_monitoramento_projetos_etapas';

   public $timestamps = true; // tabela possui coluna de data de criação/atualização


}
