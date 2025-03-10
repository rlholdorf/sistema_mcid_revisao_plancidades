<?php

namespace App\Financeiro;

use Illuminate\Database\Eloquent\Model;

class ViewAgrupamentoUfMunicipioRps extends Model
{

   protected $connection	= 'pgsql_corp';

    protected $table = 'mcid_financeiro.view_sys_agrupamento_uf_municipio_rps';
   
    public $timestamps = false; // tabela não possui coluna de data de criação/atualização 

}
