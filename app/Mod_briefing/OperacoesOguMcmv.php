<?php

namespace App\Mod_briefing;

use Illuminate\Database\Eloquent\Model;

class OperacoesOguMcmv extends Model

{

    protected $connection    = 'pgsql_corp';

    protected $table = 'mcid_briefing_carteira_investimento.tab_operacoes_ogu_mcmv';

    public $timestamps = false; // tabela não possui coluna de data de criação/atualização

}