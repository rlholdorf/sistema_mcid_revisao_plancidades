<?php

namespace App\Mod_codem;

use Illuminate\Database\Eloquent\Model;

class RlcSituacaoDemanda extends Model
{

    protected $connection	= 'pgsql_corp';
    
    protected $table = 'mcid_codem.rlc_situacao_demanda';

    public $timestamps = false; // tabela não possui coluna de data de criação/atualização

   
}
