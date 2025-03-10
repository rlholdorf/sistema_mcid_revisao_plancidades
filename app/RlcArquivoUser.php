<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RlcArquivoUser extends Model
{

  protected $connection	= 'pgsql_corp';

    protected $table = 'mcid_sistema_se.rlc_arquivo_users';

    //public $timestamps = false; // tabela não possui coluna de data de criação/atualização

    
}
