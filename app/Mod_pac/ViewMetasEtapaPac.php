<?php

namespace App\Mod_pac;

use Illuminate\Database\Eloquent\Model;

class ViewMetasEtapaPac extends Model
{

  protected $connection  = 'pgsql_corp';

  protected $table = 'mcid_pac.view_meta_etapa_pac_pendencias_caixa';


  public $timestamps = false; // tabela não possui coluna de data de criação/atualização


}
