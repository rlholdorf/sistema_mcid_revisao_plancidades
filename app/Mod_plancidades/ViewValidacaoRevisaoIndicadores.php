<?php

namespace App\Mod_plancidades;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ViewValidacaoRevisaoIndicadores extends Model
{

   protected $connection   = 'pgsql_corp';

   protected $keyType = 'string';

   protected $table = 'mcid_hom_plancidades.view_validacao_revisao_indicadores';

   public $timestamps = false; // tabela possui coluna de data de criação/atualização

}
