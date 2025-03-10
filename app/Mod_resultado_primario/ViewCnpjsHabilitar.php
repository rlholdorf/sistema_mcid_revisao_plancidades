<?php

namespace App\Mod_resultado_primario;

use Illuminate\Database\Eloquent\Model;

class ViewCnpjsHabilitar extends Model

{

   protected $connection   = 'pgsql_corp';

   protected $table = 'mcid_resultado_primario.view_sys_cnpj_habilitar';

   public $timestamps = false; // tabela não possui coluna de data de criação/atualização


}