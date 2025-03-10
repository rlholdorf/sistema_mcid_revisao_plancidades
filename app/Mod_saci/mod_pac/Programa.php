<?php

namespace App\Mod_saci\mod_pac;

use Illuminate\Database\Eloquent\Model;

class Programa extends Model
{
    protected $connection    = 'pgsql_corp';

    protected $table = 'pac.opc_programa';

    protected $primaryKey = 'cod_programa';

    public $timestamps = false; // tabela não possui coluna de data de criação/atualização


}
