<?php

namespace App\Mod_apis;

use Illuminate\Database\Eloquent\Model;

class RlcGrupoControladorDebentures extends Model

{

    protected $connection    = 'pgsql_corp';

    protected $table = 'mcid_sistema_apis.rlc_grupo_controlador_debentures';

    public $timestamps = true; // tabela não possui coluna de data de criação/atualização

    public function concessionaria()
    {
        return $this->belongsTo(Concessionarias::class, 'concessionaria_id'); //possui muitos
    }
}