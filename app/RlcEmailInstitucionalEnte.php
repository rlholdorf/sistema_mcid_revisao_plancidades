<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RlcEmailInstitucionalEnte extends Model
{

  protected $connection	= 'pgsql_corp';

    protected $table = 'mcid_sistema_se.rlc_email_institucional_ente';

    //public $timestamps = false; // tabela não possui coluna de data de criação/atualização

    
}
