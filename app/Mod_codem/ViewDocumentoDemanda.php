<?php

namespace App\Mod_codem;

use Illuminate\Database\Eloquent\Model;

class ViewDocumentoDemanda extends Model
{

    protected $connection	= 'pgsql_corp';
    
    protected $table = 'mcid_codem.view_documentos_demanda';

    public $timestamps = false; // tabela não possui coluna de data de criação/atualização
    
    
}
