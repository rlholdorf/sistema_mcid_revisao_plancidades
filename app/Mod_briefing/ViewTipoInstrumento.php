<?php

namespace App\Mod_briefing;

use Illuminate\Database\Eloquent\Model;

class ViewTipoInstrumento extends Model

{

    protected $connection    = 'pgsql_corp';

    protected $table = 'mcid_briefing_carteira_investimento.tci_tipo_instrumento';

    public $timestamps = false; // tabela não possui coluna de data de criação/atualização

}