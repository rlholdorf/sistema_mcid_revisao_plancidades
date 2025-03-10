<?php

namespace App\Propostas;

use Illuminate\Database\Eloquent\Model;

class ViewPropostasSelecionadas extends Model

{

   protected $connection	= 'pgsql_corp';

    protected $table = 'mcid_propostas.view_propostas_selecionadas';

   
    public $timestamps = false; // tabela não possui coluna de data de criação/atualização

    

 

}
