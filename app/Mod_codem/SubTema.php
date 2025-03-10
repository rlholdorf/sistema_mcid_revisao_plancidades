<?php

namespace App\Mod_codem;

use Illuminate\Database\Eloquent\Model;

class SubTema extends Model
{

    protected $connection	= 'pgsql_corp';
    
    protected $table = 'mcid_codem.opc_subtema';

    public $timestamps = false; // tabela não possui coluna de data de criação/atualização

    
}
