<?php

namespace App\Mod_apis;

use Illuminate\Database\Eloquent\Model;

class RlcCondicoesEmissao extends Model

{

    protected $connection    = 'pgsql_corp';

    protected $table = 'mcid_sistema_apis.rlc_condicoes_emissao';

    public $timestamps = true; // tabela não possui coluna de data de criação/atualização

}