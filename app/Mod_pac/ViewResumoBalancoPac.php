<?php

namespace App\Mod_pac;

use Illuminate\Database\Eloquent\Model;

class ViewResumoBalancoPac extends Model
{

  protected $connection  = 'pgsql_corp';

  protected $table = 'mcid_pac.view_resumo_balanco_pac';

  public $timestamps = false; // tabela não possui coluna de data de criação/atualização

}