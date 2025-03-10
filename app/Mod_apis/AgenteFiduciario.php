<?php

namespace App\Mod_apis;

use App\User;
use Illuminate\Database\Eloquent\Model;

class AgenteFiduciario extends Model

{

    protected $connection    = 'pgsql_corp';

    protected $keyType = 'string';

    protected $table = 'mcid_sistema_apis.tab_agente_fiduciario';

    public $timestamps = false; // tabela não possui coluna de data de criação/atualização

}
