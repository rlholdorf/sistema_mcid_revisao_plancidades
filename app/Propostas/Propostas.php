<?php

namespace App\Propostas;

use App\EntePublico;
use App\Propostas\ModalidadeParticipacao;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Propostas extends Model

{

   protected $connection	= 'pgsql_corp';

   protected $table = 'mcid_propostas.tab_propostas';

   public function situacaoProposta()
    {
       return $this->belongsTo(SituacaoProposta::class); //possui muitos
    }

    public function selecao()
    {
       return $this->belongsTo(Selecao::class); //possui muitos
    }

    public function usuario()
    {
       return $this->belongsTo(User::class,'user_id'); //possui muitos
    }

    public function modalidadeParticipacao()
    {
       return $this->belongsTo(ModalidadeParticipacao::class); //possui muitos
    }

    public function entePublico()
    {
       return $this->belongsTo(EntePublico::class); //possui muitos
    }

   
}
