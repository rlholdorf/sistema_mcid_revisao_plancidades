<?php

namespace App\Mod_plancidades;

use Illuminate\Database\Eloquent\Model;

class RlcProgramaMetaOds extends Model
{

   protected $connection   = 'pgsql_corp';

   protected $table = 'mcid_plancidades.rlc_programa_meta_ods';

   public $timestamps = false; // tabela não possui coluna de data de criação/atualização


}
