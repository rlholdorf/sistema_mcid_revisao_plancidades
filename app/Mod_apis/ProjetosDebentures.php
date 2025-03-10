<?php

namespace App\Mod_apis;

use Illuminate\Database\Eloquent\Model;

class ProjetosDebentures extends Model

{

    protected $connection    = 'pgsql_corp';

    protected $table = 'mcid_sistema_apis.tab_projetos_debentures';

    public $timestamps = true; // tabela não possui coluna de data de criação/atualização

}