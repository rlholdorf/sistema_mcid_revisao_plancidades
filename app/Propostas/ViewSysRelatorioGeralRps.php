<?php

namespace App\Propostas;

use Illuminate\Database\Eloquent\Model;

class ViewSysRelatorioGeralRps extends Model

{

   protected $connection	= 'pgsql_corp';

    protected $table = 'mcid_propostas.view_sys_relatorio_geral_rps';

   
    public $timestamps = false; // tabela não possui coluna de data de criação/atualização

    

}
