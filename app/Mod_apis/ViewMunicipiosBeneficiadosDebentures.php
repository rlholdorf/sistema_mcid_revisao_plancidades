<?php

namespace App\Mod_apis;

use Illuminate\Database\Eloquent\Model;

class ViewMunicipiosBeneficiadosDebentures extends Model

{

    protected $connection    = 'pgsql_corp';

    protected $table = 'mcid_sistema_apis.view_municipios_beneficiados_debentures';

    public $timestamps = false; // tabela não possui coluna de data de criação/atualização

}