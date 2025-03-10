<?php

namespace App\Mod_bndes;

use Illuminate\Database\Eloquent\Model;

class Mobilidade extends Model

{

   protected $connection	= 'pgsql_corp';

    protected $table = 'mcid_bndes.opc_modalidade';
   
    public $timestamps = false; // tabela não possui coluna de data de criação/atualização

}
