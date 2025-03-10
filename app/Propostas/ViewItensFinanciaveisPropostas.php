<?php

namespace App\Propostas;

use Illuminate\Database\Eloquent\Model;

class ViewItensFinanciaveisPropostas extends Model

{

   protected $connection	= 'pgsql_corp';

    protected $table = 'mcid_propostas.view_itens_financiaveis_proposta';

   
    public $timestamps = false; // tabela não possui coluna de data de criação/atualização

    


 

}
