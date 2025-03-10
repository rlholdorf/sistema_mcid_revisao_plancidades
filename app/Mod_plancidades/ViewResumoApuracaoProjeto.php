<?php

namespace App\Mod_plancidades;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ViewResumoApuracaoProjeto extends Model
{

   protected $connection   = 'pgsql_corp';

   protected $table = 'mcid_plancidades.view_resumo_apuracao_projeto';

   public $timestamps = true; // tabela possui coluna de data de criação/atualização


}