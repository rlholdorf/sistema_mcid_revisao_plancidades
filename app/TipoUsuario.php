<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoUsuario extends Model
{

  protected $connection	= 'pgsql_corp';

    protected $table = 'mcid_sistema_se.opc_tipo_usuario';

    public $timestamps = false; // tabela não possui coluna de data de criação/atualização

    public function users(){
		return $this->hasMany(User::class);
	}
}
