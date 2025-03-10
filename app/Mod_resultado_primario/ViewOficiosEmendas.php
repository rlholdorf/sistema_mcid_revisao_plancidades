<?php

namespace App\Mod_resultado_primario;

use Illuminate\Database\Eloquent\Model;

class ViewOficiosEmendas extends Model

{

   protected $connection   = 'pgsql_corp';

   protected $table = 'mcid_resultado_primario.view_oficios_emendas';

   public $timestamps = false; // tabela não possui coluna de data de criação/atualização


}
