<?php

namespace App\Mod_plancidades;

use Illuminate\Database\Eloquent\Model;

class ObjetivosEspecificos extends Model
{

   protected $connection  = 'pgsql_corp';

   protected $table = 'mcid_plancidades.opc_objetivos_especificos';

   protected $keyType = 'string';

   public $timestamps = true; // tabela possui coluna de data de criação/atualização


}