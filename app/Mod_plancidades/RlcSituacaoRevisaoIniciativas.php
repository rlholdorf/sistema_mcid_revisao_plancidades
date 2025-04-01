<?php

namespace App\Mod_plancidades;

use Illuminate\Database\Eloquent\Model;

class RlcSituacaoRevisaoIniciativas extends Model
{

    protected $connection	= 'pgsql_corp';
    
    protected $table = 'mcid_hom_plancidades.rlc_situacao_revisao_iniciativas';

    public $timestamps = false; // tabela não possui coluna de data de criação/atualização

    
}
