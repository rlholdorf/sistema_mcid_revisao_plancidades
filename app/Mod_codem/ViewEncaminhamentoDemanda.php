<?php

namespace App\Mod_codem;

use Illuminate\Database\Eloquent\Model;

class ViewEncaminhamentoDemanda extends Model
{

    protected $connection	= 'pgsql_corp';
    
    protected $table = 'mcid_codem.view_encaminhamento_demanda';

    //public $timestamps = false; // tabela não possui coluna de data de criação/atualização

    
}
