<?php

namespace App\Corporativo\Mcid_carteira_investimento;

use Illuminate\Database\Eloquent\Model;

class TabCarteiraInvestimento extends Model
{

    protected $connection    = 'pgsql_corp';

    protected $keyType = 'string';

    protected $primaryKey = 'cod_tci';


    protected $table = 'mcid_carteira_investimento.tab_carteira_investimento_mcid';

    //public $timestamps = false; // tabela não possui coluna de data de criação/atualização


}
