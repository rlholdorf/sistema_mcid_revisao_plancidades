<?php

namespace App\Mod_plancidades;

use Illuminate\Database\Eloquent\Model;

class ProgramaSubmetaOds extends Model
{

   protected $connection   = 'pgsql_corp';

   protected $table = 'mcid_plancidades.rlc_programa_submeta_ods';

   public $timestamps = false; // tabela não possui coluna de data de criação/atualização


}
