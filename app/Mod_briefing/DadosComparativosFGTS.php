<?php

namespace App\Mod_briefing;

use Illuminate\Database\Eloquent\Model;

class DadosComparativosFGTS extends Model

{

    protected $connection    = 'pgsql_corp';

    protected $table = 'mcid_briefing_carteira_investimento.tab_dados_comparativos_fgts';

    public $timestamps = false; // tabela não possui coluna de data de criação/atualização

}