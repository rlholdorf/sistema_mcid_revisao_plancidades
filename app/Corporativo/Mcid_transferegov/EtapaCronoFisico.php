<?php

namespace App\Corporativo\Mcid_transferegov;

use Illuminate\Database\Eloquent\Model;

class EtapaCronoFisico extends Model
{

  protected $connection  = 'pgsql_corp';

  protected $primaryKey = 'num_convenio';

  protected $table = 'mcid_transferegov.tab_etapas_crono_fisico';

  //public $timestamps = false; // tabela não possui coluna de data de criação/atualização


}
