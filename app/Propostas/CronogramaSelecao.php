<?php

namespace App\Propostas;

use Illuminate\Database\Eloquent\Model;

class CronogramaSelecao extends Model

{

   protected $connection	= 'pgsql_corp';

    protected $table = 'mcid_propostas.tab_cronograma_selecao';

    public $timestamps = false; // tabela não possui coluna de data de criação/atualização

    public function selecao()
    {
       return $this->belongsTo(Selecao::class); //possui muitos
    }

}
