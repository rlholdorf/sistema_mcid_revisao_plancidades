<?php

namespace App\Propostas;

use Illuminate\Database\Eloquent\Model;

class ViewSysPropostasTransferegov extends Model

{

   protected $connection	= 'pgsql_corp';

    protected $table = 'mcid_propostas.view_sys_propostas_transferegov';

   
    public $timestamps = false; // tabela não possui coluna de data de criação/atualização

    

}
