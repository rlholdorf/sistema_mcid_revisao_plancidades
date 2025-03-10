<?php

namespace App\Mod_briefing;

use Illuminate\Database\Eloquent\Model;

class ViewPac extends Model

{

    protected $connection    = 'pgsql_corp';

    protected $table = 'mcid_briefing_carteira_investimento.view_pac';

    public $timestamps = false; // tabela não possui coluna de data de criação/atualização

}