<?php

namespace App\Corporativo\Mcid_carteira_investimento;

use Illuminate\Database\Eloquent\Model;

class Fonte extends Model
{
    protected $connection    = 'pgsql_corp';

    protected $table = 'mcid_carteira_investimento.opc_fonte';

    protected $primaryKey = 'cod_fonte';


    public $timestamps = false; // tabela não possui coluna de data de criação/atualização


}
