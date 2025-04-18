<?php

namespace App\Corporativo\Mcid_carteira_investimento;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Desembolsos extends Model
{

   protected $connection   = 'pgsql_corp';

   protected $primaryKey = 'num_ordem_bancaria';

   protected $keyType = 'string';


   protected $table = 'mcid_carteira_investimento.tab_desembolsos';

   public $timestamps = false; // tabela possui coluna de data de criação/atualização

}
