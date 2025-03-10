<?php

namespace App\Mod_plancidades;

use Illuminate\Database\Eloquent\Model;

class ProgramaObjetivoEstrategico extends Model
{

   protected $connection   = 'pgsql_corp';

   protected $table = 'mcid_plancidades.rlc_programa_objetivo_estrategico';

   public $timestamps = false; // tabela não possui coluna de data de criação/atualização


}
