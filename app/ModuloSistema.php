<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModuloSistema extends Model
{

  protected $connection	= 'pgsql_corp';

    protected $table = 'mcid_sistema_se.opc_modulo_sistema';

    public $timestamps = false; // tabela não possui coluna de data de criação/atualização

    
}
