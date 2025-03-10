<?php

namespace App\Mod_apis;

use App\User;
use Illuminate\Database\Eloquent\Model;

class AcompanhamentoDebentures extends Model

{

    protected $connection    = 'pgsql_corp';

    protected $table = 'mcid_sistema_apis.tab_acompanhamento_debentures';

    public $timestamps = true; // tabela não possui coluna de data de criação/atualização

    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id'); //possui muitos
    }
}
