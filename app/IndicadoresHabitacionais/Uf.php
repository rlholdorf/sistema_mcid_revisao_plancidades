<?php

namespace App\IndicadoresHabitacionais;

use Illuminate\Database\Eloquent\Model;

class Uf extends Model
{
    protected $connection	= 'pgsql';

    protected $table = '_indicadores_habitacionais.tab_uf';

    public $timestamps = false; // tabela não possui coluna de data de criação/atualização

    public function municipios()
    {
       return $this->hasMany(Municipio::class); //possui muitos
    }



}
