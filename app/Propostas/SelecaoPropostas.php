<?php

namespace App\Propostas;

use App\User;
use Illuminate\Database\Eloquent\Model;

class SelecaoPropostas extends Model

{

   protected $connection	= 'pgsql_corp';

    protected $table = 'mcid_propostas.tab_selecao_propostas';


    public function user()
    {
       return $this->belongsTo(User::class); //possui muitos
    }
 

}
