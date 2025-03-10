<?php

namespace App\Mod_briefing;

use Illuminate\Database\Eloquent\Model;

class ViewNovoPacRelatorio extends Model

{

    protected $connection    = 'pgsql_corp';

    protected $table = 'mcid_briefing_carteira_investimento.view_novo_pac_relatorio';

    public $timestamps = false; // tabela não possui coluna de data de criação/atualização

}
