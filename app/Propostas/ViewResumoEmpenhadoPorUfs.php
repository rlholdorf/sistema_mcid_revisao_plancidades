<?php

namespace App\Propostas;

use Illuminate\Database\Eloquent\Model;

class ViewResumoEmpenhadoPorUfs extends Model

{

   protected $connection	= 'pgsql_corp';

    protected $table = 'mcid_propostas.view_resumo_vlr_empenhado_por_uf';

   
    public $timestamps = false; // tabela não possui coluna de data de criação/atualização

    

}
