<?php

namespace App\Mod_bndes;

use Illuminate\Database\Eloquent\Model;

class ViewResumoSituacaoObraBndes extends Model

{

   protected $connection	= 'pgsql_corp';

    protected $table = 'mcid_bndes.view_resumo_situacao_obra_uf';
   
    public $timestamps = false; // tabela não possui coluna de data de criação/atualização

}
