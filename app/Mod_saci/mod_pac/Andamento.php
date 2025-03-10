<?php

namespace App\Mod_saci\mod_pac;

use Illuminate\Database\Eloquent\Model;

class Andamento extends Model
{
    protected $connection	= 'pgsql_corp';
    
   protected $table = 'pac.opc_andamentos';

   protected $primaryKey = 'cod_andamento';


    public $timestamps = false; // tabela não possui coluna de data de criação/atualização
    

}
