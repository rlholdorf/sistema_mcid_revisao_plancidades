<?php

namespace App\Mod_plancidades;

use Illuminate\Database\Eloquent\Model;

class DesagregacaoMetaObjEspecifico extends Model
{

   protected $connection   = 'pgsql_corp';

   protected $table = 'mcid_plancidades.tab_desagregacao_meta_obj_especifico';

   public $timestamps = true; // tabela possui coluna de data de criação/atualização


}
