<?php

namespace App\Mod_plancidades;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ViewResumoApuracaoMetaIndicador extends Model
{

   protected $connection   = 'pgsql_corp';

   protected $table = 'mcid_plancidades.view_resumo_apuracao_meta_indicador';

   public $timestamps = true; // tabela possui coluna de data de criação/atualização


}