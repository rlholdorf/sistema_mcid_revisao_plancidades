<?php

namespace App\Mod_resultado_primario;

use Illuminate\Database\Eloquent\Model;

class ViewValidaArquivoEmendas extends Model

{

   protected $connection   = 'pgsql_corp';

   protected $table = 'mcid_resultado_primario.view_sys_valida_arquivo_emendas';

   public $timestamps = false; // tabela não possui coluna de data de criação/atualização


}
