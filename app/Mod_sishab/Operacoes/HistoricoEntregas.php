<?php

namespace App\Mod_sishab\Operacoes;

use Illuminate\Database\Eloquent\Model;

class HistoricoEntregas extends Model


{

    protected $connection   = 'pgsql';

    protected $table = 'operacoes_sishab.tab_hist_entregas';

    public $timestamps = false; // tabela não possui coluna de data de criação/atualização


}
