<?php

namespace App\Mod_saci\mod_pac;

use Illuminate\Database\Eloquent\Model;

class AgenteFinanceiro extends Model
{
    protected $connection	= 'pgsql_corp';
    
   protected $table = 'pac.opc_agentes_financeiros';

   protected $primaryKey = 'cod_agente_financeiro';


    public $timestamps = false; // tabela não possui coluna de data de criação/atualização
    

}
