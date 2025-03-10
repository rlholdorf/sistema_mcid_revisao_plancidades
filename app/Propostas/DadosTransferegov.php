<?php

namespace App\Propostas;

use App\EntePublico;
use App\Propostas\ModalidadeParticipacao;
use App\User;
use Illuminate\Database\Eloquent\Model;

class DadosTransferegov extends Model

{

   protected $connection	= 'pgsql_corp';

   protected $table = 'mcid_propostas.tab_dados_transferegov';

   public $timestamps = false; // tabela não possui coluna de data de criação/atualização


   

   
}
