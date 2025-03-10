<?php

namespace App\Mod_resultado_primario;

use Illuminate\Database\Eloquent\Model;

class ProgramasRps extends Model

{

   protected $connection   = 'pgsql_corp';

   protected $table = 'mcid_resultado_primario.tab_programas_rps';

   public $timestamps = true; // tabela não possui coluna de data de criação/atualização


}
