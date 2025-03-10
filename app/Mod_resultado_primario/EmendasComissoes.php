<?php

namespace App\Mod_resultado_primario;

use Illuminate\Database\Eloquent\Model;

class EmendasComissoes extends Model

{

   protected $connection   = 'pgsql_corp';

   protected $table = 'mcid_resultado_primario.tab_emendas_comissoes';

   public $timestamps = true; // tabela não possui coluna de data de criação/atualização

   protected $fillable = [
      'oficio_emenda_id',
      'num_emenda',
      'txt_beneficiario',
      'txt_cnpj',
      'txt_uf',
      'municipio_id',
      'cod_modalidade',
      'txt_funcional_programatica',
      'txt_acao',
      'nun_gnd',
      'vlr_emenda',
      'num_lote',
      'txt_resultado_primario',
      'txt_status',
      'num_ano_emenda',
      'bln_valida_beneficiario',
      'bln_valida_cnpj',
      'bln_valida_valor',
      'bln_registro_validado',
      'dte_validacao_registro',
      'user_id'
   ];
}