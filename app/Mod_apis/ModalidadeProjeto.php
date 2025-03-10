<?php

namespace App\Mod_apis;

use Illuminate\Database\Eloquent\Model;

class ModalidadeProjeto extends Model

{

    protected $connection    = 'pgsql_corp';

    protected $table = 'mcid_sistema_apis.opc_modalidade_projeto';

    public $timestamps = false; // tabela não possui coluna de data de criação/atualização

}