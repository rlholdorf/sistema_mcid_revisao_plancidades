<?php

namespace App\Mod_bndes;

use Illuminate\Database\Eloquent\Model;

class RlcAndamentoSituacaoObra extends Model

{

   protected $connection	= 'pgsql_corp';

    protected $table = 'mcid_bndes.rlc_andamento_situacao_obra';
   
    public $timestamps = false; // tabela não possui coluna de data de criação/atualização

}
