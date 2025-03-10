<?php

namespace App\Mod_codem;

use Illuminate\Database\Eloquent\Model;

class Prioridade extends Model
{


    protected $connection	= 'pgsql_corp';
    
    protected $table = 'mcid_codem.opc_prioridade';

    public $timestamps = false; // tabela não possui coluna de data de criação/atualização

    
}
