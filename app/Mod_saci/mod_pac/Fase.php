<?php

namespace App\Mod_saci\mod_pac;

use Illuminate\Database\Eloquent\Model;

class Fase extends Model
{
    protected $connection    = 'pgsql_corp';

    protected $table = 'pac.opc_fases';

    protected $primaryKey = 'cod_fase';


    public $timestamps = false; // tabela não possui coluna de data de criação/atualização


}
