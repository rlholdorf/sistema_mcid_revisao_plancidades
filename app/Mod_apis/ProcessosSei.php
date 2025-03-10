<?php

namespace App\Mod_apis;

use Illuminate\Database\Eloquent\Model;

class ProcessosSei extends Model

{

    protected $connection    = 'pgsql_corp';

    protected $table = 'mcid_sistema_apis.tab_processos_sei';

    public $timestamps = false; // tabela não possui coluna de data de criação/atualização

}