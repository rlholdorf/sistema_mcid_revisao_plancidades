<?php

namespace App\Mod_pac;

use Illuminate\Database\Eloquent\Model;

class AnaliseExecucaoPac extends Model
{

  protected $connection  = 'pgsql_corp';

  protected $table = 'mcid_pac.tab_tmp_analise_execucao';


  public $timestamps = false; // tabela não possui coluna de data de criação/atualização


}
