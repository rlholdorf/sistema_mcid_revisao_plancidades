<?php

namespace App\Corporativo\Mcid_corporativo;

use Illuminate\Database\Eloquent\Model;

class ViewProgramaResumido extends Model
{

  protected $connection	= 'pgsql_corp';

    protected $table = 'mcid_corporativo2.vis_programa_resumido_mcid';

    //public $timestamps = false; // tabela não possui coluna de data de criação/atualização

    
}
