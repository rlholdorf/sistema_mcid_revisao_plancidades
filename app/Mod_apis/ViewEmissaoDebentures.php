<?php

namespace App\Mod_apis;

use Illuminate\Database\Eloquent\Model;

class ViewEmissaoDebentures extends Model

{

    protected $connection    = 'pgsql_corp';

    protected $table = 'mcid_sistema_apis.view_emissao_debentures';

    public $timestamps = false; // tabela não possui coluna de data de criação/atualização

}