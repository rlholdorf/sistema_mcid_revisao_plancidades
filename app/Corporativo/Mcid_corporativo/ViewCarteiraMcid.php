<?php

namespace App\Corporativo\Mcid_corporativo;

use Illuminate\Database\Eloquent\Model;

class ViewCarteiraMcid extends Model
{

  protected $connection  = 'pgsql_corp';

  protected $table = 'mcid_corporativo.viewm_carteira_mcid';

  //public $timestamps = false; // tabela não possui coluna de data de criação/atualização


}