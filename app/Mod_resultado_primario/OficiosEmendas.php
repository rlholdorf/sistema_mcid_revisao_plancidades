<?php

namespace App\Mod_resultado_primario;

use Illuminate\Database\Eloquent\Model;

class OficiosEmendas extends Model

{

   protected $connection   = 'pgsql_corp';

   protected $table = 'mcid_resultado_primario.tab_oficios_emendas';

   public $timestamps = true; // tabela não possui coluna de data de criação/atualização

   protected $fillable = [
      'txt_num_processo_sei',
      'txt_num_oficio_completo_presidencia',
      'dte_oficio_presidencia',
      'num_documento_sei_oficio_presidencia',
      'txt_num_oficio_completo_congresso',
      'dte_oficio_congresso',
      'num_documento_sei_oficio_congresso',
      'comissao_id',
      'user_id'
   ];
}