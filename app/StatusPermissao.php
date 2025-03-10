<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StatusPermissao extends Model
{

	protected $connection	= 'pgsql_corp';

    protected $table = 'opc_status_permissao';
	public $timestamps = false;

    public function permissao()
    {
       return $this->belongsTo(Permissoes::class); //possui muitos
    }
}
