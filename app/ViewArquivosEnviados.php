<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ViewArquivosEnviados extends Model
{

  protected $connection	= 'pgsql_corp';

    protected $table = 'mcid_sistema_se.view_arquivos_enviados';

    //public $timestamps = false; // tabela não possui coluna de data de criação/atualização

    
}
