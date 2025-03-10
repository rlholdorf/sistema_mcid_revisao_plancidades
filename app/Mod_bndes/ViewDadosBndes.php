<?php

namespace App\Mod_bndes;

use Illuminate\Database\Eloquent\Model;

class ViewDadosBndes extends Model

{

   protected $connection	= 'pgsql_corp';

    protected $table = 'mcid_bndes.view_dados_bndes';
   
    public $timestamps = false; // tabela não possui coluna de data de criação/atualização

}
