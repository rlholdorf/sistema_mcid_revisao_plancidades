<?php

namespace App\Corporativo\Mcid_carteira_investimento;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class SituacaoObjeto extends Model
{

   protected $connection   = 'pgsql_corp';

   protected $primaryKey = 'cod_situacao_objeto_mcid';

   protected $table = 'mcid_carteira_investimento.opc_situacao_objeto_mcid';

   public $timestamps = false; // tabela possui coluna de data de criação/atualização

}
