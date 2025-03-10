<?php

namespace App\Corporativo\Mdr_siconv;

use Illuminate\Database\Eloquent\Model;

class Convenios extends Model
{

  protected $connection  = 'pgsql_corp';

  protected $primaryKey = 'num_convenio';

  protected $table = 'mdr_siconv.tab_convenios';

  //public $timestamps = false; // tabela não possui coluna de data de criação/atualização

  public function proposta()
    {
       return $this->belongsTo(Propostas::class,'cod_proposta'); //possui muitos
    }


}