<?php

namespace App\Corporativo\Mcid_carteira_investimento;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Empenhos extends Model
{

   protected $connection   = 'pgsql_corp';

   protected $primaryKey = 'num_nota_empenho';

   protected $keyType = 'string';


   protected $table = 'mcid_carteira_investimento.tab_empenhos';

   public $timestamps = false; // tabela possui coluna de data de criação/atualização

}
