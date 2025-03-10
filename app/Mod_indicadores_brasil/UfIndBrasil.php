<?php

namespace App\Mod_indicadores_brasil;

use App\IndicadoresHabitacionais\Uf;
use Illuminate\Database\Eloquent\Model;

class UfIndBrasil extends Model
{

  protected $connection  = 'pgsql_corp';

  protected $primaryKey = 'id_uf';

  protected $table = 'mcid_indicadores_brasil.tab_uf';


  public $timestamps = false; // tabela não possui coluna de data de criação/atualização

  public function municipiosIndBrasil()
  {
    return $this->hasMany(MunicipiosIndBrasil::class, 'id_municipio', 'id_municipio'); //possui muitos
  }
}