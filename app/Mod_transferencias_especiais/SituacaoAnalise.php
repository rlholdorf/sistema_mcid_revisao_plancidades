<?php

namespace App\Mod_transferencias_especiais;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class SituacaoAnalise extends Model
{

   protected $connection   = 'pgsql_corp';

   protected $table = 'mcid_transferencia_especiais_novo.opc_situacao_analise';

   public $timestamps = false; // tabela possui coluna de data de criação/atualização

   public $incrementing = false;
}