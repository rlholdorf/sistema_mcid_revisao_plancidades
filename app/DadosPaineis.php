<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DadosPaineis extends Model
{

  protected $connection	= 'pgsql_corp';

    protected $table = 'mcid_sistema_se.tab_dados_paineis';

    //public $timestamps = false; // tabela não possui coluna de data de criação/atualização

    
}
