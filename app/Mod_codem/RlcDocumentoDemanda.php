<?php

namespace App\Mod_codem;

use Illuminate\Database\Eloquent\Model;

class RlcDocumentoDemanda extends Model
{

    protected $connection	= 'pgsql_corp';
    
    protected $table = 'mcid_codem.rlc_documento_demanda';

    public $timestamps = false; // tabela não possui coluna de data de criação/atualização

    public function tipoDocumento(){
		return $this->belongsTo(TipoDocumento::class);
	}
    
}
