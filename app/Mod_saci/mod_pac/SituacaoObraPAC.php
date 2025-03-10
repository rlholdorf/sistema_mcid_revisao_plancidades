<?php

namespace App\Mod_saci\mod_pac;

use Illuminate\Database\Eloquent\Model;

class SituacaoObraPAC extends Model
{
    protected $connection    = 'pgsql_corp';

    protected $table = 'pac.opc_situacoes_obras';

    protected $primaryKey = 'cod_situacao_obra';

    public $timestamps = false; // tabela não possui coluna de data de criação/atualização


}
