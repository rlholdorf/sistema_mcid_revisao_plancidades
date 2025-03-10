<?php

namespace App\Propostas;

use Illuminate\Database\Eloquent\Model;

class SubitensFinanciaveis extends Model

{

   protected $connection	= 'pgsql_corp';

    protected $table = 'mcid_propostas.opc_subitens_financiaveis';

   
    public $timestamps = false; // tabela não possui coluna de data de criação/atualização

    public function itemFinanciavel()
    {
       return $this->belongsTo(ViewItensFinanciaveis::class); //possui muitos
    }


 

}
