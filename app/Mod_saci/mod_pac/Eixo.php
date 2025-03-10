<?php

namespace App\Mod_saci\mod_pac;

use Illuminate\Database\Eloquent\Model;

class Eixo extends Model
{
    protected $connection    = 'pgsql_corp';

    protected $table = 'pac.opc_eixos';

    protected $primaryKey = 'cod_eixo';


    public $timestamps = false; // tabela não possui coluna de data de criação/atualização


}
