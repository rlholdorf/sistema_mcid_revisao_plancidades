<?php

namespace App\Propostas;

use Illuminate\Database\Eloquent\Model;

class RlcItensFinanciaveisProposta extends Model

{

   protected $connection	= 'pgsql_corp';

   protected $table = 'mcid_propostas.rlc_itens_financiaveis_proposta';

   public $timestamps = false; // tabela não possui coluna de data de criação/atualização


   public static function salvarItensFinanciaveis($proposta_id, $item_financiavel_id) {

      $itensFinanciaveis = new RlcItensFinanciaveisProposta;
      $itensFinanciaveis->proposta_id = $proposta_id;
      $itensFinanciaveis->item_financiavel_id = $item_financiavel_id;
      $salvoItensFinanciaveis = $itensFinanciaveis->save();

 
  if($salvoItensFinanciaveis){                      
      return true;
  }else{                      
      return true;
  }
}
   
}
