<?php

namespace App\IndicadoresHabitacionais;

use Illuminate\Database\Eloquent\Model;

class Regiao extends Model
{
    protected $connection	= 'pgsql';

    protected $table = '_indicadores_habitacionais.tab_regiao';

    public $timestamps = false; // tabela não possui coluna de data de criação/atualização

    public function ufs()
    {
       return $this->hasMany(Uf::class); //possui muitos
    }
}
