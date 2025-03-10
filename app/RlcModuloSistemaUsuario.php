<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RlcModuloSistemaUsuario extends Model
{

  protected $connection	= 'pgsql_corp';

    protected $table = 'mcid_sistema_se.rlc_modulo_sistema_usuarios';

    public $timestamps = false; // tabela não possui coluna de data de criação/atualização

    
}
