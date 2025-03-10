<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StatusUsuario extends Model
{

	protected $connection	= 'pgsql_corp';

    protected $table = 'opc_status_usuario';
	public $timestamps = false;

	public function users(){
		return $this->hasMany(User::class);
	}
}
