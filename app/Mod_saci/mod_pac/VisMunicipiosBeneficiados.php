<?php

namespace App\Mod_saci\mod_pac;

use Illuminate\Database\Eloquent\Model;

class VisMunicipiosBeneficiados extends Model
{
    protected $connection	= 'pgsql_corp';
    
   protected $table = 'pac.vis_municipios_beneficiados';

   //protected $primaryKey = 'cod_contrato';

    public $timestamps = false; // tabela não possui coluna de data de criação/atualização
    

}
