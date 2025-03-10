<?php

namespace App\Mod_apis;

use Illuminate\Database\Eloquent\Model;

class TipoConcessionarias extends Model

{

    protected $connection    = 'pgsql_corp';

    protected $table = 'mcid_sistema_apis.opc_tipo_concessionaria';

    public $timestamps = false; // tabela não possui coluna de data de criação/atualização

    public function concessionarias()
    {
        return $this->hasMany(Concessionarias::class); //possui muitos
    }
}
