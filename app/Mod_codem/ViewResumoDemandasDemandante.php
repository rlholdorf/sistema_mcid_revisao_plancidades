<?php

namespace App\Mod_codem;

use Illuminate\Database\Eloquent\Model;

class ViewResumoDemandasDemandante extends Model
{

    protected $connection    = 'pgsql_corp';

    protected $table = 'mcid_codem.view_resumo_demandas_demandantes';

    public $timestamps = false; // tabela não possui coluna de data de criação/atualização


}
