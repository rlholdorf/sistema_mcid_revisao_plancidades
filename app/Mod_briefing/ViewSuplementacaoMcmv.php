<?php

namespace App\Mod_briefing;

use Illuminate\Database\Eloquent\Model;

class ViewSuplementacaoMcmv extends Model

{

    protected $connection    = 'pgsql_corp';

    protected $table = 'mcid_briefing_carteira_investimento.view_suplementacao_mcmv';

    public $timestamps = false; // tabela não possui coluna de data de criação/atualização

}