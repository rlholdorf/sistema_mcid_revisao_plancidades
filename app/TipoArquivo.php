<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoArquivo extends Model
{

  protected $connection	= 'pgsql_corp';

    protected $table = 'mcid_sistema_se.opc_tipo_arquivo';

    public $timestamps = false; // tabela não possui coluna de data de criação/atualização

    
}
