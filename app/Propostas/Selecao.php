<?php

namespace App\Propostas;

use Illuminate\Database\Eloquent\Model;

class Selecao extends Model

{

   protected $connection	= 'pgsql_corp';

    protected $table = 'mcid_propostas.tab_selecao';

    public function cronogramaSelecoes()
    {
       return $this->hasMany(CronogramaSelecao::class); //possui muitos
    }

    public function propostas()
    {
       return $this->hasMany(Propostas::class); //possui muitos
    }
 

}
