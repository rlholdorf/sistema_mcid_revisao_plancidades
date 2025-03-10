<?php

namespace App\Mod_saci\mod_pac;

use Illuminate\Database\Eloquent\Model;

class Fonte extends Model
{
    protected $connection    = 'pgsql_corp';

    protected $table = 'pac.opc_fontes';

    protected $primaryKey = 'cod_fonte';


    public $timestamps = false; // tabela não possui coluna de data de criação/atualização


}
