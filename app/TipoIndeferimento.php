<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoIndeferimento extends Model
{

	protected $connection	= 'pgsql_corp';

    protected $table = 'opc_tipo_indeferimento';
	public $timestamps = false;

	public function permissao()
    {
       return $this->belongsTo(Permissoes::class,'tipo_indeferimento_id','id'); //possui muitos
    }


}
