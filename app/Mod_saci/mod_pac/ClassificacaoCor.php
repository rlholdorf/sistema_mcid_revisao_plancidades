<?php

namespace App\Mod_saci\mod_pac;

use Illuminate\Database\Eloquent\Model;

class ClassificacaoCor extends Model
{
    protected $connection    = 'pgsql_corp';

    protected $table = 'pac.opc_classificacoes_cores';

    protected $primaryKey = 'cod_classificacao_cor';

    public $timestamps = false; // tabela não possui coluna de data de criação/atualização


}
