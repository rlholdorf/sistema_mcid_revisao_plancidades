<?php

namespace App\Propostas;

use Illuminate\Database\Eloquent\Model;

class SituacaoProposta extends Model

{

   protected $connection	= 'pgsql_corp';

   protected $table = 'mcid_propostas.opc_situacao_proposta';

   public $timestamps = false; // tabela não possui coluna de data de criação/atualização

   public function propostas()
    {
       return $this->hasMany(Propostas::class); //possui muitos
    }

   
}
