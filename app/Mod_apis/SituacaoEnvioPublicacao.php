<?php

namespace App\Mod_apis;

use Illuminate\Database\Eloquent\Model;

class SituacaoEnvioPublicacao extends Model

{

    protected $connection    = 'pgsql_corp';

    protected $table = 'mcid_sistema_apis.opc_situacao_envio_publicacao_sns';

    public $timestamps = false; // tabela não possui coluna de data de criação/atualização

}