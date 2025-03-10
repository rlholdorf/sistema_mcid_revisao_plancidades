<?php

namespace App\Mod_saci\mod_pac;

use Illuminate\Database\Eloquent\Model;

class Chamada extends Model
{
    protected $connection    = 'pgsql_corp';

    protected $table = 'pac.tab_chamadas';

    protected $primaryKey = 'cod_chamada';

    public $timestamps = false; // tabela não possui coluna de data de criação/atualização


}
