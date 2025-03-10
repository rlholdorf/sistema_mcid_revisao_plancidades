<?php

namespace App\Mod_codem;

use Illuminate\Database\Eloquent\Model;

class TipoDocumento extends Model
{

    protected $connection	= 'pgsql_corp';
    
    protected $table = 'mcid_codem.opc_tipo_documento';

    public $timestamps = false; // tabela não possui coluna de data de criação/atualização

    public function documentoDemandas(){
		return $this->hasMany(RlcDocumentoDemanda::class);
	}
}
