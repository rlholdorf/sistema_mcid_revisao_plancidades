<?php

namespace App\Corporativo\Mcid_corporativo;

use Illuminate\Database\Eloquent\Model;

class ViewCarteiraInvestimento extends Model
{

  protected $connection  = 'pgsql_corp';

  protected $table = 'mcid_corporativo2.view_mat_sys_carteira_investimento_mcid';

  //public $timestamps = false; // tabela não possui coluna de data de criação/atualização


}