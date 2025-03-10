<?php

namespace App\Propostas;

use Illuminate\Database\Eloquent\Model;

class ModalidadeParticipacao extends Model
{
   protected $connection	= 'pgsql_corp';

   protected $table = 'mcid_propostas.opc_modalidade_participacao';

   
    public $timestamps = false; // tabela não possui coluna de data de criação/atualização

    public function user()
    {
       return $this->belongsTo(User::class); //possui muitos
    }

    public function prototipo()
    {
       return $this->belongsTo(Prototipo::class); //possui muitos
    }

    public function propostas()
    {
       return $this->hasMany(Propostas::class); //possui muitos
    }

    public function SelecaoPropostass()
    {
       return $this->hasMany(SelecaoPropostas::class); //possui muitos
    }

}
