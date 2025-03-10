<?php

namespace App\Mod_briefing;

use Illuminate\Database\Eloquent\Model;

class ViewNovoPacEixoSubeixo extends Model

{

    protected $connection    = 'pgsql_corp';

    protected $table = 'mcid_briefing_carteira_investimento.view_novo_pac_eixo_subeixo';

    public $timestamps = false; // tabela não possui coluna de data de criação/atualização

}