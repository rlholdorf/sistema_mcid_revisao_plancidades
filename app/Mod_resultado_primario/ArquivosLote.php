<?php

namespace App\Mod_resultado_primario;

use Illuminate\Database\Eloquent\Model;

class ArquivosLote extends Model

{

   protected $connection   = 'pgsql_corp';

   protected $table = 'mcid_resultado_primario.tab_arquivos_lote';

   public $timestamps = true; // tabela não possui coluna de data de criação/atualização


}
