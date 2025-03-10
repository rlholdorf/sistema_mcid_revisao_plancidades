<?php

namespace App\Mod_pac;

use Illuminate\Database\Eloquent\Model;

class ViewResumoAnaliseExecucaoPac extends Model
{

  protected $connection  = 'pgsql_corp';

  protected $table = 'mcid_pac.view_sys_resumo_analise_execucao';


  public $timestamps = false; // tabela não possui coluna de data de criação/atualização


}