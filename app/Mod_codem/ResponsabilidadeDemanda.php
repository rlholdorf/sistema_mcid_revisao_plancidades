<?php

namespace App\Mod_codem;

use Illuminate\Database\Eloquent\Model;
use App\User;

class ResponsabilidadeDemanda extends Model
{

    protected $connection	= 'pgsql_corp';

    protected $table = 'mcid_codem.tab_responsabilidade_demanda';

    public $timestamps = false; // tabela não possui coluna de data de criação/atualização

    protected $fillable = [
        'demanda_id', 
        'user_id',
        'dte_atribuicao_demanda'
    ];



    
}
