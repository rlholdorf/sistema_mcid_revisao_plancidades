<?php

namespace App\Corporativo\Mcid_transferegov;

use Illuminate\Database\Eloquent\Model;

class Propostas extends Model
{

  protected $connection  = 'pgsql_corp';

  protected $primaryKey = 'cod_proposta';

  protected $table = 'mcid_transferegov.tab_propostas';

  //public $timestamps = false; // tabela não possui coluna de data de criação/atualização

  public function Convenio()
  {
    return $this->belongsTo(Convenios::class); //possui muitos
  }
}
