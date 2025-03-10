<?php

namespace App\Corporativo\Pendencias_caixa;

use Illuminate\Database\Eloquent\Model;

class ViewNovoPac extends Model
{

  protected $connection	= 'pgsql_corp';

    protected $table = 'pendencias_caixa.novo_pac';

    public $timestamps = false; // tabela não possui coluna de data de criação/atualização

    
}
