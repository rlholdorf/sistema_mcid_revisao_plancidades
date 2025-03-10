<?php

namespace App\Mod_codem;

use Illuminate\Database\Eloquent\Model;

class RelacaoDemandas extends Model
{

    protected $connection	= 'pgsql_corp';
    
    protected $table = 'mcid_codem.view_relacao_demandas';

    public $timestamps = false; // tabela não possui coluna de data de criação/atualização

    
}
