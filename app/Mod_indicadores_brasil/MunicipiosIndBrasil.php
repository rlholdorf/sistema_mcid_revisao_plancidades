<?php

namespace App\Mod_indicadores_brasil;

use App\IndicadoresHabitacionais\Uf;
use Illuminate\Database\Eloquent\Model;

class MunicipiosIndBrasil extends Model
{

  protected $connection  = 'pgsql_corp';

  protected $primaryKey = 'id_municipio';

  protected $table = 'mcid_indicadores_brasil.tab_municipios';


  public $timestamps = false; // tabela não possui coluna de data de criação/atualização

  public function ufindbrasil()
  {
    return $this->belongsTo(UfIndBrasil::class, 'id_uf', 'id_uf'); //possui muitos
  }
}