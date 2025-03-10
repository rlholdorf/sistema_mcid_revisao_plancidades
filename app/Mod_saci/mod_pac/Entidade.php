<?php

namespace App\Mod_saci\mod_pac;

use Illuminate\Database\Eloquent\Model;

class Entidade extends Model
{
    protected $connection    = 'pgsql_corp';

    protected $table = 'pac.tab_entidades';

    protected $primaryKey = 'cod_entidade';

    public $timestamps = false; // tabela não possui coluna de data de criação/atualização


}
