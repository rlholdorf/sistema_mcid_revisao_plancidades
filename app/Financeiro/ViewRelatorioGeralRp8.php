<?php

namespace App\Financeiro;

use Illuminate\Database\Eloquent\Model;

class ViewRelatorioGeralRp8 extends Model
{

   protected $connection	= 'pgsql_corp';

    protected $table = 'mcid_financeiro.view_sys_relatorio_geral_rp8';
   
    public $timestamps = false; // tabela não possui coluna de data de criação/atualização 

}
