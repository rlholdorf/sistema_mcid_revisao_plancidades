<?php

namespace App\Mod_apis;

use Illuminate\Database\Eloquent\Model;

class RlcMunicipiosBeneficiadosDebentures extends Model

{

    protected $connection    = 'pgsql_corp';

    protected $table = 'mcid_sistema_apis.rlc_municipios_beneficiados_debentures';

    public $timestamps = false; // tabela não possui coluna de data de criação/atualização

    public static function salvarMunicipioBeneficiado($projeto_debenture_id, $codMunicipio)
    {

        $municipiosBen = new RlcMunicipiosBeneficiadosDebentures;
        $municipiosBen->projeto_debenture_id = $projeto_debenture_id;
        $municipiosBen->municipio_id = $codMunicipio;
        $salvoMunicipiosBen = $municipiosBen->save();


        if ($salvoMunicipiosBen) {
            return true;
        } else {
            return true;
        }
    }
}
