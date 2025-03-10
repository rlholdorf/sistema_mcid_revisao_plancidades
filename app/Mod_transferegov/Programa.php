<?php

namespace App\Mod_transferegov;

use App\Mod_saci\mod_pac\Eixo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Programa extends Model
{

   protected $connection   = 'pgsql_corp';

   protected $table = 'mcid_paineis.tab_programas_cidades';

   public $timestamps = true; // tabela possui coluna de data de criação/atualização
}
