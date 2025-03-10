<?php

namespace App\Corporativo\Mcid_carteira_investimento;

use Illuminate\Database\Eloquent\Model;

class ViewResumoSecretariaOrigem extends Model
{

    protected $connection    = 'pgsql_corp';

    protected $table = 'mcid_carteira_investimento.view_resumo_secretaria_origem';

    //public $timestamps = false; // tabela não possui coluna de data de criação/atualização


}
