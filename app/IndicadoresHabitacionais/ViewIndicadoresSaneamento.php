<?php

namespace App\IndicadoresHabitacionais;

use Illuminate\Database\Eloquent\Model;

class ViewIndicadoresSaneamento extends Model
{
    protected $connection	= 'pgsql_corp';

    protected $table = 'mcid_indicadores_brasil.view_indicadores_saneamento';

    public $timestamps = false; // tabela não possui coluna de data de criação/atualização

   



}
