<?php

namespace App\Propostas;

use Illuminate\Database\Eloquent\Model;

class RlcMotivoCorrecaoProposta extends Model

{

   protected $connection	= 'pgsql_corp';

   protected $table = 'mcid_propostas.rlc_motivo_correcao_proposta';

   public $timestamps = false; // tabela não possui coluna de data de criação/atualização

   public function motivoCorrecao()
   {
      return $this->belongsTo(MotivoCorrecao::class); //possui muitos
   }
   
}
