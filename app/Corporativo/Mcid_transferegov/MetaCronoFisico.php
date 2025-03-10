<?php

namespace App\Corporativo\Mcid_transferegov;

use Illuminate\Database\Eloquent\Model;

class MetaCronoFisico extends Model
{

  protected $connection  = 'pgsql_corp';

  protected $primaryKey = 'cod_meta';

  protected $table = 'mcid_transferegov.tab_meta_crono_fisico';

  //public $timestamps = false; // tabela não possui coluna de data de criação/atualização

  public function etapas()
  {
    return $this->hasMany(EtapaCronoFisico::class, 'cod_meta')->orderBy('num_etapa'); //possui muitos
  }
}
