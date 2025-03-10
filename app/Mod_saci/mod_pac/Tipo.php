<?php

namespace App\Mod_saci\mod_pac;

use Illuminate\Database\Eloquent\Model;

class Tipo extends Model
{
    protected $connection    = 'pgsql_corp';

    protected $table = 'pac.opc_tipos';

    protected $primaryKey = 'cod_tipo';

    public $timestamps = false; // tabela não possui coluna de data de criação/atualização


}
