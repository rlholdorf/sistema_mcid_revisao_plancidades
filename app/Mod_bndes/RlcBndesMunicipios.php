<?php

namespace App\Mod_bndes;

use Illuminate\Database\Eloquent\Model;

class RlcBndesMunicipios extends Model

{

   protected $connection	= 'pgsql_corp';   

    protected $table = 'mcid_bndes.rlc_bndes_municipios';
   
    public $timestamps = false; // tabela não possui coluna de data de criação/atualização

}
