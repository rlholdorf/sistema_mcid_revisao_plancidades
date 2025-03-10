<?php

namespace App\Propostas;

use Illuminate\Database\Eloquent\Model;

class ViewSysRelatorioGeralDiscricionarioSistema extends Model

{

   protected $connection	= 'pgsql_corp';

    protected $table = 'mcid_propostas.view_sys_relatorio_geral_discricionario_sistema';

   
    public $timestamps = false; // tabela não possui coluna de data de criação/atualização

    

}
