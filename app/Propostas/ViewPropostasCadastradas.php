<?php

namespace App\Propostas;

use Illuminate\Database\Eloquent\Model;

class ViewPropostasCadastradas extends Model

{

   protected $connection	= 'pgsql_corp';

    protected $table = 'mcid_propostas.view_propostas_cadastradas';

   
    public $timestamps = false; // tabela não possui coluna de data de criação/atualização

    

 

}
