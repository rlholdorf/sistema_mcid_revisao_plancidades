<?php

namespace App\Mod_pac;

use Illuminate\Database\Eloquent\Model;

class ViewBalancoPac extends Model
{

  protected $connection  = 'pgsql_corp';

  protected $table = 'mcid_pac.view_balanco_pac';

  public $timestamps = false; // tabela não possui coluna de data de criação/atualização

  public function etapasPacs()
  {
    return $this->hasMany(ViewEtapaPac::class, 'cod_contrato', 'cod_contrato'); //possui muitos
  }

  public function municipios()
  {
    return $this->hasMany(ViewMunicipiosBalancoPac::class, 'cod_contrato', 'cod_contrato')->orderBy('ds_municipio'); //possui muitos
  }
}
