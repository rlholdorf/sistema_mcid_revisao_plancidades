<?php

namespace App\IndicadoresHabitacionais;

use Illuminate\Database\Eloquent\Model;

class IdhMunicipio extends Model
{
    protected $connection    = 'pgsql_corp';

    protected $table = 'mcid_indicadores_brasil.tab_idh_municipios';

    public $timestamps = false; // tabela não possui coluna de data de criação/atualização

    public function municipios()
    {
        return $this->hasMany(Municipio::class); //possui muitos
    }
}