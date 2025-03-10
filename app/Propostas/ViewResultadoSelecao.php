<?php

namespace App\Propostas;

use Illuminate\Database\Eloquent\Model;

class ViewResultadoSelecao extends Model

{

   protected $connection	= 'pgsql_corp';

    protected $table = 'mcid_propostas.view_resultado_selecao';

   
    public $timestamps = false; // tabela não possui coluna de data de criação/atualização

    

 

}
