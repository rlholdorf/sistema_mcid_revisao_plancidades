<?php

namespace App\Corporativo\Pendencias_caixa;

use Illuminate\Database\Eloquent\Model;

class ObraFisica extends Model
{

  protected $connection	= 'pgsql_corp';

    protected $table = 'pendencias_caixa.tab_obra_fisica';

    protected $primaryKey = 'cod_projeto';


    public $timestamps = false; // tabela não possui coluna de data de criação/atualização

    
}
