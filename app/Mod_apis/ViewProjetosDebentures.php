<?php

namespace App\Mod_apis;

use Illuminate\Database\Eloquent\Model;

class ViewProjetosDebentures extends Model

{

    protected $connection    = 'pgsql_corp';

    protected $table = 'mcid_sistema_apis.view_projetos_debentures';

    public $timestamps = false; // tabela não possui coluna de data de criação/atualização

}