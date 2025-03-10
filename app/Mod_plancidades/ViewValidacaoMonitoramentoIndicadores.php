<?php

namespace App\Mod_plancidades;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ViewValidacaoMonitoramentoIndicadores extends Model
{

   protected $connection   = 'pgsql_corp';

   protected $keyType = 'string';

   protected $table = 'mcid_plancidades.view_validacao_monitoramento_indicadores';

   public $timestamps = false; // tabela possui coluna de data de criação/atualização

}
