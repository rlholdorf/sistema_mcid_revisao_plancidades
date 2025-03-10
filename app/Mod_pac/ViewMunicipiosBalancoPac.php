<?php

namespace App\Mod_pac;

use Illuminate\Database\Eloquent\Model;

class ViewMunicipiosBalancoPac extends Model
{

  protected $connection  = 'pgsql_corp';

  protected $table = 'mcid_pac.view_municipios_balanco_pac';

  public $timestamps = false; // tabela não possui coluna de data de criação/atualização

  public function balancoPac()
  {
    return $this->belongsTo(ViewBalancoPac::class, 'cod_registro', 'cod_registro'); //possui muitos
  }
}
