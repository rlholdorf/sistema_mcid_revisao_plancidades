<?php

namespace App\Mod_saci\mod_pac;

use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    protected $connection    = 'pgsql_corp';

    protected $table = 'pac.opc_eventos';

    protected $primaryKey = 'cod_evento';


    public $timestamps = false; // tabela não possui coluna de data de criação/atualização


}
