<?php

namespace App\Propostas;

use Illuminate\Database\Eloquent\Model;

class ItensFinanciaveis extends Model

{

   protected $connection	= 'pgsql_corp';

    protected $table = 'mcid_propostas.opc_itens_financiaveis';

   
    public $timestamps = false; // tabela não possui coluna de data de criação/atualização

    public function acaoPrograma()
    {
       return $this->belongsTo(AcaoPrograma::class,'acao_programa_id'); //possui muitos
    }

    public function subitensFinanciaveis()
    {
       return $this->hasMany(SubitensFinanciaveis::class); //possui muitos
    }

 

}
