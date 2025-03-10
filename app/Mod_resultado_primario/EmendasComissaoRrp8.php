<?php

namespace App\Mod_resultado_primario;

use Illuminate\Database\Eloquent\Model;

class EmendasComissaoRrp8 extends Model

{

   protected $connection   = 'pgsql_corp';

   protected $table = 'mcid_resultado_primario.tab_emendas_comissao_rp8';

   public $timestamps = false; // tabela não possui coluna de data de criação/atualização

   protected $fillable = [
      'txt_casa_legislativa', 'txt_comissao', 'txt_presidente'
   ];
}
