<?php

namespace App\Mod_plancidades;

use Illuminate\Database\Eloquent\Model;

class RlcMonitoramentoIniciativas extends Model
{

    protected $connection	= 'pgsql_corp';
    
    protected $table = 'mcid_plancidades.view_monitoramento_indicador_iniciativa';

    public $timestamps = false; // tabela não possui coluna de data de criação/atualização

    
}
