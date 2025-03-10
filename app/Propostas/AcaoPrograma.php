<?php

namespace App\Propostas;

use Illuminate\Database\Eloquent\Model;

class AcaoPrograma extends Model

{

   protected $connection	= 'pgsql_corp';

    protected $table = 'mcid_propostas.opc_acao_programa';
    protected $keyType = 'string';


   
    public $timestamps = false; // tabela não possui coluna de data de criação/atualização

    public function itensFinanciaveis()
    {
       return $this->hasMany(ItensFinanciaveis::class,'acao_programa_id'); //possui muitos
    }

 

}
