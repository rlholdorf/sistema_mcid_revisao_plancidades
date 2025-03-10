<?php

namespace App\Mod_briefing;

use Illuminate\Database\Eloquent\Model;

class OrcamentoPorRegiao extends Model

{

    protected $connection    = 'pgsql_corp';

    protected $table = 'mcid_briefing_carteira_investimento.tab_orcamento_por_regiao';

    public $timestamps = false; // tabela não possui coluna de data de criação/atualização

}