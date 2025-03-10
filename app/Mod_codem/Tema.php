<?php

namespace App\Mod_codem;

use Illuminate\Database\Eloquent\Model;

class Tema extends Model
{

    protected $connection	= 'pgsql_corp';
    
    protected $table = 'mcid_codem.opc_tema';

    public $timestamps = false; // tabela não possui coluna de data de criação/atualização

    
}
