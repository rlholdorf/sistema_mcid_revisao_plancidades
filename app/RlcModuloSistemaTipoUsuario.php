<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RlcModuloSistemaTipoUsuario extends Model
{

  protected $connection	= 'pgsql_corp';

    protected $table = 'mcid_sistema_se.rlc_modulo_sistema_tipo_usuario';

    public $timestamps = false; // tabela não possui coluna de data de criação/atualização

    
}
