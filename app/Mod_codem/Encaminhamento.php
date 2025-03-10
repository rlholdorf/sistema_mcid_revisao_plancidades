<?php

namespace App\Mod_codem;

use Illuminate\Database\Eloquent\Model;

class Encaminhamento extends Model
{

    protected $connection	= 'pgsql_corp';
    
    protected $table = 'mcid_codem.tab_encaminhamento';

    public $timestamps = false; // tabela não possui coluna de data de criação/atualização

    
}
