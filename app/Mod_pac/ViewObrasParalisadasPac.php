<?php

namespace App\Mod_pac;

use Illuminate\Database\Eloquent\Model;

class ViewObrasParalisadasPac extends Model
{

  protected $connection  = 'pgsql_corp';

  protected $table = 'mcid_pac.view_obras_paralisadas_pac';


  public $timestamps = false; // tabela não possui coluna de data de criação/atualização


}
