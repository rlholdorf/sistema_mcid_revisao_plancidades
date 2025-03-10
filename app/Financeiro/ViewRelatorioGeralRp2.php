<?php

namespace App\Financeiro;

use Illuminate\Database\Eloquent\Model;

class ViewRelatorioGeralRp2 extends Model
{

   protected $connection	= 'pgsql_corp';

    protected $table = 'mcid_financeiro.view_sys_relatorio_geral_rp2';
   
    public $timestamps = false; // tabela não possui coluna de data de criação/atualização 

}
