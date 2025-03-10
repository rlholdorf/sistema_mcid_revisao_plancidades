<?php

namespace App\Mod_briefing;

use Illuminate\Database\Eloquent\Model;

class ViewCarteiraMcidBriefing extends Model

{

    protected $connection    = 'pgsql_corp';

    protected $table = 'mcid_briefing_carteira_investimento.view_carteira_mcid_briefing_nova';

    public $timestamps = false; // tabela não possui coluna de data de criação/atualização

}