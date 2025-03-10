<?php

namespace App\Mod_bndes;

use Illuminate\Database\Eloquent\Model;

class Bndes extends Model

{

   protected $connection	= 'pgsql_corp';

   protected $primaryKey = 'cod_bndes';

    public $keyType = 'integer';

    protected $table = 'mcid_bndes.tab_bndes';
   
    public $timestamps = false; // tabela não possui coluna de data de criação/atualização

}
