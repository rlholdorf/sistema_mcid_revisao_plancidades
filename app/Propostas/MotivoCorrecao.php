<?php

namespace App\Propostas;

use Illuminate\Database\Eloquent\Model;

class MotivoCorrecao extends Model
{
   protected $connection	= 'pgsql_corp';

   protected $table = 'mcid_propostas.opc_motivo_correcao';

   
    public $timestamps = false; // tabela não possui coluna de data de criação/atualização

    public function motivoCorrecaoProposta()
    {
       return $this->belongsTo(RlcMotivoCorrecaoProposta::class,'motivo_correcao_id'); //possui muitos
    }

}
