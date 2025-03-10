<?php

namespace App\Mod_saci\mod_pac;

use Illuminate\Database\Eloquent\Model;

class VisContratosPAC extends Model
{
    protected $connection	= 'pgsql_corp';
    
   protected $table = 'pac.vis_tab_contratos_pac';

   protected $primaryKey = 'cod_contrato_pac';

    public $timestamps = false; // tabela não possui coluna de data de criação/atualização
    

}
