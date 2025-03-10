<?php

namespace App\Mod_briefing;

use Illuminate\Database\Eloquent\Model;

class TabRetomadasMcmv extends Model

{

    protected $connection    = 'pgsql_corp';

    protected $table = 'mcid_briefing_carteira_investimento.tab_retomadas_autorizadas_mcmv';

    public $timestamps = false; // tabela não possui coluna de data de criação/atualização

}