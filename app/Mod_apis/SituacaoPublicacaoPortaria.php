<?php

namespace App\Mod_apis;

use Illuminate\Database\Eloquent\Model;

class SituacaoPublicacaoPortaria extends Model

{

    protected $connection    = 'pgsql_corp';

    protected $table = 'mcid_sistema_apis.opc_situacao_publicacao_portaria';

    public $timestamps = false; // tabela não possui coluna de data de criação/atualização

}