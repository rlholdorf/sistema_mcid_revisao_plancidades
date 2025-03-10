<?php

namespace App\Financeiro;

use Illuminate\Database\Eloquent\Model;

class SituacaoPropostasAjustadas extends Model
{

   protected $connection	= 'pgsql_corp';

    protected $table = 'mcid_financeiro.opc_situacao_proposta_ajustada';
   
    public $timestamps = false; // tabela não possui coluna de data de criação/atualização 

}
