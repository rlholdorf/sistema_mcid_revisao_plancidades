<?php

namespace App\Corporativo\Mdr_corporativo;

use Illuminate\Database\Eloquent\Model;

class ContratosMcmv extends Model
{

  protected $connection	= 'pgsql_corp';

    protected $table = 'mdr_corporativo.tab_contrato_mcmv';

    //public $timestamps = false; // tabela não possui coluna de data de criação/atualização

    
}
