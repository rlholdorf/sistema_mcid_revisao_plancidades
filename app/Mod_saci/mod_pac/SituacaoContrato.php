<?php

namespace App\Mod_saci\mod_pac;

use Illuminate\Database\Eloquent\Model;

class SituacaoContrato extends Model
{
    protected $connection    = 'pgsql_corp';

    protected $table = 'pac.opc_situacoes_contratos';

    protected $primaryKey = 'cod_situacao_contrato';

    public $timestamps = false; // tabela não possui coluna de data de criação/atualização

    public function contratoPac()
    {
        return $this->belongsTo(ContratoPac::class, 'cod_situacao_contrato', 'cod_situacao_contrato'); //possui muitos
    }
}
