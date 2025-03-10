<?php

namespace App\Mod_codem;

use Illuminate\Database\Eloquent\Model;

class ObservacaoDemanda extends Model
{

    protected $connection	= 'pgsql_corp';
    
    protected $table = 'mcid_codem.tab_observacao_demanda';

    public $timestamps = false; // tabela não possui coluna de data de criação/atualização

    
}
