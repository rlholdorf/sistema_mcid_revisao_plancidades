<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ConfiguracaoSistema extends Model
{

	protected $connection	= 'pgsql_corp';

    protected $table = 'tab_configuracoes_sistema';
	//public $timestamps = false;

   
}
