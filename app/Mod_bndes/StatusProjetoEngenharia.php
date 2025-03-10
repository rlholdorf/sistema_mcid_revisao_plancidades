<?php

namespace App\Mod_bndes;

use Illuminate\Database\Eloquent\Model;

class StatusProjetoEngenharia extends Model

{

   protected $connection	= 'pgsql_corp';

    protected $table = 'mcid_bndes.opc_status_projeto_engenharia';
   
    public $timestamps = false; // tabela não possui coluna de data de criação/atualização

}
