<?php

namespace App\Mod_apis;

use Illuminate\Database\Eloquent\Model;

class Concessionarias extends Model

{

    protected $connection    = 'pgsql_corp';

    protected $table = 'mcid_sistema_apis.tab_concessionaria';

    public $timestamps = false; // tabela não possui coluna de data de criação/atualização

    public function gruposControladores()
    {
        return $this->hasMany(RlcGrupoControladorDebentures::class, 'id', 'concessionaria_id'); //possui muitos
    }

    public function titularesProjeto()
    {
        return $this->hasMany(RlcTitularDebentures::class, 'id', 'concessionaria_id'); //possui muitos
    }

    public function tipoConcessionaria()
    {
        return $this->belongsTo(TipoConcessionarias::class, 'tipo_concessionaria_id'); //possui muitos
    }
}
