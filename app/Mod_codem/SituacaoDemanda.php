<?php

namespace App\Mod_codem;

use Illuminate\Database\Eloquent\Model;

class SituacaoDemanda extends Model
{

    protected $connection	= 'pgsql_corp';
    
    protected $table = 'mcid_codem.opc_situacao';

    public $timestamps = false; // tabela não possui coluna de data de criação/atualização
    
}
