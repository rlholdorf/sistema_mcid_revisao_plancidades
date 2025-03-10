<?php

namespace App\Mod_pac;

use Illuminate\Database\Eloquent\Model;

class ViewEtapaPac extends Model
{

  protected $connection  = 'pgsql_corp';

  protected $keyType = 'string';

  protected $table = 'mcid_pac.view_etapa_pac_pendencias_caixa';

  public $timestamps = false; // tabela não possui coluna de data de criação/atualização

  public function metasPacs()
  {
    return $this->hasMany(ViewMetasEtapaPac::class, 'etapa_id', 'etapa_id'); //possui muitos
  }

  public function balancoPac()
  {
    return $this->belongsTo(ViewBalancoPac::class, 'cod_contrato', 'cod_contrato'); //possui muitos
  }
}
