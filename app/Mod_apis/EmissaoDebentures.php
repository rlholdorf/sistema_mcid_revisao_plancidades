<?php

namespace App\Mod_apis;

use Illuminate\Database\Eloquent\Model;

class EmissaoDebentures extends Model

{

    protected $connection    = 'pgsql_corp';

    protected $table = 'mcid_sistema_apis.tab_emissao_debentures';

    public $timestamps = true; // tabela não possui coluna de data de criação/atualização

}