<?php

namespace App\Mod_codem;

use Illuminate\Database\Eloquent\Model;

class ViewResumoDemandasDemandado extends Model
{

    protected $connection    = 'pgsql_corp';

    protected $table = 'mcid_codem.view_resumo_demandas_demandados';

    public $timestamps = false; // tabela não possui coluna de data de criação/atualização


}
