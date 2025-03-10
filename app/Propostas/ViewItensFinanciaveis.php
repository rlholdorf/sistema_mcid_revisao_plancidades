<?php

namespace App\Propostas;

use Illuminate\Database\Eloquent\Model;

class ViewItensFinanciaveis extends Model

{

   protected $connection	= 'pgsql_corp';

    protected $table = 'mcid_propostas.view_itens_financiaveis';

   
    public $timestamps = false; // tabela não possui coluna de data de criação/atualização

    
    public function subitensFinanciaveis()
    {
       return $this->hasMany(SubitensFinanciaveis::class,'id','subitem_financiavel_id'); //possui muitos
    }

 

}
