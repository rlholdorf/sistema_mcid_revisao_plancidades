<?php

namespace App\Mod_bndes;

use Illuminate\Database\Eloquent\Model;

class ViewMunicipiosBeneficiadosBndes extends Model

{

   protected $connection	= 'pgsql_corp';

    protected $table = 'mcid_bndes.view_municipios_beneficiados_bndes';
   
    public $timestamps = false; // tabela não possui coluna de data de criação/atualização

}
