<?php

namespace App\Corporativo\Mcid_carteira_investimento;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Subfonte extends Model
{

   protected $connection   = 'pgsql_corp';

   protected $primaryKey = 'cod_sub_fonte';

   protected $table = 'mcid_carteira_investimento.opc_sub_fonte';

   public $timestamps = false; // tabela possui coluna de data de criação/atualização

}
