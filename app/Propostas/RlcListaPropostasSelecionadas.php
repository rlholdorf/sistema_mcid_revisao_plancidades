<?php

namespace App\Propostas;

use Illuminate\Database\Eloquent\Model;

class RlcListaPropostasSelecionadas extends Model

{

   protected $connection	= 'pgsql_corp';

   protected $table = 'mcid_propostas.rlc_lista_propostas_selecionadas';

   public $timestamps = false; // tabela não possui coluna de data de criação/atualização


   
   
}
