<?php

namespace App\IndicadoresHabitacionais;

use Illuminate\Database\Eloquent\Model;

class BrasilComRm extends Model
{

    protected $connection	= 'pgsql';

   protected $table = '_indicadores_habitacionais.tab_brasil_com_rm';

    public $timestamps = false; // tabela não possui coluna de data de criação/atualização
    
}
